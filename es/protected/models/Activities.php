<?php

class Activities{

    public function getActivityById($id){
      $activity = Yii::app()->db->createCommand()
          ->selectDistinct("tour_id, tour_clave as url, destino_clave")
          ->from('tour')    
          ->join("destino","destino_id = tour_destino")                 
          ->where("tour_status = '1' and tour_id = :id",array(":id" => $id))
          ->queryRow();
      return $activity;
    }

     public function getActivityByCode($code){
      $activity = Yii::app()->db->createCommand()
          ->select('*')
          ->from('tour')      
          ->join("destino","destino_id = tour_destino")             
          ->join("tour_descripcion","descripcion_tour = tour_id")             
          ->join("tour_proveedores","tour_proveedor = proveedores_id")              
          ->where("tour_status = 1 and descripcion_idioma = :idioma and (tour_clave_es = :clave OR tour_clave = :clave)",array(":clave"=> $code,":idioma"=>Yii::app()->GenericFunctions->getLangId()))                    
          ->order("destino_id ASC, rand()")                   
          ->queryRow();
      return $activity;
    }

    public function getSupplierById($id){
      $proveedorName = Yii::app()->db->createCommand()
          ->select('proveedores')
          ->from('tour_proveedores')
          ->where('proveedores_id = :idproveedor',  array(':idproveedor' => $proveedorId))
          ->queryRow();
      return $proveedorName;
    }

    public function isDestination($code){
    $destino = Yii::app()->db->createCommand()
      ->select('nombre_en')
      ->from('destino')
      ->where('destino_clave = :code',  array(':code' => $code))
      ->queryScalar();
    if(empty($destino)){
      return false;
    }else{
      return true;
    }
  }

  public function isInterest($code){
    $interes = Yii::app()->db->createCommand()
      ->select('categoria_nombre_en')
      ->from('categoria_tour')
      ->where('categoria_clave_en = :code',  array(':code' => $code))
      ->queryScalar();
    if(empty($interes)){
      return false;
    }else{
      return interes;
    }
  }

    public function isSupplier($code){
        $supplier = Yii::app()->db->createCommand()
            ->select('proveedores')
            ->from('tour_proveedores')
            ->where('proveedores_clave = :code',  array(':code' => $code))
            ->queryScalar();
        if(empty($supplier)){
            return false;
        }else{
            return interes;
        }
    }

    public function getDestinationCode(){
        $destinos = Yii::app()->db->createCommand()
          ->select("destino_clave as dcodigo, nombre_en as dnombre")
          ->from('destino')     
          ->where("destino_id not in(15)")                
          ->order("nombre_en ASC")                    
          ->queryAll();
        return $destinos;
    }

    public function getDestinationCodeByName($nombre){
    $destino = Yii::app()->db->createCommand()
      ->select("destino_clave")
      ->from('destino')     
            ->where('nombre_en = :nombre',  array(':nombre' => $nombre))
      ->queryScalar();
    return $destino;
  }

  public function getCategoryCodeByName($nombre){
    $interes = Yii::app()->db->createCommand()
      ->select("categoria_clave_en")
      ->from('categoria_tour')
            ->where('categoria_nombre_en = :nombre',  array(':nombre' => $nombre))
      ->queryScalar();
    return $interes;
  }

    public function getActivitiesCasa($date){
      $Tours = Yii::app()->db->createCommand()
          ->select('t.tour_id, t.tour_nombre, t.tour_clave, d.destino_clave, td.descripcion_corta, MIN(tt.tarifa_precio_adulto) AS precio_adulto, tt.tarifa_precio_menor AS precio_menor, t.tour_galeria')
          ->from('tour_tarifa tt') 
          ->join("tour t", "t.tour_id = tt.tarifa_tour")              
          ->join("tour_descripcion td" , "td.descripcion_tour = tt.tarifa_tour")
          ->join("destino d", "d.destino_id = t.tour_destino") 
          ->where("t.tour_status = 1 AND :fecha BETWEEN tt.tarifa_fecha_inicio AND tt.tarifa_fecha_final AND td.descripcion_idioma = 1 AND t.tour_casa = 1 AND tarifa_id !='2615'", array(":fecha" => $date))
          ->group("tt.tarifa_tour")
          ->order("t.tour_casa DESC, precio_adulto ASC")
          ->queryAll();
      return $Tours;
    }

