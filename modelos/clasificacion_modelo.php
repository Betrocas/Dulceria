<?php

class clasificacionModelo extends Modelo{
    function __construct(){
        parent::__construct();
        $this->connection = $this->database->connect();
    }

    public function Registro($nombre){
       $sql = "INSERT INTO Clasificaciones(nombre) VALUES('$nombre')";
        try{
            $result = $this->connection->exec($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
       return 0;
    }
    public function selectAll(){
        $sql = "SELECT Id,nombre FROM Clasificaciones";
        try{
            $result = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return null;
    }
    public function delete($Id){
       $sql = "DELETE FROM Clasificaciones WHERE Id = '$Id'";
        try{
            $result = $this->connection->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function update($id,$nombre){
        $sql = "UPDATE Clasificaciones SET nombre = '$nombre' WHERE Id='$id' ";
        try{
            $result = $this->connection->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}

?>
