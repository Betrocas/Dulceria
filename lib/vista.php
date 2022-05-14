<?php

    class Vista{

        private $message;
        private $data;//Debe trabajarse como un arreglo asociativo

        function __construct(){

        }
        

        function render($render){          
            //Reasignacion de variables tal que sean accesibles desde la vista
            $message = $this->message;
            $data = $this->data;
            $this->addHeader();  
            $vistas_url = "vistas/$render.php";            
            if(file_exists($vistas_url)){
                if(!isset($_SESSION)){
                    session_start();
                }
                if(isset($_SESSION['rol'])){
                    $this->addMenu();
                }
                include_once($vistas_url);
            }else{                
                $this->addMessage("Vista no encontrada");
                $message = $this->message;
                include_once("vistas/error.php");
            }
            $this->addFooter();
        }

        private function addHeader(){
            //Agrega header a las vistas por lo que estas no deben importar archivos externos
            require_once("vistas/header.php");
        }

        private function addMenu(){
            //Agrega Menu dependiendo de la session del Usuarios por lo que no se debe pasar por parametro
            $rol = $_SESSION['rol'];
            include_once("vistas/$rol/html/menu.php");
        }

        private function addFooter(){
            include_once("vistas/footer.php");
        }

        public function addData($data){
            //Variable donde se almacenan los datos que la vista posiblemente necesite
            $this->data = $data;
        }

        public function addMessage($msg){
            $this->message = $msg;
        }

    }

?>
