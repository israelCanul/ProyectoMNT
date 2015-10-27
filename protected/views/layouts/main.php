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

<header>
	<div class="row">
		<div class="col s12 m10 offset-m1 hide-on-med-and-down" style="">
			<div class="col s12 m6 menuLogo">
			 	<a href="/"><img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg"></a>
			</div>
			<div class="col s12 m6 menuLogo">
				<ul class="menuLogoItems">
					<li><a class="followBtn" data-open='follow'>FOLLOW US</a></li>
					<li><a class="followBtn" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" data-open='suscribe'>SUSCRIBE</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 100px;">
	  <nav>
	    <div class="nav-wrapper">
	      <a href="#!" class="brand-logo hide-on-large-only"><img class="imgLogo" src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg"></a>
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	      <div class="row">
		    <div class="col m10 l10 offset-m1 offset-l1">
		    	<center>
			      <!--<ul >
			        <li><a data-ajax="false" href="<?php /*echo $this->createUrl("/home"); */?>">HOME</a></li>
			        <li><a data-ajax="false" href="<?php /*echo $this->createUrl("/destination"); */?>">HOTELS</a></li>
					  <li><a data-ajax="false" href="#">FLIGHTS</a></li>
			        <li><a data-ajax="false" href="<?php /*echo $this->createUrl("/activities"); */?>">ACTIVITIES</a></li>
					<li><a data-ajax="false" href="#">PACKAGES</a></li>
 					<li><a data-ajax="false" href="#">WEDDINGS</a></li>
					<li><a data-ajax="false" href="#">GROUPS</a></li>
			        <li><a data-ajax="false" href="<?php /*echo $this->createUrl("/news"); */?>">NEWS</a></li>
					<li><a data-ajax="false" href="<?php /*echo $this->createUrl("/promotions"); */?>">PROMOTIONS</a></li>
			      </ul>-->

				<ul class="hide-on-med-and-down">
				   <?php
				   $this->widget('zii.widgets.CMenu',array(
					   'activeCssClass'=>'active',
					   'activateParents'=>true,
					   'items'=>array(
						   array(
							   'label'=>'HOME',
							   'url'=>array('site/index'),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'HOTELS',
							   'url'=>array('destinations/index'),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'FLIGHTS',
							   'url'=>array(''),
							   'linkOptions'=>array('class'=>'hide'),
						   ),
						   array(
							   'label'=>'ACTIVITIES',
							   'url'=>array('activities/index'),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'PACKAGES',
							   'url'=>array(''),
							   'linkOptions'=>array('class'=>'hide'),
						   ),
						   array(
							   'label'=>'WEDDINGS',
							   'url'=>'http://www.mexiconewsnetwork.com/services/bridal-moments/',
							   'linkOptions'=>array('target'=>'_blank'),
						   ),
						   array(
							   'label'=>'GROUPS',
							   'url'=>array(''),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'NEWS',
							   'url'=>array('site/news'),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'PROMOTIONS',
							   'url'=>array('ofertas/index'),
							   'linkOptions'=>array('class'=>''),
						   ),
					   ),
				   )); ?>
					</ul>


		    	</center>
		    </div>
	      </div>
	      <ul class="side-nav" id="mobile-demo">
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/home"); ?>">HOME</a></li>
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/destination"); ?>">HOTELS</a></li>
			  <li><a data-ajax="false" href="#">FLIGHTS</a></li>
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/activities"); ?>">ACTIVITIES</a></li>
			  <li><a data-ajax="false" href="#">PACKAGES</a></li>
			  <li><a data-ajax="false" href="#">WEDDINGS</a></li>
			  <li><a data-ajax="false" href="#">GROUPS</a></li>
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/news"); ?>">NEWS</a></li>
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/promotions"); ?>">PROMOTIONS</a></li>
	      </ul>
	    </div>
	  </nav>
	</div>
	<div class="row ">
	    <div class="row"></div>
		<div class="textoBanner">
			<h5 class="txtTextoBanner"><center id="txtBanner">RELAX, SWIM AND ENJOY</center></h5>
			<h4 class="txtTextoBanner"><center id="txtBanner1">THE <span class='txtCant'>10</span> BEST BEACHES OF MEXICO</center></h4>
		</div>
	</div>
</header>

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
<footer class='grey darken-4'>
	<div class="row ">
		<div class="row"></div>
		<div class="col s12 ">
			<div class="col s12 m2">
				<img class="responsive-img imagen-footer" src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg">
			</div>
			<div class="col s12 m10">
				 <div class="container">
		            <div class="row">
		              <div class="col l8 s12">
			                <h5 class="white-text">Menu</h5>
			                <ul style="display: inline;">
								<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Home" href="<?php echo $this->createUrl("/home"); ?>">HOME /</a></li>
								<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Destinations" href="<?php echo $this->createUrl("/destination"); ?>">HOTELS /</a></li>
								<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Activities" href="<?php echo $this->createUrl("/activities"); ?>">ACTIVITIES /</a></li>
								<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Promotions" href="<?php echo $this->createUrl("/promotions"); ?>">PROMOTIONS /</a></li>
								<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Flights" href="#!">FLIGHTS /</a></li>
								<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Packages" href="#!">PACKAGES /</a></li>
								<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Weddings" target="_blank" href="http://www.mexiconewsnetwork.com/services/bridal-moments/">WEDDINGS /</a></li>
								<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Groups" href="#!">GROUPS /</a></li>
			                </ul>
		              </div>
		              <div class="col l4 s12">
		                <h5 class="white-text">Language</h5>
		                <ul>
							<li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Español" href="#!">Español</a><span style='color: white;font-size:21px;'> | </span><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="English" href="#!">English</a></li>
		                </ul>
		              </div>
		            </div>
		          </div>
				 <div class="container">
		            <div class="row">
		              <div class="col l8 s12">
		                <h5 class="white-text">More</h5>
		                <ul>
		                  <li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Privacy Guidelines" href="#!">Privacy guidelines /</a></li>
		                  <li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Terms of Service" href="#!">Terms of service /</a></li>
		                  <li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Site Map" href="#!">Site Map /</a></li>
		                  <li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Contact US" href="#!">Contact US /</a></li>
		                </ul>
		              </div>
		              <div class="col l4 s12">
		                <h5 class="white-text">About Us</h5>
			                <ul>
			                  <li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Mexico News Network Live Broadcast" target="_blank" href="http://www.mexiconewsnetwork.com/">México News Network Live Broadcast /</a></li>
			                  <li><a class="grey-text text-lighten-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Brides Moments" target="_blank" href="http://www.mexiconewsnetwork.com/services/bridal-moments/">Brides Moments /</a></li>
			                </ul>
		              </div>
		            </div>
		          </div>		          
			</div>						
		</div>
          <div class="footer-copyright">
            <div class="white-text">
            © 2015 Copyright Mexico News Travel
           
            </div>
          </div>		
	</div>
