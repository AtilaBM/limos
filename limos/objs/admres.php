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