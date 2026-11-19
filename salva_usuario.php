<?php
require "conexao.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = hash("sha256", $_POST['senha']);
$tipo = $_POST['tipo'];

if ($tipo != "consumidor" && $tipo != "entregador") {
    die("Perfil inválido.");
}

$stm = $conexao->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
$stm->execute([$nome, $email, $senha, $tipo]);

echo "Usuário cadastrado! <a href='login.php'>Fazer login</a>";
