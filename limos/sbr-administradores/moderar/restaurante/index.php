<?php
include_once("../../../objs/objetos.php");
include_once("../../../conexao.php");
session_start();
include_once("../../../avisos.php");
include("../../../layout/header.php");

$idres = mysqli_real_escape_string($conexao, trim(isset($_GET["idRes"]) ? $_GET["idRes"] : 0));
# Montar o Objeto do restaurante
$query = "SELECT * FROM `res` WHERE id_res = '$idres'";
$result = mysqli_query($conexao, $query);
$restaurante_bd = mysqli_fetch_assoc($result);
$res = new restaurante($restaurante_bd["id_res"], $restaurante_bd["nome_res"], $restaurante_bd["tipo_res"], $restaurante_bd["dia_hora_func_res"], $restaurante_bd["encomenda_res"], $restaurante_bd["entrega_res"], $restaurante_bd["telefone_res"], $restaurante_bd["desc_res"], $restaurante_bd["cardapio_res"], $restaurante_bd["cnpj_res"], $restaurante_bd["fotos_res"], $restaurante_bd["nota_res"], $restaurante_bd["status_conta_res"], $restaurante_bd["whatsapp_res"], $restaurante_bd["instagram_res"]);
$imagem = $res->fotos;
$cardapio = $res->cardapio;

# Monta o objeto do endereco do restaurante
$query = "SELECT * FROM `END` WHERE id_res = '$idres'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);
$endereco_bd = mysqli_fetch_assoc($result);
$enderecoRes = new endereco($endereco_bd["cep_end"], $endereco_bd["num_end"], $endereco_bd["logradouro_end"], $endereco_bd["bairro_end"], $endereco_bd["uf_end"], $endereco_bd["pais_end"], $endereco_bd["cidade_end"], $endereco_bd["id_end"]);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/boot.css">
    <link rel="stylesheet" href="../../../css/admsis/mod_res.css">
    <title><?php echo $res->nome; ?> - Limos</title>
</head>
<!-- header -->
<header class="main_header">
    <div class="main_header_content">
        <div class="img_logo">
            <a href="../../index.php" class="logo">
                <img src="../../../img/limos_branco.png" alt="Bem vindo ao projeto Limos" title="Bem vindo ao projeto Limos"></a>
        </div>

        <nav class="main_header_content_menu">
            <div class="menu_a_inportant">
                <a href="../index.php?status=3&filtro=" class="cadastro_menu "><i class="fas fa-arrow-left"></i></a>
            </div>
        </nav>
    </div>
</header>
<!-- header -->

