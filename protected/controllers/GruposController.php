<?php

class GruposController extends CController
{
	public $pageDescription;
	public $pageKeywords;

	public function actionIndex()
	{
		$_banners = Yii::app()->db->createCommand()
							    ->select('*')
							    ->from('banners')			
							    ->where("sitio_id = 1 and seccion = :section",array(":section"=>"grupos"))			
								->order("orden asc")				
							    ->queryAll();
		$cs = Yii::app()->getclientScript();
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/grupos.js?v=2',CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/slide-show-min.js?v=4',CClientScript::POS_END);
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/grupos.min.css',CClientScript::POS_END);

		$this->pageTitle="Transfers & Tours for Groups in Cancun & Riviera Maya | Lomas Travel";
		$this->render('index',array("_banners"=>$_banners));
	}
}
?>	