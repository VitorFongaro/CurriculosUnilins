<?php
  require_once 'php/conexao.php';
  session_start();

  $id = $_SESSION['id'];
  $opcao = intval($_POST['opcao']);

  $query = "SELECT usuario.*, curriculo.preenchido AS preenchido
            FROM usuario 
            JOIN curriculo ON usuario.id = curriculo.id
            WHERE usuario.id = '$id'";
  $resultado = $conexao->query($query)->fetch();

  $imagem = base64_encode($resultado['foto']);
  $imagem_tipo = $resultado['foto_tipo'];

  if($opcao === 1){
    $_SESSION['deletar'] = 1;
    $conexao = null;
    header("location: php/curriculo.php");
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar currículo</title>
    <link rel="stylesheet" href="css/editar.css" />
    <script>
      function validarCheckbox(event){
        event.preventDefault();
  
        const checkboxes = document.querySelectorAll('input[name="disponibilidade[]"]:checked');

        if(checkboxes.length == 0){
          alert('Selecione pelo menos uma opção para Disponibilidade.');
          return false;
        }
        event.target.closest('form').submit();
      }
    </script>
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
        <form action="php/curriculo.php" method="POST">
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
            <input type="text" id="telefone" value="<?php echo $resultado['telefone'];?>" name="telefone" maxlength="15" required/>
          </div>
          <?php 
            $query = "SELECT * 
                      FROM curriculo
                      WHERE id = '$id'";
            $resultado = $conexao->query($query)->fetch();  
          ?>
            <div class="campos opcoes">
                <h2>Possibilidades na área de: &nbsp;</h2>
                <select name="area" id="curso" required>
                  <option disabled selected>SELECIONE...</option>
                  <option value="Engenharia de Software" <?php if($resultado['area'] == "Engenharia de Software") echo 'selected';?>>Engenharia de Software</option>
                  <option value="Engenharia de Computação" <?php if($resultado['area'] == "Engenharia de Computação") echo 'selected';?>>Engenharia de Computação</option>
                  <option value="Engenharia Ambiental e Sanitária" <?php if($resultado['area'] == "Engenharia Ambiental e Sanitária") echo 'selected';?>>Engenharia Ambiental e Sanitária</option>
                  <option value="Engenharia Civil" <?php if($resultado['area'] == "Engenharia Civil") echo 'selected';?>>Engenharia Civil</option>
                  <option value="Engenharia Mecânica" <?php if($resultado['area'] == "Engenharia Mecânica") echo 'selected';?>>Engenharia Mecânica</option>
                  <option value="Engenharia Elétrica" <?php if($resultado['area'] == "Engenharia Elétrica") echo 'selected';?>>Engenharia Elétrica</option>
                  <option value="Arquitetura e Urbanismo" <?php if($resultado['area'] == "Arquitetura e Urbanismo") echo 'selected';?>>Arquitetura e Urbanismo</option>
                  <option value="Administração" <?php if($resultado['area'] == "Administração") echo 'selected';?>>Administração</option>
                  <option value="Enfermagem" <?php if($resultado['area'] == "Enfermagem") echo 'selected';?>>Enfermagem</option>
                  <option value="Farmácia" <?php if($resultado['area'] == "Farmácia") echo 'selected';?>>Farmácia</option>
                  <option value="Processos Gerenciais" <?php if($resultado['area'] == "Processos Gerenciais") echo 'selected';?>>Processos Gerenciais</option>
                  <option value="Serviço Social" <?php if($resultado['area'] == "Serviço Social") echo 'selected';?>>Serviço Social</option>
                </select>
            </div>
            <div class="campos check">
              <h2>Tipo de vaga:</h2>
              <input type="radio" name="tipo_vaga" id="estagio" value="Estágio" <?php if($resultado['vaga'] == "Estágio") echo 'checked';?> required>
              <label for="estagio"style="font-size: 20px";>Estágio</label>
              <input type="radio" name="tipo_vaga" id="clt" value="CLT" <?php if($resultado['vaga'] == "CLT") echo 'checked';?> required>
              <label for="clt" style="font-size: 20px";>CLT</label>
              <input type="radio" name="tipo_vaga" id="pj" value="PJ" <?php if($resultado['vaga'] == "PJ") echo 'checked';?> required>
              <label for="pj" style="font-size: 20px";>PJ</label>
            </div>
            <div class="campos check">
              <h2>Disponibilidade:</h2>
              <?php
                $opcoes =  explode(",", $resultado['disponibilidade']);
              ?>
              <input type="checkbox" name="disponibilidade[]" id="ferias" value="Férias" <?php if(in_array("Férias", $opcoes)) echo 'checked';?>>
              <label for="ferias"style="font-size: 20px";>Férias</label>
              <input type="checkbox" name="disponibilidade[]" id="integral" value="Integral" <?php if(in_array("Integral", $opcoes)) echo 'checked';?>>
              <label for="integral" style="font-size: 20px";>Integral</label>
            </div>
            <div class="campos check">
              <h2>Período:</h2>
              <input type="radio" name="periodo" id="matutino" value="Matutino" <?php if($resultado['periodo'] == "Matutino") echo 'checked';?> required>
              <label for="matutino"style="font-size: 20px";>Matutino</label>
              <input type="radio" name="periodo" id="vespertino" value="Vespertino" <?php if($resultado['periodo'] == "Vespertino") echo 'checked';?> required>
              <label for="vespertino" style="font-size: 20px";>Vespertino</label>
              <input type="radio" name="periodo" id="noturno" value="Noturno" <?php if($resultado['periodo'] == "Noturno") echo 'checked';?> required>
              <label for="integral" style="font-size: 20px";>Noturno</label>
              <input type="radio" name="periodo" id="integral" value="Integral" <?php if($resultado['periodo'] == "Integral") echo 'checked';?> required>
              <label for="integral" style="font-size: 20px";>Integral</label>
            </div>
            <div class="campos formacao">
              <h2>Formação Acadêmica</h2>
              <label for="nome_curso">Nome do curso: &nbsp;
              <input type="text" id="nome_curso" name="curso" value="<?php echo $resultado['curso'];?>" required></label>
              <label for="instituicao_curso">Nome da Instituição: &nbsp;
              <input type="text" id="instituicao_curso" name="instituicao" value="<?php echo $resultado['instituicao'];?>" required></label> 
              <label class="lb_date" for="inicio_termino_curso">Início/termino do curso: &nbsp;
              <input type="date" id="inicio_termino_curso" name="inicio_curso" class="inicio_formacao" value="<?php if($resultado['inicio_curso'] != null) echo $resultado['inicio_curso'];?>" required>
              <input type="date" id="inicio_termino_curso" name="fim_curso" class="inicio_formacao" value="<?php if($resultado['fim_curso'] != null) echo $resultado['fim_curso'];?>" required></label>
            </div>
            <div class="campos experiencia">
              <h2>Experiência Profissional</h2>
              <label for="nome_empresa_trabalhada">Nome da empresa: &nbsp;
              <input type="text" id="nome_empresa_trabalhada" name="empresa" value="<?php echo $resultado['empresa'];?>"></label>
              <label for="nome_cargo_trabalhada">Nome do cargo exercido: &nbsp;
              <input type="text" id="nome_cargo_trabalhada" name="cargo" value="<?php echo $resultado['cargo'];?>"></label>
              <label class="lb_date" for="inicio_termino_trabalhado_empresa">Início/termino do cargo: &nbsp;
              <input type="date" id="inicio_termino_trabalhado_empresa" name="inicio_empresa" class="inicio_empresa" value="<?php if($resultado['inicio_empresa'] != null) echo $resultado['inicio_empresa'];?>">
              <input type="date" id="inicio_termino_trabalhado_empresa" name="fim_empresa" class="termino_empresa" value="<?php if($resultado['inicio_empresa'] != null) echo $resultado['inicio_empresa'];?>"></label>
            </div>
            <div class="campos qualificacoes">
              <h2>Qualificações Técnicas: &nbsp;</h2>
              <textarea name="qualificacoes" id="qualificacoes" cols="30" rows="5" maxlength="400"><?php echo $resultado['qualificacao'];?></textarea>
            </div>
          </div>

          
          </div>
          <div class="btn_edit">
            <button class="btn_save" name="opcao" onclick="validarCheckbox(event)" value="0">SALVAR</button>
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