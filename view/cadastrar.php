<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/cadastrar.css" type="text/css">
    <title>Cadastrar - Fashion Style</title>
</head>
<body>
    <nav class="nav-bar">
        <div class="logo">
            <a href="../index.php" target="_self" rel="next">Fashion Style</a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="login.php" target="_self" rel="next">LOGIN</a></li>
                <li><a href="cadastrar.php" target="_self" rel="next" id="botao">CADASTRAR</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div id="cadastro-box">
            <form action="../controller/cadastro.php" method="post" id="form-cadastro">
                <fieldset class="campo">
                    <legend>Identificação do Usuário</legend>
                    <label for="usuario_cad" id="etiqueta1">USUÁRIO:</label>
                    <input type="text" name="usuario_cad" id="usuario_cad" size="60" minlength="2" maxlength="80" placeholder="Informe o seu nome de usuário:" required>
                    <label for="senha_cad" id="etiqueta2">SENHA:</label>
                    <input type="password" name="senha_cad" id="senha_cad" size="60" minlength="8" maxlength="80" placeholder="Digite a sua senha corretamente:" required>
                    <label for="email" id="etiqueta3">E-MAIL:</label>
                    <input type="email" name="email" id="email" placeholder="Informe o seu endereço de e-mail:" required>
                    <label for="nomeCompleto" id="etiqueta4">NOME:</label>
                    <input type="text" name="nomeCompleto" id="nomeCompleto" size="60" minlength="4" maxlength="80" placeholder="Informe o seu nome completo:" required>
                </fieldset>
                <fieldset class="campo">
                    <legend>Logradouro</legend>
                    <label for="endereco" id="etiqueta5">ENDEREÇO:</label>
                    <input type="text" name="endereco" id="endereco" size="60" placeholder="Rua, Avenida, Esquina, Travessa" required>
                </fieldset>
                <fieldset class="campo">
                    <legend>Contato</legend>
                    <label for="telefone" id="etiqueta6">TELEFONE:</label>
                    <input type="tel" name="telefone" id="telefone" size="60" placeholder="Informe o seu número de telefone" required>
                </fieldset>
                <input type="submit" name="entrar" value="CADASTRAR" id="form-button">
            </form>
        </div>
    </main>
    <footer>
    <!--front-end-->
    </footer>
</body>
</html>