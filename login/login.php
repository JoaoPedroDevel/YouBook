<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h1>
        YouBook
    </h1>

    <h2>
        Log-In
    </h2>

    <form action="login.php" method="post">
            
    <label for="usuario">Usuário</label>
    <input type="text"  id="usuario" name="usuario" required>

    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" required>

    <a href="../index.php"><button type="submit">Logar</button></a>

    </form>

    <div>
    <p>Não tem Cadastro?</p>
    <a href="../cadastro/cadastroUsuario.php"><button>Clique Aqui!</button></a>
    </div>

</body>
</html>