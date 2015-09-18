<script type="text/javascript">
	var hotelsOrderingXML = "<?= $this->createUrl('hoteles/ordenacion'); ?>";
	var searchToken = "<?= $_Cr; ?>";
</script>


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
	<!-- Informacion de la reserva -->
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

	<!-- Informacion de los hoteles encontrados y de las fechas de reserva -->
	<h1 class="infoResult"> 
		<span id="hotelsResult"><?php echo sizeof($_Htls[0]->Hotel);?></span> Hotels in <?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($locacion)); ?> 
		<div class="fluid">
			on <?php echo date('D, M d', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckIn"])); ?> &nbsp;-&nbsp; 
		 	<?php echo date('D, M d', strtotime(Yii::app()->_Hotels->Config["Dates"]["CheckOut"])); ?>
		 </div>
	</h1>


	<?  //informacion de los huespedes por habitacion
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
	
	<?
			$hab++;
		}
	?>	







<? }else{ ?>	
	
	

	<?}?>
</div>
<!-- FIN -->


