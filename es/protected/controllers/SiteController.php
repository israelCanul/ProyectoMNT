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
			echo 'WE ARE HAVING TECHNICAL DIFFICULTIES, Please try again later';
		} else {
			echo 'YOUR REQUEST HAS BEEN SUCCESFULLY SENT, You will be contacted soon';
		}
	}

}