</footer>
<!-- modal de follow -->
<div id="follow" class="inActiveM modales">
	<div class="row">
		<div class="col s12 m8 offset-m2 " style="">
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
			 	<img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg">
			</div>
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
				<ul class="menuLogoItems">
					<li><a class="followBtn" style="border-bottom: 2px solid white;" data-open='follow'>FOLLOW US</a></li>
					<li><a class="followBtn" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" data-open='suscribe'>SUSCRIBE</a></li>
				</ul>	
			</div>
			<div class="col s12"><i style='float:right;font-size:50px;' data-close='follow' class="material-icons cerrar-close white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close">close</i></div>
		</div>
	</div>
	<div class="panel-modal transparent">
		<div class="row">
			<div class="col s12">
			<h5 class="white-text center-align">FOLLOW US. WE ARE EVERYWHERE</h5>
			<div class="row"></div>
				<div class="row">
					<div class="col s8 offset-4 m2 white-text medium">
						<div class="responsive-img" src="" id="iconF"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconT"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconG"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconP"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconS"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconB"></div>
					</div>					
				</div>				
			</div>
		</div> 
	</div>	
</div>
<!-- modal de search -->
<div id="search" class="inActiveM modales">
	<div class="row">
		<div class="col s12 m8 offset-m2 " style="">
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
			 	<img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg">
			</div>
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
				<ul class="menuLogoItems">
					<li><a class="followBtn" data-open='follow'>FOLLOW US</a></li>
					<li><a class="followBtn" style="border-bottom: 2px solid white;" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" data-open='suscribe'>SUSCRIBE</a></li>
				</ul>	
			</div>
			<div class="col s12"><i style='float:right;font-size:50px;' data-close='search' class="material-icons cerrar-close white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close">close</i></div>
		</div>
	</div>	
	<div class="panel-modal transparent">
		<div class="row">
			<div class="col s12">
			<h5 class="white-text">Search</h5>
				  <nav>
				    <div class="nav-wrapper">
				      <form>
				        <div class="input-field" style="">
				          <input id="search" type="search" style="border-bottom: 2px solid white;"  required>
				          <label for="search"><i class="material-icons white-text">search</i></label>
				        </div>
				      </form>
				    </div>
				  </nav>
			</div>
		</div> 
	</div>	
</div>
<!-- modal de suscribe -->
<div id="suscribe" class="inActiveM modales">
	<div class="row">
		<div class="col s12 m8 offset-m2 " style="">
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
			 	<img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg">
			</div>
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
				<ul class="menuLogoItems">
					<li><a class="followBtn" data-open='follow'>FOLLOW US</a></li>
					<li><a class="followBtn" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" style="border-bottom: 2px solid white;" data-open='suscribe'>SUSCRIBE</a></li>
				</ul>	
			</div>
			<div class="col s12"><i style='float:right;font-size:50px;' data-close='suscribe' class="material-icons cerrar-close white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close">close</i></div>
		</div>
	</div>
	<div class="panel-modal transparent">
		<div class="row">
			<div class="col s12">
			<h5 class="white-text center-align">FOLLOW US. WE ARE EVERYWHERE</h5>
			<div class="row"></div>
				<div class="row">
					<div class="col s12  white-text medium">
				       <div class="input-field col s12">
				         <i class="material-icons prefix white-text">account_circle</i>
				         <input id="icon_prefix" type="text" class="validate">
				         <label for="icon_prefix white-text">Name</label>
				       </div>
					</div>
					<div class="col s12  white-text medium">
				       <div class="input-field col s12">
				         <i class="material-icons prefix white-text">email</i>
				         <input id="icon_prefix" type="text" class="validate">
				         <label for="icon_prefix white-text">Email</label>
				       </div>
					</div>
					<div class="col s12  white-text medium">
				       <div class="input-field col s12">
				         <i class="material-icons prefix white-text">flag</i>
				         <input id="icon_prefix" type="text" class="validate">
				         <label for="icon_prefix white-text">Country</label>
				       </div>
					</div>
					<div class="col s12  white-text medium">
				       <div class="input-field col s12">
				         <i class="material-icons prefix white-text">location_city</i>
				         <input id="icon_prefix" type="text" class="validate">
				         <label for="icon_prefix white-text">City</label>
				       </div>
					</div>
					<div class="col s12  white-text medium">
					  <button style="float:right" class="btn waves-effect waves-light" type="submit" name="action">Submit
					    <i class="material-icons">send</i>
					  </button>											
					</div>
										
				</div>				
			</div>
		</div> 
	</div>	
</div>

</body>
</html>

<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
