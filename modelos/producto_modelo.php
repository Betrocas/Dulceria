<?php

class productoModelo extends Modelo{

    //Condiciones
    private $long_name = 20;

    function __construct(){
        parent::__construct();
        $this->connection = $this->database->connect();
    }
    //--------------------------FUNCIONES DE REGISTRO NUEVO-------------------------------------------------

    public function registro($nombre,$precio,$clasificacion){
        $sql = "INSERT INTO Productos VALUES('$nombre','$precio',0,$clasificacion)";
        try{
            $result = $this->connection->exec($sql);
           return $result;
        }catch(PDOException $e){
            //echo $e->getMessage();
            return -1;
        }
    }
    //--------------------------FUNCTIONES DE SELECCION-------------------------------------------------
    public function seleccionarUno($nombre){
        $sql = "Select * from Productos WHERE nombre='$nombre'";
        try{
            $result = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
            if($result != false){
                $sql_clasificacion = "Select nombre as clasificacion_nombre from Clasificaciones where id='".$result['clasificacion']."'";
                $clasificacion_nombre = $this->connection->query($sql_clasificacion)->fetch(PDO::FETCH_ASSOC);
               return $result + $clasificacion_nombre;
            }            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return null;
    }
    public function seleccionarTodos(){
        $sql = "SELECT nombre,precio,cantidad,clasificacion from Productos";
        try{
            $result = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
           return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return null;
    }
    public function seleccionarCantidad($nombre){
        $sql = "SELECT cantidad from Productos WHERE nombre='$nombre'";
        try{
            $result = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);            
           return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return null;
    }
    //--------------------------FUNCTIONES DE ELIMINACION-------------------------------------------------
    public function eliminarProducto($nombre){
        //Borra de forma permanente un producto
        $sql = "DELETE FROM Productos WHERE nombre = '$nombre'";
        try{
            $result = $this->connection->exec($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return -1;
        }
    }
    //--------------------------FUNCTIONES DE EDICION-------------------------------------------------
    //Si se quiere cambiar el nombre del producto se debe eliminar primero el producto
    public function editarPrecio($nombre,$precio){
        $sql = "UPDATE Productos SET precio = $precio WHERE nombre='$nombre'";
        try{
            $result = $this->connection->exec($sql);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function editarClasificacion($nombre,$clasificacion){
        //Cambia la clasificacion de un producto
        $sql = "UPDATE Productos SET clasificacion = $clasificacion WHERE nombre='$nombre'";
        try{
            $result = $this->connection->exec($sql);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function editarCantidad($nombre,$cantidad){
        $sql = "UPDATE Productos SET cantidad=$cantidad WHERE nombre='$nombre'";
        try{
            $result = $this->connection->exec($sql);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function addStock($nombre,$cantidad){
        $sql = "UPDATE Productos SET cantidad=$cantidad WHERE nombre=$nombre";
        try{
            $result = $this->connection->exec($sql);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function reducirStock($nombre,$cantidad){
        $cantidad_producto = $this->seleccionarCantidad($nombre);
        if($cantidad_producto != null){
            $cantidad_producto = $cantidad_producto['cantidad'];
            if($cantidad_producto >= $cantidad){
                $cantidad_producto -= $cantidad;
                $sql = "UPDATE Productos SET cantidad=$cantidad_producto WHERE nombre = '$nombre'";
                try{    
                    $result = $this->connection->exec($sql);
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }
    }
}


?>
