<?php                  
session_start();
unset($_SESSION['context']);
header("Location: /Course-work/controllers/ai_chat.php");
?>