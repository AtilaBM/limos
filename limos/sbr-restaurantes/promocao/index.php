<?php
include_once("../../objs/objetos.php");
include_once("../../conexao.php");
include("../../layout/header.php");
include("../layout_res/menu_index.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/sbr_res/promocao/index.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title><?php echo $_SESSION["restaurante"]->nome; ?> - Promoção Limos</title>
</head>

<body>
    <main>
        <section>
            <?php

$query = 'SELECT * FROM `ad` WHERE id_res = ' . $_SESSION["restaurante"]->id . ';';
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

if ($row >= 1) {
    $ad_bd = mysqli_fetch_assoc($result);
    $ad = new ad($ad_bd["id_ad"], $ad_bd["id_res"], $ad_bd["data_inicio_ad"], $ad_bd["data_fim_ad"], $ad_bd["status_ad"], $ad_bd["status_pag_ad"]);
    $ad->id_res = $ad_bd["id_res"];
    if ($ad->status_ad == 1) {
        if ($ad->atualizaAdBanco($conexao)) {
            echo '<article class="main_promotion">';

            echo '<header>';
            echo '<h1>Promoções</h1>';
            echo '</header>';

            echo '<div class="main_promotion_content">'; //main_promotion_content
            if ($ad->status_pag_ad == 2) {

                echo "<h2>Pagamento Pendente*</h2>";
                echo '<a href="pagar/index.php" class="group_butao">Pagar</a>';
            }
            else {
                echo "<h2>Promoção Ativa</h2>";
            }
            echo '<div class="group_promo">';
            echo "<h3>Data de início da promoção</h3>";
            echo "<p>" . $ad->formata_data_ad(1) . "</p>";
            echo '</div>';

            echo '<div class="group_promo">';
            echo "<h3>Data finalização da promoção</h3>";
            echo "<p>" . $ad->formata_data_ad(2) . "</p>";
            echo '</div>';

            echo '<button id="myBtn" class="group_butao">Finalizar Promoção</button>';
            //inicio modal
            echo '
                        <div id="myModal" class="modal">
                            <div class="modal-content">

                            <header>
                            <h1 id="final_promo">Finalizar promoção</h1>
                            <a class="close">
                            <i class="fas fa-times-circle"></i>
                            </a>
                           </header>

                        <form class="form_cadastro" action="../promocao/finalizar/finalizar.php" method="post" autocomplete="off">
                            <div class="form_cadastro_content">
                                <div class="form_cadastro_input_grupo">
                                    <div class="form_cadastro_input_box">
                                        <label for="password">Confirme a sua senha</label>
                                        <input type="password" name="password" id="password" required>
                                    </div>
                                    <?php
                                    include("../../../avisos.php");
                                    ?>
                                    <input class="butao_proximo" type="submit" value="Confirmar" onclick="return confirm("Tem certeza de que deseja desativar a promoção do seu restaurante? Nenhum valor sera reembolsado!!!")">
                                </div>
                             </div>
                            </div>
                        </div>
                        </form>';
        //Fim modal
        }
        else {
            echo '<article class="main_promotion">';
            echo '<div class="main_promotion_content">'; //main_promotion_content
            echo '<div class="group_promo">';
            echo "<h2>Promoção Finalizada</h2>";
            echo "<h3>Data de início da promoção</h3>";
            echo "<p>" . $ad->formata_data_ad(1) . "</p>";
            echo '</div>';

            echo '<div class="group_promo">';
            echo "<h3>Data de finalização da promoção</h3>";
            echo "<p>" . $ad->formata_data_ad(2) . "</p>";
            echo '</div>';
            if ($ad->valida_inicio_fim()) {
                echo '<a href="ativar/index.php" class="group_butao">Ativar Promoção</a>';
            }
            else {
                echo '<a href="promover/promover.php" class="group_butao">Criar nova Promoção</a>';
            }
        }
        echo '</div>'; //main_promotion_content
        echo '</article>'; //main_promotion
    }
    else {
        echo '<article class="main_promotion">';
        echo '<div class="main_promotion_content">'; //main_promotion_content

        echo '<div class="group_promo">';
        echo "<h2>Promoção Finalizada</h2>";
        echo "<h3>Data de início da promoção</h3>";
        echo "<p>" . $ad->formata_data_ad(1) . "</p>";
        echo '</div>';

        echo '<div class="group_promo">';
        echo "<h3>Data de finalização da promoção</h3>";
        echo "<p>" . $ad->formata_data_ad(2) . "</p>";
        echo '</div>';
        if ($ad->valida_inicio_fim()) {
            echo '<a href="ativar/index.php" class="group_butao">Ativar Promoção</a>';
        }
        else {
            echo '<a href="promover/promover.php" class="group_butao">Criar nova Promoção</a>';
        }
        echo '</div>'; //main_promotion_content
        echo '</article>'; //main_promotion
    }
}
else {
    echo '<article class="main_promotion">';
    echo '<div class="main_promotion_content">'; //main_promotion_content

    echo '<div class="group_promo">';
    echo "<h2>Promover restaurante</h2>";
    echo "<p>Seu restaurante não está sendo promovido no momento.</p>";
    echo '</div>';
    echo '<a id="myBtn2" class="group_butao">Iniciar uma promoção</a>';
    // modal2
    echo ' <div id="myModal2" class="modal">
                <div class="modal-content"> 
                
                <header>
                <h1 id="final_promo">Período de Promoção</h1>
                <a class="close2">
                <i class="fas fa-times-circle"></i>
                </a>
               </header>

                <form action="../promocao/promover/promover.php" method="post">

                        <div class="group_date">
                            <label for="inicio">Data de início da promoção </label>
                            <input type="date" name="inicio" id="inicio"> 
                        </div>

                        <div class="group_date">
                            <label for="fim">Data de fim da promoção </label>
                            <input type="date" name="fim" id="fim">
                            </div>

                            <button type="submit" class="butao_proximo">Promover</button>
                        </form>';

                        '</div>';
                '</div>';
    // modal2

    echo '</div>'; //main_promotion_content
    echo '</article>'; //main_promotion
}
?>
        </section>
    </main>
    <?php include("../../layout/footer.php"); ?>

    <script>
        //Get the modal
        var modal2 = document.getElementById("myModal2");
        
        // Get the button that opens the modal
        var btn2 = document.getElementById("myBtn2");

        // Get the <span> element that closes the modal
        var span2 = document.getElementsByClassName("close2")[0];

        // When the user clicks on the button, open the modal
        btn2.onclick = function() {
            modal2.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span2.onclick = function() {
            modal2.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
        </script>
        <script>
            //Get the modal
            var modal = document.getElementById("myModal");
    
            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");
    
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
    
            // When the user clicks on the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }
    
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
    
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
</body>

</html>