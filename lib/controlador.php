<?php

    //Controlador Base
    class Controlador{
        

        public function __construct($checkSession=true){            
            $this->vista = new Vista();
            if($checkSession){
                if(!isset($_SESSION['nickname'])){
                    header(('Location:'.constant(('URL'))));
                }
            }
        }
        

        protected function loadLocalModel($model){
        //Intenta cargar un modelo al arreglo de modelos, en caso que sea posible o ya este cargado retorna true en caso 
        //contrario retorna false
        if(!isset($this->modelos[$model])){
             $modelo = $this->loadModel($model);                
             if(!is_null($modelo)){
                 $this->modelos[$model] = $modelo;
             }
             return !(is_null($modelo));
        }
        return true;
        }

        protected function loadModel($modelo){
            //Retorna una instancia del modelo solicitado en caso de existir
            $path = "modelos/$modelo"."_modelo.php";
            $modelo .= "Modelo";
            if(file_exists($path)){
                require_once($path);
                return  new $modelo;
            }
            return null;
        }

        public function errorCode($code=null){
            //Renderiza una vista con el codigo de error pasado por parametro
            //en caso no contar con error se mostrara la vista por defecto
            if(isset($code)){
                $folder = "error/";
                if(is_file('vistas/'.$folder.$code.'.php')){
                    $this->vista->render($folder.$code);
                }
            }
        }
    }
?>
