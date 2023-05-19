<?php
session_start();
require("..\accessDetails\databaseDetails.php");

use Orhanerday\OpenAi\OpenAi;

$context = $_SESSION['context'] ?? [];
$userMessage = $_POST["message"];

$openai = new OpenAi(_API_KEY);
$messages = [];

if( ! empty( $settings['system_message'] ) ) {
  $messages[] = [
      "role" => "system",
      "content" => $settings['system_message'],
  ];
}

foreach( $context as $msg ) {
  $messages[] = [
      "role" => $msg["role"],
      "content" => $msg["content"],
  ];
}

$messages[] = [
  "role" => "user",
  "content" => $_GET['message'],
];

$response_text = "";

$complete = json_decode( $openai->chat( [
  'model' => 'gpt-3.5-turbo',
  'messages' => $messages,
  'temperature' => 1.0,
  'max_tokens' => 2000,
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

      echo "data: " . json_encode( ["content" => $content] ) . "\n\n";
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

echo "event: stop\n";
echo "data: stopped\n\n";
?>