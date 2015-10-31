<!-- modal de suscribe -->
<div id="contac_us" class="inActiveM modales">
	<div class="row">
		<div class="col s12 m8 offset-m2 " style="">
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
			 	<img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg">
			</div>
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
				<!-- <ul class="menuLogoItems">
					<li><a class="followBtn" data-open='follow'>FOLLOW US</a></li>
					<li><a class="followBtn" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" style="border-bottom: 2px solid white;" data-open='suscribe'>SUSCRIBE</a></li>
				</ul> -->	
			</div>
			<div class="col s12"><i style='float:right;font-size:50px;' data-close='contac_us' class="material-icons cerrar-close white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close">close</i></div>
		</div>
	</div>
	<div class="panel-modal transparent"> 
		<div class="row">
			<div class="col s12">
			<h5 class="white-text center-align">Contact Form</h5>
			<div class="row"></div>
				<form method="post" id="form_contact" action="<? $this->createUrl('site/contact'); ?>" >
					<div class="row">						
					        <div class="row">
					        	<h6 class="white-text">Interested In</h6>
						        <div class=" col s12 m6">
						       		<input type="radio" checked required='required' value="Webmaster" id="interested0" name="cboDepartamento" class="validate"/>
						       		<label for="interested0" class="white-text">Webmaster (Comments and suggestions about the website)</label>					        	
						        </div>
						        <div class=" col s12 m6">
						       		<input type="radio" value="Sales" required='required' id="interested1" name="cboDepartamento" class="validate"/>
						       		<label for="interested1" class="white-text">Reservations (Price Request)</label>					        	
						        </div>
					        </div>
					        <div class="input-field col s12">
					        	 <i class="material-icons prefix white-text">account_circle</i>
					         	<input required='required' id="name" type="text" name="name" class="validate" style="background-color: white;color:black;">
					         	<label for="name" class="label-activo">Name</label>
					        </div>
							<div class="input-field col s12">
					          	<i class="material-icons prefix white-text">phone</i>
					          	<input required='required' id="telephone" name="phone" type="text" class="validate" style="background-color: white;color:black;">
					          	<label for="telephone" class="label-activo">Telephone</label>
					        </div>
							<div class="input-field col s12">
					         	<i class="material-icons prefix white-text">email</i>
					         	<input required='required' id="email" name="email" type="text" class="validate" style="background-color: white;color:black;">
					         	<label for="email" class="label-activo">Email</label>
					        </div>
					        <div class="input-field col s12">
					         	<i class="material-icons prefix white-text">flag</i>
					         	<input required='required' id="country" name="country" type="text" class="validate" style="background-color: white;color:black;">
					         	<label for="country" class="label-activo">Country</label>
					        </div>					
							<div class="input-field col s12">
						       	 <i class="material-icons prefix white-text">receipt</i>	
						         <textarea required='required' id="text_area" name="message" class="materialize-textarea" style="background-color: white;color:black;"></textarea>
						         <label for="text_area" class="label-activo">Message</label>
					        </div>

						<div class="col s12  white-text medium">
						  <button style="float:right" class="btn waves-effect waves-light" type="submit" name="action">Submit
						    <i class="material-icons">send</i>
						  </button>											
						</div>
					</div>
				</form>				
			</div>
		</div> 
	</div>	
</div>