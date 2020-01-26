<?php
/* CHAPTER 17 - Sessions*/
// STATELESS - a page has no knowledge of previous/future visited pages
// - it cannot maintain state



// $_POST -grabs information from one page to another
// 
// $_GET - append the data in the url


/*An associative array containing session variables available to the current script*/

// cookie - is a small text file stored on your computer -LIMITED SIZE 4KB - potential security issues
// session variables are stored on the RAM of the server | replaces cookies

// put this in a include file
session_start();//USE THIS EVERY TIME YOU USE SESSION VARIABLES | TOP OF PAGE !!!



$_SESSION["name"] = "Nick"; // this would be simmilar to what will be on login_proc

////session_start() creates a session or resumes
//// the current one based on a session identifier passed via a GET or POST request, or passed via a cookie.


//RETRIVE THE SESSION VAR
echo $_SESSION["name"] . "<br>";

echo " <br>my session id<br>" . session_id() . "<br>";

// view all my sesion vars
$mySessionvar = session_encode() . "   ALL MY SESSION VARS<br>";
echo session_decode($mySessionvar);

// log out
session_destroy(); // kills the session completly 
session_unset(); //The session_unset() function frees all session variables currently registered. | keeps the session id active

//PHP.INI

/*Chapter 8 - Errors and Exception Handeling*/


try{
    if(!mysqli_connect("localhost","username","password","schema")){
        throw new Exception("error connecting to database");
    }
}
 catch (Exception $ex){
     echo "could not connect to database";
     exit; // stops execution of the program
     error_log("Error in file " . $ex->getFile() . " on line no. " . $ex->getLine() . "<br> " . $ex->getMessage());
 }
 echo "<br>more logic here";
