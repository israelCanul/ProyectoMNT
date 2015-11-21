<?php
/* @var $this SiteController */
/* @var $error array */
if(isset($_REQUEST['error']) && $_REQUEST['error']!=''){
$this->pageTitle=$_REQUEST['error'] . ' - Error'; 
$error=$_REQUEST['error'];
?>

<div class="row">
	<div class="col s10 offset-s1">			
		<br>
		<h3 class="center-align"><?=$error?></h3>
	</div>
	<div class="col s10 offset-s1">
		<br>			
		<h4 class="center-align">Oops, sorry about that...</h4>
	</div>
	<div class="col s10 offset-s1">
	<br>			
		<h5 class="center-align">Go back to the <a class="red-text" href="/">home</a> or use the menu on top.</h5>
	</div>		  	
</div>

<?
}else{

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">

<?php 

echo CHtml::encode($message); ?>
</div>
<?

}

?>