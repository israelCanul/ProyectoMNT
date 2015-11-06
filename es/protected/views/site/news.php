<div class="row">
	<div class="col s12 m10 offset-m1">
		<h5 class="center-align card-panel">Noticias</h5>
	</div>
</div>

<div class="row">
		<div class="col s12 m10 offset-m1 l11 offset-l1 news-panel grid" >
<?		if(count($notas)>0){
			foreach ($notas as $key => $value) {

?>				<div class="col s12 m5 l3 item new" style="padding:10px;">
				<div class="card-panel  hoverable">
		            <div class="row"></div>
		            <div class="card-image">
		              <img data-caption="<?=$value['alt']?>" class="responsive-img " src="<?=Yii::app()->params['cdnNews'].$value['DATA']?>">
		              <span class="card-title"><?=$value['alt']?></span>
		            </div>
		            <div class="card-content">
						<a class="black-text " target="_blank" href="<?=Yii::app()->params['news'].$value['uri']."/"?>"><h5><?=$value['titulo']?></h5></a>
						<p><?=$value['meta_description']?></p>
		            </div>
		            <div class="card-action">
		              <a class="blue-text text-darken-2" target="_blank" href="<?=Yii::app()->params['news'].$value['uri']."/"?>">Leer Más</a>
		            </div>
		        </div>
		        </div>
<?       }
			}
?>
		</div>			
</div>

<!-- Footer de la seccion con el cambio de la imagen y las notas son las mismas  -->
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#txtBanner").html("BEST FAMILY FRIENDLY VACATIONS");
		$("#txtBanner1").html("-ANYWHERE-");
	});
</script>