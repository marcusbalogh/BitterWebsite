<?php

include_once "connect.php";

class Tweet
{
	private $tweetId;           //int
	private $tweetText;         //string
	private $userId;            //int
	private $originalTweetId;   //int
	private $replyToTweet;      //int
	private $dateAdded;         //string

	public function UpdateTweet($field, $value, $tweedID)
	{
		global $con;
		$sql = "Update tweets SET " . $field . "=" . $value . " Where tweet_id= " . $tweedID;
		if ($query_update_user = mysqli_query($con, $sql))
		{
			if (mysqli_affected_rows($con) == 1)
			{
				$message = "Tweet Update successful";
				header("location:index.php?message=$message");
			}
			else
			{
				$message = "Tweet Update  failed";
				header("location:index.php?message=$message");
			}
		}
	}

	public function DeleteTweet($tweedID)
	{
		global $con;
		$sql = "Delete from tweets Where tweet_id= " . $tweedID;
		if ($query_update_user = mysqli_query($con, $sql))
		{
			if (mysqli_affected_rows($con) == 1)
			{
				$message = "Tweet deleted";
				header("location:index.php?message=$message");
			}
			else
			{
				$message = "Tweet did nto delete";
				header("location:index.php?message=$message");
			}
		}
	}

	public function DisplayTweetsWithSearch(mysqli_result $result)
	{
		date_default_timezone_set("America/Halifax");


		$retweetInfo = "";

		while ($tweet = mysqli_fetch_array($result))
		{
			$userLine = $tweet["first_name"] . " " . $tweet["last_name"] . " @" . $tweet["screen_name"];
			// Check for retweet
			if ('0' !== $tweet["original_tweet_id"])
			{
				$name             = "";
				$originalTwUserID = $tweet['original_tweet_id'];
				$namesql          = "SELECT first_name ,last_name  FROM users where user_id={$originalTwUserID}";//.$originalTwID; //. $tweet['original_tweet_id'];
				$nameArray        = self::GetQuerryResult($namesql)->fetch_array();

				$name .= $nameArray["first_name"] . " ";
				$name .= $nameArray["last_name"];
				//$retweetInfo = " Retweeted From " . $name;
				$retweetInfo .= " <strong>Retweeted From " . $name . "</strong> ";
			}
			else if ($tweet["reply_to_tweet_id"] != '0')
			{
				echo "this is a reply";
			}
			else
			{
				$retweetInfo = "";
			}

			$dateTweeted = $tweet["date_created"];
			$now         = new DateTime();
			$tweetTime   = new DateTime($dateTweeted);
			$interval    = $tweetTime->diff($now);
			$userTweet   = $tweet["tweet_text"];
			$tweetUserid = $tweet["tw_user_id"];

			echo "<a href='userpage?user_id=$tweetUserid'>" . $userLine . "</a> ";
			//
			if ($interval->y > 1) echo $interval->format('%y years') . " ago";
			elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
			elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
			elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
			elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
			elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
			elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
			elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
			elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
			elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
			elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
			elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";
			//
			echo $retweetInfo;
			//
			echo '<br>';
			echo $userTweet;
			echo '<br>';


			echo "<a  href='#'><img src='Images/like.ico' class='smallicon' ></a>"; // TODO : To be implemented
			/*
			Retweet href will redirect to retweet.php and will contain loggen in userline (fname,lname,screenName,time)
				+ "retweeted from" + NAME OF TWEET AUTHOR + tweet text + like,retweet,reply
			Data already in session:
				-User Data(user name,user id)
			*/

			$tweetid     = $tweet["tweet_id"];
			$retweetHref = "retweet.php?tweetid=$tweetid"; // tweet id and id of user who posted the tweet

			echo "<a  href='$retweetHref'><img src='Images/retweet.png' class='smallicon' ></a>";
			echo "<a  href='../reply.php?tweetid={$tweetid}'><img src='Images/reply.png' class='smallicon' ></a>"; // js to display a form that when submitted takes user to reply prop page then back to index
			//Textarea and button


			echo '<br><hr><br>';
		}


	}

	public function GetQuerryResult($sql)
	{
		global $con;
		$queryResult = mysqli_query($con, $sql)
		or die(" Could not connect using : " . $sql . " : " . mysqli_connect_error());
		return $queryResult;
	}

