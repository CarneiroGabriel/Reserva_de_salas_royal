<?php

$idUser = $_GET['id'];
  
include_once("conexao.php");




    $result_events = "DELETE FROM usuarios WHERE id='$idUser'";
	
    mysqli_query($conn, $result_events);


    header("Location: index.php");


?>