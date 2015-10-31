<style type="text/css">
	#yw0 {
    float: right;
    width: 80%;
	}
	.menu_fixed nav ul li a:hover{
		color: #FF5A14;
	}
</style>
<div class="menu_fixed hide row hide-on-med-and-down" style="position:fixed;width: 100%;height: 80px;z-index: 19;background:#212121 !important">
	<div class="col s12 hide-on-med-and-down" style="">
		<div class="col m12 ">
		
		<nav>
		  <div class="nav-wrapper">
		    <a href="/" class="brand-logo"><img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg"></a>
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
						   'url'=>array('grupos/index'),
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
		  </div>
		</nav>
		 

		</div>
	</div>
</div>