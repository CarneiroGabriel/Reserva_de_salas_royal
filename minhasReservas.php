<?php
session_start();
include "conexao2.php";
include "fullcalendar/usuario.php";
if (isset($_SESSION['log']) == false) {
  echo ("<script>window.location = 'login.php';</script>");
}
$user = $_SESSION['user'];

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
    $query = "SELECT * FROM events WHERE user = '$user'";
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
                        <th>Sala</th>
                        <th>Confirmado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "conexao2.php"; 
                        foreach ($eventos as $evento): 
                            $sala = $evento['sala'];
                            try {
                                $query = "SELECT titulo FROM salas WHERE valor = '$sala'";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $salas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                die("Erro na consulta: " . $e->getMessage());
                            }

                            if($evento['reserva'] == 0){
                                $reserva = "Confirmado";
                            }else if($evento["reserva"] == 1){
                                $reserva = "Pendente";
                            }
                        
                        ?>


                        <tr>
                            <td><?= $evento['title'] ?></td>
                            <td><?= $evento['start'] ?></td>
                            <td><?= $evento['end'] ?></td>
                            <td><?= $evento['NomeResponsavel'] ?></td>
                            <td><?= $reserva ?></td>
                            <td><?= $salas[0]['titulo'] ?></td>
                            
                            <td>
                                <a href="excluirReserva.php?id=<?php echo $evento['id'] ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>