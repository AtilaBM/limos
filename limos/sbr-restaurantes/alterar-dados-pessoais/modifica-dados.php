<?php
    include_once("../../objs/objetos.php");;
    include('../../conexao.php');
    session_start();

    if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['password'])){
        $_SESSION['dados_incompletos-alterar-cliente'] = true;
        header("Location: index.php");
    }else{
        # Declaração das variáveis
        $idadmres = $_SESSION["admres"]->id;
        $nome = mysqli_real_escape_string($conexao, trim(isset($_POST["nome"]) ? $_POST["nome"] : "0"));
        $email = mysqli_real_escape_string($conexao, trim(isset($_POST["email"]) ? $_POST["email"] : "0"));
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        

        # Confirmar se a senha foi digitada corretamente
        if($senha == $_SESSION["admres"]->senha){
            # Confirmar se o e-mail digitada já foi utilizado por outro administrador
            if($email != $_SESSION["admres"]->email){
                $sql = "select count(*) as total from admres where email_admres = '$email'";
                $result = mysqli_query($conexao, $sql);
                $row = mysqli_fetch_assoc($result);
                if($row['total'] == 1){
        
                    $_SESSION['email_existe'] = true;
                    header('Location: index.php');
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
                    header('Location: index.php');
                    exit;
                }
            }
            # Fim da verificação

            # Atualizar os dados do admres
            $sql = "UPDATE `admres` SET `email_admres`='$email',`senha_admres`='$senha', `nome_admres`='$nome' WHERE `id_admres` = '$idadmres'";
            if($conexao->query($sql) === TRUE){
                $_SESSION["admres"]-> email = $email;
                $_SESSION["admres"]-> senha = $senha;
                $_SESSION["admres"]-> nome = $nome;
                header("Location: ../index.php");
                exit;
            }else{
                $_SESSION["ErroUpdadeDadosPessoais"] =  true;
                header("Location: index.php");
                exit;
            }
            # Fim da atualização
        
        }else{
            $_SESSION['senha-errada'] = true;
            header("Location: index.php");
            exit;
        }
    }
?>