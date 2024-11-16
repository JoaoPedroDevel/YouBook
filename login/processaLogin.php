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

    // Verifique se o usuário foi encontrado
    if (!$usuarioEncontrado) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Debug: Verificar o que está sendo retornado do banco de dados
    var_dump($usuarioEncontrado); // REMOVE this line in production

    // Verifica se a senha está correta
    if ($usuarioEncontrado && password_verify($senha, $usuarioEncontrado['senha'])) {
        // Credenciais válidas
        $_SESSION['usuario_logado'] = true;
        
        // Verifica se o usuário é administrador
        if ($usuarioEncontrado['is_admin'] === true) {
            // Redireciona para o dashboard de administrador
            header('Location: ../super/dashboard.php');
            exit;
        } else {
            // Caso o usuário não seja admin, redireciona para a página principal
            header('Location: ../index.php');
            exit;
        }
    } else {
        // Debug: Verificar o que está acontecendo na comparação da senha
        echo "Senha incorreta. Senha verificada: " . $usuarioEncontrado['senha']; // REMOVE this line in production
        echo "Usuário ou senha incorretos.";
        include '../login/login.php'; // Inclui o formulário novamente
    }
} else {
    // Se não for um POST, redireciona para o formulário de login
    header('Location: ./login/login.php');
    exit;
}
?>
