<?php
    include_once("../../objs/objetos.php");
    include_once("../../avisos.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reativar</title>
</head>
<body>
    <p><?php echo $_SESSION["cliente"]->nome;?>, é bom te ver de volta.</p>
    <h1>Reativar conta</h1>
    <a href="reativa.php">Clique aqui para reativar a sua conta</a>
    <br>
    <h1>Sair</h1>
    <a href="../login/logout.php">Sair</a>
</body>
</html>