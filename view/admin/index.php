<?php
session_start();
include "../../model/connect-db.php";
if(!isset($_SESSION['token_authAdmin'])){
    header("location: ../../index.php");
}else{
    $sql = "SELECT * FROM produtos";
    $result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Fashion Style</title>
</head>
<body>    
    <header>

    </header>

    <main>
        <div id="registrar-produto">
            <form action="../../controller/register-product.php" method="post" enctype="multipart/form-data">

                <div id="img-regP">
                    <input type="file" name="img-product" id="img-product">
                </div>

                <div id="info">

                    <div id="nome-produto">
                        <label for="nome-p">NOME:</label>
                        <input type="text" name="nome-p" id="nome-p">
                    </div>

                    <div id="valor-produto">
                        <label for="valor-p">VALOR:</label>
                        <input type="text" name="valor-p" id="valor-p">
                    </div>

                </div>

                <input type="submit" value="REGISTRAR">
            </form>
        </div>

        <div id="produtos">
<?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
?>
                    <div id="produto">
                        <div id="img">
                            <img src="../../assets/img/uploads/<?=$row['caminhoIMG']?>" alt="imgoi">
                        </div>

                        <div id="nome-pro">
                            <p><?=$row['nome']?></p>
                        </div>

                        <div id="valor-pro">
                            <p><?=$row['valor']?></p>
                        </div>
                    </div>
<?php
                }
              } else {
                echo "Não há produtos";
              }
?>
        </div>

        <div id="pedidos">
            
        </div>

        <div id="excluir-produtos">
            
        </div>
    </main>

    <footer>

    </footer>
</body>
</html>


<?php
}
?>