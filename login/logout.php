<?php
session_destroy(); // Destroi a sessão

// Redireciona para a página de login
header('Location: ./login.php');
exit; // Finaliza o script
?>
?>
