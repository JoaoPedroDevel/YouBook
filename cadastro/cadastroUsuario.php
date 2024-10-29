<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>

    <h2>Cadastro de Usuário</h2>

    <form action="" method="POST"> <!-- O método POST deve ser definido -->
        <label for="usuario">Usuário</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>

        <label for="confirmaSenha">Digite a senha novamente</label>
        <input type="password" id="confirmaSenha" name="confirmaSenha" required>

        <label>
            <input type="checkbox" id="termos" name="termos" required>
            Eu concordo e aceito os <a href="../assets/termos/termos.php" target="_blank">termos de uso</a>.
        </label>

        <button type="submit">Cadastrar usuário</button>

        <p>Já tem usuário cadastrado?</p>
        <a href="../login/login.php"><button type="button">Faça Log-In!</button></a>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recebe dados do formulário
        $login = $_POST['usuario'] ?? null; // Captura 'usuario' corretamente
        $senha = $_POST['senha'] ?? null; // Captura 'senha'
        $confirmaSenha = $_POST['confirmaSenha'] ?? null; // Captura 'confirmaSenha'

        // Verifica se as senhas são iguais
        if ($senha !== $confirmaSenha) {
            echo "<script>alert('As senhas não coincidem.'); window.location.href='cadastroUsuario.php';</script>";
            exit; // Termina a execução do script
        }

        // Conecta ao banco de dados PostgreSQL
        $conn = pg_connect("host=localhost dbname=atlas user=postgres password=root");

        if (!$conn) {
            die("Erro na conexão com o banco de dados.");
        }

        // Verifica se o login já existe
        $query_select = "SELECT usuario FROM usuarios WHERE usuario = $1";
        $result = pg_query_params($conn, $query_select, array($login));

        if (!$result) {
            die("Erro na consulta ao banco de dados.");
        }

        $array = pg_fetch_assoc($result);
        $logarray = $array['usuario'] ?? null;

        if (empty($login)) {
            echo "<script>alert('O campo usuário deve ser preenchido'); window.location.href='cadastroUsuario.php';</script>";
            exit; // Termina a execução do script
        }

        if ($logarray == $login) {
            echo "<script>alert('Esse login já existe'); window.location.href='cadastroUsuario.php';</script>";
            exit; // Termina a execução do script
        } else {
            // Insere o novo usuário no banco de dados
            $hashedPassword = password_hash($senha, PASSWORD_DEFAULT); // Usar password_hash para segurança
            $query_insert = "INSERT INTO usuarios (usuario, senha) VALUES ($1, $2)";
            $insert = pg_query_params($conn, $query_insert, array($login, $hashedPassword));

            if ($insert) {
                echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='../login/login.php';</script>";
            } else {
                echo "<script>alert('Não foi possível cadastrar esse usuário'); window.location.href='cadastroUsuario.php';</script>";
            }
        }

        // Fecha a conexão com o banco
        pg_close($conn);
    }
    ?>

</body>
</html>
