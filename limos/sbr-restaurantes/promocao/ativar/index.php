<?php
    include_once("../../../objs/objetos.php");;
    include('../../../conexao.php'); # Importa os dados da conexão
    session_start();

    $idres = $_SESSION["restaurante"]->id;
    $sql = "UPDATE `ad` SET `status_ad`='1' WHERE `id_res`='$idres'";
    if($conexao->query($sql) === TRUE){
        header("Location: ../index.php");
        exit;
    }else{
        $_SESSION["ErroConexaoReativarAd"] = true;
        header("Location: index.php");
        exit;
    }
?>