<?php

class Destination{

	public function getLocalDestinations(){
		$locals = Yii::app()->db->createCommand()
			->select("destino_extranet_codigo as id")
			->from('destino')	
			->where('destino_pais=1 and destino_extranet_codigo != ""')
			->queryAll();

		$ids = array();
		foreach($locals as $local){
			array_push($ids, $local['id']);
		}
		$ids = implode(",", $ids);
		return $ids;
	}

	public function getTopDestinations(){
		$locals 		= $this->getLocalDestinations();
		$destinations 	= Yii::app()->dbWeblt->createCommand()
			->select("DISTINCT(h.hotel_ciudad), c.ciudad_nombre, c.ciudad_clave, c.ciudad_img")
			->from("hoteles h, ciudades c")
			->where("h.hotel_sitio IN (0,1) AND h.hotel_ciudad = c.ciudad_id AND h.hotel_status='1' AND c.active = '1' AND h.hotel_ciudad IN (".$locals.")")
			->order("c.ciudad_nombre ASC")
			->queryAll();

		return $destinations;
	}

	public function getMoreDestinations(){
		$locals 		= $this->getLocalDestinations();
		$destinations 	= Yii::app()->dbWeblt->createCommand()
			->select("DISTINCT(h.hotel_ciudad), c.ciudad_nombre, c.ciudad_clave,c.ciudad_img")
			->from("hoteles h, ciudades c")
			->where("h.hotel_sitio IN (0,1) AND h.hotel_ciudad = c.ciudad_id AND h.hotel_status='1' AND c.active = '1' AND h.hotel_ciudad NOT IN (".$locals.")")
			->order("c.ciudad_nombre ASC")
			->queryAll();

		return $destinations;
	}


}

?>