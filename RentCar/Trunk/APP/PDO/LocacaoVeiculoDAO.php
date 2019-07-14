<?php
    
    include_once './APP/Models/LocacaoVeiculo.php';
    include_once './APP/PDO/PDOFactory.php';

    class LocacaoVeiculoDAO
    {
        public function inserir(LocacaoVeiculo $locacao)
        {
            $qInserir = "INSERT INTO locacao(veiculoid, clienteid, dataretirada, datadevolucao, valor, formapagamento) VALUES(:veiculoId, :clienteId, :dataRetirada, :dataDevolucao, :valor, :formaPagamento)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);            
            $comando->bindParam(":veiculoId", $locacao->veiculoId);
            $comando->bindParam(":clienteId", $locacao->clienteId);
            $comando->bindParam(":dataRetirada", $locacao->dataRetirada);
            $comando->bindParam(":dataDevolucao", $locacao->dataDevolucao);
            $comando->bindParam(":valor", $locacao->valor);
            $comando->bindParam(":formaPagamento", $locacao->formaPagamento);                                          
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

            $qAtualizar = "UPDATE locacao SET veiculoId=:veiculoId, clienteId=:clienteId, dataRetirada=:dataRetirada, dataDevolucao=:dataDevolucao, valor=:valor, formaPagamento=:formaPagamento WHERE locacaoid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":veiculoId", $locacao->veiculoId);
            $comando->bindParam(":clienteId", $locacao->clienteId);
            $comando->bindParam(":dataRetirada", $locacao->dataRetirada);
            $comando->bindParam(":dataDevolucao", $locacao->dataDevolucao);
            $comando->bindParam(":valor", $locacao->valor);
            $comando->bindParam(":formaPagamento", $locacao->formaPagamento);
            $comando->bindParam(":id",$locacao->id);
            $comando->execute();
            return $locacao;   

        }

        public function listar()
        {
            $query = "SELECT 
                        locacaoid,
                        veiculo.veiculoid veiculoid,
                        veiculo.veiculomodelo veiculomodelo,
                        cliente.clienteid clienteid,
                        cliente.clientenome clientenome,
                        to_char(dataretirada, 'DD/MM/YYYY') dataretirada,
                        to_char(datadevolucao, 'DD/MM/YYYY') datadevolucao,
                        valor,
                        formapagamento
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
                $locacao[] = new LocacaoVeiculo($row->locacaoid, $row->veiculoid, $row->veiculomodelo, $row->clienteid, $row->clientenome, $row->dataretirada, $row->datadevolucao, $row->valor, $row->formapagamento);
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
                        to_char(dataretirada, 'DD/MM/YYYY') dataretirada,
                        to_char(datadevolucao, 'DD/MM/YYYY') datadevolucao,
                        valor,
                        formapagamento
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
            return new LocacaoVeiculo($result->locacaoid, $result->veiculoid, $result->veiculomodelo, $result->clienteid, $result->clientenome, $result->dataretirada, $result->datadevolucao, $result->valor, $result->formapagamento);
            
        }
    }
?>