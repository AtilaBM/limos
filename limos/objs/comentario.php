<?php
    # Classe que conterá o objeto referente aos comentários no sistema
    class coment{
        # Atributos
        public $id_coment;
        public $id_cli;
        public $id_res;
        public $data_coment;
        public $nota_coment;
        public $coment;
        # Fim dos atributos

        # Função resposável por atribuir valores para o comentario
        public function __construct($id, $cli, $res, $coment, $data, $nota){
            $this->id_coment = $id;
            $this->id_cli = $cli;
            $this->id_res = $res;
            $this->data_coment = $data;
            $this->coment = $coment;
            $this->nota_coment = $nota;
        }
        # Fim da função

        public function cadastrar(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = $pdo->prepare("INSERT INTO `coment`(`id_cli`, `id_res`, `nota_coment`, `data_coment`, `coment_coment`) VALUES (?, ?, ?, ?, ?)");
            $sql->execute(array($this->id_cli, $this->id_res, $this->nota_coment, $this->data_coment, $this->coment));
            echo "<p>Comentário cadastrado com sucesso</p>";
            return true;
        }

        public function update(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("UPDATE `coment` SET `id_cli`= ?,`id_res`= ?,`nota_coment`= ?,`data_coment`= ?,`coment_coment`= ? WHERE `id_coment` = ?");
            $sql->execute(array($this->id_cli, $this->id_res, $this->nota_coment, $this->data_coment, $this->coment, $this->id_coment));
            echo "<p>Updade feito com sucesso</p>";
            return true;
        }

        public function delete(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("DELETE FROM `coment` WHERE `id_coment` = ?");
            $sql->execute(array($this->id_coment));
            echo "<p>Deletado com sucesso</p>";
            return true;
        }
    }
?>