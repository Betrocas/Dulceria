<?php

class productos extends Controlador{
    //Permitira:
    //      Agregar, eliminar, editar y ver cada uno de los productos

    private $folder_views = 'productos/';
    

    function __construct($__render=false){
        parent::__construct();
         $this->viewsNames["home"]='productos';
         $this->viewsNames['verProductos']='productos';
         $this->viewsNames['verProducto'] = 'producto';
         $this->viewsNames['agregarProducto'] = 'nuevoProducto' ;
         $this->viewsNames['editar']='editar';
         $this->loadLocalModel(constant('MODELOS')['productos']);
        if($__render) {            
            $this->home();
        }
    }

    public function home(){
        $this->productos();
    }


     private function renderView($vista='home',$data=null,$msg=null){
         //Funcion que se encarga de la renderizacion de todas las vistas
         if(isset($msg)){
             $this->vista->addMessage($msg);
         }
         if(isset($data)){
             $this->vista->addData($data);
         }
        $this->vista->render(constant('VISTA_ADMIN').$this->folder_views.$this->viewsNames[$vista]);
    }

    //-------------------------------FUNCIONES DE MODELO---------------------

    public function productos(){        
        //Muestra todos los productos 
        if($this->loadLocalModel(constant('MODELOS')['productos'])){
            $result = $this->modelos[constant('MODELOS')['productos']]->seleccionarTodos(); 
            $result = array('productos'=>$result);
            $this->renderView('verProductos',$result);
        }
    }    
    public function producto(){
        if(isset($_GET['p']) && Validaciones::validarCadena($_GET['p'],false,20)){
            if($this->loadLocalModel(constant('MODELOS')['productos'])){
               $result = $this->modelos[constant('MODELOS')['productos']]->seleccionarUno($_GET['p']); 
               if(!empty($result)){
                    $this->renderView('verProducto',$result);
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

    public function registro(){
        //Se comprueba si solo se quiere la vista o si se prosesaran datos
        if(!empty($_POST)){
            $nombre = $_POST['nombreProducto'];
            $precio = $_POST['precioProducto'];
            $clasificacion = isset($_POST['clasificacionProducto']) ? $_POST['clasificacionProducto'] : -1;
            $result = -1;
            if(Validaciones::validarCadena($nombre)) {
                if(ctype_digit($clasificacion) && ctype_digit($precio)){
                    $clasificacion = intval($clasificacion);
                    $precio = intval($precio);
                    if($precio > 0 && $clasificacion>=0){
                        if($this->loadLocalModel('producto')){
                            $result = $this->modelos['producto']->registro($nombre,$precio,$clasificacion);
                        }
                    }
                } 
            }
        }
        if($this->loadLocalModel('clasificacion')){
            $msg = "";
            if(isset($result)){
                if($result>0){
                    $msg = "Se ha guardado con exito";
                }else{
                    $msg = "No se ha podido guardar con exito";
                }                    
            }
            $data = $this->modelos['clasificacion']->selectAll();
            $this->renderView('agregarProducto',$data,$msg);
        }else{
            echo "No se pudo cargar el modelo";
        } 
    }

    public function eliminar(){        
        $direccion = '/home';
        if(isset($_POST['p'])){
            $nombre_producto = $_POST['p'];
            if(Validaciones::validarCadena($nombre_producto)){
                if($this->loadLocalModel(constant('MODELOS')['productos'])){
                    $this->modelos[constant('MODELOS')['productos']]->eliminarProducto($nombre_producto);
                } 
            }
            $direccion = '/productos/productos';
        }
        header('Location: '.constant('URL').$direccion);
    }
    public function editar(){
        $view = false;//Bandera que indica si es que los datos ingresados pueden ser procesados
                        //en caso que no se retorna un error 404        
        if($_POST){            
            if($_POST['nombreProducto'] != null && $_POST['precioProducto']!=null && $_POST['cantidadProducto'] !=null && $_POST['clasificacionProducto']!=null){
                $nombre = $_POST['nombreProducto'];
                $precio = $_POST['precioProducto'];
                $cantidad = $_POST['cantidadProducto'];
                $clasificacion = $_POST['clasificacionProducto'];
                if(Validaciones::validarCadena($nombre,false,20)){
                    if(is_numeric($precio) && is_numeric($cantidad) && is_numeric($clasificacion)){
                        $producto_modelo = constant('MODELOS')['productos'];
                        if($this->loadLocalModel($producto_modelo)){
                            $producto = $this->modelos[$producto_modelo]->seleccionarUno($nombre);
                            if($producto != false){
                                if($producto['precio'] != $precio){
                                    $this->modelos[$producto_modelo]->editarPrecio($nombre,$precio);
                                }
                                if($producto['clasificacion'] != $clasificacion){
                                    $this->modelos[$producto_modelo]->editarClasificacion($nombre,$clasificacion);
                                }
                                if($producto['cantidad'] != $cantidad){
                                    $this->modelos[$producto_modelo]->editarCantidad($nombre,$cantidad);
                                }
                                $view = true;
                            }
                        }
                    }
                }
            }
        }

        if(isset($_GET['p'])){
            $producto_nombre = $_GET['p'];
            if(Validaciones::validarCadena($producto_nombre)){
                if($this->loadLocalModel(constant('MODELOS')['productos']) && $this->loadLocalModel(constant('MODELOS')['clasificaciones'])){
                    $producto = $this->modelos[constant('MODELOS')['productos']]->seleccionarUno($producto_nombre);
                    if(!is_null($producto)){
                        $clasificaciones = $this->modelos[constant('MODELOS')['clasificaciones']]->selectAll();
                        $data['producto'] = $producto;                    
                        $data['clasificaciones'] = $clasificaciones;
                        $view = true;
                    }
                }
            }
        }
        if(!$view){
            $this->errorCode(404);
        }else{
            $this->renderView('editar',$data);
        }
    }
}

?>
