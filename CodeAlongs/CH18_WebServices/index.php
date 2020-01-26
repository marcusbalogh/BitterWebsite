<?php
$format = "xml";
$url = "http://bitterlive/codealongs/CH18_WebServices/myFirstWS.php?temp=20&format=".$format;

//cURL - versatile set of libraries that allow php to send/retrieve data via HTTP
$cobj = curl_init($url);
curl_setopt($cobj, CURLOPT_RETURNTRANSFER, 1);//returns the results to me instead of displaying in on the webpage
$data = curl_exec($cobj);
curl_close($cobj);


if($format=="json"){

	$object = json_decode($data); // converted back to an array
	echo $object->{"temp"};
}
else{   // xml
	$xmlObject = simplexml_load_string($data);
	print_r($xmlObject);
}