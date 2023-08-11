<?php
    require_once 'conexao.php';

    function verificar($valor){
        global $conexao;
        $query = "SELECT nome 
                  FROM usuario 
                  WHERE cpf = '$valor' OR email = '$valor'";
        $resultado = $conexao->query($query)->fetch();
        if($resultado == false){
            return true;
        }
        else{
            return false;
        }
        $conexao = null;
    }

    function formatarCPF($cpf){
        $cpf = preg_replace('/[^0-9]/', '', $cpf); // Remover caracteres não numéricos
    
        if (strlen($cpf) != 11) { // Verificar se o CPF possui 11 dígitos
            return false;
        }
       
        $cpfFormatado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);  // Formatar o CPF com pontuação
        return $cpfFormatado;
    }

    function verificar_foto($arquivo){
        $tipos = array("image/jpg", "image/png", "image/jpeg");
        if(in_array($arquivo, $tipos)){
            return true;
        }
        else{
            return false;
        }
    }
?>