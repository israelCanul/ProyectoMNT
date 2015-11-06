<style>
	@import url(http://fonts.googleapis.com/css?family=Roboto:300);
	td{background: #eee;}
	strong{font-family: 'Roboto', sans-serif;}
	.tdMail{color:#717073; font-weight: lighter; font-family: 'Roboto', sans-serif;}
</style>

<div id="contactMail" style="width:800px; text-align:center; margin:20px auto;">
	
	<div style="padding:0; margin:0;">
		<img src="http://www.lomastravel.com/img/mails/headerContact.jpg" alt="Lomas Travel" width="800" />
	</div>

	<div style="padding:0; margin:0;">
		<table border="0" cellspacing="10" cellpadding="20" style="width:800px; ">
			<tr class="row">
				<td width="50%"><strong>Nombre: </strong><span class="tdMail"><?php echo ucwords($_POST['name']); ?></span></td>
				<td width="50%"><strong>Correo: </strong><span class="tdMail"><?php echo $_POST['email']; ?></span></td>
			</tr>
			<tr class="row">
				<td width="50%"><strong>Teléfono: </strong><span class="tdMail"><?php echo $_REQUEST['phone']; ?></span></td>
				<td width="50%"><strong>País: </strong><span class="tdMail"><?php echo $_REQUEST['country']; ?></span></td>
			</tr>
			<tr class="row">
				<td rowspan="5" colspan="2"  style="text-align:justify;">
					<strong>Comentarios: </strong><span class="tdMail"><?php echo $_REQUEST['message']; ?></span>
				</td>
			</tr>
		</table>
	</div>
	<div style="padding:0; margin:0;">
		<img src="http://www.lomastravel.com/img/mails/footerContact2.jpg" alt="Lomas Travel" width="800" />
	</div>
</div> 