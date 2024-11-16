<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
    header('Location: ./login/login.php');
    exit;
}

// Incluir o arquivo de conexão com o banco de dados
include('./conexao/conectaBD.php'); // Verifique se o caminho está correto

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

// Consulta para buscar todos os livros
$query = "SELECT * FROM livros";
$result = pg_query($conn, $query);

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

// Fecha a conexão com o banco
pg_close($conn);
?>
