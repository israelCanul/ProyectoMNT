<?php

class ActivitiesController extends Controller
{
	public function actionIndex()
	{
		$_act 	= new Activities();
		$_destinos 	 = $_act->getActivityDestinations();
		$_categorias = $_act->getActivityCategories();
		/*print_r($_destinos);
		exit();*/


		$params=array(
			"_destinos" 	=> $_destinos,
			'_categorias' => $_categorias,
			'destinos'=>$ciudades);
		$cs = Yii::app()->getclientScript(); 
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/page/activities.css');	
		$this->render('index',$params);
	}

	/**************************************************************************************************/
	public function actionDestinations(){		

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

	public function actionBuscarTours(){
		 $_REQUEST['lan']=Yii::app()->language;
		$_REQUEST['moneda']=$_SESSION["config_es"]["currency"]; 


		switch($_REQUEST['tipo']){
			case 'destination':
				$this->redirect($this->createUrl("activities/findByDest",$_REQUEST));break;
			case 'category':
				$this->redirect($this->createUrl("activities/findByCat",$_REQUEST));break;
			case 'supplier':
				$this->redirect($this->createUrl("activities/findBySup",$_REQUEST));break;
			case 'tour':
				$this->redirect($this->createUrl("activities/detalleTour",$_REQUEST));break;
		}

	}

	public function actionFindByDest(){

		/*print_r($_REQUEST);
		exit();*/
		$fecha=explode("/", $_REQUEST['tour-Checkin']);
		$fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];

		
		$tours= file_get_contents(Yii::app()->params['api']."/RestTours/ListByZona/".$_REQUEST['dest'].".html?date=".$fecha."&lan=".$_REQUEST['lan']."&moneda=".$_REQUEST['moneda']."&ninos=0&adults=2");
		$dataUrl="tour-Checkin=".$_REQUEST['tour-Checkin']."&tour_adults=".$_REQUEST['tour_adults']."&tour_child=".$_REQUEST['tour_child']."&lan=".$_REQUEST['lan']."&moneda=".$_REQUEST['moneda'];

		Yii::app()->GenericFunctions->scriptsTours();
		$this->render('listTours',array("tours"=>$tours,'dataUrl'=>$dataUrl,"tour_fecha"=>$_REQUEST['tour-Checkin']));
	}

	public function actionFindByCat(){

		$fecha=explode("/", $_REQUEST['tour-Checkin']);
		$fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];

		$tours= file_get_contents(Yii::app()->params['api']."/RestTours/ListByCat/".$_REQUEST['cat'].".html?date=".$fecha."&lan=".$_REQUEST['lan']."&moneda=".$_REQUEST['moneda']."&ninos=0&adults=2");
		$dataUrl="tour-Checkin=".$_REQUEST['tour-Checkin']."&tour_adults=".$_REQUEST['tour_adults']."&tour_child=".$_REQUEST['tour_child']."&lan=".$_REQUEST['lan']."&moneda=".$_REQUEST['moneda'];

