<?php

    class DevolucaoVeiculo {
        
        public $id;
        public $modelo;
        public $marca;
        public $placa;
        public $cliente;
        public $tanque;
        public $avaria;
        public $valortotallocacao;
        

        function __construct($id, $modelo, $marca,$placa,$cliente,$tanque,$avaria,$valortotallocacao){
            $this->id = $id;
            $this->modelo = $modelo;
            $this->marca = $marca;
            $this->placa = $placa;
            $this->cliente = $cliente;
            $this->tanque = $tanque;
            $this->avaria = $avaria;
            $this->valortotallocacao = $valortotallocacao;
                    
        }

    }

?>