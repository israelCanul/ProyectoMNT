<?php

class Country{

	   public function __construct($id){
      $country = Yii::app()->db->createCommand()
        ->select('*')
        ->from('pais')
        ->where('pais_id = :id', array(":id"=>$id))
        ->queryRow();

      $this->id           = $country['pais_id'];
      $this->nombre       = $country['pais_nombre'];
      $this->clave        = $country['pais_clave'];
    }

    public function getId(){
      return $this->id;
    }

    public function getNombre(){
      return $this->nombre;
    }

    public function getClave(){
      return $this->clave;
    }

}

?>