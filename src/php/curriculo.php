<?php
    require_once 'conexao.php';

    session_start();

    @$opcao = intval($_POST['opcao']);
    if(isset($_SESSION['deletar'])){
        $opcao = 1;
        unset($_SESSION['deletar']);
    }
    $id = $_SESSION['id'];
    if($opcao === 0){
        $telefone = $_POST['telefone'];
        $area = $_POST['area'];
        $vaga = $_POST['tipo_vaga'];
        $disponi = $_POST['disponibilidade'];
        $periodo = $_POST['periodo'];
        $insti = $_POST['instituicao'];
        $curso = $_POST['curso'];
        $ini_curso = $_POST['inicio_curso'];
        $fim_curso = $_POST['fim_curso'];
        
        if(isset($_POST['qualificacoes'])){
            $quali = $_POST['qualificacoes'];
        }
        else{
            $quali = null;
        }
    
        if(isset($_POST['empresa'])){
            $empresa = $_POST['empresa'];
        }
        else{
            $empresa = null;
        }
    
        if(isset($_POST['cargo'])){
            $cargo = $_POST['cargo'];
        }
        else{
            $cargo = null;
        }
    
        if(isset($_POST['inicio_empresa']) and $_POST['inicio_empresa'] != null){
            $ini_emp = $_POST['inicio_empresa'];
            $ini_emp = date('Y-m-d', strtotime($ini_emp));
        }
        else{
            $ini_emp = null;
        }
    
        if(isset($_POST['fim_empresa']) and $_POST['fim_empresa'] != null){
            $fim_emp = $_POST['fim_empresa'];
            $fim_emp = date('Y-m-d', strtotime($fim_emp));
        }
        else{
            $fim_emp = null;
        }
    
        $ini_curso = date('Y-m-d', strtotime($ini_curso));
        $fim_curso = date('Y-m-d', strtotime($fim_curso));
    
        $disponi = implode(',', $disponi);
    
        $query = "UPDATE usuario
                  SET telefone = '$telefone'
                  WHERE id = '$id'";
        $resultado = $conexao->query($query);

        $query = "UPDATE curriculo
                  SET area = '$area', vaga = '$vaga', disponibilidade = '$disponi', periodo = '$periodo', instituicao = '$insti', curso = '$curso', inicio_curso = '$ini_curso', fim_curso = '$fim_curso', qualificacao = '$quali', empresa = '$empresa', cargo = '$cargo', inicio_empresa = '$ini_emp', fim_empresa = '$fim_emp', preenchido = 1
                  WHERE id = '$id'";
        $resultado = $conexao->query($query);

        $conexao = null;
        header("location: ../editar_usuario_formatado.php");
    }
    elseif($opcao === 1){
        $query = "UPDATE usuario
                  SET telefone = null
                  WHERE id = '$id'";
        $resultado = $conexao->query($query);

        $query = "UPDATE curriculo
                  SET area = null, vaga = null, disponibilidade = null, periodo = null, instituicao = null, curso = null, inicio_curso = null, fim_curso = null, qualificacao = null, empresa = null, cargo = null, inicio_empresa = null, fim_empresa = null, preenchido = 0
                  WHERE id = '$id'";
        $resultado = $conexao->query($query);

        $conexao = null;
        header("location: ../editar_usuario_formatado.php");
    }
    else{
        $_SESSION['erro'] = "Erro desconhecido. Tente novamente.";
        $conexao = null;
        header("location: ../login.php");
    }
?>