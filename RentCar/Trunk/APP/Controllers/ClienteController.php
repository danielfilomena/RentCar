<?php

class ClienteController {

    public function listar($request, $response, $args) {
        $dao= new ClienteDAO;    
        $cliente =  $dao->listar();
                
        return $response->withJson($clientes);    
    }
    
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new ClienteDAO;    
        $cliente = $dao->buscarPorId($id);
        
        return $response->withJson($cliente);
    }

    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $cliente = new Cliente(0,$p['nome'],$p['cnh']),$p['endereco']);
    
        $dao = new ClienteDAO;
        $cliente = $dao->inserir($cliente);
    
        return $response->withJson($cliente,201);    
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $cliente = new Cliente($id, $p['nome'],$p['cnh']),$p['endereco']);
    
        $dao = new ClienteDAO;
        $cliente = $dao->atualizar($cliente);
    
        return $response->withJson($cliente);    
    }

    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new ClienteDAO;
        $cliente = $dao->deletar($id);
    
        return $response->withJson($cliente);  
    }
    
}