<?php
    /*TODO: Inicializando la sesion del usuario */
    session_start();

    /*TODO: Iniciamos Clase Conectar */
    class Conectar{
        protected $dbh;

        /*TODO: Funcion Protegida de la cadena de Conexion */
        protected function Conexion(){
            try {
        		$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=bd_proyecto","root","");
        		return $conectar;
			} catch (Exception $e) {
        		print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();
			}
        }

        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        }

        public static function ruta(){
            //QA
            return "http://localhost/Practica_Proyecto/";
            
        }

    }
?>