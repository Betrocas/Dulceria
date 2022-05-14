<?php

    class historial  extends Controlador{
    
        function __construct(){
            parent::__construct();
        }

        public function home(){
            $this->historial();
        }

        private function renderView($vista,$data=null,$msg=null){
         //Funcion que se encarga de la renderizacion de todas las vistas
         if(isset($msg)){
             $this->vista->addMessage($msg);
         }
         if(isset($data)){
             $this->vista->addData($data);
         }
        $this->vista->render(constant('VISTA_CLIENTE').$vista);
        }

        public function historial(){
            $model=$this->loadModel(constant('MODELOS')['compra']);
            $cliente = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : "" ;
            if(!is_null($model) && !empty($cliente)){
                $data = $model->historialUsuario($cliente);
                $data = array("compras"=>$data);
                $this->renderView('historial',$data);
            }
        }
        public function compra(){
           #devulve los productos comprados en x compra
            $model=$this->loadModel(constant('MODELOS')['compra']);
            $cliente = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : "" ;
            $id = isset($_GET['id'])?$_GET['id']:0;
            if(!is_null($model) && !empty($cliente) && $id>0){
                $data = $model->historialProducto($id,$cliente);
                $data = array("productos"=>$data);
                $this->renderView('historial_compra',$data);
            }
        }

    }

?>