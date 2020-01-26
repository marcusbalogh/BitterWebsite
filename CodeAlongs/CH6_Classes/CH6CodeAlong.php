<?php
include("Student.php");
$s = new Student('Marck','123'); // the default constructor
$s->studentId = 123456;
echo $s->studentId . "<br>";

// "::" calls a static method
echo Student::PrintSchool();



//$s->setName("Marcus Barcus");
//echo $s->getName() . '<br>';


// Type hinting
function DoStuff(Student $s){
    echo $s->name . "br";
}

DoStuff($s);

