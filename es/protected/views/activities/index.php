<div class="row">
	<div class="row">
		<div class="col s12 m10 offset-m1">
			<h5 class="center-align card-panel">Actividades por destino</h5>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m10 offset-m1">
		  	<?php foreach($_destinos as $_destino): ?>

	  			<?php if($_destino->getEnLista()){ ?>
					<div class="small col s12 m6 l4 " style=" height: 350px;overflow: hidden;">
			          <div class="card-destinos">
				          <div class="card ">
				            <div class="card-image hoverable">
				          		<img src="<?php echo Yii::app()->params['cdnLomas'] ?>/img/destinations/<?php echo strtolower($_destino->getClave());?>.jpg" alt="<?php echo $_destino->getNombre();?>">
				              	<span class="card-title"></span>
				            </div>
				            <div class="card-content card-action hoverable contenidoDestinos">
				              <a title="<?php echo $_destino->getNombre();?>" href="/es/toursByDest/<?php echo $_destino->getClave();?>.html?isTourCategory=0&amp;tour_destination=<?php echo  urlencode($_destino->getNombre());?>&amp;tipo=destination&cat=&dest=<?php echo $_destino->id;?>&TourId=&sup=&openTk=0&seg=&tour-Checkin=<?echo urlencode(date('m/d/Y', strtotime('+2 day'))); ?>&tour_adults=2&tour_child=0&action=&lan=en&moneda=USD">
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
			<h5 class="center-align card-panel">Actividades por Categoría</h5>
		</div>
	</div>	 
	<div class="col s12 m10 offset-m1">
		<div class="row" >
		<?
			$lista=0;
		?>
			<?php foreach ($_categorias as $_categoria):?>
				<?php if($_categoria->getEnLista() && $lista<9){ ?>
					<div class="small col s12 m6 l4 " style="height: 350px;overflow: hidden;">
			          <div class="card-destinos">
				          <div class="card ">
				            <div class="card-image hoverable">
				          		<img src="<?php echo Yii::app()->params['cdnLomas'] ?>/img/activities/interest/<?php echo $_categoria->getImagen();?>" alt="<?php echo $_categoria->getNombre();?>" />
				              	<span class="card-title"></span>
				            </div>
				            <div class="card-content card-action hoverable contenidoDestinos">
				              <a  title="<?php echo $_categoria->getNombre();?>" href="/es/toursByCat/Category.html?tour_destination=<?php echo urlencode($_categoria->getNombre());?>&tipo=category&cat=<?=$_categoria->getId(); ?>&dest=&TourId=&sup=&openTk=0&seg=&tour-Checkin=<?echo urlencode(date('m/d/Y', strtotime('+2 day'))); ?>&tour_adults=2&tour_child=0&action=&lan=en&moneda=USD">
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
				      <div class="collapsible-header center-aling red-text"><div style="width:100%;position:relative" class="center-align red-text"><i class="large material-icons">zoom_in</i>Mostrar más</div></div>
				      <div class="collapsible-body">
						<?php foreach ($_categorias as $_categoria):?>
							<?php if($_categoria->getEnLista() && $lista>=9){ ?>
								<div class="small col s12 m6 l4 " style="height: 350px;overflow: hidden;">
						          <div class="card-destinos">
							          <div class="card ">
							            <div class="card-image hoverable">
							          		<img src="<?php echo Yii::app()->params['cdnLomas'] ?>/img/activities/interest/<?php echo $_categoria->getImagen();?>" alt="<?php echo $_categoria->getNombre();?>" />
							              	<span class="card-title"></span>
							            </div>
							            <div class="card-content card-action hoverable contenidoDestinos">
							              <a  title="<?php echo $_categoria->getNombre();?>" href="/es/toursByCat/Category.html?tour_destination=<?php echo urlencode($_categoria->getNombre());?>&tipo=category&cat=<?=$_categoria->getId(); ?>&dest=&TourId=&sup=&openTk=0&seg=&tour-Checkin=<?echo urlencode(date('m/d/Y', strtotime('+2 day'))); ?>&tour_adults=2&tour_child=0&action=&lan=en&moneda=USD">
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
		<div class="parallax "><img src="<?=Yii::app()->params['baseUrl']?>/images/bg/footer-activities.jpg"></div>
	</div>
</div>

<? $value=$notas2;?>
<div class="row hide-on-med-and-down">
	<div class="col 12">
	<? 
	//notas antes del footer de la pagina
	$this->renderPartial('application.views.partials.news_footer',array('notas2'=>$notas2)); ?>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#txtBanner").html("PRE-HISPANIC CITY OF CHICHEN-ITZA");
		$("#txtBanner1").html("");
	});
</script>