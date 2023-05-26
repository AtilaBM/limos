<?php
    include("../../conexao.php");
    include_once("../../objs/objetos.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir conta</title>
</head>
<body>
    
    <form class="form_cadastro" action="excluir.php" method="post" autocomplete="off">
        <div class="form_cadastro_content">
            <div class="form_cadastro_input_grupo">
                <div class="form_cadastro_input_box">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Confirme a sua senha</label>
                </div>
                <div class="input_grupo_box_radio">
                    <input type="radio" name="del" id="del" value="1"> Desativar Temporariamente <br>
                    <input type="radio" name="del" id="del" value="2"> Excluir permanentemente
                </div>
                <input class="butao_proximo" type="submit" value="Prosseguir" onclick="return confirm('Tem certeza que deseja perder todos os benefícios de ter um conta na Limos?')">
            </div>
        </div>
    </form>
</body>
</html>