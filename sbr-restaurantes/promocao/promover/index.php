<?php
    include_once("../../../objs/objetos.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promoção de Restaurante</title>
</head>
<body>
    <?php include_once("../../../avisos.php");?>
    <form action="promover.php" method="post">
    <input type="date" name="inicio" id="inicio"> Data de início da promoção <br>
        <input type="date" name="fim" id="fim"> Data de fim da promoção <br>
        <button type="submit">Promover</button>
    </form>
</body>
</html>