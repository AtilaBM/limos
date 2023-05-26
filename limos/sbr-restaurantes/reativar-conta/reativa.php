<?php
    include_once("../../objs/objetos.php");;
    include('../../conexao.php'); # Importa os dados da conexão
    session_start();

    $idcli = $_SESSION["cliente"]->id;

    # Reativa a conta do cliente
    $sql = "UPDATE `cli` SET `status_conta_cli` = 1  WHERE id_cli = '$idcli'";
    if($conexao->query($sql) === TRUE){
        $_SESSION["cliente"]-> statusConta = 1;
        header("Location: index.php");
        exit;
    }else{
        $_SESSION["ErroAtivarConta"] =  true;
        header("Location: reativar-conta.php");
        exit;
    }
?>