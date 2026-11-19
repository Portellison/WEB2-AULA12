<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Cadastro</h2>
    <form action="salva_usuario.php" method="post">
        Nome: <input type="text" name="nome" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Senha: <input type="password" name="senha" required><br><br>
        Perfil:
        <select name="tipo">
            <option value="consumidor">Consumidor</option>
            <option value="entregador">Entregador</option>
        </select><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="login.php">Login</a>
</body>
</html>
