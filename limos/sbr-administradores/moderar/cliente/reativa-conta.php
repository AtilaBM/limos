<?php
    include_once("../../../objs/objetos.php");;
    include('../../../conexao.php');
    session_start();

    $idCli = mysqli_real_escape_string($conexao, trim(isset($_GET["idCli"]) ? $_GET["idCli"] : 0));
    $location = "Location: index.php?"."idCli=".$idCli;
    $query = "UPDATE `cli` SET `status_conta_cli`='1' WHERE `id_cli`='$idCli';";
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