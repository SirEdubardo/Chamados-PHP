<?php
session_start();
require_once 'conexao.php';

if (isset($_SESSION['nome'])) {
    if ($_SESSION['tipo'] === 'usuário') {
        header("Location: paginainicial_usuario.php");
        exit();
    } elseif ($_SESSION['tipo'] === 'técnico') {
        header("Location: paginainicial_tecnico.php");
        exit();
    }
}

$erroLogin = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email = ? AND senha = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ss', $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['tipo'] = $row['tipo'];

        if ($row['tipo'] === 'usuário') {
            header("Location: paginainicial_usuario.php");
            exit();
        } elseif ($row['tipo'] === 'técnico') {
            header("Location: paginainicial_tecnico.php");
            exit();
        }
    } else {
        $erroLogin = "Email ou senha incorretos.";
    }

    $stmt->close();
}

$conexao->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style/tela-login.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (!empty($erroLogin)) : ?>
            <p class="error"><?php echo $erroLogin; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
        <br>
        <a href="cadastro.php">Cadastre-se</a>
    </div>
</body>
</html>