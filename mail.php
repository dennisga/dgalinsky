<?php
require 'vendor/autoload.php';

$curl = curl_init();
$name = $_POST['name']; 
$email = $_POST['email']; 
$message = $_POST['message'];
$my_env_var = getenv('SENDGRID_KEY');
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n  \"personalizations\": [\n    {\n      \"to\": [\n        {\n          \"email\": \"galinsky.dennis@gmail.com\"\n        }\n      ],\n      \"subject\": \"New Contact\"\n    }\n  ],\n  \"from\": {\n    \"email\": \"galinsky.dennis@gmail.com\"\n  },\n  \"content\": [\n    {\n      \"type\": \"text/html\",\n      \"value\": \"$name<br>$email<br>$message\"\n    }\n  ]\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer $my_env_var",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
header('Location: index.html');
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}




?>