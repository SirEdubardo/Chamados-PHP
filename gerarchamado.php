<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['nome']) || $_SESSION['tipo'] !== 'usuário') {
    header("Location: index.php");
    exit();
}

$nomeUsuario = $_SESSION['nome'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tituloChamado = $_POST['titulo_chamado'];
    $descricaoChamado = $_POST['descricao_chamado'];
    $produto = $_POST['produto'];

    $sql = "INSERT INTO chamado (titulo, descricao, status) VALUES (?, ?, 'pendente')";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ss', $tituloChamado, $descricaoChamado);
    $stmt->execute();

    $idChamado = $stmt->insert_id;

    $sql = "INSERT INTO produto (id_chamado, nome) VALUES (?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('is', $idChamado, $produto);
    $stmt->execute();

    // Exiba uma mensagem de sucesso
    $mensagem = "Chamado '$tituloChamado' criado com sucesso e produto '$produto' salvo.";

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gerar Chamado</title>
    <link rel="stylesheet" type="text/css" href="style/gerarchamado.css">
</head>
<body>
    <h2>Bem-vindo, <?php echo $nomeUsuario; ?>!</h2>
    <a href="logout.php">Sair</a>
    
    <h3>Gerar Chamado</h3>
    <?php if (isset($mensagem)) : ?>
        <p><?php echo $mensagem; ?></p>
        <button onclick="location.href='paginainicial_usuario.php'">Voltar</button>
    <?php else : ?>
        <form method="POST" action="gerarchamado.php">
            <label for="titulo_chamado">Título:</label>
            <input type="text" name="titulo_chamado" id="titulo_chamado" required>
            <br>
            <label for="descricao_chamado">Descrição:</label>
            <textarea name="descricao_chamado" id="descricao_chamado" required></textarea>
            <br>
            <label for="produto">Produto:</label>
            <input type="text" name="produto" id="produto" required>
            <br>
            <button type="submit">Gerar Chamado</button>
        </form>
        <button onclick="location.href='paginainicial_usuario.php'">Voltar</button>
    <?php endif; ?>
</body>
</html>
