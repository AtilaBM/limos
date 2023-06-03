<?php
    # Classe referente aos atributos do cliente
    class cliente{
        # Declação das variáveis
        public $id;
        public $statusConta;
        public $nome;
        public $telefone;
        public $email;
        public $senha;
        public $dataRes;
        public $gostos;
        # Fim da declaração das variáveis

        public function __construct($id, $statusConta, $nome, $telefone, $email, $senha, $dataRes, $gostos){
            $this->id=$id;
            $this->statusConta=$statusConta;
            $this->nome=$nome;
            $this->telefone=$telefone;
            $this->email=$email;
            $this->senha=$senha;
            $this->dataRes=$dataRes;
            $this->gostos=$gostos;
        }


        public function login(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $pdo->prepare("SELECT * FROM `CLI` WHERE email_cli = ? AND senha_cli = ?");
            $sql->execute(array($this->email, $this->senha));
            $rowsCount = $sql->rowCount();
            $fetchAll = $sql->fetchAll();

            if($rowsCount == 1){
                echo "<p>Achei um login correspondente</p>";
                $this->__construct($fetchAll[0]["id_cli"], $fetchAll[0]["status_conta_cli"], $fetchAll[0]["nome_cli"], $fetchAll[0]["telefone_cli"], $fetchAll[0]["email_cli"], $fetchAll[0]["senha_cli"], $fetchAll[0]["data_reg_cli"], $fetchAll[0]["gostos_cli"]);
                echo "<pre>";
                print_r($this);
                echo "</pre>";
                $_SESSION["cliente"] = $this;
                return true;
            }else{
                echo "<p>Email ou senha errados na função login</p>";
                return false;
            }
        }

        public function verifica_email(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $pdo->prepare("SELECT * FROM `CLI` WHERE email_cli = ?");
            $sql->execute(array($this->email));
            $rowsCount = $sql->rowCount();

            if($rowsCount > 0){
                echo "<p>Achei $rowsCount login correspondente(s)</p>";
                return false;
            }else{
                echo "<p>O e-mail em questão está livre</p>";
                return true;
            }
        }

        public function cadastrar(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($this->verifica_email()){
                $sql = $pdo->prepare("INSERT INTO `cli`(`telefone_cli`, `status_conta_cli`, `email_cli`, `senha_cli`, `data_reg_cli`, `nome_cli`) VALUES (?, ?, ?, ?, ?, ?)");
                $sql->execute(array($this->telefone, $this->statusConta, $this->email, $this->senha, $this->dataRes, $this->nome));
                echo "<p>Cadastrado com sucesso</p>";
                $_SESSION["cliente"] = $this;
                return true;
            }else{
                echo "<p>O e-mail em questão já foi usado</p>";
                return false;
            }
        }

        public function update(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("UPDATE `cli` SET `status_conta_cli`= ?,`telefone_cli`= ?,`email_cli`= ?,`senha_cli`= ?,`data_reg_cli`= ?,`gostos_cli`=  ?,`nome_cli`= ? WHERE `id_cli` = ?");
            $sql->execute(array($this->statusConta, $this->telefone, $this->email, $this->senha, $this->dataRes, $this->gostos, $this->nome, $this->id));
            echo "<p>Updade feito com sucesso</p>";
            $_SESSION["cliente"] = $this;
            return true;
        }

        public function delete(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("DELETE FROM `cli` WHERE `id_cli` = ?");
            $sql->execute(array($this->id));
            echo "<p>Deletado com sucesso</p>";
            $_SESSION["cliente"] = $this;
            return true;
        }
        


        # Função resposável por atribuir valores para o e-mail do cliente
        public function emailSetter($a){
            $this->email = $a;
        }
        # Fim da função

        # Função resposável por atribuir valores para a senha do cliente
        public function passwordSetter($a){
            $this->senha = $a;
        }
        # Fim da função

        # Função responsável por preencher os gostos do cliente
        public function gostosChecker($gosto, $codgosto){
            if($this->statusConta == 1){
                $b = explode('-', $this->gostos);
                if($gosto == $b[$codgosto]){
                    echo "checked";
                }
            }
            
        }
        # Fim da função

        public function preencheSubmit(){
            if($this->statusConta == 1){
                echo "Alterar Gostos";
            }else{
                echo "Cadastrar-se";
            }
        }

        # Função responsável por preencher o nome do cliente
        public function nomeCli(){
            if($this->statusConta == 1){
                echo 'value="'.$this->nome.'"';
            }
        }
        # Fim da função

        # Função responsável por preencher o telefone do cliente
        public function telefoneCli(){
            if($this->statusConta == 1){
                echo 'value="'.$this->telefone.'"';
            }
        }
        # Fim da função

        # Função responsável por preencher o email do cliente
        public function emailCli(){
            if($this->statusConta == 1){
                echo 'value="'.$this->email.'"';
            }
        }
        # Fim da função

    }
    # Fim da Classe

?>