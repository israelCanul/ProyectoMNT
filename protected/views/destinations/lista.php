<script type="text/javascript">
	var hotelsOrderingXML = "<?= $this->createUrl("hoteles/ordenacion"); ?>";
	var searchToken = "<?= $_Cr; ?>";
</script>
<div class="row">
<div class="col s12 m10 offset-m1 l10 offset-l1">
<!-- INICIO DE LA VISTA -->
<div class="content">

<?php
	

	$Htls 			= array();
	$languaje 		= strtoupper(Yii::app()->language);

	if(sizeof($_Htls[0]->Hotel) && isset($_Htls[0]->Hotel[0]->attributes()->minAverPrice)){
		if(isset($_REQUEST["hotel_category"])){
			$locacion  =  utf8_encode($_REQUEST["hotel_category"]);
		}else{
			$locacion  =  utf8_encode($_REQUEST["hotel_destination"]);
    		if($locacion == "Cancun" && $languaje=="ES"){
    			$locacion  ="Canc&uacute;n";
       		}
       	}
						
		$_getPrecioMax="";
		if(intval($_GET['price_max'])>0){
			$_getPrecioMax="?price_max=".$_GET['price_max'];
		}       	
?>

	

	<!-- TITULARES -->
	<h6 class="infoSearch">
		<?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($locacion));?> &#8226; 
		<?php echo date('D, M d', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckIn"])); ?> - 
		<?php echo date('D, M d', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckOut"])); ?> &#8226; 
		<?
		$totalAdultos=0;
		$totalNinos=0;
		foreach(Yii::app()->_Hotels->Config["Rooms"] as $paxHab){
			$totalAdultos += $paxHab["Adults"];
			$totalNinos += $paxHab["Childs"];	
		}?>		
		<?php echo sizeof(Yii::app()->_Hotels->Config["Rooms"])." ";
		if(sizeof(Yii::app()->_Hotels->Config["Rooms"])==1){
			echo "Room";
		}else{
			echo "Rooms";
		}?> &#8226;
		<?php echo "".$totalAdultos." Adults ";
		if($totalNinos>0){ echo ", ".$totalNinos." Children"; }
		?> 
		
	</h6>
	
	<h1 class="infoResult"> 
		<span id="hotelsResult"><?php echo sizeof($_Htls[0]->Hotel);?></span> Hotels in <?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($locacion)); ?> 
		<div class="fluid">
			on <?php echo date('D, M d', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckIn"])); ?> &nbsp;-&nbsp; 
		 	<?php echo date('D, M d', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckOut"])); ?>
		 </div>
	</h1>

	<?php
		$hab = 1;
		foreach(Yii::app()->_Hotels->Config["Rooms"] as $Room){
			if(!isset($Room["ChildAges"])){
				$Room["ChildAges"] = array(0);
			}
	?>
        
		<p class="infoRooms">
		<span><?php echo Yii::t("global","Habitación"); ?> </span><?php echo $hab; ?>-
		<span><?php echo Yii::t("global","Adulto|Adultos",$Room["Adults"]);?> </span><?php echo $Room["Adults"]; ?>-
		<span><?php echo Yii::t("global","Menor|Menores",$Room["Childs"]);?> </span><?php echo $Room["Childs"]; ?>
		<?php if($Room["Childs"] > 0){ ?>
			- <span><?php echo Yii::t("global","Edades Menores"); ?>:</span>
			<?php foreach($Room["ChildAges"] as $ch){
					echo $ch . ", ";
				}
		}?>
		</p>
	
	<?php
		$hab++;
		}
	?>	


	<!-- Listado y Filtros para busqueda de hoteles -->
	<div id="hotelsLF" class="contentSide box jplist">
		

		<?php
					$MaxPrice = 0;
					$MinPrice = 99999999;
					$_MealsPlan = array();
					$_Categories = array();
                    $starsLevel = 0;
                    $_starsLevel = array();
					
                    $MealsPlan = array();
					// Si hay hoteles
					if(sizeof($_Htls[0]->Hotel) > 0){
						
							$elementList = 1;
							foreach($_Htls[0]->Hotel as $_h){
								
								//Agrego el Hotel a un Array para el Filtro
								
								$_Rooms = $_h->RoomType;
								foreach($_Rooms as $_r){
									$Price = $_r->Occup;
									if(isset($Price->Board)){
										if(!in_array(utf8_decode($Price->Board->attributes()->name),$MealsPlan)){
											array_push($MealsPlan,utf8_decode($Price->Board->attributes()->name));
										}
									}
								}
								
								$categoryH = explode(",",(string) utf8_decode($_h->attributes()->category));
								if(count($categoryH)>1){
									$category=$categoryH[0];
									foreach($categoryH as $catH){
										if(!in_array(utf8_decode($catH),$_Categories)){
											$_Categories[]=utf8_decode($catH);
										}
									}
								}else{
									$category = (string) utf8_decode($_h->attributes()->category);
								}								
								
								$Htl = array(
									"Discount" 	=> (float) ($_h->attributes()->discount), 
									"Price" 	=> (((float) ($_h->attributes()->minAverPrice) == 0) ? 99999 : (float) ($_h->attributes()->minAverPrice)),
									"Id" 		=> (int) $_h->attributes()->hotelId,
									"rStars" 	=> (float) $_h->attributes()->starsLevel,
									"dStars" 	=> substr((string) $_h->attributes()->starsLevel,0,1),
									"Name" 		=> (string) utf8_decode($_h->attributes()->name),
									"Category" 	=> (string) $category,
									"Location" 	=> (string) $_h->Location->attributes()->city . ", " . (string) $_h->Location->attributes()->searchingState, 
									"OnlyAdults" => (int) $_h->attributes()->onlyAdults);
							
								// Se van guadando las categorias en un array
								$tmpCat=utf8_decode(trim($category)); 
								if(!in_array($tmpCat , $_Categories)){
									$_Categories[] = $tmpCat;
								}

								// Se obtiene el precio mayor de todos los hoteles
								if((float)$_h->attributes()->minAverPrice > $MaxPrice && (float)$_h->attributes()->minAverPrice != 99999999){
									$MaxPrice = (float)$_h->attributes()->minAverPrice;
								}
								// Se obtiene el precio menos de todos los hoteles
								if((float)$_h->attributes()->minAverPrice < $MinPrice){
									$MinPrice = (float)$_h->attributes()->minAverPrice;
								}
                                                                
                               if((float) $_h->attributes()->starsLevel > $starsLevel){
									$starsLevel = (float) $_h->attributes()->starsLevel;
								}
								if(!in_array(substr((string) $_h->attributes()->starsLevel,0,1),$_starsLevel)){
									$_starsLevel[]=substr((string) $_h->attributes()->starsLevel,0,1);
								}
						
							}
					}
						
				?>


		<!-- FILTROS -->
		<section class="leftSide filter">
		
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript">
				var infowindow = null;
				var map = null;
				var hoteles = new Object;
				var isMapDisplayed = false;
			
			<?php
				$hotelsMarker = "";
				
				$xcount = 0;
				if(sizeof($_Htls[0]->Hotel) > 0){
					if(isset($_Htls[0]->Hotel[0]->attributes()->minAverPrice)){
						foreach($_Htls[0]->Hotel as $_h){
							if((string) $_h->Location->attributes()->latitude != "" && (string) $_h->Location->attributes()->longitude != ""){
								$hotelsMarker .= "[
									\"" . trim((string) utf8_decode($_h->attributes()->name)) . "\"," . (string) $_h->Location->attributes()->latitude . ","	. (string) $_h->Location->attributes()->longitude . ",{$xcount}," . (int) $_h->attributes()->hotelId . "
								],";
								$xcount++;	
							}
						}
					}
				}											
			
			?>
			var BaseHoteles = [<?= substr($hotelsMarker,0,-1); ?>];
			
			var debugHoteles = null;
			$(document).ready(function () { initialize(BaseHoteles);  });
			
			<?php
			$xcountForOpt = 0;
			$latLong = "";
			if(sizeof($_Htls[0]->Hotel) > 0){
				if(isset($_Htls[0]->Hotel[0]->attributes()->minAverPrice)){
					foreach($_Htls[0]->Hotel as $_h){
						if((string) $_h->Location->attributes()->latitude != "" && (string) $_h->Location->attributes()->longitude != ""){
							if($xcountForOpt == 0){
								$latLong = (string) $_h->Location->attributes()->latitude . "," . (string) $_h->Location->attributes()->longitude;
							}
							$xcountForOpt++;
							
						}
					}
				}
			}
			?>
			
			var centerMap = new google.maps.LatLng(<?= $latLong; ?>);
			var myOptions = {
		            zoom: 10,
		            center: centerMap,
		            mapTypeId: google.maps.MapTypeId.ROADMAP
		        }
			
		    function initialize(hoteles) {
		
		        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		
		        setMarkers(map, hoteles);
			    infowindow = new google.maps.InfoWindow({
		                content: "Loading..."
		            });
		
		        var bikeLayer = new google.maps.BicyclingLayer();
				bikeLayer.setMap(map);
		    }
			
		
		    function setMarkers(map, markers) {
		
		        for (var i = 0; i < markers.length; i++) {
		            var hotelesMarker = markers[i];
		            var hotelesLatLong = new google.maps.LatLng(hotelesMarker[1], hotelesMarker[2]);
		            var marker = new google.maps.Marker({
		                position: hotelesLatLong,
		                map: map,
		                icon: "/images/icon/mapPointsHoteles2.png",
		                title: hotelesMarker[0],
		                zIndex: hotelesMarker[3],
		                id: hotelesMarker[4]
		            });
		
		            var contentString = "Some content";

		            google.maps.event.addListener(marker, "click", function () {//$miniMap
				var html = "<div class='bloque mapPlacerOptionHotelResult'>"+ $("#hotel_titulo_"+this.id).html() + "</div>";
				//var html = "<div class='bloque mapPlacerOptionHotelResult'><a href='www.google.com'>"+hotelesMarker[0]+"</a></div>";	
							
		                infowindow.setContent(html);
		                infowindow.open(map, this);
		            });
		        }
		    }
		    
		  
		    
		    function clearOverlays() {
			  for (var i = 0; i < hoteles.length; i++ ) {
			    hoteles[i].setMap(null);
			  }
			  hoteles = [];
			}
			
			</script>


			<!-- MAPA DE HOTELES -->
			<div class="bloque" id="map_container">
				<div id="map_canvas" style="width: 100%; height: 200px;"></div>
			</div>

			<?php
				if(sizeof($_Htls[0]->Hotel) && isset($_Htls[0]->Hotel[0]->attributes()->minAverPrice)){	
			?>

			<div class="bloque formFilter jplist-panel box panel-top" id="filter_search_prod">		
				<h4>Filter your results</h4>
				<div class="bloque curved" id="filter_prods_content">
			   		<form id="HotelFilters" onsubmit="return false;">
	            	
	            		<!-- Filtro por nombre -->
	            		<div class="elementFilter">
	            			<div class="text-filter-box">
	            				
				   				<!--[if lt IE 10]>
				   					<div class="jplist-label">Filter by Title:</div>
				   				<![endif]-->
				   
				   				<input data-path=".titleHotel" type="text" value="" placeholder="Filter by Name"  data-control-type="textbox"  data-control-name="title-filter"  data-control-action="filter" />
							</div>

							<div class="clear"></div>	
						</div>


						<!-- Filtro por precio -->

			        	<? if(intval($_GET['price_max'])>0){?>
						<div class="elementFilter">
			            	<h6>Budget Travel:</h6>
			            	<div class="jplist-range-slider" data-control-type="range-slider" data-control-name="range-slider-pricesTotal" data-control-action="filter" data-path=".priceTotal" data-slider-func="pricesTotalSlider"  data-setvalues-func="pricesValues">
								<div class="ui-slider" data-type="ui-slider"></div>
								<div class="value prev" data-type="prev-value"></div>
								<div class="value next" data-type="next-value"></div>
							</div>
			        	</div>			        	
			        	<?}else{?>	
							<div class="elementFilter sliderDiv">
				            	<h6>Price average per night</h6>
				            	<div class="jplist-range-slider" data-control-type="range-slider" data-control-name="range-slider-prices" data-control-action="filter" data-path=".price" data-slider-func="pricesSlider"  data-setvalues-func="pricesValues">
									<div class="ui-slider" data-type="ui-slider"></div>
									<div class="value prev" data-type="prev-value"></div>
									<div class="value next" data-type="next-value"></div>
								</div>
				        	</div>			        			        	
			        	<?}?>

						<!-- Filtro por estrellas -->
						<div class="elementFilter sliderDiv">
				       		<h6>Stars Ratings&nbsp;
								<?php
								for($i=1;$i<=$starsLevel;$i++){
									if($i<=6){
								?>
						       		<img  src="/images/icon/prod_star.jpg" alt="stars">
								<?php 
									}
								}
								?>
				       		</h6>

				      		<div class="jplist-range-slider" data-control-type="range-slider" data-control-name="range-slider-stars"  data-control-action="filter" data-path=".stars" data-slider-func="starsSlider" data-setvalues-func="starsValues">
								<div class="ui-slider red" data-type="ui-slider"></div>
								<div class="value prev" data-type="prev-value"></div>
								<div class="value next" data-type="next-value"></div>
							</div>

							<? if($starsLevel>6){?>
								<div class="jplist-group" data-control-type="checkbox-text-filter" data-control-action="filter" data-control-name="categoria_ext" data-path=".categoria_ext" data-logic="or">
								<? if(in_array(7, $_starsLevel)){?>
		         					<input value="Boutique" id="Boutique" type="checkbox" />
		         					<label for="Boutique">Boutique</label>
		         					<div class="clear"></div>							
	         					<?}?>
	         					<? if(in_array(8, $_starsLevel)){?>
		         					<input value="Gran Turismo" id="Gran Turismo" type="checkbox" />
		         					<label for="Gran Turismo">Gran Turismo</label>
		         					<div class="clear"></div>
		         				<?}?>
		         				<? if(in_array(9, $_starsLevel)){?>
		         					<input value="Special Category" id="Special Category" type="checkbox" />
		         					<label for="Special Category">Special Category</label>
		         					<div class="clear"></div>	 
		         				<?}?>
		        				</div>
							<?}?>
				    	</div>

				    	<!-- Filtro por categoria -->
						<div class="elementFilter">
			      			<h6><?php echo Yii::t("global","Categoría"); ?></h6>
							<div class="jplist-group">
				   			   	<div class="filterCategory">
				   			   		<input  data-control-type="radio-buttons-filters" data-control-action="filter"  data-control-name="default" data-path="default" id="default-radio" type="radio" name="jplist" checked="checked" /> 
					  		   		<label for="default-radio">All</label>
					  		   	</div>
				   				
							   	<?php foreach($_Categories as $_Cat){?>
				   					<div class="filterCategory">
				   						<input  data-control-type="radio-buttons-filters" data-control-action="filter"  data-control-name="<?php echo Yii::app()->GenericFunctions->makeUrl(strtolower($_Cat));?>"  data-path=".<?php echo Yii::app()->GenericFunctions->makeUrl(strtolower($_Cat));?>"  id="<?php echo Yii::app()->GenericFunctions->makeUrl(strtolower($_Cat));?>"  type="radio" name="jplist"  /> 
										<label for="<?php echo Yii::app()->GenericFunctions->makeUrl(strtolower($_Cat));?>"><?php echo $_Cat; ?></label>
									</div>
				   				<?php } ?>
							</div>
						</div>

						<!-- Filtor por plan de alimentos -->
						<div class="elementFilter">
			    			<h6><?php echo Yii::t("global","Plan de Alimentos"); ?></h6>
							<div class="jplist-group" data-control-type="checkbox-text-filter" data-control-action="filter" data-control-name="keywords" data-path=".keywords" data-logic="or">

	         				<?php foreach($MealsPlan as $_mPlan){ ?>
	         					<div style="overflow: hidden; padding: 5px 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;  box-sizing: border-box;">
	         						<input value="<?php echo strtolower($_mPlan);?>" id="<?php echo strtolower($_mPlan);?>" type="checkbox" style="position: relative;left: 0;visibility: visible;" />
	         						<span><?php echo ucwords($_mPlan);?></span>
	         					</div>
	         				<?php } ?>
	        				</div>
	   					</div>
				
					</form>
				</div>
			</div>

			<?php } ?>

		</section>

		<section id="hotel_search_results" class="rightSide">

			<!-- PANEL DE CONTROLES -->
			<div class="jplist-panel box panel-top">
				
				<!-- Controles -->
				<div class="sortSearch">
					
					<!-- Control de Paginacion -->
					<!--
		        	<div class="jplist-label" data-type="Page {current} of {pages}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging"></div>
		        	-->
		        	<label class="jfilterHotel" >Sort By: </label>
					<label class="jfilterHotel" data-action = "1"> Price </label>
					<label class="jfilterHotel" data-action = "5"> Hotel Name </label>
					<label class="jfilterHotel" data-action = "3"> Star Rating </label>
					<label class="jfilterHotel" data-action = "6"> Best Deals </label>

					<!-- Selector de elementos por pagina -->
					<select class="jplist-select browser-default" data-control-type="items-per-page-select" data-control-name="paging" data-control-action="paging">
						<option data-number="3"> 3 per page </option>
					    <option data-number="5" data-default="true"> 5 per page </option>
					    <option data-number="10"> 10 per page </option>
					    <option data-number="all"> View All </option>
			        </select>
				
					<!-- Selector de ordenacion -->

					<select id="controlSortHotels" class="jplist-select browser-default" data-control-type="sort-select" data-control-name="sort" data-control-action="sort" >
			   			<option data-path="default">Sort by</option>
					  	<option data-path=".price" data-order="asc" data-type="number" value="1"> Price (low to high) </option>
				  		<option data-path=".price" data-order="desc" data-type="number" value="2"> Price (high to low) </option>
				  		<option data-path=".stars" data-order="asc" data-type="number" value="3"> Star Rating Asc </option>
				  		<option data-path=".stars" data-order="desc" data-type="number" value="4"> Star Rating Desc </option>
				  		<option data-path=".titleHotel" data-order="asc" data-type="text" value="5"> Name hotel </option>
				  		<option data-path=".promoHotel" data-order="des" data-type="text" value="6"> Promo Hotel </option>
					</select>
					

				</div>
			
				<!-- Paginacion -->
				<div class="pagination">
		            <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-mode="google-like" data-range="5"></div>
		        </div>
			
			</div>
			<!-- FIN DE PANEL -->

			<?
			//Ezequiel mostrar URL en el mapa
			if(sizeof($_Htls[0]->Hotel) > 0){
				foreach($_Htls[0]->Hotel as $_h){
					?>
					<div class="title elementName" style='display:none' id="hotel_titulo_<?=$_h->attributes()->hotelId?>">
						<a  href='<?php echo $this->createUrl('hoteles/detalle', array('hotel' => $_h->attributes()->hotel_keyword) );?>' title='<?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($_h->attributes()->name)); ?>'><span class="titleHotel"><?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($_h->attributes()->name)); ?><span></a>
					</div>			
				<?}
			}
			?>
			
			<!-- LISTADO DE HOTELES -->
			<div id="itemContainer" class="list box text-shadow">
			
				<?php 
					$showNoResults = "none";
					if(sizeof($_Htls[0]->Hotel) == 0){
						$showNoResults = "block";
					}
				?>
       
				<div class="no_results" style="display: <?= $showNoResults; ?>">
					<div class="bloque" id="no_result_box">
						<span>Error. Lo sentimos, tu búsqueda no arrojó resultados</span>
						<a href="#" title="" class="btnNewSearchFilter">Realizar nueva Búsqueda</a>
					</div>
				</div>
		
				<div id="ajaxHotelResults"></div>	
		
		
				<?php
					$MaxPrice = 0;
					$MinPrice = 99999999;
					$_MealsPlan = array();
					$_Categories = array();
                    $starsLevel = 0;
                    $_starsLevel = array();
					$plan_meals = array();

					// Si hay hoteles
					if(sizeof($_Htls[0]->Hotel) > 0){
						//if(isset($_Htls[0]->Hotel[0]->attributes()->minAverPrice)){
							$elementList = 1;
							foreach($_Htls[0]->Hotel as $_h){
								
								$plan_meals = array();
								$_Rooms = $_h->RoomType;
								$aa=1;
								foreach($_Rooms as $_r){
									$Price = $_r->Occup;

										if($aa==1){
											//$total = (float) $Price->attributes()->price;
											$productId= (string)$_r->attributes()->productId;
										}
										//$productId=(string) $_r->attributes()->productId;
										$hotelId=(int) $_h->attributes()->hotelId;
										$total = 0;
										$totalAVG = 0;
										foreach($_Htls as $all_hotels){
											foreach($all_hotels as $lista_hotels){
												foreach($lista_hotels as $_hotels){
													foreach($_hotels->RoomType as $rHall){
														$PriceThis = $rHall->Occup;

														if($productId == (string) $rHall->attributes()->productId){
															$total=$total + (float) $PriceThis->attributes()->price;
														}
													}
													$All_hotels= (int)$_hotels->attributes()->hotelId;
													if($hotelId==$All_hotels){
														$totalAVG = $totalAVG+(float)($_hotels->attributes()->minAverPrice);
													}
												}
											}
										}

									if(isset($Price->Board)){
										if(!in_array(utf8_decode($Price->Board->attributes()->name),$plan_meals)){
											array_push($plan_meals,utf8_decode($Price->Board->attributes()->name));
										}
									}
									$aa++;
								}
								
								$categoryH = explode(",",(string) utf8_decode($_h->attributes()->category));
								
								if(count($categoryH)>1){
									$category=$categoryH[0];
									foreach($categoryH as $catH){
										if(!in_array(utf8_decode($catH),$_Categories)){
											$_Categories[]=utf8_decode($catH);
										}
									}
								}else{
									$category= (string) utf8_decode($_h->attributes()->category);
								}								
								
								$Htl = array(
									"Discount" 	=> (float) ($_h->attributes()->discount), 
									"Price" 	=> (((float) ($_h->attributes()->minAverPrice) == 0) ? 99999 : (float) ($_h->attributes()->minAverPrice)),
									"Id" 		=> (int) $_h->attributes()->hotelId,
									"rStars" 	=> (float) $_h->attributes()->starsLevel,
									"dStars" 	=> substr((string) $_h->attributes()->starsLevel,0,1),
									"Name" 		=> (string) utf8_decode($_h->attributes()->name),
									"Category" 	=> (string) $category,
									"Location" 	=> (string) $_h->Location->attributes()->city . ", " . (string) $_h->Location->attributes()->searchingState, 
									"OnlyAdults" => (int) $_h->attributes()->onlyAdults);
							
								// Se van guadando las categorias en un array
								$tmpCat=utf8_decode(trim($category)); 
								if(!in_array($tmpCat , $_Categories)){
									$_Categories[] = $tmpCat;
								}
								// Se obtiene el precio mayor de todos los hoteles
								if((float)$_h->attributes()->minAverPrice > $MaxPrice && (float)$_h->attributes()->minAverPrice != 99999999){
									$MaxPrice = (float)$_h->attributes()->minAverPrice;
								}
								// Se obtiene el precio menos de todos los hoteles
								if((float)$_h->attributes()->minAverPrice < $MinPrice){
									$MinPrice = (float)$_h->attributes()->minAverPrice;
								}
                                                                
                                if((float) $_h->attributes()->starsLevel > $starsLevel){
									$starsLevel = (float) $_h->attributes()->starsLevel;
								}
								if(!in_array(substr((string) $_h->attributes()->starsLevel,0,1),$_starsLevel)){
									$_starsLevel[]=substr((string) $_h->attributes()->starsLevel,0,1);
								}
						
				?>


				<div class='boxbloque OptionHotel MainHotelOption'  >
					
					<!-- INFORMACION DEL HOTEL -->
					<article class='elementList list-item OptionResult' id='Hotel_<?php echo $_h->attributes()->hotelId;?>'>
						
						<!-- Fotografía del Hotel -->
						<div class='hotelPhoto galeriaHotel miniPhoto' id="" data-element="<?php echo $elementList; ?>">
							<ul class="rslides">
			    				<!--<img class="full-width" src='<?php echo $_h->attributes()->thumb; ?>' alt='<?php echo utf8_decode($_h->attributes()->name); ?>' />-->
								<?php
								$i=0;
								foreach($_h->Media->Images->Image as $_i){
									if($i<5){?>
									<li class="nailthumb-container square-thumb"><img src="//xtstatic.lomastravel.com.mx/image/440/<?php echo $_i['path'];?>" /></li>
								<?php }
								$i++;
								}?>
							</ul>
						</div>
						
						<!-- Datos del Hotel -->					
						<div class='hotelContent elementData'>
							<div class="title elementName">
								<?php if((float)$_h->attributes()->minAverPrice == 99999999 || (float)$_h->attributes()->minAverPrice == 0){ ?>
									<a  href='<?php echo $this->createUrl('hoteles/detalle', array('hotel' => $_h->attributes()->hotel_keyword) );?><?=$_getPrecioMax?>' title='<?php echo $_h->attributes()->name; ?>'><span class="titleHotel"><div style="display:none">z</div><?php echo Yii::app()->GenericFunctions->makeSinAcento($_h->attributes()->name); ?><span></a>
								<?}else{?>
									<a  href='<?php echo $this->createUrl('hoteles/detalle', array('hotel' => $_h->attributes()->hotel_keyword) );?><?=$_getPrecioMax?>' title='<?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($_h->attributes()->name)); ?>'><span class="titleHotel"><?php echo Yii::app()->GenericFunctions->makeSinAcento($_h->attributes()->name); ?><span></a>
								<?}?>
								<br/>
								<? if($_h->attributes()->tripAd_calificacion!=""){?>
									<img src="//www.tripadvisor.com.mx/img/cdsi/img2-daodao/branding/daodao21x12-14894-5.png"/>
									<small style="color: #237b30; font-weight: bold"><?php echo $_h->attributes()->tripAd_calificacion; ?></small><small style="color: #237b30;font-size: 12px">/5 Based on <?=$_h->attributes()->tripAd_comentarios;?> opinions</small>
								<?}?>
							</div>
									
							<p class="desc descHotel elementDesc"><?php echo $_h->attributes()->desc; ?></p>
							<span class="smallLetter">
								<a href='<?php echo $this->createUrl('destinations/detalle', array('hotel' => $_h->attributes()->hotel_keyword) );?><?=$_getPrecioMax?>' title='More information'><?php echo Yii::t("global","Más información"); ?></a>
							</span>
							
							<?
							if(count($categoryH)>1){
								foreach($categoryH as $cH){?>
									<p class="theme block">
										<span class="<?php echo Yii::app()->GenericFunctions->makeUrl(strtolower($cH));?>"><?php echo $cH; ?></span>
									</p>									
								<?}
							}else{?>
								<p class="theme block">
									<span class="<?php echo Yii::app()->GenericFunctions->makeUrl(strtolower($_h->attributes()->category));?>"><?php echo $_h->attributes()->category; ?></span>
								</p>								
								
							<?}?>

							<p class="keywords">
								<?php 
									foreach ($plan_meals as $planm){ ?>
										<span><?php echo $planm; ?></span>
								<?php } ?>
							</p>


                    	</div>
								
                    	
                    	<!-- Book del Hotel -->
                    	<div class='elementTax'>
                    		
                            <?php								
						    	$_pPromoH = array("hasPromo" => false,	"promoLabel" => "");
								$_x = $_h->RoomType;
								foreach($_x as $_r2){
									$Price2 = $_r2->Occup;
									//Ezequiel Glez
									if($Price2->Discount->Promotion){
										foreach($Price2->Discount->Promotion as $_b){
											if($_b->attributes()->type == 1){
												$_pPromoH = array("hasPromo" => true, "promoLabel" => "Free Night(s)");
											}
											if($_b->attributes()->type == 2){
												$_pPromoH = array( "hasPromo" => true, "promoLabel" => number_format((int)$_b->attributes()->value,0) . "% OFF");
											}
											if($_b->attributes()->type == 3){
												$_pPromoH = array( "hasPromo" => true, "promoLabel" => "Added Value");
											}
											if($_b->attributes()->type == 4){
												$_pPromoH = array("hasPromo" => true,	"promoLabel" => "Special Price",);
											}
										}
									}
								}
							?>

							<?php 
								if($_pPromoH["hasPromo"]){ ?>
									<div class=' red imgValorAgregado'>
										<span class = "promoHotel"><?php echo $_pPromoH["promoLabel"]; ?></span>
									</div>
							<?php } else{?>
								<span class = "promoHotel"> </span>
							<? } ?>
							<?
							$nivel_star = (float)$_h->attributes()->starsLevel;
							$star_ctagory = array(7=>"Boutique",8=>"Gran Turismo", 9=>"Categoría Especial");
							if((float)$_h->attributes()->starsLevel>6){
								$nivel_nombre = $star_ctagory[(float)$_h->attributes()->starsLevel];
								echo "<p class='categoria_ext' style='display:none;'>".$nivel_nombre."</p>";
							}
							if((float)$_h->attributes()->starsLevel<=6){
							?>
								<p class="stars"><?php echo $nivel_star;?></p>
							<?}else{?>
								<p class="stars"><?php echo 6;?></p>
							<?}?>
							
							<div class="elementCategory"><?php echo Yii::app()->GenericFunctions->makeStars((float)$_h->attributes()->starsLevel); ?></div>

							<?php if((float)$_h->attributes()->minAverPrice == 99999999 || (float)$_h->attributes()->minAverPrice == 0){ ?>
									<div class="elementPrice notAvailable">
										Hotel not available in the selected dates, please change your dates or contact our call center:<br/> 414-755-0592
										<p class="price"></p>
									</div>
							<?php }else{ ?>
									<div class="elementPrice">
										<p class="price"><?php echo number_format($totalAVG,0); ?></p>
										<p class="priceTotal"><?php echo number_format((float)$total,0); ?></p>
										<span class='currency_code'><?php echo Yii::app()->params['Moneda']; ?></span> $ <?php echo number_format((float)$_h->attributes()->minAverPrice,0); ?>
									</div>
							
									<div class="elementPriceInfo">
										Average per night<br/>Taxes included
									</div>
								
									<div class="elementBook">
										<a class='book curved misc_select_btn_green' href='<?php echo $this->createUrl('destinations/detalle', array('hotel' => $_h->attributes()->hotel_keyword) );?><?=$_getPrecioMax?>' title='BOOK'>BOOK</a>
									</div>
							<?php } ?>


							<?php
								$_Rooms = $_h->RoomType;
								$i=0;
								$x = 1;
								foreach($_Rooms as $_r){
									$Price = $_r->Occup;
									//Ezequiel Glez
									//$avgPerNight = (float) $Price->attributes()->avrNightPrice;
									//$total = (float) $Price->attributes()->price;
									//$ocupid = (string) $Price->attributes()->occupId;
									/*if($x != 3){
										$mPlan = array("!price"=>0,"!bbId"=>0);
										$x = $x + 1;
										if(isset($Price->Board)){
											if(!in_array(utf8_decode($Price->Board->attributes()->name),$MealPlans)){
												array_push($MealPlans,utf8_decode($Price->Board->attributes()->name));
												$mPlan = array("!price"=>$Price->Board->attributes()->price,"!bbId"=>$Price->Board->attributes()->bbId);	
											}
											if(!in_array(utf8_decode($Price->Board->attributes()->name),$_MealsPlan)){
												array_push($_MealsPlan,utf8_decode($Price->Board->attributes()->name));																
											}
										}
									}*/
								}
							?>

						</div>

                    </article>
                    <!-- FIN INFORMACION DEL HOTEL -->
                </div>
                

				<?php   
                   				$Htl["MealPlans"] = $MealPlans;
								array_push($Htls,$Htl);
								$elementList++;
							}
							//Fin del foreach
							
							$_SESSION["HotelSearch"][$_Cr]["Hotels"] = $Htls;

					/* Si solo hay 1 hotel */
					}elseif(sizeof($_Htls) > 1){
						$_h = $_Htls;
					}
				?>
		
			</div>
        	<!-- FIN DE LISTADO DE HOTELES-->

        	
        	<!-- Paginacion -->
        	<div class="jplist-panel box panel-top">
				<div class="pagination">
				    <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-mode="google-like" data-range="5"></div>
		        </div>
		   </div>

		
			<!-- NO- Results -->
			<div class="box jplist-no-results text-shadow align-center">
				<p>No results found</p>
			</div>
			<?
				if(intval($_GET['price_max'])>0){
					$MaxTotalPrice = intval($_GET['price_max']);
				}
			?>				

			<div id="minPrice"><?php  echo $MinPrice; ?></div> 
	    	<div id="maxPrice"><?php  echo $MaxPrice; ?></div>
	    	<div id="minTotalPrice"><?php  echo 0; ?></div> 
	    	<div id="maxTotalPrice"><?php  echo $MaxTotalPrice; ?></div>	    	

    	</section>

	</div>    





<?php
	}else{
?>	
	<!-- Listado y Filtros para busqueda de hoteles -->
	<div id="hotelsLF" class="contentSide box jplist">
		
		<section id="hotel_search_results" class="rightSide">
			<div class="bloque">
				<div class="bloque" id="hotel_search_results">
					<h4 class="generic_element_h2_gray">
						<span id="hotelsResult">0</span> <?= Yii::t("global","Hotel(s) founds"); ?>
					</h4>
			
					<h4 class="generic_element_h2_gray" style="font-size: 15px;">
						<span><?= Yii::t("global","Habitaciones"); ?></span>			
						<?= sizeof(Yii::app()->_Hotels->Config["Rooms"]); ?>
						-
						<span><?= Yii::t("global","Destino"); ?></span>			
						<?= $_REQUEST["hotel_destination"]; ?>
						-
						<span><?= Yii::t("global","Entrada"); ?></span>			
						<?= Yii::app()->GenericFunctions->convertPresentableDates(Yii::app()->_Hotels->Config["Dates"]["CheckIn"]); ?>			
						-
						<span><?= Yii::t("global","Salida"); ?></span>
						<?= Yii::app()->GenericFunctions->convertPresentableDates(Yii::app()->_Hotels->Config["Dates"]["CheckOut"]); ?>												
					</h4>

					<?php
						$hab = 1;
						foreach(Yii::app()->_Hotels->Config["Rooms"] as $Room){
					?>

					<h4 class="generic_element_h2_gray" style="font-size: 15px;">
						<span><?= Yii::t("global","Habitación"); ?>. </span><?= $hab; ?>
						-
						<span><?= Yii::t("global","Adulto|Adultos",$Room["Adults"]); ?> </span><?= $Room["Adults"]; ?>
						-
						<span><?= Yii::t("global","Menor|Menores",$Room["Childs"]); ?> </span><?= $Room["Childs"]; ?>
						<?php
							if($Room["Childs"] > 0){
						?>
							-
							<span><?= Yii::t("global","Edades Menores"); ?>:</span>
						<?php
								foreach($Room["ChildAges"] as $ch){
									echo $ch . ", ";
								}
							
							}
						?>
					</h4>

					<?php $hab++; } ?>	
				</div>
				<div class="bloque" style="padding: 7px;"></div>
				<div class="no_results">
					<img src="/img/no_results_display.png" alt="" />
				</div>
			</div>
		</section>
	</div>
	<?php } ?>
		
						


	
