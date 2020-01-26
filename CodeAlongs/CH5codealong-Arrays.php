<?php
$colours[0] = "red";
$colours[1] = "blue";
$colours[2] = "green";
// diff way
$colours = [5=>"Red","Blue","White"];
    echo $colours[7] . "<br>";

$grades = ["Jimmy"=> 98, "Johnny"=>66];
    echo $grades["Jimmy"] . "<br>";

// 2D Arrays
$doubleD_Array = array(
    "jimmy" => array (
        "math"=> 98,
        "science" => 99,
        "french" => 91),
    "Johnny" => array(
        "math"=> 87,
        "science" => 93,
        "french" => 100)
    );


// collection then record
foreach ($doubleD_Array as $student) {
        echo $student["math"] . $student["science"];
}


// READ FROM TXT FILE AS AN ARRAY
$students = file("students.txt");

foreach ($students as $student){
     list($name,$hometown,$gpa) = explode("|", $student);
     echo $name . " " . $hometown . " " . $gpa . "<br>";
}


//Populate an array with a range
$myNums = range(0,100);
$myGrades = range("A","F");

//Prints human-readable information about a variable
//print_r($myNums);


array_unshift($colours,"purple");//Prepend one or more elements to the beginning of an array


array_push($colours,"yellow");//Push one or more elements onto the end of array

array_shift($colours);//Shift an element off the beginning of array

array_pop($colours); //Pop the element off the end of array

print_r($colours);

if(in_array("red", $colours)) echo "great" . "<br>";
else echo "Not Found<br>";


echo count($colours) . "no. of colours";//Count all elements in an array, or something in an object

echo sizeof($myGrades). "no. of colours";//Alias of count()
echo "<br>";
print_r(array_reverse($colours)); //Return an array with elements in reverse order
echo "<br>";
print_r(array_flip($colours)); //Exchanges all keys with their associated values in an array

echo "<br>";
sort($colours);//This function sorts an array. Elements will be arranged from lowest to highest when this function has completed.
print_r($colours); 
echo "<br>";
natcasesort($colours);
echo "<BR>";
print_r($colours);
$thisArr=array_merge($students,$myNums);
print_r($thisArr);

echo "<br>";