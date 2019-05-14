<?php

    class LocacaoVeiculo {
        
        public $id;
        public $idVeiculo;
        public $idCliente;
        public $dataretirada;
        public $datadevolucao;
        public $valor;
        public $formapagamento;

        function __construct($id, $idVeiculo, $idCliente, $dataretirada, $datadevolucao, $valor, $formapagamento){
            $this->id = $id;
            $this->idVeiculo = $idVeiculo;
            $this->idCliente = $idCliente;
            $this->dataretirada = $dataretirada;
            $this->datadevolucao = $datadevolucao;
            $this->valor = $valor;
            $this->formapagamento = $formapagamento;
        
        }

    }

?>