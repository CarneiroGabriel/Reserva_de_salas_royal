<?php
    
    include "conexao.php";
    if(isset($_SESSION['log'])==false){
        echo("<script>window.location = 'login.php';</script>");
    }
     $user=$_SESSION['user'];

     $sql = "SELECT * FROM `usuarios` WHERE login = '$user'";
     $result = mysqli_query($conn, $sql);
     $userInfo = $result->fetch_assoc();
  
        function GetAdmsEmails(){
            include "conexao.php";

            $sql = "SELECT login FROM `usuarios` WHERE tipo = 'adm'";
            $result = mysqli_query($conn, $sql);
            $admsEmail = $result->fetch_assoc();
            return $admsEmail;
            
        };
?>