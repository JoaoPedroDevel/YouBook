<?php
session_start(); // Inicia a sessão

// Destrói todas as informações da sessão
$_SESSION = array(); // Limpa todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona para a página de login
<<<<<<< HEAD
header('Location: ./login.php');
exit; // Finaliza o script
?>

=======
header('Location: ../login/login.php');
exit; // Finaliza o script
?>
>>>>>>> 57eba0b9743db83707b16e37fcdcd085186079ce
