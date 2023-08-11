<?php
  require_once 'php/conexao.php';

  session_start();

  if(isset($_SESSION['id'])){
    unset($_SESSION['id']);
  }

  $query = "SELECT usuario.id, usuario.nome, curriculo.area, curriculo.vaga, curriculo.preenchido
            FROM usuario
            JOIN curriculo ON usuario.id = curriculo.id
            WHERE curriculo.preenchido = 1";
  $resultado = $conexao->query($query)->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/index.css" />
    <title>Unilins - Currículos</title>
  </head>
  <body>
    <div id="container">
      <header>
        <div style="margin-left: 10px">
          <a href="#">
            <img
              src="imagens/logo_unilins.png"
              alt="logo da unilins"
              width="150px"
            />
          </a>
        </div>
        <div class="lg-cd">
          <div id="entrar"><a href="login.php">Entrar</a></div>
          <div id="cadastro"><a href="cadastro.php">Cadastrar-se</a></div>
        </div>
      </header>
      <main id="tabela">
        <table width="auto">
          <thead>
            <td><strong>Nome</strong></td>
            <td><strong>Curso</strong></td>
            <td><strong>Tipo de Vaga</strong></td>
            <td class="curriculo"><strong>Curriculum Vitae</strong></td>
          </thead>
          <tbody>
            <?php 
              foreach($resultado as $linha){    
                echo '<tr>';
                echo '<td>' . $linha['nome'] . '</td>';
                echo '<td>' . $linha['area'] . '</td>';
                echo '<td>' . $linha['vaga'] . '</td>';
                echo '<td><a href="VisualizaCurriculum.php?id=' . $linha['id'] . '">Acessar currículo</a></td>';
                echo '</tr>';
              }
            ?>
          </tbody>
        </table>
      </main>
    </div>
  </body>
</html>
<?php
  $conexao = null;
?>