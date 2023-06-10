<?php
    include_once("../../objs/objetos.php");
    include_once("../../conexao.php");
    session_start();
    include_once("../../avisos.php");
    include("../../layout/header.php");
    include("../../layout/menu_login.php");

    $idres = mysqli_real_escape_string($conexao, trim(isset($_GET["idRes"]) ? $_GET["idRes"] : 0));
    # Montar o Objeto do restaurante
    $query = "SELECT * FROM `res` WHERE id_res = '$idres'";
    $result = mysqli_query($conexao, $query);
    $row = mysqli_num_rows($result);
    $restaurante_bd = mysqli_fetch_assoc($result);
    $res = new restaurante($restaurante_bd["id_res"], $restaurante_bd["nome_res"], $restaurante_bd["tipo_res"], $restaurante_bd["dia_hora_func_res"], $restaurante_bd["encomenda_res"], $restaurante_bd["entrega_res"], $restaurante_bd["telefone_res"], $restaurante_bd["desc_res"], $restaurante_bd["cardapio_res"], $restaurante_bd["cnpj_res"], $restaurante_bd["fotos_res"], $restaurante_bd["nota_res"], $restaurante_bd["status_conta_res"], $restaurante_bd["whatsapp_res"], $restaurante_bd["instagram_res"]);
    $imagem = $res->fotos;
    $cardapio = $res->cardapio;

    # Monta o objeto do endereco do restaurante
    $query = "SELECT * FROM `END` WHERE id_res = '$idres'";
    $result = mysqli_query($conexao, $query);
    $row = mysqli_num_rows($result);
    $endereco_bd = mysqli_fetch_assoc($result);
    $enderecoRes = new endereco($endereco_bd["cep_end"], $endereco_bd["num_end"], $endereco_bd["logradouro_end"], $endereco_bd["bairro_end"], $endereco_bd["uf_end"], $endereco_bd["pais_end"], $endereco_bd["cidade_end"], $endereco_bd["id_end"]);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/restaurante/info_res.css">
    <link rel="stylesheet" href="../../css/boot.css">
    <title><?php echo $res->nome; ?> - Limos</title>
</head>

<body>


    <main class="main_res">

        
        <section class="main_res_info">


            <div class="res_img ">

        <div class="voltar">
        <a href="../pesquisa/index.php" class=""><i class="fas fa-arrow-left"></i>
            </a>
