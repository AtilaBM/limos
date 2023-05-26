<?php
    include_once("../../objs/objetos.php");;
    include('../../conexao.php'); # Importa os dados da conexão
    session_start();

    # Verifica se os campos foram preenchidos,
    # Caso não forem, redireciona o usuário para a página de cadastro
    if(empty($_POST['nome']) || empty($_POST['desc']) || empty($_POST['nome']) || empty($_POST['dia_hora_func']) || empty($_POST['cep']) || empty($_POST['uf']) || empty($_POST['cidade']) || empty($_POST['bairro']) || empty($_POST['endereco']) || empty($_POST['numero'])){
        $_SESSION['dados_incompletos'] = true;
        header("Location: modificarestaurante.php");
    }else{
        # Declaração das variáveis
        $idres = $_SESSION["restaurante"]->id;
        $admresid = $_SESSION["admres"]->id;
        $nome = mysqli_real_escape_string($conexao, trim(isset($_POST["nome"]) ? $_POST["nome"] : "0"));
        $desc = mysqli_real_escape_string($conexao, trim(isset($_POST["desc"]) ? $_POST["desc"] : "0"));
        $dia_hora_func = mysqli_real_escape_string($conexao, trim(isset($_POST["dia_hora_func"]) ? $_POST["dia_hora_func"] : "0"));
        $cardapio = mysqli_real_escape_string($conexao, trim(isset($_POST["cardapio"]) ? $_POST["cardapio"] : "0"));
        $entrega = mysqli_real_escape_string($conexao, trim(isset($_POST["entrega"]) ? $_POST["entrega"] : "2"));
        $encomenda = mysqli_real_escape_string($conexao, trim(isset($_POST["encomenda"]) ? $_POST["encomenda"] : "2"));

        # Endereço
        $cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
        $uf = mysqli_real_escape_string($conexao, trim($_POST['uf']));
        $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
        $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
        $logradouro = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
        $numero = mysqli_real_escape_string($conexao, trim($_POST['numero']));

        # Imagem do restaurante
        if(isset($_FILES['imagem']) and $_FILES['imagem']['size'] > 0)
        {
            # Descobrir a extenção da imagem
            if(strtolower($_FILES['imagem']['name'][0]) == "p"){
                $ext = ".png";
            }else{
                $ext = ".jpg";
            }
            # A imagem receberá um nome composto pelo id do adm, a data e a extenção da imagem
            $imagem = $admresid . "-". date("Y.m.d-H.i.s") . $ext;
            $dir = '../../img/restaurantes/'; //Diretório para uploads 
            move_uploaded_file($_FILES['imagem']['tmp_name'], $dir.$imagem); //Fazer upload do arquivo
            
            # Atualizar a imagem
            $sql = "UPDATE `res` SET `fotos_res`='$imagem' WHERE `id_res`='$idres'";
            if($conexao->query($sql) === TRUE){
                $_SESSION["restaurante"]-> fotos = $imagem;
            }else{
                $_SESSION["ErroUpdadeImagem"] =  true;
                header("Location: ../index.php");
            }
        }

        # Imagem do cardápio
        if(isset($_FILES['cardapio']) and $_FILES['cardapio']['size'] > 0)
        {
            # Descobrir a extenção da imagem
            if(strtolower($_FILES['cardapio']['name'][0]) == "p"){
                $ext = ".png";
            }else{
                $ext = ".jpg";
            }
            # A imagem receberá um nome composto pelo id do adm, a data e a extenção da imagem
            $cardapio = "cardapio-" . $admresid . "-". date("Y.m.d-H.i.s") . $ext;
            $dir = '../../img/restaurantes/'; //Diretório para uploads 
            move_uploaded_file($_FILES['cardapio']['tmp_name'], $dir.$cardapio); //Fazer upload do arquivo
            
            # Atualizar a imagem
            $sql = "UPDATE `res` SET `cardapio_res`='$cardapio' WHERE `id_res`='$idres'";
            if($conexao->query($sql) === TRUE){
                $_SESSION["restaurante"]-> cardapio = $cardapio;
            }else{
                $_SESSION["ErroUpdadeImagemCardapio"] =  true;
                header("Location: ../index.php");
            }
        }

        # Telefones
        $telefone = mysqli_real_escape_string($conexao, trim(isset($_POST["tel"]) ? $_POST["tel"] : "Não possui"));
        $instagram = mysqli_real_escape_string($conexao, trim(isset($_POST["insta"]) ? $_POST["insta"] : "Não possui"));
        $whatsapp = mysqli_real_escape_string($conexao, trim(isset($_POST["whats"]) ? $_POST["whats"] : "Não possui"));

        # Tipo do Restaurante
        $tipo = mysqli_real_escape_string($conexao, trim(isset($_POST["tipo"]) ? $_POST["tipo"] : "7"));
        # Fim da declaração de variáveis

        # Início do cadastro do endereço

        $sql = "UPDATE `END` SET `cep_end`='$cep',`num_end`='$numero',`logradouro_end`='$logradouro',`bairro_end`='$bairro',`uf_end`='$uf',`cidade_end`='$cidade',`id_res`='$idres' WHERE `id_res`='$idres'";
        if($conexao->query($sql) === TRUE){
            # Criação do objeto endereco
            $endereco = new endereco($cep, $numero, $logradouro, $bairro, $uf, "Brazil", $cidade, null);
            $_SESSION['enderecoRes'] = $endereco;
        }else{
            $_SESSION["updateEndereco"] = TRUE;
            header("Location: modificarestaurante.php");
        }
        # Fim da tentativa

        # Início da tentativa de registro das informações do restaurante no banco
        $sql = "UPDATE `res` SET `nome_res`='$nome',`tipo_res`='$tipo',`dia_hora_func_res`='$dia_hora_func',`encomenda_res`='$encomenda',`entrega_res`='$entrega',`telefone_res`='$telefone',`desc_res`='$desc',`status_conta_res`='1', `whatsapp_res`='$whatsapp',`instagram_res`='$instagram' WHERE `id_res`='$idres'";
        if($conexao->query($sql) === TRUE){
            # Updade dos dados da sessão
            $_SESSION["restaurante"]-> statusContaRes = 1;
            $_SESSION["restaurante"]-> nome = $nome;
            $_SESSION["restaurante"]-> tipo = $tipo;
            $_SESSION["restaurante"]-> encomenda = $encomenda;
            $_SESSION["restaurante"]-> entrega = $entrega;
            $_SESSION["restaurante"]-> telefones = $telefone;
            $_SESSION["restaurante"]-> descricao = $desc;
            $_SESSION["restaurante"]-> diahorafunc = $dia_hora_func;
            $_SESSION["restaurante"]-> whatsapp = $whatsapp;
            $_SESSION["restaurante"]-> instagram = $instagram;

            # Início da tentativa de atualizar o CNPJ
            if(isset($_POST["cnpj"])){
                $cnpj = mysqli_real_escape_string($conexao, trim(isset($_POST["cnpj"]) ? $_POST["cnpj"] : "NULL"));

                if($cnpj != $_SESSION['restaurante']->cnpj){
                    if(strlen($cnpj)>0){
                        # Verifica se o cnpj já foi cadastrado no banco
    
                        $sql = "select count(*) as total from res where cnpj_res = '$cnpj'";  # conta o total de registros no banco como "total" onde os cnpjs forem iguais ao cnpj enviado pelo cliente
                        $result = mysqli_query($conexao, $sql); # Armazena o resultado da consulta mysql
                        $row = mysqli_fetch_assoc($result); # Armazena o número de linhas encontradas no resultado anterior
    
                        # Como o cnpj foi marcado no banco como sendo unique, só a necessidade de verificar se ele encontrou um único registro com o mesmo cnpj
    
                        if($row['total'] > 0){
    
                            $_SESSION['cnpj_existe'] = true; # Informa o usuário que o cnpj já foi cadastrado
                            header('Location: modificarestaurante.php'); # Redireciona ele para a página de cadastro
                            exit;
                        }
                        $sql = "UPDATE `res` SET `cnpj_res`='$cnpj' WHERE `id_res`='$idres'";
                        if($conexao->query($sql) === TRUE){
                            $_SESSION["restaurante"]->cnpj = $cnpj;
                            header("Location: ../index.php");
                        }else{
                            $_SESSION["ErroUpdadeCnpj"] = TRUE;
                            header("Location: modificarestaurante.php");
                        }
                    }
                }
            }
            # Fim da tentativa
            header("Location: ../index.php");
        }else{
            $_SESSION["ErroUpdadeDadosRestaurante"] = TRUE;
            header("Location: modificarestaurante.php");
        }
        # Fim da tentativa

    }
?>