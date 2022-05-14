<?php

class logout extends Controlador{

    function __construct(){
        parent::__construct(false);        
        $this->logout();
    }

    private function logout(){
        if(isset($_SESSION)){
            session_destroy();
        }
        header('Location: '.constant('URL'));
    }



}

?>
