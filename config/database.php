<?php

    class DataBase{

        private $host;
        private $db;
        private $user;
        private $password;
        private $connection;

        public function __construct(){
            $this->host = constant("HOST");
            $this->db = constant("DB");
            $this->Usuarios = constant("Usuarios");
            $this->password = constant("PASSWORD");
        }

        public function connect(){
            try {
                $this->connection = new PDO("mysql:host=$this->host;dbname=$this->db",$this->Usuarios,$this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Conexcion establecida";
                return $this->connection;
            } catch (PDOException $error) {
                echo "Error en la conexcion con la base de datos: $error";
                return null;
            }
        }

        public function disconnect(){

            if(!(is_null($this->connection))){
                echo "Cerrando conexcion con la base de datos";
                $this->connection = null;
            }

        }        

    }

?>
