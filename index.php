<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once('VeiculoController.php');
include_once('UsuarioController.php');
include_once('ClienteController.php');
require './vendor/autoload.php';

$app = new \Slim\App;
	
$app->group('/produtos', function() use ($app) {
    $app->get('','ProdutoController:listar');
    $app->post('','ProdutoController:inserir');

$app->group('/cliente', function() use ($app) {
    $app->get('','clienteController:listar');
    $app->post('','ClienteController:inserir');

    $app->get('/{id}','ProdutoController:buscarPorId');    
    $app->put('/{id}','ProdutoController:atualizar');
    $app->delete('/{id}', 'ProdutoController:deletar');
    $app->get('/{id}','ClienteController:buscarPorId');    
    $app->put('/{id}','ClienteController:atualizar');
    $app->delete('/{id}', 'ClienteController:deletar');
})-> 
})->add('UsuarioController:validarToken');

$app->post('/usuarios','UsuarioController:inserir');

$app->post('/auth','UsuarioController:autenticar');

$app->run();
?>