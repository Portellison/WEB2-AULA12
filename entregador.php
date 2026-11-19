<?php
require "conexao.php";
if ($_SESSION['tipo'] != "entregador") {
    die("Acesso negado. <a href='login.php'>Login</a>");
}

// botão Aceitar Entrega
if (isset($_POST['id'])) {
    $stm = $conexao->prepare("UPDATE entregas SET id_entregador = ?, status = 'em_rota' WHERE id = ? AND status = 'disponivel'");
    $stm->execute([$_SESSION['id_usuario'], $_POST['id']]);
}

$entregas = $conexao->query("SELECT * FROM entregas WHERE status = 'disponivel'")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Entregas disponíveis</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Olá, <?= $_SESSION['nome'] ?></h2>
    <a href="minhas_entregas.php">Minhas Entregas</a> | <a href="logout.php">Sair</a>

    <h3>Entregas disponíveis</h3>
    <table>
        <tr><th>Dimensões (L x A x P)</th><th>Peso</th><th>Alerta</th><th></th></tr>
        <?php foreach ($entregas as $e) { ?>
        <tr>
            <td><?= $e['largura'] ?> x <?= $e['altura'] ?> x <?= $e['profundidade'] ?></td>
            <td><?= $e['peso'] ?></td>
            <td>
                <?php if ($e['sensivel']) { ?>
                    <span class="alerta">CONTEÚDO SENSÍVEL</span>
                <?php } ?>
            </td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $e['id'] ?>">
                    <button type="submit">Aceitar Entrega</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
