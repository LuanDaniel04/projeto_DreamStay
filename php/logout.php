<!-- encerra a sessão -->
<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: login.php"); //redireciona para o login
exit;
?>