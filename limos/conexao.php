<?php
    # Arquivo responsável pelo estabelecimento da conexão com o servidor
    define('Host', 'localhost'); # Nome do servidor
    define('USUARIO', 'root'); # Nome do Usuário
    define('SENHA', '1677'); # Senha de acesso
    define('DB', 'sbr'); # Nome do banco de dados
    $conexao = mysqli_connect(Host, USUARIO, SENHA, DB) or die ('Não foi possível conectar'); # Conexão
?>