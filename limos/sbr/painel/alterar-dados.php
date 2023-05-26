<?php
    include("../../conexao.php");
    include_once("../../objs/objetos.php");
    session_start();
    include("../../layout/header.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/boot.css">
    <link rel="stylesheet" href="../../css/conta_cli/altera_dado.css">
    <title>Alterar Dados</title>
</head>
<body>
    <!-- HEADER-------------------------------- -->
    <header  class="main_header">
        <div class="main_header_content">
            <div class="img_logo">
                <a href="../../sbr/index.php" class="logo">
                    <img src="../../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos"
                        title="Bem vindo ao projeto Limos"></a>
            </div>
    
            <nav class="main_header_content_menu">
                <div class="menu_a_inportant">
                        <a href="index.php" class="cadastro_menu">Voltar</a>
                    </div>
            </nav>
        </div>
    </header>
    <!-- FIM HEADER------------------------------ -->
    <form class="form_cadastro" action="modifica-dados.php" method="post" autocomplete="off">

<div class="form_cadastro_content">

    <div class="form_cadastro_content_titulo">
        <h1>Informações Pessoais</h1>
    </div>

    <div class="form_cadastro_input_grupo">

        <div class="form_cadastro_input_box">
            <input type="text" name="nome" id="nome" autofocus 
            <?php $_SESSION['cliente']->nomeCli()?>>
            <label for="nome">Nome</label>
        </div>

        <div class="form_cadastro_input_box">
            <input type="email" name="email" id="email" 
            <?php $_SESSION['cliente']->emailCli()?>>
            <label for="email">E-mail</label>

        </div>

        <div class="form_cadastro_input_box">
            <input type="password" name="password" id="password" >
            <label for="password">Senha Atual</label>
        </div>

        <div class="form_cadastro_input_box">
            <input type="password" name="newPassword" id="newPassword">
            <label for="password">Nova senha</label>
        </div>

        <div class="form_cadastro_input_box">
            <input type="password" name="newPasswordConfirm" id="newPasswordConfirm"">
            <label for="password">Confirmar nova senha</label>
        </div>

        <div class="form_cadastro_input_box">
            <input type="tel"  name="telefone"  id="telefone mask_num" minlength="14" maxlength="14"
            <?php $_SESSION['cliente']->telefoneCli()?>>
            <label for="telefone">Telefone</label>

        </div>

        <div class="form_cadastro_input_box">
            <input type="text" id="cep mask_num" name="cep" maxlength="8" minlength="8" 
            <?php $_SESSION['endereco']->cepCli()?>>
            <label for="cep">CEP</label>

        </div>

        <div class="form_cadastro_input_box">
            <input type="text" id="uf" name="uf" 
            <?php $_SESSION['endereco']->ufCli()?>>
            <label for="uf">UF </label>

        </div>

        <div class="form_cadastro_input_box">
            <input type="text" id="cidade" name="cidade" 
            <?php $_SESSION['endereco']->cidadeCli()?>>
            <label for="cidade">Cidade</label>

        </div>

        <div class="form_cadastro_input_box">
            <input type="text" id="bairro" name="bairro" 
            <?php $_SESSION['endereco']->bairroCli()?>>
            <label for="bairro">Bairro </label>

        </div>

        <div class="form_cadastro_input_box">
            <input type="text" id="endereco" name="endereco" 
            <?php $_SESSION['endereco']->logradouroCli()?>>
            <label for="endereco">Logradouro </label>

        </div>
        <?php include("../../avisos.php"); ?> 
        <input class="butao_proximo" type="submit" id="altera_dado" value="Alterar dados" >

    </div>

</div>

</form>
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
                <li><a href="../sbr/spanesquisa/index.php">Restaurantes</a></li>
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
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script>
        // Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
        // quando o usuário sair do campo "cep"
        $("#cep").blur(function(){
            // Remove tudo o que não é número para fazer a pesquisa
            var cep = this.value.replace(/[^0-9]/, "");
            
            // Validação do CEP; caso o CEP não possua 8 números, então cancela
            // a consulta
            if(cep.length != 8){
                return false;
            }
            
            // A url de pesquisa consiste no endereço do webservice + o cep que
            // o usuário informou + o tipo de retorno desejado (entre "json",
            // "jsonp", "xml", "piped" ou "querty")
            var url = "https://viacep.com.br/ws/"+cep+"/json/";
            
            // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
            // caso ocorra algum erro (o cep pode não existir, por exemplo) a
            // usabilidade não seja afetada, assim o usuário pode continuar//
            // preenchendo os campos normalmente
            $.getJSON(url, function(dadosRetorno){
                try{
                    // Preenche os campos de acordo com o retorno da pesquisa
                    $("#endereco").val(dadosRetorno.logradouro);
                    $("#bairro").val(dadosRetorno.bairro);
                    $("#cidade").val(dadosRetorno.localidade);
                    $("#uf").val(dadosRetorno.uf);
                }catch(ex){}
            });
        });
    </script>
</body>
</html>