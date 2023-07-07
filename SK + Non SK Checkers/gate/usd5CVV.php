<?php






error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


//================ [ FUNCTIONS & LISTA ] ===============//

function GetStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}


function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    };

$idd = $_GET['idd'];
$amt = $_GET['cst'];
if(empty($amt)) {
	$amt = '5';
	$chr = $amt * 100;
}
$sk = $_GET['sec'];
$lista = $_GET['lista'];
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];

if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";





//================= [ CURL REQUESTS ] =================//

#-------------------[1st REQ]--------------------#
$x = 0;  

while(true)  

{  

$ch = curl_init();  

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');  

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  

curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  

curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[cvc]='.$cvv.'');  

$result1 = curl_exec($ch);  

$tok1 = Getstr($result1,'"id": "','"');  

$msg = Getstr($result1,'"message": "','"');  

//echo "<br><b>Result1: </b> $result1<br>";  

if (strpos($result1, "rate_limit"))   

{  

    $x++;  

    continue;  

}  

break;  

}
#-------------------[2nd REQ]--------------------#

$x = 0;  

while(true)  

{  

$ch = curl_init();  

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');  

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  

curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  

curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount='.$chr.'&currency=usd&payment_method_types[]=card&description=SoilMan Donation&payment_method='.$tok1.'&confirm=true&off_session=true');  

$result2 = curl_exec($ch);  

$tok2 = Getstr($result2,'"id": "','"');  

$receipturl = trim(strip_tags(getStr($result2,'"receipt_url": "','"')));  

//echo "<br><b>Result2: </b> $result2<br>";  

if (strpos($result2, "rate_limit"))   

{  

    $x++;  

    continue;  

}  

break;  

}



//=================== [ RESPONSES ] ===================//

if(strpos($result2, '"seller_message": "Payment complete."' )) {
    echo 'CHARGED</span>  </span>CC:  '.$lista.'</span>  <br>➤ Response: $'.$amt.' CVV Charged ✅ SoilMan0_0  <br> ➤ Receipt : <a href='.$receipturl.'>Here</a><br>';
}
elseif(strpos($result2,'"cvc_check": "pass"')){
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVV LIVE</span><br>';
}


elseif(strpos($result1, "generic_decline")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: GENERIC DECLINED</span><br>';
    }
