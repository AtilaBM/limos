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
    <link rel="stylesheet" href="../../css/cadastro_res/cadastrores.css">
    <title>Cadastro</title>
</head>
<body>
   
    <!-- FORM----------------------------------------------------------- -->
    <form class="form_cadastro" action="cadastrar.php" method="post" autocomplete="off" name="f1">

        <div class="form_cadastro_content">

            <div class="form_cadastro_content_titulo">
                <h1>Informações Pessoais</h1>
            </div>

            <div class="form_cadastro_input_grupo">

                <div class="form_cadastro_input_box">
                    <input type="text" name="nome" id="nome" autofocus >
                    <label for="nome">Nome</label>
                </div>

                <div class="form_cadastro_input_box">
                    <input type="email" name="email" id="email" onblur="validacaoEmail(f1.email)" >
                    <label for="email">Email</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="password" id="password" minlength="8" >
                    <label for="password">Senha</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="password-confirm" id="password-confirm" minlength="8" >
                    <label for="password-confirm">Confirmar Senha</label>

                </div>
                <?php include("../../avisos.php");?>
                <input class="butao_proximo" type="submit" value="Prosseguir">

            </div>

        </div>

    </form>
    <!-- FIM FORM-------------------------------------------------------------- -->
   <?php require_once ("../../layout/footer.php"); ?>
   <script src="../../js/sweetalert2.js"></script>
   <script>
        function validacaoEmail(field) {
            usuario = field.value.substring(0, field.value.indexOf("@"));
            dominio = field.value.substring(field.value.indexOf("@") + 1, field.value.length);

            if ((usuario.length >= 1) &&
                (dominio.length >= 3) &&
                (usuario.search("@") == -1) &&
                (dominio.search("@") == -1) &&
                (usuario.search(" ") == -1) &&
                (dominio.search(" ") == -1) &&
                (dominio.search(".") != -1) &&
                (dominio.indexOf(".") >= 1) &&
                (dominio.lastIndexOf(".") < dominio.length - 1)) {} else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Esse email não é válido!',
                })
            }
        }
        </script>
</body>
</html>