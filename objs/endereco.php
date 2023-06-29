<?php
    # Classe referente ao endereço do cliente
    class endereco{
        # Declação das variáveis
        public $id;
        public $logradouro;
        public $cep;
        public $cidade;
        public $bairro;
        public $uf;
        public $pais;
        public $numero;
        # Fim da declaração das variáveis

        # Função resposável por atribuir valores para o endereço do restaurante
        public function __construct($cep, $num, $logradouro, $bairro, $uf, $pais, $cidade, $id){
            $this->logradouro = $logradouro;
            $this->bairro = $bairro;
            $this->uf = $uf;
            $this->cep = $cep;
            $this->pais = $pais;
            $this->numero = $num;
            $this->cidade = $cidade;
            $this->id = $id;
        }
        # Fim da função

        public function cadastrar($id_cli, $id_res){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = $pdo->prepare("INSERT INTO `end`(`id_cli`, `id_res`, `cep_end`, `num_end`, `logradouro_end`, `bairro_end`, `uf_end`, `cidade_end`, `pais_end`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $sql->execute(array($id_cli, $id_res, $this->cep, $this->numero, $this->logradouro, $this->bairro, $this->uf, $this->cidade, $this->pais));
            echo "<p>Cadastro feito com sucesso</p>";
            return true;
        }

        public function update(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("UPDATE `end` SET `cep_end`= ?,`num_end`=' ?,`logradouro_end`= ?,`bairro_end`= ?,`uf_end`= ?,`cidade_end`= ?',`pais_end`= ? WHERE `id_end` = ?");
            $sql->execute(array($this->cep, $this->numero, $this->logradouro, $this->bairro, $this->uf, $this->cidade, $this->pais, $this->id));
            echo "<p>Updade feito com sucesso</p>";
            return true;
        }

        public function login($id_cli, $id_res){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $pdo->prepare("SELECT * FROM `end` WHERE id_res = ? AND id_cli ?");
            $sql->execute(array($id_res, $id_cli));
            $rowsCount = $sql->rowCount();
            $fetchAll = $sql->fetchAll();

            if($rowsCount > 0){
                echo "<p>Achei um login correspondente</p>";
                $this->__construct($fetchAll[0]["cep_end"], $fetchAll[0]["num_end"], $fetchAll[0]["logradouro_end"], $fetchAll[0]["bairro_end"], $fetchAll[0]["uf_end"], $fetchAll[0]["pais_end"], $fetchAll[0]["cidade_end"],$fetchAll[0]["id_end"]);
                return true;
            }else{
                echo "<p>Erro ao pegar dados no banco na função login</p>";
                return false;
            }
        }

        public function delete(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("DELETE FROM `end` WHERE `id_end` = ?");
            $sql->execute(array($this->id));
            echo "<p>Deletado com sucesso</p>";
            return true;
        }

        
        # Função responsável por preencher o logradouro do cliente
        public function logradouroCli(){
            if($_SESSION["cliente"]->statusConta == 1){
                echo 'value="'.trim($this->logradouro).'"';
            }
        }
        # Fim da função

         # Função responsável por preencher a cidade do cliente
         public function cidadeCli(){
            if($_SESSION["cliente"]->statusConta == 1){
                echo 'value="'.trim($this->cidade).'"';
            }
        }
        # Fim da função

        # Função responsável por preencher o bairro do cliente
        public function bairroCli(){
            if($_SESSION["cliente"]->statusConta == 1){
                echo 'value="'.trim($this->bairro).'"';
            }
        }
        # Fim da função
        
        # Função responsável por preencher a uf do cliente
        public function ufCli(){
            if($_SESSION["cliente"]->statusConta == 1){
                echo 'value="'.trim($this->uf).'"';
            }
        }
        # Fim da função
        
        # Função responsável por preencher o cep do cliente
        public function cepCli(){
            if($_SESSION["cliente"]->statusConta == 1){
                echo 'value="'.trim($this->cep).'"';
            }
        }
        # Fim da função
        
        # Função responsável por preencher o logradouro do restautante
        public function logradouroRes(){
            if($_SESSION["restaurante"]->statusContaRes == 1){
                echo 'value="'.trim($_SESSION["enderecoRes"]->logradouro).'"';
            }
        }
        # Fim da função

         # Função responsável por preencher a cidade do restautante
         public function cidadeRes(){
            if($_SESSION["restaurante"]->statusContaRes == 1){
                echo 'value="'.trim($_SESSION["enderecoRes"]->cidade).'"';
            }
        }
        # Fim da função

        # Função responsável por preencher o bairro do restautante
        public function bairroRes(){
            if($_SESSION["restaurante"]->statusContaRes == 1){
                echo 'value="'.trim($_SESSION["enderecoRes"]->bairro).'"';
            }
        }
        # Fim da função
        
        # Função responsável por preencher a uf do restautante
        public function ufRes(){
            if($_SESSION["restaurante"]->statusContaRes == 1){
                echo 'value="'.trim($_SESSION["enderecoRes"]->uf).'"';
            }
        }
        # Fim da função
        
        # Função responsável por preencher o cep do restautante
        public function cepRes(){
            if($_SESSION["restaurante"]->statusContaRes == 1){
                echo 'value="'.trim($_SESSION["enderecoRes"]->cep).'"';
            }
        }
        # Fim da função
        
        # Função responsável por preencher o número do restautante
        public function numeroRes(){
            if($_SESSION["restaurante"]->statusContaRes == 1){
                echo 'value="'.trim($_SESSION["enderecoRes"]->numero).'"';
            }
        }
        # Fim da função
    }
    # Fim da Classe
?>