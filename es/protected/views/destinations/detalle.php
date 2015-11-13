<div class="row"></div>
<div class="row bookin-form1" style="z-index:10;position: relative;">
	<div class="col s12">
		<?php	$this->widget('application.components.Bookingbox'); ?>
		<?php $fecha = date("d/m/Y",mktime(0,0,0,date("m"),date("d")+3,date("Y"))); ?>
	</div>
</div>
<div class="row">
	<div class="col s12 m10 offset-m1">
		<style>
			#main_bookingbox, #main_home_booking_box_new{border: 3px solid #00aaa6; margin-bottom: 1%;}
			#main_home_booking_box_new .booking_options {border: none;}
		</style>

		<?php 
			$Hotel = $Hoteles[0];



						
			$_fini = Yii::app()->_Hotels->Config["Dates"]["CheckIn"];
			$_ffin = Yii::app()->_Hotels->Config["Dates"]["CheckOut"];
			$_noches = Yii::app()->GenericFunctions->difDays($_fini,$_ffin);
		?>

		<div class="content">


			<h6 class="infoSearch">
				<?php echo $Hotel->Location->attributes()->city.', '.$Hotel->Location->attributes()->searchingState;?> &#8226; 
				<?php echo GenericFunctions::convierteFechaLetra(date('d/m/y', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckIn"])),4,2); ?> - 
				<?php echo GenericFunctions::convierteFechaLetra(date('d/m/y', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckOut"])),4,2); ?> 
				<?
				$totalAdultos=0;
				$totalNinos=0;
				foreach(Yii::app()->_Hotels->Config["Rooms"] as $paxHab){
					$totalAdultos += $paxHab["Adults"];
					$totalNinos += $paxHab["Childs"];	
				}?>		
				<?php echo sizeof(Yii::app()->_Hotels->Config["Rooms"])." ";
				if(sizeof(Yii::app()->_Hotels->Config["Rooms"])==1){
					echo "Habitación";
				}else{
					echo "Habitaciones";
				}?> &#8226
				<?php echo "".$totalAdultos." Adultos ";
				if($totalNinos>0){ echo ", ".$totalNinos." Niños"; }
				?> 
				
			</h6>

			<section class="col s12 detail"> 

				<!-- <div>
					<?php  //$this->widget('application.components.GenericElements');	?>
				</div> -->

				<div class="detailHead">
					<h4><?php echo  $Hotel->attributes()->name; ?></h4>
					<p>
						<span class="hotelStars"><?php echo Yii::app()->GenericFunctions->makeStars((float)$Hotel->attributes()->starsLevel); ?></span>
						<?php echo $Hotel->Location->attributes()->address; ?>
					</p>

					<?php if((int) $Hotel->attributes()->onlyAdults == 1): ?>
						<div class="onlyAdultsLabel">
							<?php echo Yii::t("global","Sólo Adultos"); ?>
						</div>
					<?php endif; ?> 

				</div>

				<style>.square-thumb { width: 150px; height: 150px; display:inline-block;} </style>

				<div class="detailPhotos">
					<div class="mainPhoto" >
						<div class="content-main-img">
							<a class="fancybox-thumb" rel="fancybox-thumb" href="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $photos['mainPhoto']; ?>">
								<img class="full-width" src='//xtstatic.lomastravel.com.mx/image/1000/<?php echo $photos['mainPhoto']; ?>' />
							</a>
						</div>
					</div>
					<?php if(count($photos['visibles']) >= 1 ){ ?>
						<div class="visiblePhotos">
							<?php foreach($photos['visibles'] as $vp): ?>
								<div class="vp">
									<div class="content-img">
										<a class="fancybox-thumb" rel="fancybox-thumb" href="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $vp; ?>">
											<img class="full-width" src='//xtstatic.lomastravel.com.mx/image/1000/<?php echo $vp; ?>' />
										</a>	
									</div>
								</div>
							<?php endforeach; ?>
						</div>	
					<?php } ?>
					
					<?php if(count($photos['other']) >= 1 ){ ?>
						<div class="otherPhotos">
							<?php foreach($photos['other'] as $op): ?>
								<div class="op">
									<a class="fancybox-thumb" rel="fancybox-thumb" href="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $op; ?>">
										<img class="full-width" src='//xtstatic.lomastravel.com.mx/image/1000/<?php echo $op; ?>' />
									</a>	
								</div>
							<?php endforeach; ?>
						</div>	
					<?php } ?>

					
					<div class="mapPhoto">
						<div id="mapLocation">
							<div>
											<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script><div id="map_canvas" style="width: 100%; height: 305px"></div><script type="text/javascript">
												function initialize() {
											        var mapOptions = {
											          zoom: 17,
											           center: new google.maps.LatLng(<?= $Hotel->Location->attributes()->latitude; ?>,<?= $Hotel->Location->attributes()->longitude; ?>),
											          mapTypeId: google.maps.MapTypeId.ROADMAP
											        }
											        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
											
											        setMarkers(map, locations);
											      }
											
											     
											      var locations = [
											        ['<?=  $Hotel->attributes()->name; ?>',<?= $Hotel->Location->attributes()->latitude; ?>,<?= $Hotel->Location->attributes()->longitude; ?>, 5]          
											      ];
											
											      function setMarkers(map, locations) {
											        var image = new google.maps.MarkerImage('//cdn.lomastravel.com.mx/img/point_general.png',
											            new google.maps.Size(32, 48),
											            new google.maps.Point(0,0),
											            new google.maps.Point(32, 48));
											            
											        var shadow = new google.maps.MarkerImage('images/beachflag_shadow.png',
											
											            new google.maps.Size(37, 32),
											            new google.maps.Point(0,0),
											            new google.maps.Point(0, 32));
											
											        var shape = {
											            coord: [1, 1, 1, 20, 18, 20, 18 , 1],
											            type: 'poly'
											        };
											        for (var i = 0; i < locations.length; i++) {
											          var beach = locations[i];
											          var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
											          var marker = new google.maps.Marker({
											              position: myLatLng,
											              map: map,
											              shadow: shadow,
											              icon: image,
											              shape: shape,
											              title: beach[0],
											              zIndex: beach[3]
											          });
											        }
											      }
											      
											      initialize();
									     	 </script>
								</div>
						</div>
					</div>
				</div>

				<div class="detailRooms">
					<div id="readyBook">LISTO PARA REALIZAR SU RESERVA EN <?php echo Yii::app()->GenericFunctions->strtoupper(Yii::app()->GenericFunctions->makeSinAcento($Hotel->attributes()->name)) ?></div>
					<!--<div id="roomRecommended">We recommend this room</div>-->
				
		        <div class="">
					<?php
						$Htl = array(
							"Price" 	=>(((float) ($Hotel->attributes()->minAverPrice) == 0) ? 99999 : (float) ($Hotel->attributes()->minAverPrice)),
							"Id" 		=>(int) $Hotel->attributes()->hotelId,
							"rStars" 	=>(float) $Hotel->attributes()->starsLevel,
							"dStars" 	=>substr((string) $Hotel->attributes()->starsLevel,0,1),
							"Name" 		=>$Hotel->attributes()->name,
							"Category" 	=>(string) $Hotel->attributes()->category,
							"Location" 	=>(string) $Hotel->Location->attributes()->city . ", " . (string) $Hotel->Location->attributes()->searchingState
						);
					?>

					<div class='bloque OptionHotel MainHotelOption' id='Hotel_<?php echo $Hotel->attributes()->hotelId;?>'>
						<div class='OptionResult'>
							<div class='hotelContent'>
							<?php	
								foreach($_HL as $_il){
									if($_il["hotel_id"]== $Hotel->attributes()->hotelId){  
		                               	$Room_habitacion = $_il["hotel_habitaciones"];
		                            }
		                        }
		                    ?>		
		                                                                             							
		                    </div>
		                                    
							<?php                 
								$_Rooms = $Hotel->RoomType;
								/*print_r($_Rooms);
								exit()*/
								$room = 0;
								$mostrar_op_ad=true;
								foreach($_Rooms as $_r){
									$isAvailable = true;
									if ($TarifasBloquedas) {
										$isAvailable = false;
									}
									
								
									
									if($room<=4){
										echo "<div class='elementList room_detailed_option_choose'>";
									}else{
										echo "<div class='elementList room_detailed_option_choose room_detailed_all' style='display:none'>";
									}
									
									
									
									//Ezequiel 20140719 se agrega el producto para comparar las habitaciones 
									$productId=$_r->attributes()->productId;
									$Price = $_r->Occup;
									$ocupid = (string) $Price->attributes()->occupId;
									$total = 0;
									$_infoPrice=array();
									$_dtPrice= array();
									$_dataPrice= array();
									$a=0;
									
									$hab_extra=false;
									foreach($Hoteles as $hAll){
										foreach($hAll->RoomType as $rHall){
											$PriceThis = $rHall->Occup;
											if($productId == (string) $rHall->attributes()->productId){
												
												foreach($PriceThis->Price as $_p){
												    $_infoPrice[$a][] = get_object_vars($_p);
												}
												
												$_dataPrice[(string) $rHall->attributes()->productId] = $_infoPrice;
												$total = $total + (float) $PriceThis->attributes()->price;
												$hab_max_ad=0;
												$hab_max_mn=0;
												$hab_max_in=0;
												$hab_max_cap=0;
												$hab_noacepta_mn=0;
												$hab_minimo=0;
												$minHab=0;
																	
												foreach($PriceThis->Price as $_p){
													$minHab = $PriceThis->attributes()->minHab;
													$hab_minimo = $PriceThis->attributes()->hab_minimo;
													if($hab_minimo==1){
														$isAvailable = false;
													}
													if($_p->attributes()->available == 0){	
														$isAvailable = false;
														$hab_max_ad = $PriceThis->attributes()->hab_max_ad;
														$hab_max_mn = $PriceThis->attributes()->hab_max_mn;
														$hab_max_in = $PriceThis->attributes()->hab_max_in;
														$hab_max_cap = $PriceThis->attributes()->hab_max_cap;
														$hab_noacepta_mn = $PriceThis->attributes()->hab_noacepta_mn;																	
													}
													if($_p->attributes()->hab_extra>0){
														$hab_ext[]=(float) $_p->attributes()->hab_extra;
														$hab_extra=true;
													}
												}
												
												$a++;
											}
										}
										if($hab_extra){
											$hab_min = min($hab_ext);
											if($_REQUEST["hotel_rooms"]>$hab_min){
												$isAvailable = false;
											}
										}
									}

									if(intval($_GET['price_max'])>0 && $total>$_GET['price_max'] && $mostrar_op_ad){
										echo "<div style='margin: 0px auto; text-align: center;color:#00aaa6'>";
											echo "<strong class='bloque'>
												<span class='show_more_opt_room'><h6>Additional options &darr; </h6></span>
											</strong>";
										echo "</div>";
										$mostrar_op_ad=false;
									}							
														
									

									// IMAGEN DEL CUARTO
									$_Media = $_r->Media;
		                            foreach($_Media->Images as $img){
										$principal = $img->attributes()->id_imagen;
		                                break;
		                            }
						
		                            echo "<div class='roomsPhoto miniPhoto imgRoomDisplayer room_".$room."' >";
		                            
		                            foreach($_Media->Images as $img){	
		                            	if($img->attributes()->id_imagen == $principal){
											echo "<a class='room-thumb_".$room."' rel='room-thumb_".$room."' href='//xtstatic.lomastravel.com.mx/preview/1000/" . $img->attributes()->path . "'><img class='full-width curved' src='//xtstatic.lomastravel.com.mx/preview/800/" . $img->attributes()->path . "' /></a>";	
										}else{
											echo "<a style='display: none;' class='room-thumb_".$room."' rel='room-thumb_".$room."' href='//xtstatic.lomastravel.com.mx/preview/1000/" . $img->attributes()->path . "'><img class='full-width' src='//xtstatic.lomastravel.com.mx/preview/800/" . $img->attributes()->path . "' /></a>";
										}
									}
									
									echo "</div>";
						
									$room++;


									/*print_r("<pre>");
									print_r($_RoomH);*/

									// DESCRIPCION DEL CUARTO 	
									echo "<div class='elementData roomInformationOpt'>";                                                         
									echo "<p class='elementName'>";
									echo $_r->attributes()->name;
									echo " : ";
									echo $Price->Board->attributes()->name;
									echo "</p>";
															
									$PromoIdCheck = 0;
									$promoImprimidas = array();
									foreach($_r->Occup->Price as $ppHall){
										if((int)$ppHall->attributes()->promotion>0&&!in_array((string)$ppHall->attributes()->promotion,$promoImprimidas)&&(int)$ppHall->attributes()->available==1){
										echo "<div class='hotelPromotion'>Promoción: <span>" . (string) $ppHall->attributes()->promotiondescrip."</span></div>";
										$promoImprimidas[]=(string)$ppHall->attributes()->promotion;
										echo "<div class='hotelBookWindow'>Reservando del : <span>" . GenericFunctions::convierteFechaLetra(date('d/m/Y', strtotime($ppHall->attributes()->promotionini)),2,2)." a ". GenericFunctions::convierteFechaLetra(date('d/m/Y', strtotime($ppHall->attributes()->promotionfin)),2,2).".</span></div>";
										echo "<div class='hotelPromoValid'> Válido: <span>" . GenericFunctions::convierteFechaLetra(date('d/m/Y', strtotime($ppHall->attributes()->promotionestadiaini)),2,2)." a ".GenericFunctions::convierteFechaLetra(date('d/m/Y', strtotime($ppHall->attributes()->promotionestadiafin)),2,2).".</span></div>";	
										}
									}
									                    	
			                        

									foreach($_RoomH as $_g){
										if($_g["descripcion_habitacion"]== $_r->attributes()->roomId){
											echo "<p class='elementDesc'>" . nl2br(strip_tags($_g["descripcion_larga"])) ."</p>";
										}               
									}
									?>
								

								<a href='#' title='More...' class='bloque show_info_room' rel='room_detail_id_<?php echo str_replace(";","_",$productId);?>'>
									<span class='show_more_opt_room red-text'>Ver información de la habitación &darr; </span>
									<span class='show_less_opt_room red-text' style='display: none;'><?php echo "Ocultar información de la habitación";?> &uarr; </span>	
								</a>
								<div class='room-type-description show_detailed_room_info' id='room_detail_id_<?php echo str_replace(";","_",$productId);?>'>	
				                    <!--<a class="openAmenities">Down</a>-->
									<?php
										if(sizeof($_r->Amenities->Amenity) > 0){
											$numAmenity = 0;
											foreach($_r->Amenities->Amenity as $_a){
												$s =  Yii::app()->GenericFunctions->obtenerHotelHabitacionCargos(intval($_a->attributes()->amenityID),intval($_r->attributes()->roomId));

												echo "<span class='roomAmenity'>";
				                                if(isset($s["cargo"])){
													echo $_a->attributes()->name," <span style='color:red;'>$</span>";
				                                }else{
				                                    echo $_a->attributes()->name; 
				                                }
				                                echo "</span>";
				                            }
										}
									?>	
									<!--</ul>-->
									
								</div>
								
								<a href='#' title='More...' class='bloque show_room_info_display_btn' rel='room_ocupp_id_<?php echo str_replace(";","_",$productId);?>'>
									<span class='show_more_opt_label red-text'>Mostrar detalle de precio &darr; </span>
									<span class='show_less_opt_label red-text' style='display: none;'><?php echo Yii::t("global","Ocultar detalle de precio");?> &uarr; </span>	
								</a>


								<div class='show_detailed_rate_info' id='room_ocupp_id_<?php echo str_replace(";","_",$productId);?>'>
								<?php 
									
													
									
									echo "<table class='hotelRoomsTable' cellspacing='0' cellpadding='0' style='width:100%'>";
									echo "<tbody>";
									echo "<tr><td>";
												
									echo "<table cellspacing='0' cellpadding='0' style='width:100%' height='100%'>";
									
									$i = 0;
									$index = 0;
									
									//20150428 Cuando existe una tarifa en 0
									$_tarifaCero=false;
									foreach($Price->Price as $_p){
										$fecha_noche =$_p->attributes()->date;
										$curTime = mktime(0,0,0,date("m",strtotime($fecha_noche)),date("d",strtotime($fecha_noche)),date("Y",strtotime($fecha_noche)));
										
										$thisDayAvailable = 0;
										$countHotel = 0;
										$DayPrice = 0;
										$HavePromo = false;
										$PromoType = 0;
										$_oP = 0;
										foreach($Hoteles as $hAll){
											if($countHotel > 0){
												foreach($hAll->RoomType as $rHall){
													$PriceThis = $rHall->Occup;
													if($productId == (string) $rHall->attributes()->productId){
														$DayPrice = $DayPrice + (float) $PriceThis->Price[$index]->attributes()->value;																						
														if(isset($PriceThis->Discount->attributes()->id)){
															$HavePromo = true;
															
															//Ezequiel 20140808 se agrego $_oP + para que tomara cuando sea mas de 1 hab 
															$_oP = $_oP + (float) $PriceThis->Price[$index]->attributes()->valueOld;
														}else{
															$_oP =  (float) $PriceThis->Price[$index]->attributes()->value;	
														}
													}
												}	
											}else{
												$thisDayAvailable = (int) $_p->attributes()->available;
												$DayPrice = (float) $_p->attributes()->value;
												if(isset($Price->Discount->attributes()->id)){
													$HavePromo = true;
													$_oP = (float) $_p->attributes()->valueOld;
																							
													//Ezequiel se cambio variable no respetaba la promocion cuando eran dias de llegaba 20140430
													if(round($DayPrice)== round($_oP)){
														$HavePromo = false;	
													}
												}	
											}																		
											$countHotel++;
										}
									
										
										if($i==0){
											echo "<tr >";
										}
										
										if($i == 7){
											echo "</tr>";
											$i = 0;
										}
										
										
										
										echo "<td class='td_precioH' >";
										echo "<div class='hotelRoomsTableFecha' >". GenericFunctions::mostrar_dias($curTime)." ".date("j",$curTime)."</div>";
										
										if($thisDayAvailable == 1){	
											if($DayPrice == 0){
												echo "<div class='bloque' style='text-align: center;'>";
												if($isAvailable && $total > 0){	
													//Noches Gratis
													echo Yii::t("global","Free");
													//echo Yii::t("global","N/D");
													//$_tarifaCero=true;
												}else{
													echo Yii::t("global","N/D");
												}
												echo "</div>";
											}else{
												if($HavePromo){
													echo "<span class='bloque' style='text-decoration: line-through; font-size:0.8rem;'>";
													echo Yii::app()->params['Moneda']." $".number_format((float) $_oP,0);
													echo "</span><br>";
												}
																						
												echo "<span class='bloque' >";
												echo Yii::app()->params['Moneda']." $".number_format($DayPrice,0);
												echo "</span>";
											}
										}else{
											echo Yii::t("global","N/D");
										}
										
										echo "</td>";
										
										$i++;
										$index++;
										
										
									}
									
									$ii=0;
									$masD=1;
									$periodo = explode("-",$fecha_noche);
									
									for($a=$index;$a<$_noches;$a++){
										$i++;
										$fecha_noche_ND = $periodo[0]."-".$periodo[1]."-".($periodo[2]+$masD);
										
										echo "<td class='td_precioH' >";
										$curTime = mktime(0,0,0,date("m",strtotime($fecha_noche_ND)),date("d",strtotime($fecha_noche_ND)),date("Y",strtotime($fecha_noche_ND)));
										echo  "<div class='hotelRoomsTableFecha'>".GenericFunctions::mostrar_dias($curTime)." ".date("j",$curTime)."</div>";
										echo Yii::t("global","N/D");
										echo "</td>";
										
										if($i==0){
											echo "<tr >";
										}
										if($i == 7){
											echo "</tr>";
											$i = 0;
										}
										
										$masD++;
									}							
									
									echo "</table>";
									echo "</tr></td>";
									echo "</tbody>";
									echo "</table>";
									echo "</div>";

									?>


								</div>


								<div class="elementTax">
								<?php
									if($isAvailable && $total > 0 && !$_tarifaCero){
										echo "<form method='post' action='" . $this->createUrl("destinations/agregar") . "'>";
										$RoomInfo = Yii::app()->_Hotels->Config["Rooms"];
										if(!isset($RoomInfo[0])){
											$RoomInfo = array(
												0 => Yii::app()->_Hotels->Config["Rooms"],
											);
										}
									
										//se agrego para guardar info de la habitacion ezequiel 20140407
										$infoHab="";
										foreach($RoomInfo as $Irooms){
											$infoHab.=$Irooms['Adults'].",".$Irooms['Childs'].":";
											if(sizeof($Irooms['ChildAges'])>0){
												foreach($Irooms['ChildAges'] as $dataRooms){
													$infoHab.=$dataRooms."+";
												}
												$infoHab.=";";
											}
										}

										$_dtPrice = array($_dataPrice,$RoomInfo);
										
										echo "<input class='misc_btn_rate_select' type=\"hidden\" name=\"jnfe\" value=\"" . Yii::app()->GenericFunctions->ProtectVar($ocupid . "@@" . $Hotel->attributes()->hotelId . "@@" . $_r->attributes()->name . "@@" . $Hotel->attributes()->name . "@@" . $total . "@@" . $Hotel->attributes()->desc . "@@" . $Price->Board->attributes()->bbId . "@@" . $Price->Board->attributes()->price . "@@". str_replace("/110/","/160/",$Hotel->attributes()->thumb) . "@@". $Price->Board->attributes()->name . "@@" . (string) $Hotel->Location->attributes()->address . "@@" . base64_encode(serialize($_dtPrice))) . "\" />";
										echo "<input type='hidden' name='promo_id'  value=".$Price->Discount->attributes()->id.">";
										echo "<input type='hidden' name='promo_seg'  value=".$_REQUEST["seg"].">";
			                            foreach($Price->Discount->Promotion as $_b){
											if($_b->attributes()->type == 3){
												echo "<input type='hidden' name='valor_agregado' id='valor_agregado' value='".$_b->attributes()->value."'>";
			    							}
			                            }
										
										foreach($_REQUEST as $k=>$v){
											if(!is_array($v)){
												$ParametersSend[$k] = urlencode($v);
											}else{
												$ParametersSend[$k] = ($v);
											}
										}
																	
										echo "<input name='pgR' type='hidden' value='" . Yii::app()->GenericFunctions->ProtectVar(serialize(Yii::app()->_Hotels->Config)) . "' />";
										$Noches ="Noches";
										if($_noches>1){
											$Noches ="Nochess";
										}								
										echo "<div class='elementPriceInfo'>Total ".$_noches." ".$Noches." </div>";								
										echo "<div class='elementPrice room-type-price-total room-price-font'><span class='currency_code'>". Yii::app()->params['Moneda']."</span> $" . number_format($total,0) . " </div>";
										echo "<div class='elementPriceInfo'>Impuestos incluidos</div>";								
										echo "<div class='elementBook'>";
										//Ezequiel Hoteles bajo solicitud 201405005	
										if($Hotel->attributes()->hotelVenta==1){
											echo "</form>";
											echo "</div>";
											echo '<input type="submit" class="book curved btnBlueSelectRoom  btn btn-large" rel="abrirChat" value="Bajo solicitud >">';
										}else{
											echo "<input type='submit' value='RESERVE' class='book btnBlueSelectRoom  btn btn-large' />";
											echo "</form>";
											echo "</div>";
										}
																		
										
										
									}else{
										$tNights = (int) $_r->attributes()->nights;
										$minStay = (int) $_r->attributes()->min_stay;
										$maxStay = (int) $_r->attributes()->max_stay;
										if($tNights < $minStay || $tNights < $maxStay){
											echo "<div class='bloque' style='color: red;'>" . Yii::t("global","Esta habitación requiere al menos {noches} noche(s) de estadía para este periodo de búsqueda",array("{noches}"=>$maxStay)) . "</div>";
										}
										
										$RoomInfo = Yii::app()->_Hotels->Config["Rooms"];
										if(!isset($RoomInfo[0])){
											$RoomInfo = array(
												0 => Yii::app()->_Hotels->Config["Rooms"],
											);
										}
													
										if($RoomInfo[0]['Childs']>0){
											if($hab_noacepta_mn==1){
												echo "<br>".Yii::t("global","Adults only");
											}else{
												if($hab_minimo==1){
													echo "<br>".Yii::t("global","Ocupación mínima requerida (".$minHab." persons)");
												}else if($hab_max_ad==1){
													echo "<br>".Yii::t("global","Se excede de la capacidad máxima de la habitación");
												}else if($hab_max_mn==1){
													echo "<br>".Yii::t("global","Se excede de la capacidad máxima de la habitación");
												}else if($hab_max_cap==1){
													echo "<br>".Yii::t("global","Se excede de la capacidad máxima de la habitación");
												}else if($hab_max_in==1){
													echo "<br>Infants are not accepted of ".(int) $Hotel->Ages->attributes()->infante_min." to ". (int) $Hotel->Ages->attributes()->infante_max." ages";
												}else if($hab_max_ad==0 && $hab_max_mn==0 && $hab_max_cap==0 && $hab_max_in==0){
													echo "<br><span class='notAvailable'>El hotel no está disponible en estas fechas, modifíquelas o llámenos al<br>01800-00-LOMAS</span>";
												}																	
											}
										}else{
											if($hab_minimo==1){
												echo "<br>".Yii::t("global","Ocupación mínima requerida (".$minHab." persons)");
											}else if($hab_max_ad==1){
												echo "<br>".Yii::t("global","Se excede de la capacidad máxima de la habitación");
											}else if($hab_max_cap==1){
												echo "<br>".Yii::t("global","Se excede de la capacidad máxima de la habitación");
											}else if($hab_max_ad==0 && $hab_max_mn==0 && $hab_max_cap==0){
												echo "<br><span class='notAvailable'>El hotel no está disponible en estas fechas, modifíquelas o llámenos al<br>01800-00-LOMAS</span>";
											}
										}														
																
										echo "<div class='clear'></div>";
									}
									
									echo "</div>";


									echo "</div>";
									
									if($room==5){
										$room_res= count($_Rooms)-$room;
									}							
								}
								//Termina Div room_detailed_option_choose
								if ($room>5){
									echo "<div class='moreRooms'>";
										echo "<a href='#' title='Más...' class='bloque show_info_room_all' >
											<span class='show_more_opt_room'><h6>Mostrar ".$room_res." habitaciones &darr; </h6></span>
											<span class='show_less_opt_room' style='display: none;'><h6>Ocultar ".$room_res." habitaciones &uarr; </h6></span>	
										</a>";
									echo "</div>";
								}
								
								echo "</div>";				
								echo "</div>"; 
								
								
							?>
							
							
							<?php
								echo "</div>";
								if($room==0){
									echo "<br><strong>Hotel no disponible, póngase en contacto con nuestro centro de llamadas : 01800-00-LOMAS</strong>";
								}						
							?>
						</div>
								<article class="detailInfo">
								<div class="readyBook">DESCRIPCIÓN DEL HOTEL</div>
								
								<ul class="collapsible popout" data-collapsible="accordion">
									<li>
										<div class="collapsible-header red-text"><i class="material-icons">filter_drama</i>Descripción </div>
										<div class="collapsible-body"><p class="black-text"><?= nl2br(utf8_encode(base64_decode($Hotel->Descriptions->longDescription))); ?></p></div>
									</li>
									<li>
										<div class="collapsible-header red-text"><i class="material-icons">filter_drama</i>Habitaciones </div>
										<div class="collapsible-body">
											<div class="row">
												<?php foreach($_HL as $_il){
			                    					if($_il["hotel_id"]== $Hotel->attributes()->hotelId){  
			                       						$Room_habitacion = $_il["hotel_habitaciones"];
			                    					}
												}?>

												<div class="col s12 m4">
													<h6 class="roomsTitle center-align blue-grey-text">Llegada</h6>
													<? if($Hotel['hotel_checkin']==""){?>
														<h6 class="black-text center-align">15:00 hrs.</h6>
													<?}else{?>
														<h6 class="black-text center-align"><?=substr($Hotel['hotel_checkin'],0,2)?>:00 hrs.</h6>
													<?}?>	
												</div>

												<div class="col s12 m4">
													<h6 class="roomsTitle center-align blue-grey-text">Salida</h6>
													<? if($Hotel['hotel_checkout']==""){?>
														<h6 class="black-text center-align">12:00 hrs.</h6>
													<?}else{?>
														<h6 class="black-text center-align"><?=substr($Hotel['hotel_checkout'],0,2)?>:00 hrs.</h6>
													<?}?>	
												</div>

												<div class="col s12 m4">
													<h6 class="roomsTitle center-align blue-grey-text">Total</h6>
													<h6 class="black-text center-align"><? echo $Room_habitacion . ' Habitaciones'; ?></h6>
												</div>		
											</div>
										</div>
									</li>
									<li>
										<div class="collapsible-header red-text"><i class="material-icons">filter_drama</i>Categoria </div>
										<div class="collapsible-body">
											<div class="row">
												<?php $hotelCategories = explode("," , $Hotel->attributes()->category);?>

												<div class="col s12">
													<div class="row">
														<?php 
														foreach ($hotelCategories as $hc):
															 echo '<div class=" col s4 m3 l2 black-text center-align"><h6>' . $hc . "</h6></div>";
														endforeach; 
														?>
													</div>
												</div>		
											</div>
										</div>
									</li>																		
									<li>
										<div class="collapsible-header red-text"><i class="material-icons">filter_drama</i>Servicios </div>
										<div class="collapsible-body">
											<div class="row">
												<div class="col s12">
													<ul class="collection">
														<?php
							                            if(sizeof($Hotel->Amenities->Amenity) > 0){
															foreach($Hotel->Amenities->Amenity as $_a){
																if($_a->attributes()->amenityTipo ==1){
																	echo '<li class="collection-item black-text center-align">';
							             							$s =  Yii::app()->GenericFunctions->obtenerHotelCargos($_a->attributes()->amenityID,$Hotel->attributes()->hotelId);
																	if($s["cargo"]){
							                                            echo $_a->attributes()->name," <span style='color:red;'> $</span>",($s["habitaciones_cuenta"]==0 ? "" : "(".$s["habitaciones_cuenta"].")");
							               					        }else{
							               					        	echo $_a->attributes()->name," ",($s["habitaciones_cuenta"]==0 ? "" : "(".$s["habitaciones_cuenta"].")");
							                                        }
							                                        echo "</li>";                                   
										                 		}
															}
														}
														?>													
													</ul>
												</div>		
											</div>
										</div>
									</li>									
									<li>
										<div class="collapsible-header red-text"><i class="material-icons">filter_drama</i>Facilidades </div>
										<div class="collapsible-body">
											<div class="row">
												<div class="col s12">
													<ul class="collection">
														<?php
							                            if(sizeof($Hotel->Amenities->Amenity) > 0){
															foreach($Hotel->Amenities->Amenity as $_a){
																
																if($_a->attributes()->amenityTipo ==2){
																	echo '<li class="collection-item black-text center-align">';
							             							$s =  Yii::app()->GenericFunctions->obtenerHotelCargos($_a->attributes()->amenityID,$Hotel->attributes()->hotelId);
																	if($s["cargo"]){
							                                            echo $_a->attributes()->name," <span style='color:red;'> $</span>",($s["habitaciones_cuenta"]==0 ? "" : "(".$s["habitaciones_cuenta"].")");
							               					        }else{
							               					        	echo  $_a->attributes()->name," ",($s["habitaciones_cuenta"]==0 ? "" : "(".$s["habitaciones_cuenta"].")");
							                                        }
							                                        echo "</li>";                                   
										                 		}
															}
														}
														?>													
													</ul>
												</div>		
											</div>
										</div>
									</li>
									<li>
										<div class="collapsible-header red-text"><i class="material-icons">filter_drama</i>Actividades </div>
										<div class="collapsible-body">
											<div class="row">
												<div class="col s12">
													<ul class="collection">
														
														<?php
														$activities =array();                         
														foreach($_HA as $_xl){
															if($_xl["hotel"]== $Hotel->attributes()->hotelId){  
																if($_xl["descripcion"] != ""){
																	if(!in_array($_xl["descripcion"], $activities)){
																		if($_xl["con_costo"] == 1){
																			echo '<li class="collection-item black-text center-align">'.$_xl["descripcion"]." <span style='color:red;'> $</span></li>";	
																		}else{
																			echo '<li class="collection-item black-text center-align">'.$_xl["descripcion"]."</li>";
																		}
																		$activities[]=$_xl["descripcion"];
																	}
																}
															}
														} 
														?>													
													</ul>
												</div>		
											</div>
										</div>
									</li>									
									<li>
										<div class="collapsible-header red-text"><i class="material-icons">filter_drama</i>Restaurantes & Bars </div>
										<div class="collapsible-body">
											<div class="row">

												<?php if(sizeof($Hotel->Restaurants->Restaurant) > 0){
												$rst = 0;
												foreach($Hotel->Restaurants->Restaurant as $_res){?>
													<div class="col s12 card-panel hoverable">
														<div class="row"></div>
															<h5 class="center-align black-text"><?php echo nl2br($_res->attributes()->name); ?></h5>
															<div class="col s12 m9 l10 black-text">
																<?php
																if($_res->attributes()->schedule!=""){
																	echo "<div class='schedule'>" .nl2br($_res->attributes()->schedule)."</div>";
																}
																if($_res->attributes()->description!=""){
																	echo "<div class='description'>".nl2br($_res->attributes()->description). "</div>";
																}
																if($_res->attributes()->dress_code!=""){
																	echo "<div class='dresscode'>".nl2br($_res->attributes()->dress_code). "</div>"; 	
																}
																?>
															</div>
														
															<div class="col s12 m3 l2 roomResPhotoD">
																<?php $class = ""; ?>
																<ul>
																<?php foreach ($_res->Images as $photoRes): ?>
																	<?php if($photoRes->attributes()->path!=""): ?>
																		<li class="<?php echo $class; ?> photoRest" data-src="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $photoRes->attributes()->path;?>" >
																			<a class='roomResPhoto-thumb_<?php echo $rst;?>' rel='roomResPhoto-thumb_<?php echo $rst;?>' href="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $photoRes->attributes()->path;?>" class="fancybox-thumb">
																				<img class="responsive-img" src="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $photoRes->attributes()->path;?>" />
																			</a>
																		</li>
																	<?php endif; ?>
																	<?php $class="hide"; ?>
																<?php endforeach; ?>
																</ul>
															</div>
														
													</div>
													<?php $rst ++; ?>
												<?php }} ?>

											</div>
										</div>


									</li>								
									<li>
										<div class="collapsible-header red-text"><i class="material-icons">filter_drama</i>Politicas </div>
										<div class="collapsible-body"><p class="black-text"><?= nl2br(utf8_encode(base64_decode($Hotel->Descriptions->legal))); ?></p></div>
									</li>									
								</ul>
								</article>
						
						</section>

						<!-- Banner Lateral Derecho -->
						<!-- <aside class="aSide">
							<?php //echo $this->renderPartial('application.views.partials.bannerslaterales', array("_BannersLaterales"=>$_BannersLaterales)); ?>
						</aside> -->
							
					</div>
											<!-- para inicializar el slide de imagenes [Inicio] -->
											<?php if(sizeof($Hotel->Restaurants->Restaurant) > 0){
											
											foreach($Hotel->Restaurants->Restaurant as $_res){?>
											<div class="roomResTitle roomResTitleD">
													<? $rst = 0; ?>
													<div class="roomResPhoto roomResPhotoD">
														<?php $class = ""; ?>
														<?php foreach ($_res->Images as $photoRes): ?>
															<? if($class==""): ?>
															<?php if($photoRes->attributes()->path!=""): ?>

																<li class="hide photoRest" data-src="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $photoRes->attributes()->path;?>" >
																	<a class='roomResPhoto-thumb_<?php echo $rst;?>' rel='roomResPhoto-thumb_<?php echo $rst;?>' href="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $photoRes->attributes()->path;?>" class="fancybox-thumb">
																		<img src="//xtstatic.lomastravel.com.mx/image/1000/<?php echo $photoRes->attributes()->path;?>" />
																	</a>
																</li>
															<?php endif; ?>
															<?php $class="photoResHide"; ?>
															<? endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
												<?php $rst ++; ?>
											<?php }} ?>
											<!-- para inicializar el slide de imagenes [Final] -->	
					
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
			
			$(function(){
				//populateBookingBoxHoteles(0);
			});

			$(document).ready(function() {

			$(".fancybox-thumb").fancybox({
				helpers	: {
					title	: {
						type: 'outside'
					},
					thumbs	: {
						width	: 85,
						height	: 85
					}
				}
			});

			$(".roomsPhoto").each(function (index){
				$(".room-thumb_"+index).fancybox({
					helpers	: {
						title	: {
							type: 'outside'
						},
						thumbs	: {
							width	: 85,
							height	: 85
						}
					}
				});
			});

			
			$(".roomResPhoto").each(function (index){
				$(".roomResPhoto-thumb_"+index).fancybox({
					helpers	: {
						title	: {
							type: 'outside'
						},
						thumbs	: {
							width	: 85,
							height	: 85
						}
					}
				});
			});

		});
		</script>			

			
	</div>	
</div>
