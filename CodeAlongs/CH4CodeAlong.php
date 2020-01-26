<?php
//type-hinting will throw an exception if the type doesn't match
function AddNumbers(int $x, int $y)
{
    return $x+$y;
}

//function PrintMessage(String $x) {echo "";}   //no work

function PrintMessage(&$x, $z=2) // & - by ref
{
    $x="Changed";
    echo $x."<br>";
    echo "optional is: ". $z . "<br>";
}
echo AddNumbers(5, 10);
echo rand() . "<br>";
echo rand(1,6) . "<br>"; // range 1-6
echo getrandmax() . "<br>"; // (2^31) -1

// recursive is ussually more efficient 
function Factorial ($num){ // recursive method
    if($num == 1) return 1;
    else return $num * Factorial ($num -1);
    
//    $sum=1;
//    for($i=2;$i<$num;$i++){ 
//    $sum*=$i;
//}
}
echo Factorial(22) . "<br>";

// all parrameters are passed in by val ( by copy )
$ms = "Hello world";
PrintMessage ($ms);
echo $ms;