<?php
session_start();

if (!isset($_SESSION['nome']) || $_SESSION['tipo'] !== 'técnico') {
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
    if (isset($row['id'])) {
        $chamado = array(
            'id' => $row['id'],
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
    <title>Página Inicial - Técnico</title>
    <link rel="stylesheet" type="text/css" href="style/paginicialtecnico.css">
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo $nomeUsuario; ?>!</h2>
        <a href="logout.php">Sair</a>
        
        <div class="tecnico-actions">
            <h3>Minhas Ações como Técnico</h3>
            <button onclick="location.href='listachamadotecnico.php'">Lista de Chamados</button>
        </div>
    </div>
</body>
</html>