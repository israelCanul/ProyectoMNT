<script type="text/javascript">
	var urlFlightsXML = "<?= Yii::app()->createUrl("vuelos/destinations"); ?>";
	var urlFlightsHotelsXML = "<?= Yii::app()->createUrl("paquetes/destinations"); ?>";
	var urlTransfersXML = "<?= Yii::app()->createUrl("traslados/destinations"); ?>";
	var dateFormat = "<?= ((Yii::app()->language == "es") ? "dd/mm/yy" : "mm/dd/yy"); ?>";
	var urlHotelsXML = "<?= Yii::app()->createUrl("hoteles/destinations"); ?>";
	var urlTourssXML = "<?= Yii::app()->createUrl("tours/destinations"); ?>";
	needRedirect = false;
</script>

<div class="main_enc_blue_gray curved">
	<h4 class="left-curved"><?= Yii::t("global","Book your Airport Transportation"); ?></h4>
	<div class="clear"></div>
</div>


<form method="post" id="search_transfer_cross_selling" action="<?=  Yii::app()->createUrl("traslados/buscar"); ?>">
	<table cellpadding="5" cellspacing="0" width="100%" id="booking_option_transfers2" class="booking_table">
		<tbody>
			<tr>
				<td  colspan="1">
					<input type="radio" name="transfer_option_type" <?= ((!isset($_REQUEST["transfer_option_type"]) || $_REQUEST["transfer_option_type"] == 1) ? "checked='checked'": ""); ?> value="1"  />
					<?= Yii::t("global","Redondo"); ?>
				</td>
				<td  colspan="2">
					<input type="radio" name="transfer_option_type" <?= (($_REQUEST["transfer_option_type"] == 2) ? "checked='checked'": ""); ?> value="2" />
					<?= Yii::t("global","Sencillo"); ?>
					
				</td>
			</tr>						
			<tr>
				<td width="25%">
					<?= Yii::t("global","Origen"); ?>
                    <select name="AirportCode" id="AirportCode" style="width: 100%;">
						<option <?= ((!isset($_REQUEST["transfer_option_airport"]) || $_REQUEST["transfer_option_airport"] == "1:1") ? "selected='selected'": ""); ?> value="1:1">Cancun Aeropuerto (CUN)</option>	
					</select>
					<input type="hidden" name="transfer_option_airport" id="transfer_option_airport" value="Cancun Aeropuerto (CUN)" />
					<input type="hidden" name="transfer_from" id="transfer_from" autocomplete="off" class="decorated" value="" />
				</td>
				<td width="25%">
					<?= Yii::t("global","Fecha de Llegada"); ?>
                    
					<input class="Null" type="text" name="transfer_arrival" value="<?= $_REQUEST["transfer_arrival"]; ?>" id="transfer_arrival2" style="width: 90%" readonly />
				</td>
				<td width="25%">
				
					<?= Yii::t("global","Hotel / Destination"); ?>
					<br />
                    <?php if($size == "small") { ?>
					<input type="text" name="transfer_to" value="<?= $_REQUEST["transfer_to"]; ?>" id="transfer_to2" size="16" />
                    <?php }  else { ?>
                    <input  type="text" name="transfer_to" value="<?= $_REQUEST["transfer_to"]; ?>" id="transfer_to2" style="width: 90%" />
                    <?php } ?>
					<input class="notNull" type="hidden" name="transfer_option_hotel_id" id="transfer_to_id2" value="<?= $_REQUEST["transfer_to_id"]; ?>" />
				</td>
				<td width="25%">		
					<div class="bloque" id="hidernoReturnTransfer2">
						<?= Yii::t("global","Fecha de Regreso"); ?>
						<input type="text" name="transfer_return"  value="<?= $_REQUEST["transfer_return"]; ?>" id="transfer_return2" style="width: 90%" readonly />								
					</div>						
				</td>
			</tr>	
			<tr>
				<td>
					<?= Yii::t("global","Adultos"); ?>
					<br />
					<select name="transfer_adults">
						<?= Yii::app()->GenericFunctions->makeComboInt(1,45,intval($_REQUEST["transfer_adults"])); ?>
					</select>	
				
				</td>
				<td>
					<?= Yii::t("global","Menores"); ?>
					<br />
					<select name="transfer_child">
						<?= Yii::app()->GenericFunctions->makeComboInt(0,10,intval($_REQUEST["transfer_child"])); ?>
					</select>									
				</td>
				<td><input type="submit" value="<?= Yii::t("global", "Buscar"); ?>" class="curved misc_select_btn_green" /></td>
			</tr>
		</tbody>
	</table>
	
	
	<div class="clear"></div>
</form>
