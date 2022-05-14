<?php

    class Errno extends Controlador{

        function __construct($message){
            parent::__construct();
            $this->vista->addMessage($message);
            $this->vista->render("error"); 
            //echo "<h1>Error: Page not Found</h1>";
        }

    }

?>
