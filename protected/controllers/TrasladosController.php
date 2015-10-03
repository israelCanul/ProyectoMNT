<?php
class TrasladosController extends CController
{

    public function actionIndex(){
        print_r($_REQUEST);
        exit();
    }

    public function actionAgregar() {

        if (isset($_REQUEST["jnfe"])) {
            $_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
            $_vValidator = Venta::model()->findAllBySql($_sql);


            if ( !($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "")){
                $Venta = $_vValidator[0]->venta_id;
            } else {
                $_venta = new Venta;
                $_SESSION["config"]["token"] = Yii::app()->WebServices->getSecureKey(150);
                $_venta->venta_session_id = $_SESSION["config"]["token"];
                $_venta->venta_moneda = $_SESSION["config"]["currency"];
                $_venta->venta_site_id = ((Yii::app()->language == "es") ? 27 : 26);
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

                if ($p->descripcion_tipo_producto == 3) {
                    $p->delete();
                }
            }

            $data = explode("@@", Yii::app()->GenericFunctions->ShowVar($_REQUEST["jnfe"]));

            $Parameters = unserialize(Yii::app()->GenericFunctions->ShowVar($_REQUEST["pgR"]));
            foreach ($Parameters as $k => $v) {
                $Parameters[$k] = urldecode($v);
            }
            $optDestino = explode(":", $Parameters["transfer_to_id"]);
            if (sizeof($optDestino) == 2) {
                $_Destino = Yii::app()->db->createCommand()->select("*")->from('transportacion_zona')->where("zona_id = :id", array(
                    ":id" => $optDestino[1]
                ))->queryRow();
            }

            $optDeparture = explode(":", $Parameters["transfer_from_id"]);
            $optArrival = explode(":", $Parameters["transfer_to_id"]);

            $t = new VentaDescripcion;
            $t->descripcion_producto = Yii::t("global", "Transfer");
            $t->descripcion_destino = $_Destino["zona_destino"];

            //$cs = Yii::app()->getclientScript();
            //$cs->registerScriptFile(Yii::app()->params["baseUrl"] . '/js/suscripcion.js', CClientScript::POS_END);
            //$cs->registerScriptFile(Yii::app()->params["baseUrl"] . '/js/traslados.js?v=1', CClientScript::POS_END);

            $t->descripcion_tarifa = $data[6];
            $t->descripcion_thumb = $data[7];
            $t->descripcion_venta = $Venta;
            $t->descripcion_fecha = date("Y-m-d H:i:s");
            $t->descripcion_fecha1 = Yii::app()->GenericFunctions->convertUsableDates($Parameters["transfer_arrival"]);
            $t->descripcion_fecha2 = Yii::app()->GenericFunctions->convertUsableDates($Parameters["transfer_return"]);
            $t->descripcion_vuelo1 = Yii::app()->GenericFunctions->convertUsableDates($Parameters["transfer_arrival"]);
            $t->descripcion_vuelo2 = Yii::app()->GenericFunctions->convertUsableDates($Parameters["transfer_return"]);
            $t->descripcion_adultos = $Parameters["transfer_adults"];
            $t->descripcion_menores = $Parameters["transfer_child"];
            $t->descripcion_infantes = 0;
            $t->descripcion_cuartos = 1;
            $t->descripcion_precio = $data[3];
            $t->descripcion_total = (str_replace(",", "", $data[3]) * 1);
            $t->descripcion_hotel1 = Yii::app()->GenericFunctions->makeSinAcento($data[4]);
            $t->descripcion_hotel2 = Yii::app()->GenericFunctions->makeSinAcento($data[5]);
            $t->descripcion_tipo_producto = 3;
            $t->descripcion_tarifa_id = $data[0];
            $t->descripcion_producto_id = $data[1];
            $t->descripcion_servicio_ini = $optDeparture[1];
            $t->descripcion_servicio_id = $optArrival[0];
            $t->descripcion_reservable = 1;
            $t->descripcion_pagado = 0;
            $t->tipo_translado = $data[8];
            if($t->save()){

            }else{

            }

            $this->redirect(array(
                "/checkout/index"
            ));

        } else {
            $this->redirect("/traslados/index");
        }
    }

    public function actionBuscar(){
        print_r($_REQUEST);
    }


}
?>