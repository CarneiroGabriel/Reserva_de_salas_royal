<?php
    session_start();
    include "conexao2.php";
    include "conexao.php";
    if(isset($_SESSION['log'])==false){
        echo("<script>window.location = 'login.php';</script>");
    }
     $user=$_SESSION['user'];

     $sql = "SELECT * FROM `usuarios` WHERE login = '$user'";
     $result = mysqli_query($conn, $sql);
     $userInfo = $result->fetch_assoc();

    echo "id: " . $userInfo["id"]. " - Name: " . $userInfo["login"]. " " . $userInfo["nome"]." " . $userInfo["tipo"]. "<br>";
  
?>