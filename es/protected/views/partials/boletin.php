<style>
	@import url(http://fonts.googleapis.com/css?family=Roboto:300);
</style>

<div id="newsletterMail" style="width:800px; text-align:center; margin:20px auto;">
	
	<div style="background:black">
		<img style="position: relative;width: 300px;" src="<?=Yii::app()->params['baseUrl']?>/images/icon/MexicoNewsTravel.png" alt="LomasTravel" />
	</div>

	<div style="padding:0; margin:0;">
		<p style="font-family: 'Roboto', sans-serif; font-size:42px; color:#717073">Gracias <?=$_REQUEST['name']?> por suscribirse a nuestro bolet&iacute;n.<br/>
			<span style="font-family: 'Roboto', sans-serif; font-size:30px; color:#717073; line-height:40px;">Pronto recibir&aacute; nuestras mejores promociones.</span>
		</p>
	</div>

	<div style="padding:0; margin:0;">
		<img src="http://www.lomastravel.com.mx/img/mails/boletin.jpg" alt="LomasTravel" width="800" />
	</div>

</div>