<?php

$idUser = $_GET['id'];
  
include_once("conexao.php");




    $result_events = "UPDATE usuarios SET tipo='adm' WHERE id='$idUser'";
	
    mysqli_query($conn, $result_events);


    header("Location: index.php");


?>