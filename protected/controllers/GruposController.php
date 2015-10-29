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
		$this->layout='checkout';
		    $cs = Yii::app()->getclientScript();
            $cs->registerCssFile('/css/page/checkout/checkout.css');
            $cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/page/checkout/checkout.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);
		$this->render('index',array("_banners"=>$_banners));
	}

	public function actionSolicitud(){


		$events 		= implode(",", $_POST['event']);
		$ages 			= implode(",", $_POST['ages']);
		$accommodations = implode(",", $_POST['accommodation']);
		$locations 		= implode(",", $_POST['location']);
		$meals 			= implode(",", $_POST['meals']);
		$budgets 		= implode(",", $_POST['budget']);

		$roomTypes 		= $_POST['roomType'];
		if($roomTypes != ''){
			$roomTypes 	= implode(",", $_POST['roomType']);
		}

		$programs 		= $_POST['program'];
		if($programs != ''){
			$programs 	= implode(",", $_POST['program']);
		}

		$fromDate 		= $this->changeDateFormat($_POST['fromDate']);
		$untilDate 		= $this->changeDateFormat($_POST['untilDate']);

		$sql = "INSERT INTO grupos (
			grupo_evento, 
			grupo_otroevento, 
			grupo_compania, 
			grupo_contacto_titulo, 
			grupo_contacto_nombre, 
			grupo_contacto_apellido, 
			grupo_contacto_direccion, 
			grupo_contacto_cp, 
			grupo_contacto_ciudad, 
			grupo_contacto_estado, 
			grupo_contacto_pais, 
			grupo_contacto_telefono, 
			grupo_contacto_fax, 
			grupo_contacto_email, 
			grupo_contacto_web,
			grupo_fecha_desde, 
			grupo_fecha_hasta, 
			grupo_destino_ciudad, 
			grupo_destino_estado,
			grupo_destino_pais, 
			grupo_participantes_numero, 
			grupo_participantes_edades, 
			grupo_alojamiento_categoria, 
			grupo_alojamiento_otracategoria, 
			grupo_alojamiento_localidad, 
			grupo_alojamiento_otralocalidad,
			grupo_alojamiento_habSingle, 
			grupo_alojamiento_habDouble,
			grupo_alojamiento_habSinDou, 
			grupo_alojamiento_habSuite, 
			grupo_alojamiento_comida, 
			grupo_conferencia_personas, 
			grupo_conferencia_tipo_hab, 
			grupo_conferencia_otrotipo_hab,
			grupo_conferencia_equipo, 
			grupo_conferencia_comida, 
			grupo_presupuesto_tipo,	
			grupo_presupuesto_cantidad, 
			grupo_presupuesto_moneda, 
			grupo_programa, 
			grupo_programa_deporte,
			grupo_otroprograma, 
			grupo_traslado_desc, 
			grupo_solicitud_desc) 

		VALUES (
			:grupo_evento, 
			:grupo_otroevento, 
			:grupo_compania, 
			:grupo_contacto_titulo, 
			:grupo_contacto_nombre, 
			:grupo_contacto_apellido, 
			:grupo_contacto_direccion, 
			:grupo_contacto_cp, 
			:grupo_contacto_ciudad, 
			:grupo_contacto_estado, 
			:grupo_contacto_pais, 
			:grupo_contacto_telefono, 
			:grupo_contacto_fax, 
			:grupo_contacto_email, 
			:grupo_contacto_web,
			:grupo_fecha_desde, 
			:grupo_fecha_hasta, 
			:grupo_destino_ciudad, 
			:grupo_destino_estado,
			:grupo_destino_pais, 
			:grupo_participantes_numero, 
			:grupo_participantes_edades, 
			:grupo_alojamiento_categoria, 
			:grupo_alojamiento_otracategoria, 
			:grupo_alojamiento_localidad, 
			:grupo_alojamiento_otralocalidad,
			:grupo_alojamiento_habSingle, 
			:grupo_alojamiento_habDouble,
			:grupo_alojamiento_habSinDou, 
			:grupo_alojamiento_habSuite, 
			:grupo_alojamiento_comida, 
			:grupo_conferencia_personas, 
			:grupo_conferencia_tipo_hab, 
			:grupo_conferencia_otrotipo_hab,
			:grupo_conferencia_equipo, 
			:grupo_conferencia_comida, 
			:grupo_presupuesto_tipo,	
			:grupo_presupuesto_cantidad, 
			:grupo_presupuesto_moneda, 
			:grupo_programa, 
			:grupo_programa_deporte,
			:grupo_otroprograma, 
			:grupo_traslado_desc, 
			:grupo_solicitud_desc)";
		
		$parameters = array(
			":grupo_evento"						=>$events, 					  
			":grupo_otroevento"					=>$_POST['otherEvent'], 
			":grupo_compania"					=>$_POST['companyName'], 	  
			":grupo_contacto_titulo"			=>$_POST['title'], 
			":grupo_contacto_nombre"			=>$_POST['lastname'],		  
			":grupo_contacto_apellido"			=>$_POST['surname'],		
			":grupo_contacto_direccion"			=>$_POST['address'],		  
			":grupo_contacto_cp"				=>$_POST['zip'],
			":grupo_contacto_ciudad"			=>$_POST['city'],			  
			":grupo_contacto_estado"			=>$_POST['state'],
			":grupo_contacto_pais"				=>$_POST['country'],		  
			":grupo_contacto_telefono"			=>$_POST['tel'],
			":grupo_contacto_fax"				=>$_POST['fax'],			  
			":grupo_contacto_email"				=>$_POST['email'],
			":grupo_contacto_web"				=>$_POST['web'],			  
			":grupo_fecha_desde"				=>$fromDate,
			":grupo_fecha_hasta"				=>$untilDate,		  
			":grupo_destino_ciudad"				=>$_POST['destCity'], 
			":grupo_destino_estado"				=>$_POST['destState'],		  
			":grupo_destino_pais"				=>$_POST['destCountry'], 
			":grupo_participantes_numero"		=>$_POST['numberP'],		  
			":grupo_participantes_edades"		=>$ages,
			":grupo_alojamiento_categoria"		=>$accommodations,			  
			":grupo_alojamiento_otracategoria"	=>$_POST['otherAcc'],
			":grupo_alojamiento_localidad"		=>$locations,				  
			":grupo_alojamiento_otralocalidad"	=>$_POST['otherLoc'],
			":grupo_alojamiento_habSingle"		=>$_POST['numberSingle'],	  
			":grupo_alojamiento_habDouble"		=>$_POST['numberDouble'],
			":grupo_alojamiento_habSinDou"		=>$_POST['numberDoubleSingleUse'],	  
			":grupo_alojamiento_habSuite"		=>$_POST['numberSuite'],
			":grupo_alojamiento_comida"			=>$meals,					  
			":grupo_conferencia_personas"		=>$_POST['confPeople'],		  
			":grupo_conferencia_tipo_hab"		=>$roomTypes,	     	  	  
			":grupo_conferencia_otrotipo_hab"	=>$_POST['otherRoomType'],
			":grupo_conferencia_equipo"			=>$_POST['detailsTechEquip'], 
			":grupo_conferencia_comida"			=>$_POST['detailsFoodBev'],
			":grupo_presupuesto_tipo"			=>$budgets,			  		  
			":grupo_presupuesto_cantidad"		=>$_POST['amount'],
			":grupo_presupuesto_moneda"			=>$_POST['currency'],		  
			":grupo_programa"					=>$programs,
			":grupo_programa_deporte"			=>$_POST['sport'], 			  
			":grupo_otroprograma"				=>$_POST['otherProgram'],
			":grupo_traslado_desc"				=>$_POST['detailsAirport'],   
			":grupo_solicitud_desc"				=>$_POST['detailsQuestion'],
			
		);
		
		Yii::app()->db->createCommand($sql)->execute($parameters);
		
		$this->actionEnviamail($events, $ages, $accommodations, $locations, $meals, $roomTypes, $budgets, $programs);
	}

	public function changeDateFormat($fecha){

		$mes = substr($fecha, 0, 2);
		$dia = substr($fecha, 3, 2);
		$ano = substr($fecha, -4);
		$fecha2 = $ano.'-'.$mes.'-'.$dia;
		/*print_r($fecha2);
		exit();*/
		return $fecha2;
	}
	
	public function actionEnviamail($events, $ages, $accommodations, $locations, $meals, $roomTypes, $budgets, $programs){
		/*header('Content-Type: text/xml; charset=iso-8859-1');
		echo '<?xml version="1.0" encoding="iso-8859-1" standalone="no"?>';*/
		$m["mail_titulo"] = "Lomas Travel | Group Request | ".$_POST["lastname"]." ".$_POST['surname']; 
		$mail = new PHPMailer(true);
		$mail->isSMTP(); 
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true; 
		$mail->Username = "envios@lomas-travel.com";
		$mail->Password = "r5J8Rg<S";
		$mail->SMTPSecure = "tls"; 
		$mail->Port = 587;
		$mail->SetFrom("envios@lomas-travel.com", "Lomas Travel Mail");
		//$mail->AddAddress("groups@lomas-travel.com", "Lomas Travel Mail");
		$mail->AddAddress("icanul@dexabyte.com.mx", "Lomas Travel Mail");
        //$mail->AddAddress("groupsmanager@lomas-travel.com", "lomas travel mail");
		//$mail->AddBCC("lomas.travel.analytics@gmail.com", "Analytics");
		$mail->Subject = $m["mail_titulo"];

		if(Yii::app()->language == 'es'){
		$mail->MsgHTML("<h1>Solicitud de Grupos</h1>
			<div style='width:710px; border:1px solid #333; padding:5px;'>
				<div style='background:#efefef'><b>DETALLES DEL GRUPO</b></div>
				<div style='font-size:14px'><br/>
				 	<b style='font-size:16px'>EVENTO</b><br/>
					<b>Evento: </b>".$events."&nbsp;&nbsp;<b>Otro Evento: </b>".$_POST['otherEvent']."<br/><br/>
					<b style='font-size:16px'>EMPRESA</b><br/>
					<b>Nombre de la empresa: </b>".$_POST['companyName']."<br/><br/>
					<b style='font-size:16px'>INFORMACION DEL CONTACTO</b><br/>
					<b>Nombre: </b>".$_POST['title']."&nbsp;".$_POST['lastname']."&nbsp;".$_POST['surname']."<br/>
					<b>Direccion: </b>".$_POST['address']."&nbsp;".$_POST['zip']."&nbsp;".$_POST['city']."&nbsp;".$_POST['state']."&nbsp;".$_POST['country']."<br/>
					<b>Telefono: </b>".$_POST['tel']."&nbsp;&nbsp;<b>Fax: </b>".$_POST['fax']."<br/>
					<b>E-mail: </b>".$_POST['email']."&nbsp;&nbsp;<b>Web: </b>".$_POST['web']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>SOLICITUD DE RESERVA</b></div>
				<div style='font-size:14px'><br/>
				 	<b style='font-size:16px'>APROX FECHAS</b><br/>
					<b>De: </b>".$_POST['fromDate']."&nbsp;&nbsp;<b>Hasta: </b>".$_POST['untilDate']."<br/><br/>
					<b style='font-size:16px'>DESTINO</b><br/>
					<b>Destino: </b>".$_POST['city']."&nbsp;".$_POST['state']."&nbsp;".$_POST['country']."<br/><br/>
					<b style='font-size:16px'>PARTICIPANTES</b><br/>
					<b>Numero: </b>".$_POST['numberP']."&nbsp;&nbsp;<b>Edad media aprox: </b>".$ages."<br/><br/>
				</div>
				<div style='background:#efefef'><b>ALOJAMIENTO</b></div>
				<div style='font-size:14px'><br/>
				 	<b  style='font-size:16px'>CATEGORIA</b><br/>
					<b>Categoria: </b>".$accommodations."&nbsp;&nbsp;<b>Otro: </b>".$_POST['otherAcc']."<br/><br/>
					<b style='font-size:16px'>UBICACION</b><br/>
					<b>Ubicacion: </b>".$locations."&nbsp;&nbsp;<b>Otro: </b>".$_POST['otherLoc']."<br/><br/>
					<b style='font-size:16px'>NUMERO DE HABITACIONES</b><br/>
					<b>Individual: </b>".$_POST['numberSingle']."&nbsp;&nbsp;<b>Doble: </b>".$_POST['numberDouble']."&nbsp;&nbsp;<b>Doble Uso Individual: </b>".$_POST['numberDoubleSingleUse']."&nbsp;&nbsp;<b>Suites: </b>".$_POST['numberSuite']."<br/><br/>
					<b style='font-size:16px'>COMIDAS</b><br/>
					<b>Comidas: </b>".$meals."<br/><br/>
				</div>
				<div style='background:#efefef'><b>SALA DE REUNIONES</b></div>
				<div style='font-size:14px'><br/>
				 	<b  style='font-size:16px'>CONFERENCIA</b><br/>
					<b>Sala para: </b>".$_POST['confPeople']." personas<br/><br/>
					<b style='font-size:16px'>SALA</b><br/>
					<b>Tipo de Sala: </b>".$roomTypes."&nbsp;&nbsp;<b>Otro: </b>".$_POST['otherRoomType']."<br/><br/>
					<b style='font-size:16px'>EQUIPOS</b><br/>
					<b>Equipo: </b>".$_POST['detailsTechEquip']."<br/><br/>
					<b style='font-size:16px'>ALIMENTACION Y BEBIDAS</b><br/>
					<b>Alimentacion y Bebidas: </b>".$_POST['detailsFoodBev']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>PRESUPUESTO ESTIMADO</b></div>
				<div style='font-size:14px'><br/>
				 	<b  style='font-size:16px'>PRESUPUESTO ESTIMADO</b><br/>
					<b>Presupuesto: </b>".$budgets."&nbsp;&nbsp;<b>Importe: </b>".$_POST['amount']."&nbsp;&nbsp;<b>Moneda: </b>".$_POST['currency']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>PROGRAMA</b></div>
				<div style='font-size:14px'><br/>
				 	<b  style='font-size:16px'>PROGRAMA</b><br/>
					".$programs."&nbsp;&nbsp;<b>Deporte: </b>".$_POST['sport']."&nbsp;&nbsp;<b>Otro: </b>".$_POST['otherProgram']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>TRASLADO AEROPUERTO</b></div>
				<div style='font-size:14px'><br/>
					<b  style='font-size:16px'>TRASLADO</b><br/>
					".$_POST['detailsAirport']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>OTRAS PREGUNTAS / SOLICITUD</b></div>
				<div style='font-size:14px'><br/>
					<b  style='font-size:16px'>OTRAS PREGUNTAS</b><br/>
					".$_POST['detailsQuestion']."<br/><br/>
				</div>
			</div>");
		}else{
			$mail->MsgHTML("<h1>Group Request</h1>
			<div style='width:710px; border:1px solid #333; padding:5px;'>
				<div style='background:#efefef'><b>GROUP DETAILS</b></div>
				<div style='font-size:14px'><br/>
				 	<b style='font-size:16px'>EVENT</b><br/>
					<b>Event: </b>".$events."&nbsp;&nbsp;<b>Other Event: </b>".$_POST['otherEvent']."<br/><br/>
					<b style='font-size:16px'>COMPANY NAME</b><br/>
					<b>Company Name: </b>".$_POST['companyName']."<br/><br/>
					<b style='font-size:16px'>CONTACT PERSON DETAILS</b><br/>
					<b>Name: </b>".$_POST['title']."&nbsp;".$_POST['lastname']."&nbsp;".$_POST['surname']."<br/>
					<b>Address: </b>".$_POST['address']."&nbsp;".$_POST['zip']."&nbsp;".$_POST['city']."&nbsp;".$_POST['state']."&nbsp;".$_POST['country']."<br/>
					<b>Phone: </b>".$_POST['tel']."&nbsp;&nbsp;<b>Fax: </b>".$_POST['fax']."<br/>
					<b>E-mail: </b>".$_POST['email']."&nbsp;&nbsp;<b>Web: </b>".$_POST['web']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>BOOKING REQUEST</b></div>
				<div style='font-size:14px'><br/>
				 	<b style='font-size:16px'>APPROX DATES</b><br/>
					<b>From: </b>".$_POST['fromDate']."&nbsp;&nbsp;<b>Until: </b>".$_POST['untilDate']."<br/><br/>
					<b style='font-size:16px'>DESTINATION</b><br/>
					<b>Destination: </b>".$_POST['city']."&nbsp;".$_POST['state']."&nbsp;".$_POST['country']."<br/><br/>
					<b style='font-size:16px'>PARTICIPANTS</b><br/>
					<b>Number: </b>".$_POST['numberP']."&nbsp;&nbsp;<b>Average age aprox: </b>".$ages."<br/><br/>
				</div>
				<div style='background:#efefef'><b>ACCOMMODATION</b></div>
				<div style='font-size:14px'><br/>
				 	<b  style='font-size:16px'>CATEGORY</b><br/>
					<b>Category: </b>".$accommodations."&nbsp;&nbsp;<b>Other: </b>".$_POST['otherAcc']."<br/><br/>
					<b style='font-size:16px'>LOCATION</b><br/>
					<b>Location: </b>".$locations."&nbsp;&nbsp;<b>Other: </b>".$_POST['otherLoc']."<br/><br/>
					<b style='font-size:16px'>NUMBER OF ROOMS</b><br/>
					<b>Single: </b>".$_POST['numberSingle']."&nbsp;&nbsp;<b>Double: </b>".$_POST['numberDouble']."&nbsp;&nbsp;<b>Double for Single Use: </b>".$_POST['numberDoubleSingleUse']."&nbsp;&nbsp;<b>Suites: </b>".$_POST['numberSuite']."<br/><br/>
					<b style='font-size:16px'>MEALS</b><br/>
					<b>Meals: </b>".$meals."<br/><br/>
				</div>
				<div style='background:#efefef'><b>CONFERENCE FACILITIES</b></div>
				<div style='font-size:14px'><br/>
				 	<b  style='font-size:16px'>CONFERENCE</b><br/>
					<b>Conference / Meeting Room for: </b>".$_POST['confPeople']." persons<br/><br/>
					<b style='font-size:16px'>CONFERENCE ROOM TYPE</b><br/>
					<b>Conference Room Type: </b>".$roomTypes."&nbsp;&nbsp;<b>Other: </b>".$_POST['otherRoomType']."<br/><br/>
					<b style='font-size:16px'>EQUIPMENT</b><br/>
					<b>Equipment: </b>".$_POST['detailsTechEquip']."<br/><br/>
					<b style='font-size:16px'>FOOD & BEVERAGE</b><br/>
					<b>Food & Beverage: </b>".$_POST['detailsFoodBev']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>ESTIMATED BUDGET</b></div>
				<div style='font-size:14px'><br/>
				 	<b  style='font-size:16px'>ESTIMATED BUDGET</b><br/>
					<b>Budget: </b>".$budgets."&nbsp;&nbsp;<b>Amount: </b>".$_POST['amount']."&nbsp;&nbsp;<b>Currency: </b>".$_POST['currency']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>PROGRAM</b></div>
				<div style='font-size:14px'><br/>
				 	<b  style='font-size:16px'>PROGRAM</b><br/>
					".$programs."&nbsp;&nbsp;<b>Sport: </b>".$_POST['sport']."&nbsp;&nbsp;<b>Other: </b>".$_POST['otherProgram']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>AIRPORT TRANSFER</b></div>
				<div style='font-size:14px'><br/>
					<b  style='font-size:16px'>TRASFER</b><br/>
					".$_POST['detailsAirport']."<br/><br/>
				</div>
				<div style='background:#efefef'><b>OTHER QUESTIONS / REQUEST</b></div>
				<div style='font-size:14px'><br/>
					<b  style='font-size:16px'>OTHER QUESTIONS</b><br/>
					".$_POST['detailsQuestion']."<br/><br/>
				</div>
			</div>");
		}
		$mail->Send();

		echo Yii::t("global","Su solicitud ha sido enviada, en breve nos estaremos comunicando con usted");	
		
		exit();
		
		}


}
?>	