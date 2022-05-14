<?php

class clienteModelo extends Modelo{
    //Clase que administra el saldo de los Usuarioss con rol de cliente
    function __construct(){
        parent::__construct();
        $this->connection = $this->database->connect();
    }


    public function Registro($nombre){
        //Todo cliente debe de iniciar con un saldo neto de 0
       $sql = "INSERT INTO Clientes VALUES(100,'$nombre')";
        try{
            $result = $this->connection->exec($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
       return 0;
    }

    public function verSaldo($id){        
        //Solo debe retornar un unico valor
        $sql = "SELECT saldo FROM Clientes WHERE usuario = '$id'";
        try{
            $result = $this->connection->query($sql)->fetch(PDO::FETCH_ASSOC);
            $result = isset($result['saldo']) ? $result['saldo']  : -1;
        }catch(PDOException $e){
            echo $e->getMessage();
            $result = null;
        }
        return $result;
    }

    public function reducirSaldo($cliente,$cantidad){
        $saldo = $this->verSaldo($cliente);
        if($cantidad >= 0 && $saldo-$cantidad>=0){
            $saldo -= $cantidad;
            $sql = "UPDATE Clientes SET saldo = $saldo where usuario = '$cliente'";
            try{
                $result = $this->connection->exec($sql);
                $band = true;
            }catch(PDOException $e){
                echo $e->getMessage();
                $band = null;
            }
        }else{
            $band = false;
        }
        return $band;
    }

    public function editarSaldo($saldo,$Id_Usuarios){
        $sql = "UPDATE Clientes SET saldo = $saldo WHERE usuario = $Id_Usuarios";
        try{
            $result = $this->connection->exec($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function eliminarCliente(){        
        //Aun no se esta seguro de realmente programar este metodo, pues puede
        //ser remplazado por la instruccion DELETE ON CASCADE

    }
}

?>
