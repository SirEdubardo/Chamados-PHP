<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO usuario (nome, email, senha, cpf, tipo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sssss', $nome, $email, $senha, $cpf, $tipo);
    $stmt->execute();

    $stmt->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="style/cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <form method="POST" action="cadastro.php">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo" required>
                    <option value="usuário">Usuário</option>
                    <option value="técnico">Técnico</option>
                </select>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>

