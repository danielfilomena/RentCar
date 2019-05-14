<?php

    class PDOFactory{

        protected $conexao;
        protected $user;
        protected $pass;

        protected $pdo;
                       
        public static function getConexao()        
        {
            
            try{
                
                    $conexao = 'pgsql:host=localhost;dbname=RentCar;';                                      				    
                    $user = 'postgres';
                    $pass = 'postgresql';

                    $pdo = new PDO($conexao, $user, $pass);                     

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES,false);
                    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            }
            catch(exception $e){

                die('Erro ao conectar no banco de dados.');

            }

            return $pdo;
        }        
    
    }
?>