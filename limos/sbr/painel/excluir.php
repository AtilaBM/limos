<?php
    include_once("../../objs/objetos.php");;
    include('../../conexao.php'); # Importa os dados da conexão
    session_start();

  
    if(empty($_POST['password']) || empty($_POST['del'])){
        $_SESSION['dados_incompletos-excluir'] = true;
        header("Location: index.php");
    }else{
        # Declaração das variáveis
        $idcli = $_SESSION["cliente"]->id;
        $del = mysqli_real_escape_string($conexao, trim(isset($_POST["del"]) ? $_POST["del"] : "0"));
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        


        # Confirmar se a senha foi digitada corretamente
        if($senha == $_SESSION["cliente"]->senha){

            # Verificar a o del
            switch($del){
                case 1:
                    # desativa a conta do cliente
                    $sql = "UPDATE `cli` SET `status_conta_cli` = 2  WHERE id_cli = '$idcli'";
                    if($conexao->query($sql) === TRUE){
                        $_SESSION["cliente"]-> statusConta = 2;
                        header("Location: ../login/logout.php");
                        exit;
                    }else{
                        $_SESSION["ErroBancoDel"] =  true;
                        header("Location: index.php");
                        exit;
                    }
                case 2:
                    # Exclui a conta do cliente
                    $sql1 = "DELETE FROM `coment` WHERE id_cli = '$idcli';";
                    $sql2 = "DELETE FROM `end` WHERE id_cli = '$idcli';";
                    $sql3 = "DELETE FROM `cli` WHERE id_cli = $idcli;";
                    if($conexao->query($sql1) === TRUE and $conexao->query($sql2) === TRUE and $conexao->query($sql3) === TRUE){
                        $_SESSION["SucessoDel"] =  true;
                        header("Location: ../login/logout.php");
                        exit;
                    }else{
                        $_SESSION["ErroBancoDel"] =  true;
                        header("Location: index.php");
                        exit;
                    }
                default:
                    $_SESSION['del-opt-indef'] = true;
                    header("Location: index.php");
                    break;
            }
            # Fim da verificação    
        }else{
            $_SESSION['senha-errada-excluir'] = true;
            header("Location: index.php");
        }
    }
?>