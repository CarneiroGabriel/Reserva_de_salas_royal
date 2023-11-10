<?php

    $idEvento = $_GET['id'];
    
    include_once("conexao.php");
    include 'fullcalendar/events.php';

    $eventInfo = GetEventsById($idEvento);


    $result_events = "DELETE FROM events WHERE id='$idEvento'";
	
    mysqli_query($conn, $result_events);

    
    $startEvent = $eventInfo['start'];
    $end = $eventInfo['end'];
    $user = $eventInfo['user'];
    $nomeResponsavel = $eventInfo['NomeResponsavel'];
    $nome_sala = $eventInfo['sala'];
    $title =$eventInfo['title'];
    $reserva = $eventInfo['reserva'];
    // converte do formato brasileiro para o formato do banco de dados
    $start_sem_barra = explode("/", $start);
    $start_sem_barra = implode("-", $start_sem_barra);
    $start_sem_barra = strtotime($start_sem_barra);
    $start_sem_barra = date("Y-m-d H:i:s", $start_sem_barra);

    // converte do formato brasileiro para o formato do banco de dados 
    $end_sem_barra = explode("/", $end);
    $end_sem_barra = implode("-", $end_sem_barra);
    $end_sem_barra = strtotime($end_sem_barra);
    $end_sem_barra = date("Y-m-d H:i:s", $end_sem_barra);


    header("Location: fullcalendar/enviaEmail.php?salaget=$nome_sala&erro=4&title=$title&user=$user&start=$start_sem_barra&end=$end_sem_barra&reserva=$reserva&nome=$nomeResponsavel&confimarReserva=1&cancelaEvento=1");
   
    //Corrigir Horario


?>