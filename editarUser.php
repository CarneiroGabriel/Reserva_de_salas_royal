<?php
include "conexao2.php";
// Conecte-se ao banco de dados e recupere os detalhes do registro a ser editado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar o formulário de edição aqui
    $id = $_POST['id'];
    $novoNome = $_POST['novoNome'];
    $novoLogin = $_POST['novoLogin'];
    $novoTipo = $_POST['novoTipo'];
    
    // Execute uma consulta SQL para atualizar o registro
    $query = "UPDATE agente SET nome = :novoNome, login = :novoLogin, tipo = :novoTipo WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':novoNome', $novoNome);
    $stmt->bindParam(':novoLogin', $novoLogin);
    $stmt->bindParam(':novoTipo', $novoTipo);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        // Redirecione para a página de lista de agentes após a edição
        header("Location: listar_agentes.php");
    } else {
        echo "Erro na edição do agente.";
    }
}
?>
<!-- Crie um formulário para editar o registro -->
<form method="POST">
    <input type="hidden" name="id" value="<?= $agente['id'] ?>">
    <input type="text" name="novoNome" value="<?= $agente['nome'] ?>">
    <input type="text" name="novoLogin" value="<?= $agente['login'] ?>">
    <input type="text" name="novoTipo" value="<?= $agente['tipo'] ?>">
    <button type="submit">Salvar</button>
</form>