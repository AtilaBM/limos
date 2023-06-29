<?php
    include_once("../../objs/objetos.php");
    include('../../conexao.php'); # Importa os dados da conexão
    session_start();

    # Declaração das variáveis
    
    $doce = mysqli_real_escape_string($conexao, trim(isset($_POST["doce"]) ? $_POST["doce"] : "3"));
    $salgado = mysqli_real_escape_string($conexao, trim(isset($_POST["salgado"]) ? $_POST["salgado"] : "3"));
    $churrasco = mysqli_real_escape_string($conexao, trim(isset($_POST["churrasco"]) ? $_POST["churrasco"] : "3"));
    $fastfood = mysqli_real_escape_string($conexao, trim(isset($_POST["fastfood"]) ? $_POST["fastfood"] : "3"));
    $pizza = mysqli_real_escape_string($conexao, trim(isset($_POST["pizza"]) ? $_POST["pizza"] : "3"));
    $sushi = mysqli_real_escape_string($conexao, trim(isset($_POST["sushi"]) ? $_POST["sushi"] : "3"));
    $brasil = mysqli_real_escape_string($conexao, trim(isset($_POST["brasil"]) ? $_POST["brasil"] : "3"));
    $italia = mysqli_real_escape_string($conexao, trim(isset($_POST["italia"]) ? $_POST["italia"] : "3"));
    $franca = mysqli_real_escape_string($conexao, trim(isset($_POST["franca"]) ? $_POST["franca"] : "3"));
    $asia = mysqli_real_escape_string($conexao, trim(isset($_POST["asia"]) ? $_POST["asia"] : "3"));
    $arabe = mysqli_real_escape_string($conexao, trim(isset($_POST["arabe"]) ? $_POST["arabe"] : "3"));
    $id = $_SESSION["cliente"]->id;
    $string = $doce."-".$salgado."-".$churrasco."-".$fastfood."-".$pizza."-".$sushi."-".$brasil."-".$italia."-".$franca."-".$asia."-".$arabe;
    $_SESSION["cliente"]->gostos = $string;
    # Fim da declaração de variáveis

    # Início da tentativa de registro das informações do banco
    $sql = "UPDATE `sbr`.`cli` SET `gostos_cli` = '$string',`status_conta_cli`=1 WHERE `cli`.`id_cli` ='$id';";
    if($conexao->query($sql) === TRUE){
        $_SESSION["cliente"]-> statusConta = 1;
        header("Location: ../painel");
    }else{
        $_SESSION["ErroCadGostos"] = TRUE;
        header("Location: index.php");
    }

?>