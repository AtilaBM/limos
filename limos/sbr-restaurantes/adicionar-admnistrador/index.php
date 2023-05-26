<?php
     session_start();
     include("../../conexao.php");
     include_once("../../objs/objetos.php");  
     include ("../../layout/header.php");
     include ("../layout_res/menu_login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/LIMOS.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/cadastro_res/cadastrores.css">
    <title>Cadastro</title>
</head>
<body>
 
    <!-- FIM NAV---------------------------------------------------------- -->
    <!-- FORM----------------------------------------------------------- -->
    <?php include("../../avisos.php");?>
    <form class="form_cadastro" action="cadastrar.php" method="post" autocomplete="off">

        <div class="form_cadastro_content">

            <div class="form_cadastro_content_titulo">
                <h1>Cadastrar Novo Administrador do Restaurante</h1>
            </div>

            <div class="form_cadastro_input_grupo">

                <div class="form_cadastro_input_box">
                    <input type="text" name="nome" id="nome" autofocus required>
                    <label for="nome">Nome</label>
                </div>

                <div class="form_cadastro_input_box">
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="password" id="password" minlength="8" required>
                    <label for="password">Senha Temporária</label>
                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="password-confirm" id="password-confirm" minlength="8" required>
                    <label for="password-confirm">Confirmar Senha Temporária</label>

                </div>

                <input class="butao_proximo" type="submit" value="Prosseguir" onclick="return confirm('Deseja cadastrar um novo administrador ao seu restaurante?')">

            </div>

        </div>

    </form>
    <!-- FIM FORM-------------------------------------------------------------- -->
    <!-- FOOTER---------------------------------------------------- -->
    <?php include("../../layout/footer.php") ?>
    <!-- FIM FOOTER--------------------------------------------------------- -->
</body>
</html>