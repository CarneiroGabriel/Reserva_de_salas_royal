<?php

include "../PHPMailer/src/PHPMailer.php";
include "../PHPMailer/src/Exception.php";
include "../PHPMailer/src/SMTP.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
include 'conexao2.php';
$sala = $_GET['salaget'];
$user = $_GET['user'];
$reserva = $_GET['reserva']; // Logica da mensagem enviada 
$titulo = $_GET['title'];
$erroAviso = $_GET['erro'];
$start = $_GET['start'];
$end = $_GET['end'];
$nome = $_GET['nome'];
$cancelaEvento = isset($_GET['cancelaEvento']) ? $_GET['cancelaEvento'] : 0 ;
$confimarReserva = isset($_GET['confimarReserva']) ? $_GET['confimarReserva'] :0;
$convidadosEmail = isset($_GET['convidados']) ? $_GET['convidados'] : 0 ;
$limpezaStatus = isset($_GET['limpeza']) ? $_GET['limpeza'] : 0 ;

//$cancelaEvento = $_GET['cancelaEvento'];


$startDec = urldecode($start);
$endDec = urldecode($end);

list($dataInicio, $horaInicio) = explode(' ', $startDec);
list(, $horaFiM) = explode(' ', $endDec);

$convidados = explode('-', $convidadosEmail);

$data = date_create_from_format('Y-m-d', $dataInicio);
$dataInicioEnvio =  date_format($data, 'd/m/Y');

include 'conexao2.php';

if($cancelaEvento == 1){
    $emailTitle = "Cancelamento de Reserva de Sala";
    $mensagem = "foi cancelada";
}else if($reserva == 0){
    $mensagem = "foi confirmada com sucesso";
    $emailTitle = "Confirmação de Reserva de Sala";
}elseif($reserva == 1){
    $mensagem = "esta pendente";
    $emailTitle = "Reserva pendente de Aprovação";
}else if($reserva == 2){
    $mensagem = "foi editado com sucesso";
    $emailTitle = "Confirmação de Edição de Reserva de Sala";
}

try {
    $query = "SELECT login , senha FROM usuarios WHERE tipo = 'email'";
    $smpt = $conn->prepare($query);
    $smpt->execute();
    $email = $smpt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}

try {
    $query = "SELECT titulo , localizacao FROM salas WHERE valor = '$sala'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $salas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}

$imagem = $salas[0]['localizacao'];
$baners = str_replace(".jpg",".png", $imagem);
$baners = str_replace("anexos_salas/","anexos_salas/baners/", $baners);

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->CharSet = "UTF-8";
    $mail->Host       = 'smtp-mail.outlook.com';                //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $email[0]['login'];                     //SMTP username
    $mail->Password   = $email[0]['senha'];                     //SMTP password
    $mail->SMTPSecure =  'starttls';          //Enable implicit TLS encryption
    $mail->Port       = 587;


    //Recipients
    $mail->setFrom($email[0]['login'], 'Alan');
    $mail->addAddress($user);     //Add a recipient
    

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $emailTitle;

    $mail->Body    = '<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #333;">'. $emailTitle .'</h2>

                        <p>Olá, '.$nome.'</p>

                        <p>Sua reserva para a <strong>'. $salas[0]['titulo'].'</strong> '.$mensagem.' para o seguinte período:</p>

                        <ul>
                            <li><strong>Data :</strong> '. $dataInicioEnvio .'</li>
                            <li><strong>Horário Inicio:</strong> '. $horaInicio .'</li>
                            <li><strong>Horário Fim:</strong> '. $horaFiM .'</li>
                        </ul>
                        
                        <img src="https://reserva.royalcargo.com.br/'.$baners.'" border="0">
                    </div>'
                    
                    ;
    $mail->AltBody = 'Sua reserva para a sala '. $salas[0]['titulo'].' foi confirmada com sucesso';

    $mail->send();

   

    if($convidadosEmail != ""){

        $mail->clearAllRecipients();
        
            foreach($convidados as $convidado){
                $mail->addAddress($convidado);
            }

        $mail->Subject = "Convite para $titulo";
        $mail->Body    = '<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                            <h2 style="color: #333;">Convite para '.$titulo.'</h2>

                            <p>Olá, tudo bem ?</p>

                            <p>A Reunião foi marcado pelo(a) '.$nome.' </p>

                            <p>A reunião será na/no <strong>'. $salas[0]['titulo'].'</strong> '.$mensagem.' para o seguinte período:</p>

                            <ul>
                                <li><strong>Data :</strong> '. $dataInicioEnvio .'</li>
                                <li><strong>Horário Inicio:</strong> '. $horaInicio .'</li>
                                <li><strong>Horário Fim:</strong> '. $horaFiM .'</li>
                            </ul>
                            
                            <img src="https://reserva.royalcargo.com.br/'.$baners.'" border="0">
                        </div>'
    ;
        $mail->send();
    }


   


    if($reserva == 1) {

        if($limpezaStatus == 1 ){
            $limpeza = "O espaço será entregue limpo";
         }else if($limpezaStatus == 2){
            $limpeza = "Limpeza é por conta da Royal";
         }else if($limpezaStatus == 3){
            $limpeza = "Limpeza será paga pelos colaboradores";
         }

        $mail->clearAllRecipients();
        include_once('usuario.php');
        $admsInfo = GetAdmsEmails();
        foreach( $admsInfo as $adms ) {
            $mail->addAddress($adms); 
        }
        
        $mail->Subject = "Aprovação para ". $salas[0]['titulo'];
        $mail->Body    = '<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                            <h2 style="color: #333;"> Titulo - ' .$titulo.'</h2>

                            <p>Olá, tudo bem ?</p>

                            <h3>A Reunião foi marcado pelo(a) '.$nome.' </h3>

                            <h4>Limpeza - '.$limpeza.'</h4>

                            <p>A reunião será na/no <strong>'. $salas[0]['titulo'].'</strong>  para o seguinte período:</p>

                            <ul>
                                <li><strong>Data :</strong> '. $dataInicioEnvio .'</li>
                                <li><strong>Horário Inicio:</strong> '. $horaInicio .'</li>
                                <li><strong>Horário Fim:</strong> '. $horaFiM .'</li>
                            </ul>
                            
                            <img src="https://reserva.royalcargo.com.br/'.$baners.'" border="0">
                        </div>'
    ;
        $mail->send();
        ///enviar botoes com id para confirmar e recusar reserva

    }

    if($confimarReserva != 1){
        header("Location: index.php?salaget=$sala&erro=$erroAviso");
    exit();
    }else{
        header("Location: ../reservasPendentes.php"); 
    }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    /*echo $email[0]['login'] . "<br>";
    echo $email[0]['senha'];   */
}
