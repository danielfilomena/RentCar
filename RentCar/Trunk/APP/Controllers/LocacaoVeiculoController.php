<?php

include_once('VeiculoController.php');
include_once('UsuarioController.php');
include_once('ClienteController.php');
include_once('locacaoVeiculoController');
include_once('LocacaoVeiculo');


class LocacaoVeiculoController {
    public function listar($request, $response, $args) {
        $dao= new locacaoVeiculoDAO;    
        $locacaoveiculo =  $dao->listar();
                
        return $response->withJson($locacaoveiculo);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new locacaoVeiculoDAO;    
        $locacaoveiculo = $dao->buscarPorId($id);
        
        return $response->withJson($locacaoveiculo);
    }

    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $locacaoveiculo = new locacaoVeiculo(0,$p['modelo'],$p['marca']),$p['placa']$p['cliente'],$p['dataatualretirada'],$p['dataprevistaentrega'],$p['valor']),$p['formapagamento'];
    
        $dao = new locacaoVeiculoDAO;
        $locacaoveiculo = $dao->inserir($locacaoveiculo);
    
        return $response->withJson($locacaoveiculo,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $locacaoveiculo = new locacaoVeiculo($id, $p['modelo'],$p['marca']),$p['placa'],$p['cliente'],$p['dataatualretirada'],$p['dataprevistaentrega'],$p['valor']),$p['formapagamento'];
        $dao = new LocacaoVeiculoDAO;
        $locacaoveiculo = $dao->atualizar($locacaoveiculo);
    
        return $response->withJson($locacaoveiculo);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new LocacaoVeiculoDAO;
        $locacaoveiculo = $dao->deletar($id);
    
        return $response->withJson($locacaoveiculo);  
    }
}