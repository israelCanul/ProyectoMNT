<?php
	class MexInit {
		public static function beginRequest(CEvent $event) {
			session_start();
			if(!isset($_SESSION["config"]["token"])){
				$_SESSION["config"] 			= array();
				$_SESSION["config"]["token"] 	= Yii::app()->WebServices->getSecureKey(150);
				$_SESSION["config"]["currency"] = "USD";

			}


			Yii::app()->params['currency']='USD';
			Yii::app()->params['assets'] = '1';
			Yii::app()->layout 	 = "main";
			Yii::app()->language = "en";
			
			

		}
	}
?>
 