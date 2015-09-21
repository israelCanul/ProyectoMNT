<div class="row">
	<div class="row">
		<div class="col s12 m10 offset-m1">
			<h5 class="center-align card-panel">Activities by Destination</h5>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m10 offset-m1">
		  	<?php foreach($_destinos as $_destino): ?>
	  			<?php if($_destino->getEnLista()){ ?>
					<div class="small col s12 m6 l4 ">
			          <div class="card-destinos">
				          <div class="card ">
				            <div class="card-image hoverable">
				          		<img src="<?php echo Yii::app()->params['cdnLomas'] ?>/img/destinations/<?php echo strtolower($_destino->getClave());?>.jpg" alt="<?php echo $_destino->getNombre();?>">
				              	<span class="card-title"></span>
				            </div>
				            <div class="card-content card-action hoverable contenidoDestinos">
				              <a title="<?php echo $_destino->getNombre();?>" href="/activities/<?php echo $_destino->getClave();?>.html?isTourCategory=0&amp;tour_destination=<?php echo Yii::app()->GenericFunctions->makeUrl($_destino->getNombre());?>&amp;TourId=0">
				             	 <p class="center-align textoCaja red-text"><?=$_destino->getNombre()?></p>
				              </a>
				            </div>
				            <!-- <div class="card-action">
				              <a href="#">This is a link</a>
				            </div> -->
				          </div>
			          </div>
			        </div> 
	   			<?php } ?>
	  		<?php endforeach;?>
	  	</div>	
	</div>
	<div class="row">
		<div class="col s12 m10 offset-m1">
			<h5 class="center-align card-panel">Activities by Category</h5>
		</div>
	</div>	 
	<div class="col s12 m10 offset-m1">
		<div class="row" >
		<?
			$lista=0;
		?>
			<?php foreach ($_categorias as $_categoria):?>
				<?php if($_categoria->getEnLista() && $lista<=9){ ?>
					<div class="small col s12 m6 l4 ">
			          <div class="card-destinos">
				          <div class="card ">
				            <div class="card-image hoverable">
				          		<img src="<?php echo Yii::app()->params['cdnLomas'] ?>/img/activities/interest/<?php echo $_categoria->getImagen();?>" alt="<?php echo $_categoria->getNombre();?>" />
				              	<span class="card-title"></span>
				            </div>
				            <div class="card-content card-action hoverable contenidoDestinos">
				              <a  title="<?php echo $_categoria->getNombre();?>" href="/activities/Category.html?isTourCategory=<?=$_categoria->getId(); ?>&amp;tour_destination=<?= $_categoria->getClave(); ?>&amp;TourId=0">
				              <p class="center-align textoCaja red-text"><?=$_categoria->getNombre()?></p>
				              </a>
				            </div>
				          </div>
			          </div>
			        </div>


		 		<?php 
		 			} 
		 			$lista++;
		 		?>
			<?php endforeach;
			$lista=0;
			?>

			<div class="col s12">
				<ul class="collapsible" data-collapsible="accordion">
				    <li>
				      <div class="collapsible-header center-aling red-text"><div style="width:100%;position:relative" class="center-align red-text"><i class="large material-icons">zoom_in</i>Show More</div></div>
				      <div class="collapsible-body">
						<?php foreach ($_categorias as $_categoria):?>
							<?php if($_categoria->getEnLista() && $lista>=9){ ?>
								<div class="small col s12 m6 l3 ">
						          <div class="card-destinos">
							          <div class="card ">
							            <div class="card-image hoverable">
							          		<img src="<?php echo Yii::app()->params['cdnLomas'] ?>/img/activities/interest/<?php echo $_categoria->getImagen();?>" alt="<?php echo $_categoria->getNombre();?>" />
							              	<span class="card-title"></span>
							            </div>
							            <div class="card-content card-action hoverable contenidoDestinos">
							              <a  title="<?php echo $_categoria->getNombre();?>" href="/activities/Category.html?isTourCategory=<?=$_categoria->getId(); ?>&amp;tour_destination=<?= $_categoria->getClave(); ?>&amp;TourId=0">
							              <p class="center-align textoCaja red-text"><?=$_categoria->getNombre()?></p>
							              </a>
							            </div>
							          </div>
						          </div>
						        </div>


					 		<?php 
					 			}
					 			$lista++; 
					 		?>
						<?php endforeach;?>			      	
				      </div>
				    </li>			    
				</ul>
			</div>
		</div>
	</div>		

</div>
<!-- Footer de la seccion con el cambio de la imagen y las notas son las mismas  -->

<div class="row hide-on-med-and-down">
	<div class="col s10 offset-s1 parallax-container">
		<div class="parallax "><img src="<?=Yii::app()->params['baseUrl']?>/images/bg/home-plane-mexiconews.jpg"></div>
	</div>
</div>

<? $value=$notas2;?>
<div class="row hide-on-med-and-down">
	<div class="col 12">
		<?
		//notas de la pagina http://www.mexiconewsnetwork.com/travel/
		if(count($notas2)>0){
			foreach ($notas2 as $key => $value) {
				?>
				<div class="col s12 m3 wrap_new" id="wrap_new_<?=$key?>">
					<div class="card transparent  new" data-key="<?=$key?>" style="height:200px;">
						<div class="card-content black-text">
							<span class="card-title black-text"><?=$value['titulo']?></span>
							<div class="col s12  <? if($key==0){ echo "animated fadeInleft";}else{ echo "line_new"; }?> line_news" id="wrap_line_<?=$key?>" style="height: 5px;"></div>
							<p class="card-contenido"><?=$value['meta_description']?></p>
							<a target="_blank" class="blue-text text-darken-2" href="<?=Yii::app()->params['news'].$value['uri']."/"?>">Read More</a>
						</div>

					</div>

				</div>

				<?
			}
		}
		?>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#txtBanner").html("PRE-HISPANIC CITY OF CHICHEN-ITZA");
		$("#txtBanner1").html("");
	});
</script>