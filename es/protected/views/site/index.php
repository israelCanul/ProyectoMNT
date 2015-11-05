<style type="text/css">
	.col{
		padding:0px;
	}
</style>
<?php

$_SESSION['home']='';
/* @var $this SiteController */
$this->pageTitle="Mexico News Travel";
?>

<!-- animacion de ventana [Final] -->
<div class="row">
<div class="col s12 m10 l10 offset-m1 offset-l1" style="padding:0px;">
	<div class="row" style="padding:0px;margin:0px;">
		<div class="col s12 m9 ">
<? 
//notas de la pagina http://www.mexiconewsnetwork.com/travel/
$posicion=true;
if(count($notas)>0){
	foreach ($notas as $key => $value) {
		if($posicion){
?>

				<div class="row ">
				<div class="col s12 l10 offset-l1 card-panel hoverable" style="padding:15px 5px;">
					<div class="col s12 m5">
						<img data-caption="<?=$value['alt']?>" class="responsive-img " src="<?=Yii::app()->params['cdnNews'].$value['data']?>">
					</div>
					<div class="col s12 m7">
						<a class="black-text " href="<?=Yii::app()->params['news'].$value['uri']."/"?>"><h5><?=$value['titulo']?></h5></a>
						<p>
							<?=$value['meta_description']?>
						</p>
			            <div class="card-action">
			              <a class="blue-text text-darken-2" target="_blank" href="<?=Yii::app()->params['news'].$value['uri']."/"?>">Read more</a>
			            </div>					
					</div>
				</div>			
			</div>
<?         
		$posicion=false;
		}else{  ?>
			<div class="row ">
				<div class="col s12 l10 offset-l1 card-panel hoverable" style="padding:15px 5px;">
					<div class="col s12 m7">
						<a class="black-text " href="<?=Yii::app()->params['news'].$value['uri']."/"?>"><h5><?=$value['titulo']?></h5></a>
						<p>
							<?=$value['meta_description']?>
						</p>
			            <div class="card-action">
			              <a class="blue-text text-darken-2" target="_blank" href="<?=Yii::app()->params['news'].$value['uri']."/"?>">Read more</a>
			            </div>					
					</div>
					<div class="col s12 m5">
						<img data-caption="<?=$value['alt']?>" class="responsive-img " src="<?=Yii::app()->params['cdnNews'].$value['data']?>">
					</div>					
				</div>			
			</div>

<?		$posicion=true;	
		}	

	}
}
?>
		</div>
		<div class="col s12 m3" style="border-left: 2px solid rgba(0,0,0,0.5);">
			<div class="row">

			<h5>Top Destinations</h5>
			<div class="row"></div>
			<?php foreach($destinations['top'] as $dest) {	?> 
	    		<div class="col s12 m11 offset-m1">
					<center>
						<a href="<?php echo $this->createUrl("destinations/listar", array("clave" => $dest['ciudad_clave']));?>">
							<img class="responsive-img" src="<?php echo Yii::app()->params['cdnLomas']."/img/destinations/".$dest['ciudad_img']; ?> " alt="<?php echo utf8_encode($dest['ciudad_nombre']); ?>">
						</a>
					</center>
				</div>
			<?}?>
			</div>
		</div>	
	</div>
</div>
</div>

<div class="row hide-on-med-and-down">
	<div class="col s10 offset-s1 parallax-container">
		<div class="parallax "><img src="<?=Yii::app()->params['baseUrl']?>/images/bg/footer-home.jpg"></div>
	</div>
</div>

<? 
//notas antes del footer de la pagina
$this->renderPartial('application.views.partials.news_footer',array('notas2'=>$notas2)); ?>


