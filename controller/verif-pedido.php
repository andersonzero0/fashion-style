<?php
session_start();

if(isset($_POST['comprar'])) {
    if(isset($_SESSION['token_auth'])){
        require "../model/connect-db.php";

        $id = $_POST['id'];

        $client = $_SESSION['token_auth'];

        $sql = "SELECT * FROM produtos WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $produto = $row['nome'];
        date_default_timezone_set("America/Sao_Paulo");
        $data = date("Y-m-d");
        $hora = date("H:i:s");

        $sql1 = "INSERT INTO pedidos(client, produto, dataPEDIDO, horaPEDIDO, estado)
        VALUES ('$client', '$produto', '$data', '$hora', 'EM ESPERA')";
        
        if($conn->query($sql1) == TRUE){
            $_SESSION['compRealizd'] = $client; 
            header('location: ../view/comprarealizada.php');
        }

    }else{
        header('location: ../view/login.php');
    }
}else{
    header('location: ../index.php');
}
?>