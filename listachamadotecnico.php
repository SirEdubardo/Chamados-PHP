<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['nome']) || $_SESSION['tipo'] !== 'técnico') {
    header("Location: index.php");
    exit();
}

$nomeUsuario = $_SESSION['nome'];

$sql = "SELECT * FROM chamado";
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("erro: " . mysqli_error($conexao));
}

$chamados = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    if (isset($row['ID'])) {
        $chamado = array(
            'id' => $row['ID'],
            'titulo' => $row['titulo'],
            'descricao' => $row['descricao'],
            'status' => $row['status']
        );
        $chamados[] = $chamado;
    }
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Chamados do Técnico</title>
    <link rel="stylesheet" type="text/css" href="style/listatecnico.css">
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo $nomeUsuario; ?>!</h2>
        <a href="logout.php">Sair</a>
        
        <div class="chamados-list">
            <h3>Lista de Chamados</h3>
            <?php if (!empty($chamados)) : ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                    <?php foreach ($chamados as $chamado) : ?>
                        <tr>
                            <td><?php echo $chamado['id']; ?></td>
                            <td><?php echo $chamado['titulo']; ?></td>
                            <td><?php echo $chamado['descricao']; ?></td>
                            <td><?php echo $chamado['status']; ?></td>
                            <td><a href="detalheschamadotecnico.php?id=<?php echo $chamado['id']; ?>">Visualizar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <p>Nenhum chamado encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
