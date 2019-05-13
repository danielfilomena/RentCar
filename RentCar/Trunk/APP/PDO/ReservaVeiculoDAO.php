<?php
    include_once 'ReservaVeiculo.php';
	include_once 'PDOFactory.php';

    class ReservaVeiculoDAO
    {
        public function inserir(ReservaVeiculo $reservaveiculo)
        {
            $qInserir = "INSERT INTO reserva(reservamodelo, reservamarca, reservacliente, reservadataretirada, reservadataprevistaentrega, reservavalor, reservaformapagamento ) VALUES (:modelo,:marca,:cliente,:dataretirada,:dataprevistaentrega,:valor,:formapagamento)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":modelo",$reserva->modelo);
            $comando->bindParam(":marca",$reserva->marca);
            $comando->bindParam(":cliente",$reserva->cliente);
            $comando->bindParam(":dataretirada",$reserva->dataretirada);
            $comando->bindParam(":dataprevistaentrega",$reserva->dataprevistaentrega);
            $comando->bindParam(":valor",$reserva->valor);
            $comando->bindParam(":formapagamento",$reserva->formapagamento);
            
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
            $qAtualizar = "UPDATE reserva SET reservamodelo=:modelo, reservamarca=:marca, reservacliente=:cliente, reservadataretirada=:dataretirada, reservadataprevistaentrega=:dataprevistaentrega, reservavalor=:valor, reservaformapagamento=:formapagamento  WHERE reservaid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
               $comando->bindParam(":modelo",$reserva->modelo);
            $comando->bindParam(":marca",$reserva->marca);
            $comando->bindParam(":cliente",$reserva->cliente);
            $comando->bindParam(":dataretirada",$reserva->dataretirada);
            $comando->bindParam(":dataprevistaentrega",$reserva->dataprevistaentrega);
            $comando->bindParam(":valor",$reserva->valor);
            $comando->bindParam(":formapagamento",$reserva->formapagamento);
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
			    $reservas[] = new Reserva($row->id,$row->modelo,$row->marca,$row->cliente,$row->dataretirada,$row->dataprevistaentrega,$row->valor,$row->formapagamento);
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
		    return new Reserva($row->id,$row->modelo,$row->marca,,$row->cliente,$row->dataretirada,$row->dataprevistaentrega,$row->valor,$row->formapagamento);           
        }
    }
?>