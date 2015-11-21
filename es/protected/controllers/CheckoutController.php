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

        $_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config_es"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
        $_vValidator = Venta::model()->findAllBySql($_sql);

        $destinationId = array(0);

        if ($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "") {
            $_venta = new Venta;
            $_venta->venta_session_id = $_SESSION["config_es"]["token"];
            $_venta->venta_moneda     = Yii::app()->params['Moneda'];
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
            if ($_p->descripcion_tipo_producto == 2 ) {
            
                $adultosExtra              = $_p->descripcion_adultos;
                $menoresExtra              = $_p->descripcion_menores;          
                $paxExtra = intval($adultosExtra) + intval($menoresExtra);
                $FechaIniExtra     = date_create($_p->descripcion_fecha1);
                $FechaFinExtra    = date_create($_p->descripcion_fecha2);       
                $_nochesExtra = Yii::app()->GenericFunctions->difDays($_p->descripcion_fecha1,$_p->descripcion_fecha2);
                
                if($_p->descripcion_tipo_producto == 2){
                    $_nochesExtra=1;
                }
            }
        }
        //Agregar servicio extra
        foreach ($_Productos as $_p) {
            if ($_p->descripcion_tipo_producto == 1 ) {
            
                $adultosExtra              = $_p->descripcion_adultos;
                $menoresExtra              = $_p->descripcion_menores;          
                $paxExtra = intval($adultosExtra) + intval($menoresExtra);
                $FechaIniExtra     = date_create($_p->descripcion_fecha1);
                $FechaFinExtra    = date_create($_p->descripcion_fecha2);       
                $_nochesExtra = Yii::app()->GenericFunctions->difDays($_p->descripcion_fecha1,$_p->descripcion_fecha2);
                
            }
        }        
        //Agregar servicio extra
        foreach ($_Productos as $_p) {
            if ($_p->descripcion_tipo_producto == 3  ) {
            
                $adultosExtra              = $_p->descripcion_adultos;
                $menoresExtra              = $_p->descripcion_menores;          
                $paxExtra = intval($adultosExtra) + intval($menoresExtra);
                $FechaIniExtra     = date_create($_p->descripcion_fecha1);
                $FechaFinExtra    = date_create($_p->descripcion_fecha2);       
                $_nochesExtra = Yii::app()->GenericFunctions->difDays($_p->descripcion_fecha1,$_p->descripcion_fecha2);
                
                            
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
/*print_r("expression");
exit();*/
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
                            $total = number_format(Yii::app()->Currency->convert(Yii::app()->params['Moneda'],$ta["tarifa_precio"]),0,".","");
                        }else{
                            if($ta["tarifa_tipo"]==1 || $ta["tarifa_tipo"]==2 || $ta["tarifa_tipo"]==3 || $ta["tarifa_tipo"]==4){
                                if($tPax > $ta["tarifa_cap_fin"]){
                                    $ta["tarifa_precio"] = $ta["tarifa_precio"] + (($tPax - $ta["tarifa_cap_fin"]) * $ta["tarifa_pax_ext"]);
                                }
                                $total = number_format(Yii::app()->Currency->convert(Yii::app()->params['Moneda'],$ta["tarifa_precio"]),0,".","");
                            }else{
                                if ($ta["tarifa_tipo"] == 6 || $ta["tarifa_tipo"] == 16) {
                                    $numVehiculo =  ceil($tPax / $ta['tarifa_cap_fin']);

                                    $ta["tarifa_precio"] = $numVehiculo * $ta["tarifa_pax_ext"];
                                    $total = number_format(Yii::app()->Currency->convert(Yii::app()->params['Moneda'],$ta["tarifa_precio"]),0,".","");
                                }
                            }
                        }

                        $aux = ($numVehiculo > 1)? " (". $numVehiculo ." Vehicles )" : "";
                        $descripcion_tarifa = $ta["tipo_nombre_" . Yii::app()->language] . $aux;
                        $jnfe           = Yii::app()->GenericFunctions->ProtectVar($ta["tarifa_id"] . "@@" . $ta["tarifa_tipo"] . "@@" . $ta["tarifa_transportacion"] . "@@" . $total . "@@" . 'Cancun Airport' . "@@" . $descripcion_producto . "@@" . $descripcion_tarifa . "@@/img/traslados/" . $ta["tipo_imagen"] . ".jpg@@" . 1);
                        $tipo_translado = 2;

                        $pgr = array(
                            'transfer_from_id' => 1,
                            'transfer_to_id'   => $hotel_id.":".$hotel['hotel_transportacion_zona'],
                            'transfer_arrival' => date_format($transfer_FechaIN, 'd/m/Y'),
                            'transfer_return'  => date_format($transfer_FechaOUT, 'd/m/Y'),
                            'transfer_adults'  => $adultos,
                            'transfer_child'   => $menores
                        );
                        
                        $pgR = Yii::app()->GenericFunctions->ProtectVar(serialize($pgr));
                        // para la validacion de sessiones [Inicio]//
                        $_SESSION['datosKey'][]=$jnfe;
                        $_SESSION['datosKeypgR'][]=$pgR;
                        // para la validacion de sessiones [Final]//
                        
                        $params  = array(
                            'jnfe'           => $jnfe,
                            'tipo_translado' => $tipo_translado,
                            'pgR'            => $pgR
                        );

                        $urlAddTransfer = '/es/traslados/agregar?'.http_build_query($params);
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

                    $ta['precio'] = number_format(Yii::app()->Currency->convert(Yii::app()->params['Moneda'],$ta['precio']),0,".","");
                    $ta['precio_total'] = number_format($ta['precio']*$paxExtra*$bloque_dias,0,".","");

                    $jnfe = Yii::app()->GenericFunctions->ProtectVar($ta["folio"] . "@@" . $ta["nombre"] . "@@" . $ta['precio_total'] . "@@/img/servicio_extra/" . $ta["foto"] . "@@" . "Assistance for your trip" . "@@" . 1);

                    $pgr = array( 'extra_folio' => $ta['folio'], 'extra_adults'  => $adultosExtra, 'extra_child'   => $menoresExtra,'extra_arrival' => date_format($FechaIniExtra, 'd/m/Y'), 'extra_return'  => date_format($FechaFinExtra, 'd/m/Y'));

                    $pgR = Yii::app()->GenericFunctions->ProtectVar(serialize($pgr));
                    /// para validar las sessiones y no exista modificacion de la info             
                    $_SESSION['datosKey'][]=$jnfe;
                    $_SESSION['datosKeypgR'][]=$pgR;
                    //////////////////////////////////////

                    $params  = array('jnfe'=> $jnfe, 'pgR'=> $pgR);
                    $urlAddTransfer = '/es/extras/agregar?'.http_build_query($params);
                    $ta['urladd']=$urlAddTransfer;

                    $serv_ex[$a]=$ta;
                    $a++;
                }
            }



            $cs = Yii::app()->getclientScript();
            //$cs->registerCssFile('http://cdn.lomastravel.com/css/page/checkout.min.css');
            $cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/checkout/checkout.css');
            $cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/checkout/checkout.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);

            /*print_r($Productos);
            exit();*/
            $this->layout='checkout';
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

     public function actionDetalle() {
        

        /* aqui vamos a poner un cataogo*/
        $Paises = Yii::app()->db->createCommand()->select('*')->from('paises')->order("PAI_NOMBRE ASC")->queryAll();
        
        if (isset($_REQUEST["query"])) {
            $id = intval(Yii::app()->GenericFunctions->ShowVar($_REQUEST["query"]));
            $_prod = VentaDescripcion::model()->findByPk($id);
            $_prod->delete();
            
            $this->redirect(array(
                "checkout/index"
            ));
            
        }
        if(isset($_REQUEST['TryAgain']) && $_REQUEST['TryAgain']==1){
            $_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config_es"]["token"] . "' and venta_estt != '2' and venta_fecha Like '" . date("Y-m-d") . "%'";
            $_vValidator = Venta::model()->findAllBySql($_sql);
            $_venta = Venta::model()->findByPk($_vValidator[0]->venta_id);
            $_venta->venta_estt = 1;
            $_venta->save();
            //print_r($_venta);
        }

        
        $_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config_es"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
        $_vValidator = Venta::model()->findAllBySql($_sql);


        if ($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "") {
            $_venta = new Venta;
            $_venta->venta_session_id = $_SESSION["config_es"]["token"];
            $_venta->venta_moneda = Yii::app()->params['Moneda'];
            $_venta->venta_site_id = ((Yii::app()->language == "es") ? 2 : 1);
            $_venta->venta_user_id = 0;
            $_venta->venta_estt = 1;
            $_venta->venta_total = 0;
            $_venta->venta_fecha = date("Y-m-d H:i:s");
            
            $_venta->save();
            $Venta = $_venta->venta_id;
        } else {
            $Venta = $_vValidator[0]->venta_id;
        }
        /*print_r($Venta."<br>");
        print_r($_SESSION["config_es"]["token"]);
        exit();*/
        $_Productos = VentaDescripcion::model()->findAll("descripcion_venta = :venta", array(
            ":venta" => $Venta
        ));

        $Productos = array();
        foreach ($_Productos as $_p) {
            if (!isset($Productos[$_p->descripcion_tipo_producto])) {
                $Productos[$_p->descripcion_tipo_producto] = array();
            }
            array_push($Productos[$_p->descripcion_tipo_producto], $_p);
        }
        
        if (sizeof($Productos) > 0) {
            $cs = Yii::app()->getclientScript();
            $cs->registerScriptFile(Yii::app()->params["baseUrl"] . '/js/page/checkout/checkout.js', CClientScript::POS_END);
            $cs->registerCssFile(Yii::app()->params["baseUrl"] . '/css/page/checkout/checkout.css');
            
            $this->layout='checkout';
            $this->render('detalle', array(
                "Productos" => $Productos,
                "_Productos" => $_Productos,
                "_Paises" => $Paises
            ));
        } else {
            $this->redirect(array(
                "site/index"
            ));
        }
    }

    public function actionValidar() { 

            $this->layout='checkout';
            $cs = Yii::app()->getclientScript();
            $cs->registerScriptFile(Yii::app()->params["baseUrl"] . '/js/page/checkout/checkout.js', CClientScript::POS_END);
            $cs->registerCssFile(Yii::app()->params["baseUrl"] . '/css/page/checkout/checkout.css');
            $email_test = array("egonzalez@dexabyte.com.mx","lcaballero@dexabyte.com.mx","malvarez@dexabyte.com.mx");
            
            //-> Es un pago con Tarjeta de Credito
            $GatewayMethod = explode("_", $_REQUEST["gateway_method"]);
            
            if (Yii::app()->params['Moneda'] == "MXN" && $GatewayMethod[0] == "santander") {
                if ($GatewayMethod[1] == 1) {
                    Yii::app()->Santander->setVars("4018", "001", "MEX", "4018WEUS0", "4018WEUS0", "15365", "3", "MXN", "A7BEC7D1", "prod");
                    //Pruebas de pago
                    if(in_array($_REQUEST["email"],$email_test)){
                        Yii::app()->Santander->setVars("1141", "002", "MEX", "1141SIUS0", "1141SIUS0", "52863", "3", "MXN", "114AF671", "dev");
                    } 
                } else if ($GatewayMethod[1] == 3) {
                    Yii::app()->Santander->setVars("4018", "001", "MEX", "4018WEUS0", "4018WEUS0", "15531", "3", "MXN", "A7BEC7D1", "prod");
                } else if ($GatewayMethod[1] == 6) {
                    Yii::app()->Santander->setVars("4018", "001", "MEX", "4018WEUS0", "4018WEUS0", "15532", "3", "MXN", "A7BEC7D1", "prod");
                }
            }else{
                if(in_array($txtEmail,$email_test)){
                    Yii::app()->Santander->setVars("1141", "002", "MEX", "1141SIUS0", "1141SIUS0", "52868", "3", "USD", "114AF671", "dev");
                }
            }
            
            

            $status = 2;
            $sucess = false;
            $auth = "";
            $authCode = "";
            $_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config_es"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
            $_vValidator = Venta::model()->findAllBySql($_sql);

            if ($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "") {
                $this->render("error", array(
                    "ErrorMessage" => Yii::t("global", "No es una venta valida")
                ));
            } else {


/*            print_r($_vValidator[0]->venta_id);
            exit();*/
                /* Inserta o actualiza el cliente para la venta */
                $_Cliente = null;
                if ($_vValidator[0]->venta_user_id == 0) {
                    $_Cliente = new Cliente;
                } else {
                    $_Cliente = Cliente::model()->findByPk($_vValidator[0]->venta_user_id);
                }
                $_Cliente->cliente_nombre = $_REQUEST["nombre"];
                $_Cliente->cliente_apellido = $_REQUEST["apellido"];
                $_Cliente->cliente_email = $_REQUEST["email"];
                $_Cliente->cliente_pais_n = $_REQUEST["pais"];
                $_Cliente->cliente_domicilio = $_REQUEST["direccion"];
                $_Cliente->cliente_estado = $_REQUEST["estado"];
                $_Cliente->cliente_ciudad = $_REQUEST["ciudad"];
                $_Cliente->cliente_postal_code = $_REQUEST["cp"];
                $_Cliente->cliente_telefono = $_REQUEST["telefono"];

                             
                $_Cliente->save();
                $clientId = $_Cliente->cliente_id;
                
                $ventaUserid = Venta::model()->findByPk($_vValidator[0]->venta_id);
                $ventaUserid->venta_user_id = $clientId;
                $ventaUserid->save();
 
                /* Inserta o actualiza el cliente para la venta */
                
                $Venta = $_vValidator[0];
                
                $_Productos = VentaDescripcion::model()->findAll("descripcion_venta = :venta", array(
                    ":venta" => $Venta->venta_id
                ));
                 
                $total = 0;
                
                foreach ($_Productos as $_p) {
                    $total+= $_p->descripcion_total;
                }
                $total = number_format($total, 0, ".", "");
               
                $Card = TestCard::model()->find("card_number=:tarjeta", array(
                    ":tarjeta" => $_REQUEST["numero"]
                ));

                /*print_r($Card->card_mail."<br>");
                print_r($Card->card_month."<br>");
                print_r($Card->card_year."<br>");
                print_r($Card->card_cvv."<br>");
                print_r("<pre>");
                print_r($_REQUEST);                   
                exit();*/
               
                if (isset($Card->card_mail)) {

                    if ($Card->card_mail == $_REQUEST["email"] && $Card->card_month == $_REQUEST["cc_month"] && $Card->card_year == $_REQUEST["cc_year"] && $Card->card_cvv == $_REQUEST["ccv"]) {
                        
                        //-> Es una TestCard Valida
                        $status = 15;
                        $sucess = true;
                        $authCode = Yii::app()->WebServices->getKey(11);
                        $auth = "Test Card";

                    } else {
                        $this->render("error", array(
                            "ErrorMessage" => Yii::t("global", "No es una Test Card valida")
                        ));
                    }
                
                } else {
                    
                    //-> No es una TestCard vamos a cobrar
                    
                    //$total = 1;
                    if ($GatewayMethod[0] == "santander") {
                        $xml = Yii::app()->Santander->makeXML($Venta->venta_id, $Venta->venta_user_id, $total, $_REQUEST["nombre"], trim($_REQUEST["numero"]) , trim($_REQUEST["cc_month"]) , trim($_REQUEST["cc_year"]) , trim($_REQUEST["ccv"]));
                        
                        //$xml = Yii::app()->Santander->makeXML($Venta->venta_id,$Venta->venta_user_id,1,$_REQUEST["nombre"],trim($_REQUEST["numero"]),trim($_REQUEST["cc_month"]),trim($_REQUEST["cc_year"]),trim($_REQUEST["ccv"]));
                        $iService = Yii::app()->Santander->callService($xml);
                        
                        //$answerSantander = get_object_vars($iService);
                        
                        $answerSantander = get_object_vars($iService);
                        foreach ($answerSantander as $k => $v) {
                            if (is_object($v)) {
                                $answerSantander[$k] = get_object_vars($v);
                            }
                        }
                        
                        $tmpTns = array_merge($answerSantander, $_REQUEST);
                        $_tns = new VentaTns;
                        $_tns->venta_id = $Venta->venta_id;
                        $_tns->venta_fecha = date("Y-m-d H:i:s");
                        $_tns->venta_data = serialize($tmpTns);
                        $_tns->save();
                             
                        if ($iService->response == "approved") {
                            $Productos = array();
                            foreach ($_Productos as $_p) {
                                if (!isset($Productos[$_p->descripcion_tipo_producto])) {
                                    $Productos[$_p->descripcion_tipo_producto] = array();
                                }
                                array_push($Productos[$_p->descripcion_tipo_producto], $_p);
                            }
                            $authCode = $iService->auth;
                            $auth = "Santander";
                            
                            $sucess = true;
                        } else {
                            if ($iService->response == "denied") {
                                
                                /* Insertar Estado de la venta */
                                $ventaUserid = Venta::model()->findByPk($_vValidator[0]->venta_id);
                                $ventaUserid->venta_estt = "7";
                                $ventaUserid->venta_total = $total;
                                $ventaUserid->save();
                                
                                /* Insertar Estado de la venta */
                                
                                $this->render("error", array(
                                    "ErrorMessage" => Yii::t("global", "El banco emisor denego el cargo a la tarjeta")
                                ));
                                exit();
                            } else {
                                
                                /* Insertar Estado de la venta */
                                $ventaUserid = Venta::model()->findByPk($_vValidator[0]->venta_id);
                                $ventaUserid->venta_estt = "6";
                                $ventaUserid->venta_total = $total;
                                $ventaUserid->save();
                                
                                /* Insertar Estado de la venta */
                                
                                $this->render("error", array(
                                    "ErrorMessage" => $iService->nb_error
                                ));
                                exit();
                            }
                        }
                    }
                    if ($GatewayMethod[0] == "hsbc") {
                        $cs = Yii::app()->getclientScript();
                        
                        //$cs->registerCssFile(Yii::app()->baseUrl.'/css/cleared_checkout.css');
                        $MerchantHSBC = array(
                            1 => "7068547",
                            3 => "7149668",
                            6 => "7149673"
                        );
                        if (Yii::app()->language == "es") $MonedaHSBC = 484;
                        
                        $this->render("hsbcform", array(
                            "_Productos" => $_Productos,
                            "Venta" => $Venta,
                            "merchant" => $MerchantHSBC[$GatewayMethod[1]]
                        ));
                    }
                }
        

                if (sizeof($_REQUEST["TransferAddInfo"]) > 0) {
                        
                        foreach ($_REQUEST["TransferAddInfo"] as $vdId => $info) {
                            $_vD = VentaDescripcion::model()->findByPk($vdId);
                            
                                $_vD->descripcion_hora_llegada_vuelo1 = $info["descripcion_hora_llegada_vuelo1"];
                                $_vD->descripcion_num_vuelo1 = $info["descripcion_num_vuelo1"];
                                $_vD->descripcion_linea_area1 = $info["descripcion_linea_area1"];

                                $_vD->descripcion_hora_llegada_vuelo2 = $info["descripcion_hora_llegada_vuelo2"];
                                $_vD->descripcion_num_vuelo2 = $info["descripcion_num_vuelo2"];
                                $_vD->descripcion_linea_area2 = $info["descripcion_linea_area2"];
                          
                            $_vD->descripcion_serialized = serialize($_REQUEST["TransferInfoPasajeros"][$vdId]);                            
                            $_vD->save();

                        }
                }       
                


                if ($sucess) {

                    foreach ($_Productos as $v) {
                        
                        if ($v->descripcion_tipo_producto == 4) {

                            foreach ($_REQUEST["TransferInfoPasajeros"] as $vdId => $info) {
                                $_vD = VentaDescripcion::model()->findByPk($v->descripcion_id);
                                $_vD->descripcion_serialized = serialize($_REQUEST["TransferInfoPasajeros"][$vdId]);
                                $_vD->save();
                                
                                $m["mail_titulo"] = "Lomas Travel | Asistencia en tu viaje | #" . $v->descripcion_id;
                                
                                $mailAC = new PHPMailer(true);
                                $mailAC->isSMTP(); 
                                $mailAC->Host = "smtp.gmail.com";
                                $mailAC->SMTPAuth = true; 
                                $mailAC->Username = "envios@lomas-travel.com";
                                $mailAC->Password = "r5J8Rg<S";
                                $mailAC->SMTPSecure = "tls"; 
                                $mailAC->Port = 587;               
                                $mailAC->SetFrom("envios@lomas-travel.com", $m["mail_titulo"]);

                                /*$mailAC->AddAddress("iris.flores@assistcard.com");
                                $mailAC->AddCC("egonzalez@dexabyte.com.mx");
                                $mailAC->AddCC("contratos@lomas-travel.com", "Contratos Lomas Travel");
                                $mailAC->AddBCC("lcaballero@dexabyte.com.mx");*/
                                
                                // Produccion
                                $link = "http://www.lomastravel.com.mx/extras/asistencia.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);
                                // Pruebas
                                //$link = "http://lomasmx.dev/extras/asistencia.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);
                                //print_r($link);
                                $info = file_get_contents($link);
                                $mailAC->AddBCC("icanul@dexabyte.com.mx","Correo Prueba Extras");
                                $mailAC->Subject = $m["mail_titulo"];
                                $mailAC->MsgHTML($info);
                                $mailAC->Send();                
                            }               
                        }
                    }           
                    

                    
                    
                    $this->pageBase = true;
                    
                    $_Tarjeta = new Tarjeta;
                    $_Tarjeta->tarjeta_cliente = $clientId;
                    $_Tarjeta->tarjeta_venta = $Venta->venta_id;
                    $_Tarjeta->Ecom_Payment_Name = $_REQUEST["titular"];
                    $_Tarjeta->Ecom_Payment_Card_Number = $_REQUEST["numero"];
                    $_Tarjeta->Ecom_Payment_Card_Month = "0";
                    $_Tarjeta->Ecom_Payment_Card_Year = "0";
                    
                    //$_Tarjeta->tipo_pago = 1; //otros santander visa
                    $_Tarjeta->save();
                                    //print_r($_REQUEST["numero"]);

                    $_vV = Venta::model()->findByPk($Venta->venta_id);
                    $_vV->venta_total = $total;
                    $_vV->venta_estt = $status;
                    $_vV->venta_user_id = $clientId;
                    $_vV->venta_authcode = $auth;
                    $_vV->venta_autorizador = $authCode;
                    $_vV->tipo_pago = 2;
                    
                    //todo lo que venga de santander u otros
                    if ($_SESSION["id_agente"] != "") {
                        $_vV->venta_agente_id = $_SESSION["id_agente"];
                         //guardo el id del agente si contiene login                        
                    }

                    $_vV->save();

                    /*print_r("<pre>");
                    print_r($Card->card_mail);                
                    exit();*/                    
                    $vende_hotel=false;
                    foreach ($_Productos as $v) {
            
                        //cuando el producto es un tour 
                        if ($v->descripcion_tipo_producto == 2) {
                            $_vD = VentaDescripcion::model()->findByPk($v->descripcion_id);
                            $_vD->hotel_huesped = $_REQUEST["hotel_huesped"];
                            $_vD->save();
                        }
            
            
                        //Se agrega papeleta del hotel 20140407
                        if ($v->descripcion_tipo_producto == 1) {
                            $vende_hotel=true;
                            
                            //Nuevo Habitacion extra
                            $_sqlVentaD = "Select descripcion_serialized from venta_descripcion where descripcion_venta = " . $Venta->venta_id;
                            $_vDescrip = VentaDescripcion::model()->findAllBySql($_sqlVentaD);
                            $hab_allotment= unserialize($_vDescrip[0]->descripcion_serialized);
                
                            //Ezequiel 20141229 Descuenta 1 habitacion del inventario extra
                            foreach($hab_allotment[0] as $key=>$info){
                                for($i=0;$i<count($info);$i++){
                                    for($j=0;$j<count($info[$i]);$j++){
                                        $tarifaID=$info[$i][$j]['@attributes']['id'];
                                        $_sqlHab_ext = Yii::app()->dbWeblt->createCommand()->select('tarifa_hab_extra')->from('tarifas')->where("tarifa_id =" . $tarifaID)->queryRow();
                                        $hab_ext = $_sqlHab_ext['tarifa_hab_extra'];                        
                                        
                                        if($hab_ext>0){
                                        $upd_hab = $hab_ext-1;
                                       /* Yii::app()->dbWeblt
                                            ->createCommand("UPDATE tarifas SET tarifa_hab_extra = '".$upd_hab."' WHERE tarifa_id=:tarifa_id")
                                            ->bindValues(array(':tarifa_id' => $tarifaID))
                                            ->execute();*/                            
                                        }
                                    }
                                }
                            }
            
                            $link_papeleta = "http://www.lomastravel.com.mx/preconfirma.html?id=".Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);
                            // Pruebas
                            //$link_papeleta = "http://lomasmx.dev/preconfirma.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);

                            $m["mail_titulo"] = "Lomas Travel | Solicitud de Reservacion | #" . $v->descripcion_id;
                            $mail2 = new PHPMailer(true);
                            $mail2->isSMTP(); 
                            $mail2->Host = "smtp.gmail.com";
                            $mail2->SMTPAuth = true; 
                            $mail2->Username = "envios@lomas-travel.com";
                            $mail2->Password = "r5J8Rg<S";
                            $mail2->SMTPSecure = "tls"; 
                            $mail2->Port = 587;
                            $mail2->SetFrom("envios@lomas-travel.com", $m["mail_titulo"]);
                            
                            if($_Cliente->cliente_email!="icanul@dexabyte.com.mx"){
                            
                               $_contacto = Yii::app()->dbWeblt->createCommand()->select('hotel_contacto_de_reservas_mail')->from('hoteles')->where("hotel_id =" . $v->descripcion_producto_id)->queryRow();
                               //$mail2->AddAddress("analista@lomas-travel.com", "Contratos Lomas Travel");
                               
                               $email_enviar = $_contacto['hotel_contacto_de_reservas_mail'];
                               $lista_email = explode(";", $email_enviar);
                               if (count($lista_email) > 0) {
                                   foreach ($lista_email as $li_email) {
                                       //if (strlen(trim($li_email)) > 0) $mail2->AddCC(trim($li_email));
                                   }
                               }
                               //$mail2->AddCC("analista2@lomas-travel.com", "Contratos Lomas Travel");
                               //$mail2->AddCC("analista3@lomas-travel.com", "Contratos Lomas Travel");
                               //$mail2->AddCC("contratos@lomas-travel.com", "Contratos Lomas Travel");
                               //$mail2->AddCC("webmaster@lomas-travel.com", "Webmaster");
                               $mail2->AddBCC("icanul@dexabyte.com.mx", "Webmaster");
                               
                               $LatamContries = array("mx","mexico");
                               if ($v->descripcion_adultos > 11) {
                                //$mail2->AddCC("groupsmanager@lomas-travel.com", "Gerardo Vald�s");
                               } else {
                                   if (in_array(Yii::app()->GenericFunctions->makeNormal(strtolower($_Cliente->cliente_pais_n)) , $LatamContries)) {
                                       //$mail2->AddCC("afiliados@lomas-travel.com", "Gloria Quezada");
                                   } else {
                                       //$mail2->AddCC("sales@lomas-travel.com", "Ventas Lomas Travel");
                                   }
                               }            
                            
                            }else{
                            $mail2->AddAddress("icanul@dexabyte.com.mx");
                            }
                           $info = file_get_contents($link_papeleta);
                           $mail2->Subject = $m["mail_titulo"];
                           $mail2->MsgHTML($info);
                           $mail2->Send();                  
                           
                            
                            //////////////////////////////////////////////////////////////////////////////
                            //Produccion
                            $link_factura = "http://www.lomastravel.com.mx/factura.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);
                            // Pruebas
                            //$link_factura = "http://lomasmx.dev/factura.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);

                            $m["mail_titulo"] = "Lomas Travel | Solicitud de Factura | #" . $v->descripcion_id;
                            $mail3 = new PHPMailer(true);
                            $mail3->isSMTP(); 
                            $mail3->Host = "smtp.gmail.com";
                            $mail3->SMTPAuth = true; 
                            $mail3->Username = "codireccion@lomas-travel.com";
                            $mail3->Password = "YSTd=C5X";
                            $mail3->SMTPSecure = "tls"; 
                            $mail3->Port = 587;

                            $mail3->SetFrom("codireccion@lomas-travel.com", $m["mail_titulo"]);
                            
                            if($_Cliente->cliente_email!="icanul@dexabyte.com.mx"){
                                $_contacto = Yii::app()->dbWeblt->createCommand()->select('hotel_contacto_administrativo_mail')->from('hoteles')->where("hotel_id =" . $v->descripcion_producto_id)->queryRow();
                                
                                //$mail3->AddAddress("analista@lomas-travel.com", "Contratos Lomas Travel");
                                $email_enviar = $_contacto['hotel_contacto_administrativo_mail'];
                                $lista_email = explode(";", $email_enviar);
                                if (count($lista_email) > 0) {
                                    foreach ($lista_email as $li_email) {
                                        //if (strlen(trim($li_email)) > 0) $mail3->AddCC(trim($li_email));
                                    }
                                }
                                //$mail3->AddCC("analista2@lomas-travel.com", "Contratos Lomas Travel");
                                //$mail3->AddCC("analista3@lomas-travel.com", "Contratos Lomas Travel");
                                //$mail3->AddCC("contratos@lomas-travel.com", "Contratos Lomas Travel");
                                //$mail3->AddCC("webmaster@lomas-travel.com", "Webmaster");
                                //$mail3->AddBCC("lcaballero@dexabyte.com.mx", "Webmaster");
                                //$mail3->AddBCC("facteac@grupolomas.com", "Facturacion");
                                //$mail3->AddBCC("codireccion@lomas-travel.com", "Facturacion");
                                

                            }else{
                                $mail3->AddAddress("icanul@dexabyte.com.mx");
                            }
                            $info = file_get_contents($link_factura);
                            $mail3->Subject = $m["mail_titulo"];
                            $mail3->MsgHTML($info);
                            $mail3->Send();

                        }
                    }           
                //Produccion                
                $link = "http://www.lomastravel.com/voucher.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);
                // Pruebas
                //$link = "http://lomasbeta.dev/voucher.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);                


                $m["mail_titulo"] = "Lomas Travel | Confirmation Letter | #" . $v->descripcion_id;
            
                    if($vende_hotel){
                        //Produccion
                        $link = "http://www.lomastravel.com/booking-request.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);
                        //Pruebas
                        //$link = "http://lomasbeta.dev/booking-request.html?id=" . Yii::app()->GenericFunctions->ProtectVar($v->descripcion_id);
                        $m["mail_titulo"] = "Lomas Travel | Online Booking Request | #" . $v->descripcion_id; 
                    }           
            
                        
                    $mail = new PHPMailer(true);
                    $mail->isSMTP(); 
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true; 
                    $mail->Username = "envios@lomas-travel.com";
                    $mail->Password = "r5J8Rg<S";
                    $mail->SMTPSecure = "tls"; 
                    $mail->Port = 587;
                                
                    $mail->SetFrom("envios@lomas-travel.com", $m["mail_titulo"]);
                    
                    $mail->AddAddress($_Cliente->cliente_email, "Cliente Lomas Travel");
            
                    if($_Cliente->cliente_email!="icanul@dexabyte.com.mx"){

                        $LatamContries = array("mx","mexico");
                        if ($v->descripcion_adultos > 11) {
                            //$mail->AddCC("groupsmanager@lomas-travel.com", "Gerardo Vald�s");
                        } else {
                            if (in_array(Yii::app()->GenericFunctions->makeNormal(strtolower($_Cliente->cliente_pais_n)) , $LatamContries)) {
                                //$mail->AddCC("afiliados@lomas-travel.com", "Gloria Quezada");
                            } else {
                                //$mail->AddCC("sales@lomas-travel.com", "Ventas Lomas Travel");
                            }
                        }
                        //$mail->AddCC("webmaster@lomas-travel.com", "Webmaster");
                        //$mail->AddBCC("lcaballero@dexabyte.com.mx", "Webmaster");
                        if ($v->descripcion_tipo_producto == 1) {
                            //$mail->AddCC("analista@lomas-travel.com", "Contratos Lomas Travel");
                            //$mail->AddCC("analista2@lomas-travel.com", "Contratos Lomas Travel");
                            //$mail->AddCC("analista3@lomas-travel.com", "Contratos Lomas Travel");
                            //$mail->AddCC("contratos@lomas-travel.com", "Contratos Lomas Travel");
                        }
                    
                    }
                    
                    $info = file_get_contents($link);
                    $mail->Subject = $m["mail_titulo"];
                    $mail->MsgHTML($info);
                    $mail->Send();
                        
                    
                    $this->render("exito", array(
                        "_Productos" => $_Productos,
                        "vv_Venta" => $Venta->venta_id,
                        "total" => $total
                    ));

                    unset($_SESSION["config_es"]["token"]);
                    $_SESSION["config_es"]["token"] = Yii::app()->WebServices->getSecureKey(150);
                    print_r("llego hasta aqui ");
            }else{
                print_r("no success");
            }
        }          
    }

    public function actionValidar1() { 

    }    

}
?>