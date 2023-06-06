<?php
    # Classe referente aos atributos do administrador de restaurante
    class admres{
        # Declação das variáveis
        public $id;
        public $nome;
        public $email;
        public $senha;
        # Fim da declaração das variáveis


        # Função resposável por atribuir valores para o administrador de restaurante
        public function __construct($id, $nome, $email, $senha){
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
        }
        # Fim da função

        public function login(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $pdo->prepare("SELECT * FROM `admres` WHERE email_admres = ? AND senha_admres = ?");
            $sql->execute(array($this->email, $this->senha));
            $rowsCount = $sql->rowCount();
            $fetchAll = $sql->fetchAll();

            if($rowsCount == 1){
                echo "<p>Achei um login correspondente</p>";
                $this->__construct($fetchAll[0]["id_admres"], $fetchAll[0]["nome_admres"], $fetchAll[0]["email_admres"], $fetchAll[0]["senha_admres"]);
                echo "<pre>";
                print_r($this);
                echo "</pre>";
                $_SESSION["admres"] = $this;
                return true;
            }else{
                echo "<p>Email ou senha errados na função login</p>";
                return false;
            }
        }

        public function verifica_email(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $pdo->prepare("SELECT * FROM `admres` WHERE email_admres = ?");
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

        public function cadastrar($id_res){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($this->verifica_email()){
                $sql = $pdo->prepare("INSERT INTO `admres`(`id_res`, `nome_admres`, `email_admres`, `senha_admres`) VALUES (?, ?, ?, ?)");
                $sql->execute(array($id_res, $this->nome, $this->email, $this->senha));
                echo "<p>Cadastrado com sucesso</p>";
                $_SESSION["admres"] = $this;
                return true;
            }else{
                echo "<p>O e-mail em questão já foi usado</p>";
                return false;
            }
        }

        public function update(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("UPDATE `admres` SET `nome_admres`= ?,`email_admres`= ?,`senha_admres` = ? WHERE `id_admres` = ?");
            $sql->execute(array($this->nome, $this->email, $this->senha, $this->id));
            echo "<p>Updade feito com sucesso</p>";
            $_SESSION["admres"] = $this;
            return true;
        }

        public function delete(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("DELETE FROM `admres` WHERE `id_admres` = ?");
            $sql->execute(array($this->id));
            echo "<p>Deletado com sucesso</p>";
            return true;
        }

        # Função responsável por preencher o nome do admres
        public function nomeAdmRes(){
            echo 'value="'.$this->nome.'"';
        }
        # Fim da função

        # Função responsável por preencher o email do admres
        public function emailAdmRes(){
            echo 'value="'.$this->email.'"';
        }
        # Fim da função

    }
# Fim da Classe
?>