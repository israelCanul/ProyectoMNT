<!-- modal de follow -->
<div id="follow" class="inActiveM modales">
	<div class="row">
		<div class="col s12 m8 offset-m2 " style="">
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
			 	<img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/MexicoNewsTravel.png">
			</div>
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
				<ul class="menuLogoItems">
					<li><a class="followBtn" style="border-bottom: 2px solid white;" data-open='follow'>SÍGANOS</a></li>
					<li><a class="followBtn" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" data-open='suscribe'>SUSCRIBASE</a></li>
				</ul>	
			</div>
			<div class="col s12"><i style='float:right;font-size:50px;' data-close='follow' class="material-icons cerrar-close white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close">close</i></div>
		</div>
	</div>
	<div class="panel-modal transparent">
		<div class="row">
			<div class="col s12">
			<h5 class="white-text center-align">SÍGANOS. ESTAMOS EN TODAS PARTES</h5>
			<div class="row"></div>
				<div class="row">
					<div class="col s8 offset-4 m2 white-text medium">
						<div class="responsive-img" src="" id="iconF"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconT"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconG"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconP"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconS"></div>
					</div>
					<div class="col s8 offset-2 m2 white-text medium">
						<div class="responsive-img" src="" id="iconB"></div>
					</div>					
				</div>				
			</div>
		</div> 
	</div>	
</div>
<!-- modal de search -->
<div id="search" class="inActiveM modales">
	<div class="row">
		<div class="col s12 m8 offset-m2 " style="">
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
			 	<img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg">
			</div>
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
				<ul class="menuLogoItems">
					<li><a class="followBtn" data-open='follow'>SÍGANOS</a></li>
					<li><a class="followBtn" style="border-bottom: 2px solid white;" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" data-open='suscribe'>SUSCRIBASE</a></li>
				</ul>	
			</div>
			<div class="col s12"><i style='float:right;font-size:50px;' data-close='search' class="material-icons cerrar-close white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close">close</i></div>
		</div>
	</div>	
	<div class="panel-modal transparent">
		<div class="row">
			<div class="col s12">
			<h5 class="white-text">Buscar</h5>
				  <nav>
				    <div class="nav-wrapper">
				      <form action="<?=$this->createUrl('site/buscar')?>" method='post'>
				        <div class="input-field" style="">
				          <input id="input_search" type="search" name="word_search" style="border-bottom: 2px solid white;"  required>
				          <label for="input_search"><i class="material-icons red-text">search</i></label>
				        </div>
				      </form>
				    </div>
				  </nav>
			</div>
		</div> 
	</div>	
</div>
<!-- modal de suscribe -->
<div id="suscribe" class="inActiveM modales">
	<div class="row">
		<div class="col s12 m8 offset-m2 " style="">
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
			 	<img class="imgLogo " src="<?=Yii::app()->params['baseUrl']?>/images/icon/logo.svg">
			</div>
			<div class="col s12 m6 menuLogo hide-on-med-and-down">
				<ul class="menuLogoItems">
					<li><a class="followBtn" data-open='follow'>SÍGANOS</a></li>
					<li><a class="followBtn" data-open='search'><i style="height:30px;" class="material-icons white-text">search</i></a></li>
					<li><a class="followBtn" style="border-bottom: 2px solid white;" data-open='suscribe'>SUSCRIBASE</a></li>
				</ul>	
			</div>
			<div class="col s12"><i style='float:right;font-size:50px;' data-close='suscribe' class="material-icons cerrar-close white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Close">close</i></div>
		</div>
	</div>
	<div class="panel-modal transparent">
		<div class="row">
			<div class="col s12">
			<h5 class="white-text center-align">SÍGANOS. ESTAMOS EN TODAS PARTES</h5>
			<div class="row"></div>
				<form method='post' id='submitSubcriptionOutlet'>
					<div class="row">
						<div class="col s12  white-text medium">
					       <div class="input-field col s12">
					         <i class="material-icons prefix white-text">account_circle</i>
					         <input id="name_suscribe" type="text" name='name_suscribe' required>
					         <label for="name_suscribe white-text" class="label-activo">Nombre</label>
					       </div>
						</div>
						<div class="col s12  white-text medium">
					       <div class="input-field col s12">
					         <i class="material-icons prefix white-text">email</i>
					         <input id="email_suscribe" type="text" name='email_suscribe' required>
					         <label for="email_suscribe white-text" class="label-activo">Correo</label>
					       </div>
						</div>
						<div class="col s12  white-text medium">
					       <div class="input-field col s12">
					         <i class="material-icons prefix white-text">flag</i>
					         <input id="country_suscribe" type="text" name='country_suscribe' required>
					         <label for="country_suscribe white-text" class="label-activo">País</label>
					       </div>
						</div>
						<div class="col s12  white-text medium">
					       <div class="input-field col s12">
					         <i class="material-icons prefix white-text">location_city</i>
					         <input id="city_suscribe" type="text" name='city_suscribe' required>
					         <label for="city_suscribe white-text" class="label-activo">Ciudad</label>
					       </div>
						</div>
						<div class="col s12  white-text medium">
						  <button id="submit_suscribe" style="float:right" class="btn waves-effect waves-light" name="action">Enviar
						    <i class="material-icons">send</i>
						  </button>											
						</div>
											
					</div>
				</form>					
			</div>
		</div> 
	</div>	
</div>