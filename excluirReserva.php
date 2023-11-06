<?php

$idEvento = $_GET['id'];
  
include_once("conexao.php");




    $result_events = "DELETE FROM events WHERE id='$idEvento'";
	
    mysqli_query($conn, $result_events);


    header("Location: index.php");


?>