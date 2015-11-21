<?			/* enviar las trending notes de Mexico news en la seccio9n de travel*/
		$notasFooter=Yii::app()->GenericFunctions->notasFooter();?>
	<div class="row hide-on-med-and-down">
		<div class="col 12">
			<?
			//notas de la pagina http://www.mexiconewsnetwork.com/travel/
			if(count($notasFooter)>0){
				foreach ($notasFooter as $key => $value) {
					/*print_r($value);
					exit();*/
					?>
					<div class="col s12 m3 wrap_new" id="wrap_new_<?=$key?>">
						<div class="card transparent  new" data-key="<?=$key?>">
							<div class="card-content black-text">
								<span class="card-title black-text"><a target="_blank" class="black-text" href="<?=Yii::app()->params['news'].$value['uri']."/"?>"><?=$value['titulo']?></a></span>
								<div class="col s12  <? if($key==0){ echo "animated fadeInleft";}else{ echo "line_new"; }?> line_news" id="wrap_line_<?=$key?>" style="height: 5px;"></div>
								<p class="card-contenido"><?=$value['meta_description']?></p>
								<a target="_blank" class="blue-text text-darken-2" href="<?=Yii::app()->params['news'].$value['uri']."/"?>">Leer Más</a>
							</div>

						</div>

					</div>

					<?
				}
			}
			?>

		</div>
	</div>