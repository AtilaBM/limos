<?php
    #Este arquivo contem todas as classes referentes ao cliente no sistema
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