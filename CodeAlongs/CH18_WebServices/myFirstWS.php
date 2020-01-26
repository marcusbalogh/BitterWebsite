<?php
// C to F

$temp = $_GET["temp"]; // it comes in in Celsius

$returnVal = $temp * 9 / 5 + 32;

$format = $_GET["format"];
if ($format == "json")
{
	header("content-type: application/json");
	echo json_encode(array("temp" => $returnVal));
}
else
{
	header("content-type: text/xml");
	$xml = "<?xml version=\"1.0\"?>"."
	<root>
	<temp> $returnVal </temp>
	</root>";
	echo $xml;
}