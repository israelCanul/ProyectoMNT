<?

class GenericFunctions extends CApplicationComponent{  

	public function notasFooter(){
		$notasFooter=Yii::app()->dbNews->CreateCommand("SELECT c.idcontenido, c.titulo, c.uri AS uri,alt,data,c.meta_description
										     FROM ws_contenido c, ws_categoria ca,ws_imagenes AS img
										     WHERE c.ididioma = '2' AND c.`idcontenido`=img.`idcontenido` 
										     AND ca.ididioma = '2' 
										     AND c.counter > 0 
										     AND ca.idcategoria=c.idcategoria 
										     AND c.idcategoria='4' 
										     AND c.idstatus='1'
										     GROUP BY c.titulo
										     ORDER BY c.counter DESC LIMIT 0,4")->queryAll();
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
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/react.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/JSXTransformar.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/build/tourDetalle.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
	}
}
?>