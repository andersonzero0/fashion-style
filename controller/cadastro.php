<?php
require "../model/connect-db.php";

$usuario_cad = $_POST['usuario_cad'];
$senha_cad = $_POST['senha_cad'];

$sql = "INSERT INTO usuarios (usuario, senha)
VALUES ('$usuario_cad', '$senha_cad')";

if (mysqli_query($conn, $sql)) {
    header("location: ../view/login.php");
  } else {
    header("location: ../view/cadastrar.php");
  }
?>