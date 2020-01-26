<?php
session_start();
include_once "CLASSES/Tweet.php";
include_once "CLASSES/User.php";
$user            = User::unsterilizeThis($_SESSION['SESS_USER']);
$tweet           = new Tweet();
$originalTweetId = $_GET["tweetid"];
$tweet->ReTweet($originalTweetId, $user->getUserId());