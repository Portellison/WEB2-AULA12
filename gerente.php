<?php
require "conexao.php";
if ($_SESSION['tipo'] != "gerente") {
    die("Acesso negado. <a href='login.php'>Login</a>");
}

if (isset($_POST['excluir'])) {
    $stm = $conexao->prepare("DELETE FROM entregas WHERE id = ?");
    $stm->execute([$_POST['excluir']]);
}
if (isset($_POST['cancelar'])) {
    $stm = $conexao->prepare("UPDATE entregas SET status = 'cancelada' WHERE id = ?");
    $stm->execute([$_POST['cancelar']]);
}

$status = $_GET['status'] ?? "";
if ($status == "") {
    $stm = $conexao->prepare("SELECT * FROM entregas");
    $stm->execute();
} else {
    $stm = $conexao->prepare("SELECT * FROM entregas WHERE status = ?");
    $stm->execute([$status]);
}
$entregas = $stm->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do gerente</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Painel do gerente</h2>
    <a href="logout.php">Sair</a><br><br>

    <form method="get">
        Filtrar por status:
        <select name="status">
            <option value="">Todos</option>
            <option value="disponivel">disponivel</option>
            <option value="em_rota">em_rota</option>
            <option value="entregue">entregue</option>
            <option value="cancelada">cancelada</option>
        </select>
        <button type="submit">Filtrar</button>
    </form><br>

    <table>
        <tr>
            <th>ID</th><th>Consumidor</th><th>Entregador</th><th>Dimensões (L x A x P)</th>
            <th>Peso</th><th>Sensível</th><th>Status</th><th>Ações</th>
        </tr>
        <?php foreach ($entregas as $e) { ?>
        <tr>
            <td><?= $e['id'] ?></td>
            <td><?= $e['id_consumidor'] ?></td>
            <td><?= $e['id_entregador'] ?></td>
            <td><?= $e['largura'] ?> x <?= $e['altura'] ?> x <?= $e['profundidade'] ?></td>
            <td><?= $e['peso'] ?></td>
            <td><?= $e['sensivel'] ? "Sim" : "Não" ?></td>
            <td><?= $e['status'] ?></td>
            <td>
                <form method="post">
                    <button type="submit" name="cancelar" value="<?= $e['id'] ?>">Cancelar</button>
                    <button type="submit" name="excluir" value="<?= $e['id'] ?>">Excluir</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
