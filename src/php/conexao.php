<?php
    try{
        $conexao = new PDO("mysql:host=localhost; dbname=unilins", "root", "");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("Falha na conexão: " . $e->getMessage());
    }
?>