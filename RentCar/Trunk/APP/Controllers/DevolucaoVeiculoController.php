<?php

include_once './APP/Models/Cliente.php';
include_once './APP/Models/Veiculo.php';

include_once './APP/Models/DevolucaoVeiculo.php';
include_once './APP/PDO/DevolucaoVeiculoDAO.php';

class DevolucaoVeiculoController {

    public function listar($request, $response, $args) {

        $dao= new DevolucaoVeiculoDAO;    
        $devolucao =  $dao->listar();
                
        return $response->withJson($devolucaoo);    
    }
    
    public function buscarPorId($request, $response, $args) {

        $id = $args['id'];
        
        $dao= new DevolucaoeiculoDAO;    
        $devolucao = $dao->buscarPorId($id);
        
        return $response->withJson($devolucao);

    }

    public function inserir( $request, $response, $args) {

        $var = $request->getParsedBody();
        $devolucao = new DevolucaoVeiculo(0, $var["idVeiculo"], $var["veiculoModelo"], $var["idCliente"], $var["clienteNome"], $var["datadevolucao"], $var["tanque"], $var["avaria"], $var["avaria"], $var["valortotal"]);
    
        $dao = new DevolucaoVeiculoDAO;
        $devolucao = $dao->inserir($devolucao);
    
        return $response->withJson($devolucao,201);    
    }
    
    public function atualizar($request, $response, $args) {

        $id = $args['id'];
        $var = $request->getParsedBody();
        
        $devolucao = new DevolucaoVeiculo($id, $var["idVeiculo"], $var["veiculoModelo"], $var["idCliente"], $var["clienteNome"], $var["datadevolucao"], $var["tanque"], $var["avaria"]), $var["valortotal"]);
        
        $dao = new DevolucaoVeiculoDAO;
        $devolucao = $dao->atualizar($devolucao);
    
        return $response->withJson($devolucao);    

    }

    public function deletar($request, $response, $args) {

        $id = $args['id'];

        $dao = new DevolucaoVeiculoDAO;
        $devolucao = $dao->deletar($id);
    
        return $response->withJson($devolucao);  

    }
}