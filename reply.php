<?php session_start();


include "CLASSES/Tweet.php";


if (!isset($_SESSION['SESS_USER'])) header("location:Login.php");
else if (!isset($_GET["tweetid"])) header("location:index.php");
else
{
	$tweet = new Tweet();
}

//Display tweet that needs replying
$tweetid    = $_GET["tweetid"];
$tweetarray = $tweet->GetTweet($tweetid);
echo ($tweetarray["tweet_text"]) . "<br><br><br><i>Please reply to the tweet above</i><br>";
echo "
<form action='replyproc.php' method='get'>
    <textarea rows=4 name='replytxt' cols=50></textarea>
    <br>
    <input value='   $tweetid  ' name='tweetid' hidden>
    <button type='submit'>Reply</button>
</form>
";
?>


