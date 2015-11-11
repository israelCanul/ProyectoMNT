<?php

class Hotel{

	public function getDestinosLocales(){
		$locales = Yii::app()->db->createCommand()
			->select("destino_extranet_codigo as id")
			->from('destino')	
			->where('destino_pais=1 and destino_extranet_codigo != ""')
			->queryAll();

		$ids = array();
		foreach($locales as $local){
			array_push($ids, $local['id']);
		}
		$ids = implode(",", $ids);
		return $ids;
	}

	public function getTopDestinos(){
		$locales 		= $this->getDestinosLocales();
		$destinations 	= Yii::app()->dbWeblt->createCommand()
			->select("DISTINCT(h.hotel_ciudad), c.ciudad_nombre, c.ciudad_clave")
			->from("hoteles h, ciudades c")
			->where("h.hotel_sitio IN (0,2) AND h.hotel_ciudad = c.ciudad_id AND h.hotel_status='1' AND c.active = '1' AND h.hotel_ciudad IN (".$locales.")")
			->order("c.ciudad_nombre ASC")
			->queryAll();

		return $destinations;
	}

	public function getMasDestinos(){
		$locales 		= $this->getDestinosLocales();
		$destinations 	= Yii::app()->dbWeblt->createCommand()
			->select("DISTINCT(h.hotel_ciudad), c.ciudad_nombre, c.ciudad_clave")
			->from("hoteles h, ciudades c")
			->where("h.hotel_sitio IN (0,2) AND h.hotel_ciudad = c.ciudad_id AND h.hotel_status='1' AND c.active = '1' AND h.hotel_ciudad NOT IN (".$locales.")")
			->order("c.ciudad_nombre ASC")
			->queryAll();

		return $destinations;
	}


	public function getHotelIdPorClave($clave){
		$hotel = Yii::app()->dbWeblt->createCommand()
			->select("hotel_id")
			->from('hoteles')	
			->where("hotel_keyword='".$clave."' and hotel_status = 1 ")
			->queryScalar();
		return $hotel;
	}

  	public function getDestinationHotels(){
  		$destinations = Yii::app()->db->createCommand()
			->select("destino_id,nombre_en as nombre,destino_tourico_iata,destino_clave,destino_extranet_codigo")
			->from('destino')	
			->where('destino_pais=1 and destino_extranet_codigo != ""')
			->queryAll();
		return $destinations;
  	}

  	public function getDestinoClavePorId($id){
  		$code = Yii::app()->dbWeblt->createCommand()
			->select("ciudad_clave")
			->from('ciudades')
			->where('ciudad_id = :id',  array(':id' => $id))
			->queryScalar();
		return $code;
  	}

  	public function esDestino($clave){
		$destino = Yii::app()->dbWeblt->createCommand()
			->select('ciudad_nombre')
			->from('ciudades')
			->where('ciudad_clave = :clave',  array(':clave' => $clave))
			->queryScalar();
		if(empty($destino)){
			return false;
		}else{
			return true;
		}
	}

	public function esInteres($clave){
		$interes = Yii::app()->dbWeblt->createCommand()
			->select('tipo_nombre_es')
			->from('hoteles_tipo')
			->where('tipo_keyword_es = :clave',  array(':clave' => $clave))
			->queryScalar();
		if(empty($interes)){
			return false;
		}else{
			return interes;
		}
	}

  	public function getInterestHotels(){
  		$interests = Yii::app()->dbWeblt->createCommand()
			->select("*")
			->from('hoteles_tipo')
			->order('tipo_nombre_es','ASC')		
			->queryAll();
		return $interests;
	}
	
  	public function getDestinationByCode($code){
		$destination = Yii::app()->db->createCommand()
			->select("destino_id, nombre_en as nombre, destino_extranet_codigo")
			->from('destino')	
			->where("destino_clave = :clave",array(":clave" => $code))
			->queryRow();
		return $destination;
	}


	public function getCategoryHotel($category){
		$categoryinfo = Yii::app()->dbWeblt->createCommand()
			->select("tipo_id, tipo_nombre_es as nombre")
			->from('hoteles_tipo')	
			->where("tipo_keyword_es = :category",array(":category" => $category))
			->queryRow();
		return $categoryinfo;
	}

	public function getClaveByDestination($destination){
		$destination = Yii::app()->db->createCommand()
			->select("destino_clave")
			->from('destino')	
			->where("nombre_en = :destination",array(":destination" => $destination))
			->queryRow();
		return $destination;
	}

