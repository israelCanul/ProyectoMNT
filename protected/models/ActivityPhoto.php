<?php

class ActivityPhoto{

	 public function __construct($id){
      $photo = Yii::app()->db->createCommand()
        ->select('*')
        ->from('foto')
        ->where('foto_id = :id', array(":id"=>$id))
        ->queryRow();

      $this->id           = $photo['foto_id'];
      $this->nombre       = $photo['foto_nombre'];
      $this->imagen       = $photo['foto_archivo'];
      $this->alt          = $photo['foto_en_alt'];
      $this->esMiniatura  = $photo['foto_miniatura'];
    }

    public function getId(){
      return $this->id;
    }

    public function getNombre(){
      return $this->nombre;
    }

    public function getImagen(){
      return $this->imagen;
    }

    public function getAlt(){
      return $this->alt;
    }

    public function getEsMiniatura(){
      if($this->esMiniatura)
        return true;
      else
        return false;
    }
    

}

?>