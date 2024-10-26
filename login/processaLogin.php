<?php
session_start(); // Inicia a sessão

include './conectaBD.php'; // Inclui o arquivo de conexão


// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Prepara a consulta para buscar o usuário pelo nome
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    
    $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado e a senha está correta
    if ($usuarioEncontrado && password_verify($senha, $usuarioEncontrado['senha'])) {
        // Credenciais válidas
        $_SESSION['usuario_logado'] = true;
        header('Location: ../index.php'); // Redireciona para a página principal
        exit;
    } else {
        // Credenciais inválidas
        echo "Usuário ou senha incorretos.";
        include '../login/login.php'; // Inclui o formulário novamente
    }
} else {
    // Se não for um POST, redireciona para o formulário de login
    header('Location: ../login/login.php');
    exit;
}
?>
