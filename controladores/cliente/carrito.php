<?php

    class carrito extends Controlador{

        public function __construct($__render=false){
            parent::__construct();
            if($__render){

            }
            $this->carritoModelo = constant('MODELOS')['carrito'];
            $this->productosModelo = constant('MODELOS')['productos'];
            $this->clientesModelo = constant('MODELOS')['usuarios'];
            $this->loadLocalModel($this->carritoModelo);
            $this->loadLocalModel($this->productosModelo);
            $this->loadLocalModel($this->clientesModelo);
        }

        public function home(){
            $this->carrito();
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
       
        public function carrito(){            
            if($this->loadLocalModel($this->carritoModelo)){
                $cliente = $_SESSION['nickname'];
                if(isset($cliente)){
                    $productos = $this->modelos[$this->carritoModelo]->getCarrito($cliente);
                    $data = array('productos' => $productos);
                    $this->renderView('carrito',$data);
                }
            }
        } 
        
        public function agregar(){
            $band = false;
            if(isset($_POST['p']) && isset($_POST['cantidad'])){
                $nombre_producto = $_POST['p'];
                $cantidad = $_POST['cantidad'];
                $cliente = $_SESSION['nickname'];
                if(Validaciones::validarCadena($nombre_producto) && Validaciones::validarCadena($cliente)){
                    $rol = $_SESSION['rol'];
                    if($rol == "cliente"){
                        if($this->modelos[$this->productosModelo]->seleccionarUno($nombre_producto)) {
                            $this->modelos[$this->carritoModelo]->addProducto($cliente,$nombre_producto,$cantidad);
                            $band = true;
                           header("Location:".constant('URL')."/productos/producto/?p=$nombre_producto");
                        }
                    }
                }
            }
            if(!$band){
                header("Location:".constant('URL')."/productos");
            }
        }

        public function eliminar(){
            //Elimina producto del carrito            
            if(isset($_POST['p'])){
                $cliente = $_SESSION['nickname'];
                $nombre_producto =  $_POST['p'];
                echo "Validando ". $nombre_producto;
                if(Validaciones::validarCadena($nombre_producto)){
                    echo "eliminado";
                    $this->modelos[$this->carritoModelo]->eliminarProducto($cliente,$nombre_producto);                
                }
            }
            header("Location: ".constant('URL')."/carrito");
        }
        

    }

?>
