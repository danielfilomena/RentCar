<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once('APP/Controllers/UsuarioController.php');

require './vendor/autoload.php';

$app = new \Slim\App;

$app->group('/usuarios', function() use ($app) {    

    $app->get("","'UsuarioController:listar");

    //$app->post('','ProdutoController:inserir');

    //$app->get('/{id}','ProdutoController:buscarPorId');    
    //$app->put('/{id}','ProdutoController:atualizar');
    //$app->delete('/{id}', 'ProdutoController:deletar');

});

$app->run();
?>
