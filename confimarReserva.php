<?php
///update no evento


$idEvento = $_GET['id'];
  
include_once("conexao.php");




    $result_events = "UPDATE events SET reserva=0, color='#5cb85c' WHERE id='$idEvento'";
	
    mysqli_query($conn, $result_events);


    header("Location: index.php");





?>