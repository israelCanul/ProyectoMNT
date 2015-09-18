<?php

class DestinationsController extends Controller
{

	public function actionIndex()
	{
		$ciudades=Yii::app()->dbWeblt->CreateCommand("SELECT 
													ciudad_id_code AS codigo,
													ciudad_nombre AS nombre, 
													ciudad_estado_nombre AS estado, 
													ciudad_clave AS clave, 
													ciudad_img AS img 
													FROM ciudades 
													WHERE ciudad_img!=''")->queryAll();

		
		/* enviar las trending notes de Mexico news en la seccio9n de travel*/
		$notasFooter=Yii::app()->GenericFunctions->notasFooter();
		$cs = Yii::app()->getclientScript(); 
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/page/destinations/destinations.css');
		$params=array('notas2'=>$notasFooter,'destinos'=>$ciudades);
		$this->render('index',$params);
	}

	public function actionDestinations(){
		$_hotel   = new Hotel();
		$destinos = $_hotel->getCiudadesMexico();
		$Hoteles  = $_hotel->getHotelsSearch();

		$strDest = "";
		foreach($destinos as $l){
			$strDest .= '{id: "' . $l["ciudad_id"] . '", label : "' .  Yii::app()->GenericFunctions->makeSinAcento($l["ciudad_nombre"]) . '",tipo : "1",categoria:"Destinations"},';
		}
		foreach($Hoteles as $l){
			$strDest .= '{id: "' . $l["hotel_id"] . '", label : "' .  Yii::app()->GenericFunctions->makeSinAcento($l["hotel_nombre"]) . '", keyword: "' . $l["hotel_keyword"] . '", tipo : "2",categoria:"Hotels"},';
		}
		
		echo "[" . substr($strDest,0,-1) . "]";		
		exit();
	}
	public function actionBuscar(){
		
		$nRoom=$_REQUEST['hotelRoom'];
		$configRoom=array();
			
		for ($i=0; $i < $nRoom; $i++) { 
			$numChild=$_REQUEST['hotelChild_'.$i];
			$numAdults=$_REQUEST['hotelAdults_'.$i];
			$childAges=array();
			for ($z=0; $z < $numChild; $z++) { 
				$childAges[]=$_REQUEST['child_'.$i.'_'.$z];
			}
			if($numChild<1){

			}
			$configRoom[]=array('Adults'=>$numAdults,'Childs'=>$numChild,'ChildAges'=>$childAges);
		}		
		$_REQUEST['Room']=$configRoom;
		
		if(isset($_REQUEST["returnToUrl"])){
			
			$url = $_REQUEST["returnToUrl"];
			unset($_REQUEST["returnToUrl"]);
			$_param = http_build_query($_REQUEST);   
		   	$this->redirect($url."?" . $_param);

		}else{

			if( isset($_REQUEST["cCode"]) && isset($_REQUEST["HotelId"]) && isset($_REQUEST["hotel_destination"]) ){
				
				$_SESSION["HotelSearchParams"] = $_REQUEST;

				// Busqueda por Hotel
				if(intval($_REQUEST["cCode"]) == 0 && intval($_REQUEST["HotelId"]) != 0){
					$_REQUEST["hotel_destination"] = urldecode($_REQUEST["hotel_destination"]);
					$_param = http_build_query($_REQUEST);
					$_url 	= $this->createUrl("/destinations/detalle",
						array(
							//"cod"	=> intval($_REQUEST["HotelId"]),
							"hotel" => $_REQUEST["hotel_keyword"]
						)
					);
					$this->redirect($_url."?" . $_param);
				
				// Busqueda por Destino
				}else{
					$_hotel = new Hotel();
					$ciudad = $_hotel->getClaveCiudad($_REQUEST['cCode']);
					$_param = http_build_query($_REQUEST);
					$_url 	= $this->createUrl("/destinations/listar",
						array(
							"clave" => $ciudad
						)
					);
					$this->redirect($_url."?" . $_param);
				}

			}else{
				$this->redirect($this->createUrl("destinations/index"));
			}
		}
	}

	public function actionDetalle(){

		$cs = Yii::app()->getclientScript();
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/fancybox/jquery.fancybox.css?a='. Yii::app()->params['assets']);
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/fancybox/jquery.fancybox-buttons.css?a='. Yii::app()->params['assets']);
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/fancybox/jquery.fancybox-thumbs.css?a='. Yii::app()->params['assets']);
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/destinations/destinations.css');

		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox.pack.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-buttons.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-media.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-thumbs.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);	
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/destinations/destinations.js',CClientScript::POS_END);
		
		//var_dump($_REQUEST["hotel"]); exit();
		$urlCanonical = $this->createUrl("hoteles/detalle",array("hotel" => $_REQUEST["hotel"]));
		Yii::app()->clientScript->registerLinkTag('canonical',"","http://www.lomastravel.com".$urlCanonical);

		$_hotel  = new Hotel();
		//$_banner = new Banner();

		$code 	 = $_REQUEST['hotel'];		
		$hotelId = $_hotel->getHotelIdByKeyword($code);		
		$_REQUEST["HotelId"] = $hotelId;
		


		if(!isset($_REQUEST["hotelCheckin"])){

			if(sizeof($_SESSION["HotelSearchParams"]) > 4){

				$oldRequest = $_REQUEST;
				unset($_SESSION["HotelSearchParams"]["cCode"]);
				$_SESSION["HotelSearchParams"]["HotelId"] = $hotelId;
				$_REQUEST 	= array_merge($_SESSION["HotelSearchParams"],$oldRequest);
				$stopOk 	= $_REQUEST;
				$stopOk["Rooms"] 			 = $_REQUEST["Room"];
				$stopOk["Dates"]["CheckIn"]  = Yii::app()->GenericFunctions->convertUsableDates($stopOk["hotelCheckin"]);
				$stopOk["Dates"]["CheckOut"] = Yii::app()->GenericFunctions->convertUsableDates($stopOk["hotelCheckout"]);
			
			}else{
				$_REQUEST 			= array_merge($_REQUEST,Yii::app()->_Hotels->Config);	
				$_REQUEST["hotelRoom"] 	= $_REQUEST["hotelRoom"];
				$stopOk 			= $_REQUEST;
				//print_r($stopOk);
				
			}
			
		}else{
			
			$oldRequest 	= $_REQUEST;
			unset($_SESSION["HotelSearchParams"]["cCode"]);
			$_SESSION["HotelSearchParams"]["HotelId"] = $hotelId;
			$_REQUEST 		= array_merge($_SESSION["HotelSearchParams"],$oldRequest);
			
			$stopOk = $_REQUEST;
			$stopOk["Rooms"] =$_REQUEST['Room'];
			$stopOk["Dates"]["CheckIn"] = Yii::app()->GenericFunctions->convertUsableDates($stopOk["hotelCheckin"]);
			$stopOk["Dates"]["CheckOut"] = Yii::app()->GenericFunctions->convertUsableDates($stopOk["hotelCheckout"]);

		}
		
		//Validacion para dos dias de diferencia 
		$minBook =  strtotime ( '+2 day' , strtotime ( date('Y-m-j') ) ) ;
		if ($minBook >  strtotime($stopOk["Dates"]["CheckIn"])) {
			$stopOk["Dates"]["CheckIn"] = date('Y-m-d',$minBook );
			$stopOk["hotelCheckin"] = date('m/d/Y',$minBook );
			$_REQUEST = $stopOk;
		}
		

		Yii::app()->_Hotels->Config = $stopOk;
		//print_r(Yii::app()->_Hotels->Config);
		$wsdl 	 = Yii::app()->_Hotels->WSDL;
		//print_r(Yii::app()->_Hotels);				
		$Rooms 	 = Yii::app()->_Hotels->Config["Rooms"];
		$Hoteles = array();
		
		unset(Yii::app()->_Hotels->Config["Rooms"]);

		/*print_r($Rooms);
		exit();*/
		foreach($Rooms as $r){
			Yii::app()->_Hotels->Config["Rooms"][0] = $r;
			$xml 		= Yii::app()->_Hotels->wsGetById($hotelId);
			$iService 	= Yii::app()->WebServices->consumeServiceXML($wsdl,$xml);
			array_push($Hoteles, $iService->SearchHotelsByIDResult->HotelList->Hotel);			
		}	
		
		Yii::app()->_Hotels->Config["Rooms"] = $Rooms;
		
		if(isset($_REQUEST["debug"])){
			echo "<pre>";
				print_r($iService);
			echo "</pre>";
			exit();
			die(0);
		}

		$Hotel 	= $Hoteles[0];  
		//Se valida que tenga dos dias de diferencia a la fecha actual 
		$TarifasBloquedas = false;
		$dateBook 		  = date("m/d/Y", strtotime($stopOk["Dates"]["CheckIn"]));
		$fechaActual 	  = date("m/d/Y");
		
		$_diasReserva 	  = Yii::app()->GenericFunctions->difDays($dateBook,$fechaActual);
		if($_diasReserva<2){
			$TarifasBloquedas = true;
		}
		
		$_REQUEST["hotel_destination"] = (string) $Hotel->attributes()->name;
		
		
		$x 		= 0;
		$photos = array();
		$photos['visibles'] = array();
		$photos['other'] 	= array();
		
		if(sizeof($Hotel->Media->Images->Image) > 0){
			foreach($Hotel->Media->Images->Image as $_i){
				if($x == 0){
					$photos['mainPhoto'] = (string) $_i['path'];
				}elseif($x >= 1 && $x <= 4){
					array_push($photos['visibles'], (string) $_i['path']);
				}else{
					array_push($photos['other'], (string) $_i['path']);
				}
			$x++;	
			}
		}
		
		$HotelVisto = array(
			"Nombre" 		=> (string) utf8_decode($Hotel->attributes()->name),
			"HotelId" 		=> (int) $Hotel->attributes()->hotelId,
			"PrecioNoche" 	=> (((float) ($Hotel->attributes()->minAverPrice) == 0) ? 99999 : (float) ($Hotel->attributes()->minAverPrice)),
			"thumb" 		=> (string) utf8_decode($Hotel->attributes()->thumb),
			"city" 			=> (string) utf8_decode($Hotel->Location->attributes()->city),
			"CheckIn" 		=> date('D, M d', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckIn"])),
			"CheckOut" 		=> date('D, M d', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckOut"]))
		);

		$existe = "";
		for($x = 0; $x < count($_SESSION["hotelesVistos"]);$x++) {
			 if($HotelVisto["HotelId"] == $_SESSION["hotelesVistos"][$x]['HotelId']){
				$existe = "Si";
				continue;
			} 
		}
		
		if($_SESSION["hotelesVistos"] == "" && $existe == ""){
			$_SESSION["hotelesVistos"] = $HotelVisto;
			array_push($_SESSION["hotelesVistos"], $HotelVisto);
		}else if($existe == ""){
			array_push($_SESSION["hotelesVistos"], $HotelVisto);
		}
		
		$_RoomH = $_hotel->getDescriptionRooms();
        $_RoomC = $_hotel->getCapacityRooms();
        $_HL 	= $_hotel->getBenefitsHotel();
        $_HA 	= $_hotel->getActivitiesHotel();
		$_PM 	= $_hotel->getDealsHotel(); 
		//$_BannersLaterales = $_banner->getBannersLaterales();
		
		
		$this->render('detalle',array(
			"Hoteles" 	=> $Hoteles, 
			"_RoomH" 	=> $_RoomH,
			"_RoomC" 	=> $_RoomC,
			"_HL" 		=> $_HL,
			"_PM"  		=> $_PM,
			"_HA" 		=> $_HA,
			"photos" 	=> $photos,
			"_BannersLaterales" => $_BannersLaterales)
		);
	}

	public function actionListar(){

		if(isset($_REQUEST["clave"])){
			$cs = Yii::app()->getclientScript();
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/responsiveslides/responsiveslides.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-core.min.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-pagination-bundle.min.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-history-bundle.min.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-textbox-control.min.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-jquery-ui-bundle.min.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-filter-toggle-bundle.min.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/destinations/destinations.css');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/jquery-ui.css');

			
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/responsiveslides/responsiveslides.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist-core.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.sort-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.pagination-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.history-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.textbox-control.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.jquery-ui-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.filter-toggle-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/destinations/destinations.js',CClientScript::POS_END);	
			//$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/destinations/destinations_filtrer.js',CClientScript::POS_END);		
					
			
			$_hotel  = new Hotel();

			$esDestino 	 = $_hotel->esDestino($_REQUEST["clave"]);
			$esInteres 	 = $_hotel->esInteres($_REQUEST["clave"]);

			if(!isset($_SESSION["iServices"])){
				$_SESSION["iServices"] = array();			
			}
			
			if(!isset($_SESSION["iServices"]["Hoteles"])){
				$_SESSION["iServices"]["Hoteles"] = array();			
			}
			
			if(isset($_REQUEST["hotelCheckin"]) && isset($_REQUEST["hotel_checkout"])){
				Yii::app()->_Hotels->chDates(Yii::app()->GenericFunctions->convertUsableDates($_REQUEST["hotelCheckin"]),Yii::app()->GenericFunctions->convertUsableDates($_REQUEST["hotel_checkout"]));
			}
			
			if(isset($_REQUEST["Room"])){
				Yii::app()->_Hotels->Config["Rooms"] = $_REQUEST["Room"];
			}			

			//Destino
			if($esDestino){
				$_dInfo = $_hotel->getCiudad($_REQUEST["clave"]);
				//var_dump($_dInfo); //exit();
		
		
				$_REQUEST["cCode"] 				= $_dInfo["ciudad_id"];
				$_REQUEST["hotel_destination"] 	= Yii::app()->GenericFunctions->makeSinAcento($_dInfo["ciudad_nombre"]);
				
				Yii::app()->_Hotels->setDes(intval($_dInfo["ciudad_id"]));
				

				$_XML = Yii::app()->_Hotels->wsGetByDestination();
				$urlCanonical = $this->createUrl("destinations/listar",array("clave" => $_REQUEST["clave"]));
				//print_r($_REQUEST);
				
			// Interés
			}else{

				$_REQUEST["hotel_category"] 	= $_hotel->getCategoryHotel($_REQUEST["clave"]);
				$_dInfo = $_hotel->getIdInteres($_REQUEST["clave"]);
				$_XML 	= Yii::app()->_Hotels->wsGetByTipoHotel($_dInfo['tipo_id']);
				$urlCanonical = $this->createUrl("destinations/listar",array("clave" => $_REQUEST["clave"]));
			}

			Yii::app()->clientScript->registerLinkTag('canonical',"",Yii::app()->params['baseUrl']. $urlCanonical);
			$ExistSearch = Yii::app()->WebServices->findSessionHotel($_SESSION["iServices"]["Hoteles"],$_REQUEST);
		
			if(empty($ExistSearch)){
				$wsdl = Yii::app()->_Hotels->WSDL;
				$xml = $_XML;
				//$iService = Yii::app()->WebServices->consumeServiceXML($wsdl,$xml);
				//$Hoteles = $iService->SearchHotelsByIDResult->HotelList;	

				$Rooms 	 = Yii::app()->_Hotels->Config["Rooms"];
				$Hoteles = array();
				unset(Yii::app()->_Hotels->Config["Rooms"]);
		

				foreach($Rooms as $r){
					Yii::app()->_Hotels->Config["Rooms"][0] = $r;
						//Destino
						if($esDestino){
							$_dInfo = $_hotel->getCiudad($_REQUEST["clave"]);
							
							$_REQUEST["cCode"] 				= $_dInfo["ciudad_id"];
							$_REQUEST["hotel_destination"] 	= $_dInfo["ciudad_nombre"];					
							
							Yii::app()->_Hotels->setDes($_dInfo["ciudad_id"]);
							$_XML = Yii::app()->_Hotels->wsGetByDestination();
							
						//Interés	
						}else{
							$_dInfo = $_hotel->getIdInteres($_REQUEST["clave"]);
							$_XML = Yii::app()->_Hotels->wsGetByTipoHotel($_dInfo['tipo_id']);
						}

					$xml  = $_XML;
					$iService = Yii::app()->WebServices->consumeServiceXML($wsdl,$xml);
					/*print_r($iService);
					exit();*/
					array_push($Hoteles, $iService->SearchHotelsByIDResult->HotelList);
					Yii::app()->_Hotels->Config["Rooms"] = $Rooms;
				}							
	
				if(sizeof($Hoteles) > 0){
					$nIndex = Yii::app()->WebServices->getKey(10);
					if(isset($_SESSION["iServices"]["Hoteles"][$nIndex])){
						$nIndex = Yii::app()->WebServices->getKey(11);
					}
					$_Cr = $nIndex;
				}

			}else{
				$_Cr = $ExistSearch;
				$Hoteles = $_SESSION["iServices"]["Hoteles"][$ExistSearch]["Hoteles"];
			}

            $_RoomH =  $_hotel->getDescriptionRooms();	// Descripcion de la Habitacion
            $_RoomC =  $_hotel->getCapacityRooms(); 	// Capacidad por Habitacion
            $_HL 	=  $_hotel->getBenefitsHotel();		// Beneficion del Hotel
            $_PM 	=  $_hotel->getDealsHotel();   		// Promocion Descripcion
            
			
			$this->render('lista',array(
				"_Htls" 	=> $Hoteles,
				"_Cr" 		=> $_Cr,
				"_RoomH" 	=> $_RoomH,
				"_RoomC" 	=> $_RoomC,
				"_HL" 		=> $_HL,
				"_PM" 		=> $_PM				
				)
			);
		
		}else{
			$this->redirect($this->createUrl("/destinations"));
		}
	}

	public function actionAgregar(){


		if(isset($_REQUEST["jnfe"])){

			$Parameters = unserialize(Yii::app()->GenericFunctions->ShowVar($_REQUEST["pgR"]));
			$ParametersNative = unserialize(Yii::app()->GenericFunctions->ShowVar($_REQUEST["pgR"]));


			foreach($Parameters as $k=>$v){
				if(!is_array($v)){
					$Parameters[$k] = urldecode($v);
				}else{
					$Parameters[$k] = ($v);
				}

			}

			if(isset($_REQUEST["promo_id"]))
				$promo_id = $_REQUEST["promo_id"];
			else
				$promo_id = "";

			if(isset($_REQUEST["promo_name"]))
				$promo_name = $_REQUEST["promo_name"];
			else
				$promo_name  = "";

			if(isset($_REQUEST["promo_seg"]))
				$promo_seg = $_REQUEST["promo_seg"];
			else
				$promo_seg  = "";



			if(isset($_REQUEST["valor_agregado"]))
				$valor_agregado = $_REQUEST["valor_agregado"];
			else
				$valor_agregado = "";

			$_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
			$_vValidator = Venta::model()->findAllBySql($_sql);

			if( !($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "")){
				$Venta = $_vValidator[0]->venta_id;
			}else{
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


			$data = explode("@@",Yii::app()->GenericFunctions->ShowVar($_REQUEST["jnfe"]));

			$t = new VentaDescripcion;
			$adultos = 0;
			$menores = 0;
			$alreadyHaveRoom = false;

			if(!$alreadyHaveRoom && isset($Parameters["Room"])){
				foreach($Parameters["Room"] as $Room){
					$adultos = $adultos + $Room["Adults"];
					$menores = $menores + $Room["Childs"];
				}
				$alreadyHaveRoom = true;
			}

			if(!$alreadyHaveRoom && isset($Parameters["Rooms"])){
				foreach($Parameters["Rooms"] as $Room){
					$adultos = $adultos + $Room["Adults"];
					$menores = $menores + $Room["Childs"];
				}
				$alreadyHaveRoom = true;
			}


			$t->descripcion_producto = (Yii::app()->GenericFunctions->makeSinAcento($data[3]));
			$t->descripcion_destino = 1;
			$t->descripcion_brief = addslashes($data[5]);
			$t->descripcion_tarifa = $data[2];
			$t->descripcion_venta = $Venta;
			$t->descripcion_fecha = date("Y-m-d H:i:s");
			$t->descripcion_fecha1 = $Parameters["Dates"]["CheckIn"];
			$t->descripcion_fecha2 = $Parameters["Dates"]["CheckOut"];
			$t->descripcion_adultos = $adultos;
			$t->descripcion_menores = $menores;
			$t->descripcion_infantes = 0;
			$t->descripcion_cuartos = ((isset($Parameters["Room"])) ? sizeof($Parameters["Room"]) : sizeof($Parameters["Rooms"]));
			$t->descripcion_precio = $data[4];
			$t->descripcion_total = (str_replace(",","",$data[4]) * 1);
			$t->descripcion_tipo_producto = 1;
			$t->descripcion_tarifa_id = $data[0];
			$t->descripcion_producto_id = $data[1];
			$t->descripcion_servicio_id = $data[6] . ";" . $data[7];
			$t->descripcion_thumb = $data[8];
			$t->descripcion_add_val_1 = $data[9];
			$t->descripcion_add_val_2 = $data[10];
			$t->descripcion_serialized = base64_decode($data[11]);
			$t->descripcion_reservable = 1;
			$t->descripcion_pagado = 0;
			$t->descripcion_promo_id = $promo_id;  //guardo la promo
			$t->valor_agregado = $valor_agregado;
			$t->descripcion_promo_name = $promo_name;	//guarda el valor agregado Texto Opcional
			$t->descripcion_seg = substr($promo_seg,1);	//guarda valor de ofertas
			$t->descripcion_seg_tipo = substr($promo_seg,0,1);	//guarda valor del tipo de ofertas
			//$t->save();

			if ($t->save()) {
				$hotel = $hotelInfo = Yii::app()->dbWeblt->createCommand()
					->select('hotel_ciudad, hotel_transportacion_zona')
					->from('hoteles')
					->where("hotel_id = :id", array(
						":id" => intval($data[1])
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
					->where("tarifa_transportacion = :id and tipo_roundtrip = '1' AND tipo_id IN (2)", array(
						":id" => $Traslado["transportacion_id"]
					))
					->order("tipo_group ASC, tarifa_precio ASC")
					->queryRow();

				$p = intval($adultos) + intval($menores);


				if (count($_Tarifas) > 0 ) {
					$tPax = $p;
					$ta = $_Tarifas;
					if($tPax>=$ta["tarifa_cap_ini"] && $tPax <= $ta["tarifa_cap_fin"]){
						$total = number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$ta["tarifa_precio"]),0,".","");
					}else{
						if($ta["tarifa_tipo"]==1 || $ta["tarifa_tipo"]==2 || $ta["tarifa_tipo"]==3 || $ta["tarifa_tipo"]==4){
							if($tPax > $ta["tarifa_cap_fin"]){
								$ta["tarifa_precio"] = $ta["tarifa_precio"] + (($tPax - $ta["tarifa_cap_fin"]) * $ta["tarifa_pax_ext"]);
							}
							$total = number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$ta["tarifa_precio"]),0,".","");
						}else{

						}
					}

					$jnfe           = Yii::app()->GenericFunctions->ProtectVar($ta["tarifa_id"] . "@@" . $ta["tarifa_tipo"] . "@@" . $ta["tarifa_transportacion"] . "@@" . $total . "@@" . 'Cancun Airport' . "@@" . $data[3] . "@@" . $ta["tipo_nombre_" . Yii::app()->language] . "@@/images/traslados/" . $ta["tipo_imagen"] . ".jpg@@" . 1);
					$tipo_translado = 2;

					$transfer_FechaIN = date_create($Parameters["Dates"]["CheckIn"]);
					$transfer_FechaOUT = date_create($Parameters["Dates"]["CheckOut"]);
					$pgr = array(
						'transfer_from_id' => 1,
						'transfer_to_id'   => $data[1].":".$hotel['hotel_transportacion_zona'],
						'transfer_arrival' => date_format($transfer_FechaIN, 'm/d/Y'),
						'transfer_return'  => date_format($transfer_FechaOUT, 'm/d/Y'),
						'transfer_adults'  => $adultos,
						'transfer_child'   => $menores
					);

					$params  = array(
						'jnfe'           => $jnfe,
						'tipo_translado' => $tipo_translado,
						'pgR'            => Yii::app()->GenericFunctions->ProtectVar(serialize($pgr)),
						'chekoutTransfer' => '1'
					);
					//print_r( explode("@@", Yii::app()->GenericFunctions->ShowVar($jnfe)));
					$this->redirect('/traslados/agregar?'.http_build_query($params));
					exit();
				}

			}
			$this->redirect(array("checkout/index"));
			exit();
		}else{
			$this->redirect(array("hoteles/index"));
		}
	}


	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}		

}
?>