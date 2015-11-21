<?

class GenericFunctions extends CApplicationComponent{  
	
	public function detectarPais(){
			require_once($_SERVER['DOCUMENT_ROOT']."/es/includes/getRealIP.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/es/includes/geoip.inc");
			$gi = geoip_open($_SERVER['DOCUMENT_ROOT']."/es/includes/GeoIP.dat",GEOIP_STANDARD);
			$ipCliente = getRealIP();
			$t_cod_pais = geoip_country_code_by_addr($gi, $ipCliente);
			if ($ipCliente == '127.0.0.1') {
				$t_cod_pais = 'MX';
			}
			return $t_cod_pais;
	}

	public function notasFooter(){
		$notasFooter=Yii::app()->dbNews->CreateCommand("SELECT c.idcontenido, c.titulo,c.meta_description,c.uri
												FROM ws_contenido AS c 
												WHERE idcategoria='23' 
												AND idstatus='1' 
												AND buen_entendedor=0												
												ORDER BY fecha DESC
												LIMIT 0,4")->queryAll();
		return $notasFooter;
	}

	public function makeUrl($name){
			$url = strtolower($name);
			$url = str_replace(" ","_",$url);
			$url = str_replace("&","",$url);
			$url = str_replace("-","",$url);
			$url = str_replace(",","",$url);
			$url = str_replace("+","",$url);
			$url = str_replace(".","",$url);
			$url = str_replace(";","",$url);
			$url = str_replace("(","",$url);
			$url = str_replace(")","",$url);
			$url = str_replace("/","",$url);
			$url = str_replace("\\","",$url);
			$url = str_replace(":","",$url);
			$url = str_replace("'","",$url);
			$url = str_replace("\"","",$url);
			$url = str_replace("#","",$url);
			$url = str_replace("$","",$url);
			$url = str_replace("__","_",$url);
			$url = str_replace("á","a",$url);
			$url = str_replace("é","e",$url);
			$url = str_replace("í","i",$url);
			$url = str_replace("ó","o",$url);
			$url = str_replace("ú","u",$url);
			$url = str_replace("ñ","n",$url);
			$url = urlencode($url);
			return $url;
	}
	
	public function convierteFechaLetra($fecha,$idioma,$completo){
			list ($dia,$mes, $anio) = explode("/",$fecha);
			//Domingo es 0
			$numDiaSemana = date("w",strtotime($anio."-".$mes."-".$dia));
			$meses_ing_letra=array("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"May", "06"=>"June",
			       "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");
	        $meses_esp_letra=array("01"=>"Enero", "02"=>"Febrero", "03"=>"Marzo", "04"=>"Abril", "05"=>"Mayo", "06"=>"Junio",
                    "07"=>"Julio", "08"=>"Agosto", "09"=>"Septiembre", "10"=>"Octubre", "11"=>"Noviembre", "12"=>"Diciembre");
	        $dia_esp_letra=array("0"=>"Domingo", "1"=>"Lunes", "2"=>"Martes", "3"=>"Miercoles", "4"=>"Jueves", "5"=>"Viernes","6"=>"Sabado");
	        $dia_ing_letra=array("0"=>"Sunday", "1"=>"Monday", "2"=>"Tuesday", "3"=>"Wednesday", "4"=>"Thursday", "5"=>"Friday","6"=>"Saturday");
			    switch($idioma) {
			   	  case '1':$fecha_letra=(($completo==1) ? $meses_ing_letra[$mes]." ".$dia.", ".$anio : substr($meses_ing_letra[$mes],0,3)." ".$dia.", ".$anio);
			   	  		   break;
				  case '2':$fecha_letra=(($completo==1) ? $dia." de ".$meses_esp_letra[$mes]." de ".$anio : $dia." de ".substr($meses_esp_letra[$mes],0,3)." de ".$anio);
				  		   break;
				  case '3':$fecha_letra=(($completo==1) ? $dia_ing_letra[$numDiaSemana].", $dia/".$meses_ing_letra[$mes]."/$anio" : substr($dia_ing_letra[$numDiaSemana],0,3).", $dia/".substr($meses_ing_letra[$mes],0,3)."/$anio");
					  	   break;
				  case '4':$fecha_letra=(($completo==1) ? $dia_esp_letra[$numDiaSemana].", $dia/".$meses_esp_letra[$mes]."/$anio" : substr($dia_esp_letra[$numDiaSemana],0,3).", $dia/".substr($meses_esp_letra[$mes],0,3)."/$anio");
				  		   break;
				  case '5':$fecha_letra=(($completo==1) ? $dia_ing_letra[$numDiaSemana]." $dia ".$meses_ing_letra[$mes]." $anio" : substr($dia_ing_letra[$numDiaSemana],0,2)." $dia ".substr($meses_ing_letra[$mes],0,3)." ".substr($anio,2,2));
					  	   break;
				  case '6':$fecha_letra=(($completo==1) ? $dia_esp_letra[$numDiaSemana].", $dia/".$meses_esp_letra[$mes]."/$anio" : substr($dia_esp_letra[$numDiaSemana],0,3).", $dia/".substr($meses_esp_letra[$mes],0,3)."/$anio");
				  		   break;
			    }
			return $fecha_letra;
	}


	public function makeStars($i,$big = "jpg"){
			$i = number_format($i,1);
			$half = substr($i,-1,1);
			$i = str_replace(".0","",$i);
			$i = str_replace(".5","",$i);
			$html = "";

			if($i <= 6){
				for($z = 0;$z < $i;$z++){
					$html .= "<img style='border: 0px !important;' src='/images/icon/prod_star.{$big}' alt='$i estrellas' />";
				}
				if($half == 5){
					$html .= "<img style='border: 0px !important;' src='/images/icon/prod_half_star.{$big}' alt='$i estrellas' />";
				}

			}else{
				if($i == 7) $html = "<span class='hCategoryName' style='font-size: 8pt; font-weight: normal; color: #14b0c7;'>Boutique</span>";
				if($i == 8) $html = "<span class='hCategoryName' style='font-size: 8pt; font-weight: normal; color: #14b0c7;'>Special Category</span>";
				if($i == 8) $html = "<span class='hCategoryName' style='font-size: 8pt; font-weight: normal; color: #14b0c7;'>Gran Turismo</span>";
			}
			return $html;
	}
		
	public function strtoupper($cadena){
			$cadena = strtoupper($cadena); 
			$cadena = str_replace("á", "Á", $cadena); 
			$cadena = str_replace("é", "É", $cadena); 
			$cadena = str_replace("í", "Í", $cadena); 
			$cadena = str_replace("ó", "Ó", $cadena); 
			$cadena = str_replace("ú", "Ú", $cadena); 
			return ($cadena); 
	}

    public function obtenerHotelHabitacionCargos($amenidad,$habitacion){
                    $_LP =  Yii::app()->dbWeblt->createCommand()
                    ->select("*")
                    ->from('habitaciones_amenidades')
                    ->where("amenidad=".$amenidad." and habitacion=".$habitacion)	
                    ->queryRow(); 
 					return $_LP["cargo"];
    }

    public function obtenerHotelCargos($amenidad,$hotel){
                    $_LP =  Yii::app()->dbWeblt->createCommand()
                    ->select("*")
                    ->from('hoteles_amenidades')
                    ->where("amenidad=".$amenidad." and hotel=".$hotel)	
                    ->queryRow(); 
                	return $_LP;
    } 

	public function ProtectVar($password){
			$encryptedPass = str_rot13(base64_encode(serialize($password . "LomasCiPhrase")));
			return $encryptedPass;
	}

    public function ProtectVarATS2($password){
			$encryptedPass = str_rot13(base64_encode(serialize($password . "ATS2.0")));;		
			return $encryptedPass;
	}

    public function ShowVar($password){
			$decodePass = unserialize(base64_decode(str_rot13($password)));		
			$decodePass = explode("LomasCiPhrase",$decodePass);
			$decodePass = $decodePass[0];		
			return $decodePass;
	}	



	public function makeSinAcento($name){
			$url = $name;
			$url = str_replace("á","a",$url);
			$url = str_replace("é","e",$url);
			$url = str_replace("í","i",$url);
			$url = str_replace("ó","o",$url);
			$url = str_replace("ú","u",$url);
			$url = str_replace("ñ","n",$url);
			$url = str_replace("Á","a",$url);
			$url = str_replace("É","e",$url);
			$url = str_replace("Í","i",$url);
			$url = str_replace("Ó","o",$url);
			$url = str_replace("Ú","u",$url);
			$url = str_replace("Ñ","n",$url);			
			return $url;
	}

	public function convertDate($date){
		if(Yii::app()->language == "es"){
			list ($dia,$mes,$anio) = explode("/",$date);
			$dias 		= array(1=>"lunes", 2=>"martes", 3=>"miércoles", 4=>"jueves", 5=>"viernes", 6=>"sábado", 7=>"domingo");
			$meses 		= array("01" =>"Ene","02" => "Feb", "03" =>"Mar", "04" =>"Abr", "05" =>"May", "06" =>"Jun", "07" =>"Jul", "08" =>"Ago", "09" =>"Sep", "10" =>"Oct", "11" =>"Nov", "12" => "Dic");
			$diaSemana 	= date('N', strtotime($anio.'-'.$mes.'-'.$dia));

			return $dias[$diaSemana].', '.$dia.'/'.$meses[$mes].'/'.$anio;
		}else{
			return date('l, M d, Y', strtotime($date));
		}
	}

	public function convertUsableDates($date){
			$nDate = "";

			$tmp = explode("/",$date);
			if(Yii::app()->language == "es"){
				$nDate = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
			}else{
				$nDate = $tmp[2] . "-" . $tmp[0] . "-" . $tmp[1];
			}			

			return $nDate;
	}

	public function difDays($a,$b){
			$gd_a = getdate(strtotime($a));
			$gd_b = getdate(strtotime($b));
			$a_new = mktime(12,0,0,$gd_a['mon'],$gd_a['mday'],$gd_a['year']);
			$b_new = mktime(12,0,0,$gd_b['mon'],$gd_b['mday'],$gd_b['year']);
			return round(abs($a_new-$b_new)/86400);
	}

	public function getRealIpAddr(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return trim($ip);
	}

	public function getLangId(){
		$idLang = array("en"=>1,"es"=>2);
		return $idLang[Yii::app()->language];
	}

	public function convertPresentableDates($date){
		$nDate = "";
		if(Yii::app()->language == "es"){
			$nDate = date("d/m/Y",strtotime($date));
		}else{
			$nDate = date("m/d/Y",strtotime($date));
		}
		return $nDate;
	}
	public function makeComboInt($min,$max,$selected = 0,$strAd = ""){
		$strInput = "";
		for($i=$min;$i<=$max;$i++){
			if($selected == $i){
				$strInput .= "<option selected='selected' value='{$i}'>{$i}{$strAd}</option>";
			}else{
				$strInput .= "<option value='{$i}'>{$i}{$strAd}</option>";
			}
		}
		return $strInput;
	}

	public function scriptsTours(){
		$cs= Yii::app()->getclientScript();
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-core.min.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-pagination-bundle.min.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/jPList/jplist-jquery-ui-bundle.min.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/activities/tours.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/react.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/JSXTransformar.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/tour.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist-core.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.sort-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.pagination-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/jPList/jplist.jquery-ui-bundle.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
	}

	public function scriptsTour(){
		$cs= Yii::app()->getclientScript();
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/activities/tours.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/owlcarousel/owl.carousel.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/plugins/owlcarousel/owl.theme.min.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/react.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/JSXTransformar.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/tourDetalle.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/plugins/owlcarousel/owl.carousel.min.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/activities/tours.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);

	}
	public function scriptsTransfer(){
		$cs= Yii::app()->getclientScript();
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/transfers/transfers.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/react.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/JSXTransformar.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/transferList.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/transfers/transfers.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
	}

