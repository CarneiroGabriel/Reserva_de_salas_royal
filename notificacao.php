<?php

function GetNotifications() {
    include "conexao2.php";

    $query = "SELECT * FROM events WHERE reserva = 1";
    $smpt = $conn->prepare($query);
    $smpt->execute();
    $eventos = $smpt->fetchAll(PDO::FETCH_ASSOC);
    return count( $eventos );
}

function notificacaoAparece( $notificacao ) {
    if ( $notificacao > 0) {
        $alerta = "<span class='badge'>$notificacao </span>";  
    }else { 
        $alerta = "";
    }
    return $alerta;
}




?>