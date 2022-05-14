<?php

    #Clase Padre de los modelos

    class Modelo{
        
        public $database;

        public function __construct(){
            $this->database = new DataBase();
        }

    }

?>
