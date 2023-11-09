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
    <title>Usuarios</title>
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
        $query = "SELECT * FROM usuarios";
        $smpt = $conn->prepare($query);
        $smpt->execute();
        $agentes = $smpt->fetchAll(PDO::FETCH_ASSOC);
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
            <h1 class="mt-5 mb-4">Usuarios</h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agentes as $agente): ?>
                        <tr>
                            <td><?= $agente['nome'] ?></td>
                            <td><?= $agente['login'] ?></td>
                            <td><?= $agente['tipo'] ?></td>
                            <td>
                                <a href="admUser.php?id=<?= $agente['id'] ?>" class="btn btn-warning">Tornar ADM</a>
                                <a href="excluirUser.php?id=<?= $agente['id'] ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="adicionar.php" class="btn btn-success">Adicionar Agente</a>
        </div>
    </div>
</body>
</html>