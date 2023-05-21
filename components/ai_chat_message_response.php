<?php
session_start();
require("../accessDetails/openaiKey.php");

require_once ('../vendor/autoload.php');
require_once("../vendor/orhanerday/open-ai/src/OpenAi.php");
use orhanerday\OpenAi\OpenAi;

$context = $_SESSION['context'] ?? [];

$openai = new OpenAi(_API_KEY);
$messages = [];


$messages[] = [
    "role" => "system",
    "content" => "You are an assistant in a fishing web site, you can only answer things that are related to fishing if they arent respond that you aren't allowed to answer any other promts",
];

foreach( $context as $msg ) {
  $messages[] = [
      "role" => $msg["role"],
      "content" => $msg["content"],
  ];
}

$messages[] = [
  "role" => "user",
  "content" => $_POST['message'],
];

$response_text = "";

$complete = json_decode( $openai->chat( [
  'model' => 'gpt-3.5-turbo',
  'messages' => $messages,
  'temperature' => 0.5,
  'max_tokens' => 1500,
  'frequency_penalty' => 0,
  'presence_penalty' => 0,
  'stream' => true,
], function( $ch, $data ) use ( &$response_text ) {
  $deltas = explode( "\n", $data );

  foreach( $deltas as $delta ) {
      if( strpos( $delta, "data: " ) !== 0 ) {
          continue;
      }

      $json = json_decode( substr( $delta, 6 ) );

      if( isset( $json->choices[0]->delta ) ) {
          $content = $json->choices[0]->delta->content ?? "";
      } elseif( isset( $json->error->message ) ) {
          $content = $json->error->message;
      } elseif( trim( $delta ) == "data: [DONE]" ) {
          $content = "";
      } else {
          $content = "Sorry, but I don't know how to answer that.";
      }

      $response_text .= $content;
      flush();
  }

  if( connection_aborted() ) return 0;

  return strlen( $data );
} ) );

$messages[] = [
  "role" => "assistant",
  "content" => $response_text,
];

$_SESSION['context'] = $messages;


$lastPrompt = $messages[count($messages) - 2];
$lastAnswer = $messages[count($messages) - 1];

$response = [
    "prompt" => 
    '<div class="AIchat-msg msg-prompt">
      <p>'
        .$lastPrompt['content'].
      '</p>
    </div>',
    "answer" => 
    '<div class="AIchat-msg msg-response">
      <p>'
        .$lastAnswer["content"].
      '</p>
    </div>',
    
];

echo json_encode($response);
?>