<?php
class ExtrasController extends CController
{
    public $pageDescription;
    public $pageKeywords;


    public function actionAgregar() {

        if(!in_array($_REQUEST["jnfe"], $_SESSION['datosKey']) || !in_array($_REQUEST["pgR"], $_SESSION['datosKeypgR']) ){
            header("Location: /error.html?error=Your session has Changed");
            exit();
       }

        if (isset($_REQUEST["jnfe"])) {

            $_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
            $_vValidator = Venta::model()->findAllBySql($_sql);

            //if ($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "") {
            if ( !($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "") && $_REQUEST['chekoutExtra'] == 1){
                $Venta = $_vValidator[0]->venta_id;

            } else {
                $_venta = new Venta;
                $_SESSION["config"]["token"] = Yii::app()->WebServices->getSecureKey(150);
                $_venta->venta_session_id = $_SESSION["config"]["token"];
                $_venta->venta_moneda = $_SESSION["config"]["currency"];
                $_venta->venta_site_id = ((Yii::app()->language == "es") ? 2 : 1);
                $_venta->venta_user_id = 0;
                $_venta->venta_estt = 1;
                $_venta->venta_total = 0;
                $_venta->venta_fecha = date("Y-m-d H:i:s");
                $_venta->venta_ip = Yii::app()->GenericFunctions->getRealIpAddr();

                $_venta->save();
                $Venta = $_venta->venta_id;

            }

            //Se eliminan los transfers y se agrega el nuevo

            $_Productos = VentaDescripcion::model()->findAll("descripcion_venta = :venta", array(
                ":venta" => $Venta
            ));

            foreach ($_Productos as $p) {
                if ($p->descripcion_tipo_producto == 4) {
                    $p->delete();
                }
            }

            $data = explode("@@", Yii::app()->GenericFunctions->ShowVar($_REQUEST["jnfe"]));

            $Parameters = unserialize(Yii::app()->GenericFunctions->ShowVar($_REQUEST["pgR"]));
            foreach ($Parameters as $k => $v) {
                $Parameters[$k] = urldecode($v);
            }

            $t = new VentaDescripcion;

            $t->descripcion_destino = 0;
            $t->descripcion_producto = $data[1];
            $t->descripcion_tarifa = $data[4];
            $t->descripcion_thumb = $data[3];

            $t->descripcion_venta = $Venta;
            $t->descripcion_fecha = date("Y-m-d H:i:s");
            $t->descripcion_fecha1 = Yii::app()->GenericFunctions->convertUsableDates($Parameters["extra_arrival"]);
            $t->descripcion_fecha2 = Yii::app()->GenericFunctions->convertUsableDates($Parameters["extra_return"]);

            $t->descripcion_adultos = $Parameters["extra_adults"];
            $t->descripcion_menores = $Parameters["extra_child"];
            $t->descripcion_infantes = 0;
            $t->descripcion_cuartos = 0;
            $t->descripcion_precio = $data[2];
            $t->descripcion_total = (str_replace(",", "", $data[2]) * 1);
            $t->descripcion_tipo_producto = 4;
            $t->descripcion_tarifa_id = $data[0];
            $t->descripcion_producto_id = $data[0];
            $t->descripcion_reservable = 1;
            $t->descripcion_pagado = 0;

            $t->save();


            $this->redirect(array(
                "/checkout/index"
            ));
        } else {
            $this->redirect("/traslados/index");
        }
    }


    public function actionAsistencia() {

        if(isset($_REQUEST["id"])){
            $id = Yii::app()->GenericFunctions->ShowVar($_REQUEST["id"]);

            $_vV = VentaDescripcion::model()->findByPk($id);
            $_Venta = Venta::model()->findByPk($_vV->descripcion_venta);

            $_Cliente = Cliente::model()->findByPk($_Venta->venta_user_id);

        }else{
            $this->redirect(array("extras/index"));
        }

        $this->renderPartial('ver',array("_vV"=>$_vV,"_Venta"=>$_Venta,"_Cliente"=>$_Cliente));

    }


}
