<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
    // Usuário não está logado, redireciona para a página de login
    header('Location: ../login/login.php');
    exit; // Finaliza o script
}

// O restante do código da página index.php aqui...
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo à Página Inicial!</h1>
    <p>Você está logado como <?php echo htmlspecialchars($_SESSION['usuario']); ?>.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
