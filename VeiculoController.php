<?php

include_once('VeiculoController.php');
include_once('UsuarioController.php');
include_once('ClienteController.php');


class VeiculoController {
    public function listar($request, $response, $args) {
        $dao= new VeiculoDAO;    
        $veiculo =  $dao->listar();
                
        return $response->withJson($veiculos);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new VeiculoDAO;    
        $veiculo = $dao->buscarPorId($id);
        
        return $response->withJson($veiculo);
    }

    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $veiculo = new Veiculo(0,$p['modelo'],$p['marca']),$p['ano'],$p['placa']);
    
        $dao = new VeiculoDAO;
        $veiculo = $dao->inserir($veiculo);
    
        return $response->withJson($veiculo,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $veiculo = new Veiculo($id, $p['modelo'],$p['marca']),$p['ano'],$p['placa']);
    
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