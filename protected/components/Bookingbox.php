<?php
	class Bookingbox extends CWidget{
		
		public $size = "normal";
		public $cProd = "hotels";
		public $selfReturn = false;
		public $returnTo = "";
		public $selectAdulto = 0;
		
		public function run(){
			$cs = Yii::app()->getclientScript();

			
			if(!isset($_REQUEST["hotel_destination"])){
				$_REQUEST["hotel_destination"] = "";
			}

			if(!isset($_REQUEST["cCode"])){
				$_REQUEST["cCode"] = "";
			}

			if(!isset($_REQUEST["HotelId"])){
				$_REQUEST["HotelId"] = "";
			} 

			if(!isset($_REQUEST["seg"])){
				$_REQUEST["seg"] = "";
			} 

			if(!isset($_REQUEST["hotel_checkin"])){
				$_REQUEST["hotel_checkin"] = "";
			} 

			if(!isset($_REQUEST["hotel_checkout"])){
				$_REQUEST["hotel_checkout"] = "";
			} 

			if(!isset($_REQUEST["hotel_rooms"])){
				$_REQUEST["hotel_rooms"] = "";
			} 

			if(!isset($_REQUEST["Room"][0]["Adults"])){
				$_REQUEST["Room"][0]["Adults"] = "";
			} 

			if(!isset($_REQUEST["Room"][0]["Childs"])){
				$_REQUEST["Room"][0]["Childs"] = "";
			} 

			if(!isset($_REQUEST["Room"][0]["Childs"])){
				$_REQUEST["Room"][0]["Childs"] = "";
			}

			if(!isset($_REQUEST["isTourCategory"])){
				$_REQUEST["isTourCategory"] = "";
			} 


			if(!isset($_REQUEST["tour_destination"])){
				$_REQUEST["tour_destination"] = "";
			} 


			if(!isset($_REQUEST["dest"])){
				$_REQUEST["dest"] = "";
			} 


			if(!isset($_REQUEST["TourId"])){
				$_REQUEST["TourId"] = "";
			} 


			if(!isset($_REQUEST["ProveedorId"])){
				$_REQUEST["ProveedorId"] = "";
			} 


			if(!isset($_REQUEST["openTk"])){
				$_REQUEST["openTk"] = "";
			} 

			
			if(!isset($_REQUEST["tour_fecha"])){
				$_REQUEST["tour_fecha"] = "";
			} 

			if(!isset($_REQUEST["tour_adults"])){
				$_REQUEST["tour_adults"] = "";
			} 

			if(!isset($_REQUEST["tour_childs"])){
				$_REQUEST["tour_childs"] = "";
			} 

			if(!isset($_REQUEST["transfer_option_type"])){
				$_REQUEST["transfer_option_type"] = "";
			} 

			if(!isset($_REQUEST["transfer_option_airport"])){
				$_REQUEST["transfer_option_airport"] = "";
			} 

			if(!isset($_REQUEST["transfer_from"])){
				$_REQUEST["transfer_from"] = "";
			} 

			if(!isset($_REQUEST["transfer_option_hotel"])){
				$_REQUEST["transfer_option_hotel"] = "";
			} 

			if(!isset($_REQUEST["transfer_arrival"])){
				$_REQUEST["transfer_arrival"] = "";
			} 

			if(!isset($_REQUEST["transfer_return"])){
				$_REQUEST["transfer_return"] = "";
			} 

			if(!isset($_REQUEST["transfer_adults"])){
				$_REQUEST["transfer_adults"] = "";
			} 

			if(!isset($_REQUEST["transfer_child"])){
				$_REQUEST["transfer_child"] = "";
			} 


			if(!isset($_REQUEST["flight_directions"])){
				$_REQUEST["flight_directions"] = "";
			} 
			if(!isset($_REQUEST["flight_airport_from"])){
				$_REQUEST["flight_airport_from"] = "";
			} 
			if(!isset($_REQUEST["flight_departure"])){
				$_REQUEST["flight_departure"] = "";
			} 
			if(!isset($_REQUEST["flight_arrive"])){
				$_REQUEST["flight_arrive"] = "";
			} 
			if(!isset($_REQUEST["flight_airport_to"])){
				$_REQUEST["flight_airport_to"] = "";
			} 
			if(!isset($_REQUEST["flight_depDate"])){
				$_REQUEST["flight_depDate"] = "";
			} 
			if(!isset($_REQUEST["flight_retDate"])){
				$_REQUEST["flight_retDate"] = "";
			} 
			if(!isset($_REQUEST["flight_numAdt"])){
				$_REQUEST["flight_numAdt"]= "";
			} 
			if(!isset($_REQUEST["flight_numChd"])){
				$_REQUEST["flight_numChd"] = "";
			} 
			if(!isset($_REQUEST["flight_numInf"])){
				$_REQUEST["flight_numInf"] = "";
			} 
			if(!isset($_REQUEST["flight_class"])){
				$_REQUEST["flight_class"] = "";
			} 
			if(!isset($_REQUEST["flight_directFlight"])){
				$_REQUEST["flight_directFlight"] = "";
			} 

			/*$cs = Yii::app()->getclientScript();
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/booking.min.css?a='. Yii::app()->params['assets'],'screen, projection');*/

			$this->render("bookingbox",array("selectAdulto" => $this->selectAdulto,"size"=>$this->size,"cProd"=>$this->cProd,"selfReturn"=>$this->selfReturn,"returnTo"=>$this->returnTo));
		}
	
	}
?>
