<?php
    # Tem a função de verificar se o usuário está autenticado, 
    # caso ele não esteja, ele será redirecionado para a página de login
    session_start();
    if(!$_SESSION['admsis']){
        header('Location: login/index.php');
        exit();
    }
?>