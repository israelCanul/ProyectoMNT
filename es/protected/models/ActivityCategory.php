<?php

class ActivityCategory{

	 public function __construct($id){
      $category = Yii::app()->db->createCommand()
        ->select('*')
        ->from('categoria_tour')
        ->where('categoria_id = :id', array(":id"=>$id))
        ->queryRow();

      $this->id       = $category['categoria_id'];
      $this->nombre   = $category['categoria_nombre_es'];
      $this->imagen   = $category['categoria_icono'];
      $this->clave    = $category['categoria_clave_es'];
      $this->enLista  = $category['categoria_enlista'];
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

    public function getClave(){
      return $this->clave;
    }

    public function getEnLista(){
      if($this->enLista)
        return true;
      else
        return false;
    }
    

}

?>