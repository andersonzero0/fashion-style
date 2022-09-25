<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fashion Style</title>
</head>
<body>
    <header>
    <!--front-end-->
    </header>

    <main>
        <!-- *não altere o valores dos atributos, pode criar classes-->
        <div id="login-box">
            <form action="../controller/auth.php" method="post" id="login-box">

                <label for="usuario">USUÁRIO:</label>
                <input type="text" name="usuario" id="usuario">

                <label for="senha">SENHA:</label>
                <input type="password" name="senha" id="senha">

                <input type="submit" value="ENTRAR">
                
            </form>
        </div>
    </main>

    <footer>
    <!--front-end-->
    </footer>
</body>
</html>