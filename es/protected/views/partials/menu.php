<header>
	<div class="row">
		<div class="col s12 m10 offset-m1 hide-on-med-and-down" style="">
			<div class="col s12 m6 menuLogo">
			 	<a href="/"><img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/MexicoNewsTravel.png"></a>
			</div>
			<div class="col s12 m6 menuLogo">
				<ul class="menuLogoItems">
					<li><a class="followBtn" data-open='follow'>SÍGANOS</a></li>
					<li><a class="followBtn" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" data-open='suscribe'>SUSCRIBIRSE</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 100px;">
	  <nav>
	    <div class="nav-wrapper">
	      <a href="#!" class="brand-logo hide-on-large-only"><img class="imgLogo" src="<?=Yii::app()->params['baseUrl']?>/images/icon/MexicoNewsTravel.png"></a>
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons red-text">menu</i></a>
	      <div class="row">
		    <div class="col m10 l10 offset-m1 offset-l1">
		    	<center>
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
							   'label'=>'HOTELES',
							   'url'=>array('destinations/index'),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'VUELOS',
							   'url'=>array(''), 
							   'linkOptions'=>array('class'=>'hide'),
						   ),
						   array(
							   'label'=>'ACTIVIDADES',
							   'url'=>array('activities/index'),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'PAQUETES',
							   'url'=>array(''),
							   'linkOptions'=>array('class'=>'hide'),
						   ),
						   array(
							   'label'=>'BODAS',
							   'url'=>'http://www.mexiconewsnetwork.com/services/bridal-moments/',
							   'linkOptions'=>array('target'=>'_blank'),
						   ),
						   array(
							   'label'=>'GRUPOS',
							   'url'=>array('grupos/index'),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'NOTICIAS',
							   'url'=>array('site/news'),
							   'linkOptions'=>array('class'=>''),
						   ),
						   array(
							   'label'=>'PROMOCIONES',
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
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/destination"); ?>">HOTELES</a></li>
			  <!-- <li><a data-ajax="false" href="#">FLIGHTS</a></li> -->
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/activities"); ?>">ACTIVIDADES</a></li>
			  <!-- <li><a data-ajax="false" href="#">PACKAGES</a></li> -->
			  <li><a data-ajax="false" target="_blank" href="http://www.mexiconewsnetwork.com/services/bridal-moments/">BODAS</a></li>
			  <li><a data-ajax="false" href="/groups.html">GRUPOS</a></li>
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/news"); ?>">NOTICIAS</a></li>
			  <li><a data-ajax="false" href="<?php echo $this->createUrl("/promotions"); ?>">PROMOCIONES</a></li>
	      </ul>
	    </div>
	  </nav>
	</div>
	<div class="row ">
	    <div class="row"></div>
		<div class="textoBanner">
			<h5 class="txtTextoBanner"><center id="txtBanner">RELAJATE, NADA Y DISFRUTA</center></h5>
			<h4 class="txtTextoBanner"><center id="txtBanner1">THE <span class='txtCant'>10</span>MEJORES PLAYAS EN MÉXICO</center></h4>
		</div>
	</div>
</header>