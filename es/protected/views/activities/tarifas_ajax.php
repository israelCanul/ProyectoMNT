<?php
unset($_SESSION['datosKey']);
$MealPlans = array();
$x         = 0;
$firstTarifa = false;
foreach ($Tarifas as $z) {
	$price = 0;
	if ($z["tarifa_tipo_cobro"] == 1 || $z["tarifa_tipo_grupo"] == 0) {
		$ad = $_ad * $z["tarifa_precio_adulto"];
		$mn = $_mn * $z["tarifa_precio_menor"];
		$price = $ad + $mn;
	} else {
		if ($z['tarifa_es_paquete'] == 1) {
			$numpersonas = $_ad + $_mn;
			$price = ceil($numpersonas / $z["tarifa_max_adultos"]);
			$price = $price * $z["tarifa_precio_adulto"];
		} else {
			$price = $z["tarifa_precio_adulto"];
		}
	}

	//Validacion para precio de parejas del tour romantic yate  =>
	if ($z["tarifa_tour"] == 1302 && $z["tarifa_id"] == 5301) {
		if (($_ad % 2) == 0) {
			$price = ($_ad / 2) * $z["tarifa_precio_adulto"];
		} else {
			$z["opera_Dia"] = "false";
			$z["opera_Dia_descripcion"] = "Available only for couples";
		}
	}


	//Convierte a dolares la tarifa si la tarifa_tipo_cobro es MXN
	if ($z["tarifa_tipo_tarifa"] == 2) {
		$price = Yii::app()->Currency->convertMXN($_SESSION["config_es"]["currency"], $price);
	} else {
		$price = Yii::app()->Currency->convert($_SESSION["config_es"]["currency"], $price);
	}

	if (trim($z["tarifa_nombre_" . Yii::app()->language]) != "") {
		$departing = $z["tarifa_nombre_" . Yii::app()->language];
	} else {
		$departing = $z["servicio_" . Yii::app()->language];
	}



	if ($z["tarifa_tipo_cobro"] == 1) {
		if ((int)$z["tarifa_precio_adulto"] != 0) {

			//Convierte a dolares la tarifa si la tarifa_tipo_cobro es MXN
			if ($z["tarifa_tipo_tarifa"] == 2) {
				$tarifa_precio_adulto = Yii::app()->Currency->convertMXN($_SESSION["config_es"]["currency"], $z["tarifa_precio_adulto"]);
				$tarifa_precio_menor = Yii::app()->Currency->convertMXN($_SESSION["config_es"]["currency"], $z["tarifa_precio_menor"]);
			} else {
				$tarifa_precio_adulto = Yii::app()->Currency->convert($_SESSION["config_es"]["currency"], $z["tarifa_precio_adulto"]);
				$tarifa_precio_menor = Yii::app()->Currency->convert($_SESSION["config_es"]["currency"], $z["tarifa_precio_menor"]);
			}
		}

		if ($_t["tour_id"] != 73) {
			if ($z["tarifa_precio_menor"] != 0) {
			}
		}
	}


	$openTk=0;
	if($_REQUEST["openTk"]==1){
		$openTk=1;
	}
	if ($z["opera_Dia"] == "true") {
		$firstTarifa = true;
		echo "<form method='post' action='".$this->createUrl("tour/agregar")."'>";
		echo '<label> ' . $z['tarifa_nombre_en'] . '<span>'. $_SESSION["config_es"]["currency"] . " $". number_format($price,0) .'</span>'. '</label>';
		echo '<div class="rate-book prod_total_list"><input type="submit"  class="misc_select_btn_green" value="' . "BOOK" . '" /></div>';
		echo "<input type=\"hidden\" name=\"jnfe\" value=\"" . Yii::app()->GenericFunctions->ProtectVar($z["tarifa_id"] . "@@" . $_t["tour_id"] . "@@" . $z["servicio_id"] . "@@" . ((Yii::app()->language == "es") ? $_t["tour_nombre_es"] : $_t["tour_nombre"]) . "@@" . $z["tarifa_nombre_" . Yii::app()->language] . "@@" . $_t["descripcion_corta"] . "@@" . $z["tarifa_precio_adulto_mxp"] . "@@" . $price . "@@" . $_t["tour_reservable"] . "@@" . $_fecha . "@@" . $_ad . "@@" . $_mn . "@@" . $_t["tour_destino"] . "@@//apstatic.lomastravel.com.mx/180/" . $_imgPrincipal . "@@" . $openTk . "@@" . number_format($tarifa_precio_adulto,0,",",""). "@@" . number_format($tarifa_precio_menor,0,",",""). "") . "\" checked=\"checked\" /></td>";
		echo "<input type='hidden' name = 'chekoutTour' value ='1'>";
		$_SESSION['datosKey'][] = Yii::app()->GenericFunctions->ProtectVar($z["tarifa_id"] . "@@" . $_t["tour_id"] . "@@" . $z["servicio_id"] . "@@" . ((Yii::app()->language == "es") ? $_t["tour_nombre_es"] : $_t["tour_nombre"]) . "@@" . $z["tarifa_nombre_" . Yii::app()->language] . "@@" . $_t["descripcion_corta"] . "@@" . $z["tarifa_precio_adulto_mxp"] . "@@" . $price . "@@" . $_t["tour_reservable"] . "@@" . $_fecha . "@@" . $_ad . "@@" . $_mn . "@@" . $_t["tour_destino"] . "@@//apstatic.lomastravel.com.mx/180/" . $_imgPrincipal . "@@" . $openTk . "@@" . number_format($tarifa_precio_adulto,0,",",""). "@@" . number_format($tarifa_precio_menor,0,",",""). "");
		echo "</form>";
	}else{

		if ($firstTarifa == false) {
			echo "<div class = 'rate_no_available'>";
			if ($z["opera_Dia_descripcion"] != '') {
				echo $z['tarifa_nombre_en'] . ' - '. $z["opera_Dia_descripcion"];
			}else{
				if($z['opera_Dia_nino'] != ''){
					echo $z['opera_Dia_nino'];

				}else{
					echo "Available on the following days: ";
					$days = array();
					if ($_t['opera_lunes'] == 1) {
						$days[]= "Monday";
					}
					if ($_t['opera_martes'] == 1) {
						$days[]= "Tuesday";
					}
					if ($_t['opera_miercoles'] == 1) {
						$days[]= "Wednesday";
					}
					if($_t['opera_jueves'] == 1){
						$days[]= "Thursday";
					}
					if($_t['opera_viernes'] == 1){
						$days[]="Friday";
					}
					if($_t['opera_sabado'] == 1){
						$days[]= "Saturday" ;
					}
					if($_t['opera_domingo'] == 1){
						$days[]= "Sunday";
					}
					echo implode(" , ", $days);

					break;
				}
			}
			echo "</div>";
		}
	}
}
?>