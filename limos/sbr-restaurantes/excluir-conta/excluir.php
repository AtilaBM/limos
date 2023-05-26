<?php
    include_once("../../objs/objetos.php");;
    include('../../conexao.php'); # Importa os dados da conexão
    session_start();

  
    if(empty($_POST['password'])){
        $_SESSION['dados_incompletos-excluir'] = true;
        header("Location: ../index.php");
    }else{
        # Declaração das variáveis
        $idadmres = $_SESSION["admres"]->id;
        $idres = $_SESSION["restaurante"]->id;
        $senha = mysqli_real_escape_string($conexao, trim(md5($_POST['password'])));
        
        # Confirmar se a senha foi digitada corretamente
        if($senha == $_SESSION["admres"]->senha){

            # Verificar se o restaurante possui mais de um administrador
            $query = 'SELECT * FROM `admres` WHERE id_res = '.$idres.';';
            $result = mysqli_query($conexao, $query);
            $row = mysqli_num_rows($result);
            if($row > 1){
                # Exclui a conta do admnistrador
                $sql = "DELETE FROM `admres` WHERE id_admres = '$idadmres';";
                if($conexao->query($sql) === TRUE){
                    $_SESSION["SucessoDel"] =  true;
                    header("Location: ../login/logout.php");
                    exit;
                }else{
                    $_SESSION["ErroBancoDel"] =  true;
                    header("Location: ../index.php");
                    exit;
                }
            }else{
                # Exclui a conta o restaurante
                $sql1 = "DELETE FROM `coment` WHERE id_res = '$idres';";
                $sql2 = "DELETE FROM `end` WHERE id_res = '$idres';";
                $sql3 = "DELETE FROM `ad` WHERE id_res = '$idres';";
                $sql4 = "DELETE FROM `admres` WHERE id_res = $idres;";
                $sql5 = "DELETE FROM `res` WHERE id_res = '$idres';";
                if($conexao->query($sql1) === TRUE and $conexao->query($sql2) === TRUE and $conexao->query($sql3) === TRUE and $conexao->query($sql4) === TRUE and $conexao->query($sql5) === TRUE){
                    $_SESSION["SucessoDel"] =  true;
                    header("Location: ../login/logout.php");
                    exit;
                }else{
                    $_SESSION["ErroBancoDel"] =  true;
                    header("Location: ../index.php");
                    exit;
                }
            }   
        }else{
            $_SESSION['senha-errada-excluir'] = true;
            header("Location: ../index.php");
        }
    }
?>