	public function buildFlightTimeCombo(){
	         $xHTML = "";
	         	for($h=0; $h <= 11; $h++){
		         	for($m = 0; $m <= 55; $m+=5){
			         	$xHTML .= "<option value='" . str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . " am'>" . str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . " am</option>";
		         	}
	         	}
			 	$h = 12;
		        for($m = 0; $m <= 55; $m+=5){
		         	if($m == 0){
			         	$xHTML .= "<option selected='selected' value='" . str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . " pm'>" . str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . " pm</option>";
		         	}else{
			         	$xHTML .= "<option value='" . str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . " pm'>" . str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . " pm</option>";
		         	}
	         	}
	         	for($h=1; $h <= 11; $h++){
			         for($m = 0; $m <= 55; $m+=5){
			         	$xHTML .= "<option value='" . str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . " pm'>" . str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . " pm</option>";
		         	}
	         	}
	    return $xHTML;
    }
	
	function mostrar_dias($fecha) {  
		$dia = date("l", $fecha); 
		switch($dia) {
			case "Sunday": $resultado = "Domingo"; break;
			case "Monday": $resultado = "Lunes"; break;
			case "Tuesday": $resultado = "Martes"; break;
			case "Wednesday": $resultado = "Miércoles"; break;
			case "Thursday": $resultado = "Jueves"; break;
			case "Friday": $resultado = "Viernes"; break;
			case "Saturday": $resultado = "Sábado"; break; 
		}
		return $resultado;
	}

}
?>