<?php
///update no evento


    $idEvento = $_GET['id'];
    
    include_once("conexao.php");
    include 'fullcalendar/events.php';




    $result_events = "UPDATE events SET reserva=0, color='#5cb85c' WHERE id='$idEvento'";
	
    mysqli_query($conn, $result_events);

    $eventInfo = GetEventsById($idEvento);
    $startEvent = $eventInfo['start'];
    $end = $eventInfo['end'];
    $user = $eventInfo['user'];
    $nomeResponsavel = $eventInfo['NomeResponsavel'];
    $nome_sala = $eventInfo['sala'];
    $title =$eventInfo['title'];
    $reserva = $eventInfo['reserva'];

    /*$startEvent = date_format($startEvent,'Y-m-d H:i');
    $end = date_format($end,'Y-m-d H:i');*/



    header("Location: fullcalendar/enviaEmail.php?salaget=$nome_sala&erro=4&title=$title&user=$user&start=$startEvent&end=$end&reserva=$reserva&nome=$nomeResponsavel&confimarReserva=1");


    //Corrigir Horario



?>