<!-- encerra a sessão -->
<?php
session_start();
$_SESSION = [];
session_destroy();
//redireciona para o login
header("Location: login.php"); 
exit;
?>