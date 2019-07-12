<?php

include_once './APP/Models/Cliente.php';
include_once './APP/Models/Veiculo.php';

include_once './APP/Models/ReservaVeiculo.php';
include_once './APP/PDO/ReservaVeiculoDAO.php';

class ReservaVeiculoController {

    public function listar($request, $response, $args) {

        $dao= new ReservaVeiculoDAO;    
        $reserva =  $dao->listar();
                
        return $response->withJson($reserva);    
    }
    
    public function buscarPorId($request, $response, $args) {

        $id = $args['id'];
        
        $dao= new ReservaVeiculoDAO;    
        $reserva = $dao->buscarPorId($id);
        
        return $response->withJson($reserva);

    }

    public function inserir( $request, $response, $args) {

        $var = $request->getParsedBody();
        $reserva = new ReservaVeiculo(0, $var["idVeiculo"], $var["idCliente"], $var["dataretirada"]);
    
        $dao = new ReservaVeiculoDAO;
        $reserva = $dao->inserir($reserva);
    
        return $response->withJson($reserva,201);    
    }
    
    public function atualizar($request, $response, $args) {

        $id = $args['id'];
        $var = $request->getParsedBody();
        
        $reserva = new ReservaVeiculo($id, $var["idVeiculo"], $var["idCliente"], $var["dataretirada"]);
        
        $dao = new ReservaVeiculoDAO;
        $reserva = $dao->atualizar($reserva);
    
        return $response->withJson($reserva);    

    }

    public function deletar($request, $response, $args) {

        $id = $args['id'];

        $dao = new ReservaVeiculoDAO;
        $reserva = $dao->deletar($id);
    
        return $response->withJson($reserva);  

    }
}