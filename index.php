<?php session_start();

include "CLASSES/User.php";
include "CLASSES/Tweet.php";


if (!isset($_SESSION['SESS_USER'])) header("location:Login.php");
else
{
	// create user from session var with serialised user obj
	$u     = User::unsterilizeThis($_SESSION['SESS_USER']);
	$tweet = new Tweet();

//	if ($u->getMsg() != "")
//	{
//		$message = $u->getMsg();
//		echo "<script>alert('" . $message . "')</script>";
//	}
	if (isset($_GET["message"]))
	{
		$msg = $_GET['message'];
		echo "<script>alert('$msg')</script>";
	}
	if (isset($_GET["msg"]))
	{
		$msg = $_GET['msg'];
		echo "<script>alert(" . $msg . ")</script>";
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

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">

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
<?php include("header.php"); ?>
<BR><BR>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="mainprofile img-rounded">
                <div class="bold">
					<?php
					if ($user->getProfImage() == "")
					{
						echo "<img class=\"bannericons\" src=\"images/profilepics/default.jfif\">";
					}
					else
					{
						echo "<img class=\"bannericons\" src=" . $user->getProfImage() . ">";
					}
					echo "<a href='userpage.php?user_id=" . $u->getUserId() . "''>";
					echo $u->getFirstName() . " " . $u->getLastName() . "</a>";
					?>
                    <BR></div>
                <table>
                    <tr>
                        <td>Tweets</td>
                        <td>Following</td>
                        <td>Followers</td>
                    </tr>
                    <tr>
                        <td>
							<?php echo $tweet->DisplayNoTweets($u->getUserId()); ?>
                        </td>
                        <td>
							<?php echo $tweet->DisplayNoFollowing($u->getUserId()); ?>
                        </td>
                        <td>
							<?php echo $tweet->DisplayNoFollowers($u->getUserId()); ?>
                        </td>
                    </tr>
                </table>
                <BR><BR><BR><BR><BR>
            </div>
            <BR><BR>
            <div class="trending img-rounded">
                <div class="bold">Trending</div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="img-rounded">
                <form method="post" id="tweet_form" action="tweet_proc.php">
                    <div class="form-group">
                            <textarea class="form-control" name="myTweet" id="myTweet" rows="1"
                                      placeholder="What are you bitter about today?"></textarea>
                        <input type="submit" name="button" id="button" value="Send"
                               class="btn btn-primary btn-lg btn-block login-button"/>
                    </div>
                </form>
            </div>
            <div class="img-rounded">
                <!--display list of tweets here-->
				<?php
				$tweet->DisplayTweets($u->getUserId());

				?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="whoToTroll img-rounded">
                <div class="bold">Who to Follow?<BR></div>
                <!-- display people you may know here-->
				<?php

				$qResult = $u->GetUsersToFollowQResult($u->getUserId());
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
                              <a href="userpage?user_id=' . $user_id . '      ">' . $output . substr(0, 25) . '</a><br>'
						. "<a href='$urlQuerry' class ='btn-sm' "
						. "style=' cursor: default; text-decoration : none; font-weight:bold; background: black; color: yellow; border: 2px solid blue; border-radius: 5px;' "
						. "type='button' >Follow</a> <br>";
					echo '<hr>';
					echo '</div>';
				}
				?>
            </div>
            <BR>
            <!--don't need this div for now
			<div class="trending img-rounded">
			© 2018 Bitter
			</div>-->
        </div>
    </div> <!-- end row -->
</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
</script>
<script src="includes/bootstrap.min.js"></script>

</body>

</html>
