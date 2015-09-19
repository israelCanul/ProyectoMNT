<?php

class ActivitiesController extends Controller
{
	public function actionIndex()
	{
		$_act 	= new Activities();
		$_destinos 	 = $_act->getActivityDestinations();
		$_categorias = $_act->getActivityCategories();


		/* enviar las trending notes de Mexico news en la seccio9n de travel*/
		$notasFooter=Yii::app()->GenericFunctions->notasFooter();

		$params=array(
			'notas2'=>$notasFooter,
			"_destinos" 	=> $_destinos,
			'_categorias' => $_categorias,
			'destinos'=>$ciudades);
		$cs = Yii::app()->getclientScript(); 
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/page/activities.css');	
		$this->render('index',$params);
	}

	/**************************************************************************************************/
	public function actionDestinations(){		
		//$_act 		= new Actividad();
		$destinos = Yii::app()->db->createCommand()
          ->select("destino_clave as dcodigo, nombre_en as dnombre")
          ->from('destino')     
          ->where("destino_id not in(15)")                
          ->order("nombre_en ASC")                    
          ->queryAll();

		$strDest = "";
		$strDest .= '{"id": "Destacados", "label": "Destacados", "tipo": 1,"categoria":"Category"},';
		
		$Categorias = Yii::app()->db->createCommand()
		    ->select("categoria_id as dcodigo, categoria_nombre_" . Yii::app()->language . " as dnombre")
		    ->from('categoria_tour')
		    ->where('categoria_estado=1')
		    ->queryAll();

		foreach($Categorias as $l){
			$strDest .= '{"id": "' . $l["dcodigo"] . '", "label": "' . utf8_encode($l["dnombre"]) . '", "tipo": 3,"categoria":"Category"},';
		}
		
		foreach($destinos as $l){
			$strDest .= '{"id": "' . $l["dcodigo"] . '", "label": "' . utf8_encode($l["dnombre"]) . '", "tipo": 1,"categoria":"Destinations"},';
		}
		
		$tours = Yii::app()->db->createCommand()
			->selectDistinct("tour_id, tour_nombre, tour_proveedor")
			->from('tour')									    
			->where("tour_status = '1' and tour_clave != '' and tour_clave_es != ''")		    
			->order("tour_nombre ASC")								    
			->queryAll();

		$proveedorList = array();
		foreach($tours as $l){
			if (!in_array($l["tour_proveedor"], $proveedorList)) {
				$proveedorList[] = $l["tour_proveedor"];
			}
			$strDest .= '{"id": "' . $l["tour_id"] . '", "label": "' .utf8_encode( str_replace("\r","",str_replace("\n","",(str_replace('"','\"',str_replace("'","",  ucwords(strtolower($l['tour_nombre']))  ))))) ). '","tipo": 2,"categoria":"Tours"},';
		}
		
		$proveedorList 	= implode(",", $proveedorList);
		$proveedores 	= Yii::app()->db->createCommand()
			->select("proveedores_id, proveedores")
			->from("tour_proveedores")
			->where("proveedores != '' and proveedor_suspendido = 0 and proveedores_id IN ($proveedorList)")
			->group("proveedores")
			->queryAll();

		foreach ($proveedores as $l) {
			$caracters =  array('\r','\n','"',"'");
			$l["proveedores"]= Yii::app()->GenericFunctions->makeSinAcento($l["proveedores"]);
			$strDest .= '{"id": "' . $l["proveedores_id"] . '", "label": "' .  str_replace("\r","",str_replace("\n","",(str_replace('"','\"',str_replace("'","",  ucwords(strtolower($l["proveedores"]))  )))))  . '", "tipo": 4,"categoria":"Supplier"},';			
		}

		echo "[" . substr($strDest,0,-1) . "]";		
		exit();
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

	public function actionBuscar(){

		$_act = new Activities();

		if(intval($_REQUEST["TourId"]) == 0 ){
			print_r("tour id");
			exit();
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
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/activities/activities.min.css?a='. Yii::app()->params['assets'],'screen, projection');

			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox.pack.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-buttons.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-media.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/fancybox/jquery.fancybox-thumbs.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
			$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/activities/activities-detail.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);

			$urlCanonical = $this->createUrl("activities/detalle",array("dest"=>$Tour["tour_clave_en"], "prod"=>$_REQUEST["prod"]));
			Yii::app()->clientScript->registerLinkTag('canonical',"",Yii::app()->params["baseUrl"].$urlCanonical);

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
			$_fecha = (isset($_REQUEST["fecha"]) ? Yii::app()->GenericFunctions->convertUsableDates($_REQUEST["fecha"]) : date("Y-m-d",mktime(0,0,0,date("m"),date("d")+3,date("Y"))) );
			$_REQUEST['tour_fecha'] 		= date('m/d/Y', strtotime($_fecha));
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
				$price = Yii::app()->Currency->convert($_SESSION["config"]["currency"],$price);
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
					$_ban = new Banner();
					$_BannersLaterales  = $_ban->getBannersLaterales();
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
						"pax_menor" 	=> $pax_menor,
						"_BannersLaterales" => $_BannersLaterales));
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

}
?>	