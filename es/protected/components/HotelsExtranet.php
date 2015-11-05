<?php
	Class HotelsExtranet extends CApplicationComponent{
		public $Config = array();
		public $User = "cheke";
		public $Pwd = "sandra";
		//public $WSDL = "http://test.lomasbeta.mx/extranet/ServicesUS/";
		public $WSDL = "http://extranet.lomastravel.com.mx/ServicesUS/";
		//public $WSDL = "http://lomas/extranet/Services/";
		public $WSDLVar = "";
		public $Lng = array("es"=>"es","en"=>"en");
		public $CurLng = "en";
		
		public function __construct(){
			date_default_timezone_set('America/Cancun');

			$this->Config = array();
			
			$this->Config["Destination"] = array();
				$this->Config["Destination"]["Code"] = "6460";				
				
			$this->Config["Dates"] = array();
				$this->Config["Dates"]["CheckIn"] = date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 2,date("Y")));
				$this->Config["Dates"]["CheckOut"] = date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 5,date("Y")));
			
			$this->Config["Rooms"] = array();
				$this->Config["Rooms"][0] = array();
					$this->Config["Rooms"][0]["Adults"] = 2;
					$this->Config["Rooms"][0]["Childs"] = 0;
						$this->Config["Rooms"][0]["ChildAges"] = array();
								$this->Config["Rooms"][0]["ChildAges"][0] = 0;
		}
		
		public function chDates($CheckIn,$CheckOut,$CallBack = ""){
			$this->Config["Dates"]["CheckIn"] = date("Y-m-d",strtotime($CheckIn));
			$this->Config["Dates"]["CheckOut"] = date("Y-m-d",strtotime($CheckOut));
		}
		public function upRoom($Index,$Config){
			$this->Config["Rooms"][$Index] = $Config;
		}
		public function bRConfig($Adults,$Childs,$ChildsAge = array(),$Callback = ""){
			$rtnArray = array();
			$rnArray["Adults"] = intval($Adults);
			$rnArray["Childs"] = intval($Childs);
			if(intval($Childs) > 0){
				$rnArray["ChildAges"] = array();
				for($i = 0; $i < $rnArray["Childs"]; $i++){
					$rnArray["ChildAges"][$i] = $ChildsAge[$i];
				}
			}
			
			if($Callback == ""){
				return $rnArray;
			}else{
				
				$Callback["Param"][1] = $rnArray;
				$this->makeCallBack($Callback);
			}
			
		}
		public function setDes($Code){
			$this->Config["Destination"]["Code"] = $Code;			
		}		
		public function sendHeaders(){
			$Header = '<Security>
			  <Username>' . $this->User . '</Username>
			  <Password>' . $this->Pwd . '</Password>
			  <Culture>en</Culture>
			  <Currency>USD</Currency>
			</Security>';
			
			return $Header;
		}
		public function wsGetDetail($Cod,$Debug = false){
			
			$ContentService = "";
			$ContentService .= '
			<GetHotelDetailsV2 xmlns:m="http://lomastravel.com/webservices/">
				<HotelIds>';
				if(is_array($Cod)){
					foreach($Cod as $Cd){
						$ContentService .= "<HotelID id='{$Cd}' />";
					}
				}else{
					$ContentService .= "<HotelID id='{$Cod}' />";
				}
			$ContentService .='
				</HotelIds>
			</GetHotelDetailsV2>';
			
			return $ContentService;				
			
		}
		
		public function wsGetByTipoHotel($Cod){
			$roomInfo = "";
			
			foreach($this->Config["Rooms"] as $Room){
				if($Room["Childs"] == 0){
					$chInfo = "<ChildAge>0</ChildAge>";
				}else{
					$chInfo = "";
					foreach($Room["ChildAges"] as $Ch){
						$chInfo .= "<ChildAge>{$Ch}</ChildAge>";
					}
				}
				$roomInfo .= '	
							<RoomInfo>
								<AdultsNum>' . $Room["Adults"] . '</AdultsNum> 
								<ChildNum>' . $Room["Childs"] . '</ChildNum> 
								<ChildAges>
						  		' .	$chInfo . '
						  		</ChildAges>
					  		</RoomInfo>';	
				
			}
			$ContentService = "";
			$ContentService .= '<SERVICE_REQUEST>';
			$ContentService .= $this->sendHeaders();
			$ContentService .= '
			  	<SearchHotelsByID>
			  		<clHotelIdInfo>';					
						$ContentService .= "<HotelIdInfo></HotelIdInfo>";
			$ContentService .= "</clHotelIdInfo>";
			$ContentService .= '
					<hTipo>'.$Cod.'</hTipo>
			  		<sPackage>false</sPackage>
			  		<Dates>
				  		<dCheckIn>' . $this->Config["Dates"]["CheckIn"] . '</dCheckIn> 
				  		<dCheckOut>' .$this->Config["Dates"]["CheckOut"] . '</dCheckOut> 
				  	</Dates>
			  		<roomsInformation>
			  			' . $roomInfo . '
			  	  	</roomsInformation>
			  	  	<Price>
				  	  	<minPrice>0</minPrice> 
			  		  	<maxPrice>0</maxPrice> 
					</Price>
			  	  	<starLevel>
			  	  		<minLevel>0</minLevel>
			  	  		<maxLevel>0</maxLevel>
			  	  	</starLevel> 
			  	  	<fAvailableOnly>true</fAvailableOnly>
			  	</SearchHotelsByID>
			';
			$ContentService .= '</SERVICE_REQUEST>';
			return $ContentService;				
		}		
		
		public function wsGetById($Cod,$Debug = false){
			$roomInfo = "";
			
			foreach($this->Config["Rooms"] as $Room){
				if($Room["Childs"] == 0){
					$chInfo = "<ChildAge>0</ChildAge>";
				}else{
					$chInfo = "";
					foreach($Room["ChildAges"] as $Ch){
						$chInfo .= "<ChildAge>{$Ch}</ChildAge>";
					}
				}
				$roomInfo .= '	
							<RoomInfo>
								<AdultsNum>' . $Room["Adults"] . '</AdultsNum> 
								<ChildNum>' . $Room["Childs"] . '</ChildNum> 
								<ChildAges>
						  		' .	$chInfo . '
						  		</ChildAges>
					  		</RoomInfo>';	
				
			}
			$ContentService = "";
			$ContentService .= '<SERVICE_REQUEST>';
			$ContentService .= $this->sendHeaders();
			$ContentService .= '
			  	<SearchHotelsByID>
			  		<clHotelIdInfo>';					
					if(is_array($Cod)){
						foreach($Cod as $Cd){
							$ContentService .= "<HotelIdInfo>{$Cd}</HotelIdInfo>";
						}
					}else{
						$ContentService .= "<HotelIdInfo>{$Cod}</HotelIdInfo>";
					}
			$ContentService .= "</clHotelIdInfo>";
			$ContentService .= '		
			  		<sPackage>false</sPackage>
			  		<Dates>
				  		<dCheckIn>' . $this->Config["Dates"]["CheckIn"] . '</dCheckIn> 
				  		<dCheckOut>' .$this->Config["Dates"]["CheckOut"] . '</dCheckOut> 
				  	</Dates>
			  		<roomsInformation>
			  			' . $roomInfo . '
			  	  	</roomsInformation>
			  	  	<Price>
				  	  	<minPrice>0</minPrice> 
			  		  	<maxPrice>0</maxPrice> 
					</Price>
			  	  	<starLevel>
			  	  		<minLevel>0</minLevel>
			  	  		<maxLevel>0</maxLevel>
			  	  	</starLevel> 
			  	  	<fAvailableOnly>true</fAvailableOnly>
			  	</SearchHotelsByID>
			';
			$ContentService .= '</SERVICE_REQUEST>';
			return $ContentService;				
		}
		public function wsBookHotel($Serialized = "",$nombre = "", $email = "", $adultos, $menores, $locator){
			$roomInfo = "";			
			$ContentService = "";
			$ContentService .= '<SERVICE_REQUEST>';
			$ContentService .= $this->sendHeaders();
			$ContentService .= '
			  	<BookHotel>			  		
			  	  	<Obj>' . base64_encode($Serialized) . '</Obj>
			  	  	<nombre>' . ($nombre) . '</nombre>
			  	  	<email>' . ($email) . '</email>
			  	  	<adultos>' . ($adultos) . '</adultos>
			  	  	<menores>' . ($menores) . '</menores>
			  	  	<locator>' . ($locator) . '</locator>
			  	</BookHotel>
			';
			$ContentService .= '</SERVICE_REQUEST>';
			return $ContentService;				
		}
		
		public function wsGetByDestination($Debug = false, $isPackage = false){
			$roomInfo = "";
			
			foreach($this->Config["Rooms"] as $Room){
				if($Room["Childs"] == 0){
					$chInfo = "<ChildAge>0</ChildAge>";
				}else{
					$chInfo = "";
					foreach($Room["ChildAges"] as $Ch){
						$chInfo .= "<ChildAge>{$Ch}</ChildAge>";
					}
				}
				$roomInfo .= '	
							<RoomInfo>
								<AdultsNum>' . $Room["Adults"] . '</AdultsNum> 
								<ChildNum>' . $Room["Childs"] . '</ChildNum> 
								<ChildAges>
						  		' .	$chInfo . '
						  		</ChildAges>
					  		</RoomInfo>';	
				
			}
			$ContentService = "";
			$ContentService .= '<SERVICE_REQUEST>';
			$ContentService .= $this->sendHeaders();
			$ContentService .= '
			  	<SearchHotelsByID>
			  		<sDestination>' . $this->Config["Destination"]["Code"] . '</sDestination>
			  		<sHotelName /> 
			  		<sPackage>' . (($isPackage) ? "true" : "false") . '</sPackage>
			  		<Dates>
				  		<dCheckIn>' . $this->Config["Dates"]["CheckIn"] . '</dCheckIn> 
				  		<dCheckOut>' .$this->Config["Dates"]["CheckOut"] . '</dCheckOut> 
				  	</Dates>
			  		<roomsInformation>
			  			' . $roomInfo . '
			  	  	</roomsInformation>
			  	  	<Price>
				  	  	<minPrice>0</minPrice> 
			  		  	<maxPrice>0</maxPrice> 
					</Price>
			  	  	<starLevel>
			  	  		<minLevel>0</minLevel>
			  	  		<maxLevel>0</maxLevel>
			  	  	</starLevel> 
			  	  	<fAvailableOnly>true</fAvailableOnly>
			  	</SearchHotelsByID>
			';
			$ContentService .= '</SERVICE_REQUEST>';
			
			return $ContentService;				
		}
		
		public function wsGetByMultipleDestination($Destinations,$Debug = false, $isPackage = false){
			$roomInfo = "";
			
			foreach($this->Config["Rooms"] as $Room){
				if($Room["Childs"] == 0){
					$chInfo = "<ChildAge>0</ChildAge>";
				}else{
					$chInfo = "";
					foreach($Room["ChildAges"] as $Ch){
						$chInfo .= "<ChildAge>{$Ch}</ChildAge>";
					}
				}
				$roomInfo .= '	
							<RoomInfo>
								<AdultsNum>' . $Room["Adults"] . '</AdultsNum> 
								<ChildNum>' . $Room["Childs"] . '</ChildNum> 
								<ChildAges>
						  		' .	$chInfo . '
						  		</ChildAges>
					  		</RoomInfo>';	
				
			}
			$ContentService = "";
			$ContentService .= '<SERVICE_REQUEST>';
			$ContentService .= $this->sendHeaders();
			$ContentService .= '
			  	<SearchHotelsMultipleDestination>
			  		<sDestination>' . $Destinations . '</sDestination>
			  		<sHotelName /> 
			  		<sPackage>' . (($isPackage) ? "true" : "false") . '</sPackage>
			  		<Dates>
				  		<dCheckIn>' . $this->Config["Dates"]["CheckIn"] . '</dCheckIn> 
				  		<dCheckOut>' .$this->Config["Dates"]["CheckOut"] . '</dCheckOut> 
				  	</Dates>
			  		<roomsInformation>
			  			' . $roomInfo . '
			  	  	</roomsInformation>
			  	  	<Price>
				  	  	<minPrice>0</minPrice> 
			  		  	<maxPrice>0</maxPrice> 
					</Price>
			  	  	<starLevel>
			  	  		<minLevel>0</minLevel>
			  	  		<maxLevel>0</maxLevel>
			  	  	</starLevel> 
			  	  	<fAvailableOnly>true</fAvailableOnly>
			  	</SearchHotelsMultipleDestination>
			';
			$ContentService .= '</SERVICE_REQUEST>';
			
			return $ContentService;				
		}
		
		public function wsGetByMultipleIds($Cod,$Debug = false, $isPackage = false){
			$roomInfo = "";
			
			foreach($this->Config["Rooms"] as $Room){
				if($Room["Childs"] == 0){
					$chInfo = "<ChildAge>0</ChildAge>";
				}else{
					$chInfo = "";
					foreach($Room["ChildAges"] as $Ch){
						$chInfo .= "<ChildAge>{$Ch}</ChildAge>";
					}
				}
				$roomInfo .= '	
							<RoomInfo>
								<AdultsNum>' . $Room["Adults"] . '</AdultsNum> 
								<ChildNum>' . $Room["Childs"] . '</ChildNum> 
								<ChildAges>
						  		' .	$chInfo . '
						  		</ChildAges>
					  		</RoomInfo>';	
				
			}
			$ContentService = "";
			$ContentService .= '<SERVICE_REQUEST>';
			$ContentService .= $this->sendHeaders();
			$ContentService .= '
			  	<SearchHotelsByID>
			  		<clHotelIdInfo>';					
						$ContentService .= "<HotelIdInfo></HotelIdInfo>";
			$ContentService .= "</clHotelIdInfo>";
			$ContentService .= '
					<hIds>'.$Cod.'</hIds>
			  		<sPackage>false</sPackage>
			  		<Dates>
				  		<dCheckIn>' . $this->Config["Dates"]["CheckIn"] . '</dCheckIn> 
				  		<dCheckOut>' .$this->Config["Dates"]["CheckOut"] . '</dCheckOut> 
				  	</Dates>
			  		<roomsInformation>
			  			' . $roomInfo . '
			  	  	</roomsInformation>
			  	  	<Price>
				  	  	<minPrice>0</minPrice> 
			  		  	<maxPrice>0</maxPrice> 
					</Price>
			  	  	<starLevel>
			  	  		<minLevel>0</minLevel>
			  	  		<maxLevel>0</maxLevel>
			  	  	</starLevel> 
			  	  	<fAvailableOnly>true</fAvailableOnly>
			  	</SearchHotelsByID>
			';
			$ContentService .= '</SERVICE_REQUEST>';
			return $ContentService;				
					
		}
		
		

		#Ezequiel se agrega funcion para mostrar la fecha de la landing page de hoteles 20140409
		public function wsGetByMultipleIdsPromoHoteles($Destinations,$Debug = false, $isPackage = false, $landing, $fecha_inicio, $fecha_fin){
			$roomInfo = "";
			date_default_timezone_set("America/Mexico_City");
			if($fecha_inicio!=""){
				$promo_inicio=$fecha_inicio;
				$promo_final=$fecha_fin;			
			}else{
				
				if(mktime(0,0,0,substr($landing,5,2),substr($landing,8,2) + 2,substr($landing,0,4))<=mktime(0,0,0,date("m"),date("d") + 2,date("Y"))){
					if($fecha_inicio=="" && $fecha_inicio==""){
						#Fecha sin book
						$promo_inicio = date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 2,date("Y")));
						$promo_final = date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 5,date("Y")));
					}else{
						$promo_inicio = date("Y-m-d",mktime(0,0,0,substr($fecha_inicio,5,2),substr($fecha_inicio,8,2),substr($fecha_inicio,0,4)));
						$promo_final = date("Y-m-d",mktime(0,0,0,substr($fecha_fin,5,2),substr($fecha_fin,8,2),substr($fecha_fin,0,4)));
					}						
				}else{
					$promo_inicio = date("Y-m-d",mktime(0,0,0,substr($landing,5,2),substr($landing,8,2) + 2,substr($landing,0,4)));
					$promo_final = date("Y-m-d",mktime(0,0,0,substr($landing,5,2),substr($landing,8,2) + 5,substr($landing,0,4)));
				}					
			}
			$_REQUEST["hotel_checkin"]=Yii::app()->GenericFunctions->convertPresentableDates($promo_inicio);
			$_REQUEST["hotel_checkout"]=Yii::app()->GenericFunctions->convertPresentableDates($promo_final);
			
			foreach($this->Config["Rooms"] as $Room){
				if($Room["Childs"] == 0){
					$chInfo = "<ChildAge>0</ChildAge>";
				}else{
					$chInfo = "";
					foreach($Room["ChildAges"] as $Ch){
						$chInfo .= "<ChildAge>{$Ch}</ChildAge>";
					}
				}
				//para que tome base doble				
				$Room["Adults"]=2;				
				$roomInfo .= '	
							<RoomInfo>
								<AdultsNum>' . $Room["Adults"] . '</AdultsNum> 
								<ChildNum>' . $Room["Childs"] . '</ChildNum> 
								<ChildAges>
						  		' .	$chInfo . '
						  		</ChildAges>
					  		</RoomInfo>';	
				
			}
			$ContentService = "";
			$ContentService .= '<SERVICE_REQUEST>';
			$ContentService .= $this->sendHeaders();
			$ContentService .= '
			  	<SearchHotelsByID>
			  		<clHotelIdInfo>';					
						$ContentService .= "<HotelIdInfo></HotelIdInfo>";
			$ContentService .= "</clHotelIdInfo>";
			$ContentService .= '
					<hIds>'.$Destinations.'</hIds>
					<sPackage>false</sPackage>
			  		<Dates>
				  		<dCheckIn>' . $promo_inicio . '</dCheckIn> 
				  		<dCheckOut>' .$promo_final . '</dCheckOut> 
				  	</Dates>
			  		<roomsInformation>
			  			' . $roomInfo . '
			  	  	</roomsInformation>
			  	  	<Price>
				  	  	<minPrice>0</minPrice> 
			  		  	<maxPrice>0</maxPrice> 
					</Price>
			  	  	<starLevel>
			  	  		<minLevel>0</minLevel>
			  	  		<maxLevel>0</maxLevel>
			  	  	</starLevel> 
			  	  	<fAvailableOnly>true</fAvailableOnly>
			  	</SearchHotelsByID>
			';
			$ContentService .= '</SERVICE_REQUEST>';
			
			return $ContentService;				
		}				
		
		public function parseFromInput($str){
			$rtn = array("City"=>"","Code"=>"");
			$tmp = explode(" (",$str);
			$tmp[1] = str_replace(")","",$tmp[1]);
			$rtn["City"] = $tmp[0];
			$rtn["Code"] = $tmp[1];
			
			
			if(strlen($rtn["Code"]) != 3){
				$rtn["Code"] = "CUN";
				$rtn["City"] = "Cancun";
			}
			
			return $rtn;
		}
		public function getRooms($Rooms){
			$rtn = array();
			if(isset($Rooms[0])){
				$rtn = $Rooms;
			}else{
				$rtn[0] = $Rooms;
			}			
			return $rtn;
		}
		
		public function getPrice($Occup){
			$rtn = array();
			if(isset($Occup["Price"])){
				$rtn = $Occup;
			}else{
				$rtn = $Occup[0];
			}
			
			return $rtn;
		}
		
		public function discountType($Value){
			$rtn = array();
			$rtn["Value"] = $Value;
			if(strpos("/",$Value)){
				$rtn["Type"] = 1;
			}else if(strpos(".",$Value)){
				$rtn["Type"] = 2;
			}else if(is_numeric($Value)){
				$rtn["Type"] = 3;
			}
						
			return $rtn;
		}
		
		
		private function makeCallBack($Callback){
			if(isset($Callback["Function"])){
				if(isset($Callback["Param"])){
					if(is_array($Callback["Param"])){
						$Params = "";
						foreach($Callback["Param"] as $_cb){
							if(is_array($_cb)){
								$Params .= ",array(";
									$_mString = "";
									foreach($_cb as $k=>$v){
										$_mString .= ",'{$k}'=>'{$v}'";
									}
									$Params .= substr($_mString,1);
								$Params .= ")";
							}else{
								$Params .= ",'{$_cb}'";
							}
						}
						

					eval("$" . "this->" . $Callback["Function"] . "(" . substr($Params,1) . ");");
						
					}else{
						eval("$" . "this->" . $Callback["Function"] . "('" . $Callback["Param"] . "');");
					}
				}else{
					eval("$" . "this->" . $Callback["Function"] . "();");
				}
			}
		}
		
		
		
		
	}

?>
