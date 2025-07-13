<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
$id = $_POST['id'];

$sql = "DELETE FROM anuncios WHERE id = '". $id . "'";


if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Erro ao deletar" . mysqli_error($conn);
}
} else {
    header("index.php");
    exit;
}

mysqli_close($conn);
?>