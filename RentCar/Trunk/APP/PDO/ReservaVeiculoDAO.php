<?php
    include_once 'ReservaVeiculo.php';
	include_once 'PDOFactory.php';

    class RservaVeiculoDAO
    {
        public function inserir(RservaVeiculo $reservaveiculo)
        {
            $qInserir = "INSERT INTO reserva(reservamodelo, reservamarca, reservaplaca, reservacliente, reservadataretirada, reservadataprevistaentrega, valor, reservaformapagamento ) VALUES (:modelo,:marca,:placa,:cliente,:dataretirada,:dataprevistaentrega,:valor,:formapagamento)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":modelo",$reserva->modelo);
            $comando->bindParam(":marca",$reserva->marca);
            $comando->bindParam(":placa",$reserva->placa);
            $comando->bindParam(":placa",$reserva->cliente);
            $comando->bindParam(":placa",$reserva->dataretirada);
            $comando->bindParam(":placa",$reserva->dataprevistaentrega);
            $comando->bindParam(":placa",$reserva->valor);
            $comando->bindParam(":placa",$reserva->formapagamento);
            
            $comando->execute();
            $reserva->id = $pdo->lastInsertId();
            return $reserva;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from reserva WHERE reservaid=:id";            
            $reserva = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $reserva;
        }

        public function atualizar(Reserva $reserva)
        {
            $qAtualizar = "UPDATE reserva SET reservamodelo=:modelo, reservamarca=:marca, reservaplaca=:placa, reservacliente=:cliente, reservadataretirada=:dataretirada, reservadataprevistaentrega=:dataprevistaentrega, reservavalor=:valor, reservaformapagamento=:formapagamento  WHERE reservaid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":modelo",$reserva->modelo);
            $comando->bindParam(":marca",$reserva->marca);
            $comando->bindParam(":placa",$reserva->placa);
            $comando->bindParam(":placa",$reserva->cliente);
            $comando->bindParam(":placa",$reserva->dataretirada);
            $comando->bindParam(":placa",$reserva->dataprevistaentrega);
            $comando->bindParam(":placa",$reserva->valor);
            $comando->bindParam(":placa",$reserva->formapagamento);
            $comando->bindParam(":id",$reserva->id);
            $comando->execute();
            return $reserva;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM reserva';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $reservas=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $reservas[] = new Reserva($row->id,$row->modelo,$row->marca,$row->placa,$row->cliente,$row->dataretirada,$row->dataprevistaentrega,$row->valor,$row->formapagamento);
            }
            return $reservas;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM reserva WHERE reservaid=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Reserva($row->id,$row->modelo,$row->marca,$row->placa,$row->cliente,$row->dataretirada,$row->dataprevistaentrega,$row->valor,$row->formapagamento);           
        }
    }
?>