<?php

class CheckoutController extends Controller
{
    public $pageDescription;
    public $pageKeywords;
    public $pageBase;

    public function actionIndex() {
        if (isset($_REQUEST["query"])) {
            $id = intval(Yii::app()->GenericFunctions->ShowVar($_REQUEST["query"]));
            $_prod = VentaDescripcion::model()->findByPk($id);
            $_prod->delete();
            $this->redirect(array(
                "checkout/index"
            ));
        }


        $_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
        $_vValidator = Venta::model()->findAllBySql($_sql);

        $destinationId = array(0);

        if ($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "") {
            $_venta = new Venta;
            $_venta->venta_session_id = $_SESSION["config"]["token"];
            $_venta->venta_moneda     = $_SESSION["config"]["currency"];
            $_venta->venta_site_id    = ((Yii::app()->language == "es") ? 2 : 1);
            $_venta->venta_user_id    = 0;
            $_venta->venta_estt       = 1;
            $_venta->venta_total      = 0;
            $_venta->venta_fecha      = date("Y-m-d H:i:s");
            $_venta->save();
            $Venta = $_venta->venta_id;
        } else {
            $Venta = $_vValidator[0]->venta_id;
        }

        $_Productos         = VentaDescripcion::model()->findAll("descripcion_venta = :venta", array(":venta" => $Venta ));
        $Productos          = array();
        $ProductoStarsLevel = array();

        foreach ($_Productos as $_p) {
            if (!isset($Productos[$_p->descripcion_tipo_producto])) {
                $Productos[$_p->descripcion_tipo_producto] = array();
            }
            array_push($Productos[$_p->descripcion_tipo_producto], $_p);

            if ($_p->descripcion_tipo_producto == 2 || $_p->descripcion_tipo_producto == 3) {
                if (!in_array($_p->descripcion_destino, $destinationId)) {
                    array_push($destinationId, $_p->descripcion_destino);
                }
                if ($_p->descripcion_tipo_producto == 2){
                    $destino_id = Yii::app()->db->createCommand()->select('destino_extranet_codigo')
                        ->from('destino')->where("destino_id = :id", array(
                            ":id" => intval($_p->descripcion_destino)
                        ))
                        ->queryRow();
                    Yii::app()->_Hotels->setDes($destino_id["destino_extranet_codigo"]);
                    $_XML = Yii::app()->_Hotels->wsGetByDestination();
                    $wsdl = Yii::app()->_Hotels->WSDL;
                    $xml = $_XML;
                    $iService = Yii::app()->WebServices->consumeServiceXML($wsdl,$xml);
                    $Hoteles = $iService->SearchHotelsByIDResult->HotelList;


                    if(sizeof($Hoteles) > 0){
                        $nIndex = Yii::app()->WebServices->getKey(10);
                        if(isset($_SESSION["iServices"]["Hoteles"][$nIndex])){
                            $nIndex = Yii::app()->WebServices->getKey(11);
                        }

                        $_Cr = $nIndex;
                    }
                }
            }

            if ($_p->descripcion_tipo_producto == 1) {
                $starsLevel = Yii::app()->dbWeblt->createCommand()->select("categoria_valor")->from('hoteles')->join("hoteles_categorias", "hotel_categoria = categoria_id")->where("hotel_id=" . $_p->descripcion_producto_id . "")->queryRow();
                $ProductoStarsLevel[$_p->descripcion_producto_id] = $starsLevel['categoria_valor'];

                $hotelInfo = Yii::app()->dbWeblt->createCommand()
                    ->select('hotel_ciudad')
                    ->from('hoteles')->where("hotel_id = :id", array(
                        ":id" => intval($_p->descripcion_producto_id)
                    ))
                    ->queryRow();

                $dInfo = Yii::app()->db->createCommand()->select('destino_id')->from('destino')->where("destino_extranet_codigo = :id", array(
                    ":id" => intval($hotelInfo["hotel_ciudad"])
                ))->queryRow();
                $destinoIdHotel = $dInfo["destino_id"];
                if (!in_array($destinoIdHotel, $destinationId)) {
                    array_push($destinationId, $destinoIdHotel);
                }
                $hotel_id             = $_p->descripcion_producto_id;
                $adultos              = $_p->descripcion_adultos;
                $menores              = $_p->descripcion_menores;
                $transfer_FechaIN     = date_create($_p->descripcion_fecha1);
                $transfer_FechaOUT    = date_create($_p->descripcion_fecha2);
                $descripcion_producto = $_p->descripcion_producto;
            }
        }

        //Agregar servicio extra
        foreach ($_Productos as $_p) {
            if ($_p->descripcion_tipo_producto == 1 || $_p->descripcion_tipo_producto == 2 || $_p->descripcion_tipo_producto == 3  ) {

                $adultosExtra              = $_p->descripcion_adultos;
                $menoresExtra              = $_p->descripcion_menores;
                $paxExtra = intval($adultosExtra) + intval($menoresExtra);
                $FechaIniExtra     = date_create($_p->descripcion_fecha1);
                $FechaFinExtra    = date_create($_p->descripcion_fecha2);
                $_nochesExtra = Yii::app()->GenericFunctions->difDays($_p->descripcion_fecha1,$_p->descripcion_fecha2);

                if($_p->descripcion_tipo_producto == 2){
                    $_nochesExtra=1;
                }

                if($_p->descripcion_tipo_producto == 3){
                    if($_p->tipo_translado==2 || $_p->tipo_translado==3 || $_p->tipo_translado==4){
                        $_nochesExtra=1;
                        $FechaFinExtra    = date_create($_p->descripcion_fecha1);
                    }
                }
            }
        }
        /*print_r($_Productos[0]->descripcion_id);
        exit()*/;

        /*se regreso seccion*/
        if (sizeof($Productos) > 0) {
            $this->pageTitle = ((Yii::app()->language == "es") ? "Lomas Travel: Traslados, Hoteles en Cancun, Vallarta, Los Cabos" : "Lomas Travel: Transfers & Hotels in Cancun, Vallarta, Cabos & Riviera ");
            $this->pageDescription = ((Yii::app()->language == "es") ? "Viaja con Lomas Travel. Reserva tus boletos de avión, transportación, actividades y noches de hotel en Cancún, Los Cabos y los mejores destinos de México" : "Travel with Lomas Travel. Buy airport transfers, tours and reserve a hotel in Cancun, Vallarta, Los Cabos and Riviera Maya. Great prices guaranteed!");
            $this->pageKeywords = ((Yii::app()->language == "es") ? "hoteles mexico, actividades y tours, transportacion, lomas travel" : "hotels mexico, tours and activities, airport transfers mexico, lomas travel");

            if($hotelInfo["hotel_ciudad"] == "" || ($hotelInfo["hotel_ciudad"] >= 14 && $hotelInfo["hotel_ciudad"] <= 21)){
                $Tours = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('tour_tarifa')
                    ->join("tour", "tour_id = tarifa_tour")
                    ->join("tour_servicio", "tarifa_servicio = servicio_id")
                    ->join("tour_descripcion", "descripcion_tour = tour_id")
                    ->join("destino", "destino_id = tour_destino")
                    ->join("pais", "pais_id = destino_pais")
                    ->where("tour_status = 1 and descripcion_idioma = :idioma and ( tour_destino IN(" . implode(",", $destinationId) . ") OR tour_casa = 1) and tarifa_tipo_tarifa = 1" . (((isset($_REQUEST["q"]) && $_REQUEST["q"] != "") ? "and " . ((Yii::app()->language == "en") ? "tour_nombre" : "tour_nombre_es") . " Like '%" . $_REQUEST["q"] . "%'" : "")) , array(
                        ":idioma" => Yii::app()->GenericFunctions->getLangId()
                    ))
                    ->order("tour_casa DESC, tour_orden ASC")
                    ->queryAll();
                //->getText();
                //print_r($Tours);
                ///exit();

                $ToursGal    = array(0);
                $ToursId     = array(0);
                $Fotos       = array();
                $_Categorias = array();

                foreach ($Tours as $p) {
                    if ($p["tour_galeria"] != "" && intval($p["tour_galeria"]) != 0) {
                        array_push($ToursGal, intval($p["tour_galeria"]));
                    }
                    array_push($ToursId, $p["tour_id"]);
                }

                $Categorias = Yii::app()->db->createCommand()
                    ->select('categoria_nombre_' . Yii::app()
                            ->language . ' as cnombre, categorias_tour,categorias_id')
                    ->from('tour_categorias')
                    ->join("categoria_tour", "categorias_categorias = categoria_id")
                    ->where("categorias_tour IN(" . implode(",", $ToursId) . ")")
                    ->queryAll();

                foreach ($Categorias as $_cat) {
                    if (!isset($_Categorias[$_cat["categorias_tour"]])) {
                        $_Categorias[$_cat["categorias_tour"]] = array();
                    }
                    array_push($_Categorias[$_cat["categorias_tour"]], $_cat);
                }

                $Imagenes = Yii::app()->db->createCommand()
                    ->select('foto_archivo, foto_galeria')
                    ->from('foto')
                    ->join("galeria", "foto_galeria = galeria_id")
                    ->where("foto_galeria IN(" . implode(",", $ToursGal) . ")")
                    ->queryAll();

                foreach ($Imagenes as $img) {
                    if (!isset($Fotos[$img["foto_galeria"]])) {
                        $Fotos[$img["foto_galeria"]] = $img["foto_archivo"];
                    }
                }

                $Connection = Yii::app()->db;
                $sql = "Select * from tour_tarifa inner join tour_servicio on tarifa_servicio = servicio_id where tarifa_tour = '" . $Tour["tour_id"] . "'  and tarifa_fecha_inicio <= '" . $_fecha . "'  and tarifa_fecha_final >= '" . $_fecha . "' AND tarifa_min_adultos <= '" . $_ad . "' AND ((tarifa_tipo_cobro = 1) OR ((tarifa_tipo_cobro = 2 AND tarifa_max_adultos >= '" . $_ad . "'AND tarifa_max_menores >= '" . $_mn . "') OR (tarifa_tipo_cobro = 2 AND tarifa_max_adultos >= '" . ($_ad + $_mn) . "')))";
                $Command = $Connection->createCommand($sql);
                $Tarifas = $Command->queryAll();
                if (sizeof($tarifas) > 0) {;
                } else {
                    $sql = "Select * from tour_tarifa inner join tour_servicio on tarifa_servicio = servicio_id where tarifa_tour = '" . $Tour["tour_id"] . "' and tarifa_fecha_final >= '" . $_fecha . "' AND tarifa_min_adultos <= '" . $_ad . "' AND ((tarifa_tipo_cobro = 1) OR ((tarifa_tipo_cobro = 2 AND tarifa_max_adultos >= '" . $_ad . "' AND tarifa_max_menores >= '" . $_mn . "') OR (tarifa_tipo_cobro = 2 AND tarifa_max_adultos >= '" . ($_ad + $_mn) . "')))";
                    $Command = $Connection->createCommand($sql);
                    $Tarifas = $Command->queryAll();
                }

                $minPrice = 999999;

                /*
                    Cotizacion para transfer en hoteles
                */
            }
            if ($hotel_id > 0) {

                $hotel = $hotelInfo = Yii::app()->dbWeblt->createCommand()
                    ->select('hotel_ciudad, hotel_transportacion_zona')
                    ->from('hoteles')
                    ->where("hotel_id = :id", array(
                        ":id" => intval($hotel_id)
                    ))
                    ->queryRow();

                //Se obtiene el id de la transportacion para agregar transportacion al hotel
                $Traslado = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('transportacion')
                    ->where('transportacion_zona_ini = :zona_ini AND transportacion_zona_fin = :zona_fin', array(
                        ':zona_ini' => 1,
                        ':zona_fin' => $hotel['hotel_transportacion_zona']
                    ))
                    ->queryRow();

                $_Tarifas = Yii::app()->db->createCommand()
                    ->select("*")
                    ->from('transportacion_tarifa')
                    ->join("transportacion_tipo", "tipo_id = tarifa_tipo")
                    ->where("tarifa_transportacion = :id and tipo_roundtrip = '1' AND tipo_id IN (2,4,6,16)", array(
                        ":id" => $Traslado["transportacion_id"]
                    ))
                    ->order("tipo_group ASC, tarifa_precio ASC")
                    ->queryAll();


                $p = intval($adultos) + intval($menores);

                $infotTransfer  = array();
                if (count($_Tarifas) > 0 ) {
                    foreach ($_Tarifas as  $ta) {
                        $tPax = $p;
                        $total = 0;
                        $numVehiculo = 1;
                        if($tPax>=$ta["tarifa_cap_ini"] && $tPax <= $ta["tarifa_cap_fin"]){
                            $total = number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$ta["tarifa_precio"]),0,".","");
                        }else{
                            if($ta["tarifa_tipo"]==1 || $ta["tarifa_tipo"]==2 || $ta["tarifa_tipo"]==3 || $ta["tarifa_tipo"]==4){
                                if($tPax > $ta["tarifa_cap_fin"]){
                                    $ta["tarifa_precio"] = $ta["tarifa_precio"] + (($tPax - $ta["tarifa_cap_fin"]) * $ta["tarifa_pax_ext"]);
                                }
                                $total = number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$ta["tarifa_precio"]),0,".","");
                            }else{
                                if ($ta["tarifa_tipo"] == 6 || $ta["tarifa_tipo"] == 16) {
                                    $numVehiculo =  ceil($tPax / $ta['tarifa_cap_fin']);

                                    $ta["tarifa_precio"] = $numVehiculo * $ta["tarifa_pax_ext"];
                                    $total = number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$ta["tarifa_precio"]),0,".","");
                                }
                            }
                        }

                        $aux = ($numVehiculo > 1)? " (". $numVehiculo ." Vehicles )" : "";
                        $descripcion_tarifa = $ta["tipo_nombre_" . Yii::app()->language] . $aux;
                        $jnfe           = Yii::app()->GenericFunctions->ProtectVar($ta["tarifa_id"] . "@@" . $ta["tarifa_tipo"] . "@@" . $ta["tarifa_transportacion"] . "@@" . $total . "@@" . 'Cancun Airport' . "@@" . $descripcion_producto . "@@" . $descripcion_tarifa . "@@/images/traslados/" . $ta["tipo_imagen"] . ".jpg@@" . 1);
                        $tipo_translado = 2;

                        $pgr = array(
                            'transfer_from_id' => 1,
                            'transfer_to_id'   => $hotel_id.":".$hotel['hotel_transportacion_zona'],
                            'transfer_arrival' => date_format($transfer_FechaIN, 'm/d/Y'),
                            'transfer_return'  => date_format($transfer_FechaOUT, 'm/d/Y'),
                            'transfer_adults'  => $adultos,
                            'transfer_child'   => $menores
                        );

                        $params  = array(
                            'jnfe'           => $jnfe,
                            'tipo_translado' => $tipo_translado,
                            'pgR'            => Yii::app()->GenericFunctions->ProtectVar(serialize($pgr))
                        );

                        $urlAddTransfer = '/traslados/agregar?'.http_build_query($params);
                        if ($total > 0) {
                            $infotTransfer[$ta['tipo_id']] = (object) array(
                                'descripcion_hotel1' => 'Cancun Airport',
                                'descripcion_hotel2' => $descripcion_producto,
                                'descripcion_total'  => $total,
                                'urladd'             => $urlAddTransfer,
                                'tarifa_id'          => $ta['tarifa_id'],
                                'descripcion_tarifa' => $ta['tipo_nombre_'.Yii::app()->language],
                                'descripcion_tipo'   => $ta["tipo_desc_" . Yii::app()->language],
                                'tipo_privado'       => $ta["tipo_privado"],
                                'tarifa_cap_ini' => $ta["tarifa_cap_ini"],
                                'tarifa_cap_fin' => $ta["tarifa_cap_fin"],
                                'tipo_imagen' => $ta["tipo_imagen"],
                                'numVehiculo' => $numVehiculo,
                            );
                        }
                    }
                }

            }


            $_Serv_ex = Yii::app()->db->createCommand()
                ->select('folio, producto_nombre_'.Yii::app()->language.' as nombre,
				producto_descripcion_'.Yii::app()->language.' as descripcion, fotografia_nombre as foto,
				tarifa_tipocambio_id as tipo_cambio, producto_precio as precio')
                ->from('productos_extras')
                ->where("producto_estado='1' and sitio_id='2' ")
                ->queryAll();

            if (count($_Serv_ex) > 0 ) {
                $a=0;
                $bloque_dias=1;
                for($i=1;$i<$_nochesExtra;$i++){
                    if(fmod($i,5) == 0){
                        $bloque_dias++;
                    }
                }
                foreach ($_Serv_ex as  $ta) {

                    $ta['precio'] = number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$ta['precio']),0,".","");
                    $ta['precio_total'] = number_format($ta['precio']*$paxExtra*$bloque_dias,0,".","");

                    $jnfe = Yii::app()->GenericFunctions->ProtectVar($ta["folio"] . "@@" . $ta["nombre"] . "@@" . $ta['precio_total'] . "@@/images/servicio_extra/" . $ta["foto"] . "@@" . "Assistance for your trip" . "@@" . 1);

                    $pgr = array( 'extra_folio' => $ta['folio'], 'extra_adults'  => $adultosExtra, 'extra_child'   => $menoresExtra,'extra_arrival' => date_format($FechaIniExtra, 'm/d/Y'), 'extra_return'  => date_format($FechaFinExtra, 'm/d/Y'));

                    $params  = array('jnfe'=> $jnfe,	'pgR'=> Yii::app()->GenericFunctions->ProtectVar(serialize($pgr) ) );
                    $urlAddTransfer = '/extras/agregar?'.http_build_query($params);
                    $ta['urladd']=$urlAddTransfer;

                    $serv_ex[$a]=$ta;
                    $a++;
                }
            }



            $cs = Yii::app()->getclientScript();
            $cs->registerCssFile('http://cdn.lomastravel.com/css/page/checkout.min.css');
            $cs->registerCssFile('/css/page/checkout/checkout.css');

            /*print_r($Productos);
            exit();*/
            $this->render('index', array(
                "_Htls"=>$Hoteles,
                "ProductoStarsLevel" => $ProductoStarsLevel,
                "Productos"          => $Productos,
                "_Productos"         => $_Productos,
                "_Tours"             => $Tours,
                "Destinos"           => $Destinos,
                "Fotos"              => $Fotos,
                "Categorias"         => $_Categorias,
                "_t"                 => $Tour,
                "Imagenes"           => $Imagenes,
                "_imgPrincipal"      => $_imgPrincipal,
                "Tarifas"            => $Tarifas,
                "_ad"                => $_ad,
                "_mn"                => $_mn,
                "_fecha"             => $_fecha,
                "minPrice"           => $minPrice,
                "pax_adulto"         => $pax_adulto,
                "pax_menor"          => $pax_menor,
                "infotTransfer" => $infotTransfer,
                "serv_ex" =>	$serv_ex
            ));
        } else {
            $this->redirect(array(
                "site/index"
            ));
        }
    }

}
?>