<?php
session_start();

if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
    // Usuário não está logado, redireciona para a página de login
    header('Location: ./login/login.php');
    exit; // Finaliza o script
}

// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'alpha';
$user = 'postgres';
$password = 'root';

$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

// Consulta os livros
$query_select = "SELECT * FROM livros";
$result = pg_query($conn, $query_select);

if ($result) {
    while ($book = pg_fetch_assoc($result)) {
        $titulo = $book['titulo'];
        $autor = $book['autor'];
        $descricao = $book['descricao'];
        $pdfUrl = $book['pdf_url'];

        echo "<h2>$titulo</h2>";
        echo "<p><strong>Autor:</strong> $autor</p>";
        echo "<p><strong>Descrição:</strong> $descricao</p>";
        echo "<a href='$pdfUrl' target='_blank'>Ler PDF</a>";
        echo "<hr>";
    }
} else {
    echo "Nenhum livro encontrado.";
}

pg_close($conn);
?>

