<? //print_r($_POST);?>
<style type="text/css">
input[type=text], input[type=password], input[type=email], input[type=url], input[type=time], input[type=date], input[type=datetime-local], input[type=tel], input[type=number], input[type=search], textarea.materialize-textarea {
    background-color: transparent;
    border: none;
    border: 1px solid #9e9e9e;
    border-radius: 0;
    outline: none;
    height: 3rem;
    width: 100%;
    font-size: 1rem;
    margin: 0 0 0px 0;
    padding: 0;
    box-shadow: none;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    transition: all .3s;
}
input[type=text]:focus:not([readonly]), input[type=password]:focus:not([readonly]), input[type=email]:focus:not([readonly]), input[type=url]:focus:not([readonly]), input[type=time]:focus:not([readonly]), input[type=date]:focus:not([readonly]), input[type=datetime-local]:focus:not([readonly]), input[type=tel]:focus:not([readonly]), input[type=number]:focus:not([readonly]), input[type=search]:focus:not([readonly]), textarea.materialize-textarea:focus:not([readonly]) {
    border: 1px solid #FF5A14;
    box-shadow: 0 1px 0 0 #FF5A14;
}
.input-field label.active {
    font-size: 1rem;
    -webkit-transform: translateY(-140%);
    -moz-transform: translateY(-140%);
    -ms-transform: translateY(-140%);
    -o-transform: translateY(-140%);
    transform: translateY(-140%);
}
.ui-menu {
    list-style: none;
    padding: 2px;
    margin: 0;
    display: block;
    outline: none;
    background-color: white;
    border: 1px solid rgba(0,0,0,0.6);
    max-height: 300px;
    overflow-y: auto;
}
.ui-autocomplete-destination {
    background: #FF5A14;
    color: #fff;
    padding: 2px;
}
.ui-state-focus{
	background-color: rgba(0,0,0,0.4);
}
</style>
<?php
	$Total = 0;
	foreach($_Productos as $_p){
		$Total = $Total + $_p->descripcion_total;		
	}
	if(isset($_POST["param"])){
		$Param = unserialize($_POST["param"]); 
	}
	$languaje=strtoupper(Yii::app()->language);
?>
<div class="content contentPage">

