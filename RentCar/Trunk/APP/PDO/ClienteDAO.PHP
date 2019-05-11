<?php
    include_once 'Cliente.php';
	include_once 'PDOFactory.php';

    class ClienteDAO
    {
        public function inserir(Cliente $cliente)
        {
            $qInserir = "INSERT INTO cliente(clientenome, clientecnh, clienteendereco) VALUES (:nome,:cnh,:endereco)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$cliente->nome);
            $comando->bindParam(":cnh",$cliente->cnh);
            $comando->bindParam(":endereco",$cliente->endereco);
            
            $comando->execute();
            $cliente->id = $pdo->lastInsertId();
            return $cliente;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from cliente WHERE clienteid=:id";            
            $cliente = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $cliente;
        }

        public function atualizar(Cliente $cliente)
        {
            $qAtualizar = "UPDATE cliente SET clientenome=:nome, clientecnh=:cnh, clienteendereco=:endereco WHERE clienteid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$cliente->nome);
            $comando->bindParam(":cnh",$cliente->cnh);
            $comando->bindParam(":endereco",$cliente->endereco);
            $comando->execute();
            return $cliente;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM cliente';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $clientes=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $clientes[] = new Cliente($row->id,$row->nome,$row->cnh,$row->endereco);
            }
            return $clientes;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM cliente WHERE clienteid=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new cliente($result->id,$result->nome,$result->cnh,$result->endereco);           
        }
    }
?>