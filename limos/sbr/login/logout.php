<?php
    #Arquivo responsável por deslogar o usuário
    session_start();
    session_destroy();
    header('Location: index.php'); # Redireciona para a página de login
    exit();
?>