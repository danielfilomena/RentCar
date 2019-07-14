<?php
    
    include_once './APP/Models/DevolucaoVeiculo.php';
    include_once './APP/PDO/PDOFactory.php';

    class DevolucaoVeiculoDAO
    {
        public function inserir(DevolucaoVeiculo $devolucao)
        {
            $qInserir = "INSERT INTO devolucao(veiculoid, clienteid, datadevolucao, tanque, avaria, valortotal) VALUES(:idveiculo, :idcliente, :datadevolucao, :tanque, :avaria, :valortotal)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);            
            $comando->bindParam(":idveiculo", $devolucao->idVeiculo);
            $comando->bindParam(":idcliente", $devolucao->idCliente);
            $comando->bindParam(":datadevolucao", $devolucao->datadevolucao);
            $comando->bindParam(":tanque", $devolucao->tanque);
            $comando->bindParam(":avaria", $devolucao->avaria);
            $comando->bindParam(":valortotal", $devolucao->valortotal);                        
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

        public function atualizar(DevolucaoVeiculo $devolucao)
        {

            $qAtualizar = "UPDATE devolucao SET veiculoid=:idveiculo, clienteid=:idcliente, datadevolucao=:datadevolucao, tanque=:tanque, avaria=:avaria, valortotal=:valortotal WHERE devolucaoid=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":idveiculo", $devolucao->idVeiculo);
            $comando->bindParam(":idcliente", $devolucao->idCliente);
            $comando->bindParam(":datadevolucao", $devolucao->datadevolucao);
            $comando->bindParam(":tanque", $devolucao->tanque);
            $comando->bindParam(":avaria", $devolucao->avaria);
            $comando->bindParam(":valortotal", $devolucao->valortotal);
            $comando->bindParam(":id",$devolucao->id);
            $comando->execute();
            return $devolucao;   

        }

        public function listar()
        {
            $query = "SELECT 
                        devolucaoid,
                        veiculo.veiculoid veiculoid,
                        veiculo.veiculomodelo veiculoModelo,
                        cliente.clienteid clienteid,
                        cliente.clientenome clienteNome,
                        to_char(dataretirada, 'DD/MM/YYYY') datadevolucao
                     FROM 
                        DEVOLUCAO
                     INNER JOIN 
                        VEICULO ON devolucao.veiculoid = veiculo.veiculoid
                    INNER JOIN 
                        CLIENTE ON devolucao.clienteid = cliente.clienteid";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->execute();
            $devolucao=array();   
            while($row = $comando->fetch(PDO::FETCH_OBJ)){
                $devolucao[] = new DevolucaoVeiculo($row->devolucaoid, $row->veiculoid, $row->veiculomodelo, $row->clienteid, $row->clientenome, $row->datadevolucao, $row->tanque, $row->avaria, $row->valortotal);
            }
            return $devolucao;
        }

        public function buscarPorId($id)
        {
            $query = "SELECT 
                        devolucaoid,
                        veiculo.veiculoid veiculoid,
                        veiculo.veiculomodelo veiculoModelo,
                        cliente.clienteid clienteid,
                        cliente.clientenome clienteNome,
                        to_char(dataretirada, 'DD/MM/YYYY') datadevolucao
                    FROM 
                        DEVOLUCAO
                    INNER JOIN 
                        VEICULO ON devolucao.veiculoid = veiculo.veiculoid
                    INNER JOIN 
                        CLIENTE ON devolucao.clienteid = cliente.clienteid  
                    WHERE devolucaoid=:id";       

            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            $comando->bindParam (':id', $id);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            return new DevolucaoVeiculo($result->devolucaoid, $result->veiculoid, $result->veiculomodelo, $result->clienteid, $result->clientenome, $result->datadevolucao, $result->tanque, $result->avaria, $result->valortotal,);
            
        }
    }
?>