<div class="bloque normal_right" style="float: left; padding: 0px;">
	
	<form id = "formularioCheckout" name="formu" method="post" action="<?= $this->createUrl("checkout/validar"); ?>" autocomplete="off">
		<input type="hidden" name="normal" id="normal" value="<?= number_format($Total,0) . " " . Yii::app()->params['Moneda']; ?>" /> 
		<input type="hidden" name="3meses" id="3meses" value="<?= number_format($Total/3,0) . " " . Yii::app()->params['Moneda']; ?>" />
		<input type="hidden" name="6meses" id="6meses" value="<?= number_format($Total/6,0) . " " . Yii::app()->params['Moneda']; ?>" />
	
		<div class="bloque prod_form_blue_bg curved">
			<div class="bloque">
				<h6>
					<?= Yii::t("global","El nombre del viajero debe coincidir con el nombre del tarjetahabiente. Para ser válida su reserva es necesario presentar una identificación oficial y la tarjeta con la cual realizó el pago")?>.
				</h6>
			</div> 
			
			<div class="bloque content_box_of_detail">

				<h2 class="bloque main_enc_with_border"><?= Yii::t("global","Correo Electrónico"); ?></h2>
				<p class = "p_campo">
					<?= Yii::t("global","Correo Electrónico"); ?>
					<br>
					<input  type="text" class="notNull dnMail"  name="email" value="<?= ((isset($Param["email"])) ? $Param["email"] : ""); ?>" />
				</p>
				
				<h2 class="bloque main_enc_with_border"><?= Yii::t("global","Cupón de Descuento"); ?></h2>
				<p>
					<?= Yii::t("global","Código del Cupón a Redimir"); ?>: 
					<br>
					<input  type="text" name="cupon" value="<?= ((isset($Param["cupon"])) ? $Param["cupon"] : ""); ?>"/>
				</p>
				
				
				<h2 class="bloque main_enc_with_border"><?= Yii::t("global","Ingrese la información del viajero"); ?></h2>
				<p >
					<?= Yii::t("global","Nombre del Pasajero"); ?>
					<br />
					<input  type="text" class="notNull"  name="nombre" value="<?= ((isset($Param["nombre"])) ? $Param["nombre"] : ""); ?>" />
				</p>

				<p >
					<?= Yii::t("global","Apellido del Pasajero"); ?>
					<br />
					<input type="text" class="notNull"  name="apellido" value="<?= ((isset($Param["apellido"])) ? $Param["apellido"] : ""); ?>" />
				</p>

				<p >
					<?= Yii::t("global","Dirección"); ?>
					<br />
					<input type="text" class="notNull"  name="direccion" value="<?= ((isset($Param["direccion"])) ? $Param["direccion"] : ""); ?>" />
				</p>

				<p >
					<?= Yii::t("global","País"); ?>
					<br />
					<? $tpais="United States"; ?>
					<select name="pais" id="pais">
						<?php foreach($_Paises as $_pais) { ?>
							<option value="<?=$_pais["PAI_NOMBRE"]?>" <?=$tpais==$_pais["PAI_NOMBRE"]?"selected":""?> ><?=$_pais["PAI_NOMBRE"]?></option>
						<?php }?>
					</select>
				</p>

				<p >
					<?= Yii::t("global","Estado"); ?>
					<br />
					<input type="text" class="notNull"  name="estado" value="<?= ((isset($Param["estado"])) ? $Param["estado"] : ""); ?>" />
				</p>

				<p >
					<?= Yii::t("global","Ciudad"); ?>
					<br />
					<input type="text" class="notNull"  name="ciudad" value="<?= ((isset($Param["ciudad"])) ? $Param["ciudad"] : ""); ?>" />
				</p>

				<p>
					<?= Yii::t("global","Teléfono"); ?>
					<br />
					<input type="text" class="notNull"  name="telefono" value="<?= ((isset($Param["telefono"])) ? $Param["telefono"] : ""); ?>" />
				</p>

				<p>
					<?= Yii::t("global","Código Postal"); ?>
					<br />
					<input type="text" class="notNull"  name="cp" value="<?= ((isset($Param["cp"])) ? $Param["cp"] : ""); ?>" />
				</p>

				<p class="p_especial_request">
					<?= Yii::t("global","Petición Especial"); ?>
					<br />
					<textarea name="special_request"></textarea>
				</p>

				<?php 
					$contieneTour = 0;
					foreach($_Productos as $_p1){
					  	if($_p1->descripcion_tipo_producto == 2){
							$contieneTour = 1;
					  	}
					}
				?>

				<? if($contieneTour == 1){?>
					<p>
						<?= Yii::t("global","Hotel"); ?>
						<br />
						<input type="text" class="notNull" id="hotel_huesped" name="hotel_huesped" value="<?= ((isset($Param["hotel_huesped"])) ? $Param["hotel_huesped"] : ""); ?>" />
					</p>
				<? } ?>
	
				<?
				$tieneTransfer=false;
				foreach($_Productos as $_p1){
					?>
					<? if($_p1->descripcion_tipo_producto == 3){
						$tieneTransfer=true; ?>
				
						<h2 class="bloque main_enc_with_border"><?= Yii::t("global","Información Adicional de Transportación"); ?></h2>
						
						<?php if($_p1->tipo_translado == 1 || $_p1->tipo_translado == 3): ?>
							<strong>Le recordamos que debe registrarse dos horas antes de su vuelo en caso de ser nacional.
							Para vuelos internacionales debe registrarse 3 horas antes de su salida.</strong>
							
							<div class="bloque" style="padding: 15px 0px 15px 0px; font-weight: bold; color: #FF5A14;">
								Servicio de Transportación <?= $_p1->descripcion_tarifa; ?> desde <?= $_p1->descripcion_hotel1; ?> hasta <?= $_p1->descripcion_hotel2; ?> por <?= Yii::t("global","{n} Adulto|{n} Adultos",$_p1->descripcion_adultos); ?>  
								<?php if($_p1->descripcion_menores > 0): ?>
									and <?= Yii::t("global","{n} Child|{n} Children",$_p1->descripcion_menores); ?> 
								<?php endif; ?>
							</div>
							
						<?php endif; ?>
							
						<?php if($_p1->tipo_translado == 1 || $_p1->tipo_translado == 2): ?>
							<div class="bloque" style="padding: 10px 0px 5px 0px;font-weight: bold;font-size: 17px;">
									Transportación Aeropuerto &rarr; Hotel - <?= date("d/d/Y",strtotime($_p1->descripcion_fecha1)); ?>
							</div>

							<div class="bloque">
								<p class="bloque" >
									Tiempo de Llegada
									<br />
									<select name="TransferAddInfo[<?= $_p1->descripcion_id; ?>][descripcion_hora_llegada_vuelo1]" >
										<?= Yii::app()->GenericFunctions->buildFlightTimeCombo(); ?>
									</select>
								</p>
								<p >
									Vuelo Numero<br>

									<input type="text" class="notNull" name="TransferAddInfo[<?= $_p1->descripcion_id; ?>][descripcion_num_vuelo1]" value="">
								</p>
								<p >
									Aerolinea <br>
									<input type="text" class="notNull" name="TransferAddInfo[<?= $_p1->descripcion_id; ?>][descripcion_linea_area1]" value="">
								</p>
							
								<div class="clear"></div>
							</div>
							<?php endif; ?>
							
							<?php if($_p1->tipo_translado == 1 || $_p1->tipo_translado == 3): ?>
							<div class="bloque" style="padding: 10px 0px 5px 0px;font-weight: bold;font-size: 17px;">
									Transportación Hotel &rarr; Aeropuerto - <?= date("d/m/Y",strtotime($_p1->descripcion_fecha2)); ?>
							</div>
							<div class="bloque" >
								<p class="bloque" >
									Salida
									<br />
									<select name="TransferAddInfo[<?= $_p1->descripcion_id; ?>][descripcion_hora_llegada_vuelo2]" >
										<?= Yii::app()->GenericFunctions->buildFlightTimeCombo(); ?>
									</select>
								</p>
								<p >
									Vuelo Numero<br>

									<input type="text" class="notNull" name="TransferAddInfo[<?= $_p1->descripcion_id; ?>][descripcion_num_vuelo2]" value="">
								</p>
								<p >
									Aerolinea <br>
									<input type="text" class="notNull" name="TransferAddInfo[<?= $_p1->descripcion_id; ?>][descripcion_linea_area2]" value="">
								</p>
							
								<div class="clear"></div>
							</div>
							<?php endif; ?>
							
							<?php if($_p1->tipo_translado == 4 || $_p1->tipo_translado == 5): ?>
							<div class="bloque" style="padding: 10px 0px 5px 0px;font-weight: bold;font-size: 17px;">
								Servicio de Transportación <?= $_p1->descripcion_tarifa; ?> desde <?= $_p1->descripcion_hotel2; ?> hasta <?= $_p1->descripcion_hotel1; ?> por <?= Yii::t("global","{n} Adult|{n} Adults",$_p1->descripcion_adultos); ?>  
								<?php if($_p1->descripcion_menores > 0): ?>
								y <?= Yii::t("global","{n} Child|{n} Children",$_p1->descripcion_menores); ?> 
								<?php endif; ?>
							</div>
							
							<div class="bloque" style="padding: 5px 0px;">
								<div class="bloque" style="float: left; width: 50%;">
									<div class="bloque" style="padding: 0px 0px 5px 0px; font-weight: bold; color: #FF5A14;">
										Hotel &rarr; Hotel Transportación - <?= date("d/m/Y",strtotime($_p1->descripcion_fecha1)); ?>
									</div>
									Hora salida de Hotel
									<br />
									<select name="TransferAddInfo[<?= $_p1->descripcion_id; ?>][descripcion_hora_llegada_vuelo1]" style="color: black;margin-top:7px;">
										<?= Yii::app()->GenericFunctions->buildFlightTimeCombo(); ?>
									</select>
								</div>
								
								<?php if($_p1->tipo_translado == 5): ?>
								<div class="bloque" style="float: left; width: 50%;">
									<div class="bloque" style="padding: 0px 0px 5px 0px; font-weight: bold; color: #FF5A14;">
										Transportación	Hotel &rarr; Hotel - <?= date("d/m/Y",strtotime($_p1->descripcion_fecha2)); ?>
									</div>
									Hotel Tiempo de Regreso
									<br />
									<select name="TransferAddInfo[<?= $_p1->descripcion_id; ?>][descripcion_hora_llegada_vuelo2]" style="color: black;margin-top:7px;">
										<?= Yii::app()->GenericFunctions->buildFlightTimeCombo(); ?>
									</select>
								</div>
								<?php endif; ?>
								
								<div class="clear"></div>
							</div>
								
							<?php endif; ?>
							<div class="bloque" style="padding: 10px 0px 5px 0px; font-weight: bold; font-size: 17px;">
								Nombre del pasajero
							</div>
							<strong>Por Ley, esta información es obligatoria para propositos de su seguro.
							Sin esta información no sera posible reservar su transportación.</strong>
							<div class="bloque">
								<?php for($xCount=1;$xCount<=$_p1->descripcion_adultos;$xCount++): ?>
								<p class="bloque">
									Pasajeros #<?= $xCount; ?>
									<br />
									<input type="text" class="notNull" name="TransferInfoPasajeros[<?= $_p1->descripcion_id; ?>][Adults][]" class="notNull"  />
								</p>
								<?php endfor; ?>
								
								<?php for($xCount=1;$xCount<=$_p1->descripcion_menores;$xCount++): ?>
								<p class="bloque">
									Niños #<?= $xCount; ?>
									<br />
									<input type="text" class="notNull" name="TransferInfoPasajeros[<?= $_p1->descripcion_id; ?>][Children][]" />
								</p>
								<?php endfor; ?>
								
								<div class="clear"></div>
							
							</div>
							
							
							
							
				<?php
						  }else{
							if(!$tieneTransfer){
								
									if($_p1->descripcion_tipo_producto == 4){
										//if($_p1->descripcion_producto_id==1 || $_p1->descripcion_producto_id==2){?>
									<div class="bloque" style="padding: 10px 0px 5px 0px; font-weight: bold; color: #FF5A14; font-size: 11pt;">
										Nombre del pasajero para el servicio de asistencia de viaje
									</div>
									<div class="bloque">
										<?php for($xCount=1;$xCount<=$_p1->descripcion_adultos;$xCount++): ?>
										<p class="bloque">
											Pasajeros #<?= $xCount; ?>
											<br />
											<input type="text" class="notNull" name="TransferInfoPasajeros[<?= $_p1->descripcion_id; ?>][Adults][]" class="notNull"  />
										</p>
										<?php endfor; ?>
										
										<?php for($xCount=1;$xCount<=$_p1->descripcion_menores;$xCount++): ?>
										<p class="bloque">
											Niños #<?= $xCount; ?>
											<br />
											<input type="text" class="notNull" name="TransferInfoPasajeros[<?= $_p1->descripcion_id; ?>][Children][]" />
										</p>
										<?php endfor; ?>
										
										<div class="clear"></div>
									
									</div>							
										
									<?	//}
									}
								}
								
							}
						}
						
						 
				?>

				
				<h2 class="bloque main_enc_with_border"><?= Yii::t("global","Forma de Pago"); ?></h2>
				
				<div class="bloque div_payment">
					<span> <?= Yii::t("global","Metodo de Pago"); ?> </span>
					<div class="bloque card-panel method_payment" >
						<p class="bloque fontsize_mobil" >
							<input id="cards" checked="checked" type="radio" name="payment_method" value="2"> 
							<label for="cards">Nacional o Extranjera</label>
							<img src="/images/tarjetas.png" alt=""/>
						</p>
					</div>
					
					<!--<span></span>-->
					<div class="card-panel bloque" id="paymentCard">
						<div class="bloque" style="padding: 10px; background: #fff;">
							<table class="banks_adquiring_cars" cellpadding="0" cellspacing="0" width="100%">
								<tbody>
									<tr>
										<td>
											<? echo "Mensualidades sin Intereses"; ?>
										</td>
										<td>
											<?= Yii::t("global","One Payment"); ?>
										</td>
										<?  if ($_SESSION["config_es"]["currency"] == "MXN") { ?>
											<td> 3 pagos </td>
											<td> 6 pagos </td>
										<? } ?>				
										<td>
											<?= Yii::t("global","Mensualidades"); ?>
										</td>
									</tr>
									<tr>
										<td><?= Yii::t("global","Tarjetas de Débito y/o Crédito"); ?></td>
										<td>
											<input class="method_gateway_selector" checked="checked" type="radio" name="gateway_method" id='gateway_method' value="santander_1" role="needcard_debito1" />
											<label for="gateway_method"></label>
										</td>
										<? if ($_SESSION["config_es"]["currency"] == "MXN") { ?>
											<td></td>
											<td></td>
										<? } ?>										
										<td>
											<div class="bloque gateway_selector_displayer" style="display: block;" id="debito1">
												1 x $<?= number_format(($Total / 1),0) . " " . $_SESSION["config_es"]["currency"]; ?>
											</div>											
										</td>
									</tr>
									<? if ($_SESSION["config_es"]["currency"] == "MXN") { ?>
										<tr>
											<td style="text-align: center; vertical-align: middle;"><img src="/img/bancos/santander.png" alt="" style="height: 30px;" /></label></td>
											<td style="vertical-align: middle;" ><input class="method_gateway_selector" type="radio" name="gateway_method" value="santander_1" role="needcard_santander1" id="needcard_santander1" /><label for="needcard_santander1">1</label></td>
											<td style="vertical-align: middle;" ><input class="method_gateway_selector" type="radio" name="gateway_method" value="santander_3" role="needcard_santander3" id="needcard_santander3" /><label for="needcard_santander3">3</label></td>
											<td style="vertical-align: middle;" ><input class="method_gateway_selector" type="radio" name="gateway_method" value="santander_6" role="needcard_santander6" id="needcard_santander6" /><label for="needcard_santander6">6</label></td>
											<td>
												<div class="bloque gateway_selector_displayer" id="santander1" style="display:none">
													1 x $<?= number_format(($Total / 1),0) . " " . $_SESSION["config_es"]["currency"]; ?>
												</div>
												<div class="bloque gateway_selector_displayer" id="santander3"  style="display:none">
													3 x $<?= number_format(($Total / 3),0) . " " . $_SESSION["config_es"]["currency"]; ?> <br /><?= Yii::t("global","meses sin intereses"); ?>
												</div>
												<div class="bloque gateway_selector_displayer" id="santander6"  style="display:none">
													6 x $<?= number_format(($Total / 6),0) . " " . $_SESSION["config_es"]["currency"]; ?> <br /><?= Yii::t("global","meses sin intereses");?>
												</div>
											</td>
										</tr>
									<? } ?>									
								</tbody>
							</table>						
						</div>
					</div>
					
					<span class='red-text'> <?= Yii::t("global","Información de la Tarjeta"); ?> </span>
					<div class="bloque row" id="formCard">
							<div class="input-field col s12 m6">
									<label for='cc_titularname'><?= Yii::t("global","Titular de la tarjeta"); ?></label>								
									<input type="text" id="cc_titularname" class="notNull" name="titular" value="<?= ((isset($Param["titular"])) ? $Param["titular"] : ""); ?>" autocomplete="OFF" />
							</div>
							
							<div class="input-field col s12 m6">
									<label for='cc_numberCard'><?= Yii::t("global","Número de la tarjeta"); ?></label>
									<input id="cc_numberCard" type="text" class="notNull dnInt" name="numero" id="numero_tarjeta" value="<?= ((isset($Param["numero"])) ? $Param["numero"] : ""); ?>" maxlength="16" autocomplete="OFF" />
									<small><?= Yii::t("global","Sin espacios (máximo 16 digitos)"); ?></small>
							</div>
							
							<p class="expeiration_card">
								<h6><?= Yii::t("global","Fecha que expira"); ?></h6>
								<div class="row">
									<div class="col s6 m2">
										<h6 class="red-text">Mes</h6>
										<select name="cc_month" id="cc_month" class="decorated" style="margin-top: 10px;">						
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "01") ? "selected='selected'" : ""); ?> value="01"><?= Yii::t("global","Enero"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "02") ? "selected='selected'" : ""); ?> value="02"><?= Yii::t("global","Febrero"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "03") ? "selected='selected'" : ""); ?> value="03"><?= Yii::t("global","Marzo"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "04") ? "selected='selected'" : ""); ?> value="04"><?= Yii::t("global","Abril"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "05") ? "selected='selected'" : ""); ?> value="05"><?= Yii::t("global","Mayo"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "06") ? "selected='selected'" : ""); ?> value="06"><?= Yii::t("global","Junio"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "07") ? "selected='selected'" : ""); ?> value="07"><?= Yii::t("global","Julio"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "08") ? "selected='selected'" : ""); ?> value="08"><?= Yii::t("global","Agosto"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "09") ? "selected='selected'" : ""); ?> value="09"><?= Yii::t("global","Septiembre"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "10") ? "selected='selected'" : ""); ?> value="10"><?= Yii::t("global","Octubre"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "11") ? "selected='selected'" : ""); ?> value="11"><?= Yii::t("global","Noviembre"); ?></option>
											<option <?= ((isset($Param["cc_month"]) && $Param["cc_month"] == "12") ? "selected='selected'" : ""); ?> value="12"><?= Yii::t("global","Diciembre"); ?></option>
										</select>
									</div>
									<div class="col s1 m1">

									</div>
									<div class="col s5 m2">
										<h6 class="red-text">Año</h6>
										<select name="cc_year" id="cc_year" class="decorated req nonempty " style="margin-top: 10px;">
											<?php
											
												$ddlYear = "";
												$year = date("Y");
												$mYear = date("Y") + 10;
												$ddlYear .= '';
												for($i = date("Y"); $i < $mYear; $i++){
													if(isset($Param["cc_year"]) && $Param["cc_year"] == $i){
														$ddlYear .= "<option selected='selected' value='" . substr($i,2,2) . "'>" . $i . "</option>";
													}else{
														$ddlYear .= "<option value='" . substr($i,2,2) . "'>" . $i . "</option>";
													}
													
												}		
												echo $ddlYear;				
											?>
										</select>
									</div>
								</div>
							</p>
							<p >
								<?= Yii::t("global","Código de seguridad"); ?>
								<br />

								<input type="password" name="ccv" value="<?= ((isset($Param["ccv"])) ? $Param["ccv"] : ""); ?>" class="dnInt notNull" style="width: 55px; margin-top: 10px;" maxlength="4" autocomplete="OFF" />
							   
							</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="bloque div_btnpolicy">
					<div class="bloque row" >
						<div class="col s12" for="piliciesCheck">	
							<input type="checkbox" class="dncheckbox filled-in" id="piliciesCheck">
							<label for="piliciesCheck"><?= Yii::t("global","He leído y estoy de acuerdo con las")?> <a href="<?= $this->createUrl("site/privacy"); ?>" title="" target="_blank"><?= Yii::t("global","políticas de reservación")?>.</a></label>  
							
						</div> 
					</div>
					<div>
						<a class="btn black-text" href="<?= $this->createUrl("checkout/index"); ?>" title="">&laquo; <?= Yii::t("global","Regresar")?></a>
						<input type="submit" class="btnBlueSelectRoom btn" disabled="disabled" value="<?= Yii::t("global","Continuar")?> &raquo;" />
					</div>
				</div>
				<div class="clear"></div>
			</div>

		</div>	

		<!--<div id="imgLoading" style="background-image: url(http://images.cdn.lomas-travel.com.mx/process.gif);height:50px;width:250px;padding-top:43px;display:none;background-repeat:no-repeat;float:right;  "></div>-->
		<div id="imgLoading" class="btn-green" style="float:right;background-image:url('');width:217px !important;height:40px; !important;display:none;">
			<div id="imgLoading2" style="margin-left:7px;position:absolute;background-image: url('');height:50px;width:250px;padding-top:43px;background-repeat:no-repeat;float:right;  "></div>
		</div>
		<div class="clear"></div>
		</form>	
