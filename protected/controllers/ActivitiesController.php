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

}
?>	