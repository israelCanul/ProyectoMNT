<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>

<?if($_SESSION['home']==""){?>
<!-- animacion de ventana [Inicio] -->
<div id="animacionIntroLeft">
	<img class="img-intro" src="/images/bg/puertaLeft.jpg">
</div>
<div id="animacionIntroLogo">
	<div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3"><center><img style="width: 40%;" class="responsive-img" src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg"></center></div></div>
	<h3 style="font-size:3rem;text-align: center;">Behind this doors you will find the best of Mexico and the world</h3>
</div>
<div id="animacionIntroRight">
	<img class="img-intro" src="/images/bg/puertaRight.jpg">
</div>

<?
	$_SESSION['home']='listo';
}?>
<head> 

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="utf-8">
	<meta name="language" content="en">
   <!-- Archivos JS *************************************************************************************************** -->
    <script src="/js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<!--<script src="/js/jquery-ui.js" type="text/javascript"></script> -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- validate -->
    <script src="<? echo '/js/validate.jquery.js?a='. Yii::app()->params['assets']; ?>" ></script>
   	<!--Import jQuery before materialize.js-->
	<script src="/js/materialize.min.js"></script>
    <!-- Archivos CSS ****************************************************************************************************** -->

    <!-- Compiled and minified CSS -->
    <link type="text/css" rel="stylesheet" href="/css/page/jquery-ui.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/css/materialize.css"  media="screen,projection"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">
    <!-- iconos de materializecss -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- css para la pagina -->
	<link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/checkout.css">


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body >
<?
$this->renderPartial('application.views.partials.menu_fixed',true);
$this->renderPartial('application.views.partials.menu',true);
?>

<div class="row" style="height: 124px;"></div>
<main>
<?php echo $content; ?>
</main>

<?
$this->renderPartial('application.views.partials.footer',true);
$this->renderPartial('application.views.partials.modales',true);
$this->renderPartial('application.views.partials.form_contact',true);
?>

</body>
</html>

<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>

