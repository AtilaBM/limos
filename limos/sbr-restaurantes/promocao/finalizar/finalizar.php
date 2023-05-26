<?php
    include_once("../../../objs/objetos.php");;
    include('../../../conexao.php'); # Importa os dados da conexão
    session_start();

  
    if(empty($_POST['password'])){
        $_SESSION['dados_incompletos-excluir'] = true;
        header("Location: ../promover/index.php");
    }else{
        $idres = $_SESSION["restaurante"]->id;
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        
        # Confirmar se a senha foi digitada corretamente
        if($senha == $_SESSION["admres"]->senha){
            $sql = "UPDATE `ad` SET `status_ad`='2' WHERE `id_res`='$idres'";
            if($conexao->query($sql) === TRUE){
                header("Location: ../index.php");
                exit;
            }else{
                $_SESSION["ErroConexaoFinalizarAd"] = true;
                header("Location: ../promover/index.php");
                exit;
            }
        }else{
            $_SESSION['senha-errada-excluir'] = true;
            header("Location: ../promover/index.php");
        }
    }
?>