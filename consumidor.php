<?php
require "conexao.php";
if ($_SESSION['tipo'] != "consumidor") {
    die("Acesso negado. <a href='login.php'>Login</a>");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Solicitar entrega</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Olá, <?= $_SESSION['nome'] ?></h2>
    <a href="minhas_solicitacoes.php">Minhas solicitações</a> | <a href="logout.php">Sair</a>

    <h3>Solicitar entrega</h3>
    <form action="salva_entrega.php" method="post">
        Largura: <input type="number" step="0.01" name="largura" required><br><br>
        Altura: <input type="number" step="0.01" name="altura" required><br><br>
        Profundidade: <input type="number" step="0.01" name="profundidade" required><br><br>
        Peso: <input type="number" step="0.01" name="peso" required><br><br>
        Conteúdo sensível:
        <input type="radio" name="sensivel" value="1" required> Sim
        <input type="radio" name="sensivel" value="0"> Não<br><br>
        <button type="submit">Solicitar</button>
    </form>
</body>
</html>
