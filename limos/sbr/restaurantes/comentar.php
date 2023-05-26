<?php
    include_once("../../objs/objetos.php");
    include('../../conexao.php'); # Importa os dados da conexão
    session_start();

    # Declaração de variáveis

    $idRes = mysqli_real_escape_string($conexao, trim(isset($_POST["idRes"]) ? $_POST["idRes"] : 1)); #id do restaurate
    $headerLocation = 'Location: index.php?idRes='.$idRes;  #string contento as informações para a localização do header

    # Função responsável por atualizar a nota dos restaurantes

    function atualizaNotaRes($idRes, $conexao){

        $sql = "select * from coment where id_res = '$idRes'"; 
        $result = mysqli_query($conexao, $sql);
        $row = 0;
        $notaTemp2 = 0;

        # Pega todas as notas e faz o seu somatório
        foreach($result as $nota){
            $notaTemp1 = $nota['nota_coment'];   
            $row += 1;
            $notaTemp2 += $notaTemp1;           
        }
        # Divide a soma total pelo número de resultados, caso não haja nenhum, garante que não haverá divissão por 0
        if($row != 0){
            $notaFinal = $notaTemp2 / $row;
        }else{
            $notaFinal = $notaTemp2;
        }
        # Faz o update da nota do restaurante
        $notaFinal = number_format($notaFinal, 2, '.', ',');
        $sql = "UPDATE `res` SET `nota_res`='$notaFinal' WHERE id_res = '$idRes'";
        $result = mysqli_query($conexao, $sql);
    }

    # Verificar se o usuário está logado
    if(isset($_SESSION['cliente'])){
        # Verifica se os campos foram preenchidos,
        # Caso não forem, redireciona o usuário para a página de cadastro
        if(empty($_POST['nota']) || empty($_POST['coment'])){
            $_SESSION['comentario_incompleto'] = true;
            header($headerLocation);
        }else{
            # Descobrir se o cliente já avaliou o restaurante

            # Declaração de variáveis
            $idCli = $_SESSION["cliente"]->id;
            $coment = mysqli_real_escape_string($conexao, trim(isset($_POST["coment"]) ? $_POST["coment"] : null));
            $nota = mysqli_real_escape_string($conexao, trim(isset($_POST["nota"]) ? $_POST["nota"] : 5));
            $data = date("Y.m.d");
            $sql = "select count(*) as total from coment where id_cli = '$idCli' and id_res = '$idRes'"; 
            $result = mysqli_query($conexao, $sql);
            $row = mysqli_fetch_assoc($result); 
    
            if($row['total'] > 0){

                # Início da tentativa de atualizar comentário no banco
                $sql = "UPDATE `coment` SET `nota_coment`='$nota',`data_coment`='$data',`coment_coment`='$coment' WHERE id_cli = '$idCli' and id_res = '$idRes';";
                if($conexao->query($sql) === TRUE){
                    atualizaNotaRes($idRes, $conexao);
                    header($headerLocation);
                }else{
                    $_SESSION["ErroAtualizarComent"] = TRUE;
                    header($headerLocation);
                }
            }else{

                # Início da tentativa de registro do novo comentário no banco
                $sql = "INSERT INTO `coment`(`id_cli`, `id_res`, `nota_coment`, `data_coment`, `coment_coment`) VALUES ('$idCli','$idRes','$nota','$data','$coment')";
                if($conexao->query($sql) === TRUE){
                    atualizaNotaRes($idRes, $conexao);
                    header($headerLocation);
                }else{
                    $_SESSION["ErroCadComent"] = TRUE;
                    header($headerLocation);
                }
            }
        }
    }else{
        $_SESSION['falha_autenticacao_cliente_comentar'] = true; # Informa o usuário que é necessário estar logado para poder comentar
        header($headerLocation);
        exit;
    }
?>