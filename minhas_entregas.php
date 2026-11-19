<?php
require "conexao.php";
if ($_SESSION['tipo'] != "entregador") {
    die("Acesso negado. <a href='login.php'>Login</a>");
}

if (isset($_POST['id'])) {
    $stm = $conexao->prepare("UPDATE entregas SET status = 'entregue' WHERE id = ? AND id_entregador = ?");
    $stm->execute([$_POST['id'], $_SESSION['id_usuario']]);
}

$stm = $conexao->prepare("SELECT * FROM entregas WHERE id_entregador = ?");
$stm->execute([$_SESSION['id_usuario']]);
$entregas = $stm->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Entregas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Minhas Entregas</h2>
    <a href="entregador.php">Entregas disponíveis</a> | <a href="logout.php">Sair</a><br><br>

    <table>
        <tr><th>Dimensões (L x A x P)</th><th>Peso</th><th>Status</th><th></th></tr>
        <?php foreach ($entregas as $e) { ?>
        <tr>
            <td><?= $e['largura'] ?> x <?= $e['altura'] ?> x <?= $e['profundidade'] ?></td>
            <td><?= $e['peso'] ?></td>
            <td><?= $e['status'] ?></td>
            <td>
                <?php if ($e['status'] == "em_rota") { ?>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $e['id'] ?>">
                    <button type="submit">Marcar como entregue</button>
                </form>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
