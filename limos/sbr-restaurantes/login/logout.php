<?php
    #Arquivo responsável por deslogar o usuário
    session_start();
    unset($_SESSION['admres']);
    unset($_SESSION['restaurante']);
    unset($_SESSION['enderecoRes']);
    header('Location: index.php'); # Redireciona para a página de login
    exit();
?>