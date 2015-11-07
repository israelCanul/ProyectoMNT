<?php
	date_default_timezone_set('America/Cancun');
	$checkIn=date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 2,date("Y")));
	$checkOut=date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 5,date("Y")));
?>

<script type="text/javascript">
	var HotelsData=<?=file_get_contents(Yii::app()->params["baseUrl"]."destinations/destinations.html")?>;
	var ToursData=<?=file_get_contents(Yii::app()->params['api']."/restTours/destinations?lan=en"); ?>;
	var transferData=<?=file_get_contents(Yii::app()->params['api']."/RestTransfers/destinations.html?lan=en");?>;
	//var transferDataCun=<? //file_get_contents("http://apilomas.dev/RestTransfers/destinationsOptions.html?h=0&a=1:1&lan=en");?>;
	//var transferDataCoz=<? //file_get_contents("http://apilomas.dev/RestTransfers/destinationsOptions.html?h=0&a=361:11&lan=en");?>;
	var fecha="<?=date('Y,m,d', strtotime('+2 day'))?>";
</script>
<script type="text/javascript" src="<?php echo Yii::app()->params["baseUrl"]; ?>/js/bookin-box.js"></script>
<link type="text/css" rel="stylesheet" href="/css/page/booking.min.css"  media="screen,projection"/>

			<div class="col s12"><center><label id="labelInBookin">Reserve sus vacaciones en México</label></center></div>
			<div class="col s12 m10  offset-m1 grey lighten-3 bookin">
			  <div class="row ">
                <div class="row">
			    <div class="col s12 m8 offset-m2 grey lighten-3">
			      <ul class="tabs">
			        <!-- <li class="tab col s12 m3 disabled "><a href="#test1"><span class="hide-on-med-and-down">Flights</span><i class="material-icons  wobble red-text zmdi-hc-2x hide-on-large-only">airplanemode_active</i></a></li>
					<li class="tab col s12 m3 disabled "><a href="#testPack"><span class="hide-on-med-and-down">Packages</span><i class="material-icons  tada red-text zmdi-hc-2x hide-on-large-only">shop_two</i></a></li> -->
			        <li class="tab col s12 m3"><a class="<?=$_REQUEST['hotel_act']?> <?=$_REQUEST['request']?>" href="#test2"><span class="hide-on-med-and-down">Hotel</span><i class="zmdi red-text zmdi-hotel  wobble red-text zmdi-hc-2x hide-on-large-only"></i></a></li>
			        <li class="tab col s12 m3"><a class="<?=$_REQUEST['tour_act']?>" href="#test3"><span class="hide-on-med-and-down">Actividades</span><i class="zmdi zmdi-directions-bike  red-text  tada zmdi-hc-2x hide-on-large-only"></i></a></li>
			        <li class="tab col s12 m3"><a class="<?=$_REQUEST['trans_act']?>" href="#test4"><span class="hide-on-med-and-down">Transportación</span><i class="zmdi zmdi-car-taxi  red-text wobble zmdi-hc-2x hide-on-large-only"></i></a></li>
			      </ul>
			    </div>
                </div>

				  <div class="row <? if($_REQUEST['request']==1 && isset($_REQUEST['request'])){ ?> oculta <? } ?>" id="contenedorBookin">

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

							<form class="col s12" action="/es/destinations/buscar" id="book_hotels" ><div class="row">
									<input class="" type="hidden" name="hotel_keyword" id="hotel_keyword" value="<?=$_REQUEST["hotel"]; ?>"/>
									<input class="" type="hidden" name="cCode" id="cCode" value="<?=$_REQUEST["cCode"]; ?>"/>
									<input class="" type="hidden" name="HotelId" id="HotelId" value="<?=$_REQUEST["HotelId"]; ?>"/>
									<div class="input-field col s12 m6 l3">
										<input required type="text" autocomplete="off" name="hotel_destination" value="<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["hotel_destination"]) ; ?>" id="hotel_destination" class="validate">
										<label for="hotel_destination" class="label-activo" >Destino/Hotel</label>
									</div>
									<div class="input-field col s12 m3 l3">
									  <input required="required" value="<?=$_REQUEST['hotelCheckin']?>"  type="date" name="hotelCheckin" id="hotelCheckin" class="datepicker-hotel" >
									  <label for="hotelCheckin" class="active">Check-In *</label>
									</div>
									<div class="input-field col s12 m3 l3">
									  <input required="required" value="<?=$_REQUEST['hotelCheckout']?>" type="date" name="hotelCheckout" id="hotelCheckout" class="datepicker-hotel" >
									  <label for="hotelCheckout" class="active" >Check-Out *</label>
									</div>
									<div class="input-field col s12 m4 l1">
										<select required name="hotelRoom" value='1' id="hotelRoom">
											<?php echo Yii::app()->GenericFunctions->makeComboInt(1,9,intval($_REQUEST["hotelRoom"])); ?>
										</select>
									  <label >Habitaciones</label>
									</div>
									<div class="input-field col s12 m4 l1">
									  <input required type="number" min="1" value="<?=$_REQUEST['hotelAdults_0']?>" name="hotelAdults_0" id="hotelAdults"  >
									  <label for="hotelAdults">Adulto(s)</label>
									</div>
									<div class="input-field col s12 m4 l1">
									  <select required type="number" min="0" data-hab="0" class="age_nino hotelChild_0" value="0" name="hotelChild_0" id="hotelChild" >
										  <?php echo Yii::app()->GenericFunctions->makeComboInt(0,9,intval($_REQUEST["hotelChild_0"])); ?>
									  </select>
									  <label >Niños</label>
									</div>

									<div class="col s12 guesthab" id="guesthab">

									</div>
									<div class="col s12 " id="dataChild1">

									</div>
									<div class="col s12 " id="dataChild">

									</div>
									<div class="input-field col s12">
										<center>
										<button class="btn waves-effect waves-light red" type="submit" name="action">Buscar
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
								<form class="col s12" action="/es/activities/BuscarTours" id="book_tours">
									<div class="input-field col s12 m6 l4">
										<input required="required" type="text" autocomplete="off" name="tour_destination" value="<?=Yii::app()->GenericFunctions->makeSinAcento($_REQUEST["tour_destination"]) ; ?>" id="tour_destination" class="validate">
										<label for="tour_destination" class="label-activo" >Tour</label>
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
										<input required="required" value="<?=$_REQUEST["tour-Checkin"]?>"  type="date" name="tour-Checkin" id="tour-Checkin" class="datepicker" >
										<label for="tour-Checkin" class="active">Fecha *</label>
									</div>
									<div class="input-field col s12 m6 l2">
										<select required="required" name="tour_adults" id="tour_adults">
												<?php echo Yii::app()->GenericFunctions->makeComboInt(0,50,intval($_REQUEST["tour_adults"]));?>
										</select>
										<label for="tour_adults">Adultos</label>
									</div>
									<div class="input-field col s12 m6 l2">
										<select required="required" name="tour_child" id="tour_child">
											<?php echo Yii::app()->GenericFunctions->makeComboInt(0,10,intval($_REQUEST["tour_child"])); ?>
										</select>
										<label for="tour_child">Niños</label>
									</div>

									<div class="input-field col s12 m12 l2">
										<button class="btn waves-effect waves-light red" type="submit" name="action">Buscar
											<i class="material-icons">search</i>
										</button>
									</div>
									<div class="row"><br></div>
								</form>
								</div>
						</div>
						<div id="test4" class="col s12 tab_contenido">
							<form id="book_tranfers"  action="/es/traslados/buscar" method="post">
								<div class="row">
									<input type="hidden" name="round_trip" id="round_trip" value="<?=$_REQUEST['round_trip']?>" />
									<input type="hidden" id="clave_ini" name="dest_from" value="<?=$_REQUEST['dest_from']?>">
									<input type="hidden" id="clave_transfer" name="clave_trans" value="<?=$_REQUEST['clave_trans']?>">
									<div class="input-field col s12 m12 l4">
										<select required="required" name="transfer_option_type" id="transfer_option_type">
											<option <?=((!isset($_REQUEST["transfer_option_type"]) || $_REQUEST["transfer_option_type"]==1) ? "selected='selected'": ""); ?> value="1">Redondo</option>
											<option <?=(($_REQUEST["transfer_option_type"]==2) ? "selected='selected'": ""); ?> value="2">Aeropuerto &rarr;Hotel</option>
											<option <?=(($_REQUEST["transfer_option_type"]==3) ? "selected='selected'": ""); ?> value="3">Hotel &rarr;Aeropuerto</option>
											<option <?=(($_REQUEST["transfer_option_type"]==4) ? "selected='selected'": ""); ?> value="4">Hotel &rarr;Hotel ( One Way ) </option>
											<option <?=(($_REQUEST["transfer_option_type"]==5) ? "selected='selected'": ""); ?> value="5">Hotel &rarr;Hotel ( Redondo )</option>
										</select>
										<label for="transfer_option_type" >Tipo de Traslado</label>
									</div>
									<div class="input-field col s12 m6 l4" id="airport_ini">
										<select required="required" name="AirportCode" id="AirportCode_in" >
											<!-- <option selected="selected" value="1">Cancun Airport (CUN)</option>
											<option value="361">Cozumel Airport (CZM)</option> -->
											<option <?=((!isset($_REQUEST["AirportCode"]) || $_REQUEST["AirportCode"]=="1") ? "selected='selected'": ""); ?> value="1">Cancun Aeropuerto (CUN)</option>
											<option <?=(($_REQUEST["AirportCode"]=="361") ? "selected='selected'": ""); ?> value="361">Cozumel Aeropuerto (CZM)</option>	
										</select>
										<label for="AirportCode">Aeropuerto</label>
									</div>
									<div class="input-field col s12 m6 l4 hide" id="hotel_ini">
										<input required="required" type="text" name="transfer_from" id="transfer_from" autocomplete="off" class="decorated ui-autocomplete-input" value="<?=$_REQUEST['transfer_from']?>" role="textbox" aria-autocomplete="list" aria-haspopup="true">
										<label for="transfer_from" class="label-activo">Hotel</label>
									</div>
									<div class="input-field col s12 m6 l4">
										<input required="required" class="notNull ui-autocomplete-input" type="text" name="transfer_end" value="<?=$_REQUEST['transfer_end']?>" id="transfer_option_hotel" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" style="display: inline-block;">
										<input type="hidden" id="clave_end" name="dest_end" value="<?=$_REQUEST['dest_end']?>">
										<label for="transfer_end " class="label-activo">Hotel</label>
									</div>
									<div class="input-field col s12 m3 l3">
										<input required="required" value="<?=$_REQUEST['date1']?>" type="date" name="date1" id="date-trans-book" class="datepicker-trans" >
										<label for="date-trans-book " class="label-activo">Llegada:</label>
									</div>
									<div class="input-field col s12 m3 l3 <?=$_REQUEST["classDate2"]?>" id="date1-trans-book-wrap">
										<input required="required" value="<?=$_REQUEST['date2']?>" type="date" name="date2" id="date1-trans-book" class="datepicker-trans " >
										<label for="date1-trans-book" class="active label-activo" >Salida:</label>
									</div>
									<div class="input-field col s6 m3 l3">
										<select required="required" name="transfer_adult" id="transfer_adult">
											<?php echo Yii::app()->GenericFunctions->makeComboInt(1,45,intval(($_REQUEST["transfer_adult"]!="")?$_REQUEST["transfer_adult"]:"2"));?>
										</select>
										<label for="transfer_adult" >Adultos</label>
									</div>
									<div class="input-field col s6 m3 l3">
										<select required="required" name="transfer_child" id="transfer_child">
											<?php echo Yii::app()->GenericFunctions->makeComboInt(0,45,intval(($_REQUEST["transfer_child"]!="")?$_REQUEST["transfer_child"]:"0"));?>
										</select>
										<label for="transfer_child" >Niños</label>
									</div>
									<div class="input-field col s12">
										<center>
											<button class="btn waves-effect waves-light red" type="submit" >Buscar
												<i class="material-icons">search</i>
											</button>
										</center>
									</div>
								</div>
							</form>
						</div>
					</div>
				  <? if($_REQUEST['request']==1 && isset($_REQUEST['request'])){ ?>
					<div class="col s12">
						<a class="btn grey darken-2  col s12" id="ocultarContenedorBookin">
							Cambiar Parametros
						</a>
					</div>
				  <?}?>
			  </div>
			</div>


<script type="text/javascript">
	<? if(isset($_REQUEST['hotel_act']) && $_REQUEST['hotel_act']!=""){ ?>
		var hab='<?=$_REQUEST['hotelRoom']?>';
		var room =<?=json_encode($_REQUEST['Room'])?>;
		generaBookin(hab,room);// llamar la funcion para generar el bookin
    <?}?>
</script>
