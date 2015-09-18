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
			$activity 		= $_act->getActivityById($_REQUEST["TourId"]);
			$checkout_tour 	= (isset($_REQUEST['checkout_tour'])) ? $_REQUEST['checkout_tour'] : '';

			$tParams = array(
				"dest" 			=> $activity["destino_clave"],
				"prod" 			=> $activity["tour_clave"],
				"tour_fecha"  	=> $_REQUEST["tour_fecha"],
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
				$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/activities-list.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);

				$urlCanonical = $this->createUrl("tours/listar", array("code" => $code));
				Yii::app()->clientScript->registerLinkTag('canonical',"","http://www.lomastravel.com".$urlCanonical);

				$_ban 		= new Banner();
				$_BannersLaterales  = $_ban->getBannersLaterales();

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
						"pax_menor"  => $pax_menor,
						"_BannersLaterales" => $_BannersLaterales
					)
				);
			}
		}else{
			$this->redirect($this->createUrl("tours/index"));
		}
	}

}
?>	