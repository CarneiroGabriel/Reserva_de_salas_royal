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
//$cancelaEvento = $_GET['cancelaEvento'];

$startDec = urldecode($start);
$endDec = urldecode($end);

list($dataInicio, $horaInicio) = explode(' ', $startDec);
list(, $horaFiM) = explode(' ', $endDec);

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
    $emailTitle = "Confirmação de Pedido de Reserva de Sala";
}else if($reserva == 2){
    $mensagem = "foi editado com sucesso";
    $emailTitle = "Confirmação de Edição de Reserva de Sala";
}

echo $mensagem;


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
    /*$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */  //Optional name

    //Content
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
    echo $imagem.'<br>';
    echo $baners;
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
