<?php
include_once("../objs/objetos.php");
include_once("loginChecker.php");
include_once("../conexao.php");
$imagem = $_SESSION["restaurante"]->fotos;
$cardapio = $_SESSION["restaurante"]->cardapio;
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
    <title><?php echo $_SESSION["restaurante"]->nome; ?> - Administração Limos</title>
</head>
<!-- HEADER-------------------------------- -->
<header class="main_header">
    <div class="main_header_content">
        <div class="img_logo">
            <a href="../sbr/index.php" class="logo">
                <img src="../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos" title="Bem vindo ao projeto Limos"></a>
        </div>

        <nav class="main_header_content_menu">
            <ul>
                <li>
                    <!-- sairconta -->
                    <a href="#" id="myBtn">Excluir sua conta como administrador</a>
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <div class="titulo_modal">
                                <h1>Excluir Conta</h1>
                                <span class="close">&times;</span>
                            </div>
                            <form class="form_cadastro" action="../sbr-restaurantes/excluir-conta/excluir.php" method="post" autocomplete="off">
                                <div class="form_cadastro_content">
                                    <div class="form_cadastro_input_box">
                                        <label for="password">Confirme a sua senha</label>
                                        <input type="password" name="password" id="password" required>
                                    </div>
                                    <?php include("../avisos.php") ?>
                                    <input class="butao_proximo" type="submit" value="Prosseguir" onclick="return confirm('Caso você seja o único administrador do seu restaurante, ele será permanentemente excluído!!! Tem certeza que deseja perder todos os benefícios de ter um conta na Limos?')">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--FIM sair conta-->
                </li>
                <li>
                    <!-- excluir conta -->
                    <a id="myBtn2" >Sair da conta</a>
                    <div id="myModal2" class="modal">
                        <div class="modal-content">
                            <div id="titulo_saiconta">
                                <h1 id="tittle_sair_conta">Deseja sair da sua conta?</h1>
                            </div>
                            <div id="botoes_modal">
                                <a class="close2" id="butao_modal">Nâo</a>
                                <a href="login/logout.php" id="butao_modal">sair</a>
                            </div>
                        </div> <!--FIM sair conta-->
                </li>
            </ul>



            <!-- dropdown===================== -->
            <div class="menu_a_inportant">
                <div class="dados_content dropdown">
                    <button onclick="myFunction()" class="dropbtn"><i class="fas fa-bars"></i></button>
                    <div class="dropdown-content" id="myDropdown">
                        <h2>alterar Informações</h1>
                            <div class="butao_box">
                                <a href="cadastro/modificarestaurante.php" class="botoes_admres">Alterar dados do restaurante</a>
                                <a href="alterar-dados-pessoais/index.php" class="botoes_admres">Alterar dados pessoais do administrador</a>
                                <a href="adicionar-admnistrador/index.php" class="botoes_admres">Adicionar um novo administrador ao sistema</a>
                            </div>
                            <h2>Gerenciar Promoções</h2>
                            <div class="butao_box">
                                <a href="promocao/index.php" class="botoes_admres">Promova o seu negócio na plataforma da Limos</a>
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

<body>
    <main>
        <section class="info_res">
            <article class="info_res_content">

                <header>
                    <h1>
                        <?php echo $_SESSION["restaurante"]->nome; ?>
                    </h1>
                </header>



                <div class="main_info">

                    <div class="seila">

                        <div class="imgs">
                            <h2>Imagens</h2>
                            <?php echo '<a href="../img/restaurantes/' . $imagem . '"" class="mfp-img-mobile"><img src="../img/restaurantes/' . $imagem . '" alt="fotodorestaurante"></a>'; ?>
                            <?php echo '<a href="../img/restaurantes/' . $cardapio . '"" class="mfp-img-mobile"><img src="../img/restaurantes/' . $cardapio . '" alt="fotodocardapio"></a>'; ?>
                        </div>

                        <div class="informacoes">
                            <h2 class="esse">Dados Pessoais</h2>
                            <p>Nome: <?php echo $_SESSION["admres"]->nome; ?></p>
                            <p>E-mail: <?php echo $_SESSION["admres"]->email; ?></p>

                            <h2>Dados do Restaurante</h2>
                            <p>Nome: <?php echo $_SESSION['restaurante']->nome ?></p>
                            <p>Nota: <?php echo  $_SESSION["restaurante"]->nota; ?> Estrelas</p>


                            <h2>Endereço do Restaurante</h2>
                            <p>País: <?php echo $_SESSION["enderecoRes"]->pais; ?></p>
                            <p>UF: <?php echo $_SESSION["enderecoRes"]->uf; ?></p>
                            <p>CEP: <?php echo $_SESSION["enderecoRes"]->cep; ?></p>
                            <p>Cidade: <?php echo $_SESSION["enderecoRes"]->cidade; ?></p>
                            <p>Bairro: <?php echo $_SESSION["enderecoRes"]->bairro; ?></p>
                            <p>Logradouro: <?php echo $_SESSION["enderecoRes"]->logradouro; ?></p>
                            <p>Número: <?php echo $_SESSION["enderecoRes"]->numero; ?></p>
                        </div>


                    </div>
                </div>



            </article>

        </section>
        <section class="coment">

            <div class="content_coment">
                <h2>Últimos Comentários</h2>
                <?php
                $query = 'SELECT * FROM `coment` WHERE id_res = ' . $_SESSION["restaurante"]->id . ' ORDER BY data_coment, id_coment DESC LIMIT 3;';
                $result = mysqli_query($conexao, $query);
                $row = mysqli_num_rows($result);
                if ($row >= 1) {
                    //Testa se retornou dados e abre um for para listar
                    echo '<div class="coment_cli">';
                    foreach ($result as $com) {
                        $comentario = new coment($com['id_coment'], $com['id_cli'], $com['id_res'], $com['coment_coment'], $com['data_coment'], $com['nota_coment']);
                        # Consulta se o email e a senha digitados conhecidem com alguma entrada no banco de dados
                        $idCliCom = $comentario->id_cli;
                        $query = "SELECT nome_cli FROM `CLI` WHERE id_cli = '$idCliCom'";
                        $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
                        $nomeCli = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta
                        echo '<div class="coment_cli_content">';

                        echo '<div class="info_coment_cli1">';
                        echo '<h3>' . "Enviado por" . " " . $nomeCli["nome_cli"] . '</h3>';
                        echo '<p>' . $comentario->nota_coment . " Estrelas - " . $comentario->data_coment . '</p>';
                        echo '</div>';

                        echo '<div class="info_coment_cli2">';
                        echo '<p>' . $comentario->coment . '</p>';
                        echo '</div>';

                        echo '</div>'; //coment_cli_content
                    }
                    echo '</div>';
                } else {
                    echo "<p>Parece que nínguem ainda comentou o seu restaurante.</p>";
                } ?>
            </div>
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
    </script>
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