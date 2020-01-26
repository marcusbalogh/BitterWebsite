<?php

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "http://localhost/includes/Fedex/ValidatePostalCodeService/ValidatePostalCodeWebServiceClientCopy.php?PostalCode=e6l1w3",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"Accept: */*",
		"Accept-Encoding: gzip, deflate",
		"Cache-Control: no-cache",
		"Connection: keep-alive",
		"Host: localhost",
		"Postman-Token: 7d6ca77a-d71e-4a25-8e0e-9038d5977252,d0fbe7dc-18c4-4b50-891a-1ee2dec136b6",
		"User-Agent: PostmanRuntime/7.20.1",
		"cache-control: no-cache"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}