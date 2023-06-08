<?php
    session_start();
    include("../../conexao.php");
    include_once("../../objs/objetos.php");
    include ("../../layout/header.php");
    include ("../../layout/menu_login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/login/login.css">
    
    <link href="https: //fonts.googleapis.com/css2?family= Inter:wght@200;300 ; 400 ; 500; 600 & display=swap"rel="stylesheet">
    <title>Login</title>
</head>
<body>
    
    <form class="form_login" autocomplete="off" action="login.php" method="POST">

        <div class="login_content">

            <div class="titulo_login">
                <h1>Bem Vindo</h1>
            </div>

            <div class="login_content_input_grupo">

                <div class="login_input_grupo_box">

                    <input type="email" name="email" id="email" >
                    <label for="email">E-mail</label>
                    
                </div>

                <div class="login_input_grupo_box">

                    <input type="password" name="password" id="password">
                    <label for="password">Senha</label>
                    
                </div>
                <?php include("../../avisos.php"); # Avisos do Sistema?>
                <input class="butao_login" type="submit" value="Login">

            </div>

            <div class="nao_tem_conta">
                <p>Não tem conta?</p>
            </div>

            <div class="grupo_butao">
                <div class="butao_login_cadastrar">
                    <a class="butao_cadastrar_login" href="../cadastro/index.php">Criar como Restaurante</a>
                </div>
                <!-- <div class="butao_login_cadastrar">
                    <a class="butao_cadastrar_login" href="../../sbr/cadastro/index.php">Criar como Cliente</a>
                </div> -->
            </div> 
            
        </div>
    </form>
  <?php  include ("../../layout/footer.php"); ?>
</body>
</html>