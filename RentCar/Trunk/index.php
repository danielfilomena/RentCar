<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once('./APP/Controllers/UsuarioController.php');
include_once('./APP/Controllers/VeiculoController.php');
include_once('./APP/Controllers/ClienteController.php');
include_once('./APP/Controllers/DevolucaoVeiculoController.php');
include_once('./APP/Controllers/LocacaoVeiculoController.php');
include_once('./APP/Controllers/ReservaVeiculoController.php');

require './vendor/autoload.php';

$app = new \Slim\App;

$app->group('/veiculos', function() use ($app) {    

    $app->get("", 'VeiculoController:listar');
    $app->post("", 'VeiculoController:inserir');

    $app->get('/{id}','VeiculoController:buscarPorId');
    $app->put('/{id}','VeiculoController:atualizar');
    $app->delete('/{id}', 'VeiculoController:deletar');

})->add('UsuarioController:validarToken');

$app->group('/clientes', function() use ($app) {    

    $app->get("", 'ClienteController:listar');
    $app->post("", 'ClienteController:inserir');

    $app->get('/{id}','ClienteController:buscarPorId');
    $app->put('/{id}','ClienteController:atualizar');
    $app->delete('/{id}', 'ClienteController:deletar');

})->add('UsuarioController:validarToken');

$app->group('/devolucoes', function() use ($app) {    

    $app->get("", 'DevolucaoVeiculoController:listar');
    $app->post("", 'DevolucaoVeiculoController:inserir');

    $app->get('/{id}','DevolucaoVeiculoController:buscarPorId');
    $app->put('/{id}','DevolucaoVeiculoController:atualizar');
    $app->delete('/{id}', 'DevolucaoVeiculoController:deletar');

})->add('UsuarioController:validarToken');

$app->group('/locacoes', function() use ($app) {    

    $app->get("", 'LocacaoVeiculoController:listar');
    $app->post("", 'LocacaoVeiculoController:inserir');

    $app->get('/{id}','LocacaoVeiculoController:buscarPorId');
    $app->put('/{id}','LocacaoVeiculoController:atualizar');
    $app->delete('/{id}', 'LocacaoVeiculoController:deletar');

})->add('UsuarioController:validarToken');

$app->group('/reservas', function() use ($app) {    

    $app->get("", 'ReservaVeiculoController:listar');
    $app->post("", 'ReservaVeiculoController:inserir');

    $app->get('/{id}','ReservaVeiculoController:buscarPorId');
    $app->put('/{id}','ReservaVeiculoController:atualizar');
    $app->delete('/{id}', 'ReservaVeiculoController:deletar');

})->add('UsuarioController:validarToken');

$app->post("/usuarios", 'UsuarioController:inserir');
$app->post("/auth", 'UsuarioController:autenticar');


$app->run();
?>
