<?php
    include_once("../../../objs/objetos.php");;
    include('../../../conexao.php');
    session_start();

    $idRes = mysqli_real_escape_string($conexao, trim(isset($_GET["idRes"]) ? $_GET["idRes"] : 0));
    $location = "Location: index.php?"."idRes=".$idRes;
    $query = "UPDATE `res` SET `status_conta_res`='1' WHERE `id_res`='$idRes';";
    if($conexao->query($query) == TRUE){
        $_SESSION["SucessoDesBan"] =  true;
        header($location);
        exit;
    }else{
        $_SESSION["ErroBancoBan"] =  true;
        header($location);
        exit;
    }
?>