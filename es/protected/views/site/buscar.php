<div class="row">
	<div class="col s12 m10 offset-m1">
		<div class="col s12 "><br></div>
		<h3>Resultados de <?=$_REQUEST['word_search']?></h3>
		<? //print_r($resultados);?>
		
	        <!-- <li class="collection-header"><h4>First Names</h4></li>
	        <li class="collection-item">Alvin</li> -->
	       <ul class="collection with-header">

	        <?
	        if(count($resultados['destinos'])>0){
	        	echo '<li class="collection-header"><h4 class="red-text">Destinos</h4></li>';
		        foreach ($resultados['destinos'] as $key => $value) {
		        	echo '<li class="collection-item col s12" style="padding: 5px;"><div><a href="'.$value["url"].'"  target="_blank">'.$value["label"].'</a><a href="'.$value["url"].'" target="_blank" class="secondary-content"><i class="material-icons">send</i></a></div></li>'; 
		        }
	    	}
	        if(count($resultados['hoteles'])>0){
	        	echo '<li class="collection-header col s12"><h4 class="red-text">Hoteles</h4></li>';
		        foreach ($resultados['hoteles'] as $key => $value) {
		        	echo '<li class="collection-item col s12" style="padding: 5px;"><div><a href="'.$value["url"].'"  target="_blank">'.$value["label"].'</a><a href="'.$value["url"].'"  target="_blank" class="secondary-content"><i class="material-icons">send</i></a></div></li>'; 
		        }
	    	}
	        if(count($resultados['tours']['dest'])>0){
	        	echo '<li class="collection-header col s12"><h4 class="red-text">Tours - Destinos</h4></li>';
		        foreach ($resultados['tours']['dest'] as $key => $value) {
		        	echo '<li class="collection-item col s12" style="padding: 5px;"><div><a href="'.$value["url"].'"  target="_blank">'.$value["label"].'</a><a href="'.$value["url"].'"  target="_blank" class="secondary-content"><i class="material-icons">send</i></a></div></li>'; 
		        }
	    	}
	        if(count($resultados['tours']['tour'])>0){
	        	echo '<li class="collection-header col s12"><h4 class="red-text">Tours - Tour</h4></li>';
		        foreach ($resultados['tours']['tour'] as $key => $value) {
		        	echo '<li class="collection-item col s12" style="padding: 5px;"><div><a href="'.$value["url"].'"  target="_blank">'.$value["label"].'</a><a href="'.$value["url"].'"  target="_blank" class="secondary-content"><i class="material-icons">send</i></a></div></li>'; 
		        	
		        }
	    	}
	        if(count($resultados['tours']['cat'])>0){
	        	echo '<li class="collection-header col s12"><h4 class="red-text">Tours - Categoria</h4></li>';
		        foreach ($resultados['tours']['cat'] as $key => $value) {
		        	echo '<li class="collection-item col s12" style="padding: 5px;"><div><a href="'.$value["url"].'"  target="_blank">'.$value["label"].'</a><a href="'.$value["url"].'"  target="_blank" class="secondary-content"><i class="material-icons">send</i></a></div></li>'; 
		        	
		        }
	    	}	    	
	        if(count($resultados['tours']['sup'])>0){
	        	echo '<li class="collection-header col s12"><h4 class="red-text">Tours - Proveedor</h4></li>';
		        foreach ($resultados['tours']['sup'] as $key => $value) {
		        	echo '<li class="collection-item col s12" style="padding: 5px;"><div><a href="'.$value["url"].'"  target="_blank">'.$value["label"].'</a><a href="'.$value["url"].'"  target="_blank" class="secondary-content"><i class="material-icons">send</i></a></div></li>';  
		        }
	    	}		    		    		    	
	        ?>
	        </ul>
      	
	</div>
</div>