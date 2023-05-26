<?php
include("../../../conexao.php");
include_once("../../../objs/objetos.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-bt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Promoção</title>
</head>

<body>
<!-- inicio modal -->
    <form class="form_cadastro" action="finalizar.php" method="post" autocomplete="off">
        <div class="form_cadastro_content">
            <div class="form_cadastro_input_grupo">
                <div class="form_cadastro_input_box">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Confirme a sua senha</label>
                </div>
                <?php
                include("../../../avisos.php");
                ?>
                <input class="butao_proximo" type="submit" value="Prosseguir" onclick="return confirm('Tem certeza de que deseja desativar a promoção do seu restaurante? Nenhum valor sera reembolsado!!!')">
            </div>
        </div>
    </form>
<!--Fim inicio modal -->

</body>

</html>