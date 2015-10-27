 	

 <div class="row">
	<div class="col s12 m10 offset-m1">
	    <div class="col s12 m6 offset-m3">
	      <ul class="tabs">
	        <li class="tab col s3"><a href="#hotels" class="active">Hotels</a></li>
	        <li class="tab col s3"><a href="#tours">Tours</a></li>
	      </ul>
	    </div>
	    <div id="hotels" class="col s12">

			<?
			$index=0;
			foreach($_Promociones as $p){

				if($p["promocion_producto"] == "hotel"){
					if($p["promocion_archivo_" . Yii::app()->language] != ''  &&  $p["promocion_miniatura_". Yii::app()->language] != ''){
						$url = "/offer/" . Yii::app()->GenericFunctions->makeUrl(str_replace("%","",(str_replace("&","&amp;",(str_replace(",","", $p["promocion_" . Yii::app()->language] )))))) . "-" . $p["promocion_id"] . ".html?seg=L". $p["promocion_id"];		
						if($p["promocion_tipo_contenido"] == 3){
							$url = $p["promocion_link_" . Yii::app()->language];
						}

					if($index%2==0){
					?>
						<div class='row'>
					<?	
					}						
			?>
					<div class='col s12 m6'>
							<div class="card-destinos">
								<div class="card">
									<div class="card-image hoverable">
										<?php if($p["promocion_miniatura_". Yii::app()->language] != ""){ ?>
											<a href='<?php echo $url; ?>' title='<?php echo $p['promocion_' . Yii::app()->language];?>' class='bloque promo-div-coined-img'>
												<img class='full-width' src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $p['promocion_miniatura_'. Yii::app()->language];?>" />
											</a>	
										<?php }else{ ?>
											<div class='bloque promo-div-coined-img promo-no-image'></div>
										<?php } ?>			
									</div>	
									<div class="card-content card-action hoverable contenidoDestinos">
										<div class='offerName'>
											<a class="red-text" href='<?php echo $url; ?>' title='<?php echo $p["promocion_" . Yii::app()->language]; ?>'><?php echo $p["promocion_" . Yii::app()->language];?></a>
										</div>
							
										<?php if($p["promocion_aplica_descripcion"] == 1){ ?>
											<div class='bloque promo-div-coined-desc'><?php echo $p["promocion_desc_" . Yii::app()->language]; ?> </div>
										<?php } ?>
										<a class="waves-effect waves-light btn white-text" href='<?php echo $url; ?>' title='<?php echo $p["promocion_" . Yii::app()->language];?>' class='promo-div-coined-btn misc_select_btn_green'>
											<i class="material-icons left">input</i>
											<?php echo (($p["promocion_bookingbox"] == 0) ? Yii::t("global","Ver información de promoción"): Yii::t("global","BOOK"));?>
										</a>
									</div>
								</div>	
							</div>	
					</div>				
					
					<?
					if($index%2!=0){
					?>
						</div>
					<?	
					}
					
					$index++;
					}
				}
				if($index==0){ ?>
					<div class="col s12">
						<div class="row"><br></div>
						<center><h5 class="offerName red-text">We have no offers in Hotels</h5></center>
						<div class="row"><br></div>
					</div>

			<?	}
			}
	?>	    	

	    </div>
	    <div id="tours" class="col s12">
			<?
			$index=0;
			foreach($_Promociones as $p){
				if($p["promocion_producto"] == "tour"){
					if($p["promocion_archivo_" . Yii::app()->language] != ''  &&  $p["promocion_miniatura_". Yii::app()->language] != ''){
						$url = "/offer/" . Yii::app()->GenericFunctions->makeUrl(str_replace("%","",(str_replace("&","&amp;",(str_replace(",","", $p["promocion_" . Yii::app()->language] )))))) . "-" . $p["promocion_id"] . ".html?seg=L". $p["promocion_id"];		
						if($p["promocion_tipo_contenido"] == 3){
							$url = $p["promocion_link_" . Yii::app()->language];
						}

					if($index%2==0){
					?>
						<div class='row'>
					<?	
					}	
			?>
					<div class='small col s12 m6'>
							<div class="card-destinos">
								<div class="card ">
									<div class="card-image hoverable">
										<?php if($p["promocion_miniatura_". Yii::app()->language] != ""){ ?>
											<a href='<?php echo $url; ?>' title='<?php echo $p['promocion_' . Yii::app()->language];?>' class='bloque promo-div-coined-img'>
												<img class='full-width' src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $p['promocion_miniatura_'. Yii::app()->language];?>" />
											</a>	
										<?php }else{ ?>
											<div class='bloque promo-div-coined-img promo-no-image'></div>
										<?php } ?>			
									</div>	
									<div class="card-content card-action hoverable contenidoDestinos">
										<div class='offerName'>
											<a class="red-text" href='<?php echo $url; ?>' title='<?php echo $p["promocion_" . Yii::app()->language]; ?>'><?php echo $p["promocion_" . Yii::app()->language];?></a>
										</div>
							
										<?php if($p["promocion_aplica_descripcion"] == 1){ ?>
											<div class='bloque promo-div-coined-desc'><?php echo $p["promocion_desc_" . Yii::app()->language]; ?> </div>
										<?php } ?>
										<a class="waves-effect waves-light btn white-text" href='<?php echo $url; ?>' title='<?php echo $p["promocion_" . Yii::app()->language];?>' class='promo-div-coined-btn misc_select_btn_green'>
											<i class="material-icons left">input</i>
											<?php echo (($p["promocion_bookingbox"] == 0) ? Yii::t("global","Ver información de promoción"): Yii::t("global","BOOK"));?>
										</a>
									</div>
								</div>	
							</div>	
					</div>

					<?
					if($index%2!=0){
					?>
						</div>
					<?	
					}

					$index++;		
					?>


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
			<div class="parallax "><img src="<?=Yii::app()->params['baseUrl']?>/images/bg/footer-deals.jpg"></div>
		</div>
	</div>

	<? //$value=$notas2;?>
	<!-- <div class="row hide-on-med-and-down">
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
	</div> -->
</div>
 <script type="text/javascript">
	 $(document).ready(function(){
		 $("#txtBanner").html("ALL SUITES, ALL BUTLERS, ALL GOURMET");
		 $("#txtBanner1").html("");
	 });
 </script>
