<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{ 
		$notas=Yii::app()->dbNews->CreateCommand("SELECT titulo,meta_description,uri,alt,DATA 
												FROM ws_contenido AS cont,ws_imagenes AS img 
												WHERE cont.idcontenido=img.idcontenido
												AND idcategoria='3' 
												AND idstatus='1' 
												AND buen_entendedor=0
												GROUP BY img.idcontenido
												ORDER BY fecha DESC
												LIMIT 0,5")->queryAll();
		/*print_r($notas);
		exit();*/
		/* destinos de los tours */
		$_dest 	= new Destination();
		$destinations['top'] = $_dest->getTopDestinations();


		$cs = Yii::app()->getclientScript(); 
		$cs->registerCssFile(Yii::app()->params['baseUrl'].'/css/page/home.css');	
		$params=array(
			'notas'=>$notas,
			'destinations'=>$destinations);
		$this->render('index',$params);
	}





	public function actionNews()
	{
		$notas=Yii::app()->dbNews->CreateCommand("SELECT titulo,meta_description,uri,alt,DATA 
												FROM ws_contenido AS cont,ws_imagenes AS img 
												WHERE cont.idcontenido=img.idcontenido
												AND idcategoria='3' 
												AND idstatus='1' 
												AND buen_entendedor=0
												GROUP BY img.idcontenido
												ORDER BY fecha DESC
												LIMIT 0,25")->queryAll();



		$params=array(
			'notas'=>$notas,
			);
        
        $cs = Yii::app()->getclientScript();
        /*Se inicializa la clase de mansorny para acomodar los datos de la noticias*/
        $cs->registerScriptFile(Yii::app()->params["baseUrl"] . '/js/masonry.js', CClientScript::POS_END);
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/page/news.css');	        
		$this->render('news',$params);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{	
		
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}else{
			$error=$_REQUEST['error'];
			$this->render('error', $error);
		} 
	}

	public function actionPrivacy(){	    	
		$cs = Yii::app()->getclientScript();
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/text.min.css?a='. Yii::app()->params['assets'],'screen, projection');
		$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/checkout/checkout.css?a='. Yii::app()->params['assets'],'screen, projection');
		$this->layout='checkout';
		$this->render("privacy");	    	
	}
	public function actionContact(){

		$mail = new PHPMailer(true);
		$mail->isSMTP(); 
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true; 
		$mail->Username = "envios@lomas-travel.com";
		$mail->Password = "r5J8Rg<S";
		$mail->SMTPSecure = "tls"; 
		$mail->Port = 587;
			
		$from 	= 'envios@lomas-travel.com';
		
		switch ($_POST['cboDepartamento']){
			case 'Sales' 	: $to = 'sales@lomas-travel.com'; break;
			case 'Webmaster': $to = 'webmaster@lomas-travel.com'; break;
		}
		//pruebas
		if($_POST['email']=='icanul@dexabyte.com.mx' || $_POST['email']=='icanul@dexabyte.com'){
			$to = $_POST['email'];
		}
		

		$bcc 	= 'lcaballero@dexabyte.com.mx';
		$cco 	= 'webmaster@lomas-travel.com';
		$cco2 	= 'e-marketing@lomas-travel.com';

		$subject = 'Contact Request | Lomas Travel';
		$message = $this->renderPartial('application.views.partials.contact', $_REQUEST, true);

		$mail->SetFrom( $from );
		$mail->AddAddress ( $to );
		//$mail->AddBCC( $bcc );
		//$mail->AddBCC( $cco );
		//$mail->AddBCC( $cco2 );

		$mail->Subject = $subject;
		$mail->MsgHTML( $message );
		
		if(!$mail->Send()) {
			echo 'Estamos experimentando dificultades técnicas. Por favor inténtelo más tarde';
		} else {
			echo 'Gracias por suscribirse a nuestro boletín. ¡Pronto recibirá información y nuestras mejores promociones!';
		}
	}

	public function actionEnviamail(){

		$correoExiste = Yii::app()->db->createCommand()
        	->select('idcorreo')
        	->from('newsletter')
        	->where('correo = "'. $_REQUEST["email"]. '" AND sitio = 1 AND estatus = 1 ')
        	->queryRow();

		if(empty($correoExiste)){
			$sql 	= "INSERT INTO newsletter (correo, sitio, estatus, fecha_registro , name , country , city) values ( :correo, :sitio, :estatus, :fecha_registro, :name, :country, :city)";
			$params = array(
					'correo'         => $_REQUEST["email"],
					'sitio'          => 1,
					'estatus'        => 1,
					'fecha_registro' => date("Y-m-d"),
					'name'	=> $_REQUEST['name'],
					'country'	=> $_REQUEST['country'],
					'city'	=> $_REQUEST['city']
				);

			Yii::app()->db->createCommand($sql)->execute($params);

			
			$mail = new PHPMailer(true);
			$mail->isSMTP(); 
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true; 
			$mail->Username = "envios@lomas-travel.com";
			$mail->Password = "r5J8Rg<S";
			$mail->SMTPSecure = "tls"; 
			$mail->Port = 587;
			
			$from 	= 'envios@omas-travel.com';
			$to 	= $_REQUEST["email"];
			$bcc 	= 'icanul@dexabyte.com.mx';
			//$cco 	= 'webmaster@lomas-travel.com';

			$subject = 'Newsletter Lomas Travel';
			$message =	$this->renderPartial('application.views.partials.boletin', $_REQUEST, true);

			$mail->SetFrom( $from );
			$mail->AddAddress ( $to );
			$mail->AddBCC( $bcc );
			//$mail->AddBCC( $cco );

			$mail->Subject = $subject;
			$mail->MsgHTML( $message );


			if(!$mail->Send()) {
				echo 'Estamos experimentando dificultades técnicas. Por favor inténtelo más tarde';
			} else {
				echo 'Gracias por suscribirse a nuestro boletín. ¡Pronto recibirá información y nuestras mejores promociones!';
			}
			exit();
		}else{
			echo 'Usted ya esta subscrito en nuestro newsletter.';
		}
	}

	public function actionBuscar(){
		//print_r($_REQUEST);
		$dateCheckin=date('m/d/Y', strtotime('+2 day'));

		$_hotel   = new Hotel();
		$destinos = $_hotel->getCiudadesMexico();
		$Hoteles  = $_hotel->getHotelsSearch();
		//print_r("<pre>");
		foreach($destinos as $l){
			$pos= strpos(strtolower(GenericFunctions::makeSinAcento($l["ciudad_nombre"])), $_REQUEST['word_search']);
			if($pos === false){
			   // echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'<br>";
			} else {
			    $url=Yii::app()->params["baseUrl"]."destinations/".GenericFunctions::makeUrl( GenericFunctions::makeSinAcento($l["ciudad_nombre"])).".html";
			    $strClave['destinos'][]=array('label'=>$l["ciudad_nombre"],'url'=>$url);
			}
		}

		foreach($Hoteles as $l){
			//$pos= strnatcasecmp(GenericFunctions::makeSinAcento($l["hotel_nombre"]), $_REQUEST['word_search']);			
			$pos=strpos(strtolower(GenericFunctions::makeSinAcento($l["hotel_nombre"])), $_REQUEST['word_search']);
			if($pos === false){
				//
			} else {
			    $url=Yii::app()->params["baseUrl"]."destinations/".GenericFunctions::makeSinAcento($l["hotel_keyword"]).".html";
			    $strClave['hoteles'][]=array('label'=>$l["hotel_nombre"],'url'=>$url);
			}			
		}
		
		
		$tours= file_get_contents(Yii::app()->params['api']."/restTours/destinations?lan=es");		
		$tours=json_decode($tours);

		foreach ($tours as $key => $value) {

			$pos=strpos(strtolower(GenericFunctions::makeSinAcento($value->label)), $_REQUEST['word_search']);
			
			if($pos === false){
				//
			} else {

				if($value->tipo=='destination'){
					$url=Yii::app()->params["baseUrl"]."toursByDest/".$value->clave.".html?tour_destination=".GenericFunctions::makeSinAcento($value->label)."&tipo=destination&cat=&dest=".$value->id."&TourId=&sup=&openTk=0&seg=&tour-Checkin=".$dateCheckin."&tour_adults=2&tour_child=0&action=&PHPSESSID=9369665a1a4cae8bfe830631a3c4039a&lan=es&moneda=".Yii::app()->params['currency'];
					$strClave['tours']['dest'][]=array('label'=>$value->label,'url'=>$url);
				}
				if($value->tipo=='category'){
					$url=Yii::app()->params["baseUrl"]."toursByCat/".$value->clave.".html?tour_destination=".GenericFunctions::makeSinAcento($value->label)."&tipo=category&cat=".$value->id."&dest=&TourId=&sup=&openTk=0&seg=&tour-Checkin=".$dateCheckin."&tour_adults=2&tour_child=0&action=&PHPSESSID=9369665a1a4cae8bfe830631a3c4039a&lan=es&moneda=".Yii::app()->params['currency'];
					$strClave['tours']['cat'][]=array('label'=>$value->label,'url'=>$url);
				}		
				if($value->tipo=='tour'){
					$url=Yii::app()->params["baseUrl"]."tours/".$value->clave.".html?tour_destination=".GenericFunctions::makeSinAcento($value->label)."&tipo=tour&cat=&dest=&TourId=".$value->id."&sup=&openTk=0&seg=&tour-Checkin=".$dateCheckin."&tour_adults=2&tour_child=0&action=&PHPSESSID=9369665a1a4cae8bfe830631a3c4039a&lan=es&moneda=".Yii::app()->params['currency'];
					$strClave['tours']['tour'][]=array('label'=>$value->label,'url'=>$url);
				}
				if($value->tipo=='supplier'){
					$url=Yii::app()->params["baseUrl"]."toursBySup/".$value->clave.".html?tour_destination=".GenericFunctions::makeSinAcento($value->label)."&tipo=supplier&cat=&dest=&TourId=&sup=".$value->id."&openTk=0&seg=&tour-Checkin=".$dateCheckin."&tour_adults=2&tour_child=0&action=&PHPSESSID=9369665a1a4cae8bfe830631a3c4039a&lan=es&moneda=".Yii::app()->params['currency'];
					$strClave['tours']['sup'][]=array('label'=>$value->label,'url'=>$url);
				}											
			}			

		}

		// aqui se imprime la vista
		$this->layout='checkout';
		$this->render("buscar",array('resultados'=>$strClave));
	}


}