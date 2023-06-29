<?php
    include("../../../../conexao.php");
    include_once("../../../../objs/objetos.php");
    session_start();
    $idRes = mysqli_real_escape_string($conexao, trim(isset($_GET["idRes"]) ? $_GET["idRes"] : 0));
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
    <?php 
        include("../../../../avisos.php"); 
    ?> 
    <form class="form_cadastro" action="banir.php" method="post" autocomplete="off">
        <div class="form_cadastro_content">
            <div class="form_cadastro_input_grupo">
                <div class="form_cadastro_input_box">
                    <input type="text" name="idRes" style="display: none;" value="<?php echo $idRes;?>">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Confirme a sua senha</label>
                </div>
                <input class="butao_proximo" type="submit" value="Prosseguir" onclick="return confirm('Tem certeza de que deseja banir o cliente de id = <?php echo $idCli;?>?')">
            </div>
        </div>
    </form>
</body>
</html>