<?php
    include_once 'locacaoVeiculo.php';
    include_once 'PDOFactory.php';

    class LocacaoVeiculoDAO
    {
        public function inserir(LocacaoVeiculo $locacaoveiculo)
        {
            $qInserir = "INSERT INTO locacao(locacaomodelo, locacaomarca, locacaoplaca, locacaocliente, locacaodataatualretirada, locacaodataprevistaentrega, locacaovalor, locacaoformapagamento ) VALUES (:modelo,:marca,:cliente,:dataatualretirada,:dataprevistaentrega,:valor,:formapagamento)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":modelo",$locacao->modelo);
            $comando->bindParam(":marca",$locacao->marca);
            $comando->bindParam(":placa",$locacao->placa);
            $comando->bindParam(":cliente",$locacao->cliente);
            $comando->bindParam(":dataatualretirada",$locacao->dataatualretirada);
            $comando->bindParam(":dataprevistaentrega",$locacao->dataprevistaentrega);
            $comando->bindParam(":valor",$locacao->valor);
            $comando->bindParam(":formapagamento",$locacao->formapagamento);
            
            $comando->execute();
            $locacao->id = $pdo->lastInsertId();
            return $locacao;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from locacao WHERE locacaoid=:id";            
            $locacao = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $locacao;
        }

        public function atualizar(Locacao $locacao)
        {
            $qAtualizar = "UPDATE locacao SET locacaomodelo=:modelo, locacaomarca=:marca, locacaoplaca=:placa, locacaocliente=:cliente, locacaodataatualretirada=:dataatualretirada, locacaodataprevistaentrega=:dataprevistaentrega, locacaovalor=:valor, locacaoformapagamento=:formapagamento  WHERE locacaoid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
               $comando->bindParam(":modelo",$locacao->modelo);
            $comando->bindParam(":marca",$locacao->marca);
            $comando->bindParam(":placa",$locacao->placa);
            $comando->bindParam(":cliente",$locacao->cliente);
            $comando->bindParam(":dataatualretirada",$locacao->dataatualretirada);
            $comando->bindParam(":dataprevistaentrega",$locacao->dataprevistaentrega);
            $comando->bindParam(":valor",$locacao->valor);
            $comando->bindParam(":formapagamento",$locacao->formapagamento);
            $comando->bindParam(":id",$locacao->id);
            $comando->execute();
            return $locacao;        
        }

        public function listar()
        {
            $query = 'SELECT * FROM locacao';
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->execute();
            $locacaos=array();  
            while($row = $comando->fetch(PDO::FETCH_OBJ)){
                $locacaos[] = new locacao($row->id,$row->modelo,$row->marca,$row->placa$row->cliente,$row->dataatualretirada,$row->dataprevistaentrega,$row->valor,$row->formapagamento);
            }
            return $locacaos;
        }

        public function buscarPorId($id)
        {
            $query = 'SELECT * FROM locacao WHERE locacaoid=:id';       
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            $comando->bindParam ('id', $id);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            return new locacao($row->id,$row->modelo,$row->marca,$row->placa,$row->cliente,$row->dataatualretirada,$row->dataprevistaentrega,$row->valor,$row->formapagamento);           
        }
    }
?>