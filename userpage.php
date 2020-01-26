<?php
//displays all the details for a particular Bitter user
include "CLASSES/User.php";
include "CLASSES/Tweet.php";


session_start();
if (!isset($_SESSION['SESS_USER'])) header("location:Login.php");
else
{
	$u     = User::unsterilizeThis($_SESSION['SESS_USER']);
	$tweet = new Tweet();
	if (isset($_GET["user_id"]))
	{
		$userpage_id = $_GET["user_id"];
	}
	else
	{
		$userpage_id = $u->getUserId();
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bitter - Your retrospective profile page">
    <meta name="author" content="Marcus B. balogh.marcu@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>


</head>

<body>


<!--Sprint 1 .80-->
<?php include("header.php"); ?>
<BR><BR>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="mainprofile img-rounded">
                <div class="bold">
					<?php echo "<img class=\"bannericons\" src=\"images/profilepics/" . $userpage_id . ".jpg\">";
					$user = $u->toArray($userpage_id);
					echo $user["first_name"] . " " . $user["last_name"];
					?>
                    <BR></div>
                <table>
                    <tr>
                        <td>
                            tweets
                        </td>
                        <td>following</td>
                        <td>followers</td>
                    </tr>
                    <tr>
                        <td>
							<?php echo $tweet->DisplayNoTweets($userpage_id); ?>
                        </td>
                        <td>
							<?php echo $tweet->DisplayNoFollowing($userpage_id); ?>
                        </td>
                        <td>
							<?php echo $tweet->DisplayNoFollowers($userpage_id); ?>
                        </td>
                    </tr>
                </table>
                <img class="icon" src="images/location_icon.jpg">
				<?php echo $user["province"]; ?>
                <div class="bold">Member Since:</div>
                <div>
					<?php
					$date = new DateTime($user["date_created"]);
					echo date_format($date, "M j, Y");; ?>
                </div>
            </div>
            <BR><BR>

            <div class="trending img-rounded">
                <div class="bold">
					<?php
					echo $tweet->DisplayNoFollowersYouKnow($userpage_id, $u->getUserId()) . " Followers you know";

					$qResult = $u->GetFollowersYouKnowQResult($userpage_id, $u->getUserId());

					while ($user = mysqli_fetch_array($qResult))
					{
						if ($user["user_id"] == $userpage_id) continue;
						if ($user == null) continue;
						$picLocation = 'images/profilepics/default.jfif';
						$output      = $user["first_name"] . ' ' . $user["last_name"] . ' @' . $user["screen_name"];

						//
						$img = "<img src=" . $picLocation . " class='bannericons'>";

						$urlQuerry = 'follow_proc.php?user_id=' . $user["user_id"] . '&screen_name=' . $user["screen_name"];
						$user_id   = $user["user_id"];
						echo '<div>';
						echo $img . '
                              <a href=userpage?user_id=' . $user_id . '      >' . $output . substr(0, 25) . '</a><br>' . "<br>";
						echo '<hr>';
						echo '</div>';
					}
					?>
                    <BR></div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="img-rounded">
                <!--display list of tweets here-->
				<?php
				$tweet->DisplayUserPageTweets($userpage_id);

				?>
            </div>
            <div class="img-rounded">

            </div>
        </div>
        <div class="col-md-3">
            <div class="whoToTroll img-rounded">
                <div class="bold">Who to Follow?<BR></div>
				<?php

				$qResult = $u->GetUsersToFollowQResult($userpage_id);
				while ($user = mysqli_fetch_array($qResult))
				{
					if ($user == null) continue;
					$picLocation = 'images/profilepics/default.jfif';
					$output      = $user["first_name"] . ' ' . $user["last_name"] . ' @' . $user["screen_name"];

					//
					$img = "<img src=" . $picLocation . " class='bannericons'>";

					$urlQuerry = 'follow_proc.php?user_id=' . $user["user_id"] . '&screen_name=' . $user["screen_name"];
					$user_id   = $user["user_id"];
					echo '<div>';
					echo $img . '
                              <a href=userpage?user_id=' . $user_id . '      >' . $output . substr(0, 25) . '</a><br>'
						. "<a href='$urlQuerry' class ='btn-sm' "
						. "style=' cursor: default; text-decoration : none; font-weight:bold; background: black; color: yellow; border: 2px solid blue; border-radius: 5px;' "
						. "type='button' >Follow</a> <br>";
					echo '<hr>';
					echo '</div>';
				}
				?>

            </div>
            <BR>

        </div>
    </div> <!-- end row -->
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
        crossorigin="anonymous"></script>
<script src="includes/bootstrap.min.js"></script>

</body>
</html>