	public function SearchTweetWithTextQResult($criteria)
	: mysqli_result
	{
//		$strSQL = "SELECT * FROM tweets
//					WHERE tweet_text like '%{$criteria}%' ORDER BY date_created  desc ";
		$sql = "SELECT users.first_name, users.last_name, users.screen_name, tweets.tweet_text,tweets.date_created, tweets.user_id as 'tw_user_id', tweets.*
                            FROM users INNER JOIN tweets ON users.user_id = tweets.user_id
                            WHERE tweets.tweet_text like '%{$criteria}%' ORDER BY date_created desc";
		return self::GetQuerryResult($sql);
	}

	public function DisplayNoTweets($memId)
	{
		$int_no_of_tweets = -5;
		if ($no_of_tweets_querry = self::GetQuerryResult(sprintf("SELECT count(tweet_id) FROM tweets where user_id =%s", $memId)))
		{
			$no_of_tweets_array = mysqli_fetch_array($no_of_tweets_querry);
			$int_no_of_tweets   = $no_of_tweets_array["count(tweet_id)"];
		}
		return $int_no_of_tweets;
	}

	public function DisplayNoFollowersYouKnow($userpage_user, $loggedin_user)
	{
		//I follow users that are followed by userPage_id
		$following = -5;
		if ($no_of_following_querry = self::GetQuerryResult(
			"SELECT count(distinct(to_id)) as 'no' FROM follows where from_id= {$loggedin_user} and to_id in (select to_id from follows where from_id= {$userpage_user} and to_id <>{$loggedin_user}) and to_id <>{$userpage_user}"
		))
		{
			$no_of_following_array = mysqli_fetch_array($no_of_following_querry);
			$following             = $no_of_following_array["no"];
		}
		return $following;
	}

	public function DisplayNoFollowing($memId)
	{
		$following = -5;
		if ($no_of_following_querry = self::GetQuerryResult(sprintf("SELECT count(to_id) FROM follows where from_id =%s", $memId)))
		{
			$no_of_following_array = mysqli_fetch_array($no_of_following_querry);
			$following             = $no_of_following_array["count(to_id)"];
		}
		return $following;
	}

	public function DisplayNoFollowers($memId)
	{

		$followers = -5;
		if ($no_of_followers_querry = self::GetQuerryResult("SELECT count(from_id) FROM follows where to_id = '$memId'"))
		{
			$no_of_followers_array = mysqli_fetch_array($no_of_followers_querry);
			$followers             = $no_of_followers_array['count(from_id)'];
		}
		return $followers;
	}

	public function DisplayUserPageTweets($userId)
	{
		date_default_timezone_set("America/Halifax");
		$sql = "SELECT users.first_name, users.last_name, users.screen_name, tweets.tweet_text,tweets.date_created, tweets.user_id as 'tw_user_id', tweets.*
                            FROM users INNER JOIN tweets ON users.user_id = tweets.user_id
                            WHERE  users.user_id = '$userId'
                            ORDER BY date_created desc ";

		$retweetInfo = "";
		if ($tweets_qerry = self::GetQuerryResult($sql))
		{
			while ($tweet = mysqli_fetch_array($tweets_qerry))
			{
				$userLine = $tweet["first_name"] . " " . $tweet["last_name"] . " @" . $tweet["screen_name"];
				// Check for retweet
				if ('0' !== $tweet["original_tweet_id"])
				{
					$name             = "";
					$originalTwUserID = $tweet['original_tweet_id'];
					$namesql          = "SELECT first_name ,last_name  FROM users where user_id={$originalTwUserID}";//.$originalTwID; //. $tweet['original_tweet_id'];
					$nameArray        = self::GetQuerryResult($namesql)->fetch_array();

					$name .= $nameArray["first_name"] . " ";
					$name .= $nameArray["last_name"];
					//$retweetInfo = " Retweeted From " . $name;
					$retweetInfo .= " <strong>Retweeted From " . $name . "</strong> ";
				}
				else if ($tweet["reply_to_tweet_id"] != '0')
				{
					echo "this is a reply";
				}
				else
				{
					$retweetInfo = "";
				}

				$dateTweeted = $tweet["date_created"];
				$now         = new DateTime();
				$tweetTime   = new DateTime($dateTweeted);
				$interval    = $tweetTime->diff($now);
				$userTweet   = $tweet["tweet_text"];
				$tweetUserid = $tweet["tw_user_id"];

				echo "<a href='userpage?user_id=$tweetUserid'>" . $userLine . "</a> ";
				//
				if ($interval->y > 1) echo $interval->format('%y years') . " ago";
				elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
				elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
				elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
				elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
				elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
				elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
				elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
				elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
				elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
				elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
				elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";
				//
				echo $retweetInfo;
				//
				echo '<br>';
				echo $userTweet;
				echo '<br>';


				echo "<a  href='#'><img src='Images/like.ico' class='smallicon' ></a>"; // TODO : To be implemented
				/*
				Retweet href will redirect to retweet.php and will contain loggen in userline (fname,lname,screenName,time)
					+ "retweeted from" + NAME OF TWEET AUTHOR + tweet text + like,retweet,reply
				Data already in session:
					-User Data(user name,user id)
				*/

				$tweetid     = $tweet["tweet_id"];
				$retweetHref = "retweet.php?tweetid=$tweetid"; // tweet id and id of user who posted the tweet

				echo "<a  href='$retweetHref'><img src='Images/retweet.png' class='smallicon' ></a>";
				echo "<a  href='../reply.php?tweetid={$tweetid}'><img src='Images/reply.png' class='smallicon' ></a>"; // js to display a form that when submitted takes user to reply prop page then back to index
				//Textarea and button


				echo '<br><hr><br>';
			}

		}
	}


