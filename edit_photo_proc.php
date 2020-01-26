<?php
session_start();
include "CLASSES/User.php";
if (!isset($_SESSION['SESS_USER'])) header("location:Login.php");

// Create user from sess var then edit photo
User::unsterilizeThis($_SESSION['SESS_USER'])->EditPhoto();

