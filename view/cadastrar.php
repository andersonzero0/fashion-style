<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/cadastrar.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/cadastrar-responsividade.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Cadastrar - Fashion Style</title>
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
                <li class="li"><a href="login.php" target="_self" rel="next">LOGIN</a></li>
                <li class="li"><a href="cadastrar.php" target="_self" rel="next" id="botao">CADASTRAR</a></li>
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
                        <a class="auth" href="login.php">LOGIN</a>
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
        <div id="cadastro-box">
            <form action="../controller/cadastro.php" method="post" id="form-cadastro">
                <fieldset class="campo">
                    <legend>Identificação do Usuário</legend>
                    <label for="usuario_cad" id="etiqueta1">USUÁRIO:</label>
                    <div class="icone-input">
                        <span class="material-symbols-outlined" id="icone-usuario">person</span>
                        <input type="text" name="usuario_cad" id="usuario_cad" size="60" minlength="2" maxlength="80" placeholder="Informe o seu nome de usuário:" required>
                    </div>
                    <label for="senha_cad" id="etiqueta2">SENHA:</label>
                    <div class="icone-input">
                        <span class="material-symbols-outlined" id="icone-senha">lock</span>
                        <input type="password" name="senha_cad" id="senha_cad" size="60" minlength="8" maxlength="80" placeholder="Digite a sua senha corretamente:" required>
                    </div>
                    <label for="email" id="etiqueta3">E-MAIL:</label>
                    <div class="icone-input">
                        <span class="material-symbols-outlined" id="icone-senha">mail</span>
                        <input type="email" name="email" id="email" placeholder="Informe o seu endereço de e-mail:" required>
                    </div>
                    <label for="nomeCompleto" id="etiqueta4">NOME:</label>
                    <div class="icone-input">
                        <span class="material-symbols-outlined">badge</span>
                        <input type="text" name="nomeCompleto" id="nomeCompleto" size="60" minlength="4" maxlength="80" placeholder="Informe o seu nome completo:" required>
                    </div>
                </fieldset>
                <fieldset class="campo">
                    <legend>Logradouro</legend>
                    <label for="endereco" id="etiqueta5">ENDEREÇO:</label>
                    <div class="icone-input">
                        <span class="material-symbols-outlined">location_on</span>
                        <input type="text" name="endereco" id="endereco" size="60" placeholder="Rua, Avenida, Esquina, Travessa" required>
                    </div>
                </fieldset>
                <fieldset class="campo">
                    <legend>Contato</legend>
                    <label for="telefone" id="etiqueta6">TELEFONE:</label>
                    <div class="icone-input">
                        <span class="material-symbols-outlined">call</span>
                        <input type="tel" name="telefone" id="telefone" size="60" placeholder="Informe o seu número de telefone" required>
                    </div>
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