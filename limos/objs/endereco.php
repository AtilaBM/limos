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