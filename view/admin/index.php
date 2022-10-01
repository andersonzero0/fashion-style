<?php
session_start();
include "../../model/connect-db.php";
if(!isset($_SESSION['token_authAdmin'])){
    header("location: ../../index.php");
}else{
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
            $sql = "SELECT * FROM produtos";
            $result = $conn->query($sql);
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

<?php
    $sql1 = "SELECT * FROM usuarios INNER JOIN info_users ON usuarios.id = info_users.id INNER JOIN pedidos ON usuarios.usuario = pedidos.client INNER JOIN produtos ON pedidos.produto = produtos.nome";

    $result1 = $conn->query($sql1);
    if ($result->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
?>
        <div id="pedidos">
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>Nome Completo</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <td><?=$row1['produto']?></td>
                    <td><?=$row1['valor']?></td>
                    <td><?=$row1['nomeCompleto']?></td>
                    <td><?=$row1['endereco']?></td>
                    <td><?=$row1['telefone']?></td>
                    <td><?=$row1['email']?></td>
                </tr>
            </table>
        </div>
<?php
    }
    }else{
        echo "Não há pedidos";
    }
?>

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