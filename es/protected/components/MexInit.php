<?php
	class MexInit {
		public static function beginRequest(CEvent $event) {
			session_start();
			
			$_SESSION['pais'] = Yii::app()->GenericFunctions->detectarPais();
			$_SESSION["config_es"]["currency"] = "MXN";
			if ($_SESSION['pais'] != 'MX') {
				$_SESSION["config_es"]["currency"] = 'USD';
			}
			
			if(!isset($_SESSION["config_es"]["currency"]) || !isset($_SESSION["config_es"]["token"])){
				$_SESSION["config_es"] = array();			
				
		        
				$_SESSION["config_es"]["token"] = Yii::app()->WebServices->getSecureKey(150);				
			}

			
			

			Yii::app()->params['assets'] = '1';
			Yii::app()->layout 	 = "main";
			Yii::app()->language = "es";
			Yii::app()->params['Moneda']=$_SESSION["config_es"]["currency"];
			
			

		}
	}
?>
 