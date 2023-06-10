<?php
    session_start();
    unset($_SESSION['banco-upado']);
    $conexao = mysqli_connect('localhost', 'root', '');
    $sql = "DROP DATABASE IF EXISTS `sbr`;";
    if($conexao->query($sql) === TRUE){
        echo "<p>Database dropada com sucesso</p>";
        echo "<br>";
        echo '<a href="automatic-database-uploader.php">Upar nova database</a>';
    }else{
        echo "<p>Algo deu errado ao dropar a database</p>";
    }
?>