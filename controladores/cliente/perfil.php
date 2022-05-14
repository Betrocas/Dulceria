<?php

    class perfil extends Controlador{

        public function __construct($__render=false){

            parent::__construct();
            if($__render){
                $this->home();
            }
        }

        public function home(){
            $this->vista->render("cliente/html/perfil");            
        }

    }

?>