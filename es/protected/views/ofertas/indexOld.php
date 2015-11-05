					<? if(($index%5)==0){ ?>
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
					<?}else{?>
						<div class=' col s12 m3'>
							<div class="card-destinos">
								<div class="card small">
									<div class="card-image">
										<?php if($p["promocion_miniatura_". Yii::app()->language] != ""){ ?>
											<a href='<?php echo $url; ?>' title='<?php echo $p['promocion_' . Yii::app()->language];?>' class='bloque promo-div-coined-img'>
												<img class='full-width' src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $p['promocion_miniatura_'. Yii::app()->language];?>" />
											</a>	
										<?php }else{ ?>
											<div class='bloque promo-div-coined-img promo-no-image'></div>
										<?php } ?>			
									</div>	
									<div class="card-content">
										<div class='offerName'>
											<a class="red-text" href='<?php echo $url; ?>' title='<?php echo $p["promocion_" . Yii::app()->language]; ?>'><?php echo $p["promocion_" . Yii::app()->language];?></a>
										</div>
							
										<?php if($p["promocion_aplica_descripcion"] == 1){ ?>
											<div class='bloque promo-div-coined-desc'><?php echo $p["promocion_desc_" . Yii::app()->language]; ?> </div>
										<?php } ?>
									</div>
									<div class="card-action">
										<a class="waves-effect waves-light btn white-text" href='<?php echo $url; ?>' title='<?php echo $p["promocion_" . Yii::app()->language];?>' class='promo-div-coined-btn misc_select_btn_green'>
											<i class="material-icons left">input</i>
											<?php echo (($p["promocion_bookingbox"] == 0) ? Yii::t("global","Ver información de promoción"): Yii::t("global","BOOK"));?>
										</a>									
									</div>
								</div>	
							</div>	
						</div>				
					<? }
					$index++;		
					?>
<!-- Toursw  -->
			<?
			$index=0;
			foreach($_Promociones as $p){
				if($p["promocion_producto"] == "tour"){
					if($p["promocion_archivo_" . Yii::app()->language] != ''  &&  $p["promocion_miniatura_". Yii::app()->language] != ''){
						$url = "/offer/" . Yii::app()->GenericFunctions->makeUrl(str_replace("%","",(str_replace("&","&amp;",(str_replace(",","", $p["promocion_" . Yii::app()->language] )))))) . "-" . $p["promocion_id"] . ".html?seg=L". $p["promocion_id"];		
						if($p["promocion_tipo_contenido"] == 3){
							$url = $p["promocion_link_" . Yii::app()->language];
						}
			?>
				
					<?if(($index%5)==0){?>
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
					<?}else{?>
						<div class='small col s12 m3'>
							<div class="card-destinos">
								<div class="card ">
									<div class="card-image ">
										<?php if($p["promocion_miniatura_". Yii::app()->language] != ""){ ?>
											<a href='<?php echo $url; ?>' title='<?php echo $p['promocion_' . Yii::app()->language];?>' class='bloque promo-div-coined-img'>
												<img class='full-width' src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $p['promocion_miniatura_'. Yii::app()->language];?>" />
											</a>	
										<?php }else{ ?>
											<div class='bloque promo-div-coined-img promo-no-image'></div>
										<?php } ?>			
									</div>	
									<div class="card-content">
										<div class='offerName'>
											<a class="red-text" href='<?php echo $url; ?>' title='<?php echo $p["promocion_" . Yii::app()->language]; ?>'><?php echo $p["promocion_" . Yii::app()->language];?></a>
										</div>
							
										<?php if($p["promocion_aplica_descripcion"] == 1){ ?>
											<div class='bloque promo-div-coined-desc'><?php echo $p["promocion_desc_" . Yii::app()->language]; ?> </div>
										<?php } ?>
									</div>
									<div class="card-action">
										<a class="waves-effect waves-light btn white-text" href='<?php echo $url; ?>' title='<?php echo $p["promocion_" . Yii::app()->language];?>' class='promo-div-coined-btn misc_select_btn_green'>
											<i class="material-icons left">input</i>
											<?php echo (($p["promocion_bookingbox"] == 0) ? Yii::t("global","Ver información de promoción"): Yii::t("global","BOOK"));?>
										</a>									
									</div>
								</div>	
							</div>	
						</div>				
					<?}
					$index++;		
					?>
				<?  
					}
				}
	
			}
	?>    						