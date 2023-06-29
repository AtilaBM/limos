<?php
    #Este arquivo contem todas as classes referentes ao restaurante no sistema

    # Classe referente aos atributos do restaurante
    class restaurante{
        # Declação das variáveis
        public $id;
        public $nome;
        public $tipo;
        public $diahorafunc;
        public $encomenda;
        public $entrega;
        public $telefones;
        public $descricao;
        public $cardapio;
        public $cnpj;
        public $fotos;
        public $nota;
        public $statusContaRes;
        public $whatsapp;
        public $instagram;
        # Fim da declaração das variáveis

        # Função resposável por atribuir valores para o endereço do restaurante
        public function __construct($id, $nome, $tipo, $diahorafunc, $encomenda, $entrega, $telefones, $descricao, $cardapio, $cnpj, $fotos, $nota, $statusConta, $whatsapp, $instagram){
            $this->id = $id;
            $this->nome = $nome;
            $this->tipo = $tipo;
            $this->diahorafunc = $diahorafunc;
            $this->encomenda = $encomenda;
            $this->entrega = $entrega;
            $this->telefones = $telefones;
            $this->descricao = $descricao;
            $this->cardapio = $cardapio;
            $this->cnpj = $cnpj;
            $this->fotos = $fotos;
            $this->nota = $nota;
            $this->statusContaRes = $statusConta;
            $this->whatsapp = $whatsapp;
            $this->instagram = $this->formataInstagram($instagram);
        }
        # Fim da função

        public function cadastrar(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = $pdo->prepare("INSERT INTO `res`(`status_conta_res`, `nome_res`, `tipo_res`, `dia_hora_func_res`, `encomenda_res`, `entrega_res`, `telefone_res`, `desc_res`, `cardapio_res`, `cnpj_res`, `fotos_res`, `nota_res`, `whatsapp_res`, `instagram_res`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $sql->execute(array($this->statusContaRes, $this->nome, $this->tipo, $this->diahorafunc, $this->encomenda, $this->entrega, $this->telefones, $this->descricao, $this->cardapio, $this->cnpj, $this->fotos, $this->nota, $this->whatsapp, $this->instagram));
            echo "<p>Cadastro feito com sucesso</p>";
            return true;
        }

        public function update(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("UPDATE `res` SET `status_conta_res`= ?,`nome_res`= ?,`tipo_res`= ?,`dia_hora_func_res`= ?,`encomenda_res`= ?,`entrega_res`= ?,`telefone_res`= ?,`desc_res`= ?,`cardapio_res`= ?,`cnpj_res`= ?,`fotos_res`= ?,`nota_res`= ?,`whatsapp_res`= ?,`instagram_res`= ? WHERE `id_res` = ?");
            $sql->execute(array($this->statusContaRes, $this->nome, $this->tipo, $this->diahorafunc, $this->encomenda, $this->entrega, $this->telefones, $this->descricao, $this->cardapio, $this->cnpj, $this->fotos, $this->nota, $this->whatsapp, $this->instagram, $this->id));
            echo "<p>Updade feito com sucesso</p>";
            return true;
        }

        public function delete(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare("DELETE FROM `res` WHERE `id_res` = ?");
            $sql->execute(array($this->id));
            echo "<p>Deletado com sucesso</p>";
            return true;
        }

        public function login(){
            $pdo = new PDO('mysql:host=localhost;dbname=sbr', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $pdo->prepare("SELECT * FROM `res` WHERE id_res = ?");
            $sql->execute(array($this->id));
            $rowsCount = $sql->rowCount();
            $fetchAll = $sql->fetchAll();

            if($rowsCount > 0){
                echo "<p>Achei um login correspondente</p>";
                $this->__construct($fetchAll[0]["id_res"], $fetchAll[0]["nome_res"], $fetchAll[0]["tipo_res"], $fetchAll[0]["dia_hora_func_res"], $fetchAll[0]["encomenda_res"], $fetchAll[0]["entrega_res"], $fetchAll[0]["telefone_res"], $fetchAll[0]["desc_res"], $fetchAll[0]["cardapio_res"], $fetchAll[0]["cnpj_res"], $fetchAll[0]["fotos_res"], $fetchAll[0]["nota_res"], $fetchAll[0]["status_conta_res"], $fetchAll[0]["whatsapp_res"], $fetchAll[0]["instagram_res"]);
                return true;
            }else{
                echo "<p>Erro ao pegar dados no banco na função login</p>";
                return false;
            }
        }

        # Função responsável por preencher os select do tipo de restaurante
        function select($a){
            if($this->statusContaRes == 1){
                $b = $this->tipo;
                if($a == $b){
                    echo "selected";
                }
            }
            
        }
        # Fim da função

        # Função responsável por preencher os input radios como checked 
        function macadora($a, $b=0){
            if($this->statusContaRes == 1){
                $a = $this->tipo[$a];
                if($a == "1" and $b == 0){
                    echo "checked";
                }elseif($a == "2" and $b != 0){
                    echo "checked";
                }
            }
            
        }
        # Fim da função

        # Função responsável por preencher os input radios da entrega como checked
        function entrega($b=0, $c=1){
            if($c != 1){
                $a = $this->entrega;
                if($a == 1){
                    echo "Sim.";
                }elseif($a == 2){
                    echo "Não.";
                }
            }
            elseif($this->statusContaRes == 1){
                $a = $this->entrega;
                if($a == 1 and $b == 0){
                    echo "checked";
                }elseif($a == 2 and $b != 0){
                    echo "checked";
                }
            }
        }
        # Fim da função

        # Função responsável por preencher os input radios da encomenda como checked
        public function encomenda($b=0, $c=1){
            if($c != 1){
                $a = $this->encomenda;
                if($a == 1){
                    echo "Sim.";
                }elseif($a == 2){
                    echo "Não.";
                }
            }
            elseif($this->statusContaRes == 1){
                $a = $this->encomenda;
                if($a == 1 and $b == 0){
                    echo "checked";
                }elseif($a == 2 and $b != 0){
                    echo "checked";
                }
            }
        }
        # Fim da função

        # Função responsável por preencher o nome
        public function nome(){
            if($this->statusContaRes == 1){
                echo 'value="'.$this->nome.'"';
            }
        }
        # Fim da função

        # Função responsável por preencher o cnpj
        public function cnpj(){
            if($this->statusContaRes == 1){
                echo 'value="'.$this->cnpj.'"';
            }
        }
        # Fim da função

        # Função responsável por preencher o telefone
        public function telefone(){
            if($this->statusContaRes == 1){
                echo 'value="'.$this->telefones.'"';
            }
        }
        # Fim da função

        # Função responsável por preencher celular
        public function celular($a=1){
            if($a != 1){
                $string = explode("#", $this->telefones);
                echo $string[1];
            }
            elseif($this->statusContaRes == 1){
                $string = explode("#", $this->telefones);
                echo 'value="'.$string[1].'"';
            }
        }
        # Fim da função

        # Função responsável por preencher o whatsapp
        public function whatsapp(){
            if($this->statusContaRes == 1){
                echo 'value="'. $this->whatsapp .'"';
            }
        }
        # Fim da função

        # Função responsável por preencher o instagram
        public function instagram(){
            if($this->statusContaRes == 1){
                echo 'value="'. $this->instagram .'"';
            }
        }
        # Fim da função

        # Função responsável por dizer o tipo de restaurante
        public function tipo(){
            $a = $this->tipo;
            switch($a){
                case 1:
                    echo "Doceria";
                    break;
                case 2:
                    echo "Loja de Salgados";
                    break;
                case 3:
                    echo "Churrascaria";
                    break;
                case 4:
                    echo "Fast Food";
                    break;
                case 5:
                    echo "Pizzaria";
                    break;
                case 6:
                    echo "Loja de Sushi";
                    break;
                case 7:
                    echo "Restaurante de Comida Brasileira";
                    break;
                case 8:
                    echo "Restaurante de Comida Francesa";
                    break;
                case 9:
                    echo "Restaurante de Comida Italiana";
                    break;
                case 10:
                    echo "Restaurante de Comida Asiática";
                    break;
                case 11:
                    echo "Restaurante de Comida Árabe";
                    break;
                default:
                    echo "Restaurante";
                    break;
            }
        }
        # Fim da função

        public function formataInstagram($instagram,$opt=false){
            if($opt == false){
                return str_replace("@", "", $instagram);
            }else{
                if($instagram[0] != "@"){
                    $string = "@".$instagram;
                    return $string;
                }else{
                    return $instagram;
                }
            }
        }

        public function nota(){
            if($this->nota != 0){
                echo $this->nota." Estrelas";
            }
        }

    }
    # Fim da Classe
?>