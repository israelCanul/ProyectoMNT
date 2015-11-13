<?php

	class PaymentGatewaySantander extends CApplicationComponent{
		public $idCompany = "4018";
		public $idBranch = "001";
		public $Country = "MEX";
		public $User = "4018WEUS0";
		public $Merchant = "15366";
		public $Operacion = 13;
		public $Crypto = 3;
		public $Currency = "USD";
		public $tUrl = "prod";
		public $Semilla = "A7BEC7D1";
		public $Pwd = "4018WEUS0";
		var $sTempUN = "";
      	var $sTempPW = "";
       	var $sbox = array();
       	var $KEY = array();
       	var $sUser = "";
       	var $sPassw = "";
		public $Url = array("dev"=>"https://dev.mitec.com.mx/pgs/cobroXml","qa"=>"https://qa.mitec.com.mx/pgs/cobroXml","prod"=>"https://vip.e-pago.com.mx/pgs/cobroXml");
		
		public function setVars($idCompany,$idBranch,$Country,$User,$Pwd,$Merchant,$Crypto,$Currency,$Semilla,$tUrl){
			$this->idCompany = $idCompany;
			$this->idBranch = $idBranch;
			$this->Country = $Country;
			$this->User = $User;
			$this->Pwd = $Pwd;
			$this->Merchant = $Merchant;
			$this->Crypto = $Crypto;
			$this->Currency = $Currency;
			$this->Semilla = $Semilla;
			$this->tUrl = $tUrl;
		}
		public function getVars(){
			return array( 
			'idCompany'=>$this->idCompany,
			'idBranch'=>$this->idBranch,
			'Country'=>$this->Country,
			'User'=>$this->User,
			'Pwd'=>$this->Pwd,
			'Merchant'=>$this->Merchant,
			'Crypto'=>$this->Crypto,
			'Currency'=>$this->Currency,
			'Semilla'=>$this->Semilla,
			'tUrl'=>$this->tUrl,
			'operacion'=>$this->Operacion,
			);
		}	
		public function limpiaVariable($str){
			$str = str_replace("%0D","",$str);
			$str = str_replace("%0A","",$str);
			$str = str_replace("%09","",$str);
			$str = str_replace("%2F","/",$str);
			$str = str_replace("%3F","?",$str);
			$str = str_replace("+"," ",$str);
			$str = str_replace("%3D","=",$str);
			return $str;
		}
		
		public function makeXML($idOperacion,$idUsuario,$cantidad,$nombreCliente,$numeroTarjeta,$expMonth,$expYear,$ccv2){
				$numeroTarjeta = trim(str_replace(" ","",$numeroTarjeta));
				$numeroTarjeta = trim(str_replace("-","",$numeroTarjeta));
				$expMonth = str_replace(" ","",$expMonth);
				$expYear = str_replace(" ","",$expYear);
				$ccv2 = str_replace(" ","",$ccv2);
				$cantidad = trim(str_replace(" ","",$cantidad));
				$cantidad = trim(str_replace(",","",$cantidad));
				
				$pwd = $this->StringToHexString($this->Salaa($this->Pwd,$this->Semilla));
				$name = $this->StringToHexString($this->Salaa($nombreCliente,$this->Semilla));
				$number = $this->StringToHexString($this->Salaa($numeroTarjeta,$this->Semilla));
				$expmonth = $this->StringToHexString($this->Salaa($expMonth,$this->Semilla));
				$expyear = $this->StringToHexString($this->Salaa($expYear,$this->Semilla));
				$cvv = $this->StringToHexString($this->Salaa($ccv2,$this->Semilla));
				$xmlSend = <<<TEXT
					<?xml version="1.0" encoding="UTF-8"?>
						<VMCAMEXM>
							<business>
								<id_company>{$this->idCompany}</id_company>
								<id_branch>{$this->idBranch}</id_branch>
								<country>{$this->Country}</country>
								<user>{$this->User}</user>
								<pwd>{$pwd}</pwd>
							</business>
							<transacction>
								<merchant>{$this->Merchant}</merchant>
								<reference>{$idOperacion}</reference>
								<tp_operation>13</tp_operation>
								<creditcard>
									<crypto>{$this->Crypto}</crypto>
									<type>V/MC</type>
									<name>{$name}</name>
									<number>{$number}</number>
									<expmonth>{$expmonth}</expmonth>
									<expyear>{$expyear}</expyear>
									<cvv-csc>{$cvv}</cvv-csc>
								</creditcard>
								<amount>{$cantidad}</amount>
								<currency>{$this->Currency}</currency>
								<usrtransacction>1</usrtransacction>
							</transacction>
						</VMCAMEXM>
TEXT;

			return $xmlSend;
		}
		
		public function callService($xml){
			$url = $this->Url[$this->tUrl];			
			$vars = "&xml=" . $this->limpiaVariable(urlencode($xml)); 
		    $header[] = "Content-type: application/x-www-form-urlencoded";
		    $ch = curl_init();
		    $postfields = "info_asj3=1".$vars;
		
			 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		     curl_setopt($ch, CURLOPT_URL,$url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 250);
		     curl_setopt($ch, CURLOPT_POST, true);
		 	 curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);		     
		
		     $data = curl_exec($ch);
				if (curl_errno($ch)) {
		           $data = curl_error($ch);          
		        } else {
		           curl_close($ch);
		        }
		   
		    return simplexml_load_string($data);
		}
		
		function RC4Initialize($strPwd){
               $tempSwap = 0;
               $i = 0;
               $b = 0;
               $intLength = 0;

               $intLength = strlen($strPwd);

               for($i = 0; $i <= 255; $i++){ // For a = 0 To 255
                           $this->KEY[$i] = ord(substr($strPwd,$i%$intLength,1));
                           $this->sbox[$i] = $i;
               }

               $b = 0;
               for($i = 0; $i <= 255; $i++){ // For a = 0 To 255
                           $b = ($b + $this->sbox[$i] + $this->KEY[$i])%256;
                           $tempSwap = $this->sbox[$i];
                           $this->sbox[$i] = $this->sbox[$b];
                           $this->sbox[$b] = $tempSwap;
               }
           }



           function Salaa($plaintxt, $key){
               $this->RC4Initialize($key);
               $temp = 0;
               $a = 0;
               $i = 0;
               $j = 0;
               $k;
               $cipherby = 0;
               $cipher = "";

               for($a = 0; $a < strlen($plaintxt); $a++){
                           $i = ($i + 1)%256;
                           $j = ($j + $this->sbox[$i])%256;
                           $temp = $this->sbox[$i];
                           $this->sbox[$i] = $this->sbox[$j];
                           $this->sbox[$j] = $temp;

                           $k = $this->sbox[($this->sbox[$i] + $this->sbox[$j])%256];

                           $cipherby = ord(substr($plaintxt,$a,1)) ^ $k;
                           $cipher = $cipher.chr($cipherby);
               }

               return $cipher;
           }


           function StringToHexString($b){
               $sb="";
               for($i = 0; $i < strlen($b); $i++){
                           $tmpb = $b;
                           $v = ord(substr($tmpb,$i,1)) & 0xFF;
                           //print("V:".$v."<br>");
                           if($v < 16){
                                       $sb = $sb.'0';
                           }
                           $sb = $sb.dechex($v);
                           //print("<br>V:".$v);
                           //print("<br>tmp:".substr($tmpb,$i,1));
                           //print("<br>SB:".dechex($v));
               }
               return $sb;
           }

           // DES-ENCRIPTADO

           function HexStringToString($s){
	           $Result = "";
	           $len = strlen($s)/2;
	           for($i=0; $i < $len; $i++){
	                       $index = $i * 2;
	                       //print("<br>v".intval(substr($s,$index,2),16));
	                       $v = intval(substr($s,$index,2),16);
	                       $Result = $Result.chr($v);
	           }
	           return $Result;
           }



           function Avain(){

           }
	}
?>
