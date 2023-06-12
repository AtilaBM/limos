<?php
    session_start();
    unset($_SESSION['banco-upado']);

    define('Host', 'localhost'); # Nome do servidor
    define('USUARIO', 'root'); # Nome do Usuário
    define('SENHA', ''); # Senha de acesso
    $conexao = mysqli_connect(Host, USUARIO, SENHA);
    
    $sql = "DROP DATABASE IF EXISTS `sbr`;";
    if($conexao->query($sql) === TRUE){
        echo "<p>Database dropada com sucesso</p>";
        echo "<br>";
        echo '<a href="automatic-database-uploader.php">Upar nova database</a>';
    }else{
        echo "<p>Algo deu errado ao dropar a database</p>";
    }
?>