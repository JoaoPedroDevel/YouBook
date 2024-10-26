<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>

    <h2>
        Cadastro de Usuário
    </h2>

    <form action="cadastroUsuario.php">

    <label for="usuario">Usuário</label>
    <input type="text"  id="cadUser" name="cadUser" required>

    <label for="senha">Senha</label>
    <input type="password" id="cadPass" name="cadPass" required>

    <label for="senha">Digite a senha novamente</label>
    <input type="password" id="passRepeat" name="passRepeat" required>

    <label for="">
        <input type="checkbox" id="termos" name="termos" required>
        Eu concordo e aceito os <a href="../assets/termos/termos.php" target="blank"></a> termos de uso.
    </label>

    <button type="submit">Cadastrar usuário</button>

    <p>Já tem usuário cadastrado?</p>
    <a href="../login/login.php"> <button>Faça Log-In!</button></a>
    </form>
</body>
</html>