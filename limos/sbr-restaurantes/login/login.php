<?php
    # Arquivo responsável por validar o login

    include('../../conexao.php'); # Importa os dados da conexão
    include_once("../../objs/objetos.php"); # Importa os objetos relacionados ao Restaurante
    session_start();

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
    $query = "SELECT * FROM `admres` WHERE email_admres = '$email' and senha_admres = '$senha'";
    $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
    $row = mysqli_num_rows($result); # Armazena a quantidade de linhas que a consulta devolveu
    $usuario_bd = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta

    # Verifica se a consulta retornou somente uma linha
    if($row == 1){

        # Declaração das variáveis
        $admres = new admres($usuario_bd["id_admres"], $usuario_bd["nome_admres"], $usuario_bd["email_admres"], $usuario_bd["senha_admres"]); # Objeto importado na linha 6
        $_SESSION['admres'] = $admres;
        $idres = $usuario_bd["id_res"];

        # Montar o Objeto do restaurante
        $query = "SELECT * FROM `res` WHERE id_res = '$idres'";
        $result = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($result);
        $restaurante_bd = mysqli_fetch_assoc($result); 
        $res = new restaurante($restaurante_bd["id_res"],$restaurante_bd["nome_res"],$restaurante_bd["tipo_res"],$restaurante_bd["dia_hora_func_res"],$restaurante_bd["encomenda_res"],$restaurante_bd["entrega_res"],$restaurante_bd["telefone_res"],$restaurante_bd["desc_res"],$restaurante_bd["cardapio_res"],$restaurante_bd["cnpj_res"], $restaurante_bd["fotos_res"], $restaurante_bd["nota_res"], $restaurante_bd["status_conta_res"], $restaurante_bd["whatsapp_res"], $restaurante_bd["instagram_res"]);
        $_SESSION['restaurante'] = $res; # Armazena o objeto na seção

        # Monta o objeto do endereco
        $query = "SELECT * FROM `END` WHERE id_res = '$idres'";
        $result = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($result);
        $endereco_bd = mysqli_fetch_assoc($result); 
        $_SESSION['enderecoRes'] = new endereco($endereco_bd["cep_end"], $endereco_bd["num_end"], $endereco_bd["logradouro_end"], $endereco_bd["bairro_end"], $endereco_bd["uf_end"], $endereco_bd["pais_end"], $endereco_bd["cidade_end"], $endereco_bd["id_end"]);
        
        # Redireciona o usuário logado para para o painel
        header('Location: ../index.php');
        exit();
    }else{
        $_SESSION['nao_autenticado'] = true;
        header('Location: index.php');
        exit();
    }
?>