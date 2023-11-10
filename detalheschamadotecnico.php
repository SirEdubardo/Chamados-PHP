<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['nome']) || $_SESSION['tipo'] !== 'técnico') {
    header("Location: index.php");
    exit();
}

$nomeUsuario = $_SESSION['nome'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resposta = $_POST['resposta'];
    $idChamado = $_POST['id_chamado'];

    $sql = "UPDATE chamado SET resposta = ?, status = 'Finalizado' WHERE ID = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('si', $resposta, $idChamado);
    $stmt->execute();

    $mensagem = "Resposta salva e chamado finalizado com sucesso.";

    $stmt->close();

    // Redirecionamento para a lista de chamados técnicos
    header("Location: listachamadostecnico.php");
    exit();
}

if (isset($_GET['id'])) {
    $idChamado = $_GET['id'];

    $sql = "SELECT * FROM chamado WHERE ID = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $idChamado);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if (!$resultado) {
        die("Erro na consulta: " . $conexao->error);
    }

    $chamado = $resultado->fetch_assoc();
    $stmt->close();
} else {
    $conexao->close();
    header("Location: listachamadostecnico.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detalhes do Chamado</title>
    <link rel="stylesheet" type="text/css" href="style/detalhes.css">
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo $nomeUsuario; ?>!</h2>
        <a href="logout.php">Sair</a>
        
        <div class="detalhes-chamado">
            <h3>Detalhes do Chamado</h3>
            <p>ID: <?php echo $chamado['ID']; ?></p>
            <p>Título: <?php echo $chamado['titulo']; ?></p>
            <p>Descrição: <?php echo $chamado['descricao']; ?></p>
            <p>Status: <?php echo $chamado['status']; ?></p>
        </div>
        
        <div class="responder-chamado">
            <h3>Responder Chamado</h3>
            <?php if (isset($mensagem)) : ?>
                <p><?php echo $mensagem; ?></p>
            <?php else : ?>
                <form method="POST" action="detalheschamadotecnico.php">
                    <input type="hidden" name="id_chamado" value="<?php echo $chamado['ID']; ?>">
                    <label for="resposta">Resposta:</label>
                    <textarea name="resposta" id="resposta" required></textarea>
                    <br>
                    <button type="submit">Responder</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
