<?php
    
    include_once './APP/Models/ReservaVeiculo.php';
	include_once './APP/PDO/PDOFactory.php';

    class ReservaVeiculoDAO
    {
        public function inserir(ReservaVeiculo $reserva)
        {
            $qInserir = "INSERT INTO reserva(veiculoid, clienteid, dataretirada) VALUES(:idveiculo, :idcliente, :dataretirada)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);            
            $comando->bindParam(":idveiculo", $reserva->idVeiculo);
            $comando->bindParam(":idcliente", $reserva->idCliente);
            $comando->bindParam(":dataretirada", $reserva->dataretirada);                        
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

        public function atualizar(ReservaVeiculo $reserva)
        {

            $qAtualizar = "UPDATE reserva SET veiculoid=:idveiculo, clienteid=:idcliente, dataretirada=:dataretirada WHERE reservaid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":idveiculo", $reserva->idVeiculo);
            $comando->bindParam(":idcliente", $reserva->idCliente);
            $comando->bindParam(":dataretirada", $reserva->dataretirada);
            $comando->bindParam(":id",$reserva->id);
            $comando->execute();
            return $reserva;   

        }

        public function listar()
        {
		    $query = "SELECT 
                        reservaid,
                        veiculo.veiculoid veiculoid,
                        veiculo.veiculomodelo veiculomodelo,
                        cliente.clienteid clienteid,
                        cliente.clientenome clientenome,
                        to_char(dataretirada, 'DD/MM/YYYY') dataretirada
                     FROM 
                        RESERVA
                     INNER JOIN 
                        VEICULO ON reserva.veiculoid = veiculo.veiculoid
                    INNER JOIN 
                        CLIENTE ON reserva.clienteid = cliente.clienteid";
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $reserva=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $reserva[] = new ReservaVeiculo($row->reservaid, $row->veiculoid, $row->veiculomodelo, $row->clienteid, $row->clientenome, $row->dataretirada);
            }
            return $reserva;
        }

        public function buscarPorId($id)
        {
 		    $query = "SELECT * FROM reserva WHERE reservaid=:id";		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (':id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new ReservaVeiculo($result->reservaid, $result->veiculoid, $result->clienteid, $result->dataretirada);
        }
    }
?>