<?php
require "../model/connect-db.php";

$usuario_cad = $_POST['usuario_cad'];
$nomeCompleto = $_POST['nomeCompleto'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha_cad = $_POST['senha_cad'];
$entrar = $_POST['entrar'];

if(isset($entrar)){
  $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario_cad'";
  $result = $conn->query($sql);

  if ($result->num_rows == 0) {
    $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario_cad', '$senha_cad'); 
    INSERT INTO info_users (nomeCompleto, endereco, telefone, email) VALUES ('$nomeCompleto', '$endereco', '$telefone', '$email');";

    if (mysqli_query($conn, $sql)) {
      header("location: ../view/login.php");
    } else {
      header("location: ../view/cadastrar.php");
    }
  }else{
    header('location: ../view/cadastrar.php');
  }
}else{
  header('location: ../index.php');
}
?>