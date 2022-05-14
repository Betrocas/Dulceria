<?php

class carritoModelo extends Modelo{

    public function __construct(){
        parent::__construct();
        $this->connection = $this->database->connect();
        $this->tablas['Carrito'] = "Carritos";
        $this->tablas['Productos'] = "Carritos_Productos";
    }
    
    //-------------------------FUNCIONES DE SELECCION------------------------
    public function  getIdCarrito($cliente){
       //Retorna el Id del carrito del Usuarios solicitado 
        $sql = "SELECT id from ".$this->tablas['Carrito']." WHERE id_cliente = '".$cliente."'";
        try{
            $result = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);           
        }catch(PDOException $e){
           echo $e->getMessage();
            $result = null;
        }
        return $result;
    }
    public function getCantidadProducto($Usuarios,$producto){
        //Retorna la cantidad de productos solicitados, en caso de no existir retorna -1
        $id_carrito = $this->getIdCarrito($Usuarios);
        if(!is_null($id_carrito)){
            $sql = "select cantidad from ".$this->tablas['Productos']." where id_carrito = ". $id_carrito['id']." AND id_producto='$producto'";
            try{
                $result = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC); 
            }catch(PDOException $e){
                $result = null;
                echo $e;
            }
            return $result;
        }
        return null;
    }
    public function getCarrito($cliente){
        //Retorna todos los productos de un carrito especifico
        $sql = "SELECT id_producto,cantidad FROM Carritos INNER JOIN Carritos_Productos ON Carritos.id =Carritos_Productos.id_carrito WHERE id_cliente = '$cliente'";
        try{
            $result = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC); 
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
            $result = null;
        }
        return $result;
    }
    //------------------------FUNCIONES DE CREACION/ADD----------------------
    private function addCarrito($cliente){
        //Crea una entrada a carrito
        //Se prevee que el cliente no sea un administrador
        if($this->getIdCarrito($cliente) == null){
            $sql = "insert into Carritos (id_cliente,bloqueado) values ('$cliente',0)";
            try{
                $result = $this->connection->exec($sql); 
            }catch(PDOException $e){
                $result = null;
            }
            return $result;
        }
    }
    public function addProducto($Usuarios,$producto,$cantidad){
        //Coloca la cantidad pasado por argumento como la nueva solicitada, no se suma 
        //En caso que la cantidad sea 0 y no existe el producto en el carrito
        //Se considera que se ha comprobado la existencia del producto
        $result = 0;
        $intent = 0;
        $id_carrito = $this->getIdCarrito($Usuarios);
        if(!$id_carrito)$this->addCarrito($Usuarios);
        $id_carrito = $this->getIdCarrito($Usuarios);
        if(isset($id_carrito['id'])){
            if($cantidad>=0){
                if($cantidad == 0){
                    $this->eliminarProducto($Usuarios,$producto);
                }else{
                    $existe = $this->getCantidadProducto($Usuarios,$producto);//Se comprueba que exista el producto ya en el carrito
                    if(is_null($existe['cantidad'])){
                        $sql = "INSERT INTO Carritos_Productos values (".$id_carrito['id'].",'$producto',$cantidad)"; 
                    }else{
                        $sql = "UPDATE Carritos_Productos SET cantidad = $cantidad WHERE id_carrito = ".$id_carrito['id']." AND id_producto = '$producto'";
                    }
                    try{
                        $result = $this->connection->exec($sql); 
                        echo $result;
                    }catch(PDOException $e){
                        $result = null;
                        echo $e;
                    }                
                }
            }
        }
        return $result;
    }
    public function bloquear($nombre){
       //Bloquea la capacidad de escritura al carrito
        // Setea la bandera a verdadero         
            $sql = "UPDATE Carrito SET bloqueado = 1 WHERE id_cliente = '$nombre'";
            try{
                $result = $this->connection->exec($sql); 
            }catch(PDOException $e){
                $result = null;
            }                
            return $result;
    }
    public function desbloquear($nombre){
        //Desbloque al carrito y permite que se tengan permisos de escritura
        //Setea la bandera a false
            $sql = "UPDATE Carrito SET bloqueado = 0 WHERE id_cliente = '$nombre'";
            try{
                $result = $this->connection->exec($sql); 
            }catch(PDOException $e){
                $result = null;
            }                
            return $result;
    }
    //-------------------------FUNCIONES DE ELIMINAR----------------------------    
    public  function eliminarProducto($Usuarios,$producto){
        $id_carrito = $this->getIdCarrito($Usuarios);
        $result = 0;
        if(isset($id_carrito['id'])){
            $sql = "DELETE FROM Carritos_Productos WHERE id_carrito =". $id_carrito['id']." and id_producto='$producto'";
            try{
                $result = $this->connection->exec($sql); 
            }catch(PDOException $e){
                echo $e;
                $result = null;
            }                
        }
        return $result;
    }
    public function eliminarCarrito($Usuarios){
            $sql = "DELETE FROM Carritos WHERE id_cliente='$Usuarios'";
            try{
                $result = $this->connection->exec($sql); 
            }catch(PDOException $e){
                $result = null;
                echo $e;
            }                
            return $result;
    }
    //--------------------------FUNCIONES DE EDICION---------------------------

}

?>
