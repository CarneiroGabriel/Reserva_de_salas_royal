<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

include "../PHPMailer/src/PHPMailer.php";
//include "../PHPMailer/src/OAuth.php";
//include "../PHPMailer/src/OAuthTokenProvider.php";
include "../PHPMailer/src/Exception.php";
include "../PHPMailer/src/SMTP.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
include 'conexao2.php';
$sala = $_GET['salaget'];
$user = $_GET['user'];
$reserva = $_GET['reserva'];
$titulo = $_GET['title'];
$erro = $_GET['erro'];
$start = $_GET['start'];
$end = $_GET['end'];


try {
    $query = "SELECT login , senha FROM usuarios WHERE tipo = 'email'";
    $smpt = $conn->prepare($query);
    $smpt->execute();
    $email = $smpt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->CharSet = "UTF-8";
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $email[0]['login'];                     //SMTP username
    $mail->Password   = $email[0]['senha'];                               //SMTP password
    $mail->SMTPSecure =  'starttls';          //Enable implicit TLS encryption
    $mail->Port       = 587;        
   

    //Recipients
    $mail->setFrom($email[0]['login'], 'Alan');
    $mail->addAddress('g.carneiro@royalcargo.com.br', 'Gabriel');     //Add a recipient
    /*$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */  //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Confirmação de Reserva';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    header("Location: index.php?salaget=$sala");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    /*echo $email[0]['login'] . "<br>";
    echo $email[0]['senha'];   */ 
}