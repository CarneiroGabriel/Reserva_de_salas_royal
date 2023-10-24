<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<?php
    session_start();

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
    <div class="container">
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
                            <a href="editarUser.php?id=<?= $agente['id'] ?>" class="btn btn-warning">Editar</a>
                            <a href="excluir.php?id=<?= $agente['id'] ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="adicionar.php" class="btn btn-success">Adicionar Agente</a>
    </div>
</body>
</html>