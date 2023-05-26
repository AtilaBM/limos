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
    }
?>