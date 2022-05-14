<?php

class productos extends Controlador{

    public function __construct(){
        parent::__construct();
        $this->viewsNames['productos'] = 'productos';
        $this->viewsNames['producto'] = 'producto';
    }

     private function renderView($vista,$data=null,$msg=null){
         //Funcion que se encarga de la renderizacion de todas las vistas
         if(isset($msg)){
             $this->vista->addMessage($msg);
         }
         if(isset($data)){
             $this->vista->addData($data);
         }
         $this->vista->render(constant('VISTA_CLIENTE').$this->viewsNames[$vista]);
    }
    public function home(){
        $this->productos();
    }

    public function productos(){
        if($this->loadLocalModel(constant('MODELOS')['productos'])){
            $result = $this->modelos[constant('MODELOS')['productos']]->seleccionarTodos(); 
            $result = array('productos'=>$result);
            $this->renderView('productos',$result);
        }
    }

    public function producto(){
        if(isset($_GET['p']) && Validaciones::validarCadena($_GET['p'],false,20)){
            if($this->loadLocalModel(constant('MODELOS')['productos'])){
               $result = $this->modelos[constant('MODELOS')['productos']]->seleccionarUno($_GET['p']); 
               if(!empty($result)){
                   $result['cantidad'] = 0;
                   if(isset($_SESSION['rol']) && "cliente" == $_SESSION['rol']){                       
                       $this->loadLocalModel(constant('MODELOS')['carrito']);
                       $cliente = $_SESSION['nickname'];
                       $producto = $result['nombre'];
                       $cantidad = $this->modelos[constant('MODELOS')['carrito']]->getCantidadProducto($cliente,$producto)['cantidad'];  
                       $result['cantidad'] =$cantidad;
                   }    
                    $this->renderView('producto',$result);
               }else{
                    $this->errorCode('404');
               }               
            }else{
                $this->errorCode('404');
            } 
        }else{
            $this->errorCode('404');
        }
    }

}

?>
