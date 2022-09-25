<?php
require "../model/connect-db.php";

$usuario = $_POST["usuario"];
$senha = md5($_POST["senha"]);

echo $usuario, $senha;
?>