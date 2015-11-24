<?php
	if($vv_Venta == "") $vv_Venta = 55458;
	$cliente = Yii::app()->db->createCommand()
							    ->select('cliente_email')
							    ->from('venta')
							    ->join("cliente","cliente_id = venta_user_id")
                                ->where("venta_id={$vv_Venta}")								    
							    ->queryRow();
							    
?>

<div class="bloque content contentPage" style="padding: 3% 5%;">
	<div class="bloque" style="background-color: #e4edf4; border: solid 1px #128bd0; border-radius: 5px; padding: 20px; text-align: center; font-size: 14pt; color :#128bd0;">
		¡<?= Yii::t("global","Gracias por reservar con Lomas Travel");?>!
	</div>
	
	<div class="clear" style="padding: 15px;"></div>
	
	<div class="bloque" style="width: 640px; text-align: right; color: #6f6f6f; float: left;font-size:1rem;">
		<!--<?= Yii::t("global","La información acerca de tu reservación ha sido enviada al correo"); ?>: <strong><?= $cliente["cliente_email"]; ?></strong>
		<br />
		ID de Compra <strong style="color: #017eb6;"><?= $vv_Venta; ?></strong>		
		-->
        <?= Yii::t("global","Su transacci&oacute;n ha finalizado, en breve recibir&aacute; un correo electr&oacute;nico con los detalles de su compra")?>. <!--Puede acceder a su cuenta, www.paypal.com/mx, para ver los detalles de esta transacci&oacute;n-->
	</div>
	</div>
	
	<div class="bloque" style="width: 300px; text-align: center; float: right; padding-top: 20px; padding-bottom:20px;">
		<form method="get" action="/es">
			
			<input type="submit" style="font-size: 20pt; padding: 10px 15px; background-color:#00aaa6; color: #FFF;" class="btnBlueSelectRoom" value="<?= Yii::t("global","Continuar")?>">
		</form>
	</div>

</div>



<?php if(intval($total) != 0){ ?>
<iframe src="http://4344202.fls.doubleclick.net/activityi;src=4344202;type=sales180;cat=mx_lo610;qty=1;cost=<?= $total; ?>;u6=[hotel];u1=lomastravel.com;u3=[categoria];u2=[servicio];u5=[destino];u4=[salida];ord=<?= $vv_Venta; ?>?" width="1" height="1" frameborder="0" style="display:none"></iframe>

<?php } ?>


<?php
// Transaction Data
$tipo_producto = array("","Hotel","Tour","Transfer","Servicio extra");
foreach ($_Productos as $_p) {
	// List of Items Purchased.
	$items[] =array("sku"=>$_p->descripcion_id, "name"=>str_replace("'"," ",$_p->descripcion_producto), "category"=> $tipo_producto[$_p->descripcion_tipo_producto], "price"=>$_p->descripcion_total, "quantity"=>"1");
}
$trans = array("id"=>$vv_Venta, "affiliation"=>"Lomas Travel COM", "revenue"=> $total, "shipping"=>"0", "tax"=>"0");


?>
<?php
// Function to return the JavaScript representation of a TransactionData object.
function getTransactionJs(&$trans) {
  return <<<HTML
ga('ecommerce:addTransaction', {
  'id': '{$trans['id']}',
  'affiliation': '{$trans['affiliation']}',
  'revenue': '{$trans['revenue']}',
  'shipping': '{$trans['shipping']}',
  'tax': '{$trans['tax']}'
});
HTML;
}

// Function to return the JavaScript representation of an ItemData object.
function getItemJs(&$transId, &$item) {
  return <<<HTML
ga('ecommerce:addItem', {
  'id': '$transId',
  'name': '{$item['name']}',
  'sku': '{$item['sku']}',
  'category': '{$item['category']}',
  'price': '{$item['price']}',
  'quantity': '{$item['quantity']}'
});
HTML;
}
?>

<!-- Begin HTML -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-49567664-2', 'auto');
ga('require', 'ecommerce');

<?php
echo getTransactionJs($trans);

foreach ($items as &$item) {
  echo getItemJs($trans['id'], $item);
}
?>

ga('ecommerce:send');
</script>
