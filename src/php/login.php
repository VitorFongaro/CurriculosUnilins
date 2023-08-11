<?php
    require_once 'conexao.php';

    session_start();

    $usuario = $_POST['email_id'];
    $senha = $_POST['senha_aluno'];

    $query = "SELECT * 
              FROM usuario 
              WHERE id = '$usuario' OR email = '$usuario'";
    $resultado = $conexao->query($query)->fetch();

    if($resultado){
        if(password_verify($senha, $resultado['senha'])){
            $_SESSION['id'] = $resultado['id'];
            header("location: ../editar_usuario_formatado.php");
        }
        else{
            $_SESSION['erro'] = "Senha incorreta.";
            header("location: ../login.php");
        }
    }
    else{
        $_SESSION['erro'] = "Usuário não encontrado.";
        header("location: ../login.php");
    }

    $conexao = null;
?>