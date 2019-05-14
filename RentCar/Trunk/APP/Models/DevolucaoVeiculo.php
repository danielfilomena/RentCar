<?php

    class DevolucaoVeiculo {
        
        public $id;
        public $idVeiculo;        
        public $idCliente;
        public $dataDevolucao;
        public $tanque;
        public $avaria;
        public $valortotal;        

        function __construct($id, $idVeiculo, $idCliente, $dataDevolucao, $tanque, $avaria, $valortotal){

            $this->id = $id;
            $this->idVeiculo = $idVeiculo;
            $this->idCliente = $idCliente;
            $this->dataDevolucao = $datadevolucao;
            $this->tanque = $tanque;
            $this->avaria = $avaria;
            $this->valortotal = $valortotal;
                    
        }

    }

?>