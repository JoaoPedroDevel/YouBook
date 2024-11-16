<?php
session_start(); // Inicia a sessão
include('./conexao/conectaBD.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
    // Usuário não está logado, redireciona para a página de login
    header('Location: ./login/login.php');
    exit;
}

if ($_SESSION['is_admin'] === true) {
    echo "<h2>Área de administração</h2>";
    echo "<p>Inserir e excluir usuários aqui</p>";

    // Aqui você pode adicionar os formulários ou funcionalidades extras para administradores
    echo "<form action='inserir_usuario.php' method='POST'>
            <label for='novo_usuario'>Novo Usuário:</label>
            <input type='text' name='novo_usuario' required>
            <button type='submit'>Adicionar Usuário</button>
          </form>";
    
    echo "<form action='excluir_usuario.php' method='POST'>
            <label for='usuario_excluir'>Excluir Usuário:</label>
            <input type='text' name='usuario_excluir' required>
            <button type='submit'>Excluir Usuário</button>
          </form>";
} else {
    // Se o usuário não for admin, exibe uma mensagem
    header('Location: ./login/login.php');
}

?>
/*
$email = 'usuario@exemplo.com';

// Consulta SQL para verificar se o usuário é administrador
$sql = "SELECT is_admin FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verificando se o usuário foi encontrado e se é administrador
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['is_admin']) {
        echo "Acesso concedido ao dashboard.";
        // Redirecionar ou mostrar o conteúdo do dashboard
    } else {
        echo "Acesso negado. Usuário não é administrador.";
    }
} else {
    echo "Usuário não encontrado.";
}

// Fechar a conexão
$stmt->close();
$conn->close();
*/