    public function getActivitiesByCategory($category, $date){
      $Tours = Yii::app()->db->createCommand()
          ->select('t.tour_id, t.tour_nombre, t.tour_clave, d.destino_clave, td.descripcion_corta, MIN(tt.tarifa_precio_adulto) AS precio_adulto, tt.tarifa_precio_menor AS precio_menor, t.tour_galeria')
          ->from('tour_tarifa tt') 
          ->join("tour t", "t.tour_id = tt.tarifa_tour")
          ->join("tour_categorias tc","categorias_tour = tour_id")        
          ->join("categoria_tour ct","categoria_id = categorias_categorias")             
          ->join("tour_descripcion td" , "td.descripcion_tour = tt.tarifa_tour")
          ->join("destino d", "d.destino_id = t.tour_destino") 
          ->where("ct.categoria_id = :categoria and t.tour_status = 1 and :fecha BETWEEN tt.tarifa_fecha_inicio and tt.tarifa_fecha_final and descripcion_idioma = 1 AND tarifa_id !='2615'",array(":categoria"=> $category,":fecha" => Yii::app()->GenericFunctions->convertUsableDates($date)))
          ->group("tt.tarifa_tour")
          ->order("t.tour_casa DESC, precio_adulto ASC")  
          ->queryAll();
      return $Tours;
    }

    public function getGolfActivities($date){
      $Tours = Yii::app()->db->createCommand()
          ->select('t.tour_id, t.tour_nombre, t.tour_clave, d.destino_clave, td.descripcion_corta, MIN(tt.tarifa_precio_adulto) AS precio_adulto, tt.tarifa_precio_menor AS precio_menor, t.tour_galeria')
          ->from('tour_tarifa tt') 
          ->join("tour t", "t.tour_id = tt.tarifa_tour")
          ->join("tour_categorias tc","categorias_tour = tour_id")        
          ->join("categoria_tour ct","categoria_id = categorias_categorias")             
          ->join("tour_descripcion td" , "td.descripcion_tour = tt.tarifa_tour")
          ->join("destino d", "d.destino_id = t.tour_destino") 
          ->where("ct.categoria_id = :categoria and t.tour_status = 1 and :fecha BETWEEN tt.tarifa_fecha_inicio and tt.tarifa_fecha_final and descripcion_idioma = 1 AND tarifa_id !='2615'",array(":categoria"=> 18,":fecha" => Yii::app()->GenericFunctions->convertUsableDates($date)))
          ->group("tt.tarifa_tour")
          ->order("t.tour_casa DESC, precio_adulto ASC")  
          ->queryAll();
      return $Tours;
    }

    public function getActivitiesByDestination($destination, $date){
      $Tours = Yii::app()->db->createCommand()
          ->select('t.tour_id, t.tour_nombre, t.tour_clave, d.destino_clave, td.descripcion_corta, MIN(tt.tarifa_precio_adulto) AS precio_adulto, tt.tarifa_precio_menor AS precio_menor, t.tour_galeria')
          ->from('tour_tarifa tt') 
          ->join("tour t", "t.tour_id = tt.tarifa_tour")              
          ->join("tour_descripcion td" , "td.descripcion_tour = tt.tarifa_tour")
          ->join("destino d", "d.destino_id = t.tour_destino") 
          ->where("t.tour_status = 1 AND t.tour_destino = :destino AND :fecha BETWEEN tt.tarifa_fecha_inicio AND tt.tarifa_fecha_final AND td.descripcion_idioma = 1 AND tarifa_id !='2615'", array(":destino"=>$destination,":fecha" => Yii::app()->GenericFunctions->convertUsableDates($date)))
          ->group("tt.tarifa_tour")
          ->order("t.tour_casa DESC, precio_adulto ASC")  
          ->queryAll();
      return $Tours;
    }


    public function getActivitiesBySupplier($proveedorId, $date){
      $Tours = Yii::app()->db->createCommand()
          ->select('tour_id, tour_nombre, tour_clave, destino_clave, descripcion_corta, MIN(tarifa_precio_adulto) AS precio_adulto, tarifa_precio_menor AS precio_menor, tour_galeria')
          ->from('tour_tarifa')     
          ->join("tour","tour_id = tarifa_tour")      
          ->join("tour_servicio","tarifa_servicio = servicio_id")             
          ->join("tour_descripcion","descripcion_tour = tour_id")             
          ->join("destino","destino_id = tour_destino")             
          ->join("pais","pais_id = destino_pais")             
          ->where("tour_status = 1 and tour_proveedor = :idproveedor and :fecha BETWEEN tarifa_fecha_inicio and tarifa_fecha_final and descripcion_idioma = :idioma",array(":idproveedor"=>$proveedorId,":fecha" => Yii::app()->GenericFunctions->convertUsableDates($date), ":idioma"=>Yii::app()->GenericFunctions->getLangId()))
          ->group("tour_id")                
          ->order("tour_casa DESC, tour_orden ASC,precio_adulto ASC")   
          ->queryAll();
      return $Tours;
    }



