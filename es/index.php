<?php
/*phpinfo();
exit();*/
	ini_set("display_errors",1);
	ini_set("memory_limit", -1 );
	ini_set("xmlrpc_errors",true);
    ob_start();

date_default_timezone_set('America/Cancun');
// change the following paths if necessary
//$yii=dirname(__FILE__).'/lib/yii/yii.php';
$yii='../lib/yii/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require_once($yii);
	ini_set("output_buffering",0);
	ini_set("output_handler",null);
	ini_set("implicit_flush",0);

Yii::createWebApplication($config)->run();
