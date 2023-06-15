<style>
    .aviso {
        color: red;
        font-size: 0.85em;
        margin: 5px 5px;
    }
    .aviso2 {
        color: #FF5733;
        font-size: 0.85em;
        margin: 5px 5px;
    }
</style>
<?php
    # Este arquivo contem todas os avisos do sistema
    $aviso = '<p>';
    $aviso2 = '<p>';

    # Flags de erros de cadastro

    if (isset($_SESSION['dados_incompletos'])) {
        echo $aviso . "Por favor, preencha todos os campos.</p>";
        unset($_SESSION['dados_incompletos']);
    }
    if (isset($_SESSION['erro_conexao_banco'])) {
        echo $aviso . "Ocorreu um erro ao se conectar com o banco de dados.</p>";
        unset($_SESSION['erro_conexao_banco']);
    }
    if (isset($_SESSION['senha_errada'])) {
        echo $aviso . "As senhas devem ser iguais.</p>";
        unset($_SESSION['senha_errada']);
    }
    if (isset($_SESSION['email_existe'])) {
        echo $aviso . "O e-mail digitado já foi cadastrado. Por favor digite outro endereço de e-mail.</p>";
        unset($_SESSION['email_existe']);
    }
    if (isset($_SESSION['erro_inesperado'])) {
        echo $aviso . "Um erro inesperado ocorreu. Por favor, tente se cadastrar novamente mais tarde.</p>";
        unset($_SESSION['erro_inesperado']);
    }
    if (isset($_SESSION['ErroCadGostos'])) {
        echo $aviso . "Ocorreu um erro ao atualizar os seus gostos. Por favor, tente novamente mais tarde</p>";
        unset($_SESSION['ErroCadGostos']);
    }
    if (isset($_SESSION['erro_inesperado_1'])) {
        echo $aviso . "Um erro inesperado ocorreu ao tentar fazer contado com o banco de dados. Por favor, tente se cadastrar novamente mais tarde.</p>";
        unset($_SESSION['erro_inesperado']);
    }
    if (isset($_SESSION['erro_inesperado_2'])) {
        echo $aviso . "Um erro inesperado ocorreu ao tentar fazer contado com o banco de dados. Por favor, tente se cadastrar novamente mais tarde.</p>";
        unset($_SESSION['erro_inesperado2']);
    }
    if (isset($_SESSION['erroCadEnd'])) {
        echo $aviso . "Ocorreu um erro ao cadastrar o endereço. Por favor, tente se cadastrar novamente mais tarde.</p>";
        unset($_SESSION['erroCadEnd']);
    }
    if (isset($_SESSION['ErroUpdadeDadosRestaurante'])) {
        echo $aviso . "Ocorreu um erro ao fazer o update dos dados do restaurante.</p>";
        unset($_SESSION['ErroUpdadeDadosRestaurante']);
    }
    if (isset($_SESSION['cnpj_existe'])) {
        echo $aviso . "O cnpj digitado já foi cadastrado. Por favor digite outro cnpj ou deixa a opção nula.</p>";
        unset($_SESSION['cnpj_existe']);
    }
    if (isset($_SESSION['ErroUpdadeCnpj'])) {
        echo $aviso . "Ocorreu um erro ao fazer o updade do cnpj</p>";
        unset($_SESSION['ErroUpdadeCnpj']);
    }
    if (isset($_SESSION['ErroUpdadeImagem'])) {
        echo $aviso . "Ocorreu um erro ao fazer o updade da imagem</p>";
        unset($_SESSION['ErroUpdadeImagem']);
    }
    if (isset($_SESSION['ErroUpdadeImagemCardapio'])) {
        echo $aviso . "Ocorreu um erro ao fazer o updade da imagem do cardápio</p>";
        unset($_SESSION['ErroUpdadeImagemCardapio']);
    }
    if (isset($_SESSION['updateEndereco'])) {
        echo $aviso . "Ocorreu um erro ao fazer o updade do endereço</p>";
        unset($_SESSION['updateEndereco']);
    }
    #Fim das flags de erros de cadastro

    # Flags de erro de login

    if (isset($_SESSION['incompleto'])) {
        echo $aviso . "Por favor preencha todos os campos.</p>";
        unset($_SESSION['incompleto']);
    }
    if (isset($_SESSION['nao_autenticado'])) {
        echo $aviso . "Senha ou email incorretos.</p>";
        unset($_SESSION['nao_autenticado']);
    }
    # Fim das flags de erro de login

    # Flags de erro de comentário

    if (isset($_SESSION['falha_autenticacao_cliente_comentar'])) {
        echo $aviso . "<p style='color:white;'>*É necessário estar logado para poder comentar e avaliar um restaurante*</p>";
        unset($_SESSION['falha_autenticacao_cliente_comentar']);
    }
    if (isset($_SESSION['comentario_incompleto'])) {
        echo $aviso . "Por favor, dê uma nota para o restaurante e escreva um pequeno texto para poder comentar.</p>";
        unset($_SESSION['comentario_incompleto']);
    }
    if (isset($_SESSION['ErroCadComent'])) {
        echo $aviso . "Ocorreu um erro ao registrar o seu comentário.</p>";
        unset($_SESSION['ErroCadComent']);
    }
    if (isset($_SESSION['ErroAtualizarComent'])) {
        echo $aviso . "Ocorreu um erro ao atualizar o seu comentário.</p>";
        unset($_SESSION['ErroAtualizarComent']);
    }
    # Fim das flags de erro de comentário

    # Flags de erro de alteração de dados pessoais do cliente

    if (isset($_SESSION['dados_incompletos-alterar-cliente'])) {
        echo $aviso . "É necessário que os campos estejam preenchidos para poder alterar os dados pessoais</p>";
        unset($_SESSION['dados_incompletos-alterar-cliente']);
    }
    if (isset($_SESSION['senha-errada'])) {
        echo $aviso . "A senha digitada está incorreta.</p>";
        unset($_SESSION['senha-errada']);
    }
    if (isset($_SESSION['ErroUpdadeDadosPessoais'])) {
        echo $aviso . "Ocorreu um erro ao atualizar as suas informações no banco de dados.</p>";
        unset($_SESSION['ErroUpdadeDadosPessoais']);
    }
    if (isset($_SESSION['ErroUpdadeDadosPessoaisEndereco'])) {
        echo $aviso . "Ocorreu um erro ao atualizar as suas informações referentes ao endereço no banco de dados.</p>";
        unset($_SESSION['ErroUpdadeDadosPessoaisEndereco']);
    }
    # Fim das flags de erro alteração de dados pessoais do cliente

    # Flags de erro de exclusão de conta

    if (isset($_SESSION['dados_incompletos-excluir'])) {
        echo $aviso . "É necessário que os campos estejam preenchidos para poder alterar os dados pessoais</p>";
        unset($_SESSION['dados_incompletos-excluir']);
    }
    if (isset($_SESSION['senha-errada-excluir'])) {
        echo $aviso . "A senha digitada está incorreta.</p>";
        unset($_SESSION['senha-errada-excluir']);
    }
    if (isset($_SESSION['del-opt-indef'])) {
        echo $aviso . "Por favor selecione uma das duas opções.</p>";
        unset($_SESSION['del-opt-indef']);
    }
    if (isset($_SESSION['ErroBancoDel'])) {
        echo $aviso . "Ocorreu um erro. Infelizmente não conseguimos fazer contato com o nosso banco de dados para efetuar o processo de dativação de sua conta.</p>";
        unset($_SESSION['ErroBancoDel']);
    }

    # Fim das flags de erro alteração de exclusão de conta
    if (isset($_SESSION["ErroAtivarConta"])) {
        echo $aviso . "Ocorreu um erro ao desativar a sua conta.</p>";
        unset($_SESSION["ErroAtivarConta"]);
    }
    # Fim das flags de erro alteração de exclusão de conta

    # Flags de erros de promoção
    if (isset($_SESSION["promocao_existe"])) {
        echo $aviso . "Seu restaurante já está sendo promovido.</p>";
        unset($_SESSION["promocao_existe"]);
    }
    if (isset($_SESSION["erro_conexao_ad"])) {
        echo $aviso . "Ocorreu um erro ao se comunicar com o banco para concluir a promoção do restaurante.</p>";
        unset($_SESSION["erro_conexao_ad"]);
    }
    if (isset($_SESSION["erro_data_ad"])) {
        echo $aviso . "Por favor, atente-se as datas de início e de fim da sua promoção.</p>";
        unset($_SESSION["erro_data_ad"]);
    }
    if (isset($_SESSION["ErroConexaoFinalizarAd"])) {
        echo $aviso . "Por favor, atente-se as datas de início e de fim da sua promoção.</p>";
        unset($_SESSION["ErroConexaoFinalizarAd"]);
    }
    if (isset($_SESSION["ErroConexaoReativarAd"])) {
        echo $aviso . "Ocorreu um erro em nosso banco de dados ao tentar ativar o seu anúncio.</p>";
        unset($_SESSION["ErroConexaoReativarAd"]);
    }
    if (isset($_SESSION['erro_conexao_pag_ad'])) {
        echo $aviso . "Ocorreu um erro em nosso banco de dados ao tentar concluir o pagamento.</p>";
        unset($_SESSION['erro_conexao_pag_ad']);
    }
    if (isset($_SESSION['cartao_vencido'])) {
        echo $aviso . "O cardão cadastrado aparenta estar vencido. Por favor, cadastre um cartão válido.</p>";
        unset($_SESSION['cartao_vencido']);
    }
    # Fim das flags de erro de promoção

    # Flags de sucesso
    if (isset($_SESSION["SucessoDel"])) {
        echo $aviso2 . "Sua conta foi deletada com sucesso.</p>";
        unset($_SESSION["SucessoDel"]);
    }
    if (isset($_SESSION['sucesso_adcionar_adm'])) {
        echo $aviso2 . "Um novo administrador foi cadastradado com sucesso.</p>";
        unset($_SESSION['sucesso_adcionar_adm']);
    }
    if (isset($_SESSION['sucesso_ad'])) {
        echo $aviso2 . "Seu restarante está sendo promovido.</p>";
        unset($_SESSION['sucesso_ad']);
    }
    if (isset($_SESSION['sucesso_pag_ad'])) {
        echo $aviso2 . "Pagamento efetuado com sucesso.</p>";
        unset($_SESSION['sucesso_pag_ad']);
    }
    # Fim das flags de erro alteração de dados pessoais do cliente
?>