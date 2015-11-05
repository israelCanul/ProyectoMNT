<?php
	class Bookingbox extends CWidget{
		
		public $size = "normal";
		public $cProd = "hotels";
		public $selfReturn = false;
		public $returnTo = "";
		public $selectAdulto = 0;
		
		public function run(){
			$cs = Yii::app()->getclientScript();
			//$cs->registerScriptFile(Yii::app()->params["baseUrl"].'/js/validate.jquery.js?a='. Yii::app()->params['assets'],CClientScript::POS_END);

			// si no llegan parametros de busquedas request queda activo para hoteles
			$_REQUEST['request']="active";
			//
			//
			if(!isset($_REQUEST['hotelAdults_0'])){
				$_REQUEST['hotelAdults_0']=2;
			}
			if(isset($_REQUEST['hotelCheckin']) && isset($_REQUEST['hotelCheckout'])){
				$_REQUEST['hotel_act']="active";
				$_REQUEST['trans_act']="";
				$_REQUEST['tour_act']="";
				$_REQUEST['request']=1;
			}
			

			
			if(!isset($_REQUEST['hotelCheckin'])){
				$_REQUEST['hotelCheckin']=date('m/d/Y', strtotime('+2 day'));
			}
			if(!isset($_REQUEST['hotelCheckout'])){
				$_REQUEST['hotelCheckout']=date('m/d/Y', strtotime('+5 day'));
			}



			// destino del tour o busqueda
			if(!isset($_REQUEST['tour_destination'])){
				$_REQUEST['tour_destination']="";
				$_REQUEST['dest']='8';
				$_REQUEST['tipo']='destination';
			}
			if(!isset($_REQUEST['tour-Checkin'])){
				$_REQUEST['tour-Checkin']=date('m/d/Y', strtotime('+2 day'));
			}
			if(!isset($_REQUEST['tour_adults'])){
				$_REQUEST['tour_adults']=2;
			}

			if(!isset($_REQUEST['tour_child'])){
				$_REQUEST['tour_child']=0;
			}

			if($_REQUEST['tour_destination']!="" && isset($_REQUEST['tour-Checkin']) && isset($_REQUEST['tipo'])){
				$_REQUEST['trans_act']="";
				$_REQUEST['tour_act']="active";
				$_REQUEST['hotel_act']=""; 
				$_REQUEST['request']=1;
			}

			if(isset($_REQUEST['TourId']) && $_REQUEST['TourId']!="" ){
				$_REQUEST['tipo']='tour';
				$_REQUEST['trans_act']="";
				$_REQUEST['tour_act']="active";
				$_REQUEST['hotel_act']="";
				$_REQUEST["clave"]=$_REQUEST["prod"];
				$_REQUEST['request']=1;
			}

			/*print_r($_REQUEST);
			exit();*/
			
			/*  cuando se viene desde una busqueda de un transfer */
			// destino from por default es 1=aeropuerto cancun
			if(!isset($_REQUEST['dest_from'])){
				$_REQUEST['dest_from']=1;
			}
			// validar que la busqueda por default sea redondo=1
			if(!isset($_REQUEST['round_trip'])){
				$_REQUEST['round_trip']=1;
			}
			// vuelo redondo es igual a 1 por default
			if(!isset($_REQUEST['transfer_option_type'])){
				$_REQUEST['transfer_option_type']=1;
			}
			// id del aeropuerto de cancun 1 si no existe un id enviado
			if(!isset($_REQUEST['AirportCode'])){
				$_REQUEST['AirportCode']=1;
			}
			//transfer_from
			if(!isset($_REQUEST['transfer_from'])){
				$_REQUEST['transfer_from']="";
			}
			//transfer_end
			if(!isset($_REQUEST['transfer_end'])){
				$_REQUEST['transfer_end']="";
			}
			// si no recibe id de llegada se pone el "" por default
			if(!isset($_REQUEST['dest_end'])){
				$_REQUEST['dest_end']="";
			}
			//date1 salida
			if(!isset($_REQUEST['date1'])){
				$_REQUEST['date1']=date('m/d/Y', strtotime('+6 day'));
			}
			//date 2 llegada
			if(!isset($_REQUEST['date2'])){
				$_REQUEST['date2']=date('m/d/Y', strtotime('+6 day'));
			}
			// numero de adultos
			if(!isset($_REQUEST['transfer_adult'])){
				$_REQUEST['transfer_adult']=2;
			}
			// numero de niños
			if(!isset($_REQUEST['transfer_child'])){
				$_REQUEST['transfer_child']=0;
			}
			// clave de la transferencia
			if(!isset($_REQUEST['clave_trans'])){
				$_REQUEST['clave_trans']="";
			}

			if($_REQUEST['clave_trans']!="" && $_REQUEST['dest_end']!="" && $_REQUEST['transfer_end']!=""){
				$_REQUEST['trans_act']="active";
				$_REQUEST['tour_act']="";
				$_REQUEST['hotel_act']="";
				$_REQUEST['request']=1;
				$classDate2="";
				if($_REQUEST['transfer_option_type']!=1 && $_REQUEST['transfer_option_type']!=5){
					$classDate2="hide";
					$_REQUEST["classDate2"]=$classDate2;
				}
			}


			/*$cs = Yii::app()->getclientScript();
			$cs->registerCssFile(Yii::app()->params["baseUrl"].'/css/page/booking.min.css?a='. Yii::app()->params['assets'],'screen, projection');*/

			$this->render("bookingbox",array("selectAdulto" => $this->selectAdulto,"size"=>$this->size,"cProd"=>$this->cProd,"selfReturn"=>$this->selfReturn,"returnTo"=>$this->returnTo));
		}
	
	}
?>
