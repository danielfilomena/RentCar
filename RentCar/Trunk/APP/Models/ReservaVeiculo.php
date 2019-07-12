<?php    

    class ReservaVeiculo {
        
        public $id;                
        public $idveiculo;
        public $veiculomodelo;
        public $idcliente;
        public $clientenome;
        public $dataretirada;        

        function __construct($id, $idVeiculo, $veiculoModelo, $idCliente, $clientenome, $dataretirada){

            $this->id = $id;
            $this->idveiculo = $idVeiculo;
            $this->veiculomodelo = $veiculoModelo;
            $this->idcliente = $idCliente;
            $this->clientenome = $clientenome;
            $this->dataretirada = $dataretirada;
            
        
        }

    }

?>