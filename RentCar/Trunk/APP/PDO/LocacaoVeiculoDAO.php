<?php
    
    include_once './APP/Models/LocacaoVeiculo.php';
    include_once './APP/PDO/PDOFactory.php';

    class LocacaoVeiculoDAO
    {
        public function inserir(LocacaoVeiculo $locacao)
        {
            $qInserir = "INSERT INTO locacao(veiculoid, clienteid, dataretirada, datadevolucao, valor, formadepagamento) VALUES(:idveiculo, :idcliente, :dataretirada, :datadevolucao, :valor, :formadepagamento)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);            
            $comando->bindParam(":idveiculo", $locacao->idVeiculo);
            //$comando->bindParam(":veiculomodelo", $locacao->veiculoModelo);
            $comando->bindParam(":idcliente", $locacao->idCliente);
            //$comando->bindParam(":clientenome", $locacao->clienteNome);
            $comando->bindParam(":dataretirada", $locacao->dataretirada);                        
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

            $qAtualizar = "UPDATE locacao SET veiculoid=:idveiculo, clienteid=:idcliente, dataretirada=:dataretirada, datadevolucao=:datadevolucao, valor=:valor, formadepagamento=:formadepagamento WHERE locacaoid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":idveiculo", $locacao->idVeiculo);
            $comando->bindParam(":idcliente", $locacao->idCliente);
            $comando->bindParam(":dataretirada", $locacao->dataretirada);
            $comando->bindParam(":datadevolucao", $locacao->datadevolucao);
            $comando->bindParam(":valor", $locacao->valor);
            $comando->bindParam(":formadepagamento", $locacao->formadepagamento);
            $comando->bindParam(":id",$locacao->id);
            $comando->execute();
            return $locacao;   

        }

        public function listar()
        {
            $query = "SELECT 
                        locacaoid,
                        veiculo.veiculoid veiculoid,
                        veiculo.veiculomodelo veiculoModelo,
                        cliente.clienteid clienteid,
                        cliente.clientenome clienteNome,
                        to_char(dataretirada, 'DD/MM/YYYY') dataretirada
                        to_char(dataretirada, 'DD/MM/YYYY') datadevolucao
                     FROM 
                        LOCACAO
                     INNER JOIN 
                        VEICULO ON locacao.veiculoid = veiculo.veiculoid
                    INNER JOIN 
                        CLIENTE ON locacao.clienteid = cliente.clienteid";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->execute();
            $locacao=array();   
            while($row = $comando->fetch(PDO::FETCH_OBJ)){
                $locacao[] = new LocacaoVeiculo($row->locacaoid, $row->veiculoid, $row->veiculomodelo, $row->clienteid, $row->clientenome, $row->dataretirada, $row->datadevolucao, $row->valor, $row->formadepagamento);
            }
            return $locacao;
        }

        public function buscarPorId($id)
        {
            $query = "SELECT 
                        locacaoid,
                        veiculo.veiculoid veiculoid,
                        veiculo.veiculomodelo veiculoModelo,
                        cliente.clienteid clienteid,
                        cliente.clientenome clienteNome,
                        to_char(dataretirada, 'DD/MM/YYYY') dataretirada
                        to_char(dataretirada, 'DD/MM/YYYY') datadevolucao
                    FROM 
                        LOCACAO
                    INNER JOIN 
                        VEICULO ON locacao.veiculoid = veiculo.veiculoid
                    INNER JOIN 
                        CLIENTE ON locacao.clienteid = cliente.clienteid  
                    WHERE locacaoid=:id";       

            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            $comando->bindParam (':id', $id);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            return new LocacaoVeiculo($result->locacaoid, $result->veiculoid, $result->veiculomodelo, $result->clienteid, $result->clientenome, $result->dataretirada, $result->datadevolucao, $result->valor, $result->formadepagamento);
            
        }
    }
?>