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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Unilins - Login</title>
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <div id="container">
      <header>
        <div style="margin-left: 10px">
          <a href="index.php">
            <img
              src="imagens/logo_unilins.png"
              alt="logo da unilins"
              width="150px"
            />
          </a>
        </div>
      </header>
      <main id="login">
        
        <form action="php/login.php" id="form_login" method="POST">
          <div class="title">
            Central de Currículos - FPTE
          </div>
          <label for="email_id">ID / LOGIN</label>
            <input type="text" id="email_id" name="email_id" placeholder="Digite seu ID ou Email aqui" maxLength="100" required>
            <label for="senha_aluno">SENHA</label>
            <input type="password" name="senha_aluno" id="senha_aluno" placeholder="Digite sua senha aqui" maxLength="60" required>
            <button id="btn_login">Entrar</button>

            <p>Centro de Informações da FPTE - C.I</p>
        </form>
      </main>
      <footer>
        <img src="imagens/footer_unilins.png">
      </footer>
    </div>
  </body>
</html>
