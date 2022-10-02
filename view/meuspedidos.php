<?php
session_start();
require "../model/connect-db.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos - Fashion Style</title>
</head>
<body>
    <header>

    </header>

    <main>
<?php
    if(isset($_SESSION['token_auth'])){
        $client = $_SESSION['token_auth'];
        $sql = "SELECT * FROM pedidos WHERE client = '$client'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
?>
        <div>
            <p id="produto"><?=$row['produto']?></p>
            <p id="data"><?=$row['dataPEDIDO']?></p>
            <p id="estado"><?=$row['estado']?></p>
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