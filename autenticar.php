<?php
	session_start();
	include "conexao2.php";
	
	$login = $_GET['login'];
	$senha = $_GET['senha'];
	
	$consultaexiste = $conn->prepare("SELECT * FROM usuarios WHERE login = :login");
	$consultaexiste->bindParam(':login', $login);
	$consultaexiste->execute();
	
	if ($consultaexiste->rowCount() == 0) {
		echo "<script>alert('Usuário ainda não cadastrado!'); window.location = 'login.php'; </script>";
	} else {
		$consulta = $conn->prepare("SELECT * FROM usuarios WHERE login = :login AND senha = :senha");
		$consulta->bindParam(':login', $login);
		$consulta->bindParam(':senha', $senha);
		$consulta->execute();
	
		if ($consulta->rowCount() > 0) {
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
				if ($linha['tipo'] != null) {
					$_SESSION['log'] = $linha['tipo'];
					$_SESSION['user'] = $login;
					header("location:index.php");
				} else {
					echo "<script>alert('Acesso não autorizado!');</script>";
				}
			}
		} else {
			echo "<script>alert('Usuário ou senha incorreta!'); window.location = 'login.php'; </script>";
		}
	}
?>
