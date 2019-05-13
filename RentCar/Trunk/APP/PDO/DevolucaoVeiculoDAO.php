<?php
    include_once 'DevolucaoVeiculo.php';
	include_once 'PDOFactory.php';

    class DevolucaoVeiculoDAO
    {
        public function inserir(DevolucaoVeiculo $devolucaoVeiculo)
        {
            $qInserir = "INSERT INTO devolucao(devolucaomodelo, devolucaomarca, devolucaocliente, datadevolucao, tanque, devolucaovalor, avaria ) VALUES (:modelo,:marca,:cliente,:datadevolucao,:tanque,:valor,:avaria)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":modelo",$devolucao->modelo);
            $comando->bindParam(":marca",$devolucao->marca);
            $comando->bindParam(":cliente",$devolucao->cliente);
            $comando->bindParam(":datadevolucao",$devolucao->datadevolucao);
            $comando->bindParam(":tanque",$devolucao->tanque);
            $comando->bindParam(":valor",$devolucao->valor);
            $comando->bindParam(":avaria",$devolucao->avaria);
            
            $comando->execute();
            $devolucao->id = $pdo->lastInsertId();
            return $devolucao;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from devolucao WHERE devolucaoid=:id";            
            $devolucao = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $devolucao;
        }

        public function atualizar(Devolucao $devolucao)
        {
            $qAtualizar = "UPDATE devolucao SET devolucaomodelo=:modelo, devolucaomarca=:marca, devolucaocliente=:cliente, datadevolucao=:datadevolucao, tanque=:tanque, devolucaovalor=:valor, devolucaoavaria=:avaria  WHERE devolucaoid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
               $comando->bindParam(":modelo",$devolucao->modelo);
            $comando->bindParam(":marca",$devolucao->marca);
            $comando->bindParam(":cliente",$devolucao->cliente);
            $comando->bindParam(":datadevolucao",$devolucao->datadevolucao);
            $comando->bindParam(":tanque",$devolucao->tanque);
            $comando->bindParam(":valor",$devolucao->valor);
            $comando->bindParam(":avaria",$devolucao->avaria);
            $comando->bindParam(":id",$devolucao->id);
            $comando->execute();
            return $devolucao;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM devolucao';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $devolucaos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $devolucaos[] = new Devolucao($row->id,$row->modelo,$row->marca,$row->cliente,$row->datadevolucao,$row->tanque,$row->valor,$row->avaria);
            }
            return $devolucaos;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM devolucao WHERE devolucaoid=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new devolucao($row->id,$row->modelo,$row->marca,,$row->cliente,$row->datadevolucao,$row->tanque,$row->valor,$row->avaria);           
        }
    }
?>