<?php
//this page will allow the user to edit their profile photo
session_start();
//If a user tries to access index.php and they are not logged, you must redirect them to login.php
if (!isset($_SESSION['SESS_USER'])) header("location:Login.php");
else {
    if (isset($_GET["message"])) {
        $message = $_GET["message"];
        if ($message != "") {
            echo "<script>alert('$message')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Develop your dark side by tweeting bitter things non-stop">
    <meta name="author" content="Marcus B. balogh.marcu@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Bitter - Edit Profile PIc</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">

    <!-- Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>


</head>

<body>
<br><br><br><br>
<!--Sprint 1 .80-->
<?php include("header.php"); ?>
<form action="edit_photo_proc.php" method="post" enctype='multipart/form-data'>
    Select your image to replace your profile pic. (Must be under 1MB in size):<br>
    <input type="file" accept='image/*' name="pic" required><br><br>
    <input id="button" type="submit" name="submit" value="Submit" style="display: block;">
</form>
</body>
</html>


















