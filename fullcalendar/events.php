<?php
    
    if(isset($_SESSION['log'])==false){
        echo("<script>window.location = 'login.php';</script>");
    }

    function GetEventsById($id){
        include "conexao.php";

        $sql = "SELECT * FROM `events` WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $eventInfo = $result->fetch_assoc();
        return $eventInfo;
        
    };
     
  
?>