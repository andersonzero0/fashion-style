<?php
session_start();
require "../model/connect-db.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/meuspedidos.css">
    <title>Meus Pedidos - Fashion Style</title>
</head>
<body>
    <nav class="nav-bar">
        <div class="logo">
            <a href="../index.php" target="_self" rel="next">Fashion Style</a>
        </div>
<?php
    if(empty($_SESSION['token_auth']) && empty($_SESSION['token_authAdmin'])){
?>
        <!--SE NÃO HÁ LOGIN-->
        <div class="menu">
            <ul>
                <li class="li"><a href="login.php" target="_self" rel="next" id="botao">LOGIN</a></li>
                <li class="li"><a href="cadastrar.php" target="_self" rel="next">CADASTRAR</a></li>
            </ul>
        </div>
<?php
    }else{
        require "../model/connect-db.php";
        if(isset($_SESSION['token_auth'])) {
            $user = $_SESSION['token_auth'];
            $sql = "SELECT * FROM info_users INNER JOIN usuarios ON info_users.id = usuarios.id WHERE usuario = '$user'";
        }elseif(isset($_SESSION['token_authAdmin'])){
            $user = 'admin';
            $sql = "SELECT * FROM info_users INNER JOIN usuarios ON info_users.id = usuarios.id WHERE usuario = '$user'";
        }

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
?>
        <!--SE JA HÁ LOGIN-->
        <div class="menu">
            <ul>
                <li class="li"><a href="meuspedidos.php" target="_self" rel="next" id="botao">MEUS PEDIDOS</a></li>
                <li class="li-user">
                    <a href="javascript:void(0)" class="dropbtn"><img src="../assets/img/icon-user.png" alt="Ícone de usuário" id="icon-user"></a>
                    <div class="dropdown-container">
                        <p class="id-username"><?=$row['nomeCompleto']?></p>
                        <p class="id-user-email"><?=$row['email']?></p>
                        <a href="login.php">LOGIN</a>
                        <a href="cadastrar.php">CADASTRAR</a>
                        <a href="../controller/exit.php"><button>SAIR</button></a>
                    </div>
                </li>
            </ul>
        </div>
<?php
    }
?>
    </nav>
    <main>
<?php
    if(isset($_SESSION['token_auth'])){
        $client = $_SESSION['token_auth'];
        $sql1 = "SELECT * FROM pedidos INNER JOIN produtos ON pedidos.produto = produtos.nome WHERE client = '$client'";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $estado = $row1['estado'];
                switch ($estado) {
                    case 'EM ESPERA':
                        $color = 'yellow';
                        break;
                    case 'A CAMINHO':
                        $color = 'blue';
                        break;
                    case 'ENTREGUE':
                        $color = 'grenn';
                        break;
                    case 'RECUSADO':
                        $color = 'red';
                        break;

                }
?>
        <div>
            <img src="../assets/img/uploads/<?=$row1['caminhoIMG']?>" alt="Imagem">
            <p id="produto"><?=$row1['produto']?></p>
            <p id="data"><?=$row1['dataPEDIDO']?></p>
            <p style="background-color: <?=$color?>;" class="estado"><?=$estado?></p>
        </div>
<?php
            }
        }else{
?>
        <div>
            <p>Você ainda não fez compras!</p>
            <a href="../index.php">Acesse aqui para comprar nossos produtos</a>
        </div>
<?php
        }
    }else{

?>
        <div>
            <p>Faça login para ver os seus pedidos</p>
            <a href="login.php">Ir para Login</a>
        </div>
<?php
    }
?>
    </main>

    <footer>

    </footer>
</body>
</html>
