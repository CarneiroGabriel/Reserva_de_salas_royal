<?php
session_start();
include "conexao2.php";

    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    $nome = $_POST['nome'];

    

    if(strpos($login, "@royalcargo.com.br") == false) {
        echo "<script>alert('Por favor Insira o Email da Organização'); window.location = 'singup.php';</script>";
        header('Location: singup.php');
        return 0;
       }

    if($senha != $senha2) {
        echo "<script>alert('Senha não está igual '); window.location = 'singup.php';</script>";
        return 0;
    }

    if(strlen($senha) < 4){
        echo "<script>alert('Senha ter mais que 4 caracteres'); window.location = 'singup.php';</script>";
        return 0;
    }

    // Verifique se o nome de usuário já existe
    $consultaexiste = $conn->prepare("SELECT * FROM usuarios WHERE login = :login");
    $consultaexiste->bindParam(':login', $login);
    $consultaexiste->execute();

    if ($consultaexiste->rowCount() > 0) {
        echo "<script>alert('Já existe uma conta neste Email'); window.location = 'singup.php';</script>";
    } else {
        // Insira o novo usuário no banco de dados
        $inserir = $conn->prepare("INSERT INTO usuarios (login, senha, nome, tipo) VALUES (:login, :senha, :nome, 'user')");
        $inserir->bindParam(':login', $login);
        $inserir->bindParam(':senha', $senha);
        $inserir->bindParam(':nome', $nome);
        

        if ($inserir->execute()) {
            echo "<script>alert('Conta criada com sucesso! Faça o login.'); window.location = 'login.php';</script>";
        } else {
            echo "<script>alert('Erro ao criar a conta. Tente novamente.'); window.location = 'singup.php';</script>";
        }
    }
    

?>