<?php
    include("../../conexao.php");
    include_once("../../objs/objetos.php");;
    session_start();
    include ("../../layout/header.php");
    include ("../../layout/menu_login.php")
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/cadastro_cli/gostos.css">
    <title>Gostos</title>
</head>
<body>
    
    <!-- FIM NAV---------------------------------------------------------- -->
    <!-- FORM----------------------------------------------------------- -->
    <form class="form_gostos" id="cad_gostos" action="finalizarcadastro.php" method="post">
        <div class="form_content">

            <div class="titulo_form_gostos">
                <h1>Escolha Seus Gostos</h1>
            </div>

            <div class="input_grupo">

                <div class="input_grupo_box">

                    <h2>Doces</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="doce" id="doce1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "0")?>> Adoro
                        <input type="radio" name="doce" id="doce2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "0")?>> Gosto
                        <input type="radio" name="doce" id="doce3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "0")?>> Não me importo
                        <input type="radio" name="doce" id="doce4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "0")?>> Não Gosto
                        <input type="radio" name="doce" id="doce5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "0")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Salgados</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="salgado" id="salgado1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "1")?>> Adoro
                        <input type="radio" name="salgado" id="salgado2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "1")?>> Gosto
                        <input type="radio" name="salgado" id="salgado3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "1")?>> Não me importo
                        <input type="radio" name="salgado" id="salgado4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "1")?>> Não Gosto
                        <input type="radio" name="salgado" id="salgado5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "1")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Churrasco</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="churrasco" id="churrasco1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "2")?>> Adoro
                        <input type="radio" name="churrasco" id="churrasco2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "2")?>> Gosto
                        <input type="radio" name="churrasco" id="churrasco3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "2")?>> Não me importo
                        <input type="radio" name="churrasco" id="churrasco4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "2")?>> Não Gosto
                        <input type="radio" name="churrasco" id="churrasco5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "2")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Fast Food</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="fastfood" id="fastfood1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "3")?>> Adoro
                        <input type="radio" name="fastfood" id="fastfood2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "3")?>> Gosto
                        <input type="radio" name="fastfood" id="fastfood3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "3")?>> Não me importo
                        <input type="radio" name="fastfood" id="fastfood4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "3")?>> Não Gosto
                        <input type="radio" name="fastfood" id="fastfood5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "3")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Pizza</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="pizza" id="pizza1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "4")?>> Adoro
                        <input type="radio" name="pizza" id="pizza2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "4")?>> Gosto
                        <input type="radio" name="pizza" id="pizza3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "4")?>> Não me importo
                        <input type="radio" name="pizza" id="pizza4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "4")?>> Não Gosto
                        <input type="radio" name="pizza" id="pizza5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "4")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Sushi</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="sushi" id="sushi1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "5")?>> Adoro
                        <input type="radio" name="sushi" id="sushi2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "5")?>> Gosto
                        <input type="radio" name="sushi" id="sushi3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "5")?>> Não me importo
                        <input type="radio" name="sushi" id="sushi4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "5")?>> Não Gosto
                        <input type="radio" name="sushi" id="sushi5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "5")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Comida Brasileira</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="brasil" id="brasil1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "6")?>> Adoro
                        <input type="radio" name="brasil" id="brasil2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "6")?>> Gosto
                        <input type="radio" name="brasil" id="brasil3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "6")?>> Não me importo
                        <input type="radio" name="brasil" id="brasil4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "6")?>> Não Gosto
                        <input type="radio" name="brasil" id="brasil5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "6")?>> Odeio
                    </div>
                </div>


                <div class="input_grupo_box">
                    <h2>Comida Francesa</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="franca" id="franca1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "7")?>> Adoro
                        <input type="radio" name="franca" id="franca2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "7")?>> Gosto
                        <input type="radio" name="franca" id="franca3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "7")?>> Não me importo
                        <input type="radio" name="franca" id="franca4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "7")?>> Não Gosto
                        <input type="radio" name="franca" id="franca5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "7")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Comida Italiana</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="italia" id="italia1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "8")?>> Adoro
                        <input type="radio" name="italia" id="italia2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "8")?>> Gosto
                        <input type="radio" name="italia" id="italia3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "8")?>> Não me importo
                        <input type="radio" name="italia" id="italia4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "8")?>> Não Gosto
                        <input type="radio" name="italia" id="italia5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "8")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Comida Asiática</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="asia" id="asia1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "9")?>> Adoro
                        <input type="radio" name="asia" id="asia2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "9")?>> Gosto
                        <input type="radio" name="asia" id="asia3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "9")?>> Não me importo
                        <input type="radio" name="asia" id="asia4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "9")?>> Não Gosto
                        <input type="radio" name="asia" id="asia5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "9")?>> Odeio
                    </div>
                </div>

                <div class="input_grupo_box">
                    <h2>Comida Árabe</h2>
                    <div class="input_grupo_box_radio">
                        <input type="radio" name="arabe" id="arabe1" value="1" <?php $_SESSION["cliente"]->gostosChecker("1", "10")?>> Adoro
                        <input type="radio" name="arabe" id="arabe2" value="2" <?php $_SESSION["cliente"]->gostosChecker("2", "10")?>> Gosto
                        <input type="radio" name="arabe" id="arabe3" value="3" <?php $_SESSION["cliente"]->gostosChecker("3", "10")?>> Não me importo
                        <input type="radio" name="arabe" id="arabe4" value="4" <?php $_SESSION["cliente"]->gostosChecker("4", "10")?>> Não Gosto
                        <input type="radio" name="arabe" id="arabe5" value="5" <?php $_SESSION["cliente"]->gostosChecker("5", "10")?>> Odeio
                    </div>
                </div>

            </div>
                <input class="butao_enviar" type="submit" id="finaliza_cadastro" value="<?php $_SESSION['cliente']->preencheSubmit()?>" >
        </div>
    </form>
    <!-- FIM FORM-------------------------------------------------------------- -->
    <!-- FOOTER---------------------------------------------------- -->
    <?php require_once ("../../layout/footer.php");?>
    <!-- FIM FOOTER--------------------------------------------------------- -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>