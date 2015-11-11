				
                	<div style="background-color: white;width:400px;">
                    
					<?php
						
							
						
						
					
						$MealPlans = array();
							
							echo "<div class='bloque OptionHotel MainHotelOption' id='' >";
                            echo "<br />";
								echo "<div class='OptionResult_ajax' style='background-image: none !important;margin-left:10px;margin-top:10px;background-color:white;';>";
									echo "<div class='hotelPhoto' ><a style='font-size: 11pt;' href='#' title='Foto Principal'>";
										echo "<img src='/images/130/" . $_imgPrincipal . "' alt='Foto Principal' /></a>";
									echo "</div>";
									
									echo "<div class='hotelContent' style='width:250px;'>";
										echo "<h2><a style='font-size: 10pt;' href='#' title=''>" . $_t[((Yii::app()->language == "es") ? "tour_nombre_es" : "tour_nombre")] . "</a>";
											if((int) $_t["tour_adulto"] == 1){
												echo " - <span class='onlyAdultsLabel'>";
													echo Yii::t("global","Sólo Adultos");
												echo "</span>";
											}											
										echo "</h2>";
										echo "<div class='clear' style='margin-left:-1px'>";
										echo "<div class='hotelPrice'></div>";
										
										echo "<span style='font-size: 20px; font-weight: bold; color: #7d7c81;'>$" . number_format((float)$minPrice,0) . "</span><span style='color:#7d7c81;' class='currency_code'>" . $_SESSION["config_es"]["currency"] . "</span><br />";
										echo "<span style='font-size: 9px; color: #9a999f;'>" . Yii::t("global", "Tarifa promedio más baja por persona") . ".</span>";
										
										echo "<div class='tour_categoria_info_displayer'>";
												echo "<span>";
													
														$_cats = "";
														foreach($Categorias[$_t["tour_id"]] as $_c){
															$_cats .= " - " . $_c["cnombre"];
														}
														
														echo substr($_cats,2);
													
												echo "</span>";
										echo "</div>";
									 	echo "</div>";
										$texto = $_t["descripcion_larga"];
										$text= strip_tags($texto, "<p>,<strong>, <b>");
										echo "<div class='clear' style='padding: 5px;'></div>";
										echo "<div class='bloque' style='margin-left: -100px !important; margin-right: -60px !important; padding-right: 0px; height: 230px; overflow: auto; font-size:10px; color: #9a999f;width:380px;'>".$text. "</div>";
										echo "\n";
									echo "</div>";
											
									
									
									echo "<div class='clear'></div>";
									
									echo "<br />";
									echo "<div class='bloque' style='margin-left:6px;'>";
									echo "<form method='post' action='" . $this->createUrl("tours/agregar") . "' id='flightsCheckoutFormToursAjax'>";
									echo "<table class='hotelRoomsTable' cellspacing='0' cellpadding='0' width='95%'>";
										echo "<thead>";
											echo "<tr>";
												echo "<th style='background-color: #009bdb; color: #fff; font-weight: bold;' width='65%'>" . Yii::t("global","Concepto") . "</th>";
												echo "<th style='background-color: #009bdb; color: #fff; font-weight: bold; text-align: right !important;' width='20%''>Total</th>";
												echo "<th style='background-color: #009bdb; color: #fff; font-weight: bold;' width='5%'>&nbsp;</th>";
											echo "</tr>";
										echo "</thead>";
										echo "<tbody style='color: #9a999f;'>";
											
											$x = 0;	
											foreach($Tarifas as $z){
												$price = 0;
												
												$d = $_t["tour_destino"];					
												if($d == 1 || $d == 2 || $d == 3 || $d == 4 || $d == 11 || $d == 12){
													$z["tarifa_precio_adulto"] = (($z["tarifa_precio_adulto"] * 1.11));
													$z["tarifa_precio_menor"] = (($z["tarifa_precio_menor"] * 1.11));
												}else{						
													$z["tarifa_precio_adulto"] = (($z["tarifa_precio_adulto"] * 1.16));
													$z["tarifa_precio_menor"] = (($z["tarifa_precio_menor"] * 1.16));						
												}
												
												if($z["tarifa_tipo_cobro"] == 1){							
													$ad = $_ad * $z["tarifa_precio_adulto"];
													$mn = $_mn * $z["tarifa_precio_menor"];
													$price = $ad + $mn;
												   // echo $test;
												
												}else{
													$price = $z["tarifa_precio_adulto"];							
												}

										 //$price; 
                                             		$price = Yii::app()->Currency->convert($_SESSION["config_es"]["currency"],$price);   
                                         //Yii::app()->Currency->convert($_SESSION["config_es"]["currency"],$price);
												echo "<tr>";
												echo "<td>";
													if(trim($z["tarifa_nombre_" . Yii::app()->language]) != ""){
														echo $z["tarifa_nombre_" . Yii::app()->language];
														echo "<br />";
													}
													if($z["tarifa_descripcion_" . Yii::app()->language] != "" && $z["tarifa_descripcion_" . Yii::app()->language] != " "){
														echo $z["tarifa_descripcion_" . Yii::app()->language];
														echo "<br />";
													}
													if($z["tarifa_tipo_cobro"] == 1){							
														echo Yii::t("global","Precio por adulto") . ": $" . number_format(Yii::app()->Currency->convert($_SESSION["config_es"]["currency"],$z["tarifa_precio_adulto"]),0);
														echo "<br />";
                                                        if($_t["tour_id"] != 73)
                                                        {
                                                        if($z["tarifa_precio_menor"] != 0)
                                                          {
														  echo Yii::t("global","Precio por menor")  . ": $" . number_format(Yii::app()->Currency->convert($_SESSION["config_es"]["currency"],$z["tarifa_precio_menor"]),0);
                                                          }
                                                        }
														
													}else{
														echo Yii::t("global","Tarifa") . ": $" . $price . " " . Yii::t("global","desde") . " " . 1 . " " . Yii::t("global","hasta") . " " . $z["tarifa_max_adultos"] . " pax";							
													}
												echo "</td>";
												echo "<td valign='top' class='prod_total_list' align='right'><strong>$" . number_format($price,0) . "</strong></td>";
												
												if($x == 0){													
													echo "<td valign='top' align='center'><input class='misc_btn_rate_select' type=\"radio\" id=\"jnfe\" name=\"jnfe\" value=\"" . Yii::app()->GenericFunctions->ProtectVar($z["tarifa_id"] . "@@" . $_t["tour_id"] . "@@" . $z["servicio_id"] . "@@" . ((Yii::app()->language == "es") ? $_t["tour_nombre_es"] : $_t["tour_nombre"]) . "@@" . $z["servicio_" . Yii::app()->language] . " - " . $z["tarifa_nombre_" . Yii::app()->language] . "@@" . $_t["descripcion_corta"] . "@@" . $z["tarifa_precio_adulto_mxp"] . "@@" . $price . "@@" . $_t["tour_reservable"] . "@@" . $_fecha . "@@" . $_ad . "@@" . $_mn . "@@" . $_t["tour_destino"] . "@@/images/180/" . $_imgPrincipal . "") . "\" checked=\"checked\" /></td>";	
												}else{				
													
													echo "<td valign='top' align='center' width='5%'><input class='misc_btn_rate_select' type=\"radio\" id=\"jnfe\"name=\"jnfe\" value=\"" . Yii::app()->GenericFunctions->ProtectVar($z["tarifa_id"] . "@@" . $_t["tour_id"] . "@@" . $z["servicio_id"] . "@@" .((Yii::app()->language == "es") ? $_t["tour_nombre_es"] : $_t["tour_nombre"])  . "@@" . $z["servicio_" . Yii::app()->language] . " - " . $z["tarifa_nombre_" . Yii::app()->language] . "@@" . $_t["descripcion_corta"] . "@@" . $z["tarifa_precio_adulto_mxp"] . "@@" . $price . "@@" . $_t["tour_reservable"] . "@@" . $_fecha . "@@" . $_ad . "@@" . $_mn . "@@" . $_t["tour_destino"] . "@@/images/180/" . $_imgPrincipal . "") . "\" /></td>";
												}	
												
												
												
																	
												
												
												
												echo "</tr>";
												$x++;
											}		
										
										echo "</tbody>";
									echo "</table>
										</form>
									";						
													
								echo "</div>";				
							echo "</div>";
							echo "</div>";
							
					?>
						<br />
						<div style="margin-left:280px; z-index:1;position:absolute;rigth:0px;width:120px;*margin-left:260px;*margin-top:2px;" id="p">
						<a style="float:right; margin-right:20px; margin-top:60px;width:50px;" href="#" title="Agregar al Carrito" class="curved misc_select_btn_green btnAddtoCart">
							Agregar
						</a>
						</div>
					</div>
