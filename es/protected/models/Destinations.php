<?php

class Destinations{
   
  	public function __construct($id){
      $destination = Yii::app()->db->createCommand()
        ->select('*')
        ->from('destino')
        ->where('destino_id = :id', array(":id"=>$id))
        ->queryRow();

      $this->id           = $destination['destino_id'];
      $this->nombre       = $destination['nombre_en'];
      $this->clave        = $destination['destino_clave'];
      $this->image        = $destination['destino_img'];
      $this->codExtranet  = $destination['destino_extranet_codigo'];
      $this->enLista      = $destination['destino_tours_enlista'];
      $this->Pais         = new Country($destination['destino_pais']);
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

    public function getDestImage(){
      return $this->image;
    }

    public function getCodigoExtranet(){
      return $this->codExtranet;
    }

    public function getTitulo(){
      return $this->Titulo;
    }

    public function getKeywords(){
      return $this->codExtranet;
    }

    public function getDescripcion(){
      return $this->codExtranet;
    }

    public function getEnLista(){
      if($this->enLista)
        return true;
      else
        return false;
    }
    

}

?>