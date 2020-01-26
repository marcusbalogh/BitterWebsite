<?php session_start();

include_once 'CLASSES/User.php';
$u = new User();
$u->Login($_POST["username"], $_POST["password"]);
if (isset($_SESSION['SESS_USER']))
{
	$msg = $u->getMsg();
	header("location:index.php?msg='{$msg}'");
}
else
{

	$msg = $u->getMsg();
	header("location:Login.php?msg='{$msg}'");
}