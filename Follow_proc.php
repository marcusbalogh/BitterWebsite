<?php
session_start();
include 'connect.php';
include "CLASSES/User.php";
if (isset($_GET["user_id"]) && (isset($_GET["screen_name"])))
{
	$u = User::unsterilizeThis($_SESSION['SESS_USER']);
	$u->FollowUser($_GET["user_id"], $_GET["screen_name"]);
}

else header("location:index.php");