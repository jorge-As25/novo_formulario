<?php

    include("conexao.php");
    
    try{
        $varVerifica = $pdo->prepare("SELECT COUNT(*) FROM  login WHERE usuario = :usuario ");
        $varVerifica->bindParam(':usuario', $usuario);
        $varVerifica -> execute();

        if($varVerifica->fetchColumn() > 0){
            echo("usuario já foi cadastrado");
            exit;
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
//iniciar uma transação
        $pdo->beginTransaction();

        //cadastrar o usuario na tabela de login
        $varLogin = $pdo->prepare("INSERT INTO login (usuario, senha) VALUES 
        (:usuario, :senha");

        $varLogin->bindParam(':$usuario', $usuario);
        $varLogin->bindParam(':senha', $senha);
        $varLogin->execute();

        $id_login = $pdo->lastInsertId();

        //prociso pegar o id do meu login, para inserir na tabela do usuario, pois existe um relacionamento entre elas.

        $varUsusario = $pdo->prepare("INSERT INTO usuario (nome, email, id_login)
        VALUES (:nome, :email, :id_login)");
        $varUsusario->bindParam("id_login", $id_login);
        $varUsusario->bindParam("nome", $nome);
        $varUsusario->bindParam("email", $email);

        $pdo->commit();
        echo("cadastro realizado com sucesso!");


    } catch(PDOException $e){
        echo "ERRO AO CADASTRAR". $e->getMessage();
    }

?>
