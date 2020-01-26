<?php

echo "<pre>"; // for preformatted text
$count = 0;
$count++;   // increment the count var (postfix)
echo $count . "\n";
if ($count == 0) {
    echo "Zero";
} elseif ($count > 0) {
    echo "greater than zero \n\n";
} else {
    $count . " count<BR>";
}

$a=5;
$b="5";

if ($a===$b) echo "Equal \n";
else echo "Not Equal \n";


echo ($a <=> $b) ."\n"; //the cpaceship operator(1,-,-1; greater than, equal, less then)

$color = "red";

switch($color){
    case "red": echo "red \n"; break;
    case "blue": echo "blue \n"; break;
    default : echo "default \n";
}

while(true) {if($color=="red") break;}
//echo "<script>alert(\"Hello\")</script>";
$i=0;
do 
{
       echo (pow($a, 2)) ."\n";
       $i++;
}
while ($i<10);
 
for($i = 0; $i<10;$i++) 
{
    if($i==5) continue ;
    echo $i." ";
}
echo "</pre>" ; // it changes the font