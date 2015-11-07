<?php
	class MexInit {
		public static function beginRequest(CEvent $event) {
			session_start();
			
			if(!isset($_SESSION["config"]["currency"]) || !isset($_SESSION["config"]["token"])){
				$_SESSION["config"] = array();
				$_SESSION["config"]["currency"] = "MXN";
				$_SESSION['pais'] = Yii::app()->GenericFunctions->detectarPais();
		
				if ($_SESSION['pais'] != 'MX') {
					$_SESSION["config"]["currency"] = 'USD';
				}


				$_SESSION["config"]["token"] = Yii::app()->WebServices->getSecureKey(150);				
			}

			


			Yii::app()->params['assets'] = '1';
			Yii::app()->layout 	 = "main";
			Yii::app()->language = "es";
			
			

		}
	}
?>
 