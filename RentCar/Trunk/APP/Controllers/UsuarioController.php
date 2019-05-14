<?php
       
    use \Firebase\JWT\JWT;

    include_once './APP/Models/Usuario.php';
    include_once './APP/PDO/UsuarioDAO.php';

    class UsuarioController{

        private $secretKey = "R3ntC@r";

        public function atualizar($request, $response, $args) 
        {

            $id = $args['id'];
            $var = $request->getParsedBody();
            $usuario = new Usuario($id, $var['nome'], $var['login'], $var['senha']);
        
            $dao = new UsuarioDAO;
            $usuario = $dao->atualizar($usuario);
        
            return $response->withJson($usuario);    

        }

        public function deletar($request, $response, $args)
        {

            $id = $args['id'];

            $dao = new UsuarioDAO();
            $usuario = $dao->deletar($id);

            return $response->withJson($usuario);

        }

        public function buscarPorId($request, $response, $args)
        {
            $id = $args['id'];

            $dao = new UsuarioDAO();
            $usuario = $dao->buscarPorId($id);

            return $response->withJson($usuario);

        }
        
        public function listar($request, $response, $args)        
        {

            $dao = new UsuarioDAO();
            $usuario = $dao->buscarTodosUsuarios();

            return $response->withJson($usuario);

        }
        
        public function inserir($request, $response, $args)
        {
            $var = $request->getParsedBody();
            $usuario = new Usuario(0, $var["nome"], $var["login"], $var["senha"]);
        
            $dao = new UsuarioDAO;    
            $usuario = $dao->inserir($usuario);
        
            return $response->withJson($usuario, 201);
        }
        
        public function autenticar($request, $response, $args)
        {
            $user = $request->getParsedBody();
            
            $dao= new UsuarioDAO;    
            $usuario = $dao->buscarPorLogin($user['login']);
            if($usuario->senha == $user['senha'])
            {
                $token = array(
                    'user' => strval($usuario->id),
                    'nome' => $usuario->nome
                );
                $jwt = JWT::encode($token, $this->secretKey);
                return $response->withJson(["token" => $jwt], 201)
                    ->withHeader('Content-type', 'application/json');   
            }
            else
                return $response->withStatus(401);
        }

        public function validarToken($request, $response, $next)
        {
            $token = $request->getHeader('Authorization')[0];
            
            if($token)
            {
                try {
                    $decoded = JWT::decode($token, $this->secretKey, array('HS256'));

                    if($decoded)
                        return($next($request, $response));
                } catch(Exception $error) {

                    return $response->withStatus(401);
                }
            }
            
            return $response->withStatus(401);
        }

    }

?>