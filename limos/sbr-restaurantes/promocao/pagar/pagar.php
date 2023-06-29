<?php
    include_once("../../../objs/objetos.php");
    include('../../../conexao.php');
    session_start();

    if(empty($_POST['nome']) || empty($_POST['cnpj']) || empty($_POST['numero']) || empty($_POST['validade']) || empty($_POST['cvv']) || empty($_POST['parcela'])){
        $_SESSION['dados_incompletos'] = true;
        header("Location: index.php");
    }else{
        $nome = mysqli_real_escape_string($conexao, trim(isset($_POST["nome"]) ? $_POST["nome"] : "0"));
        $cnpj = mysqli_real_escape_string($conexao, trim(isset($_POST["cnpj"]) ? $_POST["cnpj"] : "0"));
        $numero = mysqli_real_escape_string($conexao, trim(isset($_POST["numero"]) ? $_POST["numero"] : "0"));
        $parcela = mysqli_real_escape_string($conexao, trim(isset($_POST["parcela"]) ? $_POST["parcela"] : "0"));
        $validade = mysqli_real_escape_string($conexao, trim(isset($_POST["validade"]) ? $_POST["validade"] : "0"));
        $cvv = mysqli_real_escape_string($conexao, trim(isset($_POST["cvv"]) ? $_POST["cvv"] : "0"));
        $idres = $_SESSION["restaurante"]->id;

        $hoje = explode("-", date("Y-m-d"));
        $fim_validade = explode("-", $validade);
        $ptsFim = ($fim_validade[0] * 365) + ($fim_validade[1] * 30) + $fim_validade[2];
        $ptsHoje = ($hoje[0] * 365) + ($hoje[1] * 30) + $hoje[2];
        if($ptsHoje > $ptsFim){
            $_SESSION['cartao_vencido'] = true; 
            header('Location: index.php');
            exit;
        }

        $sql = "UPDATE `ad` SET `status_pag_ad`='1' WHERE `id_res`='$idres'";
            if($conexao->query($sql) === TRUE){
                $_SESSION['sucesso_pag_ad'] = true; 
                header('Location: ../index.php');
            }
            else{
                $_SESSION['erro_conexao_pag_ad'] = true; 
                header('Location: index.php');
            }

        #Fim do cadastro
    }
?>