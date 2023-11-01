<?php
session_start();
include "conexao2.php";
include "fullcalendar/usuario.php";
if (isset($_SESSION['log']) == false) {
  echo ("<script>window.location = 'login.php';</script>");
}
$user = $_SESSION['user'];

if ($userInfo['tipo'] == 'adm') {

?>

<!DOCTYPE html>
<html>
<head>
    <title>Confimação de reservas</title>
    <!--FavIcons-->
    <link rel="icon" href="assets/img/favicon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">


    <script src="https://kit.fontawesome.com/d98d40e574.js" crossorigin="anonymous"></script>
    
</head>
<?php

    include "conexao2.php";

try {
    $query = "SELECT * FROM events WHERE reserva = 1";
    $smpt = $conn->prepare($query);
    $smpt->execute();
    $eventos = $smpt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}
?>

<body>
    <div id="wrapper">

    <?php

    include_once "topo.php";

    ?>

    <!-- TOPO -->

    <!-- MENU LATERAL -->

    <?php

    include_once "menu_lateral.php";

    ?>

        <div class="container main">
            <h1 class="mt-5 mb-4">Confimação de reservas</h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Começo</th>
                        <th>Fim</th>
                        <th>Nome Responsavel</th>
                        <th>Limpeza</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $evento): 

                        if($evento['limpeza'] == 1 ){
                           $limpeza = "O espaço será entregue limpo";
                        }else if($evento['limpeza'] == 2){
                           $limpeza = "Limpeza é por conta da Royal";
                        }else if($evento['limpeza'] == 3){
                           $limpeza = "Limpeza será paga pelos colaboradores";
                        }

                        ?>


                        <tr>
                            <td><?= $evento['title'] ?></td>
                            <td><?= $evento['start'] ?></td>
                            <td><?= $evento['end'] ?></td>
                            <td><?= $evento['NomeResponsavel'] ?></td>
                            <td><?= $limpeza ?></td>
                            
                            <td>
                                <a href="confimarReserva.php" class="btn btn-success">Confirmar</a>
                                <a href="excluir.php?id=<?= $agente['id'] ?>" class="btn btn-danger">Negar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php }else{ header("Location:index.php"); } ?>