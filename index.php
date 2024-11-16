<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>YouBook</title>
</head>
<body>
    <h1>Bem-vindo à Página Inicial!</h1> <a href="./index.php">YouBook</a>
    <h3>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>. O que você quer ler hoje?</h3>
    <form method="GET" action="">
        <label for="query">Buscar livro:</label>
        <input type="text" id="query" name="query" required>
        <button type="submit">Buscar</button>
    </form>
    <br>
    <a href="./login/logout.php"><button class="bt_sair">Sair</button></a>
    <br>

    <h2>Inserir Livro</h2>
    <form action="upload_pdf.php" method="post" enctype="multipart/form-data">
        <label for="titulo">Título do Livro</label>
        <input type="text" id="titulo" name="titulo" required><br>
        
        <label for="autor">Autor</label>
        <input type="text" id="autor" name="autor"><br>

        <label for="descricao">Descrição</label>
        <textarea id="descricao" name="descricao"></textarea><br>

        <label for="pdf">Arquivo PDF</label>
        <input type="file" id="pdf" name="pdf" accept=".pdf" required><br>

        <button type="submit">Enviar Livro</button>
    </form>

</body>
</html>

<?php
// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
    header('Location: ./login/login.php');
    exit;
}

// Incluir o arquivo de conexão com o banco de dados
include('./conexao/conectaBD.php');

// Conectar ao banco de dados PostgreSQL
$host = 'localhost';
$dbname = 'alpha';
$user = 'postgres';
$password = 'root';

$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}

// Verifica se foi enviado um termo de busca
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $_GET['query'];

    // Consulta para buscar livros no banco de dados
    $query_sql = "SELECT * FROM livros WHERE titulo ILIKE $1 OR autor ILIKE $1";
    $result = pg_query_params($conn, $query_sql, array("%$query%"));

    if ($result) {
        while ($livro = pg_fetch_assoc($result)) {
            echo "<h2>" . htmlspecialchars($livro['titulo']) . "</h2>";
            echo "<p><strong>Autor:</strong> " . htmlspecialchars($livro['autor']) . "</p>";
            echo "<p><strong>Descrição:</strong> " . htmlspecialchars($livro['descricao']) . "</p>";
            echo "<a href='" . htmlspecialchars($livro['pdf_url']) . "' target='_blank'>Visualizar PDF</a><br>";
            echo "<hr>";
        }
    } else {
        echo "Nenhum livro encontrado.";
    }
}

// Fecha a conexão com o banco
pg_close($conn);
?>
