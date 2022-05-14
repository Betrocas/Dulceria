<?php

class clasificacion extends Controlador{
    function __construct(){
        parent::__construct();
       $this->loadModel('clasificacion'); 
    } 

    public function home($msg=null){
        if(isset($_POST['nombreClasificacion'])){
           $result =  $this->modelo->Registro($_POST['nombreClasificacion']);
           $msg = "Esta clasificion ya existe";
           if($result > 0){
              $msg = "Guardada con exito"; 
           } 
           $this->vista->addMessage($msg);
        }
        $this->vista->render(constant('VISTA_ADMIN').'nuevaClasificacion');
    }

}


?>
