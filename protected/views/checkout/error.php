<div class="content contentPage errorCheckout">
	<div class="bloque mensajeError" style="">
		¡<?= Yii::t("global","Lo sentimos, su transacción no ha sido aprobada"); ?>!
	</div>
	
	<div class="clear" style="padding: 15px;"></div>
	
	<div class="bloque" style="width: 640px; text-align: right; color: #6f6f6f; float: left; font-size:1.5rem;">
		<?= Yii::t("global","No hemos podido completar la transacción con su banco, por favor inténtelo nuevamente o ingrese otra tarjeta de crédito"); ?>.
		<div class="bloque" style="padding: 5px 0px; font-size: 1rem;">
			<?= Yii::t("global","Detalles del Error:"); ?><br />
            
		</div>
	</div>
	
	<div class="bloque" style="width: 300px; text-align: center; float: right; padding-top: 20px;">
		<form method="post" action="<?= $this->createUrl("checkout/detalle"); ?>">
			<input type="hidden" name="param" value='<?= serialize($_POST); ?>' />
			<input type="hidden" name="TryAgain" value='1' />
			<?php
				if(isset($_POST["Pax"])){
					echo "<input type='hidden' name='Pax' value='" . ($_POST["Pax"]) . "' />";
				}
			?>
			<?php
				if(isset($_POST["Menor"])){
					echo "<input type='hidden' name='Menor' value='" . ($_POST["Menor"]) . "' />";
				}
			?>
			<input type="submit" style="font-size: 20pt; padding: 10px 15px; background-color: #e34530 !important; border-bottom: solid 1px #c13526; text-shadow: 1px 1px 1px #c13526; color:#fff;" class="btnBlueSelectRoom" value="&laquo; <?= Yii::t("global","Intentar con otra tarjeta"); ?>">
		</form>
	</div>

	<div class="clear"></div>
	<div class="clear" style="padding: 5px;"></div>
	
	<div class="bloque" style="padding: 10px 0px; font-size: 1rem;font-family:Arial;font-weight:bold;">
    	<?= Yii::t("global","Llame a Lomas Travel y uno de nuestros representantes con gusto le asistirá");  ?>: 314-669-6871
    </div>
	<div class="bloque" style="font-weight: bold; color: #87868a; font-size: 1rem;">                    
		<?= Yii::t("global","Si tiene suficientes fondos, comuníquese con su banco o llama sin costo a los teléfonos"); ?>					 
	</div>
	
	<div class="bloque" style="padding-top: 10px; width: 300px;">
		<a href="#" class="LiveHelpButton default"> <img src="http://www.lomas-travel.com/livehelp/include/status.php" id="LiveHelpStatusDefault" name="LiveHelpStatusDefault" border="0" alt="Live Help" class="LiveHelpStatus" style="height: 36px; margin-top: 5px; margin-left:840px;"/></a>
	</div>
	<style type="text/css">
		.errorCheckout{
			padding: 2% 5%;
		}
		.errorCheckout .mensajeError{
			background-color: #f4e7e4; 
			border: solid 1px #d12711;
			border-radius: 5px; 
			padding: 20px; 
			text-align: center; 
			font-size: 14pt; 
			color :#d12711;
		}
	</style>
</div>