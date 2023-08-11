<?php
    require_once 'conexao.php';
    require_once 'funcoes.php';

    session_start();

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['tel'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $arquivo = $_FILES['foto']['tmp_name'];
    $arquivo_tipo = $_FILES['foto']['type'];

    $foto = addslashes(file_get_contents($arquivo));
    $cpf_formatado = formatarCPF($cpf);
    $senha_crip = password_hash($senha, PASSWORD_DEFAULT);
    
    if($cpf_formatado != false){
        if(verificar($cpf_formatado)){
            if(verificar($email)){
                $foto_valida = verificar_foto($arquivo_tipo);
                if($foto_valida){
                    $query = "INSERT INTO usuario(nome, cpf, endereco, email, senha, telefone, foto, foto_tipo)
                              VALUES('$nome', '$cpf_formatado', '$endereco', '$email', '$senha_crip', '$telefone', '$foto', '$arquivo_tipo')";
                    $resultado = $conexao->query($query);
                    if($resultado == false){
                        $_SESSION['erro'] = "Erro ao inserir dados.";
                        header("location: ../cadastro.php");
                    }
                    else{
                        $query = "SELECT id 
                                  FROM usuario
                                  WHERE cpf = '$cpf_formatado'";
                        $id = $conexao->query($query)->fetch();
                        $_SESSION['id'] = $id['id'];
                        header("location: ../editar_usuario_formatado.php");
                    } 
                }
                else{
                    $_SESSION['erro'] = "Formato de foto inválido.";
                    header("location: ../cadastro.php");
                }
            }
            else{
                $_SESSION['erro'] = "Email já cadastrado.";
                header("location: ../cadastro.php");
            }
        }
        else{
            $_SESSION['erro'] = "CPF já cadastrado.";
            header("location: ../cadastro.php");
        }
    }
    else{
        $_SESSION['erro'] = "CPF inválido.";
        header("location: ../cadastro.php");
    }

    $conexao = null;
?>