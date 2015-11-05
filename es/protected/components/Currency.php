<?php
class Currency extends CApplicationComponent{

	public $actualCurrency = "USD";
	public $availCurrencies = array("MXN","USD","EUR");
	
	
	
	public function convert($to,$amount){
		$moneda =  Yii::app()->dbWeblt->createCommand()
				->select("*")
				->from('monedas')
				->where('moneda_id = 1')
				->queryRow();			
		$eRate = array();
		$eRate["USD"] = array();
		$eRate["USD"]["MXN"] = $moneda['moneda_cambio'];
		$eRate["USD"]["EUR"] = 0.72838517;
		$eRate["USD"]["USD"] = 1;
		
		$converted = $amount * $eRate["USD"][$to];
		$converted = number_format($converted,2,".","");
		
		return $converted;
			
	}
	
	public function convertMXN($to, $amount)
	{
		$moneda =  Yii::app()->dbWeblt->createCommand()
				->select("*")
				->from('monedas')
				->where('moneda_id = 1')
				->queryRow();		
		$eRate = array();
		$eRate["MXN"] = array();
		$eRate["MXN"]["MXN"] = 1;
		$eRate["MXN"]["EUR"] = 0.72838517;
		$eRate["MXN"]["USD"] =  $moneda['moneda_cambio'];

		$converted = $amount / $eRate["MXN"][$to];
		$converted = ceil($converted);
		return $converted;
	}
	
}
?>
