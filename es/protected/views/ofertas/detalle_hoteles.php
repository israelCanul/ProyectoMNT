<?php 
	if($p["promocion_archivo_" . Yii::app()->language] != ""){ 
?>

<div class="row">

	<div class=" col s12 m10 offset-m1 promo-full-div-image">
		<img class="responsive-img" src="<?php echo $p["promocion_archivo_" . Yii::app()->language];?>" />
	</div>
	

	<div class="col s12 m10 offset-m1">
	<?php
		if($p["promocion_aplica_descripcion"] == 1){
			echo "<div class='bloque promo-div-full-desc'>" . $p["promocion_desc_" . Yii::app()->language] . "</div>";
		}
	?>
	
	<div class="row">
	<?php

	$Hotel = $_Htls[0];
	$_tmpHotels = $_Htls;
	
	$_Htls2 = array();
	$posicion = array();
	$nueva_fila = array();
	
	foreach ($_tmpHotels[0]->Hotel as $k => $v) {
	    $posicion[] = $v->attributes()->minAverPrice;
	    $nueva_fila[] = $v;
	}
	asort ($posicion,SORT_NUMERIC);
	
	foreach ($posicion as $k => $pos) {
	    $_Htls2[] = $nueva_fila[$k];
	}
	
	if(sizeof($_Htls) > 0){
		$Hotel = $_Htls[0];
		
		foreach($_Htls2 as $_h){
			if(isset($_h->attributes()->minAverPrice)){
				$_hotelId= (float)$_h->attributes()->hotelId;
				$x = 1;

				$hotelId = $_h->attributes()->hotelId;
				$promo_ini = explode(" ",$p['promocion_tw_inicio']);
				$landing = $promo_ini[0];
			
				//ezequiel validiacion cuando la promo ya comenzo, tome la fecha actual	20140409						
				if(mktime(0,0,0,substr($landing,5,2),substr($landing,8,2) + 2,substr($landing,0,4))<mktime(0,0,0,date("m"),date("d") + 2,date("Y"))){
					$promo_inicio = date("m/d/Y",mktime(0,0,0,date("m"),date("d") + 2,date("Y")));
					$promo_final = date("m/d/Y",mktime(0,0,0,date("m"),date("d") + 5,date("Y")));							
				}else{
					$promo_inicio = date("m/d/Y",mktime(0,0,0,substr($landing,5,2),substr($landing,8,2) + 2,substr($landing,0,4)));
					$promo_final = date("m/d/Y",mktime(0,0,0,substr($landing,5,2),substr($landing,8,2) + 5,substr($landing,0,4)));
				}						
			
				$urlPagina = explode("?",$_SERVER['REQUEST_URI']);
				$url_promo = "?hotel_destination=".Yii::app()->GenericFunctions->makeUrl((str_replace(",","",utf8_decode($_h->attributes()->name))))."&cCode=&HotelId=".$hotelId."&".$urlPagina[1];
				
?>
			<div class="promotion_home_info_displayer col s12">
				<div class="elementList prod_home_content_info">
					
					<div class="miniPhoto">
						<a href='<?php echo $this->createUrl('hoteles/detalle', array('clave' => $_h->Location->attributes()->cityClave, 'hotel' => $_h->attributes()->hotel_keyword) ).urldecode($url_promo); ?>' title="<?= str_replace("&","&amp;",$_h->attributes()->name);  ?>" class="">
								<img class="full-width"  src="<?= str_replace("/110/","/440/",$_h->attributes()->thumb); ?>"  alt="<?= str_replace("&","&amp;",utf8_decode($_h->attributes()->name));  ?>"  />
		                </a>
		            </div>
	                
					<div class="elementData">
						<div class="elementName misc_book_info_txt_home" style="white-space:normal">
							<a href='<?php echo $this->createUrl('hoteles/detalle', array('clave' => $_h->Location->attributes()->cityClave, 'hotel' => $_h->attributes()->hotel_keyword) ) . urldecode($url_promo); ?>' title="<?= str_replace("&","&amp;",$_h->attributes()->name); ?>">
									<span><?= str_replace("&","&amp;",$_h->attributes()->name); ?></span>
							</a>
							<p class="elementDesc">	<?=substr($_h->attributes()->desc,0,120) . "..."; ?></p>
							<span class="smallLetter">	
								<?= Yii::t("global","Destino"); ?>:
								<a class="misc_destination_info_home shadow" href="<?= $this->createUrl("hoteles/buscar"); ?>?cCode=<?= $_h->Location->attributes()->cityId; ?>&amp;hotel_destination=<?= (string) utf8_decode($_h->Location->attributes()->city); ?>" title="Destino"><?= (string) $_h->Location->attributes()->city; ?></a>
							 </span>	
						</div>
					</div>

					<?
					$total=0;
					$isAvailable = true;
					foreach($_Htls as $all_hotels){
						foreach($all_hotels as $lista_hotels){
							foreach($lista_hotels as $_hotels){
								$All_hotels= (float)$_hotels->attributes()->hotelId."<br>";
								if($_hotelId==$All_hotels){
									$total=$total+$_hotels->attributes()->minAverPrice;
								}
							}
						}
					}
					?>
					
					
					<div class="elementTax prices_form_div_home">
						<?php if($total>0 && $_h->attributes()->minAverPrice!=99999999){ ?>
						
							<div class="elementPriceInfo">
								<?= Yii::t("global","desde"); ?>
							</div>

							<div class="elementPrice red-text">
								<span class='currency_code '><?php echo $_SESSION["config_es"]["currency"]; ?></span> $ <?= number_format($total,0); ?>
							</div>

							<div class="elementPriceInfo">
								<span>Average per night<br/>Taxes included</span>
							</div>
							
										
						<div class="elementBook">
							<a class="book btn btn-large curved misc_select_btn_green" href='<?php echo $this->createUrl('destinations/detalle', array('clave' => $_h->Location->attributes()->cityClave, 'hotel' => $_h->attributes()->hotel_keyword) ).urldecode($url_promo); ?>' title="<?= str_replace("&","&amp;",utf8_decode($_h->attributes()->name)); ?>">
								BOOK				
							</a>	
						</div>
						<?php
							}else{
								
								if($_h->attributes()->onlyAdults==1){
									$RoomInfo = Yii::app()->_Hotels->Config["Rooms"];
									if(!isset($RoomInfo[0])){
										$RoomInfo = array(
											0 => Yii::app()->_Hotels->Config["Rooms"],
										);
									}
									$ro=0;
									foreach($RoomInfo as $InfoRoom){
										if($RoomInfo[$ro]['Childs']>0){
											echo "<span style='font-size: 17px; color: #9a999f;'>" . Yii::t("global","Adults only") . "</span>";
										}else{
											echo "<span style='font-size: 17px; color: #9a999f;'>This hotel is not available in the selected dates,<br> please change your dates or contact us at our call center: <br>314-669-6871</span>";
										}
										$ro++;
										if($ro==1){
											$ro++;	
										}
									}
									
								}else{
									echo "<span style='font-size: 17px; color: #9a999f;'>This hotel is not available in the selected dates,<br> please change your dates or contact us at our call center: <br>314-669-6871</span>";


								}

							}
						?>
						
					</div>
					<div class="clear"></div>
				</div>	
				
				<div class="clear"></div>
			</div>	
<?php
			
			$x++;
			}
		}
	}
?>



</div>
</div>
</div>

<?php 
}

?> 

<script type="text/javascript">
	<?php
		$RoomInfo = Yii::app()->_Hotels->Config["Rooms"];
		if(!isset($RoomInfo[0])){
			$RoomInfo = array(
				0 => Yii::app()->_Hotels->Config["Rooms"],
			);
		}
	?>
	var HotelRoomsInfo = <?= json_encode( $RoomInfo ); ?>;
	

</script>