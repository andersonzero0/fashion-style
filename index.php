<?php
session_start();
require "model/connect-db.php";

if(!isset($_GET['procurar'])){
    $sql = "SELECT * FROM produtos";
}elseif(isset($_GET['procurar'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM produtos WHERE nome LIKE '$search%'";
}else{
    $sql = "SELECT * FROM produtos";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <?php
            if(isset($_SESSION['token_auth']) || isset($_SESSION['token_authAdmin'])){
                echo 1;
            }else{
                echo 0;
            }
        ?>
        <a href="controller/exit.php">exit</a>
        <a href="view/login.php">login</a>
        <a href="view/cadastrar.php">cadastrar</a>
    </header>

    <main>
        <form action="index.php" method="get">
            <input type="search" name="search" id="search">
            <input type="submit" value="procurar" name="procurar" id="procurar">
        </form>

        <div id="produtos">
<?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
?>
            <div id="produto">
                <div id="img">
                    <img src="assets/img/uploads/<?=$row['caminhoIMG']?>" alt="imgoi">
                </div>

                <div id="nome-pro">
                    <p><?=$row['nome']?></p>
                </div>

                <div id="valor-pro">
                    <p><?=$row['valor']?></p>
                </div>
                <form action="controller/verif-pedido.php" method="post">
                    <!--ocultar esse elemento-->
                    <input type="text" value="<?=$row['id'];?>" name="id">

                    <input id="comprar" type="submit" value="comprar" name="comprar">
                </form>
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