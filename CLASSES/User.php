<?php
/*
    Got inspired from here:
    https://github.com/davidlpz/php-user-class/blob/master/classes/class.user.php
*/
include_once 'connect.php';

class User
{
	private $msg; // fix this so it only appears per event
	private $userId;
	private $userName;
	private $email;
	private $password;
	private $hashedPassword;
	private $firstName;
	private $lastName;
	private $address;
	private $province;
	private $contactNo;
	private $postalCode;
	private $dateAdded;
	private $location;
	private $url;
	private $desc;
	private $profImage;

	public static function unsterilizeThis(String $s)
	: User
	{
		try
		{
			return unserialize($s);
		}
		catch (Exception $ex)
		{
			return null;
		}
	}

	public function EditPhoto()
	{
		if (empty($_FILES["pic"]["name"]))
		{
			$message = "Error: Please select a file!";
			header("location:edit_photo.php?message=$message");
		}
		else if ($_FILES['pic']['size'] > (1024 * 1024 * 3))
		{ //bigger than 1mb
			unlink($_FILES['pic']['tmp_name']);
			$message = "Error: File too big.";
			header("location:edit_photo.php?message=$message");
		}
		else
		{   // good scenario

			$memId = $this->userId;
			global $con;
			if (move_uploaded_file($_FILES['pic']['tmp_name'], "Images/profilepics/" . $_FILES['pic']['name']))
			{

				$newPicLocation = "Images/profilepics/" . $memId . ".jpg";
				if (rename("Images/profilepics/" . $_FILES['pic']['name'], $newPicLocation))
				{

					// Update current user profile pic in DB

					$userID = $memId;
					$sql    = "UPDATE users SET profile_pic = '$newPicLocation' WHERE user_id ='$userID'";

					if (mysqli_query($con, $sql))
					{
						$_SESSION["SESS_MEMBER_PIC"] = $newPicLocation;
						$message                     = "Success: Profile Picture changed successfully";
						header("Refresh:0; url=index.php?message=$message");
					}
					else
					{
						$message = "Error: DB error";
						header("location:edit_photo.php?message=$message");
					}

					//


				}
				else
				{
					$message = "Error: Could not rename file";
					header("location:edit_photo.php?message=$message");
				}

			}
			else
			{

				unlink($_FILES['pic']['tmp_name']);
				// back to upload page with a get message saying uploaded failed
				echo 'Error: Uploaded files where not moved to the correct location';
				$message = "Error: Uploaded files where not moved to the correct location.";
				header("location:edit_photo.php?message=$message");
			}
		}
	}

	public function Register()
	: bool
	{
		global $con;
		$isSuccessful = false;

		if (!empty($_POST['username']) && isset($_POST['username']))
		{ // username goes through _POST and is not empty


			$fName      = mysqli_real_escape_string($con, $_POST["firstname"]);
			$lName      = mysqli_real_escape_string($con, $_POST["lastname"]);
			$email      = mysqli_real_escape_string($con, $_POST["email"]);
			$username   = mysqli_real_escape_string($con, $_POST["username"]);
			$password   = mysqli_real_escape_string($con, $_POST["password"]);
			$phone      = mysqli_real_escape_string($con, $_POST["phone"]);
			$address    = mysqli_real_escape_string($con, $_POST["address"]);
			$province   = mysqli_real_escape_string($con, $_POST["province"]);
			$postalCode = mysqli_real_escape_string($con, $_POST["postalCode"]);
			$url        = mysqli_real_escape_string($con, $_POST["url"]);
			$desc       = mysqli_real_escape_string($con, $_POST["desc"]);
			$location   = mysqli_real_escape_string($con, $_POST["location"]);


			$hashPass = password_hash($password, PASSWORD_DEFAULT);
			$querySQL = "INSERT INTO users(first_name, last_name, screen_name,password,address,province,postal_code,contact_number,email,url,description,location) VALUES('$fName','$lName','$username','$hashPass','$address','$province','$postalCode','$phone','$email','$url','$desc','$location')";

			if (!self::Exists($username))
			{
				if (mysqli_query($con, $querySQL))
				{
					// User Created
					$isSuccessful = true;
					$this->msg    = "Sign up complete";
				}
				else
				{
					$this->msg = 'The Following Query Failed: \n ' . $querySQL;
				}
			}
			else
			{
				$this->msg = "Duplicate username :(";
			}

		}
		else
		{
			$this->msg = "Username goes through _POST and is not empty returned false";
		}
		return $isSuccessful;
	}

