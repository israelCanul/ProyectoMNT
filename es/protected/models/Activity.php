<?php

class Activity{


    public function __construct($id){
      $act = Yii::app()->db->createCommand()
        ->select('*')
        ->from('tour')
        ->where('tour_id = :id', array(":id"=>$id))
        ->queryRow();

      $desc = Yii::app()->db->createCommand()
        ->select('*')
        ->from('tour_descripcion')
        ->where('descripcion_idioma = 1 AND descripcion_tour = :tour', array(":tour" => $id))
        ->queryRow();

      $this->id               = $act['tour_id'];
      $this->nombre           = $act['tour_nombre'];
      $this->clave            = $act['tour_clave'];
      $this->status           = $act['tour_status'];
      $this->checkout         = $act['tour_checkout'];
      $this->reservable       = $act['tour_reservable'];
      $this->casa             = $act['tour_casa'];
      $this->galeria          = $act['tour_galeria'];
      
      $this->descripcionCorta = $desc['descripcion_corta'];
      $this->descripcionLarga = $desc['descripcion_larga']; 
      $this->politicas        = $desc['descripcion_politicas'];
      $this->restricciones    = $desc['descripcion_restricciones'];   
      $this->horariosSalida   = $desc['descripcion_horarios_salida'];
      $this->exclusiones      = $desc['descripcion_exclusiones'];
      $this->inclusiones      = $desc['descripcion_inclusiones'];
      $this->recomendaciones  = $desc['descripcion_recomendaciones'];      
      
      $this->Destino  = new Destination($act['tour_destino']);

      //$this->Categoria = new CategoryActivity($act['tour_destino']);
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

    public function getStatus(){
      return $this->status;
    }

    public function getCheckout(){
      return $this->checkout;
    }

    public function getReservable(){
      return $this->reservable;
    }

    public function getCasa(){
      return $this->casa;
    }

    public function getGaleriaID(){
      return $this->galeria;
    }



    public function getDescripcionCorta(){
      return $this->descripcionCorta;
    }

    public function getDescripcionLarga(){
      return $this->$descripcionLarga;
    }

    public function getPoliticas(){
      return $this->politicas;
    }

    public function getRestricciones(){
      return $this->$restricciones;
    }

    public function getHorariosSalida(){
      return $this->horariosSalida;
    }

    public function getExclusiones(){
      return $this->$exclusiones;
    }

    public function getInclusiones(){
      return $this->inclusiones;
    }

    public function getRecomendaciones(){
      return $this->$recomendaciones;
    }

    public function Fotos(){
       $rows = Yii::app()->db->createCommand()
        ->select('foto_id')
        ->from('foto')
        ->where('foto_galeria = :galeria ', array(":galeria"=>$this->galeria))
        ->queryAll();

      $fotos = array();
      foreach($rows as $row){
        array_push($fotos, new ActivityPhoto($row['foto_id']));
      }
      $this->Fotos = $fotos;
      return $this->Fotos;
    }

    public function getTarifaMinima($date){
       $tarifa = Yii::app()->db->createCommand()
        ->select('MIN(tarifa_precio_adulto)')
        ->from('tour_tarifa')
        ->where(':fecha BETWEEN tarifa_fecha_inicio AND tarifa_fecha_final AND tarifa_tipo_tarifa = 1 AND tarifa_tour = :tour AND tarifa_id !="2615"', array(":fecha" => $date, ":tour" => $this->id))
        ->queryScalar();
      return $tarifa;
    }

}

?>