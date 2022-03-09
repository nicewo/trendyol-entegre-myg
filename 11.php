<?php

$curl = curl_init();







curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.trendyol.com/sapigw/suppliers/213186/orders?orderByField=CreatedDate&orderByDirection=DESC&size=200',
  CURLOPT_HTTPAUTH => CURLAUTH_ANY,
  CURLOPT_COOKIESESSION => TRUE,
  CURLOPT_HTTPHEADER => array(
    'User-Agent: 213186 - SelfIntegration',
    'Content-Type: application/json',
    'Authorization: Basic '.base64_encode('a2nJm3kx0P5Dbnh0WTsO:LIraMfjSSvfoAVQhaxH3'),
  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => 2,
  CURLOPT_UNRESTRICTED_AUTH => true,
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
