<?php
$valid = checkdate(10,31,2010); //Validate a Gregorian date
echo $valid . "<br>";
setlocale(LC_ALL,"can-EN");// set the locale
// %d- day of month
// %F- full date
// %B month
// %Y year
echo strftime("%A, %dth  %B, %Y") . "<br>";
echo date("F d, y") ."<br>" . "<br>";
//date_default_timezone_set("America/Halifax");
echo date("h:i:sa") . "<br>";
//$dateArray = getdate();
//print_r($dateArray);


//last modified date
//echo "this page was last modified on: " . date("F d, Y H:i:s", getlastmod())  ;

//$dateTweeted = "2019-10-01";  //Obviously, this should not be hard-coded, it should come from the database

//this is new in PHP 5.1
//$now = new DateTime();
//$tweetTime = new DateTime($dateTweeted );
//$interval = $tweetTime->diff($now);
//
//if ($interval->y > 1) echo $interval->format('%y years') . " ago";
//elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
//elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
//elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
//elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
//elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
//elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
//elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
//elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
//elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
//elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
//elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";