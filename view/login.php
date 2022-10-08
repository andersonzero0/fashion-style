<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css" type="text/css">
    <!-- <link rel="stylesheet" href="../assets/css/login-responsividade.css" type="text/css"> -->
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
                <li><a href="login.php" target="_self" rel="next" id="botao">LOGIN</a></li>
                <li><a href="cadastrar.php" target="_self" rel="next">CADASTRAR</a></li>
            </ul>
        </div>
<?php
    }else{
?>
        <!--SE JA HÁ LOGIN-->
        <div class="menu">
            <ul>
                <li><a href="meuspedidos.php" target="_self" rel="next">PEDIDOS</a></li>
                <li><a href="login.php" target="_self" rel="next" id="botao">LOGIN</a></li>
                <li><a href="cadastrar.php" target="_self" rel="next">CADASTRAR</a></li>
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
                        <input type="text" name="usuario" id="usuario" size="60" minlength="2" maxlength="80" placeholder="Informe o seu nome de usuário:">
                    </div>
                    <div class="container-controls">
                        <label for="senha" class="etiqueta" id="label-senha">SENHA:</label>
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