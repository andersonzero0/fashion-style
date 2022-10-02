<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css" type="text/css">
    <title>Login - Fashion Style</title>
</head>
<body>
    <nav class="nav-bar">
        <div class="logo">
            <a href="../index.php" target="_self" rel="next">Fashion Style</a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#" target="_self" rel="next">PEDIDOS</a></li>
                <li><a href="login.php" target="_self" rel="next" id="botao">LOGIN</a></li>
                <li><a href="cadastrar.php" target="_self" rel="next">CADASTRAR</a></li>
                <li><a href="#" target="_self" rel="next">CONTATO</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <!-- *não altere o valores dos atributos, pode criar classes-->
        <div id="login-box">
            <form action="../controller/auth.php" method="post" id="form-login">
                <fieldset class="campo">
                    <label for="usuario" id="etiqueta1">USUÁRIO:</label>
                    <input type="text" name="usuario" id="usuario" size="60" minlength="2" maxlength="80" placeholder="Informe o seu nome de usuário:">
                    <label for="senha" id="etiqueta2">SENHA:</label>
                    <input type="password" name="senha" id="senha" size="60" minlength="8" maxlength="80" placeholder="Digite a sua senha corretamente:">
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