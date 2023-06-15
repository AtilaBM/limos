<?php
    session_start();

    define('Host', 'localhost'); # Nome do servidor
    define('USUARIO', 'root'); # Nome do Usuário
    define('SENHA', '1677'); # Senha de acesso
    define('DB', 'sbr'); # Nome do banco de dados
    $conexao = mysqli_connect('localhost', 'root', '1677'); # Dados da Conexão

    if(isset($_SESSION['banco-upado'])){
        echo "<p>O banco foi upado com sucesso<p>";
    }else{

        echo "<h1>Criando o Banco</h1>";

        # Cria o banco caso ele não exista
            $sql = "CREATE SCHEMA IF NOT EXISTS `sbr` DEFAULT CHARACTER SET utf8 ;";
            if($conexao->query($sql) === TRUE){
                echo "<p>Banco criado com sucesso</p>";
                $conexao = mysqli_connect(Host, USUARIO, SENHA, DB);
            }else{
                echo "<p>Algo deu errado ao criar o banco</p>";
            }
            

        # CRIAÇÃO DE TABELAS

            echo "<h2>Criando as tabelas</h2>";
        
            # Cria a tabela de restaurante caso ela não exista
            $sql = "CREATE TABLE IF NOT EXISTS `sbr`.`RES` (
                `id_res` INT NOT NULL AUTO_INCREMENT,
                `status_conta_res` INT NOT NULL DEFAULT 1 COMMENT '1=ativa\n2=excluída\n3=banida\n4=cadastro incompleto',
                `nome_res` VARCHAR(200) NOT NULL,
                `tipo_res` INT NOT NULL,
                `dia_hora_func_res` VARCHAR(200) NULL DEFAULT NULL COMMENT 'Breve descrição sobre os horários de funcionamento do restaurante',
                `encomenda_res` INT NOT NULL COMMENT 'O RESTAURANTE ACEITA PEDIDOS DE ENCOMENDA?\nSIM = 1\nNÃO = 2',
                `entrega_res` INT NULL DEFAULT NULL COMMENT 'O RESTAURENTE FAZ DELIVERY?\n1 = SIM\n2 = NÃO',
                `telefone_res` VARCHAR(20) NULL DEFAULT NULL,
                `desc_res` VARCHAR(2000) NULL DEFAULT NULL COMMENT 'DESCRIÇíO DO RESTAURANTE',
                `cardapio_res` VARCHAR(60) NULL DEFAULT NULL,
                `cnpj_res` CHAR(18) NULL DEFAULT NULL,
                `fotos_res` VARCHAR(1000) NOT NULL COMMENT 'FOTOS DO RESTAURANTE. OBDECEM AO PADRíO: \"FOTO1.EXTENÇíO##FOTO2.EXTENÇÃO##FOTO3.EXTENÇÃO\"',
                `nota_res` FLOAT NULL COMMENT 'NOTA DO RESTAURATE REFERENTE AOS COMENTÁRIOS DOS USUÁRIOS',
                `whatsapp_res` VARCHAR(20) NULL,
                `instagram_res` VARCHAR(45) NULL,
                PRIMARY KEY (`id_res`),
                UNIQUE INDEX `cnpj_res_UNIQUE` (`cnpj_res` ASC))
            ENGINE = InnoDB;";
            if($conexao->query($sql) === TRUE){
                echo "<p>Tabela do restaurante criada com sucesso</p>";
            }else{
                echo "<p>Algo deu errado ao criar a tabela do restaurante</p>";
            }

            # Cria a tabela de cliente caso ela não exista
            $sql = "CREATE TABLE IF NOT EXISTS `sbr`.`CLI` (
                `id_cli` INT NOT NULL AUTO_INCREMENT,
                `status_conta_cli` INT NOT NULL DEFAULT 1 COMMENT '1=ativa\n2=excluída\n3=banida\n4=cadastro incompleto',
                `telefone_cli` VARCHAR(45) NULL DEFAULT NULL,
                `email_cli` VARCHAR(200) NOT NULL,
                `senha_cli` VARCHAR(32) NOT NULL,
                `data_reg_cli` DATE NOT NULL,
                `gostos_cli` VARCHAR(200) NULL DEFAULT NULL,
                `nome_cli` VARCHAR(200) NOT NULL,
                PRIMARY KEY (`id_cli`),
                UNIQUE INDEX `id_cli_UNIQUE` (`id_cli` ASC),
                UNIQUE INDEX `email_cli_UNIQUE` (`email_cli` ASC))
            ENGINE = InnoDB;";
            if($conexao->query($sql) === TRUE){
                echo "<p>Tabela do cliente criada com sucesso</p>";
            }else{
                echo "<p>Algo deu errado ao criar a tabela do cliente</p>";
            }

            # Cria a tabela de comentário caso ela não exista
            $sql = "CREATE TABLE IF NOT EXISTS `sbr`.`COMENT` (
                `id_coment` INT NOT NULL AUTO_INCREMENT,
                `id_cli` INT NOT NULL,
                `id_res` INT NOT NULL,
                `nota_coment` INT NOT NULL,
                `data_coment` DATE NOT NULL,
                `coment_coment` VARCHAR(1000) NULL DEFAULT NULL,
                PRIMARY KEY (`id_coment`),
                INDEX `fk_COMENT_CLI_idx` (`id_cli` ASC),
                INDEX `fk_COMENT_RES1_idx` (`id_res` ASC),
                CONSTRAINT `fk_COMENT_CLI`
                FOREIGN KEY (`id_cli`)
                REFERENCES `sbr`.`CLI` (`id_cli`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
                CONSTRAINT `fk_COMENT_RES1`
                FOREIGN KEY (`id_res`)
                REFERENCES `sbr`.`RES` (`id_res`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;";
            if($conexao->query($sql) === TRUE){
                echo "<p>Tabela dos comentários criada com sucesso</p>";
            }else{
                echo "<p>Algo deu errado ao criar a tabela dos comentários</p>";
            }

            # Cria a tabela de admres caso ela não exista
            $sql = "CREATE TABLE IF NOT EXISTS `sbr`.`ADMRES` (
                `id_admres` INT NOT NULL AUTO_INCREMENT,
                `id_res` INT NOT NULL,
                `nome_admres` VARCHAR(200) NOT NULL,
                `email_admres` VARCHAR(100) NOT NULL,
                `senha_admres` CHAR(32) NOT NULL,
                PRIMARY KEY (`id_admres`),
                INDEX `fk_ADMRES_RES1_idx` (`id_res` ASC),
                UNIQUE INDEX `email_admres_UNIQUE` (`email_admres` ASC),
                CONSTRAINT `fk_ADMRES_RES1`
                FOREIGN KEY (`id_res`)
                REFERENCES `sbr`.`RES` (`id_res`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;";
            if($conexao->query($sql) === TRUE){
                echo "<p>Tabela dos administradores de restaurante criada com sucesso</p>";
            }else{
                echo "<p>Algo deu errado ao criar a tabela dos administradores de restaurante</p>";
            }

            # Cria a tabela de admsis caso ela não exista
            $sql = "CREATE TABLE IF NOT EXISTS `sbr`.`ADMSIS` (
                `id_admsis` INT NOT NULL AUTO_INCREMENT,
                `nome_admsis` VARCHAR(200) NOT NULL,
                `email_admsis` VARCHAR(200) NOT NULL,
                `senha_admsis` VARCHAR(32) NOT NULL,
                PRIMARY KEY (`id_admsis`),
                UNIQUE INDEX `email_admsis_UNIQUE` (`email_admsis` ASC))
            ENGINE = InnoDB;";
            if($conexao->query($sql) === TRUE){
                echo "<p>Tabela dos admnistradores de sistema criada com sucesso</p>";
            }else{
                echo "<p>Algo deu errado ao criar a tabela dos admnistradores de sistema</p>";
            }

            # Cria a tabela de endereço caso ela não exista
            $sql = "CREATE TABLE IF NOT EXISTS `sbr`.`END` (
                `id_end` INT NOT NULL AUTO_INCREMENT,
                `id_cli` INT NULL,
                `id_res` INT NULL,
                `cep_end` CHAR(9) NOT NULL,
                `num_end` VARCHAR(20) NULL,
                `logradouro_end` VARCHAR(45) NOT NULL,
                `bairro_end` VARCHAR(45) NOT NULL,
                `uf_end` VARCHAR(13) NOT NULL,
                `cidade_end` VARCHAR(58) NOT NULL,
                `pais_end` VARCHAR(45) NOT NULL DEFAULT 'Brazil',
                PRIMARY KEY (`id_end`),
                INDEX `fk_ENDERECO_CLI1_idx` (`id_cli` ASC),
                INDEX `fk_ENDERECO_RES1_idx` (`id_res` ASC),
                CONSTRAINT `fk_ENDERECO_CLI1`
                FOREIGN KEY (`id_cli`)
                REFERENCES `sbr`.`CLI` (`id_cli`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
                CONSTRAINT `fk_ENDERECO_RES1`
                FOREIGN KEY (`id_res`)
                REFERENCES `sbr`.`RES` (`id_res`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;";
            if($conexao->query($sql) === TRUE){
                echo "<p>Tabela de endereços criada com sucesso</p>";
            }else{
                echo "<p>Algo deu errado ao criar a tabela de endereços</p>";
            }

            # Cria a tabela de ad caso ela não exista
            $sql = "CREATE TABLE IF NOT EXISTS `sbr`.`AD` (
                `id_ad` INT NOT NULL AUTO_INCREMENT,
                `data_inicio_ad` DATE NOT NULL COMMENT 'DATA DE INÍCO DO ANÚNCIO',
                `data_fim_ad` DATE NOT NULL COMMENT 'DATA DE FINALIZAÇíO DO ANÚNCIO',
                `status_ad` INT NOT NULL DEFAULT '1' COMMENT '1 = ATIVO\n2 = NíO ATIVO ',
                `status_pag_ad` INT NOT NULL DEFAULT '2' COMMENT '1 = PAGO\n2 = PENDENTE',
                `id_res` INT NOT NULL,
                PRIMARY KEY (`id_ad`),
                INDEX `fk_AD_RES1_idx` (`id_res` ASC),
                CONSTRAINT `fk_AD_RES1`
                FOREIGN KEY (`id_res`)
                REFERENCES `sbr`.`RES` (`id_res`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;";
            if($conexao->query($sql) === TRUE){
                echo "<p>Tabela das promoções criada com sucesso</p>";
            }else{
                echo "<p>Algo deu errado ao criar a tabela das promoções</p>";
            }
        
        # INSERTS

            echo "<h2>Fazendo os inserts</h2>";

            # CLIENTES

            $sql = "INSERT INTO `cli` (`status_conta_cli`, `telefone_cli`, `email_cli`, `senha_cli`, `data_reg_cli`, `gostos_cli`, `nome_cli`) VALUES
            (1, '(54)65456-4784', '1@1', '25d55ad283aa400af464c76d713c07ad', '2023-05-11', '3-3-3-3-3-3-3-3-3-3-3', 'Joaquim das Neves'),
            (1, '(61)95986-4634', 'cliente@limos.com', '25d55ad283aa400af464c76d713c07ad', '2023-05-11', '3-3-3-3-3-3-3-3-3-3-3', 'Marie Antoinette Josèphe Jeanne de Habsbourg-Lorraine');";
            if($conexao->query($sql) === TRUE){
                echo "<p>Clientes inseridos com sucesso!<p>";
            }else{
                echo "<p>Algo deu ao fazer os inserts de clientes</p>";
            }

            # RESTAURANTES

            $sql = "INSERT INTO `res` (`status_conta_res`, `nome_res`, `tipo_res`, `dia_hora_func_res`, `encomenda_res`, `entrega_res`, `telefone_res`, `desc_res`, `cardapio_res`, `cnpj_res`, `fotos_res`, `nota_res`, `whatsapp_res`, `instagram_res`) VALUES
            (1, 'Patinho é melhor que picanha', 3, 'Abre às 11:30AM, fecha às 3AM.', 2, 1, '06133716161', 'Uma churrascaria gaúcha autêntica. Visite-nos e conheço todo o sabor que a carne pode ter.', 'cardapio-1-2023.05.11-13.39.10.jpg', NULL, '1-2023.05.11-13.39.10.jpg', 5, '+5506133716161', 'patinhoemelhorquepicanha'),
            (1, 'Maggic Real', 1, 'Das 10AM às 3PM', 1, 1, '061985026930', 'Um lugar mágico. Servimos os melhores doces já feitos na Ceilândia Norte.', 'cardapio-2-2023.05.11-13.45.53.jpg', NULL, '2-2023.05.11-13.45.53.jpg', 0, '+55061985026930', 'maggicreal'),
            (1, 'Ebelu do Paraguai', 4, 'Todos os dias, das 10AM às 10PM.', 2, 2, '06133585606', 'Uma cópia da rede de restaurante Ebelu que, com certeza, você conhece.', 'cardapio-3-2023.05.11-13.51.36.jpg', NULL, '3-2023.05.11-13.51.36.jpg', 0, '06133585606', 'ebeludoparaguai'),
            (1, 'Da Esquina', 2, 'Todos os dias, exceto domingos, das 7 da manhí às 6 da tarde.', 2, 2, '061981063000', 'Uma lanchonete familiar que vende salgados gostosos.', 'cardapio-4-2023.05.11-14.00.16.jpg', NULL, '4-2023.05.11-14.00.16.jpg', 0, '061981063000', 'daesquina'),
            (1, 'Sushiya', 6, '24/7', 2, 1, '061992897920', 'Uma loja de sushi japonês, com atendentes chinêses e com o dono um coreano.', 'cardapio-5-2023.05.11-14.08.45.jpg', NULL, '5-2023.05.11-14.08.45.jpg', 0, '061992897920', 'sushiya'),
            (1, 'Seu Logo', 5, 'Todos os dias, das 7PM às 4AM.', 1, 1, '06139637678', 'Uma pizzaria top. Temos a maior pizza do Centro-Oeste.', 'cardapio-6-2023.05.11-14.14.16.jpg', NULL, '6-2023.05.11-14.14.16.jpg', 0, '06139637678', 'seulogopizzaria'),
            (1, 'Ali\'s Tapas', 11, 'Todos os dias, das 11 ás 15.', 1, 2, '06134514750', 'Conheça o quebab otomano.', 'cardapio-7-2023.05.11-14.21.08.jpg', NULL, '7-2023.05.11-14.21.08.jpg', 0, '+5506134514750', 'alistapas'),
            (1, 'Kim Will Sung', 10, 'De segunda a quinta, das 12 às 15.', 2, 2, '06138790900', 'Um restaurante norte coreano gerenciado por refugiados da ditadura.', 'cardapio-8-2023.05.11-14.28.32.jpg', NULL, '8-2023.05.11-14.28.32.jpg', 0, '06138790900', 'koreadonorte'),
            (1, 'Bom de Boca', 7, 'Todos os dias em horário comercial.', 2, 1, '06134598153', 'Um restaure normal.', 'cardapio-9-2023.05.11-14.32.31.jpg', NULL, '9-2023.05.11-14.32.31.jpg', 0, '06134598153', 'bomdeboca'),
            (1, 'Le Amoux', 8, 'Somente funciona com reservas feitas através do nosso telefone.', 2, 2, '061998380012', 'Um restaurante dedicado à elite do funcionalismo público.', 'cardapio-10-2023.05.11-14.36.49.jpg', NULL, '10-2023.05.11-14.36.49.jpg', 0, '061998380012', 'leamoux'),
            (1, 'Italianos', 9, '24/7', 1, 1, '06134435050', 'Só aceitamos dinheiro vivo. Totalmente não funciona como esquema de lavagem de dinheiro.', 'cardapio-11-2023.05.11-14.41.15.jpg', NULL, '11-2023.05.11-14.41.15.jpg', 5, '06134435050', 'italianos');";
            if($conexao->query($sql) === TRUE){
                echo "<p>Restaurantes inseridos com sucesso!<p>";
            }else{
                echo "<p>Algo deu ao fazer os inserts de Restaurante</p>";
            }

            # ENDEREÇOS

            $sql = "INSERT INTO `end` (`id_cli`, `id_res`, `cep_end`, `num_end`, `logradouro_end`, `bairro_end`, `uf_end`, `cidade_end`, `pais_end`) VALUES
            (NULL, 1, '72220521', '14', 'EQNN 4/6 Bloco A', 'Ceilândia Sul (Ceilândia)', 'DF', 'Brasília', 'Brazil'),
            (NULL, 2, '72225172', '8', 'QNN 17 Conjunto B', 'Ceilândia Norte (Ceilândia)', 'DF', 'Brasília', 'Brazil'),
            (NULL, 3, '72145450', '18', 'QNM 34 Área Especial 1', 'Taguatinga Norte (Taguatinga)', 'DF', 'Brasília', 'Brazil'),
            (NULL, 4, '72115105', '50', 'CNB 10', 'Taguatinga Norte (Taguatinga)', 'DF', 'Brasília', 'Brazil'),
            (NULL, 5, '72145450', '12', 'QNM 34 Área Especial 1', 'Taguatinga Norte (Taguatinga)', 'DF', 'Brasília', 'Brazil'),
            (NULL, 6, '72007675', '31', 'Rua 12 Chácara 154/3', 'Setor Habitacional Vicente Pires', 'DF', 'Brasília', 'Brazil'),
            (NULL, 7, '71900100', '12', 'Avenida das Castanheiras', 'Norte (Águas Claras)', 'DF', 'Brasília', 'Brazil'),
            (NULL, 8, '70374510', '666', 'CLS 111 Bloco A', 'Asa Sul', 'DF', 'Brasília', 'Brazil'),
            (NULL, 9, '72220571', '21', 'EQNN 22/24 Bloco A', 'Ceilândia Sul (Ceilândia)', 'DF', 'Brasília', 'Brazil'),
            (NULL, 10, '70390079', '23', 'SEPS 708/907', 'Asa Sul', 'DF', 'Brasília', 'Brazil'),
            (NULL, 11, '70272510', '8', 'CLS 209 Bloco A', 'Asa Sul', 'DF', 'Brasília', 'Brazil'),
            (1, NULL, '72220225', NULL, 'QNN 22 Conjunto E', 'Ceilândia Sul (Ceilândia)', 'DF', 'Brasília', 'Brazil'),
            (2, NULL, '72220225', NULL, 'QNN 22 Conjunto E', 'Ceilândia Sul (Ceilândia)', 'DF', 'Brasília', 'Brazil');";
            if($conexao->query($sql) === TRUE){
                echo "<p>Endereços inseridos com sucesso!<p>";
            }else{
                echo "<p>Algo deu ao fazer os inserts de Endereços</p>";
            }

            # ADMRES

            $sql = "INSERT INTO `admres` (`id_res`, `nome_admres`, `email_admres`, `senha_admres`) VALUES
            (1, 'Jolío', '1@1', '25d55ad283aa400af464c76d713c07ad'),
            (2, 'José', '1@2', '25d55ad283aa400af464c76d713c07ad'),
            (3, 'Bertulucci', '1@3', '25d55ad283aa400af464c76d713c07ad'),
            (4, 'Édison', '1@4', '25d55ad283aa400af464c76d713c07ad'),
            (5, 'Júlio Ferreira', '1@5', '25d55ad283aa400af464c76d713c07ad'),
            (6, 'João Kleber', '1@6', '25d55ad283aa400af464c76d713c07ad'),
            (7, 'Cleiton', '1@7', '25d55ad283aa400af464c76d713c07ad'),
            (8, 'Lorraine', '1@8', '25d55ad283aa400af464c76d713c07ad'),
            (9, 'Vanila', '1@9', '25d55ad283aa400af464c76d713c07ad'),
            (10, 'Françoar', '1@10', '25d55ad283aa400af464c76d713c07ad'),
            (11, 'Franccesco', '1@11', '25d55ad283aa400af464c76d713c07ad');";
            if($conexao->query($sql) === TRUE){
                echo "<p>Admnistradores de restaurantes inseridos com sucesso!<p>";
            }else{
                echo "<p>Algo deu ao fazer os inserts de admnistradores de restaurantes</p>";
            }

            # COMENTÁRIO

            $sql = "INSERT INTO `coment` (`id_cli`, `id_res`, `nota_coment`, `data_coment`, `coment_coment`) VALUES
            (1, 1, 5, '2023-05-11', 'Bacana. Super recomendo para quem está quebrado no fim do mês.'),
            (1, 11, 5, '2023-05-11', 'Consegui ganhar uma licitação almoçando aqui. Super recomendo por atrair a sorte.');";
            if($conexao->query($sql) === TRUE){
                echo "<p>Comentários inseridos com sucesso!<p>";
            }else{
                echo "<p>Algo deu ao fazer os inserts de comentários</p>";
            }

            # ADMSIS

            $sql = "INSERT INTO `admsis` (`nome_admsis`, `email_admsis`, `senha_admsis`) VALUES
            ('Louise Françoise le Blanc de la Vallière', '1@1', '25d55ad283aa400af464c76d713c07ad'),
            ('Louis-Auguste de France', 'adm@limos.com', '25d55ad283aa400af464c76d713c07ad');";
            if($conexao->query($sql) === TRUE){
                echo "<p>Admnistradores de sistema inseridos com sucesso!<p>";
            }else{
                echo "<p>Algo deu ao fazer os inserts de admnistradores de sistema</p>";
            }
        
            # AD

            $sql = "INSERT INTO `ad`(`data_inicio_ad`, `data_fim_ad`, `status_ad`, `status_pag_ad`, `id_res`) VALUES 
            ('2023-06-06','2025-06-06','1','1','1'),
            ('2023-06-06','2025-06-06','1','1','2'),
            ('2023-06-06','2025-06-06','1','1','3'),
            ('2023-06-06','2025-06-06','1','1','4'),
            ('2023-06-06','2025-06-06','1','1','5'),
            ('2023-06-06','2025-06-06','1','1','6'),
            ('2023-06-06','2025-06-06','1','1','7'),
            ('2023-06-06','2025-06-06','1','1','8'),
            ('2023-06-06','2025-06-06','1','1','9'),
            ('2023-06-06','2025-06-06','1','1','10'),
            ('2023-06-06','2025-06-06','1','1','11');";
            if($conexao->query($sql) === TRUE){
                echo "<p>Promoções inseridos com sucesso!<p>";
            }else{
                echo "<p>Algo deu ao fazer os inserts de Promoções</p>";
            }
        

        # FINALIZA
        $_SESSION['banco-upado'] = true;
        echo "<p>Tudo Finalizado!<p>";
    }
    echo "<h1>Dropar Database</h1>";
    echo '<a href="automatic-database-dropper.php">Dropar database</a>';
?>
