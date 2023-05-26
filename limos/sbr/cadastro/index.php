<?php
session_start();
include("../../conexao.php");
include_once("../../objs/objetos.php");
include("../../layout/header.php");
include("../../layout/menu_login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/cadastro_cli/cadastrocli.css">
    <title>Cadastro</title>
</head>

<body>

    <!-- FORM----------------------------------------------------------- -->
    <form class="form_cadastro" action="cadastrar.php" method="post" autocomplete="off" name="f1">

        <div class="form_cadastro_content">

            <div class="form_cadastro_content_titulo">
                <h1>Informações Pessoais</h1>
            </div>

            <div class="form_cadastro_input_grupo">

                <div class="form_cadastro_input_box">
                    <input type="text" name="nome" id="nome" autofocus>
                    <label for="nome">Nome</label>
                </div>

                <div class="form_cadastro_input_box">
                    <input type="email" name="email" id="email" onblur="validacaoEmail(f1.email)">
                    <label for="email">Email</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="password" id="password" minlength="8">
                    <label for="password">Senha</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="password" name="password-confirm" id="password-confirm" minlength="8">
                    <label for="password-confirm">Confirmar Senha</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="tel" name="telefone" id="telefone" minlength="14" maxlength="14">
                    <label for="telefone">Telefone </label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="text" id="cep" name="cep" maxlength="8" minlength="8">
                    <label for="cep">CEP</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="text" id="uf" name="uf">
                    <label for="uf">UF </label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="text" id="cidade" name="cidade">
                    <label for="cidade">Cidade</label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="text" id="bairro" name="bairro">
                    <label for="bairro">Bairro </label>

                </div>

                <div class="form_cadastro_input_box">
                    <input type="text" id="endereco" name="endereco">
                    <label for="endereco">Logradouro </label>

                </div>
                <?php include("../../avisos.php"); ?>
                <input class="butao_proximo" type="submit" id="prosseguir_login" value="Prosseguir">

            </div>

        </div>

    </form>
    <!-- FIM FORM-------------------------------------------------------------- -->
    <!-- FOOTER---------------------------------------------------- -->
    <?php require_once("../../layout/footer.php"); ?>
    <!-- FIM FOOTER--------------------------------------------------------- -->

    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="../../js/sweetalert2.js"></script>
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
        const input = document.getElementById("telefone");
        input.addEventListener("keyup", formatarTelefone);

        function formatarTelefone(e) {
            var v = e.target.value.replace(/\D/g, "");
            v = v.replace(/^(\d\d)(\d)/g, "($1)$2");
            v = v.replace(/(\d{5})(\d)/, "$1-$2");
            e.target.value = v;
        }
    </script>
    <script>
        function validacaoEmail(field) {
            usuario = field.value.substring(0, field.value.indexOf("@"));
            dominio = field.value.substring(field.value.indexOf("@") + 1, field.value.length);

            if ((usuario.length >= 1) &&
                (dominio.length >= 3) &&
                (usuario.search("@") == -1) &&
                (dominio.search("@") == -1) &&
                (usuario.search(" ") == -1) &&
                (dominio.search(" ") == -1) &&
                (dominio.search(".") != -1) &&
                (dominio.indexOf(".") >= 1) &&
                (dominio.lastIndexOf(".") < dominio.length - 1)) {} else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Esse email não é válido!',
                })
            }
        }
    </script>
</body>

</html>