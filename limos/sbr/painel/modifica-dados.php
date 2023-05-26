<?php
    include_once("../../objs/objetos.php");;
    include('../../conexao.php'); # Importa os dados da conexão
    session_start();

    # Verifica se os campos foram preenchidos,
    # Caso não forem, redireciona o usuário para a página de de alterar dados
    if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['telefone']) || empty($_POST['cep']) || empty($_POST['uf']) || empty($_POST['cidade']) || empty($_POST['bairro']) || empty($_POST['endereco'])){
        $_SESSION['dados_incompletos-alterar-cliente'] = true;
        header("Location: alterar-dados.php");
    }else{
        # Declaração das variáveis
        $idcli = $_SESSION["cliente"]->id;
        $nome = mysqli_real_escape_string($conexao, trim(isset($_POST["nome"]) ? $_POST["nome"] : "0"));
        $telefone = mysqli_real_escape_string($conexao, trim(isset($_POST["telefone"]) ? $_POST["telefone"] : "0"));
        $email = mysqli_real_escape_string($conexao, trim(isset($_POST["email"]) ? $_POST["email"] : "0"));
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        

        # Endereço
        $cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
        $uf = mysqli_real_escape_string($conexao, trim($_POST['uf']));
        $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
        $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
        $logradouro = mysqli_real_escape_string($conexao, trim($_POST['endereco']));

        # Confirmar se a senha foi digitada corretamente
        if($senha == $_SESSION["cliente"]->senha){
            # Confirmar se o e-mail digitada já foi utilizado por outro cliente
            if($email != $_SESSION["cliente"]->email){
                $sql = "select count(*) as total from cli where email_cli = '$email'";
                $result = mysqli_query($conexao, $sql);
                $row = mysqli_fetch_assoc($result);
                if($row['total'] == 1){
        
                    $_SESSION['email_existe'] = true;
                    header('Location: alterar-dados.php');
                    exit;
                }
            }
            # Fim da confirmação
        
            # Verificar se uma nova senha foi digitada
            if($_POST["newPassword"] != null){
                if($_POST["newPassword"] == $_POST["newPasswordConfirm"]){
                    $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['newPassword'])));
                }else{
                    $_SESSION['senha_errada'] = true;
                    header('Location: alterar-dados.php');
                    exit;
                }
            }
            # Fim da verificação

            # Atualizar os dados do cliente
            $sql = "UPDATE `cli` SET `telefone_cli`='$telefone',`email_cli`='$email',`senha_cli`='$senha', `nome_cli`='$nome' WHERE `id_cli` = '$idcli'";
            if($conexao->query($sql) === TRUE){
                $_SESSION["cliente"]-> telefone = $telefone;
                $_SESSION["cliente"]-> email = $email;
                $_SESSION["cliente"]-> senha = $senha;
                $_SESSION["cliente"]-> nome = $nome;
            }else{
                $_SESSION["ErroUpdadeDadosPessoais"] =  true;
                header("Location: alterar-dados.php");
                exit;
            }
            # Fim da atualização

            # Atualizar os dados do endereco
            $sql = "UPDATE `end` SET `cep_end`='$cep', `logradouro_end`='$logradouro',`bairro_end`='$bairro',`uf_end`='$uf',`cidade_end`='$cidade' WHERE id_cli = '$idcli'";
            if($conexao->query($sql) === TRUE){
                $_SESSION["endereco"] = new endereco($cep, null, $logradouro, $bairro, $uf, "Brazil", $cidade, $_SESSION["endereco"]->id);
                header("Location: index.php");
                exit;
            }else{
                $_SESSION["ErroUpdadeDadosPessoaisEndereco"] =  true;
                header("Location: alterar-dados.php");
                exit;
            }
            # Fim da atualização
        
        }else{
            $_SESSION['senha-errada'] = true;
            header("Location: alterar-dados.php");
        }
    }
?>