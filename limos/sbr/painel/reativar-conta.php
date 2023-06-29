<?php
include_once("../../objs/objetos.php");
include_once("../../avisos.php");
include("../../layout/menu_login.php");
include("../../layout/header.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/conta_cli/reativa.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Reativar</title>
</head>

<body>
    <main>
        <section class="reativa">
            <header class="titulo">

                <h1><?php echo $_SESSION["cliente"]->nome; ?>, é bom ter você de volta!!</h1>
                <a href="../login/logout.php">
                <i class="fas fa-times-circle"></i>
                </a>
            </header>
            <div class="reativa_content">

                <div class="reativa_content_button">

                    <a href="reativa.php">Clique aqui para reativar a sua conta</a>


                </div>

            </div>
        </section>
    </main>
    <?php include("../../layout/footer.php") ?>
</body>

</html>