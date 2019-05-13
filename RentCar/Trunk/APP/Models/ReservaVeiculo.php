<?php

    class ReservaVeiculo {
        
        public $id;
        public $modelo;
        public $marca;
        public $cliente;
        public $dataretirada;
        public $dataprevistaentrega;
        public $valor;
        public $formapagamento;

        function __construct($id, $modelo, $marca,$cliente,$dataretirada,$dataprevistaentrega,$valor,$formapagamento){
            $this->id = $id;
            $this->modelo = $modelo;
            $this->marca = $marca;
            $this->cliente = $cliente;
            $this->dataretirada = $dataretirada;
            $this->dataprevistaentrega = $dataprevistaentrega;
            $this->valor = $valor;
            $this->formapagamento = $formapagamento;
        
        }

    }

?>