</div>

	<input type="hidden" name="pgR" value='<?= serialize($ParametersNative); ?>' />
	<input type="hidden" name="sgF" value='<?= serialize($FlightSegments); ?>' />
	<?php
		if(isset($_POST["Pax"])){
			echo "<input type='hidden' name='Pax' value='" . serialize($_POST["Pax"]) . "' />";
		}
	?>
	<?php
		if(isset($_POST["Menor"])){
			echo "<input type='hidden' name='Menor' value='" . serialize($_POST["Menor"]) . "' />";
		}
	?>
	<?php
		if(isset($_POST["TryAgain"])){
			echo "<input type='hidden' name='TryAgain' value='" . ($_POST["TryAgain"]) . "' />";
		}
	?>

<div class="bloque normal_left shopping_cart" style="float: right;margin-right: 10px;">
		<div class="prod_service_resume bloque curved">
			<h5 class="enc_prod_resume bloque" >
				Su Reservación
			</h5>
			<? $Total = 0; ?>
			<? foreach($_Productos as $_p){ ?>
				<? $Total = $Total + $_p->descripcion_total; ?>
				<div class="card hoverable">
					<div class="card-content" style="height: 120px;">
						<span class="card-title activator grey-text text-darken-4"><?= $_p->descripcion_producto ?></span>
						<br><br>
						<h6 class="shopping_Price">
							<?=  $_SESSION["config_es"]["currency"] ." $". number_format($_p->descripcion_total,0); ?>
						</h6>
						<i class='activator red-text' style='cursor:pointer'><i class="material-icons red-text">info_outline</i> Más Info</i>						
						<div class="shopping_moreInformation card-reveal">
							<span class="card-title grey-text text-darken-4">
								<h6><?= $_p->descripcion_producto ?>
								<i class="material-icons right">close</i></h6>
							</span>
							<? if($_p->descripcion_id_cupon==1){?>
								Valido para:
							<?}else{?>
								Fecha:
							<?}?>
							
							<?= Yii::app()->GenericFunctions->convertPresentableDates($_p->descripcion_fecha1); ?>					
							<? if($_p->descripcion_tipo_producto == 3){ ?>
									<? if($_p->tipo_translado == 1 || $_p->tipo_translado == 5){ ?>
										 - <?= Yii::app()->GenericFunctions->convertPresentableDates($_p->descripcion_fecha2); ?>
									<? } ?>
							<? } ?>
								
							<? if($_p->descripcion_tipo_producto == 1){ ?>
									 - <?= Yii::app()->GenericFunctions->convertPresentableDates($_p->descripcion_fecha2); ?>
							<? } ?>	
							<br>							
							<?= $_p->descripcion_adultos; ?>
							<?= Yii::t("global","Adulto|Adultos",$_p->descripcion_adultos); ?>
								
							<? if($_p->descripcion_menores > 0){ ?>
									- 
									<?= $_p->descripcion_menores; ?>
									<?= Yii::t("global","Menor|Menores",$_p->descripcion_menores); ?>
							<? } ?>
							
							<br />
								
							<? if($_p->descripcion_tipo_producto == 1){ ?>
									<strong><?= Yii::t("global","Habitación") ?>:</strong>
							<? }else{ ?>
									<strong><?= Yii::t("global","Tarifa") ?>:</strong>
							<? } ?>

							<?= $_p->descripcion_tarifa; ?>
							
							<br />

							<? if($_p->descripcion_tipo_producto == 1){ ?>
								<? if($_p->valor_agregado!= "") {?>
										<br /><strong><?= Yii::t("global","Valores Agregados") ?>:</strong> 
										<br /><?= $_p->valor_agregado; ?>
								<? } ?>
								<? if($_p->descripcion_promo_name != "") { ?>
									   <br /><strong><?= Yii::t("global","Promocion") ?>:</strong>
									   <br /><?= $_p->descripcion_promo_name; ?>
								<? } ?>
							<? } ?>
							
						</div>


					</div>
				</div>
			<? } ?>
			<div class="prod_service_resume_total">
				<table class="shopping_table" >
					<tr>
						<td>TOTAL </td>
						<td><?= $_SESSION["config_es"]["currency"]. " $". number_format($Total,0); ?></td>
					</tr>
				</table>
			</div>
		</div>

