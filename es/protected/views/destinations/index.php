<div class="row">
	<h5 class="center-align">Top Destinos</h5>
	<div class="col s12 m10 offset-m1">
		<div class="row" >
		<? if(count($destinos)>0){
				foreach ($destinos as $key => $value) {
				if($value['nombre']!=$value['estado']){
		?>
				<div class="small col s12 m6 l4 " style="height: 350px;">
		          <div class="card-destinos">
			          <div class="card ">
			            <div class="card-image">
			              <img src="<?=Yii::app()->params['cdnLomas']."/img/destinations/".$value['img']?>">
			              <span class="card-title"></span>
			            </div>
			            <div class="card-content card-action hoverable contenidoDestinos">
			              <a class="red-text" href="/es/destinations/<? echo $value['clave'] ?>.html?hotel_keyword=&cCode=<? echo $value['codigo']?>&HotelId=&hotel_destination=<? echo urlencode( GenericFunctions::makeSinAcento( $value['nombre'])) ?>&hotelCheckin=<? echo urlencode(date('d/m/Y', strtotime('+2 day')));?>&hotelCheckout=<? echo urlencode(date('d/m/Y', strtotime('+5 day')));?>&hotelRoom=1&hotelAdults_0=2&hotelChild_0=0&action=&Room%5B0%5D%5BAdults%5D=2&Room%5B0%5D%5BChilds%5D=0">
			              <?
			              
			              ?>
			              <p class="center-align"><label class="textoCaja"><?=$value['nombre']?></label></p>
			              <p class="center-align"><?=$value['estado']?></p>

			              </a> 
			            </div>
			            <!-- <div class="card-action">
			              <a href="#">This is a link</a>
			            </div> -->
			          </div>
		          </div>
		        </div>  				
		<?
				}
				}	
			}
		?>	
		</div>
	</div>
</div>
<!-- Footer de la seccion con el cambio de la imagen y las notas son las mismas  -->
<div class="row">
	<div class="row hide-on-med-and-down">
		<div class="col s10 offset-s1 parallax-container">
			<div class="parallax "><img src="<?=Yii::app()->params['baseUrl']?>/images/bg/footer-hotels.jpg"></div>
		</div>
	</div>

	<? $value=$notas2;?>
	<div class="row hide-on-med-and-down">
		<div class="col 12">
		<? 
		//notas antes del footer de la pagina
		$this->renderPartial('application.views.partials.news_footer',array('notas2'=>$notas2)); ?>

		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#txtBanner").html("CANCUN, RIVIERA MAYA");
		$("#txtBanner1").html("& COZUMEL");
	});
</script>