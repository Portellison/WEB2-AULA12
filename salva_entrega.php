<?php
require "conexao.php";
if ($_SESSION['tipo'] != "consumidor") {
    die("Acesso negado.");
}

$stm = $conexao->prepare(
    "INSERT INTO entregas (id_consumidor, id_entregador, largura, altura, profundidade, peso, sensivel, status)
     VALUES (?, NULL, ?, ?, ?, ?, ?, 'disponivel')"
);
$stm->execute([
    $_SESSION['id_usuario'],
    $_POST['largura'],
    $_POST['altura'],
    $_POST['profundidade'],
    $_POST['peso'],
    $_POST['sensivel']
]);

echo "Entrega solicitada! <a href='minhas_solicitacoes.php'>Ver minhas solicitações</a>";
