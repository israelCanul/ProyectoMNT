<ul id="breadCrumb" class="right hide-on-med-and-down">
	<?php
	$lastCrumb = array_pop($this->crumbs);
	foreach ($this->crumbs as $crumb) {
		if (isset($crumb['url'])  && !$isLastCrumb) {
			echo '<li>'.CHtml::link($crumb['name'],$crumb['url'], array('class'=>'purple-text text-darken-5 zoom-size')).'</li>';
		} else {
						print_r("expression");
			echo $crumb['name'];
		}
		if (next($this->crumbs)) {
			echo $this->delimiter;
		}
	}
	echo $lastCrumb['name'];
	?>
</ul>