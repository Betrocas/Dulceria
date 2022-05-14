<?php

    class home extends Controlador{

        function __construct($__render=false){
            parent::__construct();
            if($__render){
                $this->home();
            }
        }

        public function home(){
            $this->vista->render(constant('VISTA_ADMIN').'home');
        }

    }

?>