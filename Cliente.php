<?php
    class Cliente {
        public $id;
        public $nome;
        public $cnh;
        public $endereco;
        

        function __construct($id, $nome, $cnh,$endereco){
            $this->id = $id;
            $this->nome = $nome;
            $this->cnh = $cnh;
            $this->endereco = $endereco;
           }
    }
?>