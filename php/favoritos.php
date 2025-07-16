<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// $usuario_id = $_SESSION['id'];
// $sql = "SELECT * FROM register WHERE id = $usuario_id";
// $result = mysqli_query($conn, $sql);

// if ($result && mysqli_num_rows($result) > 0) {
//     $usuario = mysqli_fetch_assoc($result);
// } else {
//     die("Usuário não encontrado.");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Vai trabalhar vagabunda!</h1>
    
</body>
</html>