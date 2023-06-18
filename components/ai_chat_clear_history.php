<?php                  
session_start();
unset($_SESSION['context']);
header("Location: ../controllers/ai_chat.php");
?>