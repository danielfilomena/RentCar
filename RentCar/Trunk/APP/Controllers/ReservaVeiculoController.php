<?php

include_once('VeiculoController.php');
include_once('UsuarioController.php');
include_once('ClienteController.php');
include_once('ReservaVeiculoController');


class ReservaVeiculoController {
    public function listar($request, $response, $args) {
        $dao= new ReservaVeiculoDAO;    
        $reservaveiculo =  $dao->listar();
                
        return $response->withJson($reservaveiculo);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new ReservaVeiculoDAO;    
        $reservaveiculo = $dao->buscarPorId($id);
        
        return $response->withJson($reservaveiculo);
    }

    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $reservaveiculo = new ReservaVeiculo(0,$p['modelo'],$p['marca']),$p['placa'],$p['cliente'],$p['dataretirada'],$p['dataprevistaentrega'],$p['valor']),$p['formapagamento'];
    
        $dao = new RservaVeiculoDAO;
        $reservaveiculo = $dao->inserir($reservaveiculo);
    
        return $response->withJson($reservaveiculo,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $reservaveiculo = new ReservaVeiculo($id, $p['modelo'],$p['marca']),$p['placa'],$p['cliente'],$p['dataretirada'],$p['dataprevistaentrega'],$p['valor']),$p['formapagamento'];
        $dao = new RservaVeiculoDAO;
        $reservaveiculo = $dao->atualizar($reservaveiculo);
    
        return $response->withJson($reservaveiculo);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new RservaVeiculoDAO;
        $reservaveiculo = $dao->deletar($id);
    
        return $response->withJson($reservaveiculo);  
    }
}