<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/login-responsividade.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Login - Fashion Style</title>
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
                <li class="li"><a href="meuspedidos.php" target="_self" rel="next">MEUS PEDIDOS</a></li>
                <li class="li-user">
                    <a href="javascript:void(0)" class="dropbtn"><img src="../assets/img/icon-user.png" alt="Ícone de usuário" id="icon-user"></a>
                    <div class="dropdown-container">
                        <p class="id-username"><?=$row['nomeCompleto']?></p>
                        <p class="id-user-email"><?=$row['email']?></p>
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
        <!-- *não altere o valores dos atributos, pode criar classes-->
        <div id="login-box">
            <form action="../controller/auth.php" method="post" id="form-login">
                <fieldset class="campo">
                    <div class="container-controls">
                        <label for="usuario" class="etiqueta" id="label-usuario">USUÁRIO:</label>
                        <div class="icone-input">
                            <span class="material-symbols-outlined" id="icone-usuario">person</span>
                            <input type="text" name="usuario" id="usuario" size="60" minlength="2" maxlength="80" placeholder="Informe o seu nome de usuário:">
                        </div>
                    </div>
                    <div class="container-controls">
                        <label for="senha" class="etiqueta" id="label-senha">SENHA:</label>
                        <div class="icone-input">
                            <span class="material-symbols-outlined" id="icone-senha">lock</span>
                            <input type="password" name="senha" id="senha" size="60" minlength="8" maxlength="80" placeholder="Digite a sua senha corretamente:">
                        </div>
                </fieldset>
                <input type="submit" name="entrar" value="ENTRAR" id="form-button">
            </form>
        </div>
    </main>
    <footer>
    <!--front-end-->
    </footer>
</body>
</html>