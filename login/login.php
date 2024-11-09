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

    <?php

session_start(); // Inicia a sessão

include '../conexao/conectaBD.php'; // Inclui o arquivo de conexão

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recebe dados do formulário
        $usuario = $_POST['usuario'] ?? null;
        $senha = $_POST['senha'] ?? null;

        // Conecta ao banco de dados PostgreSQL
        $conn = pg_connect("host=localhost dbname=atlas user=postgres password=root");

        if (!$conn) {
            die("Erro na conexão com o banco de dados.");
        }

        // Consulta para verificar se o usuário existe
        $query_select = "SELECT usuario, senha FROM usuarios WHERE usuario = $1";
        $result = pg_query_params($conn, $query_select, array($usuario));

        if (!$result) {
            die("Erro na consulta ao banco de dados.");
        }

        $array = pg_fetch_assoc($result);
        $userArray = $array ?? null;

<<<<<<< HEAD
            // Verifica se o usuário foi encontrado e a senha está correta
        if ($userArray && md5($senha) === $userArray['senha']) {
=======
        // Verifica se o usuário foi encontrado e a senha está correta
        if ($userArray && password_verify($senha, $userArray['senha'])) {
>>>>>>> 57eba0b9743db83707b16e37fcdcd085186079ce
            // Credenciais válidas
            session_start();
            $_SESSION['usuario_logado'] = true;
            $_SESSION['usuario'] = $usuario; // Armazena o nome do usuário na sessão
<<<<<<< HEAD
            echo "<script>alert('Logado com Sucesso!');</script>";
=======
            echo "<script>altert('Logado com Sucesso!'); </script>";
>>>>>>> 57eba0b9743db83707b16e37fcdcd085186079ce
            header('Location: ../index.php'); // Redireciona para a página principal
            exit;
        } else {
            // Credenciais inválidas
            echo "<script>alert('Usuário ou senha incorretos.'); window.location.href='login.php';</script>";
        }

<<<<<<< HEAD

=======
>>>>>>> 57eba0b9743db83707b16e37fcdcd085186079ce
        // Fecha a conexão com o banco
        pg_close($conn);
    }
    ?>

    <div>
    <p>Não tem Cadastro?</p>
    <a href="../cadastro/cadastroUsuario.php"><button>Clique Aqui!</button></a>
    </div>

</body>
</html>