<?php
session_start();
require "../model/connect-db.php";

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
$entrar = $_POST["entrar"];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if(isset($entrar)){
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row['senha'] == $senha){
            $_SESSION['token_auth'] = md5($senha);
            header("location: redirect.php");
        }else{
            header("location: ../view/login.php");
        }
    }else{
        header("location: ../view/login.php");
    }
}
?>