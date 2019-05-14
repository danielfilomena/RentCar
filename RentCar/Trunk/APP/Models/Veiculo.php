<?php

    class Veiculo {
        
        public $id;
        public $modelo;
        public $marca;
        public $ano;
        public $placa;

        function __construct($id, $modelo, $marca, $ano, $placa){
            $this->id = $id;
            $this->modelo = $modelo;
            $this->marca = $marca;
            $this->ano = $ano;
            $this->placa = $placa;
        }

    }

?>