<body>
    <main>
        <section class="informacoes-res boot">
            <article class="info-res-container ">
                <header>
                    <h1>
                        <?php
                        echo $res->nome;
                        if ($res->statusContaRes == 3) {
                            echo " - BANIDO";
                        }
                        ?>
                    </h1>
                </header>
        
        
                <div class="info-res-img">
                    <h2>Fotos</h2>
                    <div class="group-img">
                        <img src="../../../img/restaurantes/<?php echo $imagem ?>" alt="imagem do Restaurante">
                        <img src="../../../img/restaurantes/<?php echo $cardapio ?>" alt="imagem do cardápio">
                    </div>
                </div>
                <div class="info-res-content">
                    <h2>Dados</h2>
                    <h3>Status</h3>
                    <p><?php echo $res->nota() ?></p>
                    <p>Status da conta: <?php echo $res->statusContaRes; ?></p>
                    
                    <h3>Funcionamento</h3>
                    <p><?php echo $res->diahorafunc; ?></p>
                    <h3>Entregas e encomendas</h3>
                    <ul>
                        <li>Fazemos entregas? <?php echo $res->entrega(0, 2); ?></li>
                        <li>fazemos encomendas? <?php echo $res->encomenda(0, 2); ?></li>
                    </ul>
                    <h3>Contato</h3>
                    <p class="iconp"> <i class="fas fa-mobile"></i>Telefone: <?php echo $res->telefones; ?></p>
                    <p class="iconp"> <i class="fab fa-whatsapp"></i>WhatsApp: <?php echo $res->whatsapp; ?></p>
                    <p class="iconp"> <i class="fab fa-instagram"></i>Instagram: <a target="_blank" href="https://www.instagram.com/<?php echo $res->instagram; ?>">@<?php echo $res->instagram; ?></a></p>
                    <h3>Localização</h3>
                    <address><?php echo $enderecoRes->logradouro . " Nº " . $enderecoRes->numero; ?></address>
                    <h3>Descrição</h3>
                    <p><?php echo $res->descricao; ?></p>
                    <h2>Administradores</h2>
                    <?php
                    $query = 'SELECT * FROM admres WHERE id_res = ' . $idres . '';
                    $result = mysqli_query($conexao, $query);
                    $row = mysqli_num_rows($result);
                    if ($row >= 1) {
                        foreach ($result as $admres) {
                            $admres2 = new admres($admres["id_admres"], $admres["nome_admres"], $admres["email_admres"], $admres["senha_admres"]);
                            echo '<div class="">';
                            echo "<h4>" . $admres2->nome . "</h4>";
                            echo "<p>Id da Conta: " . $admres2->id . "</p>";
                            echo "<p>E-mail: " . $admres2->email . "</p>";
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
                <div class="info-res-promocoes">
                    <h2>Promoções</h2>
                    <?php
                    $query = 'SELECT * FROM `ad` WHERE id_res = ' . $idres . ';';
                    $result = mysqli_query($conexao, $query);
                    $row = mysqli_num_rows($result);
                    if ($row >= 1) {
                        $ad_bd = mysqli_fetch_assoc($result);
                        $ad = new ad($ad_bd["id_ad"], $ad_bd["id_res"], $ad_bd["data_inicio_ad"], $ad_bd["data_fim_ad"], $ad_bd["status_ad"], $ad_bd["status_pag_ad"]);
                        $ad->id_res = $ad_bd["id_res"];
                        if ($ad->status_ad == 1) {
                            if ($ad->atualizaAdBanco($conexao)) {
                                if ($ad->status_pag_ad == 2) {
                                    echo "<h2>Pagamento Pendente</h2>";
                                } else {
                                    echo "<h2>Promoção Ativa<h2>";
                                }
                                echo "<h3>Data prevista de início da promoção</h3>";
                                echo "<p>" . $ad->formata_data_ad(1) . "</p>";
                                echo "<h3>Data finalização da promoção</h3>";
                                echo "<p>" . $ad->formata_data_ad(2) . "</p>";
                            } else {
                                echo "<h2>Promoção Finalizada<h2>";
                                echo "<h3>Data de início da promoção</h3>";
                                echo "<p>" . $ad->formata_data_ad(1) . "</p>";
                                echo "<h3>Data de finalização da promoção</h3>";
                                echo "<p>" . $ad->formata_data_ad(2) . "</p>";
                            }
                        } else {
                            echo "<h2>Promoção Finalizada<h2>";
                            echo "<h3>Data de início da promoção</h3>";
                            echo "<p>" . $ad->formata_data_ad(1) . "</p>";
                            echo "<h3>Data de finalização da promoção</h3>";
                            echo "<p>" . $ad->formata_data_ad(2) . "</p>";
                        }
                    } else {
                        echo "<p>O restaurante não está sendo promovido no momento.</p>";
                    }
                    ?>
                </div>
                <div class="info-res-buttons">
                    <?php
                    if ($res->statusContaRes != 3) {
                        
                        echo '<a href="banir-conta/index.php?idRes=' . $restaurante_bd["id_res"] . '">Banir o restaurante</a>';
                    } else {
                        
                        echo '<a href="reativa-conta.php?idRes=' . $restaurante_bd["id_res"] . '">Reativar o restaurante</a>';
                    }
                    ?>
                </div>
            </article>
        </section>
        
        
        
        <section class="comentarios boot">
            <article class="coment-content">
                <?php
                $query = 'SELECT * FROM `coment` WHERE id_res = ' . $idres . ' ORDER BY data_coment, id_coment;';
                $result = mysqli_query($conexao, $query);
                $row = mysqli_num_rows($result);
                if ($row >= 1) {
                    //Testa se retornou dados e abre um for para listar
                    echo '<div class="comentario_cli">';
                    foreach ($result as $com) {
                        $comentario = new coment($com['id_coment'], $com['id_cli'], $com['id_res'], $com['coment_coment'], $com['data_coment'], $com['nota_coment']);
                        # Consulta se o email e a senha digitados conhecidem com alguma entrada no banco de dados
                        $idCliCom = $comentario->id_cli;
                        $query = "SELECT nome_cli FROM `CLI` WHERE id_cli = '$idCliCom'";
                        $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
                        $nomeCli = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta
                        echo '<div class="coment_cli_content">';
                        echo '<div class="info_coment_cli1">';
                        echo '<h3>' . "Enviado por" . " " . $nomeCli["nome_cli"] . '</h3>';
                        echo '<p>' . $comentario->nota_coment . " Estrelas - " . $comentario->data_coment . '</p>';
                        echo '</div>';
                        echo '<div class="info_coment_cli2">';
                        echo '<p>' . $comentario->coment . '</p>';
                        echo '</div>';
                        echo '<a href="../cliente/index.php?idCli=' . $idCliCom . '"class="link_res">Ver mais sobre o cliente</a><br>';
                        echo '</div>'; //coment_cli_content
                    }
                    echo '</div>'; //comentario_cli
                } else {
                    echo "<p>Ninguém comentou esse restaurante ainda.</p>";
                }
                ?>
            </article>
        </section>
    </main>
    <?php include("../../../layout/footer.php"); ?>
</body>

</html>