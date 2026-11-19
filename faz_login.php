<?php
require "conexao.php";

$email = $_POST['email'];
$senha = hash("sha256", $_POST['senha']);

$stm = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
$stm->execute([$email, $senha]);
$usuario = $stm->fetch();

if (!$usuario) {
    die("Email ou senha inválidos. <a href='login.php'>Voltar</a>");
}

$_SESSION['id_usuario'] = $usuario['id'];
$_SESSION['nome'] = $usuario['nome'];
$_SESSION['tipo'] = $usuario['tipo'];

if ($usuario['tipo'] == "entregador") {
    header("Location: entregador.php");
} else if ($usuario['tipo'] == "consumidor") {
    header("Location: consumidor.php");
} else {
    header("Location: gerente.php");
}
