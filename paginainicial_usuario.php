<?php
session_start();

if (!isset($_SESSION['nome']) || $_SESSION['tipo'] !== 'usuário') {
    header("Location: index.php");
    exit();
}

$nomeUsuario = $_SESSION['nome'];

$conexao = mysqli_connect("localhost", "root", "", "banco");

if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$sql = "SELECT * FROM chamado";
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

$chamados = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    $chamado = array(
        'id' => $row['ID'],
        'titulo' => $row['titulo'],
        'descricao' => $row['descricao'],
        'status' => $row['status']
    );
    $chamados[] = $chamado;
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Página Inicial - Usuário</title>
    <link rel="stylesheet" type="text/css" href="style/paginicialusuario.css">
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo $nomeUsuario; ?>!</h2>
        <a href="logout.php">Sair</a>
        
        <div class="user-actions">
            <h3>Minhas Ações como Usuário</h3>
            <button onclick="location.href='gerarproduto.php'">Produto</button>
            <button onclick="location.href='gerarchamado.php'">Chamado</button>
        </div>
        
        <div class="chamados-list">
            <h3>Lista de Chamados</h3>
            <?php if (mysqli_num_rows($resultado) > 0) : ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach ($chamados as $chamado) : ?>
                        <tr>
                            <td><?php echo $chamado['id']; ?></td>
                            <td><?php echo $chamado['titulo']; ?></td>
                            <td><?php echo $chamado['descricao']; ?></td>
                            <td><?php echo $chamado['status']; ?></td>
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