<?php
include_once("../../../objs/objetos.php");
include_once("../../../conexao.php");
session_start();
include_once("../../../avisos.php");
include("../../../layout/header.php");

$idCli = mysqli_real_escape_string($conexao, trim(isset($_GET["idCli"]) ? $_GET["idCli"] : 0));
# Montar o Objeto do restaurante
$query = "SELECT * FROM `cli` WHERE id_cli = '$idCli'";
$result = mysqli_query($conexao, $query);
$cli = mysqli_fetch_assoc($result);
$cli2 = new cliente();
$cli2->id = $cli["id_cli"];
$cli2->nome = $cli["nome_cli"];
$cli2->statusConta = $cli["status_conta_cli"];
$cli2->email = $cli["email_cli"];
$cli2->telefone = $cli["telefone_cli"];
$cli2->dataRes = $cli["data_reg_cli"];
$cli2->gostos = $cli["gostos_cli"];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/boot.css">
    <link rel="stylesheet" href="../../../css/admsis/mod_cli.css">
    <title><?php echo $cli2->nome; ?> - Limos</title>
</head>

<body>
    <main>
        <!-- info cliente -->
        <section class="info_cliente boot">
           
            <article class="info_cli_container">
                <header>
                    <h1>Dados</h1>
                </header>
                
                <div class="info_cli_box">
                    <div class="info_cli_box_groups">
                        <h3>Nome:</h3>
                        <p><?php echo $cli2->nome; ?></p>
                    </div>
                    <div class="info_cli_box_groups">
                        <h3>telefone:</h3>
                        <p><?php echo $cli2->telefone; ?></p>
                    </div>
                    <div class="info_cli_box_groups">
                        <h3>ID:</h3>
                        <p><?php echo $cli2->id; ?></p>
                    </div>
                    <div class="info_cli_box_groups">
                        <h3>Email:</h3>
                        <p><?php echo $cli2->email; ?></p>
                    </div>
                    <div class="info_cli_box_groups">
                        <h3>Data de Registro:</h3>
                        <p><?php echo $cli2->dataRes; ?></p>
                    </div>
                    <div class="info_cli_box_groups">
                        <h3>Status da Conta:</h3>
                        <p><?php echo $cli2->statusConta; ?></p>
                    </div>
                </div>
                
               <div class="info_cli_buttons">
                   <?php
                    if ($cli2->statusConta != 3) {
                        echo "<h1>Banir cliente</h1>";
                        echo '<a href="banir-conta/index.php?idCli=' . $cli2->id . '">Banir o cliente</a>';
                    } else {
                        echo "<h1>Reativar conta do cliente</h1>";
                        echo '<a href="reativa-conta.php?idCli=' . $cli2->id . '">Reativar a conta do cliente</a>';
                    }
                    ?>
               </div>
            </article>
        </section>
        <!-- info cliente -->
        <!-- comentarios -->
        <section class="comentarios boot">
            <header>
                <h1>Comentários Feitos</h1>
            </header>
            <div class="coment-content">
                <?php
                $query = 'SELECT * FROM `coment` WHERE id_cli = ' . $idCli . ' ORDER BY data_coment, id_coment;';
                $result = mysqli_query($conexao, $query);
                $row = mysqli_num_rows($result);
                if ($row >= 1) {
                    //Testa se retornou dados e abre um for para listar
                    echo '<div class="comentario_cli">';
                    foreach ($result as $com) {
                        $comentario = new coment($com['id_coment'], $com['id_cli'], $com['id_res'], $com['coment_coment'], $com['data_coment'], $com['nota_coment']);
                        $idResCom = $comentario->id_res;
                        $query = "SELECT nome_res FROM `res` WHERE id_res = '$idResCom'";
                        $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
                        $nomeRes = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta
                        echo '<div class="coment_cli_content">';
                        echo '<div class="info_coment_cli1">';
                        echo '<h3>' . "Referente ao restaurante" . " " . $nomeRes["nome_res"] . '</h3>';
                        echo '<p>' . $comentario->nota_coment . " Estrelas - " . $comentario->data_coment . '</p>';
                        echo '</div>';
                        echo '<div class="info_coment_cli2">';
                        echo '<p>' . $comentario->coment . '</p>';
                        echo '</div>';
                        echo '<a href="../restaurante/index.php?idRes=' . $com["id_res"] . '">Ver mais sobre o restaurante</a><br>';
                        echo '</div>'; //coment_cli_content
                    }
                    echo '</div>'; //comentario_cli
                } else {
                    echo "<p>Esse cliente ainda não realizou nenhum comentário.</p>";
                }
                ?>
            </div>
        </section>
        <!-- comentarios -->
    </main>
    <?php include("../../../layout/footer.php"); ?>
</body>

</html>