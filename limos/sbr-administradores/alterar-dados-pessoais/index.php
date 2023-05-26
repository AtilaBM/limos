<?php
    include("../../conexao.php");
    include_once("../../objs/objetos.php");
    include ("../../layout/header.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/cadastro_res/cadastrores.css">
    <link rel="stylesheet" href="../../css/boot.css">
    <title>Alterar Dados</title>

</head>
<body>
    
        
<body>
    
</body>
</html>
    <form class="form_cadastro" action="modifica-dados.php" method="post" autocomplete="off">

        <div class="form_cadastro_content">

            <div class="form_cadastro_content_titulo">
                <h1>Informações Pessoais</h1>
            </div>

            <div class="form_cadastro_input_grupo">

                <div class="form_cadastro_input_box">
                    <input type="text" name="nome" id="nome" autofocus required
                    <?php $_SESSION['admsis']->nomeAdmSis();?>>
                    <label for="nome">Nome</label>
                </div>

                <div class="form_cadastro_input_box">
                    <input type="email" name="email" id="email" required
                    <?php $_SESSION['admsis']->emailAdmSis();?>>
                    <label for="email">E-mail</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Senha Atual</label>
                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="newPassword" id="newPassword"">
                    <label for="password">Nova senha</label>
                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="newPasswordConfirm" id="newPasswordConfirm"">
                    <label for="password">Confirmar nova senha</label>
                </div>
                <?php 
        include_once("../../avisos.php"); 
    ?> 
                <input class="butao_proximo" type="submit" value="Alterar dados" onclick="return confirm('Tem certeza que deseja mudar os seus dados pessoais?')">

            </div>

        </div>

    </form>

    <?php include("../../layout/footer.php"); ?>
</body>
</html>