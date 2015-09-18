<?php

if($_SERVER['SERVER_NAME']=='mexico-news.com.dev'){

	return array(		
	"class" => "CDbConnection",	
	'connectionString' => 'mysql:host=localhost;dbname=mexico_news',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '1234',
	'charset' => 'utf8',
	);

}else{

	return array(
	"class" => "CDbConnection",	
	'connectionString' => 'mysql:host=caribedb.webair.com;dbname=17872_mxcom',
	'emulatePrepare' => true,
	'username' => '17872_mxroot',
	'password' => 'mx1f1bXTl5',
	'charset' => 'utf8',
	);

}	


?>