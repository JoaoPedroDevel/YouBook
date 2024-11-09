<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
    // Usuário não está logado, redireciona para a página de login
    header('Location: ./login/login.php');
    exit; // Finaliza o script
}

// O restante do código da página index.php aqui...
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
</body>
</html>

<?php
// Chave de API do Google Books (substitua pela sua chave real)
$apiKey = 'AIzaSyDjCby-f2VH41HqHShaKg249oHK_WlvgmU';

// Verifica se foi enviado um termo de busca
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = urlencode($_GET['query']);
    
    // URL da API do Google Books
    $url = "https://www.googleapis.com/books/v1/volumes?q=$query&key=$apiKey";

    // Inicializa cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decodifica a resposta JSON
    $data = json_decode($response, true);
    
    // Verifica se houve resultados
    if (isset($data['items'])) {
        foreach ($data['items'] as $book) {
            $title = $book['volumeInfo']['title'] ?? 'Título não disponível';
            $authors = implode(', ', $book['volumeInfo']['authors'] ?? ['Autor desconhecido']);
            $description = $book['volumeInfo']['description'] ?? 'Descrição não disponível';

            echo "<h2>$title</h2>";
            echo "<p><strong>Autores:</strong> $authors</p>";
            echo "<p><strong>Descrição:</strong> $description</p>";
            echo "<hr>";
        }
    } else {
        echo "Nenhum livro encontrado.";
    }
}
?>


   

