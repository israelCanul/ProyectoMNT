<?php

class Oferta{


	public function getOfertas(){
		$ofertas = Yii::app()->db->createCommand()
		    ->select("*")
		    ->from('promos')									    
		    ->where(':date BETWEEN promocion_inicio and promocion_fin and promocion_sitio_aplica IN (0,2) and promocion_en_listado = 1',array(":date"=>date("Y-m-d")))
		    ->order("promocion_orden")
			->queryAll();
		return $ofertas;
	}

	public function getOfertaPorId($id){
		$oferta = Yii::app()->db->createCommand()
			->select("*")
			->from('promos')									    
			->where(':date BETWEEN promocion_inicio and promocion_fin and promocion_id = :id and promocion_sitio_aplica IN (0,2) and promocion_en_listado = 1',array(":id" => $id, ":date"=>date("Y-m-d")))								    
			->queryRow();
		return $oferta;
	}

	public function getProductosOfertaPorId($id){
		$oferta = Yii::app()->db->createCommand()
			->select("*")
			->from('promos_rows')									    
			->where('promocion = :id',array(":id"=> $id ))
			->queryAll();
		return $oferta;
	}
		
}

?>