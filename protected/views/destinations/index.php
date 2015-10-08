<div class="row">
	<h5 class="center-align">Top Destinations</h5>
	<div class="col s12 m10 offset-m1">
		<div class="row" >
		<? if(count($destinos)>0){
				foreach ($destinos as $key => $value) {

		?>
				<div class="small col s12 m6 l4 ">
		          <div class="card-destinos">
			          <div class="card ">
			            <div class="card-image">
			              <img src="<?=Yii::app()->params['cdnLomas']."/img/destinations/".$value['img']?>">
			              <span class="card-title"></span>
			            </div>
			            <div class="card-content card-action hoverable contenidoDestinos">
			              <a class="red-text" href="/destinations/<? echo $value['clave'] ?>.html?hotel_keyword=&cCode=<? echo $value['codigo']?>&HotelId=&hotel_destination=<? echo urlencode( GenericFunctions::makeSinAcento( $value['nombre'])) ?>&hotelCheckin=<? echo urlencode(date('m/d/Y', strtotime('+2 day')));?>&hotelCheckout=<? echo urlencode(date('m/d/Y', strtotime('+5 day')));?>&hotelRoom=1&hotelAdults_0=2&hotelChild_0=0&action=&Room%5B0%5D%5BAdults%5D=2&Room%5B0%5D%5BChilds%5D=0">
			              <?
			              if($value['nombre']!=$value['estado']){
			              ?>
			              <p class="center-align"><label class="textoCaja"><?=$value['nombre']?></label></p>
			              <p class="center-align"><?=$value['estado']?></p>
			              <? }else{ ?>

			              	<p class="center-align"><label class="textoCaja"><?=$value['estado']?></label></p>
			              <?}?>
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
			//notas de la pagina http://www.mexiconewsnetwork.com/travel/
			if(count($notas2)>0){
				foreach ($notas2 as $key => $value) {
					?>
					<div class="col s12 m3 wrap_new" id="wrap_new_<?=$key?>">
						<div class="card transparent  new" data-key="<?=$key?>" style="height:200px;">
							<div class="card-content black-text">
								<span class="card-title black-text"><?=$value['titulo']?></span>
								<div class="col s12  <? if($key==0){ echo "animated fadeInleft";}else{ echo "line_new"; }?> line_news" id="wrap_line_<?=$key?>" style="height: 5px;"></div>
								<p class="card-contenido"><?=$value['meta_description']?></p>
								<a target="_blank" class="blue-text text-darken-2" href="<?=Yii::app()->params['news'].$value['uri']."/"?>">Read More</a>
							</div>

						</div>

					</div>

					<?
				}
			}
			?>

		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#txtBanner").html("CANCUN, RIVIERA MAYA");
		$("#txtBanner1").html("& COZUMEL");
	});
</script>