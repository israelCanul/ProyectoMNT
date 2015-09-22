<?php 
	date_default_timezone_set('America/Cancun');
	$checkIn=date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 2,date("Y")));
	$checkOut=date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 5,date("Y"))); 
?>

<script type="text/javascript">
	var HotelsData=<?= file_get_contents(Yii::app()->params["baseUrl"]."/destinations/destinations"); ?>;
	var ToursData=<?= file_get_contents(Yii::app()->params["baseUrl"]."/activities/destinations"); ?>;
	var fecha="<?=date('Y,m,d', strtotime('+2 day'))?>";
</script>
<script type="text/javascript" src="<?php echo Yii::app()->params["baseUrl"]; ?>/js/bookin-box.js"></script>
<link type="text/css" rel="stylesheet" href="/css/page/booking.min.css"  media="screen,projection"/>

			<div class="col s12"><center><label>Reserve your vacation in mexico</label></center></div>
			<div class="col s12 m10 offset-m1 grey lighten-3 bookin">
			  <div class="row">
			    <div class="col s12 m8 offset-m2 grey lighten-3">
			      <ul class="tabs">
			        <li class="tab col s12 m3"><a href="#test1">Flights</a></li>
					  <li class="tab col s12 m3"><a href="#testPack">Packages</a></li>
			        <li class="tab col s12 m3"><a class="active" href="#test2">Hotel</a></li>
			        <li class="tab col s12 m3"><a href="#test3">Activities</a></li>
			        <li class="tab col s12 m3"><a href="#test4">Transportation</a></li>
			      </ul>
			    </div>
				  <div id="testPack" class="col s12">
					  <form class="col s12">
						  <div class="row">
							  <div class="input-field col s12 m6 l2">
								  <select name="form-fly" value='<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["to-fly"])?>' id="form-fly">
									  <option value="" selected="selected">Arriving to</option>
									  <option value="CZM">Cozumel, Mx</option>
									  <option value="MID">Merida, Mx</option>
									  <option value="VER">Veracruz, Mx</option>
									  <option value="VSA">Villahermosa</option>
								  </select>
								  <label >Departing from</label>
							  </div>
							  <div class="input-field col s12 m6 l2">
								  <select name="to-fly" value='<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["to-fly"])?>' id="to-fly">
									  <option value="" selected="selected">Arriving to</option>
									  <option value="CZM">Cozumel, Mx</option>
									  <option value="MID">Merida, Mx</option>
									  <option value="VER">Veracruz, Mx</option>
									  <option value="VSA">Villahermosa</option>
								  </select>
								  <label for="to-fly" data-error="wrong" data-success="right">Arriving to</label>
							  </div>
							  <div class="input-field col s12 m3 l2">
								  <input required="required" type="date" name="flyCheckin" id="flyCheckin" class="datepicker" >
								  <label for="flyCheckin">Departure Date</label>
							  </div>
							  <div class="input-field col s12 m3 l2">
								  <input required="required" type="date" name="flyCheckout" id="flyCheckout" class="datepicker" >
								  <label for="flyCheckout">Return Date</label>
							  </div>
							  <div class="input-field col s12 m3 l1">
								  <input required type="number" min="0" name="flyAdult" id="flyAdult" >
								  <label for="flyAdult">Adult(s)</label>
							  </div>
							  <div class="input-field col s12 m3 l1">
								  <input required type="number" min="0" name="flyChild" id="flyChild" >
								  <label for="flyChild">Children</label>
							  </div>
							  <div class="input-field col s12 m3 l3">
								  <input name="tipoViaje" checked="checked" type="radio" id="tipoRedondo" />
								  <label for="tipoRedondo">Round trip</label>
							  </div>
							  <div class="input-field col s12 m3 l3">
								  <input name="tipoViaje" type="radio" id="tipoSencillo" />
								  <label for="tipoSencillo">One way</label>
							  </div>
							  <div class="input-field col s12 m4 offset-m1 l3">
								  <button class="btn waves-effect waves-light red" type="submit" name="action">Search
									  <i class="material-icons">search</i>
								  </button>
							  </div>
						  </div>
					  </form>
				  </div>
			    <div id="test1" class="col s12">
			    	<form class="col s12">
			    		<div class="row">
			    			<div class="input-field col s12 m6 l2">
					          	<select name="form-fly" value='<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["to-fly"])?>' id="form-fly">
	                                <option value="" selected="selected">Arriving to</option>
	                                <option value="CZM">Cozumel, Mx</option>
	                                <option value="MID">Merida, Mx</option>
	                                <option value="VER">Veracruz, Mx</option>
	                                <option value="VSA">Villahermosa</option>
								</select>					          
					          	<label >Departing from</label>
					        </div>
			    			<div class="input-field col s12 m6 l2">
					          	<select name="to-fly" value='<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["to-fly"])?>' id="to-fly">
	                                <option value="" selected="selected">Arriving to</option>
	                                <option value="CZM">Cozumel, Mx</option>
	                                <option value="MID">Merida, Mx</option>
	                                <option value="VER">Veracruz, Mx</option>
	                                <option value="VSA">Villahermosa</option>
								</select>
					          <label for="to-fly" data-error="wrong" data-success="right">Arriving to</label>
					        </div>					        
			    			<div class="input-field col s12 m3 l2">
					          <input required="required" type="date" name="flyCheckin" id="flyCheckin" class="datepicker" >
					          <label for="flyCheckin">Departure Date</label>
					        </div>
			    			<div class="input-field col s12 m3 l2">
					          <input required="required" type="date" name="flyCheckout" id="flyCheckout" class="datepicker" >
					          <label for="flyCheckout">Return Date</label>
					        </div>
			    			<div class="input-field col s12 m3 l1">
					          <input required type="number" min="0" name="flyAdult" id="flyAdult" >
					          <label for="flyAdult">Adult(s)</label>
					        </div>
			    			<div class="input-field col s12 m3 l1">
					          <input required type="number" min="0" name="flyChild" id="flyChild" >
					          <label for="flyChild">Children</label>
					        </div>
			    			<div class="input-field col s12 m3 l3">
							      <input name="tipoViaje" checked="checked" type="radio" id="tipoRedondo" />
							      <label for="tipoRedondo">Round trip</label>
					        </div>
			    			<div class="input-field col s12 m3 l3">
							      <input name="tipoViaje" type="radio" id="tipoSencillo" />
							      <label for="tipoSencillo">One way</label>
					        </div>
			    			<div class="input-field col s12 m4 offset-m1 l3">		        					        
								<button class="btn waves-effect waves-light red" type="submit" name="action">Search
								   <i class="material-icons">search</i>
								</button>
					        </div>				        				        				        				        				        				        
			    		</div>
			    	</form>
			    </div>
			    <div id="test2" class="col s12">
			    	<div class="row"></div>
			    	<form class="col s12" action="/destinations/buscar">
							<input class="" type="hidden" name="hotel_keyword" id="hotel_keyword" value="<?=$_REQUEST["hotel"]; ?>"/>
							<input class="" type="hidden" name="cCode" id="cCode" value="<?=$_REQUEST["cCode"]; ?>"/>
							<input class="" type="hidden" name="HotelId" id="HotelId" value="<?=$_REQUEST["HotelId"]; ?>"/>			    	
				    		<div class="row">
				    			<div class="input-field col s12 m6 l3">
						          <input required type="text" autocomplete="off" name="hotel_destination" value="<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["hotel_destination"]) ; ?>" id="hotel_destination" class="validate">
					          <label for="hotel_destination" class="active" >Destination/Hotel</label>
					        </div>
			    			<div class="input-field col s12 m3 l2">
					          <input required="required" value="<?=date('m/d/Y', strtotime('+2 day'))?>"  type="date" name="hotelCheckin" id="hotelCheckin" class="datepicker-hotel" >
					          <label for="hotelCheckin" class="active">Check-In *</label>
					        </div>
			    			<div class="input-field col s12 m3 l2">
					          <input required="required" value="<?=date('m/d/Y', strtotime('+5 day'))?>" type="date" name="hotelCheckout" id="hotelCheckout" class="datepicker-hotel" >
					          <label for="hotelCheckout" class="active" >Check-Out *</label>
					        </div>
			    			<div class="input-field col s12 m3 l1">
					         	<select name="hotelRoom" value='1' id="hotelRoom">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>									
								</select>					          
					          <label >Rooms</label>
					        </div>
			    			<div class="input-field col s12 m3 l1">
					          <input required type="number" min="1" value="2" name="hotelAdults_0" id="hotelAdults"  >
					          <label for="hotelAdults">Adult(s)</label>
					        </div>
			    			<div class="input-field col s12 m3 l1">
					          <select required type="number" min="0" data-hab="0" class="age_nino hotelChild_0" value="0" name="hotelChild_0" id="hotelChild" >
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
							  </select>								          
					          <label >Children</label>
					        </div>
					        <div class="row"><br></div>
					        <div class="col s12 guesthab" id="guesthab">
					        	
					        </div>
					        <div class="col s12 " id="dataChild1">
					        	
					        </div>
					        <div class="col s12 " id="dataChild">
					        	
					        </div>
					        <div class="input-field col s12">
								<center><button class="btn waves-effect waves-light red" type="submit" name="action">Search
								   <i class="material-icons">search</i>
								</button></center>
					        </div>					        				        				        				        				        				        				        
			    		</div>
			    		<script type="text/javascript">
							var hab_var_name="Room";
							var menor_var_name="Children ages";
						</script>
			    	</form>
			    </div>
			    <div id="test3" class="col s12" >
					<div class="row">
						<div class="input-field col s12 m6 l3">
							<input required type="text" autocomplete="off" name="hotel_destination" value="<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["hotel_destination"]) ; ?>" id="tour_destination" class="validate">
							<label for="tour_destination">Type of Transfer</label>
							<input class="" type="hidden" name="dest" id="dest" value="<?=$_REQUEST["dest"]; ?>"/>
							<input class="" type="hidden" name="TourId" id="TourId" value="<?=$_REQUEST["TourId"]; ?>"/>
							<input class="" type="hidden" name="ProveedorId" id="ProveedorId" value="<?=$_REQUEST["ProveedorId"]; ?>"/>
							<input class="" type="hidden" name="openTk" id="openTk" value="<?= (($openTk != 1) ? 0 : 1); ?>"/>
						</div>
						<div class="input-field col s12 m6 l3">
							<select name="AirportCode" id="AirportCode">
								<option value="1:1">Cancun Airport (CUN)</option>
								<option value="361:11">Cozumel Airport (CZM)</option>
							</select>
							<label for="AirportCode">Airport</label>
						</div>
						<div class="input-field col s12 m3 l2">
							<input required="required" value="<?=date('m/d/Y', strtotime('+2 day'))?>"  type="date" name="trans-Checkin" id="trans-Checkin" class="datepicker" >
							<label for="trans-Checkin">Check-In *</label>
						</div>
						<div class="input-field col s12 m4 l2">
							<input required type="number" min="0" name="flyAdult" id="flyAdult" >
							<label for="flyAdult">Adult(s)</label>
						</div>
						<div class="input-field col s12 m4 l2">
							<input required type="number" min="0" name="flyChild" id="flyChild" >
							<label for="flyChild">Children</label>
						</div>
						<div class="input-field col s12 m4 l2">
							<button class="btn waves-effect waves-light red" type="submit" name="action">Search
								<i class="material-icons">search</i>
							</button>
						</div>
					</div>
				</div>
			    <div id="test4" class="col s12">
			    		<div class="row">
			    			<div class="input-field col s12 m6 l3">
								<select name="transfer_option_type" id="transfer_option_type">
									<option value="1">Round Trip</option>
									<option value="2">Airport →Hotel</option>
									<option value="3">Hotel →Airport</option>
									<option value="4">Hotel →Hotel ( One Way ) </option>
									<option value="5">Hotel →Hotel ( Round Trip )</option>
								</select>
					          	<label>Type of Transfer</label>
					        </div>
   			    			<div class="input-field col s12 m6 l3">
								<select name="AirportCode" id="AirportCode">							
									<option value="1:1">Cancun Airport (CUN)</option>
									<option value="361:11">Cozumel Airport (CZM)</option>
								</select>
					            <label for="AirportCode">Airport</label>
					        </div>
			    			<div class="input-field col s12 m3 l2">
					          <input required="required" value="<?=date('m/d/Y', strtotime('+2 day'))?>"  type="date" name="trans-Checkin" id="trans-Checkin" class="datepicker" >
					          <label for="trans-Checkin">Check-In *</label>
					        </div>
			    			<div class="input-field col s12 m3 l2">
					          <input required="required" value="<?=date('m/d/Y', strtotime('+2 day'))?>" type="date" name="trans-Checkout" id="trans-Checkout" class="datepicker" >
					          <label for="trans-Checkout">Check-Out *</label>
					        </div>					        
			    			<div class="input-field col s12 m4 l2">
					          <input required type="number" min="0" name="flyAdult" id="flyAdult" >
					          <label for="flyAdult">Adult(s)</label>
					        </div>
			    			<div class="input-field col s12 m4 l2">
					          <input required type="number" min="0" name="flyChild" id="flyChild" >
					          <label for="flyChild">Children</label>
					        </div>
			    			<div class="input-field col s12 m4 l2">		        					        
								<button class="btn waves-effect waves-light red" type="submit" name="action">Search
								   <i class="material-icons">search</i>
								</button>
					        </div>				        				        				        				        				        				        
			    		</div>	
			    </div>
			  </div>
			</div>
		


	