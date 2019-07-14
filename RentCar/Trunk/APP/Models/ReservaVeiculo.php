<?php    

    class ReservaVeiculo {
        
        public $id;                
        public $idVeiculo;
        public $veiculoModelo;
        public $idCliente;
        public $clienteNome;
        public $dataretirada;        

        function __construct($id, $idVeiculo, $veiculoModelo, $idCliente, $clienteNome, $dataretirada){

            $this->id = $id;
            $this->idVeiculo = $idVeiculo;
            $this->veiculoModelo = $veiculoModelo;
            $this->idCliente = $idCliente;
            $this->clienteNome = $clienteNome;
            $this->dataretirada = $dataretirada;            
        
        }

    }

?>