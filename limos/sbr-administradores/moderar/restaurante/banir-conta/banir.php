<?php
    include_once("../../../../objs/objetos.php");;
    include('../../../../conexao.php');
    session_start();

    $idRes = mysqli_real_escape_string($conexao, trim(isset($_POST["idRes"]) ? $_POST["idRes"] : 0));
    $location = "Location: index.php?"."idRes=".$idRes;

  
    if(empty($_POST['password'])){
        $_SESSION['dados_incompletos-banir'] = true;
        header($location);
        exit;
    }else{
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        
        
        if($senha == $_SESSION["admsis"]->senha_admsis){
            $query = "UPDATE `res` SET `status_conta_res`='3' WHERE `id_res`='$idRes';";
            if($conexao->query($query) == TRUE){
                $_SESSION["SucessoBan"] =  true;
                $location = "Location: ../index.php?"."idRes=".$idRes;
                header($location);
                exit;
            }else{
                $_SESSION["ErroBancoBan"] =  true;
                header($location);
                exit;
            }
        }else{
            $_SESSION['senha-errada-banir'] = true;
            header($location);
            exit;
        }
    }
?>