<?php
    session_start();
    unset($_SESSION['id']);
    
    if(isset($_SESSION['erro'])){
        echo "<script>alert('" . $_SESSION['erro'] . "');</script>";
        unset($_SESSION['erro']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Unilins - Cadastro</title>
</head>

<body>
    <header>
        <div id="container">
        <div style="margin-left: 10px">
            <a href="index.php">
                <img src="imagens/logo_unilins.png" alt="logo da unilins" width="150px" />
            </a>
        </div>
    </header>
    <div class="titulo">
        <h1>Cadastre-se e prepare o seu currículo</h1>
    </div>
    <div class="prime">
        <form class="auto" action="php/cadastro.php" method="POST" enctype="multipart/form-data">
            <div class="tab_left">
                <div class="bloco">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" required maxlength="100">
                </div>
                <div class="bloco">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf"required maxlength="14" onkeyup ="formatarInput()">
                </div>
                <div class="bloco">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" required maxlength="200">
                </div>
                <div class="bloco ">
                    <label for="tel">Telefone</label>
                    <input type="text" name="tel" id="tel" required maxlength="15">
                </div>
            </div>

            <div class="tab_right">
                <div class="bloco">
                    <label for="email">Email</label>
                    <input type="text" name="email" required maxlength="100">
                </div>
                <div class="bloco">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" required maxlength="60">
                </div>
                <div class="bloco">
                    <label>Foto</label>
                    <input type="file" name="foto" required>
                </div>
                <button>Cadastre-se</button>
            </div>
        </form>
    </div>
    <footer>
        <img src="imagens/footer_unilins.png">
      </footer>
</div>
<script src="js/cadastro.js"></script>
</body>

</html>