<?php
    # Tem a função de verificar se o usuário está autenticado, 
    # caso ele não esteja, ele será redirecionado para a página de login
    include_once("../../objs/objetos.php");
    session_start();
    if(!$_SESSION['cliente']){
        header('Location: ../login/index.php');
        exit();
    }else{
        if($_SESSION['cliente']->statusConta == '4'){
            header('Location: ../cadastro/gostos.php');
        }
        if($_SESSION['cliente']->statusConta == '2'){
            header('Location: ../painel/reativar-conta.php');
        }
    }
?>