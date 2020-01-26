<?php session_start();


include "CLASSES/Tweet.php";
include "CLASSES/User.php";

if (!isset($_SESSION['SESS_USER'])) header("location:Login.php");
else if (!isset($_GET["replytxt"])) header("location:index.php");
else
{
	$u     = User::unsterilizeThis($_SESSION['SESS_USER']);
	$tweet = new Tweet();
}

$replytxt = $_GET["replytxt"];
$tweetid  = $_GET["tweetid"];
$tweet->InsertTweet($replytxt, $u->getUserId(),0,$tweetid);
