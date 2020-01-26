<?php
session_start();
include_once "CLASSES/Tweet.php";
include_once "CLASSES/User.php";
date_default_timezone_set("America/Halifax");
//insert a tweet into the database

// Create user and tweet obj
$u     = User::unsterilizeThis($_SESSION['SESS_USER']);
$tweet = new Tweet();


// Tweet
if (isset($_POST["myTweet"]) && $_POST["myTweet"] != "") $tweet->InsertTweet($_POST["myTweet"], $u->getUserId());
else header("location:index.php");