<?php
//Clase con funciones estaticas de utilidades 
class Validaciones {

    public static function validarCadena($cad,$num=false,$long=50){
        //Valida que cadena solo contenga caracteres del alfabeto
        $band = false;
        if(isset($cad) && is_string($cad)){
            if($long >= strlen($cad)){
                if(!$num){
                    $band =  ctype_alpha($cad);
                }else{
                    $band = true;
                }
            }
        }
        return $band;
    } 

    public static function validarVariables(){
        //Verifica
    }

    public static function validarNumero(){
        
    }
}

?>
