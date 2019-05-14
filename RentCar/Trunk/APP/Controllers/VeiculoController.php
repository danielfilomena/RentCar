<?php

include_once './APP/Controllers/VeiculoController.php';
include_once './APP/PDO/VeiculoDAO.php';


class VeiculoController {

    public function listar($request, $response, $args) {

        $dao = new VeiculoDAO();
        $veiculo = $dao->listar();

        return $response->withJson($veiculo);

    }
       
    public function buscarPorId($request, $response, $args) {
        
        $id = $args['id'];
        
        $dao= new VeiculoDAO;    
        $veiculo = $dao->buscarPorId($id);
        
        return $response->withJson($veiculo);

    }

    public function inserir($request, $response, $args) 
    {

        $var = $request->getParsedBody();
        $veiculo = new Veiculo(0, $var["modelo"], $var["marca"], $var["ano"], $var["placa"]);
    
        $dao = new VeiculoDAO;
        $veiculo = $dao->inserir($veiculo);
    
        return $response->withJson($veiculo,201);            
    }
    
    public function atualizar($request, $response, $args) {

        $id = $args['id'];
        $var = $request->getParsedBody();
        $veiculo = new Veiculo($id, $var["modelo"], $var["marca"], $var["ano"], $var["placa"]);
    
        $dao = new VeiculoDAO;
        $veiculo = $dao->atualizar($veiculo);
    
        return $response->withJson($veiculo);    

    }

    public function deletar($request, $response, $args) {

        $id = $args['id'];

        $dao = new VeiculoDAO;
        $veiculo = $dao->deletar($id);
    
        return $response->withJson($veiculo);  

    }

}