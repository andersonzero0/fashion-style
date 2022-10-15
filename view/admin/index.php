<?php
session_start();
include "../../model/connect-db.php";
if(!isset($_SESSION['token_authAdmin'])){
    header("location: ../../index.php");
}else{
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css" type="text/css">
    <title>Admin - Fashion Style</title>
</head>
<body>    
    <nav class="nav-bar">
        <div class="logo">
            <a href="../../index.php" target="_self" rel="next">Fashion Style</a>
        </div>
<?php
    if(empty($_SESSION['token_auth']) && empty($_SESSION['token_authAdmin'])){
?>
        <!--SE NÃO HÁ LOGIN-->
        <div class="menu">
            <ul>
                <li class="li"><a href="../login.php" target="_self" rel="next" id="botao">LOGIN</a></li>
                <li class="li"><a href="../cadastrar.php" target="_self" rel="next">CADASTRAR</a></li>
            </ul>
        </div>
<?php
    }else{
        require "../../model/connect-db.php";
        if(isset($_SESSION['token_auth'])) {
            $user = $_SESSION['token_auth'];
            $sql3 = "SELECT * FROM info_users INNER JOIN usuarios ON info_users.id = usuarios.id WHERE usuario = '$user'";
        }elseif(isset($_SESSION['token_authAdmin'])){
            $user = 'admin';
            $sql3 = "SELECT * FROM info_users INNER JOIN usuarios ON info_users.id = usuarios.id WHERE usuario = '$user'";
        }

        $result3 = $conn->query($sql3);
        $row3 = $result3->fetch_assoc();
?>
        <!--SE JA HÁ LOGIN-->
        <div class="menu">
            <ul>
                <li class="li-user">
                    <a href="javascript:void(0)" class="dropbtn"><img src="../../assets/img/icon-user.png" alt="Ícone de usuário" id="icon-user"></a>
                    <div class="dropdown-container">
                        <p class="id-username"><?=$row3['nomeCompleto']?></p>
                        <p class="id-user-email"><?=$row3['email']?></p>
                        <a href="../login.php">LOGIN</a>
                        <a href="../cadastrar.php">CADASTRAR</a>
                        <a href="../../controller/exit.php"><button>SAIR</button></a>
                    </div>
                </li>
            </ul>
        </div>
<?php
    }
?>
    </nav>
    <main>
        <form action="../../controller/register-product.php" method="post" enctype="multipart/form-data" class="registrar-produto">

            <div class="img-regP">
                <input type="file" name="img-product" class="img-product">
            </div>

            <div class="info">

                <div class="nome-produto">
                    <label for="nome-p">NOME:</label>
                    <input type="text" name="nome-p" id="nome-p">
                </div>

                <div class="valor-produto">
                    <label for="valor-p">VALOR:</label>
                    <input type="text" name="valor-p" id="valor-p">
                </div>

            </div>

            <input type="submit" value="REGISTRAR" id="botao-registrar">
        </form>
<?php
    $sql1 = "SELECT * FROM usuarios INNER JOIN info_users ON usuarios.id = info_users.id INNER JOIN pedidos ON usuarios.usuario = pedidos.client INNER JOIN produtos ON pedidos.produto = produtos.nome";
    
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
            if(isset($_GET['atualizar'])){
                $estado = $_GET['estado'];
                switch ($estado) {
                    case 'espera':
                        $estado = 'EM ESPERA';
                        break;
                    case 'caminho':
                        $estado = 'A CAMINHO';
                        break;
                    case 'entrege':
                        $estado = 'ENTREGE';
                        break;
                    case 'recusado':
                        $estado = 'RECUSADO';
                        break;
                    default:
                        $estado = 'EM ESPERA';
                }
                $id = $_GET['id'];
                $sql2 = "UPDATE pedidos SET estado = '$estado' WHERE id1 = '$id'";
                $conn->query($sql2);
                header('location: ../../controller/update.php');
            }
?>
        <div class="pedidos">
            <table class="tabela-pedidos">
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
                    <td>
                        <form action="index.php" method="get">
                            <!--ocultar esse elemento-->
                            <input type="text" name="id" class="id" value="<?=$row1['id1']?>">

                            <select name="estado" class="estado">
                                <option value="espera" <?php if($row1['estado'] == 'EM ESPERA'){ ?> selected <?php } ?>>EM ESPERA</option>
                                <option value="caminho" <?php if($row1['estado'] == 'A CAMINHO'){ ?> selected <?php } ?>>A CAMINHO</option>
                                <option value="entrege" <?php if($row1['estado'] == 'ENTREGE'){ ?> selected <?php } ?>>ENTREGE</option>
                                <option value="recusado" <?php if($row1['estado'] == 'RECUSADO'){ ?> selected <?php } ?>>RECUSADO</option>
                            </select>
                            <input type="submit" value="ATUALIZAR" name="atualizar" id="botao-tabela">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
<?php
    }
    }else{
        echo "Não há pedidos";
    }
?>
    </main>

    <footer>

    </footer>
</body>
</html>


<?php
}
?>