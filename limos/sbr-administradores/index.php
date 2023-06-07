<?php
include_once("../objs/objetos.php");
include_once("loginChecker.php");
include_once("../conexao.php");
include("../layout/header.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/boot.css">
    <link rel="stylesheet" href="../css/sbr_res/index.css">
    <title>Administração do Sistema Limos</title>
</head>

<body>
    <!-- HEADER-------------------------------- -->
    <header class="main_header">
        <div class="main_header_content">
            <div class="img_logo">
                <a href="#" class="logo">
                    <img src="../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos" title="Bem vindo ao projeto Limos"></a>
            </div>

            <nav class="main_header_content_menu">
                <ul>
                    <li>
                        <!-- excluir conta -->
                        <a id="myBtn">Sair da conta</a>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <div id="titulo_saiconta">
                                    <h1 id="tittle_sair_conta">Deseja sair da sua conta?</h1>
                                </div>
                                <div id="botoes_modal">
                                    <a class="close" id="butao_modal">Nâo</a>
                                    <a href="login/logout.php" id="butao_modal">sair</a>
                                </div>
                              <!--FIM sair conta-->
                    </li>
                </ul>



                <!-- dropdown===================== -->
                <div class="menu_a_inportant">
                    <div class="dados_content dropdown">
                        <button onclick="myFunction()" class="dropbtn fas fa-bars"></button></i>
                        <div class="dropdown-content" id="myDropdown">
                            <h2>alterar Informações</h1>
                                <div class="butao_box">
                                    <a href="alterar-dados-pessoais/index.php">Alterar dados pessoais do administrador</a>
                                    <a href="adicionar-admnistrador/index.php">Adicionar um novo administrador ao sistema</a>
                                </div>
                                <h2>Moderar</h2>
                                <div class="butao_box">

                                    <a href="moderar/index.php?status=1&filtro=">Clientes</a>
                                    <a href="moderar/index.php?status=2&filtro=">Comentários</a>
                                    <a href="moderar/index.php?status=3&filtro=">Restaurantes</a>
                                </div>
                        </div>
                    </div>
                </div>
                <!--Fim dropdown===================== -->
        </div>
        </nav>
        </div>
    </header>
    <!-- FIM HEADER------------------------------ -->

    <main>
        <section class="info_res">
            <article class="info_res_content">
                <header>
                    <h1>
                        Administrador(a) <?php echo $_SESSION["admsis"]->nome_admsis; ?>
                    </h1>
                </header>
                <div class="main_info">

                    <div class="seila">


                        <div class="informacoes">
                            <h2 class="esse">Dados Pessoais</h2>
                            <p>Nome: <?php echo $_SESSION["admsis"]->nome_admsis; ?></p>
                            <p>E-mail: <?php echo $_SESSION["admsis"]->email_admsis; ?></p>
                        </div>


                    </div>
                </div>
                </div>
            </article>

        </section>
    </main>
    <?php include("../layout/footer.php") ?>
    <script>
        //Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>