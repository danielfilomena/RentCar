<?php

include_once './APP/Models/LocacaoVeiculo.php';
include_once './APP/PDO/LocacaoVeiculoDAO.php';


class LocacaoVeiculoController {

    public function listar($request, $response, $args) {

        $dao= new LocacaoVeiculoDAO;    
        $locacao =  $dao->listar();
                
        return $response->withJson($locacao);    
    }
    
    public function buscarPorId($request, $response, $args) {

        $id = $args['id'];
        
        $dao= new LocacaoVeiculoDAO;    
        $locacao = $dao->buscarPorId($id);
        
        return $response->withJson($locacao);
    }

    public function inserir( $request, $response, $args) {

        $var = $request->getParsedBody();        
        $locacao = new LocacaoVeiculo(0, $var["idVeiculo"], $var["idCliente"], $var["dataretirada"], $var["datadevolucao"], $var["valor"], $var["formapagamento"]);

        $dao = new LocacaoVeiculoDAO;
        $locacao = $dao->inserir($locacao);
    
        return $response->withJson($locacao,201);    
    }
    
    public function atualizar($request, $response, $args) {

        $id = $args['id'];
        $var = $request->getParsedBody();
        $locacao = new LocacaoVeiculo($id, $var["idVeiculo"], $var["idCliente"], $var["dataretirada"], $var["datadevolucao"], $var["valor"], $var["formapagamento"]);

        $dao = new LocacaoVeiculoDAO;
        $locacao = $dao->atualizar($locacao);
    
        return $response->withJson($locacao);    

    }

    public function deletar($request, $response, $args) {

        $id = $args['id'];

        $dao = new LocacaoVeiculoDAO;
        $locacao = $dao->deletar($id);
    
        return $response->withJson($locacao);  
    }
}