<?php

    class LocacaoVeiculo {
        
        public $id;
        public $modelo;
        public $marca;
        public $placa;
        public $cliente;
        public $dataatualretirada;
        public $dataprevistaentrega;
        public $valor;
        public $formapagamento;

        function __construct($id, $modelo, $marca,$placa,$cliente,$dataatualretirada,$dataprevistaentrega,$valor,$formapagamento){
            $this->id = $id;
            $this->modelo = $modelo;
            $this->marca = $marca;
            $this->placa = $placa;
            $this->cliente = $cliente;
            $this->dataatualretirada = $dataatualretirada;
            $this->dataprevistaentrega = $dataprevistaentrega;
            $this->valor = $valor;
            $this->formapagamento = $formapagamento;
        
        }

    }

?>