<?php
session_start();
require "model/connect-db.php";

if(!isset($_GET['procurar'])){
    $sql = "SELECT * FROM produtos";
}elseif(isset($_GET['procurar'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM produtos WHERE nome LIKE '%$search%'";
}else{
    $sql = "SELECT * FROM produtos";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css" type="text/css">
    <link rel="stylesheet" href="assets/css/index-responsividade.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Document</title>
</head>
<body>
    <nav class="nav-bar">
        <div class="logo">
            <a href="index.php" target="_self" rel="next">Fashion Style</a>
        </div>
<?php
    if(empty($_SESSION['token_auth']) && empty($_SESSION['token_authAdmin'])){
?>
        <!--SE NÃO HÁ LOGIN-->
        <div class="menu">
            <ul>
                <li class="li"><a href="view/login.php" target="_self" rel="next" id="botao">LOGIN</a></li>
                <li class="li"><a href="view/cadastrar.php" target="_self" rel="next">CADASTRAR</a></li>
            </ul>
        </div>
<?php
    }else{
        require "model/connect-db.php";
        if(isset($_SESSION['token_auth'])) {
            $user = $_SESSION['token_auth'];
            $sql1 = "SELECT * FROM info_users INNER JOIN usuarios ON info_users.id = usuarios.id WHERE usuario = '$user'";
        }elseif(isset($_SESSION['token_authAdmin'])){
            $user = 'admin';
            $sql1 = "SELECT * FROM info_users INNER JOIN usuarios ON info_users.id = usuarios.id WHERE usuario = '$user'";
        }

        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
?>
        <!--SE JA HÁ LOGIN-->
        <div class="menu">
            <ul>
                <li class="li"><a href="view/meuspedidos.php" target="_self" rel="next">MEUS PEDIDOS</a></li>
                <li class="li-user">
                    <a href="javascript:void(0)" class="dropbtn"><img src="assets/img/icon-user.png" alt="Ícone de usuário" id="icon-user"></a>
                    <div class="dropdown-container">
                        <p class="id-username"><?=$row1['nomeCompleto']?></p>
                        <p class="id-user-email"><?=$row1['email']?></p>
                        <a class="auth" href="view/login.php">LOGIN</a>
                        <a class="auth" href="view/cadastrar.php">CADASTRAR</a>
                        <a href="controller/exit.php"><button>SAIR</button></a>
                    </div>
                </li>
            </ul>
        </div>
<?php
    }
?>
    </nav>
    <div class="compra-realizada" id="box-buy" style="display: none;">
        <div style="cursor: pointer;" class="btn-close" onclick="closebox()">
            <span class="material-symbols-outlined">
                close
            </span>
        </div>
        <div class="message">
            <p>Compra realizada com sucesso!</p>
        </div>
    </div>
    <main id="main" class="main">
        <form action="index.php" method="get" class="search-box">
            <span class="material-symbols-outlined">
                search
            </span>
            <input type="search" name="search" id="search">
            <input type="submit" value="PROCURAR" name="procurar" id="procurar">
        </form>
        <div class="produtos">
<?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
?>
            <div class="produto">
                <div class="img">
                    <img src="assets/img/uploads/<?=$row['caminhoIMG']?>" alt="imgoi">
                </div>

                <div class="informacoes-produto">
                    <div class="nome-produto">
                        <p><?=$row['nome']?></p>
                    </div>
                    <div class="valor-produto">
                        <p>R$<?=$row['valor']?></p>
                    </div>
                    <form action="controller/verif-pedido.php" method="post" class="comprar-produto">
                        <!--ocultar esse elemento-->
                        <input type="text" value="<?=$row['id'];?>" name="id" style="display: none;">
                        <input id="comprar" type="submit" value="COMPRAR" name="comprar">
                    </form>
                </div>
            </div>
<?php
            }
        }else {
            echo "Não há produtos";
            }
?>
    </main>

    <footer>

    </footer>
</body>
</html>
<script>
    function closebox() {
        document.getElementById('box-buy').style.display = 'none'
    }
</script>
<?php
    if (isset($_SESSION['compra-realizada'])) {
?>
<script>
    var main = document.getElementById('main')
    var boxbuy = document.getElementById('box-buy')
    boxbuy.style.display = 'block'
    //main.style.pointerEvents = 'none'
    //main.style.touchAction = 'none'
</script>
<?php
    unset($_SESSION['compra-realizada']);
    }
?>