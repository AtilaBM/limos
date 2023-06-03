<?php
    # Arquivo responsável por validar o casdastro

    session_start();
    include_once("../../objs/objetos.php");
    include('../../conexao.php'); # Importa os dados da conexão

    # Verifica se os campos foram preenchidos,
    # Caso não forem, redireciona o usuário para a página de cadastro
    if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['nome']) || empty($_POST['telefone']) || empty($_POST['password-confirm']) || empty($_POST['cep']) || empty($_POST['uf']) || empty($_POST['cidade']) || empty($_POST['bairro']) || empty($_POST['endereco'])){
        $_SESSION['dados_incompletos'] = true;
        header("Location: index.php");
    }else{
        # Declaração das variáveis

        # Para evitar ataque de mysql injection
        # Todas as variáveis passam pela função mysqli_real_escape_string()

        # Dados pessoais
        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
        $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
        $datareg = date("Y-m-d");

        # Endereço
        $cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
        $uf = mysqli_real_escape_string($conexao, trim($_POST['uf']));
        $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
        $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
        $logradouro = mysqli_real_escape_string($conexao, trim($_POST['endereco']));


        # As senhas são criptografadas em md5
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        $confirmaSenha = mysqli_real_escape_string($conexao, trim(md5($_POST['password-confirm']))); 

        # Fim da declaração das variáveis

        # Verifica se as senhas conhecidem,
        # Caso não conhecidam, redireciona para a página de cadastro
        if($senha != $confirmaSenha){

        $_SESSION['senha_errada'] = true; # Informa o usuário que as senhas não se conhecidem
        header('Location: index.php');
        exit;
        }
        # Fim da verificação das senhas

        # Verifica se o email já foi cadastrado no banco

        $sql = "select count(*) as total from cli where email_cli = '$email'";  # conta o total de registros no banco como "total" onde os emails forem iguais ao email enviado pelo cliente
        $result = mysqli_query($conexao, $sql); # Armazena o resultado da consulta mysql
        $row = mysqli_fetch_assoc($result); # Armazea o numero de linhas encontradas no resultado anterior

        # Como o email foi marcado no banco como sendo unique, só a necessidade de verificar se ele encontrou um único registro com o mesmo email

        if($row['total'] == 1){

            $_SESSION['email_existe'] = true; # Informa o usuário que o email já foi cadastrado
            header('Location: index.php'); # Redireciona ele para a página de cadastro
            exit;
        }
        # Fim da verificação de email

        # Início do cadastro do cliente no banco

        # Comando mysql que fará o cadastro
        # O status da conta foi definido para "4", o que indica que ainda falta para o usuário cadastrar os seus gostos e endereço.
        $sql = "INSERT INTO `cli`(`telefone_cli`, `status_conta_cli`, `email_cli`, `senha_cli`, `data_reg_cli`, `nome_cli`) VALUES ('$telefone', '4','$email','$senha','$datareg', '$nome')";

        # Tentativa de cadastrar o usuário no banco
        if($conexao->query($sql) === TRUE){


        # Cria o objeto cliente e o armazena na sessão

        # Busca os dados no banco
        $query = "SELECT * FROM `CLI` WHERE email_cli = '$email' and senha_cli = '$senha'";
        $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
        $row = mysqli_num_rows($result); # Armazena a quantidade de linhas que a consulta devolveu
        $usuario_bd = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta

        # Efetivamente cria os objetos na sessão
        $cliente = new cliente($usuario_bd["id_cli"], $usuario_bd["status_conta_cli"], $usuario_bd["nome_cli"], $usuario_bd["telefone_cli"], $usuario_bd["email_cli"], $usuario_bd["senha_cli"], $usuario_bd["data_reg_cli"], $usuario_bd["gostos_cli"]);
        $_SESSION['cliente'] = $cliente;
        # Fim da tentativa

        # Início do cadastro do endereço
        $id = $usuario_bd["id_cli"];
        $sql = "INSERT INTO `END`(`cidade_end`, `cep_end`, `logradouro_end`, `bairro_end`, `uf_end`, `id_cli`) VALUES ('$cidade','$cep','$logradouro','$bairro','$uf','$id')";
        if($conexao->query($sql) === TRUE){
            # Criação do objeto endereco
            $endereco = new endereco($cep, null, $logradouro, $bairro, $uf, "Brazil", $cidade, null);
            $_SESSION['endereco'] = $endereco;
            # Fecha a conexão e redireciona o usuário para a próxima etapa do cadastro
            $conexao -> close();
            header('Location: gostos.php');
            exit;
        }
        # Fim da tentativa
        }
        else{
            $_SESSION['erro_inesperado'] = true; # Informa o usuário que ocorreu um erro inesperado
            header('Location: index.php');
        }

        #Fim do cadastro
    }
?>
