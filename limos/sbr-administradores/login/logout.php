<?php
    #Arquivo responsável por deslogar o usuário
    session_start();
    unset($_SESSION['admsis']);
    header('Location: index.php'); # Redireciona para a página de login
    exit();
?>