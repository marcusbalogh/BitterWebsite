<?php session_start();
include_once "CLASSES/User.php";
$user = new User();

echo $_POST["province"] . " ";
echo $_POST["postalCode"] . " ";
$postalCode = str_ireplace(" ", "", $_POST["postalCode"]); // delete space in postalcode

$curl = curl_init();
// Code generated from POSTMAN
curl_setopt_array($curl, array(
	CURLOPT_URL => "http://localhost/includes/Fedex/ValidatePostalCodeService/ValidatePostalCodeWebServiceClientCopy.php?PostalCode={$postalCode}",
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
$err      = curl_error($curl);

curl_close($curl);

if ($err)
{

	$output = "cURL Error #:" . $err;
}
else
{
	$output = $response;
	//echo $response;
}
if (strpos($output, "Severity: SUCCESS"))
{
	$province = $_POST["province"]; // convert from name to initials
	switch ($province)
	{
		case "Alberta":
			$province = "AB";
			break;
		case "British Columbia":
			$province = "BC";
			break;
		case "Manitoba":
			$province = "MB";
			break;
		case "New Brunswick":
			$province = "NB";
			break;
		case "Newfoundland and Labrador":
			$province = "NL";
			break;
		case "Nova Scotia":
			$province = "NS";
			break;
		case "Northwest Territories":
			$province = "NT";
			break;
		case "Nunavut":
			$province = "NU";
			break;
		case "Ontario":
			$province = "ON";
			break;
		case "Prince Edward Island":
			$province = "PE";
			break;
		case "Quebec":
			$province = "QC";
			break;
		case "Saskatchewan":
			$province = "SK";
			break;
		case "Yukon":
			$province = "YT";
			break;
		default:
			break;
	}
	if (strpos($output, $province))
	{
		//echo "{$province}province found in postal code";

		if ($user->Exists($_POST["username"]))
		{
			$message = "Sign up failed, username already exists";
			header("location:Login.php?message=$message");
		}
		else
		{

			$user->Register();
			if (mysqli_affected_rows($con) == 1)
			{

				header("location:Login.php?message=" . $user->getMsg());
			}
			else
			{
				$message = $user->getMsg();
				header("location:Signup.php?message=" . $user->getMsg());
			}
		}
	}
	else
	{
		//echo "province not found in postal code";
		header("location:Signup.php?message=Province not found in postalcode");
	}
}
else{
	header("location:Signup.php?message=Postal Code not found");
}

