<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>

<?if($_SESSION['home']==""){?>
<!-- animacion de ventana [Inicio] -->
<div id="animacionIntroLeft">
	<img class="img-intro" src="/images/bg/puertaLeft.jpg">
</div>
<div id="animacionIntroLogo">
	<div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3"><center><img style="width: 40%;" class="responsive-img" src="<?=Yii::app()->params['baseUrl']?>/images/icon/MexicoNewsTravel.png"></center></div></div>
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
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body >
<?
$this->renderPartial('application.views.partials.menu_fixed',true);
$this->renderPartial('application.views.partials.menu',true);
?>
<div class="row" style="height: 500px;"></div>

<main>
	<!-- formulario de bookin [inicio] -->
	<div class="row bookin-form1" style="z-index:10;position: relative;">
		<div class="col s12">
			<?php	$this->widget('application.components.Bookingbox'); ?>
			<?php $fecha = date("d/m/Y",mktime(0,0,0,date("m"),date("d")+3,date("Y"))); ?>
		</div>
	</div>
	<!-- formulario de bookin [final] -->
<?php echo $content; ?>
</main>

<?
$this->renderPartial('application.views.partials.footer',true);
$this->renderPartial('application.views.partials.modales',true);
$this->renderPartial('application.views.partials.form_contact',true);
?>
</body>
</html>
<style type="text/css">
	#lhnContainerDone{
    text-align: center;
    width: auto;
    bottom: 10px;
    right: 10px;
    position: fixed;
    z-index: 9999;		
	}
</style>
<!-- This code must be installed within the body tags -->
<script type="text/javascript">
    var lhnAccountN = "20895-1";
    var lhnButtonN = 7631;
    var lhnChatPosition = 'default';
    var lhnInviteEnabled = 1;
    var lhnWindowN = 30537;
    var lhnInviteN = 38591;
    var lhnDepartmentN = 23227;
</script>
<a href="http://www.livehelpnow.net/products/live-chat-system" target="_blank" style="font-size:10px;" id="lhnHelp">best live chat</a>
<script src="//www.livehelpnow.net/lhn/widgets/chatbutton/lhnchatbutton-current.min.js" type="text/javascript" id="lhnscript"></script>

<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
