<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['nome']) || $_SESSION['tipo'] !== 'usuário') {
    header("Location: index.php");
    exit();
}

$nomeUsuario = $_SESSION['nome'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeProduto = $_POST['nome_produto'];

    $sql = "INSERT INTO produto (nome) VALUES (?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('s', $nomeProduto);
    $stmt->execute();

    $mensagem = "Produto '$nomeProduto' criado com sucesso.";

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gerar Produto</title>
    <link rel="stylesheet" type="text/css" href="style/gerarproduto.css">
</head>
<body>
<div class="container">
        <h2>Bem-vindo, <?php echo $nomeUsuario; ?>!</h2>
        <a href="logout.php">Sair</a>
        
        <div class="gerar-produto">
            <h3>Gerar Produto</h3>
            <?php if (isset($mensagem)) : ?>
                <p><?php echo $mensagem; ?></p>
                <button onclick="location.href='paginainicial_usuario.php'">Voltar</button>
            <?php else : ?>
                <form method="POST" action="gerarproduto.php">
                    <label for="nome_produto">Nome do Produto:</label>
                    <input type="text" name="nome_produto" id="nome_produto" required>
                    <br>
                    <button type="submit">Gerar Produto</button>
                </form>
                <button onclick="location.href='paginainicial_usuario.php'">Voltar</button>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
