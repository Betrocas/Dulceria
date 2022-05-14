<?php

    #Clase Modelo encargada del acesso a la informacion de los usuarios, 
    #tanto adminstradores como de los clientes

    class usuariosModelo extends Modelo{

        function __construct(){
            parent::__construct();
            $this->connection = $this->database->connect();
        }

        public function Create($values){
            //$Values_Arr debe contener en un arreglo los
            //valores requeridos
            //  Id,nombre,apellidos,constrasena,admin(Bool)
            $id = $values[0];
            $nombre = $values[1];
            $apellido = $values[2];
            $contrasena = md5($values[3]);
            $sql = "INSERT INTO Usuarios  VALUES('$id','$nombre','$apellido','$contrasena',0)";
            try{
               return  $this->connection->exec($sql);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return -1;
        }
        

        public function DeleteClient($Id){
            $sql = "DELETE FROM Usuarios WHERE ID = '$Id'";
             try{
                $rows = $this->connection->exec($sql);
                return $rows;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return -1;
       }

        public function Read($values,$atributos="contrasena"){
            //atributos -> cadena de texto que contiene los atributos a solicitar
            $nick = $values[0];
            $sql = "SELECT $atributos  FROM Usuarios WHERE id = '$nick'";
            try{
                $results = $this->connection->query($sql);
                return $results;
            }catch(PDOException $e){
                echo $e->getMessage();
                return null;
            }
        }

        public function selectClients(){
            //Funcion orientada a administradores
            //Retorna un arreglo con todos los datos de los clientes 
            $sql = "SELECT id,nombre,apellido,admin FROM Usuarios WHERE admin='0'";
            try{
                $results = $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            }catch(PDOException $e){
                echo $e->getMessage();
                return null;
            }
        }

        public function Update(){
            
        }

    }

?>
