<?php

    include_once('./APP/Models/Usuario.php');
	include_once( './APP/PDO/PDOFactory.php');

    class UsuarioDAO
    {
                
        public function inserir(Usuario $usuario)
        {
            $qInserir = "INSERT INTO usuario(usuarionome, usuariologin, usuariosenha) VALUES(:nome, :login, :senha)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(':nome', $usuario->nome);
            $comando->bindParam(':login', $usuario->login);
            $comando->bindParam(':senha', $usuario->senha);
            $comando->execute();
            $usuario->id = $pdo->lastInsertId();
            return $usuario;
        }
        
        public function deletar($id)
        {
            $qDeletar = "DELETE from usuario WHERE usuarioid=:id";
            $usuario = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $usuario;
        }

        public function atualizar(Usuario $usuario)
        {
            $qAtualizar = "UPDATE usuario SET usuarionome=:nome, usuariologin=:login, usuariosenha=:senha WHERE usuarioid=:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$usuario->nome);
            $comando->bindParam(":login",$usuario->login);
            $comando->bindParam(":senha",$usuario->senha);
            $comando->bindParam(":id",$usuario->id);
            $comando->execute();
            return $usuario;        
        }
        
        public function buscarTodosUsuarios()
        {
		    $query = "SELECT * FROM usuario";
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $usuario=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $usuario[] = new Usuario($row->usuarioid,$row->usuarionome,$row->usuariologin,$row->usuariosenha);
            }
            return $usuario;
        }

        public function buscarPorId($id)
        {
 		    $query = "SELECT * FROM usuario WHERE usuarioid=:id";		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (":id", $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Usuario($result->usuarioid, $result->usuarionome, $result->usuariologin, $result->usuariosenha);           
        }

        public function buscarPorLogin($login)
        {
 		    $query = 'SELECT * FROM usuario WHERE usuariologin=:login';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('login', $login);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Usuario($result->usuarioid,$result->usuarionome,$result->usuariologin,$result->usuariosenha);           
        }

    }

?>