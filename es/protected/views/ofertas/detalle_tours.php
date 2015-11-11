
<div class="row">
<?php 
if($p["promocion_archivo_" . Yii::app()->language] != ""){ 
	
?>
	<div class=" col s12 m10 offset-m1 promo-full-div-image">
		<img class="responsive-img" src="<?php echo $p["promocion_archivo_" . Yii::app()->language]; ?>" />
	</div>
	

<?php 
}

?> 

<div class=" col s12 m10 offset-m1 bloque normal_left">
	
    <div class="bloque" style="padding: 10px 0px;">
    <?php
    	if($p["promocion_desc_left_" . Yii::app()->language] != ""){
			echo "<div class='col s12 m10 offset-m1  bloque'>" .$p["promocion_desc_left_" . Yii::app()->language] . "</div>";
		}
    ?>
    </div>
    
</div>


<div class=" row ">

<?php 

if($p["promocion_aplica_descripcion"] == 1){
	echo "<div class='col s12 m10 offset-m1  bloque promo-div-full-desc'>" . $p["promocion_desc_" . Yii::app()->language] . "</div>";
}
?> 

<div class="col s12 m10 offset-m1  listContainer">

<?php

// Agregado por Luis Caballero
// Lunes, 7 Abril 2014
// Se agrego el listado de los tours de rockstar porque la pagina no mostraba nada
	//$urlPag = explode("?",$_SERVER['REQUEST_URI']);
	//$urlPagina=$urlPag[1];
	if(sizeof($rows) > 0){
		foreach($rows as $r){
			//echo "<a href='" . $r["url"] . "' title=''><img src='" . $r["imagen"] . "' alt='' /></a> &nbsp;";

		?>
		

			<div class="elementList promotion_home_info_displayer">
				<div class="prod_home_content_info">
					<div class="miniPhoto">
						<a href='<?= $this->createUrl("tours/detalle", array("dest" => $r["destino_clave"], "prod" => $r["tour_clave"], "seg" => $_REQUEST["seg"])); ?>' title="<?= str_replace("&","&amp;",utf8_decode($r["nombre"]));  ?>" class="btn_img_tour_link_a">
							<img class="full-width"  src="//apstatic.lomastravel.com.mx/1000/<?= $r["foto"]; ?>"  alt="<?= str_replace("&","&amp;",utf8_decode($r["nombre"]));  ?>"  />
	                    
	                	</a>
                	</div>
					
					<div class="elementData">
						<div class="elementName">
							<a href='<?= $this->createUrl("tours/detalle", array("dest" => $r["destino_clave"], "prod" => $r["tour_clave"], "seg" => $_REQUEST["seg"])); ?>' title="<?= str_replace("&","&amp;",utf8_encode($r["nombre"])); ?>">
								<?=  utf8_encode($r["nombre"]); ?>
								<br />
							</a>
						</div>
						<p class="elementDesc"><?= str_replace("&","&amp;",substr($r["descripcion_corta"],0,120)) . "..."; ?></p>
						<span class="smallLetter"><?= Yii::t("global","Destino"); ?>: 
							<a class="misc_destination_info_home shadow" href='<?= "/tours/" . $r["destino_clave"]?>' title="Destino"><?= (string) utf8_encode($r["destino_nombre"]) ; ?></a>
						</span>
					</div>
					
					<div class="elementTax prices_form_div_home">
						<div class="elementPriceInfo">
							<span><?= Yii::t("global","desde"); ?></span>
						</div>
						<div class="elementPrice red-text">
							<span class="currency_code"><?php echo $_SESSION["config_es"]["currency"]; ?>$ <?=number_format((float)$r["tarifa"],0);?></span>
						</div>
						<div class="elementBook">
							<a class="book btn btn-large curved misc_select_btn_green" href='<?= $this->createUrl("activities/detalle", array("dest" => $r["destino_clave"], "prod" => $r["tour_clave"], "seg" => $_REQUEST["seg"])); ?>' title="<?php str_replace("&","&amp;",utf8_decode($r["nombre"])); ?>">
								BOOK	
							</a>	
						</div>
					</div>
					
				</div>	
				
			</div>	

			
		<?php
		 }
	}


// Fin de Agregado
?>
</div>

</div>