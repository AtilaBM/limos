<?php
    include_once("../../../objs/objetos.php");
    include('../../../conexao.php');
    session_start();

    if(empty($_POST['inicio']) || empty($_POST['fim'])){
        $_SESSION['dados_incompletos'] = true;
        header("Location: ../index.php");
    }else{
        $inicio = mysqli_real_escape_string($conexao, trim($_POST['inicio']));
        $fim = mysqli_real_escape_string($conexao, trim($_POST['fim']));
        $idres = $_SESSION["restaurante"]->id;

        $sql = "select count(*) as total from ad where id_res = '$idres'"; 
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);
        $ad  = new ad(null, $idres, $inicio, $fim, 1, 2);

        if($row['total'] == 1){
            $sql = "UPDATE `ad` SET `data_inicio_ad`='$inicio',`data_fim_ad`='$fim',`status_ad`='1',`status_pag_ad`='2' WHERE `id_res`='$idres'";
            if($conexao->query($sql) === TRUE){
                $_SESSION['sucesso_ad'] = true; 
                header('Location: ../index.php');
            }
            else{
                $_SESSION['erro_conexao_ad'] = true; 
                header('Location: ../index.php');
            }
            exit;
        }


        if($ad->status_ad == 1){
            $sql = "INSERT INTO `ad`(`data_inicio_ad`, `data_fim_ad`, `status_ad`, `id_res`) VALUES ('$inicio','$fim',1,'$idres')";
            if($conexao->query($sql) === TRUE){
                $_SESSION['sucesso_ad'] = true; 
                header('Location: ../index.php');
            }
            else{
                $_SESSION['erro_conexao_ad'] = true; 
                header('Location: ../index.php');
            }
        }else{
            $_SESSION['erro_data_ad'] = true; 
            header('Location: ../index.php');
        }

        #Fim do cadastro
    }
?>