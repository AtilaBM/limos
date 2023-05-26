<?php
    include('../../conexao.php');
    include ('../../objs/objetos.php');
    include ("../../layout/header.php");                             
    include ("../../layout/menu_login.php");   
    session_start();                          
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/pesquisa/pesquisa.css">
    <title>Limos - Pesquisa</title>
</head>
<body>
        <form action="index.php" method="post">
            <div class="form_content">
                <input type="text" name="pesquisa"  id="pesquisa" placeholder="Digite o nome do restaurante..." autocomplete="off">
                <input type="submit" value="Pesquisar">
            </div>
        </form>
    <?php
        $pesquisa =  mysqli_real_escape_string($conexao, trim(isset($_POST["pesquisa"]) ? $_POST["pesquisa"] : 0));
        $query = 'SELECT * FROM res WHERE nome_res LIKE "%'.$pesquisa.'%" ORDER BY nome_res;';
        $result = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($result);

        
function limita_caracteres($texto, $limite, $quebra = true){
   $tamanho = strlen($texto);
   if($tamanho <= $limite){ //Verifica se o tamanho do texto é menor ou igual ao limite
      $novo_texto = $texto;
   }else{ // Se o tamanho do texto for maior que o limite
      if($quebra == true){ // Verifica a opção de quebrar o texto
         $novo_texto = trim(substr($texto, 0, $limite))."...";
      }else{ // Se não, corta $texto na última palavra antes do limite
         $ultimo_espaco = strrpos(substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limite
         $novo_texto = trim(substr($texto, 0, $ultimo_espaco))."..."; // Corta o $texto até a posição localizada
      }
   }
   return $novo_texto; // Retorna o valor formatado
}

        
        if($row >= 1){ 
            //Testa se retornou dados e abre um for para listar
           echo '<header class="titulo_pesquisa">';
            echo '<h1>'; 
            echo "Restaurante Encontrados com o nome de"." ".$pesquisa;
            echo '</h1>';
            echo '</header>';

            echo '<main class="main_res">';

            
                echo '<section class="content_res">';

                foreach($result as $res ){
                    $res2 = new restaurante($res["id_res"],$res["nome_res"],$res["tipo_res"],$res["dia_hora_func_res"],$res["encomenda_res"],$res["entrega_res"],$res["telefone_res"],$res["desc_res"],$res["cardapio_res"],$res["cnpj_res"], $res["fotos_res"], $res["nota_res"], $res["status_conta_res"], $res["whatsapp_res"], $res["instagram_res"]);

                    if($res['status_conta_res'] == 1){
                       
                        echo '<article class="info_res">';

                            echo '<div class="img_res">';
                                echo '<img src="../../img/restaurantes/'.$res['fotos_res'].'" alt="'.$res['nome_res'].'">';
                            echo '</div>';

                            echo '<div class="infos_grup">';

                            echo '<div class="miniinfo_res">';
                                echo '<h2>'.$res['nome_res'].'</h2>';
                                echo '<p>'.$res2->tipo().'</p>';
                                echo '<h3>Descrição</h3>';
                                echo '<p>';
                                echo limita_caracteres($res['desc_res'],150);
                                echo '</p>';
                                
                            echo '</div>';

                            echo '<div class="ver_mais_button">';

                            echo '<a href="../restaurantes/index.php?idRes='.$res['id_res'].'" class="ver_mais">';
                            echo 'Ver mais</a>'; 

                            echo '</div>'; //ver_mais_button
                            echo '</div>'; //infos_grup
                        echo '</article>'; //info_res

                        
                    }                   
                }
                echo '</section>'; //content_res
            echo '</main> '; //main_res
        }else{
            // echo "<h1 class='txt_erro'>Nenhum Restaurante encontrado</h1>";
        }
    ?>
    <?php include ("../../layout/footer.php");?>
</body>
</html>