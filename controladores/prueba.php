<?php
class prueba extends Controlador{
    function __construct(){
        //$date = new DateTime('d-m-Y');
        $model =constant('MODELOS')['compra'];
        $this->loadLocalModel(constant('MODELOS')['compra']);
        /*echo $this->modelos[$model]->verSaldo('Cliente');
        $this->modelos[$model]->reducirSaldo('Cliente',100);
        echo $this->modelos[$model]->verSaldo('Cliente');*/
        $productos = array(
            array("id_producto"=>'Chetos',"cantidad"=>1)
        );
        $this->modelos[$model]->compra("Cliente",$productos);
    }
    function home(){

    }
}
?>
