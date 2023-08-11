<?php
    require_once 'php/conexao.php';

    $id = $_GET['id'];
    $query = "SELECT nome, cpf, endereco, email, telefone, foto, foto_tipo
              FROM usuario
              WHERE id = '$id'";
    $resultado = $conexao->query($query)->fetch();

    $imagem = base64_encode($resultado['foto']);
    $imagem_tipo = $resultado['foto_tipo'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>Unilins - Banco de Currículos</title>
    <link rel="stylesheet" href="css/Visualiza.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>
    
<body>
    <div id="container"></div>
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
    <div id="pessoais">
    <div> <h1>Informações Pessoais</h1></div>
    <div class="pessoais_foto">    
    <div class="Pessoais">
            <p>Nome: <?php echo $resultado['nome'];?></p>
            <p>CPF: <?php echo $resultado['cpf'];?></p>
            <p>Endereço: <?php echo $resultado['endereco'];?></p>
            <p>Telefone: <?php echo $resultado['telefone'];?></p>
            <p>Email: <?php echo $resultado['email'];?></p>
        </div>
        <div class="Foto">
            <img src=<?php echo '"data:' . $imagem_tipo . ';base64,' . $imagem . '"';?> id="foto_curriculo" alt="Foto_currículo">
        </div>
    </div>
    </div>
    <?php 
        $query = "SELECT * 
                  FROM curriculo
                  WHERE id = '$id'";
        $resultado = $conexao->query($query)->fetch();
    ?>
    <div id="objetivos">
    <div><h3>Objetivos</h3></div>
        <div class="Objetivos">
            <p>Tipo de Contrato: <?php echo $resultado['vaga'];?></p>
            <p>Disponibilidade: <?php echo $resultado['disponibilidade'];?></p>
            <p>Período: <?php echo $resultado['periodo'];?></p>
        </div>    
    </div>
    <div id="formacao_academia">
    <div><h2>Formação Acadêmica</h2></div>
        <div class="Formacao">
                <p>Instituição de Ensino: <?php echo $resultado['instituicao'];?></p>
                <p>Curso: <?php echo $resultado['curso'];?></p>
                <p>Período: <?php if($resultado['inicio_curso'] != null) echo date('Y',strtotime($resultado['inicio_curso']));?> - <?php if($resultado['fim_curso'] != null) echo date('Y',strtotime($resultado['fim_curso']));?></p>
        </div>
    </div>
    <div id="qualificacoes_tecnicas">
    <div><h4>Qualificações Técnicas</h4></div>
        <div class="Qualificacoes">
                <p><?php echo $resultado['qualificacao'];?></p>
    </div>
</div>
    <div id="experiencia">
    <div><h6>Experiências Profissionais</h6></div>
        <div class="Profissionais">
                <p>Empresa: <?php echo $resultado['empresa'];?></p>
                <p>Período: <?php if($resultado['inicio_empresa'] != null and $resultado['inicio_empresa'] != "0000-00-00") echo date('Y',strtotime($resultado['inicio_empresa'])) . ' - ';?><?php if($resultado['fim_empresa'] != null and $resultado['inicio_empresa'] != "0000-00-00") echo date('Y',strtotime($resultado['fim_empresa']));?></p>
                <p>Cargo: <?php echo $resultado['cargo'];?></p>
    </div>
</div>
<footer class="primary-footer container group">
    <small>&copy; Unilins - Banco de Currículos</small>
    <nav class="nav">
        <a href="https://unilins.edu.br/">Página Inicial Unilins</a> &nbsp;|&nbsp; 
        <a href="index.php">Central de Currículos</a>
    </nav>
</footer>
</div>
</body>
    
</html>
<?php
    $conexao = null;
?>