<?php

    class App{

        function __construct(){
            /*if (session_status()==PHP_SESSION_NONE) {        
                session_start();
               // header('Location:'.constant('URL'));
                var_dump(session_status());
            }else{*/
            if(!empty($_GET['url'])){//Se pregunta si se indico alguna ruta
                $url = $_GET["url"];
                $url = rtrim($url,'/');
                $url = explode('/',$url);            
                $controladorArchivo  = $this->findController($url[0]);                
                if($controladorArchivo){//SE PREGUNTA SI EXISTE EL CONTROLADOR
                    require_once($controladorArchivo);
                    $controlador = new $url[0];
                    if(isset($url[1])){//Se compruba que se este solicitando un metodo
                       if(method_exists($controlador,$url[1])){ 
                            $controlador->{$url[1]}(); 
                        } else {
                            require_once("controladores/error.php");
                            new errno("No se pudo encontrar este metodo");    
                        }
                    }else{
                        if(method_exists($controlador,'home')){
                            $controlador->home();                            
                        }
                    }
                }else{
                    require_once("controladores/error.php");
                    new errno("No se encontro la seccion que buscas(Controlador)");
                }
            }else{
                include_once("controladores/login.php");
                $controlador = new Login(true);
            }
        /*}*/
        }


        private function findController($controller){
            if(!isset($_SESSION)){
                session_start();
            }            
            $path = "controladores/$controller.php";
            $found = (file_exists($path));
            if(!$found && isset($_SESSION['rol'])){
                $path = "controladores/".$_SESSION['rol']."/$controller.php";
                $found = file_exists($path);
            }
            
            return $found ? $path : "";
        }

    }


?>
