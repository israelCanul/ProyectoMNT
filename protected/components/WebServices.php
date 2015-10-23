<?php
class WebServices extends CApplicationComponent{

	public function consumeService($params)
	{
		$_HOST = "http://" . $_SERVER["SERVER_NAME"] . "/iServices.php";
		foreach ($params as $key => &$val) {
			if (is_array($val)) $val = implode(',', $val);
			$post_params[] = $key.'='.urlencode($val);
		}
		$post_string = implode('&', $post_params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $_HOST);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'curl');
		curl_setopt($ch, CURLOPT_TIMEOUT, 600);
		$result = curl_exec($ch);
		curl_close($ch);

		return unserialize($result);
	}

	public function requestService($url,$params)
	{
		foreach ($params as $key => &$val) {
			if (is_array($val)) $val = implode(',', $val);
			$post_params[] = $key.'='.urlencode($val);
		}
		$post_string = implode('&', $post_params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'curl');
		curl_setopt($ch, CURLOPT_TIMEOUT, 600);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

	public function consumeServiceXML($url,$xml){
		$url = $url;
		$vars = "&xml=" . (urlencode($xml));
		$header[] = "Content-type: application/x-www-form-urlencoded";
		$ch = curl_init();
		$postfields = "info_asj3=1".$vars;


		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 250);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		$data = curl_exec($ch);


		if(isset($_REQUEST["debug"])){
			echo "<pre>";
			print_r($xml);
			print_r($data);

			echo "</pre>";

		}

		

		if (curl_errno($ch)) {
			$data = curl_error($ch);
		} else {
			curl_close($ch);
		}

		$a = simplexml_load_string($data);
		if($a===FALSE) {
			return "";
		} else {
			return simplexml_load_string($data);
		}


	}

	public function getKey($length){
		$characters = "0123456789ABCDEFGHIJKLMNOPQRSTUV";
		$string = "";
		for ($p = 1; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return $string;
	}

	public function getSecureKey($length){
		$characters = "-_.;,=+/|?¡0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-_.;,=+/|?¡abcdefghijklmnopqrstuvwxyz-_.;,=+/|?¡";
		$string = "";
		for ($p = 1; $p <= $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return utf8_encode($string);
	}

	public function findSessionVuelo($_Sess,$_params){
		if(sizeof($_Sess) > 0){
			$return = false;
			$rKey = "";
			foreach($_Sess as $k => $_s){
				$_p = $_s["Parametros"];

				if($_p["flight_type"] == $_params["flight_type"] && $_p["flight_departure"] == $_params["flight_departure"] && $_p["flight_arrival"] == $_params["flight_arrival"] && $_p["flight_origen"] == $_params["flight_origen"] && $_p["flight_destino"] == $_params["flight_destino"] && $_p["flight_adults"] == $_params["flight_adults"] && $_p["flight_childs"] == $_params["flight_childs"]){
					$return = true;
					$rKey = $k;
				}

			}

			if($return){
				return $rKey;
			}else{
				return "";
			}

		}else{
			return "";
		}
	}
	public function findSessionHotel($_Sess,$_params){
		if(sizeof($_Sess) > 0){
			$return = false;
			$rKey = "";
			foreach($_Sess as $k => $_s){
				$_p = $_s["Parametros"];

				if(1==2){
					$return = true;
					$rKey = $k;
				}

			}

			if($return){
				return $rKey;
			}else{
				return "";
			}

		}else{
			return "";
		}
	}

}
?>
