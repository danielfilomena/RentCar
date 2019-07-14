<?php

    class LocacaoVeiculo {
        
        public $id;
        public $veiculoId;
        public $veiculoModelo;
        public $clienteId;
        public $clienteNome;
        public $dataRetirada;
        public $dataDevolucao;
        public $valor;
        public $formaPagamento;

        function __construct($id, $veiculoId, $veiculoModelo, $clienteId, $clienteNome, $dataRetirada, $dataDevolucao, $valor, $formaPagamento){
            
            $this->id = $id;
            $this->veiculoId = $veiculoId;
            $this->veiculoModelo = $veiculoModelo;
            $this->clienteId = $clienteId;
            $this->clienteNome = $clienteNome;
            $this->dataRetirada = $dataRetirada;
            $this->dataDevolucao = $dataDevolucao;
            $this->valor = $valor;
            $this->formaPagamento = $formaPagamento;
        
        }

    }

?>