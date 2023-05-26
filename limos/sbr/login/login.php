<?php
    # Arquivo responsável por validar o login

    session_start();
    include('../../conexao.php'); # Importa os dados da conexão
    include_once("../../objs/objetos.php"); # Importa os objetos relacionados ao cliente

    # Verifica se os campos de e-mail e senha foram preenchidos,
    # Caso não forem, redireciona o usuário para a página de login
    if(empty($_POST['email']) || empty($_POST['password'])){
        $_SESSION['incompleto'] = true;
        header('Location: index.php');
        exit();
    }

    # Declaração das variáveis

    $email = mysqli_real_escape_string($conexao,trim( $_POST['email'])); 
    $senha = mysqli_real_escape_string($conexao, md5(trim($_POST['password'])));

    # Consulta se o email e a senha digitados conhecidem com alguma entrada no banco de dados
    $query = "SELECT * FROM `CLI` WHERE email_cli = '$email' and senha_cli = '$senha'";
    $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
    $row = mysqli_num_rows($result); # Armazena a quantidade de linhas que a consulta devolveu
    $usuario_bd = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta

    # Verifica se a consulta retornou somente uma linha
    if($row == 1){

        # Declaração das variáveis
        $cliente = new cliente; # Objeto importado na linha 6
        $cliente -> dataRes = $usuario_bd["data_reg_cli"];
        $cliente -> id = $usuario_bd["id_cli"];
        $cliente -> telefone = $usuario_bd["telefone_cli"];
        $cliente -> gostos = $usuario_bd["gostos_cli"];
        $cliente -> nome = $usuario_bd["nome_cli"];
        $cliente -> statusConta = $usuario_bd["status_conta_cli"];
        $cliente -> emailSetter($usuario_bd["email_cli"]);
        $cliente -> passwordSetter($usuario_bd["senha_cli"]);
        $_SESSION['cliente'] = $cliente;

        # Monta o objeto do endereco
        $query = "SELECT * FROM `END` WHERE id_cli = '$cliente->id'";
        $result = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($result);
        $endereco_bd = mysqli_fetch_assoc($result); 
        $endereco = new endereco($endereco_bd["cep_end"], null, $endereco_bd["logradouro_end"],  $endereco_bd["bairro_end"], $endereco_bd["uf_end"], $endereco_bd["pais_end"], $endereco_bd["cidade_end"], $endereco_bd["id_end"]);
        $_SESSION['endereco'] = $endereco;
        
        
        # Redireciona o usuário logado para para o painel
        header('Location: ../painel/index.php');
        exit();
    }else{
        $_SESSION['nao_autenticado'] = true;
        header('Location: index.php');
        exit();
    }
?>