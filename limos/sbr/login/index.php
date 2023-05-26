<?php
    session_start();
    include("../../conexao.php");
    include_once("../../objs/objetos.php");
    require_once ("../../layout/header.php");
    require_once ("../../layout/menu_login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

<link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/login/login.css">
    
    <title>Login</title>
</head>
<body>

    <!-- FORM----------------------------------------------------------- -->
    <form class="form_login" autocomplete="off" action="login.php" method="POST">

        <div class="login_content">

            <div class="titulo_login">
                <h1>Bem Vindo</h1>
            </div>

            <div class="login_content_input_grupo">

                <div class="login_input_grupo_box">

                    <input type="email" name="email" id="email" autofocus>
                    <label for="email">E-mail</label>
                    
                </div>

                <div class="login_input_grupo_box">

                    <input type="password" name="password" id="password">
                    <label for="password">Senha</label>
                    
                </div>
                <?php include ("../../avisos.php") ?>
                <input class="butao_login" type="submit" id="login_submit" value="Login">
          
            </div>

            <div class="nao_tem_conta">
                <p>Não tem conta?</p>
            </div>

            <div class="grupo_butao">
                <div class="butao_login_cadastrar">
                    <a class="butao_cadastrar_login" href="../cadastro/index.php">Criar como Cliente</a>
                </div>
                <div class="butao_login_cadastrar">
                    <a class="butao_cadastrar_login" href="../../sbr-restaurantes/cadastro/index.php">Criar como Restaurante</a>
                </div>
            </div>
            
        </div>
    </form>
    <!-- FIM FORM-------------------------------------------------------------- -->
    <!-- FOOTER---------------------------------------------------- -->
    <?php require_once ("../../layout/footer.php");?>
</body>
</html>