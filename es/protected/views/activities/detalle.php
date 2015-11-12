<div class="row">

	<section class="contentSide detail col s12 m10 offset-m1">
		<div class="detailHead">
			<span class="operated">Operado por: <span class="supplier"><?=$_t["proveedores"];?></span></span>
			<h1>Tour - <?php echo $_t["tour_nombre_es"];?></h1>
			<h2><?php echo $_t["nombre_es"]; ?></h2>
			<h3><?php echo Yii::app()->GenericFunctions->convertDate($_REQUEST["fecha"]); ?> - <?php echo $_REQUEST["tour_adults"]; ?> <?php echo ($_REQUEST["tour_adults"] == 1) ? "Adulto" : "Adultos"; ?>, <?php echo $_REQUEST["tour_childs"]; ?> <?php echo ($_REQUEST["tour_childs"] == 1) ? "Niño" : "Niños"; ?></h3>
		</div>

		<!-- DESCRIPCION -->
		<div class="detailDescription">
			<p><?php echo nl2br( $_t["descripcion_larga"]); ?></p>
		</div>

		<?php if(sizeof($Imagenes) > 0): ?>
			<div class="detailPhotos">
				<?php foreach($Imagenes as $indice => $_i): ?>
					<?php if ($indice == 0): ?>
					<div class="mainPhoto" >
						<div class="content-main-img">
							<a class="fancybox-thumb" rel="fancybox-thumb" href="//apstatic.lomastravel.com.mx/1000/<?php echo $_i["foto_archivo"]; ?>" >
								<img class="full-width" src="//apstatic.lomastravel.com.mx/800/<?php echo $_i["foto_archivo"]; ?>" alt="" />
							</a>
						</div>
					</div>
					<?php endif; ?>
				<?php endforeach; ?>
					
				<div class="visiblePhotos">
				<?php foreach($Imagenes as $indice => $_i): ?>
					<?php if($indice > 0 && $indice < 5): ?>
						<div class="vp">
							<div class="content-img">
								<a class="fancybox-thumb" rel="fancybox-thumb" href="//apstatic.lomastravel.com.mx/1000/<?php echo $_i["foto_archivo"]; ?>" >
									<img class="full-width" src="//apstatic.lomastravel.com.mx/450/<?php echo $_i["foto_archivo"]; ?>" alt="" />
								</a>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>

				<div class="otherPhotos">
				<?php foreach($Imagenes as $indice => $_i): ?>
					<?php if($indice >= 5 ): ?>
						<div class="op">
							<a class="fancybox-thumb" rel="fancybox-thumb" href="//apstatic.lomastravel.com.mx/1000/<?php echo $_i["foto_archivo"]; ?>" >
								<img class="full-width" src="//apstatic.lomastravel.com.mx/450/<?php echo $_i["foto_archivo"]; ?>" alt="" />
							</a>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>	
			</div>
		<?php endif; ?>

		
		<div class='bloque OptionActivity MainActivityOption'>
			<div class='OptionResult rates'>
				<?php
					$MealPlans = array();						
					$x = 0;	
					foreach($Tarifas as $z){
						echo "<form method='post' action='".$this->createUrl("activities/agregar")."'>";
						echo "<input type='hidden' name='promo_seg'  value=".$_REQUEST["seg"].">";
						$price = 0;
						if($z["tarifa_tipo_cobro"] == 1 || $z["tarifa_tipo_grupo"] == 0){							
							$ad = $_ad * $z["tarifa_precio_adulto"];
							$mn = $_mn * $z["tarifa_precio_menor"];
							$price = $ad + $mn;
						}else{
							if ($z['tarifa_es_paquete'] == 1) {
								$numpersonas = $_ad + $_mn;
								$price       = ceil($numpersonas / $z["tarifa_max_adultos"]);
								$price       = $price * $z["tarifa_precio_adulto"];
							}else{
								$price = $z["tarifa_precio_adulto"];							
							}
						}

						//Validacion para precio de parejas del tour romantic yate  =>
						if ($z["tarifa_tour"] == 1302 && $z["tarifa_id"] == 5301) {
							if (($_ad % 2) == 0) {
								$price = ($_ad / 2 ) * $z["tarifa_precio_adulto"];
							}else{
								$z["opera_Dia"] = "false";
								$z["opera_Dia_descripcion"] = "Available only for couples";
							}							
						}
						//Validacion para parejas del tour romantic yate  <=


						//Convierte a dolares la tarifa si la tarifa_tipo_cobro es MXN
						if ($z["tarifa_tipo_tarifa"] == 2) {
							$price = Yii::app()->Currency->convertMXN($_SESSION["config_es"]["currency"],$price);
						}else{
							$price = Yii::app()->Currency->convert($_SESSION["config_es"]["currency"],$price);
						}
					?>
					

						<!-- Tarifa -->
						<div class='actRate'>

							<!-- Nombre tarifa -->
							<div class='rate-name'>
								<?php 
								if(trim($z["tarifa_nombre_" . Yii::app()->language]) != ""){ 
									echo $z["tarifa_nombre_" . Yii::app()->language];
								}else{
									echo $z["servicio_" . Yii::app()->language];
								}
								?>
							</div>


						
						<?php if($z["tarifa_descripcion_" . Yii::app()->language] != "" && $z["tarifa_descripcion_" . Yii::app()->language] != " "){
							echo "<div class='rate-desc'>" . $z["tarifa_descripcion_" . Yii::app()->language] . "</div>";
						}
													  
						if($z["tarifa_tipo_cobro"] == 1){
							echo "<div class='rate-description'>";		
							//Convierte a dolares la tarifa si la tarifa_tipo_cobro es MXN
							if ($z["tarifa_tipo_tarifa"] == 2) {
								$tarifa_precio_adulto = Yii::app()->Currency->convertMXN($_SESSION["config_es"]["currency"],$z["tarifa_precio_adulto"]);
								$tarifa_precio_menor = Yii::app()->Currency->convertMXN($_SESSION["config_es"]["currency"],$z["tarifa_precio_menor"]);
							}else{
								$tarifa_precio_adulto = Yii::app()->Currency->convert($_SESSION["config_es"]["currency"],$z["tarifa_precio_adulto"]);
								$tarifa_precio_menor = Yii::app()->Currency->convert($_SESSION["config_es"]["currency"],$z["tarifa_precio_menor"]);
							}

							if ((int) $z["tarifa_precio_adulto"] != 0) {
								echo "<div class='rate-amount'><span>" . Yii::t("global","Adultos") . ":</span> <span class = 'currency_code' > ". $_SESSION["config_es"]["currency"]."</span> <span>$" . number_format($tarifa_precio_adulto,0) . "</span></div>";
							}					
			
							if($_t["tour_id"] != 73){
								if($z["tarifa_precio_menor"] != 0){
									echo "<div class='rate-amount'><span>Children:</span> <span class = 'currency_code' > ". $_SESSION["config_es"]["currency"]."</span> <span>$" . number_format($tarifa_precio_menor,0) . "</span></div>";
								}
							}
							echo "</div>";
						}else{
							echo "<div class='rate-description'>";		
								echo Yii::t("global","Tarifa") . ": $" . $price . " " . Yii::t("global","desde") . " " . $z["tarifa_min_adultos"] . " " . Yii::t("global","to") . " " . $z["tarifa_max_adultos"] . " pax";							
							echo "</div>";
							
						}
						
						$openTk=0;	
						if($_REQUEST["openTk"]==1){
							$openTk=1;
						}
						if ($z["opera_Dia"] == "true") {
							echo '<div class="rate-book prod_total_list"> <label> <span class = "currency_code" > '.$_SESSION["config_es"]["currency"].'  </span> $ '.number_format($price,0).'</label> <input type="submit"  class="misc_select_btn_green" value="' . "BOOK" .'" /></div>';
							if($x == 0){													
								echo "<input type=\"hidden\" name=\"jnfe\" value=\"" . Yii::app()->GenericFunctions->ProtectVar($z["tarifa_id"] . "@@" . $_t["tour_id"] . "@@" . $z["servicio_id"] . "@@" . ((Yii::app()->language == "es") ? $_t["tour_nombre_es"] : $_t["tour_nombre"]) . "@@"  . $z["tarifa_nombre_" . Yii::app()->language] . "@@" . $_t["descripcion_corta"] . "@@" . $z["tarifa_precio_adulto_mxp"] . "@@" . $price . "@@" . $_t["tour_reservable"] . "@@" . $_fecha . "@@" . $_ad . "@@" . $_mn . "@@" . $_t["tour_destino"] . "@@//apstatic.lomastravel.com.mx/180/" . $_imgPrincipal . "@@" . $openTk . "@@" . number_format($tarifa_precio_adulto,0,",",""). "@@" . number_format($tarifa_precio_menor,0,",",""). "") . "\" checked=\"checked\" /></td>";	
							}else{				
								echo "<input type=\"hidden\" name=\"jnfe\" value=\"" . Yii::app()->GenericFunctions->ProtectVar($z["tarifa_id"] . "@@" . $_t["tour_id"] . "@@" . $z["servicio_id"] . "@@" .((Yii::app()->language == "es") ? $_t["tour_nombre_es"] : $_t["tour_nombre"])  . "@@" . $z["tarifa_nombre_" . Yii::app()->language] . "@@" . $_t["descripcion_corta"] . "@@" . $z["tarifa_precio_adulto_mxp"] . "@@" . $price . "@@" . $_t["tour_reservable"] . "@@" . $_fecha . "@@" . $_ad . "@@" . $_mn . "@@" . $_t["tour_destino"] . "@@//apstatic.lomastravel.com.mx/180/" . $_imgPrincipal . "@@" . $openTk . "@@" . number_format($tarifa_precio_adulto,0,",",""). "@@" . number_format($tarifa_precio_menor,0,",",""). "") . "\" />";
							}	
						}else{
							echo '<div class="rate-nobook prod_total_list"><span>Not available</span>';
							echo "<div class = 'rate-notabalible'>".$z["opera_Dia_descripcion"]."</div></div>";
						}
														
						/*echo "<div class='rate-book prod_total_list'>";
						if ((int) $price != 0) {
							echo "<strong>$ ". number_format($price,0) . " " . $_SESSION["config_es"]["currency"]  . "</strong>";
						}
						echo "</div>";*/
						echo "</div>";
						
						$x++;
						echo "</form>";	
					}
				?>

			</div>
		</div>

					<div class="bloque infoAct prod_detail_contained">
						
						<h3><?php echo Yii::t("global","Duración"); ?>:</h3>
						<p><?php echo $_t["tour_duracion"]; ?></p>
						
						<div>
							<h3><?= Yii::t("global","Disponible los días"); ?></h3>
						
							<div>
								<table cellpadding="5" cellspacing="1" border="0" width="100%">
									<tbody>
										<tr>
											<td>Lunes</td>
											<td>Martes</td>
											<td>Miércoles</td>
											<td>Jueves</td>
											<td>Viernes</td>
											<td>Sábado</td>
											<td>Domingo</td>										
										</tr>
										<tr>
											<td><img src="<?= (($_t["opera_lunes"] == 1) ? "/images/icon/1.png" : "/images/icon/0.png"); ?>" alt="" /></td>
											<td><img src="<?= (($_t["opera_martes"] == 1) ? "/images/icon/1.png" : "/images/icon/0.png"); ?>" alt="" /></td>
											<td><img src="<?= (($_t["opera_miercoles"] == 1) ? "/images/icon/1.png" : "/images/icon/0.png"); ?>" alt="" /></td>
											<td><img src="<?= (($_t["opera_jueves"] == 1) ? "/images/icon/1.png" : "/images/icon/0.png"); ?>" alt="" /></td>
											<td><img src="<?= (($_t["opera_viernes"] == 1) ? "/images/icon/1.png" : "/images/icon/0.png"); ?>" alt="" /></td>
											<td><img src="<?= (($_t["opera_sabado"] == 1) ? "/images/icon/1.png" : "/images/icon/0.png"); ?>" alt="" /></td>
											<td><img src="<?= (($_t["opera_domingo"] == 1) ? "/images/icon/1.png" : "/images/icon/0.png"); ?>" alt="" /></td>
										</tr>
									</tbody>
								</table>							
							</div>						
						</div>
											
						
						<!-- HORARIOS DE SALIDA -->
						<?php if(trim($_t["descripcion_horarios_salida"]) != "" ): ?>
							<h3><?= Yii::t("global","Salidas"); ?></h3>
							<div class="bloque db_content"><p><?php echo nl2br( $_t["descripcion_horarios_salida"]); ?></p></div>
						<?php endif; ?>
						
						<!-- iINCLUSIONES -->
						<?php if(trim($_t["descripcion_inclusiones"]) != "" ): ?>
							<h3><?= Yii::t("global","Incluye"); ?></h3>
							<div class="bloque db_content"><p><?php echo nl2br($_t["descripcion_inclusiones"]); ?></p></div>						
						<?php endif; ?>
						
						<!-- EXCLUSIONES -->
						<?php if(trim($_t["descripcion_exclusiones"]) != "" ): ?>
							<h3><?= Yii::t("global","No Incluye"); ?></h3>
							<div class="bloque db_content"><p><?php echo nl2br($_t["descripcion_exclusiones"]); ?></p></div>
						<?php endif; ?>
						
						<!-- RECOMENDACIONES -->
						<?php if(trim($_t["descripcion_recomendaciones"]) != "" ): ?>
							<h3><?= Yii::t("global","Recomendaciones"); ?></h3>
							<div class="bloque db_content"><p><?php echo nl2br($_t["descripcion_recomendaciones"]); ?></p></div>
						<?php endif; ?>
						
						<!-- REGULACIONES -->
						<?php if(trim($_t["descripcion_regulaciones"]) != "" ): ?>
							<h3><?= Yii::t("global","Regulaciones"); ?></h3>
							<div class="bloque db_content"><p><?php echo nl2br($_t["descripcion_regulaciones"]); ?></p></div>
						<?php endif; ?>
						
						<!-- POLITICAS -->
						<?php if(trim($_t["descripcion_politicas"]) != "" ): ?>
							<h3><?= Yii::t("global","Política de cancelación"); ?></h3>
							<div class="bloque db_content"><p><?php echo nl2br( $_t["descripcion_politicas"]); ?></p></div>
						<?php endif; ?>
						
					</div>


	</section>



<? if($_REQUEST["openTk"]==1){?>
<script>
$("#tour_fecha").datepicker({defaultDate:1,changeMonth:false,dateFormat:dateFormat,minDate:2,numberOfMonths:2,numberOfMonths:2,maxDate: 180});
</script>
<?}?>