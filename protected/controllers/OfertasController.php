<?php

class OfertasController extends CController
{

	public function actionIndex(){

		$_Promociones = Yii::app()->db->createCommand()
						    ->select("*")
						    ->from('promos')									    
						    ->where(':date BETWEEN promocion_inicio and promocion_fin and promocion_sitio_aplica IN (0,1) and promocion_en_listado = 1',array(":date"=>date("Y-m-d")))								    
						     ->order("promocion_orden")
						    ->queryAll();
		/* enviar las trending notes de Mexico news en la seccio9n de travel*/
		$notasFooter=Yii::app()->GenericFunctions->notasFooter();

		
		$params=array(
			"_Promociones"=>$_Promociones,
			'notas2'=>$notasFooter
			);

		$cs = Yii::app()->getclientScript(); 
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/page/ofertas/ofertas.css');
		$this->render('index',$params);
	}

}
?>