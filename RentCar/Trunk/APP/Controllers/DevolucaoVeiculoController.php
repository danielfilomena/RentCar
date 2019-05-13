<?php

include_once('VeiculoController.php');
include_once('UsuarioController.php');
include_once('ClienteController.php');
include_once('LocacaoVeiculoController');
include_once('LocacaoVeiculo');
include_once('DevolucaoVeiculo');


class DevolucaoVeiculoController {
    public function listar($request, $response, $args) {
        $dao= new DevolucaoVeiculoDAO;    
        $devolucaoveiculo =  $dao->listar();
                
        return $response->withJson($devolucaoveiculo);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new DevolucaoVeiculoDAO;    
        $devolucaoveiculo = $dao->buscarPorId($id);
        
        return $response->withJson($devolucaoveiculo);
    }

    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $devolucaoveiculo = new DevolucaoVeiculo(0,$p['modelo'],$p['marca']),$p['placa']$p['cliente'],$p['datadevolucao'],$p['tanque'],$p['valor']),$p['avaria'];
    
        $dao = new DevolucaoVeiculoDAO;
        $devolucaoveiculo = $dao->inserir($devolucaoveiculo);
    
        return $response->withJson($devolucaoveiculo,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $devolucaoveiculo = new DevolucaoVeiculo($id, $p['modelo'],$p['marca']),$p['placa'],$p['cliente'],$p['datadevolucao'],$p['tanque'],$p['valor']),$p['avaria'];
        $dao = new DevolucaoVeiculoDAO;
        $devolucaoveiculo = $dao->atualizar($devolucaoveiculo);
    
        return $response->withJson($devolucaoveiculo);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new DevolucaoVeiculoDAO;
        $devolucaoveiculo = $dao->deletar($id);
    
        return $response->withJson($devolucaoveiculo);  
    }
}