	public function DisplayTweets($userId, $limit = 10)
	{
		date_default_timezone_set("America/Halifax");
		$sql = "SELECT users.first_name, users.last_name, users.screen_name, tweets.tweet_text,tweets.date_created, tweets.user_id as 'tw_user_id', tweets.*
                            FROM users INNER JOIN tweets ON users.user_id = tweets.user_id
                            WHERE users.user_id in (Select follows.to_id FROM follows where follows.from_id = '$userId') or  users.user_id = '$userId'
                            ORDER BY date_created desc LIMIT {$limit} ";

		$retweetInfo = "";
		if ($tweets_qerry = self::GetQuerryResult($sql))
		{
			while ($tweet = mysqli_fetch_array($tweets_qerry))
			{
				$userLine = $tweet["first_name"] . " " . $tweet["last_name"] . " @" . $tweet["screen_name"];
				// Check for retweet
				if ('0' !== $tweet["original_tweet_id"])
				{
					$name             = "";
					$originalTwUserID = $tweet['original_tweet_id'];
					$namesql          = "SELECT first_name ,last_name  FROM users where user_id={$originalTwUserID}";//.$originalTwID; //. $tweet['original_tweet_id'];
					$nameArray        = self::GetQuerryResult($namesql)->fetch_array();

					$name .= $nameArray["first_name"] . " ";
					$name .= $nameArray["last_name"];
					//$retweetInfo = " Retweeted From " . $name;
					$retweetInfo .= " <strong>Retweeted From " . $name . "</strong> ";
				}
				else if ($tweet["reply_to_tweet_id"] != '0')
				{
					echo "this is a reply";
				}
				else
				{
					$retweetInfo = "";
				}

				$dateTweeted = $tweet["date_created"];
				$now         = new DateTime();
				$tweetTime   = new DateTime($dateTweeted);
				$interval    = $tweetTime->diff($now);
				$userTweet   = $tweet["tweet_text"];
				$tweetUserid = $tweet["tw_user_id"];

				echo "<a href='userpage?user_id=$tweetUserid'>" . $userLine . "</a> ";
				//
				if ($interval->y > 1) echo $interval->format('%y years') . " ago";
				elseif ($interval->y > 0) echo $interval->format('%y year') . " ago";
				elseif ($interval->m > 1) echo $interval->format('%m months') . " ago";
				elseif ($interval->m > 0) echo $interval->format('%m month') . " ago";
				elseif ($interval->d > 1) echo $interval->format('%d days') . " ago";
				elseif ($interval->d > 0) echo $interval->format('%d day') . " ago";
				elseif ($interval->h > 1) echo $interval->format('%h hours') . " ago";
				elseif ($interval->h > 0) echo $interval->format('%h hour') . " ago";
				elseif ($interval->i > 1) echo $interval->format('%i minutes') . " ago";
				elseif ($interval->i > 0) echo $interval->format('%i minute') . " ago";
				elseif ($interval->s > 1) echo $interval->format('%s seconds') . " ago";
				elseif ($interval->s > 0) echo $interval->format('%s second') . " ago";
				//
				echo $retweetInfo;
				//
				echo '<br>';
				echo $userTweet;
				echo '<br>';


				echo "<a  href='#'><img src='Images/like.ico' class='smallicon' ></a>"; // TODO : To be implemented
				/*
				Retweet href will redirect to retweet.php and will contain loggen in userline (fname,lname,screenName,time)
					+ "retweeted from" + NAME OF TWEET AUTHOR + tweet text + like,retweet,reply
				Data already in session:
					-User Data(user name,user id)
				*/

				$tweetid     = $tweet["tweet_id"];
				$retweetHref = "retweet.php?tweetid=$tweetid"; // tweet id and id of user who posted the tweet

				echo "<a  href='$retweetHref'><img src='Images/retweet.png' class='smallicon' ></a>";
				echo "<a  href='../reply.php?tweetid={$tweetid}'><img src='Images/reply.png' class='smallicon' ></a>"; // js to display a form that when submitted takes user to reply prop page then back to index
				//Textarea and button


				echo '<br><hr><br>';
			}

		}
	}

