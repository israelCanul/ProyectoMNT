<?php

/*ob_start('My_OB');
function My_OB($str, $flags) 
{
    //remove UTF-8 BOM
    $str = preg_replace("/\xef\xbb\xbf/","",$str);

    return $str; 
}*/
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Mexico News',
	'language'=>'en',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.controllers.*',
		'application.Tours.*',
	),
	'onBeginRequest' => array('MexInit', 'beginRequest'),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array( 
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',

	        'urlSuffix' => '.html',
			'showScriptName'=>false,			
			'rules'=>array(
				/* site */
				'home' => 'site/index',
				'Terms_Conditions' => 'site/Terms_Conditions',
				'Privacy' => 'site/Privacy',
				
				'destination' => 'destinations/index',
				'activities' => 'activities/index',
				'news' => 'site/news',
				/* offers */
				'promotions' => 'ofertas/index',
				'offer/<promo:\w+>-<cod:\d+>' => 'ofertas/detalle',

				//destinations
				'destinations/buscar'				=> 'destinations/buscar',
				'destinations/destinations' 		=> 'destinations/destinations',
				'destinations/<clave:[a-z\-]+>' 	=> 'destinations/listar',
				"destination/<hotel:[a-z0-9\-]+>" 	=> "destinations/detalle",
				"agregar" 							=> "destinations/agregar",

				//Activities
				"activities/BuscarTours"								=> "activities/BuscarTours",
				"toursByDest/<clave:[a-zA-Z0-9\-\_]+>" 					=> "activities/findByDest",
				"toursByCat/<clave:[a-zA-Z0-9\-\_]+>"					=> "activities/findByCat",
				"toursBySup/<clave:[a-zA-Z0-9\-\_]+>"					=> "activities/findBySup",
				"tours/<clave:[a-zA-Z0-9\-\_]+>"						=> "activities/detalleTour",
				"tour/agregar"											=> "activities/agregar",
				"activities/buscar"										=> "activities/buscar",
				"activities/destinations"								=> "activities/destinations",
				"activities/<code:[a-z0-9\-]+>" 						=> "activities/listar",
				"activitie/<dest:[a-zA-Z\_\-]+>/<prod:[a-zA-Z0-9\_\-]+>" => "activities/detalle",

				//Traslado
				"traslados/agregar"											=> "traslados/agregar",
				"traslados/buscar"											=> "traslados/buscar",
				"traslados/<clave_trans:[a-zA-Z0-9\-\_]+>"					=> "traslados/detalle",

				'checkout/detalle'										=>'checkout/detalle',

				//GROUPS
			   	'groups' 			=> 'grupos/index',
			   	//search
			   	'search'			=> 'site/buscar',
				/*
				 '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',*/
			),
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),
		'dbWeblt'=>require(dirname(__FILE__).'/dbWeblt.php'),
		'dbNews'=>require(dirname(__FILE__).'/dbMexicoNews.php'),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		"GenericFunctions" => array(
				"class" => "GenericFunctions", 
		),
		"WebServices" => array(
			"class" => "WebServices",				
		),
		"Currency" => array(
			"class" => "Currency",
			"actualCurrency" => $_SESSION["config"]["currency"],
		),
		"_PHPMailer" => array(
				"class" => "PHPMailer",
		),		
		"_Hotels" => array(
			"class" => "HotelsExtranet",				
		),
		"Santander" => array(
				"class" => "PaymentGatewaySantander",
		),		
		"BreadCrumb" => array(
			"class" => "BreadCrumb",
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute',
				),*/
				
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['baseUrl']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'news'=>'http://www.mexiconewsnetwork.com/travel/',
		'cdnNews'=>'http://cdn.mexiconewsnetwork.com/uploads/images/',
		'cdnLomas'=>'//cdn.lomastravel.com',
		'baseUrl'=>'http://www.mexicotravelsnews.com/',
		'Moneda'=>'USD',
		'assets'=>'1',
		'api'=> 'http://beta.etravelpartners.com'
	),
);
