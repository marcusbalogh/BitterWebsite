<?php

$myPass ='secret'; //would normaly be passed via POST
// $myPass =$_POST["password"]
//change login_proc and signup_proc with this
// add this this line signup_proc
$myHashedPassword = password_hash($myPass,PASSWORD_DEFAULT);

echo $myHashedPassword . "<br>";


//place this on login_proc
echo password_verify($myPass, $myHashedPassword);
