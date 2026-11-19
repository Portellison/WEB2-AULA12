<?php
require "conexao.php";
if ($_SESSION['tipo'] != "consumidor") {
    die("Acesso negado. <a href='login.php'>Login</a>");
}

$stm = $conexao->prepare(
    "SELECT entregas.*, usuarios.nome AS entregador
     FROM entregas
     LEFT JOIN usuarios ON usuarios.id = entregas.id_entregador
     WHERE entregas.id_consumidor = ?"
);
$stm->execute([$_SESSION['id_usuario']]);
$entregas = $stm->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas solicitações</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Minhas solicitações</h2>
    <a href="consumidor.php">Nova entrega</a> | <a href="logout.php">Sair</a><br><br>

    <table>
        <tr>
            <th>Largura</th><th>Altura</th><th>Profundidade</th><th>Peso</th>
            <th>Sensível</th><th>Status</th><th>Entregador</th>
        </tr>
        <?php foreach ($entregas as $e) { ?>
        <tr>
            <td><?= $e['largura'] ?></td>
            <td><?= $e['altura'] ?></td>
            <td><?= $e['profundidade'] ?></td>
            <td><?= $e['peso'] ?></td>
            <td><?= $e['sensivel'] ? "Sim" : "Não" ?></td>
            <td><?= $e['status'] ?></td>
            <td><?= $e['entregador'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
