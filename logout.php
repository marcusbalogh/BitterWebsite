<?php
 session_start(); // access ses vars
 session_destroy(); // destroy them, aka log out
include_once "connect.php";
global $con;
mysqli_close($con);
 header("location:Login.php"); 
 
//log the user out and redirect them back to the login page.

