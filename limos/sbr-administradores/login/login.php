<?php
    include('../../conexao.php');
    include_once("../../objs/objetos.php");
    session_start();

    if(empty($_POST['email']) || empty($_POST['password'])){
        $_SESSION['incompleto'] = true;
        header('Location: index.php');
        exit();
    }

    # Declaração das variáveis
    $email = mysqli_real_escape_string($conexao,trim( $_POST['email'])); 
    $senha = mysqli_real_escape_string($conexao, md5(trim($_POST['password'])));

    $admsis = new admsis(null, null, $email, $senha);
    if($admsis->login($conexao)){
        header('Location: ../index.php');
        exit();
    }else{
        $_SESSION['nao_autenticado'] = true;
        header('Location: index.php');
        exit();
    }
?>