<?php

class ventas extends Controlador{

    function __construct($__render=false){
        parent::__construct();
        if($__render) {
            $this->home();
        }
    }

     function home(){
        $this->vista->render(constant('VISTA_ADMIN').'ventas');
    }
}

?>
