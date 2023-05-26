<?php
    include_once("../../../../objs/objetos.php");;
    include('../../../../conexao.php');
    session_start();

    $idCli = mysqli_real_escape_string($conexao, trim(isset($_POST["idCli"]) ? $_POST["idCli"] : 0));
    $location = "Location: index.php?"."idCli=".$idCli;

  
    if(empty($_POST['password'])){
        $_SESSION['dados_incompletos-banir'] = true;
        header($location);
        exit;
    }else{
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        
        
        if($senha == $_SESSION["admsis"]->senha_admsis){
            $query = "UPDATE `cli` SET `status_conta_cli`='3' WHERE `id_cli`='$idCli';";
            if($conexao->query($query) == TRUE){
                $_SESSION["SucessoBan"] =  true;
                $location = "Location: ../index.php?"."idCli=".$idCli;
                header($location);
                exit;
            }else{
                $_SESSION["ErroBancoBan"] =  true;
                header($location);
                exit;
            }
        }else{
            $_SESSION['senha-errada-banir'] = true;
            header($location);;
            exit;
        }
    }
?>