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
  if(isset($usuario_cad) && isset($nomeCompleto) && isset($endereco) && isset($telefone) && isset($email) && isset($senha_cad)){
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario_cad'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
      $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario_cad', '$senha_cad');";
      $sql1 = "INSERT INTO info_users (nomeCompleto, endereco, telefone, email) VALUES ('$nomeCompleto', '$endereco', '$telefone', '$email');";

      if ($conn->query($sql) === TRUE && $conn->query($sql1)) {
        header("location: ../view/login.php");
      } else {
        header("location: ../view/cadastrar.php");
      }
    }else{
?>

    <div>
      <p>Já existe usuario com esse nome.</p>
      <a href="../view/cadastrar.php">Tentar fazer o cadastro novamente</a>
    </div>

<?php
    }
  }else{
?>

    <div>
      <p>Você não inseriu as informações por completo.</p>
      <a href="../view/cadastrar.php">Tentar fazer o cadastro novamente</a>
    </div>

<?php
  }
}else{
  header('location: ../index.php');
}
?>