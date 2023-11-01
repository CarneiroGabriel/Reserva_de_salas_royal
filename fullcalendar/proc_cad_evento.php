<?php

ini_set('display_errors', 0);
error_reporting(0);
session_start();

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Sistema de Reservas de Salas </title>
  <meta charset="utf-8">
  <link href='css/bootstrap.min.css' rel='stylesheet'>
  <link href='css/fullcalendar.min.css' rel='stylesheet' />
  <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link href='css/personalizado.css' rel='stylesheet' />
  <script src='js/jquery.min.js'></script>
  <script src='js/bootstrap.min.js'></script>
  <script src='js/moment.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>
  <script src='locale/pt-br.js'></script>
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/fontico/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
  <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="assets/css/main.css">
  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  <link rel="stylesheet" href="assets/css/demo.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>

  <?php

  //Incluir conexao com BD
  //include_once("conexao.php");

  //Incluir usuario completo
  include 'usuario.php';

  date_default_timezone_set('America/Fortaleza');

  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $color = '#3A87AD';
  $start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
  $start_hora = filter_input(INPUT_POST, 'hora_start', FILTER_SANITIZE_STRING);
  $end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
  $end_hora = filter_input(INPUT_POST, 'hora_end', FILTER_SANITIZE_STRING);
  $nome_sala = filter_input(INPUT_POST, 'nome_sala', FILTER_SANITIZE_STRING);
  $start2 = $_POST['start'];
  $user = $_POST['user'];
  $nomeResponsavel = $userInfo['nome'];
  $reserva = $_POST['reserva'];
  $limpeza = $_POST['limpeza'];
  $semana = $_POST['repetir_semana'];
  $mes = $_POST['repetir_mes'];
  $ano = $_POST['repetir_ano'];
  $quant = $_POST['quant'];
  $quant_mes = $_POST['quant_mes'];
  $quant_ano = $_POST['quant_ano'];
  $num = '1';

  if($limpeza != 0){
    $color = '#FFC107';
  }

  //metodo post

  $sql_index = "SELECT DISTINCT MAX(id_index) as id_index FROM events";
  $resultado_index = mysqli_query($conn, $sql_index) or die("Erro ao retornar dados 1");

  while ($registro_index = mysqli_fetch_array($resultado_index)) {
    $id_index = $registro_index['id_index'];
  }

  $id_index2 = $id_index + $num;

  // união da data e hora escolhidada pelo usuario em uma variavel so //

  $data = explode(" ", $start);
  list($date, $hora) = $data;
  $data_sem_barra = array_reverse(explode("/", $date));
  $data_sem_barra = implode("-", $data_sem_barra);
  $add_start_sem_barra = $data_sem_barra . " " . $start_hora;

  $data = explode(" ", $end);
  list($date, $hora) = $data;
  $data_sem_barra = array_reverse(explode("/", $date));
  $data_sem_barra = implode("-", $data_sem_barra);
  $add_end_sem_barra = $data_sem_barra . " " . $end_hora;

  // união da data e hora escolhidada pelo usuario em uma variavel so //

  if ($add_start_sem_barra > $add_end_sem_barra || $add_start_sem_barra == $add_end_sem_barra) {

    echo "<center>
<div class='alert alert-danger' role='alert'><h2>Erro ao cadastrar o evento, verifique se a hora inicial é menor que a final.<h2><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
</center>
<meta http-equiv=refresh content='4; URL=index.php?salaget=$nome_sala';> ";
  } else {



    if ($semana == 7 && $mes == 30 && $ano == 365) {

      echo "<center>
<div class='alert alert-danger' role='alert'><h2>Todos dois ou mais paramentros de repetição foram selecionados, Por favor selecione apenas um.<h2><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
</center>
    <meta http-equiv=refresh content='3; URL=index.php?salaget=$nome_sala';> ";
    } elseif ($semana == 7 && $mes == 30) {
      echo "<center>
<div class='alert alert-danger' role='alert'><h2>Todos dois ou mais paramentros de repetição foram selecionados, Por favor selecione apenas um.<h2><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
</center>
    <meta http-equiv=refresh content='3; URL=index.php?salaget=$nome_sala';> ";
    } elseif ($mes == 30 && $ano == 365) {
      echo "<center>
<div class='alert alert-danger' role='alert'><h2>Todos dois ou mais paramentros de repetição foram selecionados, Por favor selecione apenas um.<h2><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
</center>
    <meta http-equiv=refresh content='3; URL=index.php?salaget=$nome_sala';> ";
    } elseif ($semana == 7 && $ano == 365) {
      echo "<center>
<div class='alert alert-danger' role='alert'><h2>Todos dois ou mais paramentros de repetição foram selecionados, Por favor selecione apenas um.<h2><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
</center>
    <meta http-equiv=refresh content='3; URL=index.php?salaget=$nome_sala';> ";
    } else {

      //Seleciona as datas iguais (Caso exista algum) à que usuário tentou marcar 
      $sql_data = "SELECT start, end FROM events WHERE (start >= '$add_start_sem_barra' or end >= '$add_start_sem_barra')  AND (start <= '$add_end_sem_barra' or end <= '$add_end_sem_barra') AND sala = '$nome_sala'";
      $resultado_data = mysqli_query($conn, $sql_data) or die("Erro ao retornar dados 1");

      while ($registro_data = mysqli_fetch_array($resultado_data)) {
        $id_data = $registro_data['start'];
      }

      // Condição se não existir nenhuma data igual a que o usuário tentou marcar //
      if (!isset($id_data)) {

        if (!empty($title) && !empty($color) && !empty($start) && !empty($end)) {

          $result_events = "INSERT INTO events (title, color, start, end, user, sala, id_index , NomeResponsavel, reserva, limpeza) VALUES ('$title', '$color', '$add_start_sem_barra', '$add_end_sem_barra', '$user', '$nome_sala', '$id_index2', '$nomeResponsavel', '$reserva', '$limpeza')";
          $resultado_events = mysqli_query($conn, $result_events);

          //Verificar se salvou no banco de dados através "mysqli_insert_id" o qual verifica se existe o ID do último dado inserido
          if (mysqli_insert_id($conn)) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Evento Cadastrado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            if($limpeza !=0){
              header("Location: index.php?salaget=$nome_sala&erro=4");
            }else{
            header("Location: index.php?salaget=$nome_sala&erro=3");
            }
            
          } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o evento 1 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            header("Location: index.php?salaget=$nome_sala&erro=1");
          }
        }
      } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>O Evento de $add_start_sem_barra à $add_end_sem_barra não pode ser cadastrado pois o horário já está marcado! <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        header("Location: index.php?salaget=$nome_sala&erro=2");
      }

      $i = 0;

      if($semana == 7){
        $quant_rpt = $quant;
        $timeString = "week";
      }elseif($mes == 30){
        $quant_rpt = $quant_mes;
        $timeString = "month";
      }elseif($quant_ano == 365){
        $quant_rpt = $quant_ano;
        $timeString = "year";

      }else{
        $quant_rpt = 0;
      }

      while ($i < $quant_rpt) {
        $i++;

        if (!empty($title) && !empty($color) && !empty($start) && !empty($end)) {

          $start2 = strtotime($add_start_sem_barra);
          $start_fim = strtotime("+ " . $i ." $timeString", $start2);

          $start_sem_barra2 = date('Y-m-d H:i:s', $start_fim);

          $end2 = strtotime($add_end_sem_barra);
          $end_fim = strtotime("+ " . $i ." $timeString", $end2);

          $end_sem_barra2 = date('Y-m-d H:i:s', $end_fim);

          //Seleciona as datas iguais (Caso exista algum) à que usuário tentou marcar 
          $sql_data = "SELECT start, end FROM events WHERE (start >= '$start_sem_barra2' or end >= '$start_sem_barra2')  AND (start <= '$end_sem_barra2' or end <= '$end_sem_barra2') AND sala = '$nome_sala'";
          $resultado_data = mysqli_query($conn, $sql_data) or die("Erro ao retornar dados 1");

          while ($registro_data = mysqli_fetch_array($resultado_data)) {
            $id_data = $registro_data['start'];
          }

          // Condição se não existir nenhuma data igual a que o usuário tentou marcar //
          if (!isset($id_data)) {

            $result_events = "INSERT INTO events (title, color, start, end, user, sala, id_index, NomeResponsavel, reserva) VALUES ('$title', '$color', '$start_sem_barra2', '$end_sem_barra2', '$user', '$nome_sala', '$id_index2', '$nomeResponsavel', '$reserva')";
            $resultado_events = mysqli_query($conn, $result_events);


            if (mysqli_insert_id($conn)) {
              $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Evento Cadastrado com Sucesso <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
              
              header("Location: index.php?salaget=$nome_sala&erro=3");
            } else {
              $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o evento 2 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
              
              header("Location: index.php?salaget=$nome_sala&erro=1");
            }
          } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>O Evennão pode ser cadastrado pois o horário já está marcado! <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            
            header("Location: index.php?salaget=$nome_sala&erro=2");
          }
        }
      }
    }
  }



  ?>


</body>

</html>