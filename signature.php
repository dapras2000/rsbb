<?php

 date_default_timezone_set('UTC');
$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));

   $cons_id = "4215";
	$data= $cons_id."&".$tStamp;
	#echo $data;
   $secretKey = "6yS741EFD8";

# echo $tStamp;

           // Computes the signature by hashing the salt with the secret key as the key

   $signature = hash_hmac('sha256', $data, $secretKey, true);

 

   // base64 encode…

   $encodedSignature = base64_encode($signature);

 #echo $encodedSignature;

   // urlencode…

   // $encodedSignature = urlencode($encodedSignature);

 

 

?>