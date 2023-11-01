<?php
    
    include "conexao2.php";
    include "conexao.php";

    if(isset($_SESSION['log'])==false){
        echo("<script>window.location = 'login.php';</script>");
    }

    $nSala =  isset( $_GET['salaget']) ? $_GET['erro'] : $nSala;

     $sql = "SELECT * FROM `salas` WHERE valor = '$nSala'";
     $result = mysqli_query($conn, $sql);
     $salaInfo = $result->fetch_assoc();
  
?>