<?php
session_start();
require "../model/connect-db.php";

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
$entrar = $_POST["entrar"];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($sql);

$sql1 = "SELECT * FROM usuarios WHERE usuario = 'admin'";
$result1 = $conn->query($sql1);

if(isset($entrar)){
    if(empty($_SESSION['token_auth']) && empty($_SESSION['token_authAdmin'])){
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row1 = $result1->fetch_assoc();

            if($usuario == $row1['usuario'] && $senha == $row1['senha']){
                $_SESSION['token_authAdmin'] = md5($senha);
                header("location: redirect.php");
            }
            elseif($row['senha'] == $senha){
                $_SESSION['token_auth'] = $usuario;
                header("location: redirect.php");
            }else{
?>

                <div>
                    <p>Usuário e/ou senha incorretas</p>
                    <a href="../view/login.php">Tente fazer login novamente</a>
                </div>

<?php
            }
        }else{
?>

            <div>
                <p>Usuário não encontrado.</p>
                <a href="../view/login.php">Tente fazer login novamente</a>
            </div>

<?php
        }
    }else{
?>

        <div>
            <p>Você já fez login. Saia para dessa conta e faça o login novamente.</p>
            <a href="../index.php">Pagina Inicial</a>
        </div>

<?php
    }
}else{
    header('location: ../index.php');
}
?>