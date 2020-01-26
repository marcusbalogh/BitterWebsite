<?php
session_start();

if(isset($_SESSION["name"])) echo "You are logged in<br>";
else echo "not logged in<br>";//send them to the login page with a header location


$students = array(
    "Nick",
    "Jim",
    "John",
    "jill"
    );
$jStudents = preg_grep("/^J/i", $students);
print_r($jStudents); echo"<br>";