	public function ReTweet($originalTweetId, $TweetUserId)
	{
		$tweetarray = $this->GetTweet($originalTweetId);
//		$this->InsertTweet($tweetarray["tweet_text"], $TweetUserId);
		$this->InsertTweet($tweetarray["tweet_text"], $TweetUserId, $tweetarray["tweet_id"]);
	}

	public function GetTweet($tweetID)
	: array
	{
		$sql         = "SELECT * FROM bitter_marcub.tweets where tweet_id=" . $tweetID;
		$tweet_qerry = self::GetQuerryResult($sql);
		return mysqli_fetch_array($tweet_qerry);
	}

	public function InsertTweet($tweetText, $userID, $originalTweetId = 0, $replyToTweetId = 0)
	{
		// INSERT STATEMENT
		global $con;
		$text = mysqli_real_escape_string($con, $tweetText);
		$sql  = "INSERT INTO tweets (tweet_text, user_id, original_tweet_id, reply_to_tweet_id) VALUES ( '$text', '$userID','$originalTweetId','$replyToTweetId' )";
		if (mysqli_query($con, $sql))
		{
			if (mysqli_affected_rows($con) == 1)
			{
				$message = "Tweet successful";
				header("location:index.php?message=$message");
			}
			else
			{
				$message = "Tweet failed";
				header("location:index.php?message=$message");
			}
		}
		else
		{
			$message = "Tweet Query failed";
			header("location:index.php?message=$message");
		}
	}

	/**
	 * @return mixed
	 */
	public function getTweetId()
	{
		return $this->tweetId;
	}

	/**
	 * @param mixed $tweetId
	 */
	public function setTweetId($tweetId)
	: void
	{
		$this->tweetId = $tweetId;
	}

	/**
	 * @return mixed
	 */
	public function getTweetText()
	{
		return $this->tweetText;
	}

	/**
	 * @param mixed $tweetText
	 */
	public function setTweetText($tweetText)
	: void
	{
		$this->tweetText = $tweetText;
	}

	/**
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	: void
	{
		$this->userId = $userId;
	}

	/**
	 * @return mixed
	 */
	public function getOriginalTweetId()
	{
		return $this->originalTweetId;
	}

	/**
	 * @param mixed $originalTweetId
	 */
	public function setOriginalTweetId($originalTweetId)
	: void
	{
		$this->originalTweetId = $originalTweetId;
	}

	/**
	 * @return mixed
	 */
	public function getReplyToTweet()
	{
		return $this->replyToTweet;
	}

	/**
	 * @param mixed $replyToTweet
	 */
	public function setReplyToTweet($replyToTweet)
	: void
	{
		$this->replyToTweet = $replyToTweet;
	}

	/**
	 * @return mixed
	 */
	public function getDateAdded()
	{
		return $this->dateAdded;
	}

	/**
	 * @param mixed $dateAdded
	 */
	public function setDateAdded($dateAdded)
	: void
	{
		$this->dateAdded = $dateAdded;
	}


}