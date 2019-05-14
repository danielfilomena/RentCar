<?php

include_once './APP/Models/Cliente.php';
include_once './APP/PDO/ClienteDAO.php';

class ClienteController {

    public function listar($request, $response, $args) {

        $dao= new ClienteDAO;    
        $cliente =  $dao->listar();
                
        return $response->withJson($cliente);    
    }
    
    public function buscarPorId($request, $response, $args) {

        $id = $args['id'];
        
        $dao= new ClienteDAO;    
        $cliente = $dao->buscarPorId($id);
        
        return $response->withJson($cliente);
    }

    public function inserir($request, $response, $args) {

        $var = $request->getParsedBody();
        $cliente = new Cliente(0, $var["nome"], $var["cnh"], $var["endereco"]);        
    
        $dao = new ClienteDAO;
        $cliente = $dao->inserir($cliente);
    
        return $response->withJson($cliente,201);    

    }
    
    public function atualizar($request, $response, $args) {

        $id = $args['id'];
        $var = $request->getParsedBody();
        $cliente = new Cliente($id, $var["nome"], $var["cnh"], $var["endereco"]);
    
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