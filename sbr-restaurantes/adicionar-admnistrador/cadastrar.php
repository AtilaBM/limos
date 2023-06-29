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
        $idRes = $_SESSION["restaurante"] -> id; 

        # Fim da declaração das variáveis

        # Verifica se as senhas conhecidem,
        if($senha != $confirmaSenha){
            $_SESSION['senha_errada'] = true; # Informa o usuário que as senhas não se conhecidem
            header('Location: index.php');
            exit;
        }
        # Fim da verificação das senhas

        # Verifica se o email já foi cadastrado no banco
        $sql = "select count(*) as total from admres where email_admres = '$email'";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result); 

        if($row['total'] == 1){

            $_SESSION['email_existe'] = true; # Informa o usuário que o email já foi cadastrado
            header('Location: index.php'); # Redireciona ele para a página de cadastro
            exit;
        }

        $sql = "INSERT INTO `sbr`.`admres` (`id_admres`, `id_res`, `nome_admres`, `email_admres`, `senha_admres`) VALUES (NULL, $idRes, '$nome', '$email', '$senha')";
        if($conexao->query($sql) === TRUE){
            $_SESSION['sucesso_adcionar_adm'] = true;
            header('Location: index.php');
        }else{
            $_SESSION['erro_conexao_banco'] = true;
            header('Location: index.php');
        }
    }
?>