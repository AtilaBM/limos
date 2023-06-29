<?php
    include_once("../../objs/objetos.php");
    include('../../conexao.php'); 
    session_start();

    if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['nome']) || empty($_POST['password-confirm'])){
        $_SESSION['dados_incompletos'] = true;
        header("Location: index.php");
    }else{
        # Declaração das variáveis

        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        $confirmaSenha = mysqli_real_escape_string($conexao, trim(md5($_POST['password-confirm'])));

        # Fim da declaração das variáveis

        # Verifica se as senhas conhecidem,
        if($senha != $confirmaSenha){
            $_SESSION['senha_errada'] = true; # Informa o usuário que as senhas não se conhecidem
            header('Location: index.php');
            exit;
        }
        
        $novoAdmsis = new admsis(null, $nome, $email, $senha);
        if($novoAdmsis->cadastro($conexao)){
            $_SESSION['sucesso_adcionar_adm'] = true;
            header('Location: index.php');
            exit;
        }else{
            $_SESSION['erro_conexao_banco'] = true;
            header('Location: index.php');
            exit;
        }
    }
?>