<?php
	date_default_timezone_set('America/Cancun');
	$checkIn=date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 2,date("Y")));
	$checkOut=date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 5,date("Y")));
?>

<script type="text/javascript">
	var HotelsData=<?= file_get_contents(Yii::app()->params["baseUrl"]."/destinations/destinations"); ?>;
	var ToursData=<?= file_get_contents("http://apilomas.dev/restTours/destinations?lan=en"); ?>;
	var fecha="<?=date('Y,m,d', strtotime('+2 day'))?>";
</script>
<script type="text/javascript" src="<?php echo Yii::app()->params["baseUrl"]; ?>/js/bookin-box.js"></script>
<link type="text/css" rel="stylesheet" href="/css/page/booking.min.css"  media="screen,projection"/>

			<div class="col s12"><center><label>Reserve your vacation in mexico</label></center></div>
			<div class="col s12 m10  offset-m1 grey lighten-3 bookin">
			  <div class="row ">
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
                </div>
                <div id="testPack" class="col s12 tab_contenido">
					  <form class="col s12">
						  <div class="row">

						  </div>
					  </form>
				</div>
			    <div id="test1" class="col s12 tab_contenido">
			    	<form class="col s12">
			    		<div class="row">

			    		</div>
			    	</form>
			    </div>
				 <!-- hoteles -->
			    <div id="test2" class="col s12 tab_contenido">

			    	<form class="col s12" action="/destinations/buscar"><div class="row">
							<input class="" type="hidden" name="hotel_keyword" id="hotel_keyword" value="<?=$_REQUEST["hotel"]; ?>"/>
							<input class="" type="hidden" name="cCode" id="cCode" value="<?=$_REQUEST["cCode"]; ?>"/>
							<input class="" type="hidden" name="HotelId" id="HotelId" value="<?=$_REQUEST["HotelId"]; ?>"/>
				    		<div class="input-field col s12 m6 l3">
						       	<input required type="text" autocomplete="off" name="hotel_destination" value="<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["hotel_destination"]) ; ?>" id="hotel_destination" class="validate">
					        	<label for="hotel_destination" class="active" >Destination/Hotel</label>
							</div>
					        <div class="input-field col s12 m3 l3">
					          <input required="required" value="<?=date('m/d/Y', strtotime('+2 day'))?>"  type="date" name="hotelCheckin" id="hotelCheckin" class="datepicker-hotel" >
					          <label for="hotelCheckin" class="active">Check-In *</label>
					        </div>
			    			<div class="input-field col s12 m3 l3">
					          <input required="required" value="<?=date('m/d/Y', strtotime('+5 day'))?>" type="date" name="hotelCheckout" id="hotelCheckout" class="datepicker-hotel" >
					          <label for="hotelCheckout" class="active" >Check-Out *</label>
					        </div>
			    			<div class="input-field col s12 m4 l1">
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
			    			<div class="input-field col s12 m4 l1">
					          <input required type="number" min="1" value="2" name="hotelAdults_0" id="hotelAdults"  >
					          <label for="hotelAdults">Adult(s)</label>
					        </div>
			    			<div class="input-field col s12 m4 l1">
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

					        <div class="col s12 guesthab" id="guesthab">

					        </div>
					        <div class="col s12 " id="dataChild1">

					        </div>
					        <div class="col s12 " id="dataChild">

					        </div>
					        <div class="input-field col s12">
                                <center>
								<button class="btn waves-effect waves-light red" type="submit" name="action">Search
								   <i class="material-icons">search</i>
								</button>
                                </center>
					        </div>

			    		<script type="text/javascript">
							var hab_var_name="Room";
							var menor_var_name="Children ages";
						</script>
					</div></form>

			    </div>

				 <!-- Tours -->
			    <div id="test3" class="col s12 tab_contenido" >
						<div class="row">
						<form class="col s12" action="/activities/BuscarTours">
							<div class="input-field col s12 m6 l4">
								<input required type="text" autocomplete="off" name="tour_destination" value="<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["tour_destination"]) ; ?>" id="tour_destination" class="validate">
								<label for="tour_destination">Tour</label>
								<input type="hidden" name="tipo" id="tipo" value="<?=$_REQUEST["tipo"]; ?>">
								<input class="" type="hidden" name="cat" id="cat" value="<?=$_REQUEST["cat"]; ?>"/>
								<input class="" type="hidden" name="dest" id="dest" value="<?=$_REQUEST["dest"]; ?>"/>
								<input class="" type="hidden" name="TourId" id="TourId" value="<?=$_REQUEST["TourId"]; ?>"/>
								<input class="" type="hidden" name="sup" id="sup" value="<?=$_REQUEST["sup"]; ?>"/>
								<input class="" type="hidden" name="clave" id="clave" value="<?=$_REQUEST["clave"]; ?>"/>
								<input class="" type="hidden" name="openTk" id="openTk" value="<?= (($openTk != 1) ? 0 : 1); ?>"/>
								<input class="" type="hidden" name="seg" id="seg" value="<?=$_REQUEST["seg"]; ?>"/>
							</div>
							<div class="input-field col s12 m6 l2">
								<input required="required" value="<?=date('m/d/Y', strtotime('+2 day'))?>"  type="date" name="tour-Checkin" id="tour-Checkin" class="datepicker" >
								<label for="tour-Checkin" class="active">Date *</label>
							</div>
							<div class="input-field col s12 m6 l2">
								<select name="tour_adults" id="tour_adults">
									<?php if($selectAdulto["status"]  == 1 ){ ?>
										<?php echo Yii::app()->GenericFunctions->makeComboInt($selectAdulto["min"],$selectAdulto["max"],intval(($selectAdulto["min"] <= $_REQUEST["tour_adults"] && $selectAdulto["max"] >= $_REQUEST["tour_adults"] )?$_REQUEST["tour_adults"]:$selectAdulto["default"])); ?>
									<?php }else{ ?>
										<?php echo Yii::app()->GenericFunctions->makeComboInt(1,50,intval(($_REQUEST["tour_adults"]!="")?$_REQUEST["tour_adults"]:"2"));?>
									<?php } ?>
								</select>
								<label for="tour_adults">Adults</label>
							</div>
							<div class="input-field col s12 m6 l2">
								<select name="tour_child" id="tour_child">
									<?php echo Yii::app()->GenericFunctions->makeComboInt(0,10,intval($_REQUEST["tour_childs"])); ?>
								</select>
								<label for="tour_child">Children</label>
							</div>

							<div class="input-field col s12 m12 l2">
								<button class="btn waves-effect waves-light red" type="submit" name="action">Search
									<i class="material-icons">search</i>
								</button>
							</div>
							<div class="row"><br></div>
						</form>
						</div>
				</div>
			    <div id="test4" class="col s12 tab_contenido">
			    		<div class="row">
							<input class="" type="hidden" name="hotel_keyword" id="hotel_keyword" value="<?=$_REQUEST["hotel"]; ?>"/>
							<input class="" type="hidden" name="cCode" id="cCode" value="<?=$_REQUEST["cCode"]; ?>"/>
							<input class="" type="hidden" name="HotelId" id="HotelId" value="<?=$_REQUEST["HotelId"]; ?>"/>
							<div class="input-field col s12 m6 l3">
								<input required type="text" autocomplete="off" name="hotel_destination" value="<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["hotel_destination"]) ; ?>" id="hotel_destination" class="validate">
								<label for="hotel_destination" class="active" >Destination/Hotel</label>
							</div>
							<div class="input-field col s12 m6 l3">
								<input required type="text" autocomplete="off" name="hotel_destination" value="<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["hotel_destination"]) ; ?>" id="hotel_destination" class="validate">
								<label for="hotel_destination" class="active" >Destination/Hotel</label>
							</div>
							<div class="input-field col s12 m3 l3">
								<input required="required" value="<?=date('m/d/Y', strtotime('+2 day'))?>"  type="date" name="hotelCheckin" id="hotelCheckin" class="datepicker-hotel" >
								<label for="hotelCheckin" class="active">Check-In *</label>
							</div>
							<div class="input-field col s12 m3 l3">
								<input required="required" value="<?=date('m/d/Y', strtotime('+5 day'))?>" type="date" name="hotelCheckout" id="hotelCheckout" class="datepicker-hotel" >
								<label for="hotelCheckout" class="active" >Check-Out *</label>
							</div>
			    		</div>
			    </div>
			  </div>
			</div>



