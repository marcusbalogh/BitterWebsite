<?php

$students = array(
    "Nick",
    "Jim",
    "John",
    "jill"
    );
$jStudents = preg_grep("/^J/i", $students);
print_r($jStudents); echo"<br>";

$myString = "The lion, the witch and the wardrobe" . "<br>";
echo preg_match("/the/i", $myString)."<br>"; 
preg_match_all("/the/i", $myString,$myMatches); //Perform a global regular expression match
print_r($myMatches); echo "<br>";

$myString = "the price is $19.99";
echo preg_quote($myString) . "<br>"; //"Escape" Quote regular expression characters //the price is \$19\.99

$myString = "PHP is my favourinte programming language";

$myString =  preg_replace("/PHP/","Java" , $myString); ///Java/ is my favourinte programming language
echo $myString;

mysqli_real_escape_string($con, $string); // use this for inserts !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!