</div>

                <a href="../../img/restaurantes/<?php echo $imagem ?>"><img src="../../img/restaurantes/<?php echo $imagem ?>" alt="imagem do Restaurante"></a>
                <div class="img_cardapio">
                    <a href="../../img/restaurantes/<?php echo $cardapio ?>"><img src="../../img/restaurantes/<?php echo $cardapio ?>" alt="imagem do cardápio"></a>
                </div>
            </div>

            <article class="main_info_content">

                <div class="art_main_info">
                    <header class="titulo_res">
                        <h1><?php echo $res->nome; ?></h1>
                        <p><?php echo $res->tipo() ?></p>
                        <p class="nota-res"><?php  for ($i = 1; $i <= 5; $i++) {
                            $starImage = ($i <= $restaurante_bd["nota_res"]) ? '../../img/icons/estrela.png' : '../../img/icons/estrela_vazia.png';
                            echo '<img src="' . $starImage . '" style="width: 30px; height: 30px;">';
                        }   ?></p>
                    </header>


                    <div class="funcionamento">
                        <h2>Funcionamento</h2>
                        <p><?php echo $res->diahorafunc; ?></p>
                        <ul>
                            <li>Fazemos entregas? <?php echo $res->entrega(0, 2); ?></li>
                            <li>fazemos encomendas? <?php echo $res->encomenda(0, 2); ?></li>
                        </ul>
                    </div>

                    <div class="contato">
                        <h2>Contato</h2>
                        <p class="iconp"> <span><img src="../../img/icons/phone-solid.svg" alt=""></span> Telefone: <?php echo $res->telefones; ?></p>
                        <p class="iconp"> <span><img src="../../img/icons/whatsapp.svg" alt=""></span> WhatsApp: <?php echo $res->whatsapp; ?></p>
                        <p class="iconp"> <span><img src="../../img/icons/instagram.svg" alt=""></span> Instagram: <a target="_blank" href="https://www.instagram.com/<?php echo $res->instagram; ?>">@<?php echo $res->instagram; ?></a></p>
                    </div>
                    <div class="localiza">
                        <h2>Localização</h2>
                        <address><?php echo $enderecoRes->logradouro . " Nº " . $enderecoRes->numero; ?></address>
                    </div>

                    <div class="descricao">
                        <h2>Descrição</h2>
                        <p><?php echo $res->descricao; ?></p>
                    </div>
                </div>
            </article>

        </section>

        <section class="coment">
            <header class="titulo_coment">
                <h1>Comentários</h1>
            </header>

            <div class="content_coment">
                <form action="comentar.php" method="POST" class="form_coment ">
                <div class="saco">
                    <textarea id="coment" name="coment" rows="5" cols="33" placeholder="Comentar..." class="area"></textarea>
            </div>
                    <div class="estrelas">
                        
                        <input type="radio" id="pontuacao-1" name="nota" value="1"required>
                        <label for="pontuacao-1" onclick="marcarEstrelas(1)"><img src="../../img/icons/estrela_vazia.png"style="width:25px;height:25px;" alt=""></label>

                        <input type="radio" id="pontuacao-2" name="nota" value="2"required>
                        <label for="pontuacao-2"onclick="marcarEstrelas(2)"><img src="../../img/icons/estrela_vazia.png"style="width:25px;height:25px;" alt=""></label>

                        <input type="radio" id="pontuacao-3" name="nota" value="3"required>
                        <label for="pontuacao-3"onclick="marcarEstrelas(3)"><img src="../../img/icons/estrela_vazia.png"style="width:25px;height:25px;" alt=""></label>


                        <input type="radio" id="pontuacao-4" name="nota" value="4"required>
                        <label for="pontuacao-4"onclick="marcarEstrelas(4)"><img src="../../img/icons/estrela_vazia.png"style="width:25px;height:25px;" alt=""></label>

                        
                        <input type="radio" id="pontuacao-5" name="nota" value="5"required>
                        <label for="pontuacao-5"onclick="marcarEstrelas(5)"><img src="../../img/icons/estrela_vazia.png"style="width:25px;height:25px;" alt=""></label>

                        <input type="hidden" name="idRes" value="<?php echo $idres;?>" >
                    </div>
                
                        </script>
                
                    <div class="butao_coment">
                        <input type="submit" value="Avaliar"></input>
                    </div>
                </form>
                <?php
                $query = 'SELECT * FROM `coment` WHERE id_res = ' . $idres . ' ORDER BY data_coment, id_coment DESC LIMIT 3;';
                $result = mysqli_query($conexao, $query);
                $row = mysqli_num_rows($result);
                if ($row >= 1) {
                    //Testa se retornou dados e abre um for para listar
                    foreach ($result as $com) {
                        echo '<div class="comentario_cli">';
                        echo '<div class="coment_cli_content">';
                        $comentario = new coment($com['id_coment'], $com['id_cli'], $com['id_res'], $com['coment_coment'], $com['data_coment'], $com['nota_coment']);
                        # Consulta se o email e a senha digitados conhecidem com alguma entrada no banco de dados
                        $idCliCom = $comentario->id_cli;
                        $query = "SELECT nome_cli FROM `CLI` WHERE id_cli = '$idCliCom'";
                        $result = mysqli_query($conexao, $query); # Armazena o resultado da consulta ao banco
                        $nomeCli = mysqli_fetch_assoc($result); # Armazena todos os dados referentes ao resultado da consulta

                        echo '<div class="info_coment_cli1">';
                        echo '<h3>'."Enviado por"." " . $nomeCli["nome_cli"] . '</h3>';
                        
                        echo '<p>'; 
                         for ($i = 1; $i <= 5; $i++) {
                            $starImage = ($i <= $com['nota_coment']) ? '../../img/icons/estrela.png' : '../../img/icons/estrela_vazia.png';
                            echo '<img src="' . $starImage . '" style="width: 20px; height: 20px;">';
                        }  
                        echo '</p>';
                        echo '</div>';

                        echo '<div class="info_coment_cli2">';
                        echo '<p>' . $comentario->coment . '</p>';
                        echo '</div>';

                        echo '</div>'; //coment_cli_content
                        echo '</div>'; //comentario_cli
                    }
                }
                ?>
            </div>


        </section>

    </main>
    <?php include("../../layout/footer.php"); ?>
    
    <script>
                function marcarEstrelas(pontuacao) {
                    var estrelas = document.querySelectorAll('.estrelas label img');

                    for (var i = 0; i < estrelas.length; i++) {
                        if (i < pontuacao) {
                            estrelas[i].src = '../../img/icons/estrela.png';
                        } else {
                            estrelas[i].src = '../../img/icons/estrela_vazia.png';
                        }
                    }
                }
            </script>
</body>

</html>