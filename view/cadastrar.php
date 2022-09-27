<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar - Fashion Style</title>
</head>
<body>
    <header>
    <!--front-end-->
    </header>

    <main>
        <!-- *não altere o valores dos atributos, pode criar classes-->
        <div id="cadastro-box">
            <form action="../controller/cadastro.php" method="post" id="form-cadastro">

                <label for="usuario_cad">USUÁRIO:</label>
                <input type="text" name="usuario_cad" id="usuario_cad">

                <label for="senha_cad">SENHA:</label>
                <input type="password" name="senha_cad" id="senha_cad">

                <input type="submit" name="entrar" value="CADASTRAR">

            </form>
        </div>
    </main>

    <footer>
    <!--front-end-->
    </footer>
</body>
</html>