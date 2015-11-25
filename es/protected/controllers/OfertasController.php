<?php

class OfertasController extends CController
{

	public function actionIndex(){

		/*$_Promociones = Yii::app()->db->createCommand()
						    ->select("*")
						    ->from('promos')									    
						    ->where(':date BETWEEN promocion_inicio and promocion_fin and promocion_sitio_aplica IN (0,2) and promocion_en_listado = 1',array(":date"=>date("Y-m-d")))								    
						     ->order("promocion_orden")
						    ->queryAll();*/

		$_oferta 		= new Oferta();
		$_Promociones 	= $_oferta->getOfertas();				    
		
		$params=array(
			"_Promociones"=>$_Promociones,
			);

		$cs = Yii::app()->getclientScript(); 
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/page/ofertas/ofertas.css');
		$this->render('index',$params);
	}

	public function actionDetalle(){
		

		$p = Yii::app()->db->createCommand()
						    ->select("*")
						    ->from('promos')									    
						    ->where(':date BETWEEN promocion_inicio and promocion_fin and promocion_id = :id and promocion_sitio_aplica IN (0,2) and promocion_en_listado = 1',array(":id" => $_REQUEST["cod"], ":date"=>date("Y-m-d")))								    
						    ->queryRow();
		
		//var_dump($p["promocion_producto"]);
		//var_dump($p["promocion_tipo_contenido"]);

		$rows = Yii::app()->db->createCommand()
						    ->select("*")
						    ->from('promos_rows')									    
						    ->where('promocion = :id',array(":id"=> $_REQUEST["cod"] ))								    
						    ->queryAll();

		/*print_r($_REQUEST);
		exit();*/
		
		$cs = Yii::app()->getclientScript(); 
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/page/ofertas.css');
		//$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/hoteles-min.js?a='.Yii::app()->params['assets'],CClientScript::POS_END);
		
		// Agregado por Luis Caballero
		// Lunes 7 - Abril - 2014
		// Se agrego para poder mostrar el listado de los tours en rockstar porque la pagina no mostraba nada		
			
		if($p["promocion_producto"] == "tour"){
			if($p["promocion_tipo_contenido"] != 0){

				$this->render('detalle_promociones',array("p"=>$p,"rows"=>$rows));

			}else{
				$rows = Yii::app()->db->createCommand()
					->select('pr.*, td.descripcion_corta, t.tour_id, t.tour_nombre, t.tour_clave, d.destino_id, d.destino_clave, d.nombre_en as destino_nombre')
    				->from('promos_rows pr')
    				->join('tour_descripcion td', 'pr.id=td.descripcion_tour')
    				->join('tour t', 'pr.id=t.tour_id')
    				->join('destino d', 't.tour_destino=d.destino_id')
    				->where('t.tour_status=1 and promocion=:id and td.descripcion_idioma = :idioma', array(':id'=>$_REQUEST["cod"] , ":idioma"=>Yii::app()->GenericFunctions->getLangId()))
    				->queryAll();
				
				$tours = array();
				foreach ($rows as $row){

					$tour = array();

					$Connection = Yii::app()->db;
					$sql 		= "SELECT f.foto_archivo FROM foto AS f, tour AS t WHERE t.tour_id = '" . $row["id"] . "' AND t.tour_galeria = f.foto_galeria AND f.foto_miniatura = 1";
					$Command 	= $Connection->createCommand($sql);
					$foto 		= $Command->queryRow();

					$_fecha 	= date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y")));
			
					$Connection = Yii::app()->db;
					$sql 		= "SELECT MIN(tarifa_precio_adulto) as tarifa FROM tour_tarifa WHERE tarifa_tour = '" . $row["id"] . "'  AND tarifa_fecha_inicio <= '" . $_fecha . "'  AND tarifa_fecha_final >= '" . $_fecha ."' and tarifa_tipo_tarifa='1'";
					$Command 	= $Connection->createCommand($sql);
					$tarifa 	= $Command->queryRow();
					
					if(!$tarifa["tarifa"]){
						$Connection = Yii::app()->db;
						$sql 		= "SELECT MIN(tarifa_precio_adulto) as tarifa FROM tour_tarifa WHERE tarifa_tour = '" . $row["id"] . "'  ";
						$Command 	= $Connection->createCommand($sql);
						$tarifa 	= $Command->queryRow();						
					}					

					/*$Connection = Yii::app()->dbExtranet;
					$sql 		= "SELECT moneda_cambio FROM monedas WHERE moneda_id = 1";
					$Command 	= $Connection->createCommand($sql);
					$moneda 	= $Command->queryRow();
					$tarifa 	= $tarifa["tarifa"] * $moneda["moneda_cambio"];*/

					$tour['id'] 				= $row['id'];
					$tour['nombre'] 			= $row['tour_nombre'];
					$tour['descripcion_corta'] 	= $row['descripcion_corta'];
					$tour['tour_clave'] 		= $row['tour_clave'];
					$tour['destino_id']			= $row['destino_id'];
					$tour['destino_clave']		= $row['destino_clave'];
					$tour['destino_nombre']		= $row['destino_nombre'];

					$tour['foto']				= $foto['foto_archivo'];
					$tour['tarifa']				= $tarifa['tarifa'];

					array_push($tours, $tour);

			}
			
			//print_r($tours);
			$this->render('detalle_tours',array("p"=>$p,"rows"=>$tours));
			// Fin de la Modificacion	
		}
		}else{



		if($p["promocion_tipo_contenido"] != 1){
		
			$ids = "";
			foreach($rows as $r){
				if(intval($r["id"]) != 0){
					$ids .= $r["id"].",";
				}
			}
			
			$ids = substr ($ids, 0, strlen($ids) - 1);
		
			//if($p["promocion_producto"] == "hotel"){
				if($p["promocion_tipo_contenido"] == 0){

					$wsdl = Yii::app()->_Hotels->WSDL;	
				    			
					#ezequiel se agrego llamada para mandar la fecha de promocion 20140409
					$promo_tw_inicio = explode(" ",$p['promocion_tw_inicio']);
					$promocion_tw_inicio =$promo_tw_inicio[0];
					
					#Ezequiel 20150204 para tomar las fechas del booking
					if(isset($_REQUEST["hotel_checkin"]) && isset($_REQUEST["hotel_checkout"])){
						$_fini = Yii::app()->GenericFunctions->convertUsableDates($_REQUEST["hotel_checkin"]);
						$_ffin = Yii::app()->GenericFunctions->convertUsableDates($_REQUEST["hotel_checkout"]);
					}else{
						$_fini="";
						$_ffin="";
					}
									
					if(!isset($_REQUEST["Room"])){
						$Rooms = Yii::app()->_Hotels->Config["Rooms"];	
					}else{
						$stopOk["Rooms"] = $_REQUEST["Room"];
						Yii::app()->_Hotels->Config = $stopOk;
						
						$Rooms = Yii::app()->_Hotels->Config["Rooms"];						
					}
					
					$Hoteles = array();
					unset(Yii::app()->_Hotels->Config["Rooms"]);
					foreach($Rooms as $r){
						Yii::app()->_Hotels->Config["Rooms"][0] = $r;
						$xml = Yii::app()->_Hotels->wsGetByMultipleIdsPromoHoteles($ids,false,false,$promocion_tw_inicio, $_fini, $_ffin);
						$iService = Yii::app()->WebServices->consumeServiceXML($wsdl,$xml);

						//$Hoteles = $iService->SearchHotelsByIDResult->HotelList;
						array_push($Hoteles, $iService->SearchHotelsByIDResult->HotelList);			
					}
					
					
					Yii::app()->_Hotels->Config["Rooms"] = $Rooms;					
					
					
					$this->render('detalle_hoteles',array("p"=>$p,"_Htls"=>$Hoteles));
				}
				if($p["promocion_tipo_contenido"] == 2){			    		    
				    $wsdl = Yii::app()->_Hotels->WSDL;	
				    $xml = Yii::app()->_Hotels->wsGetByMultipleDestination($ids);
					$iService = Yii::app()->WebServices->consumeServiceXML($wsdl,$xml);
					$Hoteles = $iService->SearchHotelsResult->HotelList;
					
					
					$_RoomH = Yii::app()->dbExtranet->createCommand()
						    ->selectDistinct("descripcion_larga,descripcion_habitacion")
						    ->from('habitaciones_descripcion')									    
						    ->where('descripcion_idioma=2')								    
						    ->queryAll();
		            //Obtengo la Capacidad por Habitacion
		            $_RoomC  = Yii::app()->dbExtranet->createCommand()
								    ->select("habitacion_id,ifnull(habitacion_capacidad,0) as habitacion_capacidad")
								    ->from('habitaciones')	
								    ->queryAll();
		             
		            $_HL =    Yii::app()->dbExtranet->createCommand()
								    ->select("hotel_id,ifnull(hotel_beneficio,'') as hotel_beneficio,ifnull(hotel_habitaciones,' ') as hotel_habitaciones,ifnull(hotel_restaurant,' ') as hotel_restaurant")
								    ->from('hoteles')	
								    ->queryAll();
		                            
		                            
		                            
		                            
		            $nIndex = Yii::app()->WebServices->getKey(11);
	
					$_Cr = $nIndex;
		         
		                                                          
		            //Promocion Descripcion
		             $_PM =    Yii::app()->dbExtranet->createCommand()
								    ->select("*")
								    ->from('promociones')	
								    ->queryAll();                
		                // 
					
					$this->render('detalle_destino_hoteles',array("p"=>$p,"_Htls"=>$Hoteles,"_Cr"=>$_Cr,"_RoomH"=>$_RoomH,"_RoomC"=>$_RoomC,"_HL"=>$_HL,"_PM"=>$_PM));
				}
					
			//}
		
		
		}else{
			
			$this->render('detalle_promociones',array("p"=>$p,"rows"=>$rows));
		}	
			
		}
		
	}


}
?>