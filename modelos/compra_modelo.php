<?php

class compraModelo extends Modelo{

    function __construct(){
        parent::__construct();
        $this->connection = $this->database->connect();
    }

        //Funcion encargada de vaciar carrito de compra de ciertp cliente
        //1) Verificar que exista carro de compra a nombre del cliente  ->Carrito
        //2) Bloquear carro de compra en columna 'en_compra'            ->Carrito
        //  -> Obtener lista de productos en carrito
        //3) Comprobar stock de productos                               ->Productos
        //  -> Obtener costo total de compra
        //4) Validar que saldo de cliente sea suficiente                ->Cliente
        //5) Reducir stock de productos seleccionados                   ->Producto
        //6) Agregar datos en la tabla de compra                        ->Compra
        //7) Eliminar entrada de carrito                                ->Carrito

    function compra($nombre_cliente,$productos){
        var_dump($productos);
        $rest = false;
        if(isset($productos) && !empty($productos)){   
            //Se comprueba que haya productos listos
            if($this->crearCompra($nombre_cliente)==1){
                //Se intenta crear la compra
                $id_compra = $this->getIdUltimaCompra($nombre_cliente);
                if(!is_null($id_compra) && !empty($id_compra)){
                    $id_compra = $id_compra['id'];
                    foreach($productos as $producto) {
                        $p = $producto['id_producto'];
                        $cantidad = $producto['cantidad'];                         
                       $sql = "INSERT INTO Compras_Productos VALUES ($id_compra,'$p',$cantidad)"; 
                        try{
                            $result = $this->connection->exec($sql);
                        }catch(PDOException $e){
                            echo $e;
                            echo "Compra modelo<br>";
                        }
                    }
                    $rest = true;
                }else{
                    echo "<br>algo raro";
                    var_dump($id_compra);
                    echo "<br>";
                }
            }
        }else{
            echo "Lista de productos vacia<br>";
        }
        return $result;
    }
    private function addProducto($id_compra,$producto,$cantidad){
        if($cantidad > 0){
            $sql = "INSERT INTO Compra_Producto values ($id_compra,'$producto',$cantidad)" ;
            try{
                $result = $this->connection->exec($sql);
               return $result;
            }catch(PDOException $e){
                //echo $e->getMessage();
                return -1;
            }
        }else{
            return -1;
        }
    }

    private function crearCompra($cliente){
        $date = date('Y-m-d');
        echo $date;
        $sql = "INSERT INTO Compras (fecha,id_cliente) values('$date','$cliente')";
        try{
            $result = $this->connection->exec($sql);
            echo $result;
           return $result;
        }catch(PDOException $e){
            echo $e;
            return -1; 
        }
    }

    private function getIdUltimaCompra($cliente){
       $sql = "SELECT id FROM Compras WHERE id_cliente = '$cliente' ORDER BY fecha ASC LIMIT 1";
        try{
            $result = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
           return $result;
        }catch(PDOException $e){
            echo $e;
            return null;
        }
    }

    public function historialUsuario($cliente){
        #Retorna las entradas de las compras 
        $sql = "select id,fecha from Compras where id_cliente='$cliente'";
        try{
            $result = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e;
            return null;
        }
    }

    public function historialProducto($id,$usuario){
        $sql = "select producto,cantidad 
        from Compras_Productos
        inner join Compras
        on Compras.id = Compras_Productos.id_compra
        where Compras.id=$id and Compras.id_cliente='$usuario'";
        try{
            $result = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e;
            return null;
        }
    }

}
?>
