<?php
  require_once 'php/conexao.php';
  session_start();

  $id = $_SESSION['id'];

  $query = "SELECT usuario.*, curriculo.preenchido AS preenchido
            FROM usuario 
            JOIN curriculo ON usuario.id = curriculo.id
            WHERE usuario.id = '$id'";
  $resultado = $conexao->query($query)->fetch();

  $imagem = base64_encode($resultado['foto']);
  $imagem_tipo = $resultado['foto_tipo'];
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar currículo</title>
    <link rel="stylesheet" href="css/editar.css" />
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
      <main>
        <form action="editar_usuario.php" method="POST">
          <nav class="nav options">
            <?php 
              if($resultado['preenchido'] == 0){
                echo '<button class="btn_options" name="opcao" value="0">Inserir currículo</button>';
              }
              else{
                echo '<button class="btn_options" name="opcao" value="0">Editar currículo</button>';
              }
            ?>
            <button class="btn_options" name="opcao" value="1">Excluir currículo</button>
          </nav>
          <div class="curriculo">
            <div class="tab_left">
              <div class="campos img_usuario">
                <h2>Foto do currículo: &nbsp;</h2>
                  <img src=<?php echo '"data:' . $imagem_tipo . ';base64,' . $imagem . '"';?> id="foto_curriculo" alt="Foto_currículo">
              </div>
            <div class="campos">
              <h2>ID: &nbsp;</h2>
              <h2 class="aluno"><?php echo $resultado['id'];?></h2>
            </div>
            <div class="campos">
              <h2>Nome: &nbsp;</h2>
              <h2 class="aluno"><?php echo $resultado['nome'];?></h2>
            </div>
            <div class="campos">
              <h2>CPF: &nbsp;</h2>
              <h2 class="aluno"><?php echo $resultado['cpf'];?></h2>
            </div>
            <div class="campos">
              <h2>Endereço: &nbsp;</h2>
              <h2 class="aluno"><?php echo $resultado['endereco'];?></h2>
            </div>
            
            <div class="campos">
              <h2>Email: &nbsp;</h2>
              <h2 class="aluno"><?php echo $resultado['email'];?></h2>
            </div>
          </div> 
          <div class="tab_right">
          <div class="campos">
            <h2>Telefone de Contato: &nbsp;</h2>
            <h2><?php echo $resultado['telefone'];?></h2>
          </div>
          <?php 
            $query = "SELECT * 
                      FROM curriculo
                      WHERE id = '$id'";
            $resultado = $conexao->query($query)->fetch();  
          ?>
            <div class="campos opcoes">
                <h2>Possibilidades na área de: &nbsp;</h2>
                <h2><?php echo $resultado['area'];?></h2>
            </div>
            <div class="campos check">
              <h2>Tipo de vaga:</h2>
              <h2><?php echo $resultado['vaga'];?></h2>
            </div>
            <div class="campos check">
              <h2>Disponibilidade:</h2>
              <h2><?php echo $resultado['disponibilidade'];?></h2>
            </div>
            <div class="campos check">
              <h2>Período:</h2>
              <h2><?php echo $resultado['periodo'];?></h2>
            </div>
            <div class="campos formacao">
              <h2>Formação Acadêmica</h2>
              <label for="nome_curso">Nome do curso: &nbsp;
              <p><?php echo $resultado['curso'];?></p></label>
              <label for="instituicao_curso">Nome da Instituição: &nbsp;
              <p><?php echo $resultado['instituicao'];?></p></label>
              <label class="lb_date" for="inicio_termino_curso">Início/termino do curso: &nbsp;
              <p><?php 
                    if($resultado['inicio_curso'] != null){
                      echo date('d-m-Y', strtotime($resultado['inicio_curso']));
                    }
                  ?>
              </p>
              <p>/</p>
              <p><?php 
                    if($resultado['fim_curso'] != null){
                      echo date('d-m-Y', strtotime($resultado['fim_curso']));
                    }
                  ?></p></label>
            </div>
            <div class="campos experiencia">
              <h2>Experiência Profissional</h2>
              <label for="nome_empresa_trabalhada">Nome da empresa: &nbsp;
              <p><?php echo $resultado['empresa'];?></p></label>
              <label for="nome_cargo_trabalhada">Nome do cargo exercido: &nbsp;
              <p><?php echo $resultado['cargo'];?></p></label>
              <label class="lb_date" for="inicio_termino_trabalhado_empresa">Início/termino do cargo: &nbsp;
                <p><?php 
                    if($resultado['inicio_empresa'] != null and $resultado['inicio_empresa'] != "0000-00-00"){
                      echo date('d-m-Y', strtotime($resultado['inicio_empresa']));
                    }
                   ?></p>
                <p>/</p>
                <p><?php 
                    if($resultado['fim_empresa'] != null and $resultado['fim_empresa'] != "0000-00-00"){
                      echo date('d-m-Y', strtotime($resultado['fim_empresa']));
                    }
                   ?></p></label>
            </div>
            <div class="campos qualificacoes">
              <h2>Qualificações Técnicas: &nbsp;</h2>
              <p><?php echo $resultado['qualificacao'];?></p></textarea>
            </div>
          </div>
          </div>
        </form>
      </main>
    </div>
    <script src="js/editar.js"></script>
  </body>
</html>
<?php 
  $conexao = null;
?>