</div>
<!-- FIN -->


<script type="text/javascript">
	<?php
		$RoomInfo = Yii::app()->_Hotels->Config["Rooms"];
		if(!isset($RoomInfo[0])){
			$RoomInfo = array(
				0 => Yii::app()->_Hotels->Config["Rooms"],
			);
		}
	?>
	var HotelRoomsInfo = <?= json_encode( $RoomInfo ); ?>;
	//populateBookingBoxHoteles(0);
	var cat = "<?= $_GET["cat"]; ?>";
	var cat2 = "<?= $_GET["cat2"]; ?>";
	var cat3 = "<?= $_GET["cat3"]; ?>";
	var filterSomething = false;
$(function(){
	

	$("#showMapHotels").click(function(){
		$("#pagination_product").hide();
		updateResults();
		
		if(isMapDisplayed){
			isMapDisplayed = false;
			$(this).removeClass("active");
			$("#map_container").hide();
			$("#ajaxHotelResults").show();
		}else{
			isMapDisplayed = true;
			$(this).addClass("active");
			$("#map_container").show();
			$("#ajaxHotelResults").hide();
			
		}
		$.facebox.close();
		
		return false;
	});
	
	$(".search_name_cat_url").each(function(){
		var txt = $(this).text();
		var padre = $(this.parentNode);
		if(txt == cat || txt == cat2 || txt == cat3){
			filterSomething = true;
			$("input",padre).attr("checked","checked");				
		}
	});
	if(filterSomething){
		updateResultsHotel();
	}
	
	
   jQuery.fn.jplist.settings = {
      
      /**
      * LIKES: jquery ui range slider
      */
      starsSlider: function ($slider, $prev, $next){

        $slider.slider({
          min: 0
          <? if($starsLevel>6) $starsLevel=6;?>
          ,max: <?=$starsLevel?>
          ,range: true
          ,values: [0, <?=$starsLevel?>]
          ,slide: function (event, ui){
            $prev.text(ui.values[0] + ' stars');
            $next.text(ui.values[1] + ' stars');
          }
        });
      }
      
      /**
      * LIKES: jquery ui set values
      */
      ,starsValues: function ($slider, $prev, $next){
        $prev.text($slider.slider('values', 0) + ' stars');
        $next.text($slider.slider('values', 1) + ' stars');
      }
      
      /**
      * PRICES: jquery ui range slider
      */
      ,pricesSlider: function ($slider, $prev, $next){
        var minimo = parseInt(Math.round($('#minPrice').html()));
        var maximo = parseInt(Math.round($('#maxPrice').html()));
        var resta  = maximo - minimo;
        $slider.slider({
          min: 0
          ,max: maximo
          ,range: true
          ,values: [0, maximo]
          ,slide: function (event, ui){
            $prev.text('$' + ui.values[0]);
            $next.text('$' + ui.values[1]);
          }
        });
      }     
      ,pricesTotalSlider: function ($slider, $prev, $next){
        var minimo = parseInt(Math.round($('#minTotalPrice').html()));
        var maximo = parseInt(Math.round($('#maxTotalPrice').html()));
        var resta  = maximo - minimo;
        $slider.slider({
          min: 0
          ,max: maximo
          ,range: true
          ,values: [0, maximo]
          ,slide: function (event, ui){
            $prev.text('$' + ui.values[0]);
            $next.text('$' + ui.values[1]);
          }
        });
      } 


      /**
      * PRICES: jquery ui set values

      */
      ,pricesValues: function ($slider, $prev, $next){

        $prev.text('$' + $slider.slider('values', 0));
        $next.text('$' + $slider.slider('values', 1));
      }
      
      /**
      * VIEWS: jquery ui range slider
      */
      ,tripAdvisorSlider: function ($slider, $prev, $next){

        $slider.slider({
          min: 0
          , max: 4000
          , range: true
          , values: [0, 4000]
          , slide: function (event, ui) {
            $prev.text(ui.values[0] + ' views');
            $next.text(ui.values[1] + ' views');
          }
        });
      }

      /**
      * VIEWS: jquery ui set values
      */
      ,tripAdvisorValues: function ($slider, $prev, $next){
        $prev.text($slider.slider('values', 0) + ' views');
        $next.text($slider.slider('values', 1) + ' views');
      }
    };	
});	
	
	$( "#slider-price" ).slider({
		range: "min",
		value: "<?= $MaxPrice; ?>",
		//value: 1500,
		min: "<?= $MinPrice; ?>",
		max: "<?= $MaxPrice; ?>",
		slide: function( event, ui ) {			
			$( "#maxPrice" ).val( ui.value );
			$( "#currentPrice" ).html("$" + CommaFormatted(CurrencyFormatted(ui.value)) );
		},
		change: function( event, ui ) {
			updateResults();
			$( "#maxPrice" ).val( ui.value );
			$( "#currentPrice" ).html("$" + CommaFormatted(CurrencyFormatted(ui.value)) );
		}
	});
	
	
	function btnsViewPromotionResult(){
		$(".display_more_info_hab").unbind("click");
		$(".display_more_info_hab").bind("click");
		$(".display_more_info_hab").click(function(){
			if($(this).hasClass("show_more_info_hab")){
				var habId = $(this).attr("rel");
				
				$("span",$(".display_more_info_hab")).html(_view_more_);
				$(".display_more_info_hab").removeClass("hide_more_info_hab");
				$(".display_more_info_hab").addClass("show_more_info_hab");
				
				$(this).removeClass("show_more_info_hab");
				$(this).addClass("hide_more_info_hab");
				$("span",$(this)).html(_hide_);
				$(".tr_hab_more_info").hide();
				$(this.parentNode.parentNode.parentNode).next().show();
			}else{
				$("span",$(".display_more_info_hab")).html(_view_more_);
				$(".display_more_info_hab").removeClass("hide_more_info_hab");
				$(".display_more_info_hab").addClass("show_more_info_hab");
				
				
				$(this).removeClass("hide_more_info_hab");
				$(".tr_hab_more_info").hide();			
			}
			
			return false;
		});
	}
	
	
	function updateResultsHotel(){
		alert("RESULTS HOTEL");
		jQuery.facebox(function(){
			var data = "";
			$.get("/site/searching.html",{},function(data){
				$.facebox(data);
				
			});
		});
		
		
		//$(".MainHotelOption").hide();
		$("#pagination_product").hide();
		
		var id = $("#sorterBy").val();
		var Data = $("#HotelFilters").serialize();
		Data += "&token=" + searchToken + "&Order=" + id; 
		$.getJSON(hotelsOrderingXML,Data,function(hotels){
			$(".MainHotelOption").hide();
			$("#ajaxHotelResults").empty().removeClass("whileSearch")
			$("#hotelsResult").html(hotels.Results);
			btnsViewPromotionResult();
			
			if(hotels.Results == 0){
				$(".no_results").style("display: block;");
			}else{
				$(".no_results").style("display: none !important;");
			}
			
			$.facebox.close();
			$.each(hotels.Hotels, function(z,hotel){
				var xHTML = $("#Hotel_" + hotel.Id).html();
				$("#ajaxHotelResults").append("<div class='bloque OptionHotel'>" + xHTML + "</div>");
				
				
				
				$(".hotelRoomsTable .misc_select_btn_blue").unbind("click");
				$(".hotelRoomsTable .misc_select_btn_blue").bind("click");
				$(".hotelRoomsTable .misc_select_btn_blue").click(function(){				
					
					$("form",this.parentNode.parentNode).submit();
					
					return false;
				});
				
				$(".hotelRoomsTable .btnGreenSbmt").unbind("click");
				$(".hotelRoomsTable .btnGreenSbmt").bind("click");
				$(".hotelRoomsTable .btnGreenSbmt").click(function(){				
					$("form",this.parentNode.parentNode.parentNode).submit();
					
					return false;
				});
				
			});
	
		});
		
	}
	
	
	function updateResultsHotelNoFacebox(){
		
		//$(".MainHotelOption").hide();
		$("#pagination_product").hide();
		
		var id = $("#sorterBy").val();
		var Data = $("#HotelFilters").serialize();
		Data += "&token=" + searchToken + "&Order=" + id; 
		$.getJSON(hotelsOrderingXML,Data,function(hotels){
			$(".MainHotelOption").hide();
			$("#ajaxHotelResults").empty().removeClass("whileSearch")
			$("#hotelsResult").html(hotels.Results);
			btnsViewPromotionResult();
			
			if(hotels.Results == 0){
				$(".no_results").style("display: block;");
			}else{
				$(".no_results").style("display: none !important;");
			}
			
			$.each(hotels.Hotels, function(z,hotel){
				var xHTML = $("#Hotel_" + hotel.Id).html();
				$("#ajaxHotelResults").append("<div class='bloque OptionHotel'>" + xHTML + "</div>");
				
				
				
				$(".hotelRoomsTable .misc_select_btn_blue").unbind("click");
				$(".hotelRoomsTable .misc_select_btn_blue").bind("click");
				$(".hotelRoomsTable .misc_select_btn_blue").click(function(){				
					
					$("form",this.parentNode.parentNode).submit();
					
					return false;
				});
				
				$(".hotelRoomsTable .btnGreenSbmt").unbind("click");
				$(".hotelRoomsTable .btnGreenSbmt").bind("click");
				$(".hotelRoomsTable .btnGreenSbmt").click(function(){				
					$("form",this.parentNode.parentNode.parentNode).submit();
					
					return false;
				});
				
			});
	
		});
		
	}


	$(document).ready(function() {
  
		  $('.jfilterHotel').on('click',function (argument) {
		    var action  = $(this).data('action');
		    $('#controlSortHotels').val(action).change();
		  });
		  
		  $(".rslides").responsiveSlides({
		    auto:true,
		    speed: 1000,
		    prevText: "Previous",
		    nextText: "Next", 
		    nav:true,
		  });

		  $('#hotelsLF').jplist({       
		    itemsBox: '.list', 
		    itemPath: '.list-item',
		    panelPath: '.jplist-panel',
		    effect: 'fade',
		  });

		});
	
</script>
</div>
</div>
	