  	public function getHotelsByDestination($destination){
  		$hotels = Yii::app()->dbWeblt->createCommand()
			->select("hotel_id")
			->from('hoteles')	
			->where("hotel_ciudad=".$destination."")
			->queryAll();
		return $hotels;
	}

	public function getDescriptionRooms(){
		$descriptions = Yii::app()->dbWeblt->createCommand()
			->selectDistinct("descripcion_larga,descripcion_habitacion")
			->from('habitaciones_descripcion')									    
			->where('descripcion_idioma=2')								    
			->queryAll();
		return $descriptions;
	}

	public function getCapacityRooms(){
		$capacitites = Yii::app()->dbWeblt->createCommand()
			->select("habitacion_id,ifnull(habitacion_capacidad,0) as habitacion_capacidad")
			->from('habitaciones')	
			->queryAll();
		return $capacities;
	}

	public function getBenefitsHotel(){
		$info = Yii::app()->dbWeblt->createCommand()
			->select("hotel_id,ifnull(hotel_beneficio,'') as hotel_beneficio,ifnull(hotel_habitaciones,' ') as hotel_habitaciones,ifnull(hotel_restaurant,' ') as hotel_restaurant")
			->from('hoteles')	
			->queryAll();
		return $info;
	}

	public function getActivitiesHotel(){
		$activities = Yii::app()->dbWeblt->createCommand()
			->select("hotel,descripcion,con_costo")
			->from('actividades')
            ->join("hoteles_actividades","actividad = actividades_id")
            ->queryAll();
    	return $activities;
	}
	
	public function getDealsHotel(){
		$deals = Yii::app()->dbWeblt->createCommand()
			->select("*")
			->from('promociones')	
			->queryAll();
		return $deals;
	}


	public function getHotelsSearch(){
		$hotels = Yii::app()->dbWeblt->createCommand()
			->selectDistinct("hotel_id, hotel_nombre, hotel_keyword")
			->from('hoteles')									    
			->where("hotel_status = '1' and hotel_sitio IN(0,2)")								    
			->order("hotel_nombre ASC")								    
			->queryAll();
		return $hotels; 
	}

	public function getCiudadesSearch(){
		$ciudades = Yii::app()->dbWeblt->createCommand()
			->selectDistinct("ciudad_id, ciudad_nombre")
			->from('ciudades')									    
			->where("ciudad_pais_codigo = 'MX'")								    
			->order("ciudad_nombre ASC")								    
			->queryAll();
		return $ciudades;
	}

	public function getIdInteres($interes){
		$interes = Yii::app()->dbWeblt->createCommand()
			->select("tipo_id")
			->from('hoteles_tipo')	
			->where("tipo_keyword_es = :interes",array(":interes" => $interes))
			->queryRow();
		return $interes;
	}

	public function getCiudad($claveCiudad){
		$ciudad = Yii::app()->dbWeblt->createCommand()
			->select("ciudad_id,ciudad_nombre")
			->from('ciudades')	
			->where("ciudad_clave = :clave",array(":clave" => $claveCiudad))
			->queryRow();
		return $ciudad;
	}

	public function getCiudadesMexico(){
		$ciudades = Yii::app()->dbWeblt->createCommand()
			->selectDistinct("ciudad_id, ciudad_nombre")
			->from('ciudades')									    
			->where("ciudad_pais_codigo = 'MX'")								    
			->order("ciudad_nombre ASC")								    
			->queryAll();
		return $ciudades;
	}

	public function getClaveCiudad($idCiudad){
		$ciudad = Yii::app()->dbWeblt->createCommand()
			->selectDistinct("ciudad_clave")
			->from('ciudades')
			->where("ciudad_id = :id",array(":id" => $idCiudad))    
			->queryRow();
		return $ciudad['ciudad_clave'];
	}

	public function getCiudadClavePorHotelId($hotelId){
		$ciudad = Yii::app()->dbWeblt->createCommand()
			->select("ciudad_clave")
			->from('ciudades')
			->join('hoteles', 'hotel_ciudad = ciudad_id')
			->where("hotel_id = :id",array(":id" => $hotelId))    
			->queryScalar();
		return $ciudad;
	}

	public function getHotelClavePorId($id){
		$keyword = Yii::app()->dbWeblt->createCommand()
			->select("hotel_keyword")
			->from('hoteles')
			->where("hotel_id = :id",array(":id" => $id))    
			->queryScalar();
		return $keyword;
	}
	
}

?>