	// Get User From DB

	public function Exists($userName)
: bool
{
	$sql    = "SELECT screen_name from users where screen_name = '$userName'";
	$result = mysqli_num_rows($this->GetQuerryResult($sql));
	if ($result >= 1) return true;
	return false;
}

	public function GetQuerryResult($sql)
	{
		global $con;
		$queryResult = mysqli_query($con, $sql)
		or die(" Could not connect using : " . $sql . " : " . mysqli_connect_error());
		return $queryResult;
	}

	public function UpdateUser($field, $value)
	{
		global $con;
		$sql = "Update users SET " . $field . "=" . $value . " Where user_id= " . self::getUserId();
		if ($query_update_user = mysqli_query($con, $sql))
		{
			if (mysqli_affected_rows($con) == 1)
			{
				// refresh userInfo from database by logging in again
				self::Login($this->userName, $this->password);
			}
			else
			{
				$message = "User Update failed";
				header("location:index.php?message=$message");
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	public function Login($username, $password)
	{
		$dbPasswordResult = self::GetQuerryResult("Select password from users 
							Where (screen_name LIKE UPPER('$username' )OR screen_name LIKE LOWER('$username'))");
		if (mysqli_num_rows($dbPasswordResult) == 1)
		{
			$hashedPass = mysqli_fetch_array($dbPasswordResult)["password"];
			if (password_verify($password, $hashedPass))
			{
				// Make username case insensitive
				$sql = "SELECT first_name , last_name , user_id , profile_pic FROM users 
							WHERE (screen_name LIKE UPPER('$username' )OR screen_name LIKE LOWER('$username')) AND password = '$hashedPass'";

				$result = self::GetQuerryResult($sql);
				if (mysqli_num_rows($result) == 1) // returned one row from db with user info
				{
					$this->msg             = "after get query";
					$user                  = mysqli_fetch_array(self::GetQuerryResult($sql));
					$this->firstName       = $user["first_name"];
					$this->lastName        = $user["last_name"];
					$this->userId          = $user["user_id"];
					$this->profImage       = $user["profile_pic"];
					$this->msg             = "Log in successful :) Welcome " . $this->firstName . ' ' . $this->userId;
					$_SESSION['SESS_USER'] = serialize($this);  // retrieve this on index page
					header("location:index.php?message=Log in successful :) Welcome " . $this->firstName . ' ' . $this->userId);
				}
				else
				{
					$this->msg = 'Could not find user with this password';

					//header("location:Login.php?message=" . $this->getMsg());
				}

			}
			else
			{
				$this->msg = 'Passwords do not match';

				//header("location:Login.php?message=" . $this->getMsg());
			}
		}
		else
		{
			$this->msg = 'Could not find password from user in DB';
			//header("location:Login.php?message=" . $this->getMsg());

		}
	}

	public function DeleteUser($userId)
	{
		global $con;
		$sql = "Delete from users Where user_id= " . $userId;
		if ($query_update_user = mysqli_query($con, $sql))
		{
			if (mysqli_affected_rows($con) == 1)
			{
				$message = "User Deleted";
				header("location:login.php?message=$message");
			}
			else
			{
				$message = "User Delete failed";
				header("location:index.php?message=$message");
			}
		}
	}

	public function SearchUserWithTextQResult($criteria)
	: mysqli_result
	{
		$strSQL = "SELECT first_name, last_name, user_id, screen_name FROM users 
					WHERE first_name like '%{$criteria}%' or last_name like '%{$criteria}%' or screen_name like '%{$criteria}%' ";
		return self::GetQuerryResult($strSQL);
	}

	public function GetUsersToFollowQResult($memId, $limit = 3)
	: mysqli_result
	{
		$strSQL = "SELECT first_name, last_name, user_id, screen_name FROM users 
					WHERE user_id <> $memId 
						AND user_id Not IN(Select to_id from follows where from_id = $memId )
					ORDER BY RAND() LIMIT $limit";
		return self::GetQuerryResult($strSQL);
	}

	public function GetFollowersYouKnowQResult($userpage_user, $loggedin_user, $limit = 3)
	: mysqli_result
	{
		$strSQL = "SELECT first_name, last_name, user_id, screen_name FROM users 
					WHERE user_id IN(SELECT distinct(to_id) as 'user_id' FROM follows where from_id= {$loggedin_user} and to_id in (select to_id from follows where from_id= {$userpage_user} and to_id <>{$loggedin_user}) and to_id <>{$userpage_user} )
					ORDER BY RAND() LIMIT $limit";
		//$sql    = "SELECT to_id as 'no' FROM follows where from_id= {$loggedin_user} and to_id in (select to_id from follows where from_id= {$userpage_user} and to_id <>{$loggedin_user}) and to_id <>{$userpage_user}";
		return self::GetQuerryResult($strSQL);
	}

	public function FollowUser($follow_user_id, $screen_name)
	{
		$sql = "INSERT INTO follows (`from_id`, `to_id`) VALUES (" . self::getUserId() . ", '$follow_user_id')";

		global $con;
		$message = 'following ' . $screen_name;

		if (mysqli_query($con, $sql)) header("location:index.php?message=$message");
		else echo "Error: " . $sql . "<br>" . mysqli_error($con);


	}

	// return an array with all user details

	public function DisplayNoFollowing($memId)
	{
		$following = -5;
		if ($no_of_following_querry = self::GetQuerryResult("SELECT count(to_id) FROM follows where from_id =" . $memId))
		{
			$no_of_following_array = mysqli_fetch_array($no_of_following_querry);
			$following             = $no_of_following_array["count(to_id)"];
		}
		return $following;

	}

	public function toArray($userId)
	{
		$sql       = "SELECT * FROM bitter_marcub.users WHERE user_id=" . $userId;
		$userquery = self::GetQuerryResult($sql);
		return mysqli_fetch_array($userquery);

	}

	public function FollowingUser($me_id, $notme_id)
	: bool
	{
		$following = true;
		$sql       = "Select * from bitter_marcub.follows WHERE from_id = {$me_id} AND to_id={$notme_id} AND to_id <> {$me_id}";
		//$sql = "select user_id, first_name, last_name, screen_name, profile_pic from users where user_id != {$notme_id} and user_id != {$me_id} "
		//. "and user_id IN (SELECT to_id from follows where from_id={$notme_id}) "
		//. "and user_id IN (SELECT to_id from follows where from_id={$me_id}) order by rand() limit 3";
		if ($followingQ = self::GetQuerryResult($sql))
		{
			$following_array = mysqli_fetch_array($followingQ);
			if ($following_array["from_id"] == null) $following = false;
			// Doesn't hide the current user as it should
			//if ($following_array["user_id"] == self::getUserId()) $following = false;
		}
		return $following;
	}

	/**
	 * @return mixed
	 */
	public function getMsg()
	{
		return $this->msg;
	}

	/**
	 * @return mixed
	 */
	public function getUserName()
	{
		return $this->userName;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @return mixed
	 */
	public function getHashedPassword()
	{
		return $this->hashedPassword;
	}

	/**
	 * @return mixed
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @return mixed
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @return mixed
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @return mixed
	 */
	public function getProvince()
	{
		return $this->province;
	}

	/**
	 * @return mixed
	 */
	public function getContactNo()
	{
		return $this->contactNo;
	}

	/**
	 * @return mixed
	 */
	public function getPostalCode()
	{
		return $this->postalCode;
	}

	/**
	 * @return mixed
	 */
	public function getDateAdded()
	{
		return $this->dateAdded;
	}

	/**
	 * @return mixed
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @return mixed
	 */
	public function getDesc()
	{
		return $this->desc;
	}

	/**
	 * @return mixed
	 */
	public function getProfImage()
	{
		return $this->profImage;
	}
}