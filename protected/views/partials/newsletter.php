<style>
	@import url(http://fonts.googleapis.com/css?family=Roboto:300);
</style>

<div id="newsletterMail" style="width:800px; text-align:center; margin:20px auto;">	
	<div style="background:black">
		<img style="position: relative;width: 300px;" src="<?=Yii::app()->params['baseUrl']?>/images/icon/MexicoNewsTravel.png" alt="LomasTravel" />
	</div>

	<div style="padding:0; margin:0;">
		<p style="font-family: 'Roboto', sans-serif; font-size:42px; color:#717073">Thank you <?=$_REQUEST['name']?> for subscribing.<br/>
			<span style="font-family: 'Roboto', sans-serif; font-size:30px; color:#717073; line-height:40px;">Soon you will receive our best deals.</span>
		</p>
	</div>

	<div style="padding:0; margin:0;">
		<img src="http://www.lomastravel.com/img/mails/newsletter.jpg" alt="LomasTravel" width="800" />
	</div>
</div>