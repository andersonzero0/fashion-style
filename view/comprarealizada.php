<?php
session_start();
if(isset($_SESSION['compRealizd'])){
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>

    </header>

    <main>
        <p>Compra Realizada Com Sucesso</p>
        <a href="../controller/redirect1.php">Voltar</a>
    </main>

    <footer>

    </footer>
</body>
</html>

<?php
}else{
    header("location: ../index.php");
}
?>