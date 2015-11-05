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
						       		<img class="stars" src="/img/icons/prod_star.jpg" alt="stars">
								<?php 
									}
								}
								?>
				       		</h6>

				      		<div class="jplist-range-slider" data-control-type="range-slider" data-control-name="range-slider-stars"  data-control-action="filter" data-path=".stars" data-slider-func="starsSlider" data-setvalues-func="starsValues">
								<div class="ui-slider" data-type="ui-slider"></div>
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
	         						<input value="<?php echo strtolower($_mPlan);?>" id="<?php echo strtolower($_mPlan);?>" type="checkbox" />
	         						<span><?php echo ucwords($_mPlan);?></span>
	         					</div>
	         				<?php } ?>
	        				</div>
	   					</div>
				
					</form>
				</div>
			</div>

			<?php } ?>