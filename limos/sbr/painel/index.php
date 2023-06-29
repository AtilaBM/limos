<?php
include_once("../../objs/objetos.php");
include_once("../loginChecker.php");
include("../../layout/header.php")
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/conta_cli/index.css">
    <title>Site de Busca de Restaurantes</title>
</head>

<body>
    <!-- HEADER-------------------------------- -->
    <header class="main_header">
        <div class="main_header_content">
            <div class="img_logo">
                <a href="../../sbr/index.php" class="logo">
                    <img src="../../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos" title="Bem vindo ao projeto Limos"></a>
            </div>

            <nav class="main_header_content_menu">
                <div class="menu_a_inportant">
                    <a href="../../sbr/index.php" class="cadastro_menu">Início</a>
                </div>
            </nav>
        </div>
    </header>
    <!-- FIM HEADER------------------------------ -->

    <!-- MAIN============================================ -->
    <main>
        <section class="main_content_dados">
            <header class="main_titulo_dados">
                <h1>Dados Pessoais</h1>
            </header>

            <div class='dados_cadastro_content'>
                <div class="dados_cadastro_input_box">
                    <label for="#">Nome:</label>
                    <span class="dado_php"><?php echo $_SESSION["cliente"]->nome; ?></span>
                </div>
                <div class="dados_cadastro_input_box">
                    <label for="#">Email:</label>
                    <span class="dado_php"><?php echo $_SESSION['cliente']->email; ?></span>
                </div>
                <div class="dados_cadastro_input_box">
                    <label for="#">Telefone:</label>
                    <span class="dado_php"><?php echo $_SESSION['cliente']->telefone; ?></span>
                </div>
                <div class="dados_cadastro_input_box">
                    <label for="#">Cep:</label>
                    <span class="dado_php"><?php echo $_SESSION['endereco']->cep; ?></span>
                </div>
                <div class="dados_cadastro_input_box">
                    <label for="#">Cidade:</label>
                    <span class="dado_php"><?php echo $_SESSION['endereco']->cidade; ?></span>
                </div>
                <div class="dados_cadastro_input_box">
                    <label for="#">Bairro:</label>
                    <span class="dado_php"><?php echo $_SESSION['endereco']->bairro; ?></span>
                </div>
                <div class="dados_cadastro_input_box">
                    <label for="#">Logradouro:</label>
                    <span class="dado_php"><?php echo $_SESSION['endereco']->logradouro; ?></span>
                </div>
            </div>
            <div class="dados_butao_box">
                <div class="dados_butao_pessoais">
                    <a href="../cadastro/gostos.php">Mudar gostos</a>
                    <a href="alterar-dados.php" type="submit">Mudar Dados Pessoais</a>
                    <a href="recomendar.php">Recomende-me um restaurante</a>
                </div>
                <div class="dados_butao_sair">
                    <!-- SAIR Conta -->
                    <a id="myBtn2" type="submit">Sair da Conta</a>

                    <div id="myModal2" class="modal">
                        <div class="modal-content">
                            <div class="titulo_saiconta">
                                <h1 id="tittle_sair_conta">Deseja sair da sua conta?</h1>
                            </div>
                            <div class="botoes_modal">
                                <a class="close2">Nâo</a>
                                <a href="../login/logout.php">sair</a>
                            </div>
                        </div>

                    </div>

                    <!-- FIM SAIR Conta -->


                    <!-- excluir conta============= -->
                    <a id="myBtn">Desejo excluir minha conta</a>
                    <!-- The Modal -->
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">

                            <div class="titulo_modal">
                                <h1>Excluir Conta</h1>
                                <span class="close">&times;</span>
                            </div>
                            <form class="form_cadastro" action="excluir.php" method="post" autocomplete="off">
                                <div class="form_cadastro_content">
                                    <div class="form_cadastro_input_grupo">
                                        <div class="form_cadastro_input_box">
                                            <label for="password">Confirme a sua senha</label>
                                            <input type="password" name="password" id="password" required>

                                        </div>
                                        <div class="form_cadastro_input_radio">
                                            <div class="group_radio">
                                                <label for="">Desativar Temporariamente</label>
                                                <input type="radio" name="del" id="del" value="1">
                                            </div>
                                            <div class="group_radio">
                                                <label for="">Excluir permanentemente </label>
                                                <input type="radio" name="del" id="del" value="2">
                                            </div>
                                        </div>
                                        <?php
                                        include("../../avisos.php");
                                        ?>
                                        <input class="butao_proximo" type="submit" value="Prosseguir" onclick="return confirm('Tem certeza que deseja perder todos os benefícios de ter um conta na Limos?')">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!--fim excluir conta============= -->


                </div>
            </div>
        </section>
    </main>
    <!-- MAIN============================================ -->

    <!-- FOOTER============================================= -->
    <section class="main_footer">
        <header>
            <h1>Quer saber mais?</h1>
        </header>
        <article class="main_footer_our_pages">
            <header>
                <h2>Nossas Páginas</h2>
            </header>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="../sbr/pesquisa/index.php">Restaurantes</a></li>
            </ul>
        </article>

        <article class="main_footer_links">
            <header>
                <h2>Links Úteis</h2>
            </header>
            <ul>
                <li><a href="#">Política de Privacidade</a></li>
                <li><a href="#">Aviso Legal</a></li>
                <li><a href="#">Termos de Uso</a></li>
            </ul>
        </article>

        <article class="main_footer_about">
            <header>
                <h2>Sobre o Projeto</h2>
            </header>
            <p>Procure os melhores restaurantes com base em sua localização e gostos pessoais e divulgue sua experiência por meio dos comentários e da avaliação do resturante.</p>
        </article>
    </section>
    <footer class="main_footer_rights">
        <p>LIMOS - &copy;Todos os direitos reservados.</p>
    </footer>
    <!-- FIM FOOTER=================================== -->
    <script>
        //Get the modal
        var modal2 = document.getElementById("myModal2");

        // Get the button that opens the modal
        var btn2 = document.getElementById("myBtn2");

        // Get the <span> element that closes the modal
        var span2 = document.getElementsByClassName("close2")[0];

        // When the user clicks on the button, open the modal
        btn2.onclick = function() {
            modal2.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span2.onclick = function() {
            modal2.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
    </script>
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
    </script>
</body>

</html>