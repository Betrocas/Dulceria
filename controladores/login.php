<?php

    class Login extends Controlador{


        function __construct($__render=false){
            $this->sessionStarted();
            parent::__construct(false);
            $this->modelo = $this->loadModel('usuarios');
            if($__render){
                $this->home();
            }
        }


        
        private function home($msg=null,$data=null){
            if(isset($msg)){
                $this->vista->addMessage($msg);
            }
            if(isset($data)){
                $this->vista->addData($data);
            }
            $this->vista->render("login");
        }       

        private function sessionStarted(){
            //Comprueba que no haya alguna session iniciada, en caso que si se redirige al home o la pag solicitada
            $this->startedSession();
            if(isset($_SESSION['nickname'])){
                header('Location: '.constant('URL').'/home');
            }
        } 

        public function login(){
            //Funcion encarga de recibir los datos del inicio de sesion
                //En caso de tener las licencias se debe detectar el rol del Usuarios y enviarlo a su home
            $nickName = $_POST['nickname'];
            $contrasena = $_POST['contrasena'];
            if(isset($nickName) && isset($contrasena)){
                if($this->validarFormatoCadena($nickName) && $this->validarFormatoCadena($contrasena)){
                    $values[0] = $nickName;
                    $result = $this->modelo->Read($values,'contrasena,admin')->fetch();
                    if(0==strcmp($result['contrasena'],md5($contrasena))){
                       $this->startSession($nickName,$result['admin']); 
                       echo $_SESSION['nickname'].' '.$_SESSION['rol'];
                       header('Location: '.constant('URL').'/home' );
                    }
                }
            }
            //Se le notifica al Usuarios que no se ha logrado inicar sesion
            $data['error'] = true;
            $this->home('No se ha logrado inicar sesion',$data);
        }        

        private function startSession($nick,$rol){
            $this->startedSession();
            $_SESSION['nickname'] = $nick;
            $admin = ($rol == 1) ? 'admin' : 'cliente';
            $_SESSION['rol'] = $admin;
        }

        private function startedSession(){
            if(!isset($_SESSION)){
                session_start();
            }
        }

        private function validarFormatoCadena($cad){
            return strlen($cad)>0;
        } 

    }

?>