elseif(strpos($result2, "generic_decline" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: GENERIC DECLINED</span><br>';
}
elseif(strpos($result2, "insufficient_funds" )) {
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: INSUFFICIENT FUNDS</span><br>';
}

elseif(strpos($result2, "fraudulent" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: FRAUDULENT</span><br>';
}
elseif(strpos($resul3, "do_not_honor" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
    }
elseif(strpos($resul2, "do_not_honor" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
}
elseif(strpos($result,"fraudulent")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: FRAUDULENT</span><br>';

}

elseif(strpos($result2,'"code": "incorrect_cvc"')){
    echo 'CCN</span>  </span>CC:  '.$lista.'</span>  <br>Result: Security code is incorrect</span><br>';
}
elseif(strpos($result1,' "code": "invalid_cvc"')){
    echo 'CCN</span>  </span>CC:  '.$lista.'</span>  <br>Result: Security code is incorrect</span><br>';
     
}
elseif(strpos($result1,"invalid_expiry_month")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INVAILD EXPIRY MONTH</span><br>';

}
elseif(strpos($result2,"invalid_account")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INVAILD ACCOUNT</span><br>';

}

elseif(strpos($result2, "do_not_honor")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
}
elseif(strpos($result2, "lost_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: LOST CARD</span><br>';
}
elseif(strpos($result2, "lost_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: LOST CARD</span></span>  <br>Result: CHECKER BY checker</span> <br>';
}

elseif(strpos($result2, "stolen_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: STOLEN CARD</span><br>';
    }

elseif(strpos($result2, "stolen_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: STOLEN CARD</span><br>';


}
elseif(strpos($result2, "transaction_not_allowed" )) {
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: TRANSACTION NOT ALLOWED</span><br>';
    }
    elseif(strpos($result2, "authentication_required")) {
    	echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: 32DS REQUIRED</span><br>';
   } 
   elseif(strpos($result2, "card_error_authentication_required")) {
    	echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: 32DS REQUIRED</span><br>';
   } 
   elseif(strpos($result2, "card_error_authentication_required")) {
    	echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: 32DS REQUIRED</span><br>';
   } 
   elseif(strpos($result1, "card_error_authentication_required")) {
    	echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: 32DS REQUIRED</span><br>';
   } 
elseif(strpos($result2, "incorrect_cvc" )) {
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: Security code is incorrect</span><br>';
}
elseif(strpos($result2, "pickup_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: PICKUP CARD</span><br>';
}
elseif(strpos($result2, "pickup_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: PICKUP CARD</span><br>';

}
elseif(strpos($result2, 'Your card has expired.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: EXPIRED CARD</span><br>';
}
elseif(strpos($result2, 'Your card has expired.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: EXPIRED CARD</span><br>';

}
elseif(strpos($result2, "card_decline_rate_limit_exceeded")) {
	echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SK IS AT RATE LIMIT</span><br>';
}
elseif(strpos($result2, '"code": "processing_error"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: PROCESSING ERROR</span><br>';
    }
elseif(strpos($result2, ' "message": "Your card number is incorrect."')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: YOUR CARD NUMBER IS INCORRECT</span><br>';
    }
elseif(strpos($result2, '"decline_code": "service_not_allowed"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SERVICE NOT ALLOWED</span><br>';
    }
elseif(strpos($result2, '"code": "processing_error"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: PROCESSING ERROR</span><br>';
    }
elseif(strpos($result2, ' "message": "Your card number is incorrect."')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: YOUR CARD NUMBER IS INCORRECT</span><br>';
    }
elseif(strpos($result2, '"decline_code": "service_not_allowed"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SERVICE NOT ALLOWED</span><br>';

}
elseif(strpos($result, "incorrect_number")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INCORRECT CARD NUMBER</span><br>';
}
elseif(strpos($result1, "incorrect_number")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INCORRECT CARD NUMBER</span><br>';


}elseif(strpos($result1, "do_not_honor")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';

}
elseif(strpos($result1, 'Your card was declined.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD DECLINED</span><br>';

}
elseif(strpos($result1, "do_not_honor")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
    }
elseif(strpos($result2, "generic_decline")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: GENERIC CARD</span><br>';
}
elseif(strpos($result, 'Your card was declined.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD DECLINED</span><br>';

}
elseif(strpos($result2,' "decline_code": "do_not_honor"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_UNCHECKED : INFORM AT OWNER</span><br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_CHECK : FAIL</span><br>';
}
elseif(strpos($result2, "card_not_supported")) {
	echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD NOT SUPPORTED</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unavailable"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_CHECK : UNVAILABLE</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_UNCHECKED : INFORM TO OWNER」</span><br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_CHECKED : FAIL</span><br>';
}
elseif(strpos($result2,"currency_not_supported")) {
	echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CURRENCY NOT SUPORTED TRY IN INR</span><br>';
}

elseif (strpos($result,'Your card does not support this type of purchase.')) {
    echo 'DEAD</span> CC:  '.$lista.'</span>  <br>Result: CARD NOT SUPPORT THIS TYPE OF PURCHASE</span><br>';
    }

elseif(strpos($result2,'"cvc_check": "pass"')){
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVV LIVE</span><br>';
}
elseif(strpos($result2, "fraudulent" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: FRAUDULENT</span><br>';
}
elseif(strpos($result1, "testmode_charges_only" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SK KEY DEAD OR INVALID</span><br>';
}
elseif(strpos($result1, "api_key_expired" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SK KEY REVOKED</span><br>';
}
elseif(strpos($result1, "parameter_invalid_empty" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: ENTER CC TO CHECK</span><br>';
}
elseif(strpos($result1, "card_not_supported" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD NOT SUPPORTED</span><br>';
}
else {
    echo 'DEAD</span> CC:  '.$lista.'</span>  <br>Result: INCREASE AMOUNT OR TRY ANOTHER CARD</span><br>';
   
   
      
}




//echo "<br><b>Lista:</b> $lista<br>";
//echo "<br><b>CVV Check:</b> $cvccheck<br>";
//echo "<b>D_Code:</b> $dcode<br>";
//echo "<b>Reason:</b> $reason<br>";
//echo "<b>Risk Level:</b> $riskl<br>";
//echo "<b>Seller Message:</b> $seller_msg<br>";

echo " BYPASSING: $x <br>";

//echo "<br><b>Result3: </b> $result2<br>";

curl_close($ch);
ob_flush();
?>