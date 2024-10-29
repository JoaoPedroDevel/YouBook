<?php
session_start(); // Inicia a sessão

// Destrói todas as informações da sessão
$_SESSION = array(); // Limpa todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona para a página de login
header('Location: ../login/login.php');
exit; // Finaliza o script
?>