		Yii::app()->GenericFunctions->scriptsTours();
		$this->render('listTours',array("tours"=>$tours,'dataUrl'=>$dataUrl,"tour_fecha"=>$_REQUEST['tour-Checkin']));

	}
	public function actionFindBySup(){

		// fechas
		$fechaTem=explode("/", $_REQUEST['tour-Checkin']);
		$fechaTem=$fechaTem[2]."-".$fechaTem[1]."-".$fechaTem[0];

		// url y data para los tours
		$tours= file_get_contents(Yii::app()->params['api']."/RestTours/ListBySup/".$_REQUEST['sup'].".html?date=".$fechaTem."&lan=".$_REQUEST['lan']."&moneda=".$_REQUEST['moneda']."&ninos=0&adults=2");
		$dataUrl="tour-Checkin=".$_REQUEST['tour-Checkin']."&tour_adults=".$_REQUEST['tour_adults']."&tour_child=".$_REQUEST['tour_child']."&lan=".$_REQUEST['lan']."&moneda=".$_REQUEST['moneda'];

		// se importan los css y js de react
		Yii::app()->GenericFunctions->scriptsTours();

		$this->render('listTours',array("tours"=>$tours,'dataUrl'=>$dataUrl,"tour_fecha"=>$_REQUEST['tour-Checkin']));
	}

	public function actionDetalleTour(){
		
		// fechas
		$fechaTem=explode("/", $_REQUEST['tour-Checkin']);
		$fechaTitulo=$fechaTem[0]."/".$fechaTem[1]."/".$fechaTem[2];
		$fechaTem=$fechaTem[2]."-".$fechaTem[1]."-".$fechaTem[0];

		// url y data para los tours
		$tours= file_get_contents(Yii::app()->params['api']."/RestTours/tour/".$_REQUEST['TourId'].".html?date=".$fechaTem."&lan=".$_REQUEST['lan']."&moneda=".$_REQUEST['moneda']."&ninos=".$_REQUEST['tour_child']."&adults=".$_REQUEST['tour_adults']);
		$dataUrl="tour-Checkin=".$_REQUEST['tour-Checkin']."&tour_adults=".$_REQUEST['tour_adults']."&tour_child=".$_REQUEST['tour_child']."&lan=".$_REQUEST['lan']."&moneda=".$_REQUEST['moneda'];
		/*print_r("<pre>");
		print_r($tours);
		exit();*/
		// se importan los css y js de react
		Yii::app()->GenericFunctions->scriptsTour();

		$this->render('tour',array("tours"=>$tours,'dataUrl'=>$dataUrl,"tour_fecha"=>$_REQUEST['tour-Checkin'],"fechaTitulo"=>$fechaTitulo));
	}

	public function actionBuscar(){

		$_act = new Activities();

		if(intval($_REQUEST["TourId"]) == 0 ){

			// Es proveedor
			if(intval($_REQUEST["ProveedorId"] > 0)) {
				$code = $_act->getSupplierCodeById($_REQUEST["ProveedorId"]);

			}else{

				// Es Categoria
				if($_REQUEST['isTourCategory']){
					$code = $_act->getCategoryCodeByName($_REQUEST['tour_destination']);

					// Es Destino
				}else{
					$code = $_act->getDestinationCodeByName($_REQUEST['tour_destination']);
				}
			}

			$this->redirect($this->createUrl("activities/listar", array(
					'code' 		 	 => $code,
					'tour_fecha' 	 => $_REQUEST["tour_fecha"],
					'tour_adults' 	 => $_REQUEST["tour_adults"],
					'tour_childs' 	 => $_REQUEST["tour_childs"])
			/*'TourId' 		 => $_REQUEST["TourId"],
            'ProveedorId' 	 => $_REQUEST["ProveedorId"],
            'isTourCategory' => $_REQUEST["isTourCategory"])*/
			));

			// Es Tour
		}else{
			////////////////////////////////////////////////////////
			//Cuando llega de la pagina de checkout
			///////////////////////////////////////////////////////
			$activity 		= $_act->getActivityById($_REQUEST["TourId"]);
			$checkout_tour 	= (isset($_REQUEST['checkout_tour'])) ? $_REQUEST['checkout_tour'] : '';

			$tParams = array(
				"dest" 			=> $activity["destino_clave"],
				"prod" 			=> $activity["url"],
				"tour_fecha"  	=> $_REQUEST["fecha"],
				"tour_adults" 	=> $_REQUEST["tour_adults"],
				"tour_childs" 	=> $_REQUEST["tour_childs"],
				"checkout_tour" => $checkout_tour
			);

			$this->redirect($this->createUrl("activities/detalle",$tParams));

		}
	}

	public function actionListar(){
		if(isset($_REQUEST["code"])){
			$code = $_REQUEST["code"];
			$_act 			= new Activities();
			$isDestination	= $_act->isDestination($code);
			$isInterest 	= $_act->isInterest($code);
			$isSupplier 	= $_act->isSupplier($code);

			if(!$isDestination && !$isInterest && !$isSupplier){
				$this->redirect($this->createUrl("activities/index"));
			}else{
				$cs= Yii::app()->getclientScript();
				$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/responsiveslides/responsiveslides.css?a='. Yii::app()->params['assets'],'screen, projection');
				$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-core.min.css?a='. Yii::app()->params['assets'],'screen, projection');
				$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-pagination-bundle.min.css?a='. Yii::app()->params['assets'],'screen, projection');
				$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-jquery-ui-bundle.min.css?a='. Yii::app()->params['assets'],'screen, projection');
				$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/activities/activities.css?a='. Yii::app()->params['assets'],'screen, projection');

				$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/responsiveslides/responsiveslides.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
				$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist-core.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
				$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.sort-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
				$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.pagination-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
				$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.jquery-ui-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
				$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/activities/activities-list.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);

				$urlCanonical = $this->createUrl("tours/listar", array("code" => $code));
				Yii::app()->clientScript->registerLinkTag('canonical',"","http://www.lomastravel.com".$urlCanonical);


				$tour_fecha		= (isset($_REQUEST["tour_fecha"])  ) ? $_REQUEST["tour_fecha"] : date("m/d/Y",mktime(0,0,0,date("m"),date("d")+3,date("Y"))) ;
				$pax_adulto 	= (isset($_REQUEST['tour_adults']) )? $_REQUEST["tour_adults"] : 2;
				$pax_menor 		= (isset($_REQUEST["tour_childs"]) ) ? $_REQUEST["tour_childs"] :  0;

				if($isDestination){
					$destination = $_act->getDestinationByCode($code);
					$Tours 		 = $_act->getActivitiesByDestination($destination["id"], $tour_fecha);
					$_REQUEST['tour_destination'] 	= $destination['nombre'];
					$_REQUEST['dest'] 				= $Tours[0]['destino_clave'];
					unset($_REQUEST['TourId']);
					unset($_REQUEST['ProveedorId']);
					unset($_REQUEST['isTourCategory']);
				}else{
					if($isInterest){
						$interest	 = $_act->getInterestByCode($code);

						$Tours 		 = $_act->getActivitiesByCategory($interest["id"], $tour_fecha);
						$_REQUEST['tour_destination'] 	= $interest['nombre'];

						$_REQUEST['isTourCategory']		= $Tours[0]['categoria_id'];
						unset($_REQUEST['TourId']);
						unset($_REQUEST['ProveedorId']);
						unset($_REQUEST['dest']);
					}else{
						$supplier	 = $_act->getSupplierByCode($code);
						$Tours 		 = $_act->getActivitiesBySupplier($supplier["proveedores_id"], $tour_fecha);
						$_REQUEST['tour_destination'] 	= $supplier['proveedores'];
						$_REQUEST['ProveedorId']		= $supplier['proveedores_id'];
						unset($_REQUEST['TourId']);
						unset($_REQUEST['isTourCategory']);
						unset($_REQUEST['dest']);
					}
				}

				$ToursGal 	 = array(0);
				$ToursId 	 = array(0);
				$Fotos 		 = array(0);
				$_Categorias = array(0);
				foreach($Tours as $p){
					if($p["tour_galeria"] != "" && intval($p["tour_galeria"]) != 0){
						array_push($ToursGal,intval($p["tour_galeria"]));
					}
					array_push($ToursId,$p["tour_id"]);
				}

				$Categorias =  $_act->getCategoriesByActivity($ToursId);
				$Imagenes 	=  $_act->getPhotosByActivity($ToursGal);

				foreach($Categorias as $_cat){
					if(!isset($_Categorias[$_cat["categorias_tour"]])){
						$_Categorias[$_cat["categorias_tour"]] = array();
					}
					array_push($_Categorias[$_cat["categorias_tour"]],$_cat);
				}
				foreach($Imagenes as $img){
					if(!isset($Fotos[$img["foto_galeria"]])){
						$Fotos[$img["foto_galeria"]] = $img["foto_archivo"];
					}
				}

				$nIndex = Yii::app()->WebServices->getKey(11);
				$_Cr 	= $nIndex;

				$this->render("listar", array(
						"_Tours"	 => $Tours,
						"Fotos"		 => $Fotos,
						"_Cr" 		 => $_Cr,
						"Categorias" => $_Categorias,
						"tour_fecha" => $tour_fecha,
						"pax_adulto" => $pax_adulto,
						"pax_menor"  => $pax_menor
					)
				);
			}
		}else{
			$this->redirect($this->createUrl("tours/index"));
		}
	}

	public function actionDetalle(){
		$_act = new Activities();
		$Tour = $_act->getActivityByCode($_REQUEST["prod"]);

		if(intval($Tour["tour_id"]) != 0){
			$cs = Yii::app()->getclientScript();
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/fancybox/jquery.fancybox.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/fancybox/jquery.fancybox-buttons.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/fancybox/jquery.fancybox-thumbs.css?a='. Yii::app()->params['assets'],'screen, projection');
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/activities.min.css?a='. Yii::app()->params['assets'],'screen, projection');

			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox.pack.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-buttons.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-media.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-thumbs.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/activities-detail.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);

			$urlCanonical = $this->createUrl("tours/detalle",array("dest"=>$_REQUEST["dest"], "prod"=>$_REQUEST["prod"]));
			Yii::app()->clientScript->registerLinkTag('canonical',"","http://www.lomastravel.com".$urlCanonical);

			$_Categorias = array();
			$Categorias  = $_act->getCategoriesByActivity($Tour["tour_id"]);
			foreach($Categorias as $_cat){
				if(!isset($_Categorias[$_cat["categorias_tour"]])){
					$_Categorias[$_cat["categorias_tour"]] = array();
				}
				array_push($_Categorias[$_cat["categorias_tour"]],$_cat);
			}

			/* Validacion para el tour 1457 que no acepta adultos  */
			if ($Tour["tour_id"] == 1457) {
				$_REQUEST["tour_adults"] = 0;
				$_REQUEST["tour_childs"] = 1;
			}else{
				if ($_REQUEST["tour_adults"] <= 0) {
					$_REQUEST["tour_adults"] = 2;
				}
			}

			//Informacion para auto llendo del formulario del booking
			$_ad 	= (isset($_REQUEST["tour_adults"]) ? $_REQUEST["tour_adults"] : (isset($_REQUEST["pax_adulto"]) ? $_REQUEST["pax_adulto"] : 2));
			$_mn 	= (isset($_REQUEST["tour_childs"]) ? $_REQUEST["tour_childs"] : (isset($_REQUEST["pax_menor"]) ? $_REQUEST["pax_menor"] : 0));
			$_fecha = (isset($_REQUEST["tour_fecha"]) ? Yii::app()->GenericFunctions->convertUsableDates($_REQUEST["tour_fecha"]) : date("Y-m-d",mktime(0,0,0,date("m"),date("d")+3,date("Y"))) );
			$_REQUEST['tour_fecha'] 		= date('m/d/Y', strtotime($_fecha));

			//print_r($_REQUEST);
			$_REQUEST['tour_adults'] 		= $_ad;
			$_REQUEST['tour_childs'] 		= $_mn;

			$_REQUEST['TourId'] 			= $Tour["tour_id"];
			$_REQUEST['tour_destination'] 	= $Tour['tour_nombre'];
			unset($_REQUEST['dest']);
			unset($_REQUEST['ProveedorId']);
			unset($_REQUEST['isTourCategory']);

			$minBook =  strtotime ( '+2 day' , strtotime ( date('Y-m-j') ) );
			if ($minBook >  strtotime($_fecha)) {
				$_fecha = date('Y-m-d',$minBook );
				$_REQUEST['tour_fecha'] = date('m/d/Y',$minBook );
			}

			$Connection = Yii::app()->db;
			$sql = "Select * from tour_tarifa inner join tour_servicio on tarifa_servicio = servicio_id where tarifa_tour = '" . $Tour["tour_id"] . "'  and tarifa_fecha_inicio <= '" . $_fecha . "'  and tarifa_fecha_final >= '" . $_fecha . "'  AND tarifa_tipo_tarifa=1 ";
			$Command = $Connection->createCommand($sql);
			$Tarifas = $Command->queryAll();

			//Se buscan tarifas en pesos en caso de que no se encuentren tarifas en dolares
			if (sizeof($Tarifas) <= 0) {
				$sql = "Select * from tour_tarifa inner join tour_servicio on tarifa_servicio = servicio_id where tarifa_tour = '" . $Tour["tour_id"] . "'  and tarifa_fecha_inicio <= '" . $_fecha . "'  and tarifa_fecha_final >= '" . $_fecha . "' order by tarifa_precio_adulto DESC ";
				$Command = $Connection->createCommand($sql);
				$Tarifas = $Command->queryAll();
			}

			if(sizeof($Tarifas) > 0){}else{
				$sql = "Select * from tour_tarifa inner join tour_servicio on tarifa_servicio = servicio_id where tarifa_tour = '" . $Tour["tour_id"] . "' and tarifa_fecha_inicio <= '" . $_fecha . "' and tarifa_fecha_final >= '" . $_fecha . "' AND tarifa_tipo_tarifa=1 order by tarifa_precio_adulto DESC";
				$Command = $Connection->createCommand($sql);
				$Tarifas = $Command->queryAll();
				if (sizeof($Tarifas)==0){
					$sql = "Select * from tour_tarifa inner join tour_servicio on tarifa_servicio = servicio_id where tarifa_tour = '" . $Tour["tour_id"] . "' and tarifa_fecha_inicio <= '" . $_fecha . "' and tarifa_fecha_final >= '" . $_fecha . "' order by tarifa_precio_adulto DESC";
					$Command = $Connection->createCommand($sql);
					$Tarifas = $Command->queryAll();

				}
			}

			$Imagenes = $_act->getPhotosByGallery($Tour["tour_galeria"]);
			$_imgPrincipal  = "";
			foreach($Imagenes as $_i){
				if($_i["foto_miniatura"] == 1){
					$_imgPrincipal = $_i["foto_archivo"];
				}
			}
			if($_imgPrincipal == ""){
				$_imgPrincipal = $Imagenes[0]["foto_archivo"];
			}

			$minPrice = 999999;
			$valor 	  = 0;
			foreach($Tarifas as $key => $z){
				$price = $z["tarifa_precio_adulto"];
				$price = Yii::app()->Currency->convert($_SESSION["config_es"]["currency"],$price);
				if($price <= $minPrice){
					if($valor > $price){
						$price = $valor;
					}else{
						$minPrice = $price;
					}
					$valor = $minPrice;
				}

				$opera = $this->operaDia($Tour, $Tarifas[$key], $_fecha, $_ad, $_mn);
				$Tarifas[$key]["opera_Dia"]             = $opera["opera"];
				$Tarifas[$key]["opera_Dia_descripcion"] = $opera["descripcion"];
				$Tarifas[$key]["opera_Dia_nino"]        = $opera["descripcionNino"];

				$diaSemana = date("N", strtotime($_fecha));
				if ($z["tarifa_tour"] == 188 AND ($z["tarifa_id"] == 538 || $z["tarifa_id"] == 545) AND ($diaSemana == '2' || $diaSemana == '4' || $diaSemana == '6' || $diaSemana == '7')) {
					unset($Tarifas[$key]);
				}
			}

			$fechaBook 		= date("m/d/Y", strtotime($_fecha));
			$fechaActual 	= date("m/d/Y");
			$_diasReserva 	= Yii::app()->GenericFunctions->difDays($fechaBook,$fechaActual);
			if ($_diasReserva<2) {
				$Tarifas = array();
			}

			if ($Tour["tour_id"] == 1457) {
				$selectAdulto["min"]     = 0;
				$selectAdulto["max"]     = 0;
				$selectAdulto["default"] = 0;
				$selectAdulto["status"]  = 1;
			}else{
				$selectAdulto["status"] = 0;
			}

			if(isset($_REQUEST["ws"])){
				header('Content-Type: text/html; charset=iso-8859-1');
				$this->renderPartial('detalle_ajax', array(
					"_t" 			=> $Tour,
					"Imagenes" 		=> $Imagenes,
					"_imgPrincipal" => $_imgPrincipal,
					"Categorias" 	=> $_Categorias,
					"Tarifas" 		=> $Tarifas,
					"_ad" 			=> $_ad,
					"_mn" 			=> $_mn,
					"_fecha" 		=> $_fecha,
					"minPrice" 		=> $minPrice,
					"pax_adulto" 	=> $pax_adulto,
					"pax_menor" 	=> $pax_menor));

			}else{
				if ($_REQUEST['checkout_tour'] == 'ajax') {
					$this->renderPartial('tarifas_ajax', array(
						"selectAdulto" 	=> $selectAdulto,
						"opera_Dia" 	=> $opera_Dia,
						"_t" 			=> $Tour,
						"Imagenes" 		=> $Imagenes,
						"_imgPrincipal" => $_imgPrincipal,
						"Categorias" 	=> $_Categorias,
						"Tarifas" 		=> $Tarifas,
						"_ad"  			=> $_ad,
						"_mn" 			=> $_mn,
						"_fecha" 		=> $_fecha,
						"minPrice" 		=> $minPrice,
						"pax_adulto" 	=> $pax_adulto,
						"pax_menor" 	=> $pax_menor));
				}else{
/*					$_ban = new Banner();
					$_BannersLaterales  = $_ban->getBannersLaterales();*/
					$this->render('detalle', array(
						"selectAdulto" 	=> $selectAdulto,
						"opera_Dia" 	=> $opera_Dia,
						"_t" 			=> $Tour,
						"Imagenes" 		=> $Imagenes,
						"_imgPrincipal" => $_imgPrincipal,
						"Categorias" 	=> $_Categorias,
						"Tarifas" 		=> $Tarifas,
						"_ad"   		=> $_ad,
						"_mn" 			=> $_mn,
						"_fecha" 		=> $_fecha,
						"minPrice"  	=> $minPrice,
						"pax_adulto" 	=> $pax_adulto,
						"pax_menor" 	=> $pax_menor));
				}
			}
		}else{
			$this->redirect($this->createUrl("activities/index"));
		}

	}

	/* Funcion para validar las tarifas para poder ser reservadas */
	public function operaDia($tour, $tarifa, $_fecha, $numAdulto, $numNiños){

		/*Validacion de los dias que opera la tarifa */
		$diaSemana =date("N", strtotime($_fecha));
		switch ($diaSemana) {
			case '1': $diaSemanaText = "opera_lunes"; break;
			case '2': $diaSemanaText = "opera_martes"; break;
			case '3': $diaSemanaText = "opera_miercoles"; break;
			case '4': $diaSemanaText = "opera_jueves";	break;
			case '5': $diaSemanaText = "opera_viernes";	break;
			case '6': $diaSemanaText = "opera_sabado"; break;
			case '7': $diaSemanaText = "opera_domingo";	break;
		}

		$opera_Dia  = ($tour[$diaSemanaText] == 1) ? "true" : "false" ;
		$numPersonas = $numAdulto + $numNiños;
		$descripcionNinos = '';

		/* Validacion para tarifas compartidas ya que solo se pueden reservar en pax que son pares */
		if ((stripos($tarifa["tarifa_nombre_en"], "/ Shared") !== false || $tarifa["tarifa_compartido"] == 1) && ($numPersonas % 2) != 0 ){
			$opera_Dia 		= "false";
			$descripcion 	= "Shared rates apply for even </br> number of passengers only.";
		}

		/* Validacion para tarifas con adulto abligatorio */
		if ($tarifa["tarifa_adulto_obligatorio"] == 1 && $numAdulto < $numNiños) {
			$opera_Dia 		= "false";
			$descripcion 	= "Children must be accompanied by an adult.";
		}

		/* Validacion Para capacidad minima de un tour */
		if (!($numPersonas >=  $tarifa["tarifa_min_adultos"] )) {
			$opera_Dia 		= "false";
			$descripcion 	= "Minimum capacity: ".$tarifa["tarifa_min_adultos"]." people.";
		}

		/* Validacion para capacidad Maxima de un paquete */
		if ($tarifa["tarifa_es_paquete"] == 1 && $numPersonas > $tarifa['tarifa_max_pax']) {
			$opera_Dia 		= "false";
			$descripcion 	= "Maximum capacity: ".$tarifa["tarifa_max_pax"]." people.";
		}

		/* Validacion para capacidad Maxima de un tour */
		if ($tarifa["tarifa_es_paquete"] != 1 && $numPersonas > $tarifa["tarifa_max_adultos"] ) {
			$opera_Dia 		= "false";
			$descripcion 	= "Maximum capacity: ".$tarifa["tarifa_max_adultos"]." people.";
		}

		/*Validacion para precio de niños para tours */
		if ($tour["tour_adulto"] == 1 || $tarifa["tarifa_precio_menor"] <= 0) {
			// no acepta niños
			if ($numNiños != 0) {
				$opera_Dia 		= "false";
				$descripcion 	= "";
				$descripcionNinos = "Only Adults";
			}
		}

		/* Validacion para precio de adulto mayor a cero */
		if ($tarifa["tarifa_precio_adulto"] <= 0 && $numAdulto > 0) {
			$opera_Dia 		= "false";
			$descripcion 	= "";
		}

		/* Validacion para tours especiales    ==== > */
		if ($tarifa["tarifa_id"] == 4809 || $tarifa["tarifa_id"] == 4810) {
			switch ($diaSemana) {
				case '2':
				case '5':
				case '7':
					$opera_Dia = "false";
					$descripcion = "Available on Monday, Wednesday, Thursday and Saturday";
					break;
			}
		}
		if ($tarifa["tarifa_id"] == 4921 ) {
			switch ($diaSemana) {
				case '7':
					$opera_Dia = "false";
					$descripcion = "Available on Monday, Tuesday, Wednesday, Thursday, Friday, Saturday";
					break;
			}
		}
		/* Validacion para tours especiales     < ====*/

		return array(
			'opera' 			=> $opera_Dia,
			"descripcion" 		=> $descripcion,
			"descripcionNino" 	=> $descripcionNinos
		);
	}

	public function difDays($a,$b){
		$gd_a = getdate(strtotime($a));
		$gd_b = getdate(strtotime($b));
		$a_new = mktime(12,0,0,$gd_a['mon'],$gd_a['mday'],$gd_a['year']);
		$b_new = mktime(12,0,0,$gd_b['mon'],$gd_b['mday'],$gd_b['year']);
		return round(abs($a_new-$b_new)/86400);
	}


	public function actionAgregar(){
		if(isset($_REQUEST["jnfe"])){
			$_sql = "Select venta_id from venta where venta_session_id Like '" . $_SESSION["config_es"]["token"] . "' and venta_estt = '1' and venta_fecha Like '" . date("Y-m-d") . "%'";
			$_vValidator = Venta::model()->findAllBySql($_sql);

			if( !($_vValidator[0]->venta_id == 0 || $_vValidator[0]->venta_id == "")){
				$Venta = $_vValidator[0]->venta_id;
			}else{
				$_venta = new Venta;
				$_SESSION["config_es"]["token"] = Yii::app()->WebServices->getSecureKey(150);
				$_venta->venta_session_id 	= $_SESSION["config_es"]["token"];
				$_venta->venta_moneda 		= $_SESSION["config_es"]["currency"];
				$_venta->venta_site_id 		= ((Yii::app()->language == "es") ? 2 : 1);
				$_venta->venta_user_id 		= 0;
				$_venta->venta_estt 		= 1;
				$_venta->venta_total 		= 0;
				$_venta->venta_fecha 		= date("Y-m-d H:i:s");
				$_venta->venta_ip 			= Yii::app()->GenericFunctions->getRealIpAddr();
				$_venta->save();
				$Venta = $_venta->venta_id;
			}

			$_Productos = VentaDescripcion::model()->findAll("descripcion_venta = :venta", array(
				":venta" => $Venta
			));
			/* From the CheckOut */
			if(!isset($_REQUEST['fromDetails'])) {
				$data = explode("@@", Yii::app()->GenericFunctions->ShowVar($_REQUEST["jnfe"]));

				foreach ($_Productos as $p) {
					if ($p->descripcion_tipo_producto == 2) {
						if($p->descripcion_producto_id == $data[1]){
							$p->delete();
						}
					}
				}

				$promo_seg  = "";
				if(isset($_REQUEST["promo_seg"])){
					$promo_seg = $_REQUEST["promo_seg"];
				}


				$t = new VentaDescripcion;
				$t->descripcion_producto 	= ($data[3]);
				$t->descripcion_destino 	= $data[12];
				$t->descripcion_brief 		= addslashes($data[5]);
				$t->descripcion_tarifa 		= $data[4];
				$t->descripcion_venta 		= $Venta;
				$t->descripcion_fecha 		= date("Y-m-d H:i:s");
				$t->descripcion_fecha1 		= $data[9];
				$t->descripcion_fecha2 		= $data[9];
				$t->descripcion_adultos 	= $data[10];
				$t->descripcion_menores 	= $data[11];
				$t->descripcion_infantes 	= 0;
				$t->descripcion_cuartos 	= 1;
				$t->descripcion_precio 		= $data[15];
				$t->descripcion_total 		= (str_replace(",","",$data[7]) * 1);
				$t->descripcion_tipo_producto = 2;
				$t->descripcion_tarifa_id 	= $data[0];
				$t->descripcion_producto_id = $data[1];
				$t->descripcion_servicio_id = $data[2];
				$t->descripcion_thumb 		= $data[13];
				$t->descripcion_reservable 	= $data[8];
				$t->descripcion_pagado 		= 0;
				$t->descripcion_id_cupon 	= $data[14];	//para el open ticket
				$t->descripcion_seg 		= substr($promo_seg,1);	//guarda valor de ofertas
				$t->descripcion_seg_tipo 	= substr($promo_seg,0,1);	//guarda valor del tipo de ofertas
				$t->descripcion_precio_nino = $data[16];
				$t->save();


			/* From the Tours details*/
			}else{
				$data = unserialize(Yii::app()->GenericFunctions->ShowVar($_REQUEST["jnfe"]));

				foreach ($_Productos as $p) {
					//print_r($p->descripcion_producto);
					if ($p->descripcion_tipo_producto == 2) {
						if($p->descripcion_producto_id == $data['descripcion_producto_id']){
							$p->delete();
						}
					}
				}


				$promo_seg  = "";
				if(isset($_REQUEST["promo_seg"])){
					$promo_seg = $_REQUEST["promo_seg"];
				}


				$t = new VentaDescripcion;
				$t->descripcion_producto 	= $data['descripcion_producto'];
				$t->descripcion_destino 	= $data['descripcion_destino'];
				$t->descripcion_brief 		= addslashes($data['descripcion_brief']);
				$t->descripcion_tarifa 		= $data['descripcion_tarifa'];
				$t->descripcion_venta 		= $Venta;
				$t->descripcion_fecha 		= date("Y-m-d H:i:s");
				$t->descripcion_fecha1 		= $data['descripcion_fecha1'];
				$t->descripcion_fecha2 		= $data['descripcion_fecha2'];
				$t->descripcion_adultos 	= $data['descripcion_adultos'];
				$t->descripcion_menores 	= $data['descripcion_menores'];
				$t->descripcion_infantes 	= 0;
				$t->descripcion_cuartos 	= 1;
				$t->descripcion_precio 		= $data['descripcion_precio'];
				$t->descripcion_total 		= (str_replace(",","",$data['descripcion_total']) * 1);
				$t->descripcion_tipo_producto = 2;
				$t->descripcion_tarifa_id 	= $data['descripcion_tarifa_id'];
				$t->descripcion_producto_id = $data['descripcion_producto_id'];
				$t->descripcion_servicio_id = $data['descripcion_servicio_id'];
				$t->descripcion_thumb 		= $data['descripcion_thumb'];
				$t->descripcion_reservable 	= $data['descripcion_reservable'];
				$t->descripcion_pagado 		= 0;
				$t->descripcion_id_cupon 	= 0;	//para el open ticket
				$t->descripcion_seg 		= substr($promo_seg,1);	//guarda valor de ofertas
				$t->descripcion_seg_tipo 	= substr($promo_seg,0,1);	//guarda valor del tipo de ofertas
				$t->descripcion_precio_nino = $data['descripcion_precio_nino'];
				$t->save();
			}


			$this->redirect(array("checkout/index"));
		}else{
			$this->redirect(array("activities/index"));
		}

	}


}
?>	