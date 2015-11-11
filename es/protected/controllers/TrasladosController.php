<?php
class TrasladosController extends CController
{

    public function actionIndex(){
        print_r($_REQUEST);
        exit();
    }

    public function actionAgregar() {

        if (isset($_REQUEST["jnfe"])) {

            $_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config_es"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
            $_vValidator = Venta::model()->findAllBySql($_sql);

            if (!($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "")) {
                $Venta = $_vValidator[0]->venta_id;
            } else {
                $_venta = new Venta;
                $_SESSION["config_es"]["token"] = Yii::app()->WebServices->getSecureKey(150);
                $_venta->venta_session_id = $_SESSION["config_es"]["token"];
                $_venta->venta_moneda = $_SESSION["config_es"]["currency"];
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
                if ($p->descripcion_tipo_producto == 4 ) {
                    //print_r("extra");
                    $p->delete();
                }
            }
            
            
            if(!isset($_REQUEST['oftransfer'])){
                //$cs = Yii::app()->getclientScript();
                //$cs->registerScriptFile(Yii::app()->params["baseUrl"] . '/js/suscripcion.js', CClientScript::POS_END);
                //$cs->registerScriptFile(Yii::app()->params["baseUrl"] . '/js/traslados.js?v=1', CClientScript::POS_END);

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
                $t->descripcion_producto = Yii::t("global", "Translado");
                $t->descripcion_destino = $_Destino["zona_destino"];
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
                if ($t->save()) {

                } else {

                }
            }else{
                $parametros=unserialize(GenericFunctions::ShowVar($_REQUEST["jnfe"]));
                $t = new VentaDescripcion;
                $t->descripcion_producto = Yii::t("global", "Translado");
                $t->descripcion_destino = $parametros['descripcion_servicio_id'];
                $t->descripcion_tarifa = $parametros['descripcion_tarifa'];
                $t->descripcion_thumb = $parametros['tdescripcion_thumb'];
                $t->descripcion_venta = $Venta;
                $t->descripcion_fecha = date("Y-m-d H:i:s");
                $t->descripcion_fecha1 = $parametros['descripcion_fecha1'];
                $t->descripcion_fecha2 = $parametros["descripcion_fecha2"];
                $t->descripcion_vuelo1 = $parametros['descripcion_fecha1'];
                $t->descripcion_vuelo2 = $parametros["descripcion_fecha2"];
                $t->descripcion_adultos = $parametros["descripcion_adultos"];
                $t->descripcion_menores = $parametros["descripcion_menores"];
                $t->descripcion_infantes = 0;
                $t->descripcion_cuartos = 1;
                $t->descripcion_precio = $parametros['descripcion_total'];
                $t->descripcion_total = $parametros['descripcion_total'];
                $t->descripcion_hotel1 = $parametros['descripcion_hotel1'];
                $t->descripcion_hotel2 = $parametros['descripcion_hotel2'];
                $t->descripcion_tipo_producto = 3;
                $t->descripcion_tarifa_id = $parametros['descripcion_tarifa_id'];
                $t->descripcion_producto_id = $parametros['descripcion_producto_id'];
                $t->descripcion_servicio_ini = $parametros['descripcion_servicio_ini'];
                $t->descripcion_servicio_id = $parametros['descripcion_servicio_id'];
                $t->descripcion_reservable = 1;
                $t->descripcion_pagado = 0;
                $t->tipo_translado = $parametros['tipo_translado'];
                if ($t->save()) {

                } else {

                }
            }

            $this->redirect(array(
                "/checkout/index"
            ));

        } else {
            $this->redirect("/es");
        }
    }

    public function actionBuscar()
    {
        $this->redirect($this->createUrl("traslados/detalle",$_REQUEST));
    }
    public function actionDetalle(){

        $date1=explode("/",$_REQUEST['date1']);
        $date1=$date1[2]."-".$date1[0]."-".$date1[1];
        $date2=explode("/",$_REQUEST['date2']);
        $date2=$date2[2]."-".$date2[0]."-".$date2[1];
        $fecha1=date('D, F d Y', strtotime($_REQUEST["date1"]));// textos para fecha 1
        $fecha2=date('D, F d Y', strtotime($_REQUEST["date2"]));// textos para fecha 2
        $textoFecha=$fecha1;
        if(intval($_REQUEST["transfer_option_type"]) == 1 || intval($_REQUEST["transfer_option_type"]) == 5){
            $textoFecha=$fecha1.", ".$fecha2;
        }

        switch(intval($_REQUEST['transfer_option_type'])){
            case 1:
                $transfers=file_get_contents(Yii::app()->params['api']."/RestTransfers/rates.html?moneda=USD&lan=en&adults=".$_REQUEST['transfer_adult']."&ninos=".$_REQUEST['transfer_child']."&dest_ini=".$_REQUEST['dest_from']."&dest_end=".$_REQUEST['dest_end']."&round_trip=".$_REQUEST['round_trip']."&transfer_option_type=".$_REQUEST['transfer_option_type']."&date=".$date1."&date2=".$date2."");
                break;
            case 2:
                $transfers=file_get_contents(Yii::app()->params['api']."/RestTransfers/rates.html?moneda=USD&lan=en&adults=".$_REQUEST['transfer_adult']."&ninos=".$_REQUEST['transfer_child']."&dest_ini=".$_REQUEST['dest_from']."&dest_end=".$_REQUEST['dest_end']."&round_trip=".$_REQUEST['round_trip']."&transfer_option_type=".$_REQUEST['transfer_option_type']."&date=".$date1."&date2=".$date2."");
                break;
            case 3:
                $transfers=file_get_contents(Yii::app()->params['api']."/RestTransfers/rates.html?moneda=USD&lan=en&adults=".$_REQUEST['transfer_adult']."&ninos=".$_REQUEST['transfer_child']."&dest_ini=".$_REQUEST['dest_end']."&dest_end=".$_REQUEST['dest_from']."&round_trip=".$_REQUEST['round_trip']."&transfer_option_type=".$_REQUEST['transfer_option_type']."&date=".$date1."&date2=".$date2."");
                break;
            case 4:
                $transfers=file_get_contents(Yii::app()->params['api']."/RestTransfers/rates.html?moneda=USD&lan=en&adults=".$_REQUEST['transfer_adult']."&ninos=".$_REQUEST['transfer_child']."&dest_ini=".$_REQUEST['dest_from']."&dest_end=".$_REQUEST['dest_end']."&round_trip=".$_REQUEST['round_trip']."&transfer_option_type=".$_REQUEST['transfer_option_type']."&date=".$date1."&date2=".$date2."");
                break;
            case 5:
                $transfers=file_get_contents(Yii::app()->params['api']."/RestTransfers/rates.html?moneda=USD&lan=en&adults=".$_REQUEST['transfer_adult']."&ninos=".$_REQUEST['transfer_child']."&dest_ini=".$_REQUEST['dest_from']."&dest_end=".$_REQUEST['dest_end']."&round_trip=".$_REQUEST['round_trip']."&transfer_option_type=".$_REQUEST['transfer_option_type']."&date=".$date1."&date2=".$date2."");
                break;
        }
        GenericFunctions::scriptsTransfer();
        $this->render('traslados',array('transfers' => $transfers,'fecha'=> $textoFecha));
    }


}
?>