<?php

    class Compra  extends Controlador{

        function __construct(){
            
            $this->carrito = constant('MODELOS')['carrito'];
            $this->productos = constant('MODELOS')['productos'];
            $this->cliente = constant('MODELOS')['clientes'];
            $this->compra = constant('MODELOS')['compra'];
            $this->loadLocalModel($this->carrito);
            $this->loadLocalModel($this->productos);
            $this->loadLocalModel($this->cliente);
            $this->loadLocalModel($this->compra);
        }

        public function compra(){
            $cliente = $_SESSION['nickname'];
            $id_carrito = $this->modelos[$this->carrito]->getIdCarrito($cliente);            
            if(isset($id_carrito['id'])){
                $id_carrito = $id_carrito['id'];
                $this->modelos[$this->carrito]->bloquear($cliente);
                $productos = $this->modelos[$this->carrito]->getCarrito($cliente);
                if(!empty($productos)){//Se verifica que haya productos en el carrito
                    $precioTotal = 0;
                    $suficiente_stock = true;
                    foreach($productos as $producto_carrito){
                        //Se comprueba que haya suficiente stock de los productos
                        //asi como calcular el precio total de la compra

                        $producto_carrito_nombre = $producto_carrito['id_producto'];
                        $producto_carrito_cantidad = $producto_carrito['cantidad'];  
                        $producto = $this->modelos[$this->productos]->seleccionarUno($producto_carrito_nombre);
                        if($producto['cantidad'] >= $producto_carrito_cantidad){
                            $precioTotal += $producto['precio'] * $producto_carrito_cantidad;
                        }else{
                            $suficiente_stock = false;
                            echo "Stock insuficiente<br>";
                        }
                    }
                    $saldo_cliente = $this->modelos[$this->cliente]->verSaldo($cliente);
                    //Se asegura que el cliete posee suficiente saldo para la compra
                    if(!is_null($saldo_cliente) && $saldo_cliente>=$precioTotal){
                        //Se verifica que haya suficiente sotck de todos los productos
                        if($suficiente_stock){
                            if($this->modelos[$this->cliente]->reducirSaldo($cliente,$precioTotal)){
                                if($this->modelos[$this->compra]->compra($cliente,$productos)){
                                    foreach($productos as $producto_carrito){
                                        //Se reduce stock de cada producto  
                                        $producto = $this->modelos[$this->productos]->reducirStock($producto_carrito['id_producto'],$producto_carrito['cantidad']);
                                    }
                                    $this->modelos[$this->carrito]->eliminarCarrito($cliente);
                                    //header('Location:'.constant('URL').'/perfil');
                                }                                
                            }                            
                        }
                    }else{
                        echo "Saldo insuficiente<br>";
                    }
                }
            }
            header('Location:'.constant('URL').'/carrito');
        }
    }

?>