</div>
</div>
<script type="text/javascript">
	$(function(){
		$(".whatisCvv").button();
		$("#paymentCard").show();
		//$("#paymentCard input, #paymentCard select").addClass("notNull");
		
		$("input[name=payment_method]").change(function(){
			qSelect = $(this).val();
			$("#paymentCard > table").show();
			if(qSelect != 1){
				$("#paymentCard").show();	
				
				var role = $(".method_gateway_selector:checked").attr("role");
				role = role.split("_");
				if(role[0] == "needcard"){
					$("#formCard").show();
				}else{
					$("#formCard").hide();
				}			
			}else{
				$("#paymentCard").hide();
				$("#formCard").hide();
			}
		});
		
		$(".method_gateway_selector").click(function(){
			$(".gateway_selector_displayer").hide();
			var role = $(this).attr("role");
			role = role.split("_");
			

			if(role[0] == "needcard"){
				$("#formCard").show();
			}else{
				$("#formCard").hide();
			}
			$("#" + role[1]).show();
		});
		
		var HotelsData = <?= file_get_contents(Yii::app()->params["baseUrl"]."destinations/destinations.html"); ?>;
        // autocomplete customisado para el bookin
        $.widget("custom.MixCombo", $.ui.autocomplete, {
            _create: function() {
                this._super();
                this.widget().menu("option", "items", "> :not(.ui-autocomplete-category)");
            },
            _renderItem: function( ul, item ) {
                return $( "<li>" )
                    .attr("data-value", item.value)
                    .data("ui-autocomplete-item", item)
                    .data("item", item)
                    .append(item.label)
                    .appendTo( ul );
            },
            _renderMenu:function(e,t){
                var n=this,r="";
                $.each(t,function(t,i){
                    if(i.categoria!=r){
                        e.append("<li class='ui-autocomplete-category ui-autocomplete-destination'>"+i.categoria+"</li>");
                        r=i.categoria
                    }
                    n._renderItem(e,i);
                });
            }
        });	

		$("#hotel_huesped").MixCombo({
			delay:0,
			minLength:3,
			source:function(e,t){
				var n=new RegExp($.ui.autocomplete.escapeRegex(e.term),"i");
				t($.grep(HotelsData,function(e){
					e=e.label||e.value||e;
					return n.test(e)||n.test(normalize(e))
				}));

			}
		});

	});
</script>

<script>
	$(document).ready(function(e) {
		$(".shopping_moreDetails").click(function () {
			element = $(this).closest('div').find('.shopping_moreInformation');
			if (element.hasClass( "hide" )) {
				element.removeClass('hide');
			}else{
				element.addClass('hide');
			};
		});
	});

	$(function(){

		$("#piliciesCheck").click(function(){
			if( $(this).is(":checked")){
				$(".btnBlueSelectRoom").removeAttr("disabled");
			}else{
				$(".btnBlueSelectRoom").attr("disabled","disabled");
			}
		});
	});
</script>
</div>
