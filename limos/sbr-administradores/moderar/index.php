<?php
include('../../conexao.php');
include('../../objs/objetos.php');
include ("../../layout/header.php");

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
                    <img src="../../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos" title="Bem vindo ao projeto Limos"></a>
            </div>

            <nav class="main_header_content_menu">
                <ul>
                    <li>
                        <a href="index.php?status=1&filtro=">Clientes</a>

                    </li>
                    <li>
                        <a href="index.php?status=2&filtro=">Comentários</a>
                    </li>
                    <li>
                        <a href="index.php?status=3&filtro=">Restaurantes</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>


    <form action="index.php" method="get">
        <h1>Filtrar Resultados</h1>
        <input type="search" name="filtro" id="filtro"><br>
        <input type="text" name="status" style="display: none;" value="<?php echo $status; ?>">
        <button type="submit">Filtrar</button>
    </form>
    <?php
    switch ($status) {
        case 1:
            $query = 'SELECT * FROM cli WHERE nome_cli LIKE "%' . $filtro . '%" ORDER BY data_reg_cli;';
            $result = mysqli_query($conexao, $query);
            $row = mysqli_num_rows($result);
            if ($row >= 1) {
                foreach ($result as $cli) {

                    if ($filtro != null) {
                        echo '<h1>Resultados escontrados para "' . $filtro . '"</h1>';
                    }

                    $cli2 = new cliente();
                    $cli2->id = $cli["id_cli"];
                    $cli2->nome = $cli["nome_cli"];
                    $cli2->statusConta = $cli["status_conta_cli"];
                    $cli2->email = $cli["email_cli"];
                    $cli2->telefone = $cli["telefone_cli"];
                    $cli2->dataRes = $cli["data_reg_cli"];
                    $cli2->gostos = $cli["gostos_cli"];

                    echo '<div class="">';
                    echo "<h2>" . $cli2->nome;
                    if ($cli2->statusConta == 3) {
                        echo " - BANIDO";
                    }
                    echo "</h2>";
                    echo "<p>Status da Conta: ";
                    echo $cli2->statusConta . "</p>";
                    echo "<p>E-mail: " . $cli2->email . "</p>";
                    echo '<a href="cliente/index.php?idCli=' . $cli2->id . '">Ver mais</a>';
                    echo '</div>';
                }
            } else {
                echo "<h1>Não foram encontrados quaisquer resultados.</h1>";
            }
            break;
        case 2:
            $query = 'SELECT * FROM coment WHERE coment_coment LIKE "%' . $filtro . '%" ORDER BY data_coment DESC;';
            $result = mysqli_query($conexao, $query);
            $row = mysqli_num_rows($result);
            if ($row >= 1) {
                if ($filtro != null) {
                    echo '<h1>Resultados escontrados onde "' . $filtro . '" aparece nos comentários</h1>';
                }
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
                    echo '<h2>' . "Enviado por" . " " . $nomeCli["nome_cli"] . '</h2>';
                    echo '<h3>' . "Referente ao restaurante" . " " . $nomeRes["nome_res"] . '</h3>';
                    echo '<p>' . $comentario->nota_coment . " Estrelas - " . $comentario->data_coment . '</p>';
                    echo '<p>' . $comentario->coment . '</p>';
                    echo '<a href="cliente/index.php?idCli=' . $com['id_cli'] . '">Ver mais sobre o cliente</a><br>';
                    echo '<a href="restaurante/index.php?idRes=' . $idRes . '">Ver mais sobre o restaurante</a>';
                }
            } else {
                echo "<h1>Não foram encontrados quaisquer resultados.</h1>";
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
                    echo '<h1>Resultados escontrados para "' . $filtro . '"</h1>';
                }
                foreach ($result as $res) {
                    $res2 = new restaurante($res["id_res"], $res["nome_res"], $res["tipo_res"], $res["dia_hora_func_res"], $res["encomenda_res"], $res["entrega_res"], $res["telefone_res"], $res["desc_res"], $res["cardapio_res"], $res["cnpj_res"], $res["fotos_res"], $res["nota_res"], $res["status_conta_res"], $res["whatsapp_res"], $res["instagram_res"]);
                    echo '<h2>' . $res['nome_res'];
                    if ($res["status_conta_res"] == 3) {
                        echo " - BANIDO";
                    }
                    echo '</h2>';
                    echo '<img src="../../img/restaurantes/' . $res['fotos_res'] . '" alt="' . $res['nome_res'] . '" style="width: 100px">';
                    echo '<p>' . $res2->tipo() . '</p>';
                    echo "<p>Status da Conta: " . $res["status_conta_res"] . "</p>";
                    echo '<h3>Descrição</h3>';
                    echo limita_caracteres($res['desc_res'], 150);
                    echo "<br>";
                    echo '<a href="restaurante/index.php?idRes=' . $res["id_res"] . '">Ver mais</a>';
                }
            } else {
                echo "<h1>Não foram encontrados quaisquer resultados.</h1>";
            }
            break;
        default:
            echo "<h1>Status Inválido</h1>";
            break;
    }
    ?>
    <?php include ("../../layout/footer.php");?>
</body>

</html>