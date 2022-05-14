<?php

    class home  extends Controlador{
    
        function __construct($__render=false){
            parent::__construct();
            //$this->loadModel("");
           /* if($__render){
                $this->ventana();
            }*/
        }

        public function home(){
            //funcion que renderiza la vista
            $this->vista->render("cliente/html/home");
        }

        public function productos(){

        }



    }

?>
