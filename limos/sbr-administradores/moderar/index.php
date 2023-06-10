<?php
include('../../conexao.php');
include('../../objs/objetos.php');
include("../../layout/header.php");

session_start();
$status =  mysqli_real_escape_string($conexao, trim(isset($_GET["status"]) ? $_GET["status"] : 0));
$filtro =  mysqli_real_escape_string($conexao, trim(isset($_GET["filtro"]) ? $_GET["filtro"] : null));
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/admsis/moderar.css">
    <title>Moderar</title>
</head>

<body>
    <header class="main_header">
        <div class="main_header_content">
            <div class="img_logo">
                <a href="index.php" class="logo">
                    <img src="../../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos" title="Bem vindo ao projeto Limos">
                </a>
            </div>

            <nav class="main_header_content_menu" id="main_header_content_menu">
                <ul id="top-menu">
                    <li>
                        <a href="index.php?status=1&filtro=" class="btn">Clientes</a>

                    </li>
                    <li>
                        <a href="index.php?status=2&filtro=" class="btn">Comentários</a>
                    </li>
                    <li>
                        <a href="index.php?status=3&filtro=" class="btn">Restaurantes</a>
                    </li>
                    <div class="menu_a_inportant">
                        <a href="../index.php" > <i class="fas fa-home"></i> </a>

                    </div>
        </div>
        </ul>
        </nav>
        </div>
    </header>


    <main>
        <section>
            <article class="busca">
                <form action="index.php" method="get" class="campo-busca">
                    <input type="search" name="filtro" id="filtro" placeholder="Buscar....">
                    <input type="text" name="status" style="display: none;" value="<?php echo $status; ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </article>
            <article class="moderados">
                <?php
                switch ($status) {
                    case 1:
                        $query = 'SELECT * FROM cli WHERE nome_cli LIKE "%' . $filtro . '%" ORDER BY data_reg_cli;';
                        $result = mysqli_query($conexao, $query);
                        $row = mysqli_num_rows($result);
                        if ($row >= 1) {
                            echo '<table class="moderacao_tabela cliente">';

                            echo "<tr>";

                            echo "<th>ID</th>";
                            echo "<th>Nome</th>";
                            echo "<th>Status da Conta</th> ";
                            echo "<th>E-mail </th>";
                            echo "<th>telefone </th>";
                            echo "<th>Mais informações </th>";

                            echo "</tr>";
                            foreach ($result as $cli) {
                                if ($filtro != null) {
                                    echo '<h1 class="sucesso">Resultados escontrados para "' . $filtro . '"</h1>';
                                }
                                $cli2 = new cliente(null, null, null, null, null, null, null, null);
                                $cli2->id = $cli["id_cli"];
                                $cli2->nome = $cli["nome_cli"];
                                $cli2->statusConta = $cli["status_conta_cli"];
                                $cli2->email = $cli["email_cli"];
                                $cli2->telefone = $cli["telefone_cli"];
                                $cli2->dataRes = $cli["data_reg_cli"];
                                $cli2->gostos = $cli["gostos_cli"];


                                echo "<tr>";

                                echo "<td>$cli2->id</td>";
                                echo "<td>$cli2->nome</td>";
                                echo "<td>";
                                echo  $cli["status_conta_cli"] == 1 ? "Ativo" : "Desativado";
                                echo "</td>";
                                echo  "<td>$cli2->email</td>";
                                echo  "<td>$cli2->telefone</td>";
                                echo '<td><a href="cliente/index.php?idCli=' . $cli2->id . '">Ver mais</a></td>';

                                echo "</tr>";
                            }
                            echo '</table>';
                        } else {
                            echo "<h1 class='erro'>*Sem resultatos para essa busca*</h1>";
                        }
                        break;
                    case 2:
                        $query = 'SELECT * FROM coment WHERE coment_coment LIKE "%' . $filtro . '%" ORDER BY data_coment DESC;';
                        $result = mysqli_query($conexao, $query);
                        $row = mysqli_num_rows($result);
                        if ($row >= 1) {
                            if ($filtro != null) {
                                echo '<h1 class="sucesso">Resultados escontrados onde a palavra "' . $filtro . '" aparece nos comentários</h1>';
                            }
                            echo '<table class="moderacao_tabela restaurante">';

                            echo "<tr>";
                            echo "<th>Comentário </th>";
                            echo "<th>Enviado por</th>";
                            echo "<th>Restaurante Comentado</th>";

                            echo "</tr>";

                            foreach ($result as $com) {
                                $comentario = new coment($com['id_coment'], $com['id_cli'], $com['id_res'], $com['coment_coment'], $com['data_coment'], $com['nota_coment']);
                                $idCliCom = $comentario->id_cli;
                                $query = "SELECT nome_cli FROM `CLI` WHERE id_cli = '$idCliCom'";
                                $result = mysqli_query($conexao, $query);
                                $nomeCli = mysqli_fetch_assoc($result);
                                $idRes = $com['id_res'];
                                $query = "SELECT nome_res FROM `res` WHERE id_res = '$idRes'";
                                $result = mysqli_query($conexao, $query);
                                $nomeRes = mysqli_fetch_assoc($result);
                                
                                echo "<tr>";

                                echo "<td>";
                                echo '<p>';
                                for ($i = 1; $i <= 5; $i++) {
                                    $starImage = ($i <= $com['nota_coment']) ? '../../img/icons/estrela.png' : '../../img/icons/estrela_vazia.png';
                                    echo '<img src="' . $starImage . '" style="width: 20px; height: 20px;">';
                                } 
                                echo '<span style="margin-left:5px;">'.$comentario->data_coment . '</span></p>';
                                echo '<p style="margin-top:5px;">' . $comentario->coment . '</p>';
                                echo "</td>";

                                echo '<td><a href="cliente/index.php?idCli=' . $com['id_cli'] . '">' . $nomeCli["nome_cli"] . '</td></a>';
                                echo '<td><a href="restaurante/index.php?idRes=' . $idRes . '">'.$nomeRes["nome_res"] . '</a></td>';
                               
                                

                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<h1 class='erro'>*Sem resultatos para essa busca*</h1>";
                        }
                        break;
                    case 3:

                        $query = 'SELECT * FROM res WHERE nome_res LIKE "%' . $filtro . '%" ORDER BY nome_res;';
                        $result = mysqli_query($conexao, $query);
                        $row = mysqli_num_rows($result);
                        function limita_caracteres($texto, $limite, $quebra = true)
                        {
                            $tamanho = strlen($texto);
                            if ($tamanho <= $limite) { //Verifica se o tamanho do texto é menor ou igual ao limite
                                $novo_texto = $texto;
                            } else { // Se o tamanho do texto for maior que o limite
                                if ($quebra == true) { // Verifica a opção de quebrar o texto
                                    $novo_texto = trim(substr($texto, 0, $limite)) . "...";
                                } else { // Se não, corta $texto na última palavra antes do limite
                                    $ultimo_espaco = strrpos(substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limite
                                    $novo_texto = trim(substr($texto, 0, $ultimo_espaco)) . "..."; // Corta o $texto até a posição localizada
                                }
                            }
                            return $novo_texto; // Retorna o valor formatado
                        }
                        if ($row >= 1) {

                            if ($filtro != null) {
                                echo '<h1 class="sucesso">Resultados escontrados para "' . $filtro . '"</h1>';
                            }
                            echo '<table class="moderacao_tabela restaurante">';

                            echo "<tr>";


                            echo "<th>Nome</th>";
                            echo "<th>Status da Conta</th> ";
                            echo "<th>Telefone </th>";
                            echo "<th>Tipo do restaurante</th>";
                            echo "<th>Mais informações </th>";

                            echo "</tr>";
                            foreach ($result as $res) {

                                $res2 = new restaurante($res["id_res"], $res["nome_res"], $res["tipo_res"], $res["dia_hora_func_res"], $res["encomenda_res"], $res["entrega_res"], $res["telefone_res"], $res["desc_res"], $res["cardapio_res"], $res["cnpj_res"], $res["fotos_res"], $res["nota_res"], $res["status_conta_res"], $res["whatsapp_res"], $res["instagram_res"]);


                                echo "<tr>";

                                echo '<td>' . $res['nome_res'] . '</td>';
                                echo '<td>';
                                if ($res["status_conta_res"] == 2) {
                                    echo " Desativado";
                                } else if ($res["status_conta_res"] == 3) {
                                    echo " Banido";
                                } else {
                                    echo "ativo";
                                }
                                echo '</td>';
                                // echo '<img src="../../img/restaurantes/' . $res['fotos_res'] . '" alt="' . $res['nome_res'] . '" style="width: 100px">';

                                echo '<td>' . $res["telefone_res"] . '</td>';
                                echo '<td>';
                                echo $res2->tipo();
                                echo '</td>';
                                // echo "<td>" . limita_caracteres($res['desc_res'], 150) . "</td>";
                                echo '<td><a href="restaurante/index.php?idRes=' . $res["id_res"] . '">Ver mais</a></td>';

                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {

                            echo "<h1 class='erro'>*Sem resultatos para essa busca*</h1>";
                        }
                        break;
                    default:
                        echo "<h1 class='erro'>Status Inválido</h1>";
                        break;
                }

                ?>
            </article>
        </section>
    </main>
    <?php include("../../layout/footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script>
    </script>
</body>

</html>