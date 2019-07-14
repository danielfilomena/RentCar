<?php

    class DevolucaoVeiculo {
        
        public $id;
        public $veiculoId;
        public $veiculoModelo;
        public $clienteId;
        public $clienteNome;
        public $dataDevolucao;
        public $tanque;
        public $avaria;
        public $valortotal;        

        function __construct($id, $veiculoId, $veiculoModelo, $clienteId, $clienteNome, $dataDevolucao, $tanque, $avaria, $valortotal){

            $this->id = $id;
            $this->veiculoId = $veiculoId;
            $this->veiculoModelo = $veiculoModelo;
            $this->clienteId = $clienteId;
            $this->clienteNome = $clienteNome;
            $this->dataDevolucao = $dataDevolucao;
            $this->tanque = $tanque;
            $this->avaria = $avaria;
            $this->valortotal = $valortotal;
                    
        }

    }

?>