<?php

    class ReservaVeiculo {
        
        public $id;        
        public $idVeiculo;
        public $idCliente;
        public $dataretirada;        

        function __construct($id, $idVeiculo, $idCliente, $dataretirada){

            $this->id = $id;
            $this->idVeiculo = $idVeiculo;
            $this->idCliente = $idCliente;
            $this->dataretirada = $dataretirada;
            
        
        }

    }

?>