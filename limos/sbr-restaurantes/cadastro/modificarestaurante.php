<?php
include("../../conexao.php");
include_once("../../objs/objetos.php");
include("../../layout/header.php");
include("../../layout/menu_login.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/cadastro_res/modificares.css">
    <title>Dados do Restaurante</title>
</head>
<body>

    <form action="finalizarcadastro.php" method="post" enctype="multipart/form-data">
        <div class="form_content">

            <div class="form_content_titulo">
                <h1>Informações do Restaurante</h1>
            </div>

            <div class="form_input_grupo">
                <div class="form_cadastro_input_box">
                    <input type="text" name="nome" <?php $_SESSION['restaurante']->nome() ?>>
                    <label for="nome">Nome do Restaurante </label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="file" name="imagem" accept="image/png, image/jpeg">
                    <label for="imagem">Foto do Restaurante</label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" name="cnpj" id="cnpj" onkeyup="FormataCnpj(this,event)" maxlength="18" onblur="if(!validarCNPJ(this.value)){alert('CNPJ Informado é inválido'); this.value='';}" <?php $_SESSION['restaurante']->cnpj() ?>>
                    <label for="cnpj">CNPJ</label>
                </div>

                <div class="form_cadastro_input_box">
                    <input type="text" name="tel" <?php $_SESSION['restaurante']->telefone() ?>>
                    <label for="cel">Telefone</label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" name="whats" <?php $_SESSION['restaurante']->whatsapp() ?>>
                    <label for="whats">WhatsApp</label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" name="insta" <?php $_SESSION['restaurante']->instagram() ?>>
                    <label for="tel">Instagram</label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" id="cep" name="cep" maxlength="8" minlength="8" required <?php $_SESSION['enderecoRes']->cepRes() ?>>
                    <label for="cep">CEP</label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" id="uf" name="uf" required <?php $_SESSION['enderecoRes']->ufRes() ?>>
                    <label for="uf">UF </label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" id="cidade" name="cidade" required <?php $_SESSION['enderecoRes']->cidadeRes() ?>>
                    <label for="cidade">Cidade</label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" id="bairro" name="bairro" required <?php $_SESSION['enderecoRes']->bairroRes() ?>>
                    <label for="bairro">Bairro </label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" id="endereco" name="endereco" required <?php $_SESSION['enderecoRes']->logradouroRes() ?>>
                    <label for="endereco">Logradouro </label>
                </div>
                <div class="form_cadastro_input_box">
                    <input type="text" id="numero" name="numero" <?php $_SESSION['enderecoRes']->numeroRes() ?>>
                    <label for="numero">Número</label>
                </div>
            </div>

            <div class="form_content_part2">
                <div class="tipores">
                    <!-- <label for="tipo" >Selecione o tipo do seu restaurante</label> -->
                    <select name="tipo" id="tipo">
                        <option value="#" selected disabled>Tipo Restaurante</option>
                        <option value="3" <?php $_SESSION['restaurante']->select(3) ?>>Churrascaria</option>
                        <option value="1" <?php $_SESSION['restaurante']->select(1) ?>>Doceria</option>
                        <option value="4" <?php $_SESSION['restaurante']->select(4) ?>>Loja de Fast Food</option>
                        <option value="2" <?php $_SESSION['restaurante']->select(2) ?>>Loja de Salgados</option>
                        <option value="6" <?php $_SESSION['restaurante']->select(6) ?>>Loja de Sushi</option>
                        <option value="5" <?php $_SESSION['restaurante']->select(5) ?>>Pizzaria</option>
                        <option value="11" <?php $_SESSION['restaurante']->select(11) ?>>Restaurante de comida Árabe</option>
                        <option value="10" <?php $_SESSION['restaurante']->select(10) ?>>Restaurante de comida Asiática</option>
                        <option value="7" <?php $_SESSION['restaurante']->select(7) ?>>Restaurante de comida Brasileira</option>
                        <option value="8" <?php $_SESSION['restaurante']->select(8) ?>>Restaurante de comida Francesa</option>
                        <option value="9" <?php $_SESSION['restaurante']->select(9) ?>>Restaurante de comida Italiana</option>
                    </select>
                </div>
                <div class="descres base_input">
                    <label for="desc">Descreva seu restaurante </label>
                    <textarea class="area" id="desc" name="desc" rows="5" cols="33">
                        <?php
                            if ($_SESSION["restaurante"]->statusContaRes == 1) {
                                echo trim($_SESSION["restaurante"]->descricao);
                            }
                                                                                    
                        ?>
                    </textarea>
                </div>
                <div class="func_dia_hora base_input">
                    <label for="dia_hora_func">Dias e horários de funcionamento </label>
                    <textarea class="area" id="dia_hora_func" name="dia_hora_func" rows="5" cols="33">
                        <?php
                            if ($_SESSION["restaurante"]->statusContaRes == 1) {
                                echo trim($_SESSION["restaurante"]->diahorafunc);
                            }
                        ?>
                    </textarea>
                </div>
                <div class="cardapio base_input">
                    <label for="cardapio">Uma imagem do cardápio </label>
                    <input type="file" name="cardapio" accept="image/png, image/jpeg">
                </div>
                <div class="Res_radio base_input">
                    <label for="entrega">O Restaurante Faz entregas?</label>
                    <input type="radio" name="entrega" value="1" <?php $_SESSION['restaurante']->entrega() ?>> Sim
                    <input type="radio" name="entrega" value="2" <?php $_SESSION['restaurante']->entrega(2) ?>> Não
                </div>
                <div class="Res_radio base_input">
                    <label for="encomenda">O Restaurante aceita encomendas?</label>
                    <input type="radio" name="encomenda" value="1" <?php $_SESSION['restaurante']->encomenda() ?>> Sim
                    <input type="radio" name="encomenda" value="2" <?php $_SESSION['restaurante']->encomenda(2) ?>> Não
                </div>
                <?php
                include("../../avisos.php");
                ?>
                <button type="submit" class="butao">Enviar</button>
            </div>
        </div>
    </form>
    <!-- FIM FORM-------------------------------------------------------------- -->
    <!-- FOOTER---------------------------------------------------- -->
    <?php include("../../layout/footer.php") ?>
    <!-- FIM FOOTER--------------------------------------------------------- -->
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script>
        // Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
        // quando o usuário sair do campo "cep"
        $("#cep").blur(function() {
            // Remove tudo o que não é número para fazer a pesquisa
            var cep = this.value.replace(/[^0-9]/, "");

            // Validação do CEP; caso o CEP não possua 8 números, então cancela
            // a consulta
            if (cep.length != 8) {
                return false;
            }

            // A url de pesquisa consiste no endereço do webservice + o cep que
            // o usuário informou + o tipo de retorno desejado (entre "json",
            // "jsonp", "xml", "piped" ou "querty")
            var url = "https://viacep.com.br/ws/" + cep + "/json/";

            // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
            // caso ocorra algum erro (o cep pode não existir, por exemplo) a
            // usabilidade não seja afetada, assim o usuário pode continuar//
            // preenchendo os campos normalmente
            $.getJSON(url, function(dadosRetorno) {
                try {
                    // Preenche os campos de acordo com o retorno da pesquisa
                    $("#endereco").val(dadosRetorno.logradouro);
                    $("#bairro").val(dadosRetorno.bairro);
                    $("#cidade").val(dadosRetorno.localidade);
                    $("#uf").val(dadosRetorno.uf);
                } catch (ex) {}
            });
        });
    </script>
    <script>
        function FormataCnpj(campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(campo.value);
				vr = vr.replace(".", "");
				vr = vr.replace("/", "");
				vr = vr.replace("-", "");
				tam = vr.length + 1;
				if (tecla != 14)
				{
					if (tam == 3)
						campo.value = vr.substr(0, 2) + '.';
					if (tam == 6)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 5) + '.';
					if (tam == 10)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/';
					if (tam == 15)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/' + vr.substr(9, 4) + '-' + vr.substr(13, 2);
				}
			}



        function validarCNPJ(cnpj) {
    
            cnpj = cnpj.replace(/[^\d]+/g,'');
        
            if(cnpj == '') return false;
            
            if (cnpj.length != 14)
                return false;
        
            // Elimina CNPJs invalidos conhecidos
            if (cnpj == "00000000000000" || 
                cnpj == "11111111111111" || 
                cnpj == "22222222222222" || 
                cnpj == "33333333333333" || 
                cnpj == "44444444444444" || 
                cnpj == "55555555555555" || 
                cnpj == "66666666666666" || 
                cnpj == "77777777777777" || 
                cnpj == "88888888888888" || 
                cnpj == "99999999999999")
                return false;
                
            // Valida DVs
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0,tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;
                
            tamanho = tamanho + 1;
            numeros = cnpj.substring(0,tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;
                
            return true;
        }
    </script>
</body>

</html>
