<?php
session_start();
include "../../model/connect-db.php";
if(empty($_SESSION['token_authAdmin'])){
    header("location: ../../index.php");
}else{
    header('Refresh: 120;');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
            <sub id="alert" style="color: red;">*Todos os campos não estão preenchidos</sub>
            <div class="img-regP">
                <input type="file" name="img-product" class="img-product" required>
            </div>

            <div class="info">

                <div class="nome-produto">
                    <label for="nome-p">NOME:</label>
                    <input type="text" name="nome-p" id="nome-p" required>
                </div>

                <div class="valor-produto">
                    <label for="valor-p">VALOR:</label>
                    <input type="text" name="valor-p" id="valor-p" required>
                </div>

                <div class="estoque-produto">
                    <label for="estoque-p">ESTOQUE:</label>
                    <input type="number" name="estoque-p" id="estoque-p" required>
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
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <td><?=$row1['produto']?></td>
                    <td><?=$row1['valor']?></td>
                    <td><?=$row1['nomeCompleto']?></td>
                    <td><?=$row1['dataPEDIDO']?></td>
                    <td><?=$row1['horaPEDIDO']?></td>
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
        echo "<p style='text-align: center; font-weight: bold''>Não há pedidos</p> <br>";
    }
    $sql4 = "SELECT * FROM produtos";
    $result4 = $conn->query($sql4);
    if($result4->num_rows > 0){
?>
        <div class="container-edit">
            <div class="table-edit">
                <table class="tabela-edit">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
while($row4 = $result4->fetch_assoc()){
    if(isset($_GET['save'])){
        $valor_p_edit = $_GET['valor'];
        $estoque_p_edit = $_GET['estoque'];
        $id_p_edit = $_GET['id'];
        $sql5 = "UPDATE produtos SET valor = '$valor_p_edit', estoque = '$estoque_p_edit' WHERE id = $id_p_edit";
        $conn->query($sql5);
        echo "<script> window.location.href='index.php'; </script>";
    }
    if(isset($_GET['btnexcluir'])){
        $id_excluir = $_GET['id_excluir'];
        $caminhoImgDelete = $_GET['caminhoImgDelete'];
        $file = "../../assets/img/uploads/$caminhoImgDelete";
        $sql6 = "DELETE FROM produtos WHERE id = $id_excluir";
        $conn->query($sql6);
        unlink($file);
        echo "<script> window.location.href='index.php'; </script>";
    }
?>
                        <tr>
                            <td><?=$row4['nome']?></td>
                            <td><?=$row4['valor']?></td>
                            <td><?=$row4['estoque']?></td>
                            <td>
                                <form action="index.php" method="get">
                                    <input style="display: none;" value="<?=$row4['id']?>" type="text" name="id_excluir" id="id_excluir">
                                    <input style="display: none;" value="<?=$row4['caminhoIMG']?>" type="text" name="caminhoImgDelete" id="caminhoImgDelete">
                                    <button name="btnexcluir" type="submit"><span class="material-symbols-outlined">delete</span></button>
                                </form>
                            </td>
                        </tr>
<?php
}
?>
                    </tbody>
                </table>
            </div>
            <div class="div-edit">
                <button id="btn-edit" onclick="showFormEdit()"><span class="material-symbols-outlined">edit</span></button>
            </div>
        </div>
        <div id="box-edit">
        <span id="btn-close" onclick="exitFormEdit()" class="material-symbols-outlined">close</span>
        <form id="form-edit" action="index.php" method="get">
            <select name="id" id="id_edit_p">
<?php
        $sqlx = "SELECT * FROM produtos";
        $resultx = $conn->query($sqlx);
        while($rowx = $resultx->fetch_assoc()){
?>
            <option value="<?=$rowx['id']?>"><?=$rowx['nome']?></option>
<?php
        }
?>
            </select>
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" required>

            <label for="estoque">Estoque:</label>
            <input type="number" name="estoque" id="estoque" required>

            <input type="submit" value="Salvar" name="save">
        </form>
        <form action="index.php" method="get">
        </form>
        </div>
<?php
    }else{
        echo "<p style='text-align: center; font-weight: bold'>Não há produtos</p>";
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

<?php
if(isset($_SESSION['erroRegProduct'])){
?>
<script>
    var alert = document.getElementById('alert');
    alert.style.display = 'block';
</script>
<?php
unset($_SESSION['erroRegProduct']);
}else{
?>
<script>
    var alert = document.getElementById('alert');
    alert.style.display = 'none';
</script>
<?php
}
?>

<script>
    var btn_edit = document.getElementById('btn-edit');
    var box_edit = document.getElementById('box-edit');

    box_edit.style.display = 'none'

    function showFormEdit() {
        box_edit.style.display = 'block'
    }

    function exitFormEdit() {
        box_edit.style.display = 'none'
    }
</script>