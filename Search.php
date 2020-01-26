<?php
session_start();
include "CLASSES/User.php";
include "CLASSES/Tweet.php";
if (!isset($_SESSION['SESS_USER'])) header("location:Login.php");
else
{
	$u     = User::unsterilizeThis($_SESSION['SESS_USER']);
	$tweet = new Tweet();
	if ($_GET["text"] == "") header("location:index.php?message=Search empty");
	else
	{
		$criteria = $_GET["text"];
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

    <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">


    <!-- Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <script>
        //just a little jquery to make the textbox appear/disappear like the real Twitter website does
        $(document).ready(function () {
            //hide the submit button on page load
            $("#button").hide();
            $("#tweet_form").submit(function () {

                $("#button").hide();
            });
            $("#myTweet").click(function () {
                this.attributes["rows"].nodeValue = 5;
                $("#button").show();
            }); //end of click event
            $("#myTweet").blur(function () {
                this.attributes["rows"].nodeValue = 1;
                //$("#button").hide();

            }); //end of click event
        }); //end of ready event handler
    </script>
</head>

<body>

<!--Sprint 1 .80-->
<?php include("header.php");
// Search Users
if ($serachRes = $u->SearchUserWithTextQResult($criteria))
{
	echo "<br><h6><b>Users found</b></h6>";
	echo "<hr>";

	while ($userResult = mysqli_fetch_array($serachRes))
	{
		if ($userResult == null) continue;
		$userline = $userResult["first_name"] . " ";
		$userline .= $userResult["last_name"] . " ";
		$userline .= "@" . $userResult["screen_name"];

		echo "<a href='userpage.php?user_id={$userResult["user_id"]}'>" . $userline . "</a>";

		// |Following
		if ($u->FollowingUser($u->getUserId(), $userResult["user_id"])) echo " |Following ";
		else
		{
			$urlQuerry = 'follow_proc.php?user_id=' . $userResult["user_id"] . '&screen_name=' . $userResult["screen_name"];
			//follow btn

			echo " <a href='{$urlQuerry}' class ='btn-sm'
			style=' cursor: default; text-decoration : none; font-weight:bold; background: black; color: yellow; border: 2px solid blue; border-radius: 5px;'
			type='button' >Follow</a> ";
		}
		//Follows you
		if ($u->FollowingUser($userResult["user_id"], $u->getUserId())) echo " |Follows you ";
		// |Follows you
		echo "<br><br>";
	}
	echo "<hr>";
}

// Search Tweets
if ($tweetSearchRes = $tweet->SearchTweetWithTextQResult($criteria))
{
	//print_r( mysqli_fetch_array($tweetSearchRes));
	$tweet->DisplayTweetsWithSearch($tweetSearchRes);
}
?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
</script>
<script src="includes/bootstrap.min.js"></script>

</body>
<!-- Custom styles for this template -->
<link href="includes/starter-template.css" rel="stylesheet">
</html>