    public function getCategoriesByActivity($ToursId){
      if(is_array($ToursId)){
        $ToursId = implode(",",$ToursId);
      }
      
      $categories = Yii::app()->db->createCommand()
          ->select('categoria_nombre_' . Yii::app()->language . ' as cnombre, categorias_tour,categorias_id')
          ->from('tour_categorias')     
          ->join("categoria_tour","categorias_categorias = categoria_id")             
          ->where("categorias_tour IN(" . $ToursId . ")")                    
          ->queryAll(); 
      return $categories;
    }

    public function getPhotosByActivity($ToursGal){
      if(is_array($ToursGal)){
        $ToursGal = implode(",",$ToursGal);
      }

      $photos = Yii::app()->db->createCommand()
          ->select('foto_archivo, foto_galeria')
          ->from('foto')      
          ->join("galeria","foto_galeria = galeria_id")             
          ->where("foto_galeria IN(" . $ToursGal . ") and foto_miniatura = '1' ")                    
          ->queryAll();
      return $photos;
    }

    public function getPhotosByGallery($gallery){
      $photos = Yii::app()->db->createCommand()
          ->select('foto_archivo, foto_galeria')
          ->from('foto')      
          ->join("galeria","foto_galeria = galeria_id")             
          ->where("foto_galeria = :galeria and foto_miniatura = '0' ",array(":galeria"=>$gallery))                   
          ->order("foto_archivo") 
          ->queryAll();
      return $photos;
    }


    public function getActivityDeals(){
      $rows = Yii::app()->db->createCommand()
                ->select("promocion_id")
                ->from('promos')                      
                ->where('NOW() BETWEEN promocion_inicio and promocion_fin and promocion_sitio_aplica IN (0,1) and promocion_aplica_slider = 1 and promocion_en_listado = 1 and promocion_producto = "tour"')                    
                ->order("promocion_orden DESC, promocion_id DESC")
                ->queryAll();

      $promos = array();
      foreach($rows as $row){
        array_push($promos, new Deal($row['promocion_id']));
      }
      return $promos;
    }


    /* Devuelve los tours mas buscados */
    /* 1345 - ATV at Maroma Adventures
       1396 - Ultima Noche Pirata
       1348 - Waverunners at Maroma Adventures 
       1005 - Bonanza Jungle Horseback Ride
       234  - Xcaret Plus
    */
    public function getActivityMostWanted(){
      $rows = Yii::app()->db->createCommand()
          ->select('tour_id')
          ->from('tour')     
          ->where("tour_id = 1396 or tour_id = 1348 or tour_id = 1005 or tour_id = 234")
          ->order("tour_nombre")
          ->queryAll();
      
      $tours = array();
      foreach($rows as $row){
        array_push($tours, new Activity($row['tour_id']));
      }
      return $tours;
    }

    
    /* Devuelve todos los destinos */
    public function getActivityDestinations(){
      $rows = Yii::app()->db->createCommand()
          ->select('destino_id')
          ->from('destino')     
          ->order("destino_tours_orden")              
          ->queryAll();

      $destinations = array();
      foreach($rows as $row){
        array_push($destinations, new Destinations($row['destino_id']));
      }
      return $destinations;
    }

    public function getDestinationByCode($code){
      $destino = Yii::app()->db->createCommand()
          ->select("destino_id as id, nombre_en as nombre")
          ->from('destino')                     
          ->where("destino_clave = :clave",array(":clave" => $code))
          ->queryRow();
      return $destino;
    }

    public function getInterestByCode($code){
    $interest = Yii::app()->db->createCommand()
      ->select("categoria_id as id, categoria_nombre_en as nombre")
      ->from('categoria_tour')      
            ->where('categoria_clave_en = :clave',  array(':clave' => $code))
      ->queryRow();
    return $interest;
  }

    /* Devuelve todos las categorias de tours */
    public function getActivityCategories(){
      $rows = Yii::app()->db->createCommand()
          ->select('categoria_id')
          ->from('categoria_tour')
	        ->where('categoria_estado=1')
          ->order("categoria_orden")
          ->queryAll();

      $categories = array();
      foreach($rows as $row){
        array_push($categories, new ActivityCategory($row['categoria_id']));
      }
      return $categories;
    }


}

?>