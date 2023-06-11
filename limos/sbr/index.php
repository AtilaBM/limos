<?php
    include ("../layout/header.php");;
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/boot.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Limos</title>
</head>
    <body>

    <header  class="main_header">
            <div class="main_header_content">
                <div class="img_logo">
                    <a href="index.php" class="logo">
                        <img src="../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos"
                            title="Bem vindo ao projeto Limos"></a>
                </div>

                <nav class="main_header_content_menu">
                    <ul>
                        <li><a href="index.php">Início</a></li>
                        <li><a href="pesquisa/index.php" >Restaurantes</a></li>
                    </ul>
                    <div class="menu_a_inportant">
                    <?php 
                    if(!isset($_SESSION['cliente'])){
                      echo  '<a href="login/index.php"  id="cad_menu" class="cadastro_menu">Cadastrar-se</a>';
                      unset($_SESSION['cliente']);
                    }if(isset($_SESSION['cliente'])){
                      echo  '<a href="../sbr/painel/index.php"  id="cad_menu" class="cadastro_menu">Conta</a>';
                    }
                    ?>
                        </div>
                </nav>
            </div>
        </header>
 

        <!--FIM DOBRA CABEÇALHO-->
        <!--1ª DOBRA-->
        <main>
        <div class="main_cta ">
                <!-- <img src="../img/variosburguer.jpg" alt=""> -->
                <article class="main_cta_content">
                    <div class="main_cta_content_spacer">
                            <div class="txt_burguer">
                                <h1>Os melhores restaurantes perto de você
                                </h1>
                                    <p>Ache a melhor opção para o seu gosto</p>
                                <p><a href="pesquisa/index.php" class="btn">Pesquisar</a></p>
                            </div>
                    </div>
                </article>
            </div>
            <!--FIM 1ª DOBRA-->

            <!--Restaurantes promovidos -->
            <section class="promovidos">
                <?php
                    include_once('../objs/objetos.php');
                    include_once('../conexao.php');
                    $query = 'SELECT * FROM ad WHERE status_pag_ad = 1 AND status_ad = 1 ORDER BY data_inicio_ad DESC LIMIT 30;';
                    $result = mysqli_query($conexao, $query);
                    $row = mysqli_num_rows($result);
                    if($row >= 1){
                        echo '<header>';
                        echo "<h1>Restaurantes em destaque</h1>";
                        echo '</header>';
                        foreach($result as $ad){
                            $ad2 = new ad($ad["id_ad"], $ad["id_res"], $ad["data_inicio_ad"], $ad["data_fim_ad"], $ad["status_ad"], $ad["status_pag_ad"]);
                            if($ad2->status_ad == 1){
                                $id_res = $ad2->id_res;
                                $query = "SELECT * FROM res WHERE id_res = '$id_res';";
                                $res = mysqli_fetch_assoc(mysqli_query($conexao, $query));
                                $row = mysqli_num_rows($result);
                                if($row >= 1 and $res["status_conta_res"] == 1){
                                    $res2 = new restaurante($res["id_res"],$res["nome_res"],$res["tipo_res"],$res["dia_hora_func_res"],$res["encomenda_res"],$res["entrega_res"],$res["telefone_res"],$res["desc_res"],$res["cardapio_res"],$res["cnpj_res"], $res["fotos_res"], $res["nota_res"], $res["status_conta_res"], $res["whatsapp_res"], $res["instagram_res"]);
                                   echo '<div class="content">';
                                   echo '<div class="card">';
                                   echo '<img style="width:100%" src="../img/restaurantes/'.$res['fotos_res'].'" alt="'.$res['nome_res'].'">';
                                    echo "<h2>".$res["nome_res"]."</h2>";
                                    echo '<button><a href="restaurantes/index.php?idRes='.$res['id_res'].'">Ver mais</a></button>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                        }
                    }
                
                ?>
            </section>
            <!--FIM Restaurantes promovidos -->
        </main>
        <!--FIM DOBRA PALCO PRINCIPAL-->

        <!--INCIIO DOBRA RODAPE-->
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
        <!--FIM DOBRA RODAPE-->
    </body>
</html>