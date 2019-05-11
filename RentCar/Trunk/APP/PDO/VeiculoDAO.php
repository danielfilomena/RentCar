<?php
    include_once 'Veiculo.php';
	include_once 'PDOFactory.php';

    class VeiculoDAO
    {
        public function inserir(Veiculo $veiculo)
        {
            $qInserir = "INSERT INTO veiculo(veiculomodelo, veiculomarca, veiculoano, veiculoplaca) VALUES (:modelo,:marca,:ano,:placa)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":modelo",$veiculo->modelo);
            $comando->bindParam(":marca",$veiculo->marca);
            $comando->bindParam(":ano",$veiculo->ano);
            $comando->bindParam(":placa",$veiculo->placa);
            
            $comando->execute();
            $veiculo->id = $pdo->lastInsertId();
            return $veiculo;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from veiculo WHERE veiculoid=:id";            
            $veiculo = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $veiculo;
        }

        public function atualizar(Veiculo $veiculo)
        {
            $qAtualizar = "UPDATE veiculo SET veiculomodelo=:modelo, veiculomarca=:marca, veiculoano=:ano, veiculoplaca=:placa WHERE veiculoid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
                $comando->bindParam(":modelo",$veiculo->modelo);
            $comando->bindParam(":marca",$veiculo->marca);
            $comando->bindParam(":ano",$veiculo->ano);
            $comando->bindParam(":placa",$veiculo->placa);
            $comando->bindParam(":id",$veiculo->id);
            $comando->execute();
            return $veiculo;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM veiculo';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $veiculos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $veiculos[] = new Veiculo($row->id,$row->modelo,$row->marca,$row->ano,$row->placa);
            }
            return $veiculos;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM veiculo WHERE veiculoid=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Veiculo($result->id,$result->modelo,$result->marca,$result->ano,$result->placa);           
        }
    }
?>