<?php

class usuarios extends Controlador{

    function __construct($__render=false){
        parent::__construct();
        if($__render) {
            $this->home();
        }
            
    }

     function home(){
        $this->loadUsers();
        $this->vista->render(constant('VISTA_ADMIN').'clientes');
    }

    private function loadUsers(){
       //Funcion encargada de cargar la informacion de los Usuarioss a la vista 
        if($this->loadLocalModel(constant('MODELOS')['usuarios'])){
             $result = $this->modelos[constant('MODELOS')['usuarios']]->selectClients();
             $this->vista->addData(array('users'=>$result));
        }
    }

    public function delete(){
        //Borra unicamente clientes
        if(isset($_POST['Id'])){
            if($this->loadLocalModel(constant('MODELOS')['usuarios'])){
                $this->modelos[constant('MODELOS')['usuarios']]->DeleteClient($_POST['Id']);
                header('Location: '.constant('URL').'/Usuarios');
            }
        }
    }
}

?>
