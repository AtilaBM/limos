<?php
    # Arquivo responsável por validar o cadastro

    session_start();
    include_once("../../objs/objetos.php"); # Contem os objetos do sistema
    include('../../conexao.php'); # Importa os dados da conexão

    # Verifica se os campos foram preenchidos,
    # Caso não forem, redireciona o usuário para a página de cadastro
    if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['nome']) || empty($_POST['password-confirm'])){
        $_SESSION['dados_incompletos'] = true;
        header("Location: index.php");
    }else{
        # Declaração das variáveis

        # Dados pessoais
        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $email = mysqli_real_escape_string($conexao, trim($_POST['email']));

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

        $sql = "select count(*) as total from admres where email_admres = '$email'";  # conta o total de registros no banco como "total" onde os emails forem iguais ao email enviado pelo cliente
        $result = mysqli_query($conexao, $sql); # Armazena o resultado da consulta mysql
        $row = mysqli_fetch_assoc($result); # Armazena o número de linhas encontradas no resultado anterior

        # Como o email foi marcado no banco como sendo unique, só a necessidade de verificar se ele encontrou um único registro com o mesmo email

        if($row['total'] == 1){

            $_SESSION['email_existe'] = true; # Informa o usuário que o email já foi cadastrado
            header('Location: index.php'); # Redireciona ele para a página de cadastro
            exit;
        }
       
        # Tentativa de cadastrar o restaurante no banco
        $sql = "INSERT INTO `res`(`nome_res`, `tipo_res`, `dia_hora_func_res`, `encomenda_res`, `entrega_res`, `telefone_res`, `desc_res`, `cardapio_res`, `cnpj_res`, `fotos_res`, `nota_res`, `status_conta_res`, `whatsapp_res`, `instagram_res`) VALUES ('$email',1,'Temporário',1,1,'Temporário','Temporário','default.png',NULL,'default.png','0',4 , 'Temporário', 'Temporário')";
        if($conexao->query($sql) === TRUE){

            # Busca os dados no banco
            $query = "SELECT * FROM `res` WHERE nome_res = '$email'"; # O nome do restaurante é temporário cadastrado como sendo o e-mail do administrador
            $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
            $row = mysqli_num_rows($result); # Armazena a quantidade de linhas que a consulta devolveu
            $restaurante_bd = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta

            # Efetivamente cria os objetos na sessão
            $res = new restaurante($restaurante_bd["id_res"],$restaurante_bd["nome_res"],$restaurante_bd["tipo_res"],$restaurante_bd["dia_hora_func_res"],$restaurante_bd["encomenda_res"],$restaurante_bd["entrega_res"],$restaurante_bd["telefone_res"],$restaurante_bd["desc_res"],$restaurante_bd["cardapio_res"],$restaurante_bd["cnpj_res"], $restaurante_bd["fotos_res"], $restaurante_bd["nota_res"], $restaurante_bd["status_conta_res"], $restaurante_bd["whatsapp_res"], $restaurante_bd["instagram_res"]);
            $_SESSION['restaurante'] = $res; # Armazena o objeto na seção
            $idRes = $restaurante_bd["id_res"];
            # Fim do cadastro do restaurante no banco

            # Início do cadastro do endereço
            $sql = "INSERT INTO `END`(`cep_end`, `num_end`, `logradouro_end`, `bairro_end`, `uf_end`, `cidade_end`, `pais_end`, `id_res`) VALUES ('temp', 'temp', 'temp', 'temp', 'temp', 'temp', 'Brazil', $idRes)";
            if($conexao->query($sql) === TRUE){
                # Criação do objeto endereco
                $endereco = new endereco($cep, $num, $logradouro, $bairro, $uf, "Brazil", $cidade, $id);
                $_SESSION['enderecoRes'] = $endereco;
                # Fecha a conexão e redireciona o usuário para a próxima etapa do cadastro
            }else{
                $_SESSION['erroCadEnd'] = true; # Informa o usuário que ocorreu um erro
                header('Location: index.php');
            }
            # Fim da tentativa

            # Tentativa de cadastrar o admnistrador de restaurante no banco

            $sql = "INSERT INTO `sbr`.`admres` (`id_admres`, `id_res`, `nome_admres`, `email_admres`, `senha_admres`) VALUES (NULL, $idRes, '$nome', '$email', '$senha')";
            if($conexao->query($sql) === TRUE){

                # Busca os dados no banco
                $query = "SELECT * FROM `admres` WHERE email_admres = '$email' and senha_admres = '$senha'";
                $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
                $row = mysqli_num_rows($result); # Armazena a quantidade de linhas que a consulta devolveu
                $usuario_bd = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta
    
                # Efetivamente cria os objetos na sessão
                $admres = new admres($usuario_bd["id_admres"], $usuario_bd["nome_admres"], $usuario_bd["email_admres"], $usuario_bd["senha_admres"]);
                $_SESSION['admres'] = $admres; # Armazena o objeto na sessão
                # Fim da tentativa
                header('Location: modificarestaurante.php');
            }else{
                $_SESSION['erro_inesperado_2'] = true; # Informa o usuário que ocorreu um erro inesperado
                header('Location: index.php');
            }

        }
        else{
            $_SESSION['erro_inesperado_1'] = true; # Informa o usuário que ocorreu um erro inesperado
            header('Location: index.php');
        }

        #Fim do cadastro
    }
?>