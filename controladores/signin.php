<?php

    class signin extends Controlador{

        function __construct($__render=false){
            parent::__construct(false);
            if($__render){
                $this->home();
            }
        }

        public function home(){
            $this->vista->render("signin");
        }

        public function registrarUsuarios(){
            //Se recoge la informacion recibida desde el formulario
            if($_POST['Id']!=null && $_POST['Nombre']!=null && $_POST['Apellido']!=null &&$_POST['Password']!=null){
                $modelo = constant('MODELOS')['usuarios'];
                if($this->loadLocalModel($modelo)){
                    $values[0] = $_POST['Id']; 
                    $values[1] = $_POST['Nombre'];
                    $values[2] = $_POST['Apellido'];
                    $values[3] = $_POST['Password'];
                    $this->modelos[$modelo]->Create($values);
                    $this->loadLocalModel(constant('MODELOS')['clientes']);
                    $this->modelos[constant('MODELOS')['clientes']]->Registro($values[0]);
                    header('Location: '.constant('URL'));
                    return ;
                }
            }

        }

    }


?>
