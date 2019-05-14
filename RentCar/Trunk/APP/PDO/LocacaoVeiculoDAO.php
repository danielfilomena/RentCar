<?php
    include_once './APP/Models/LocacaoVeiculo.php';
    include_once './APP/PDO/PDOFactory.php';

    class LocacaoVeiculoDAO
    {
        public function inserir(LocacaoVeiculo $locacao)
        {

            $qInserir = "INSERT INTO locacao(veiculoid, clienteid, dataretirada, datadevolucao, valor, formapagamento) VALUES (:idveiculo, :idcliente, :dataretirada, :datadevolucao, :valor, :formapagamento)";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":idveiculo", $locacao->idVeiculo);
            $comando->bindParam(":idcliente", $locacao->idCliente);
            $comando->bindParam(":dataretirada", $locacao->dataretirada);
            $comando->bindParam(":datadevolucao", $locacao->datadevolucao);
            $comando->bindParam(":valor", $locacao->valor);
            $comando->bindParam(":formapagamento", $locacao->formapagamento);
            
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

        public function atualizar(LocacaoVeiculo $locacao)
        {
            
            $qAtualizar = "UPDATE locacao SET veiculoid=:idveiculo, clienteid=:idcliente, dataretirada=:dataretirada, datadevolucao=:datadevolucao, valor=:valor, formapagamento=:formapagamento  WHERE locacaoid=:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":idveiculo", $locacao->idVeiculo);
            $comando->bindParam(":idcliente", $locacao->idCliente);
            $comando->bindParam(":dataretirada", $locacao->dataretirada);
            $comando->bindParam(":datadevolucao", $locacao->datadevolucao);
            $comando->bindParam(":valor", $locacao->valor);
            $comando->bindParam(":formapagamento", $locacao->formapagamento);        
            $comando->bindParam(":id",$locacao->id);
            $comando->execute();
            return $locacao;

        }

        public function listar()
        {

            $query = "SELECT * FROM locacao";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->execute();
            $locacao=array();  
            while($row = $comando->fetch(PDO::FETCH_OBJ)){
                $locacao[] = new LocacaoVeiculo($row->locacaoid, $row->veiculoid, $row->clienteid, $row->dataretirada, $row->datadevolucao, $row->valor, $row->formapagamento);
            }
            return $locacao;

        }

        public function buscarPorId($id)
        {
            $query = 'SELECT * FROM locacao WHERE locacaoid=:id';       
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            $comando->bindParam ('id', $id);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            return new LocacaoVeiculo($result->locacaoid, $result->veiculoid, $result->clienteid, $result->dataretirada, $result->datadevolucao, $result->valor, $result->formapagamento);           
        }
    }
?>