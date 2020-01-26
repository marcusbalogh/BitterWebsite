<?php	session_start();
//If a user is already logged in, and they try to access login.php or signup.php, you must redirect them to index.php

if (isset($_SESSION['SESS_USER'])) header("location:index.php");
if (isset($_GET["message"]))
{
	$message = $_GET["message"];
	if ($message != "")
	{
		echo "<script>alert('$message')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bitter - Sign up for a new account to this bitter awesome trolling website.">
    <meta name="author" content="Marcus B. balogh.marcu@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Signup - Bitter</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
            integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
    </script>

    <script src="includes/bootstrap.min.js"></script>

    <script src="jsFormValidation.js"></script>
</head>

<body>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <a class="navbar-brand" href="index.php"><img src="images/logo.jpg" class="logo"></a>

        <a class="nav-link" href="http://localhost/contactus">
            <img class="bannericons" src="images/phone-book.png">Contact Us</a>
    </div>
</nav>

<BR><BR>
<div class="container">
    <div class="row">

        <div class="main-login main-center">
            <h5>Sign up once and troll as many people as you like!</h5>
            <form method="post" id="registration_form" action="signup_proc.php">

                <div class="form-group">
                    <!--    First Name   -->
                    <label for="firstname" class="cols-sm-2 control-label">First Name</label>
					<?php /* ****Required for proc isset if statement**** */ ?>
					<?php /*First Name max length 50*/ ?>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" required name="firstname" id="firstname"
                                   maxlength="50" placeholder="Enter your First Name" autofocus/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    Last Name   -->
                    <label for="lastname" class="cols-sm-2 control-label">Last Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /*Last Name max length 50*/ ?>
                            <input type="text" class="form-control" required name="lastname" id="lastname"
                                   maxlength="50" placeholder="Enter your Last Name"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--   Email   -->
                    <label for="email" class="cols-sm-2 control-label">Your Email</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /*Email max length 100*/ ?>
                            <input type="email" class="form-control" required
                                   maxlength="100" name="email" id="email" placeholder="Enter your Email"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    Screen Name / Username   -->
                    <label for="username" class="cols-sm-2 control-label">Screen Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /*Username max length 15*/ ?>
                            <input type="text" class="form-control" required name="username" id="username"
                                   maxlength="15" placeholder="Enter your Screen Name"/>
                        </div>
                    </div>
                    <span id="username-message" class="confirm-message"></span>
                </div>

                <div class="form-group">
                    <!--    Password   -->
                    <label for="password" class="cols-sm-2 control-label">Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /*Password max length 250 */ ?>
                            <input type="password" class="form-control" required name="password" id="password"
                                   maxlength="250" placeholder="Enter your Password"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    Confirm Password   -->
                    <label if='confirmLabel' for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group">

                            <input type="password" class="form-control" required name="confirm" id="confirm"
                                   placeholder="Confirm your Password"/><br><br>
                        </div>
                    </div>
                    <span id="confirm-message" class="confirm-message"></span>
                </div>

                <div class="form-group">
                    <!--    Phone Number   -->
                    <label for="phone" class="cols-sm-2 control-label">Phone Number</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /*Phone max length 25 */ ?>
                            <input type="text" class="form-control" required name="phone" id="phone"
                                   placeholder="Format: 123 123 1234"
                                   pattern="[0-9]{3}\s[0-9]{3}\s[0-9]{4}" maxlength="25"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    Address   -->
                    <label for="name" class="cols-sm-2 control-label">Address</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /*Address max length 200 */ ?>
                            <input type="text" class="form-control" required name="address" id="address"
                                   maxlength="200" placeholder="Enter your Address"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    Province   -->
                    <label for="name" class="cols-sm-2 control-label">Province</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <select name="province" id="province" class="textfield1"
                                    required><?php echo $vprovince; ?>
                                <option></option>
                                <option value="British Columbia">British Columbia</option>
                                <option value="Alberta">Alberta</option>
                                <option value="Saskatchewan">Saskatchewan</option>
                                <option value="Manitoba">Manitoba</option>
                                <option value="Ontario">Ontario</option>
                                <option value="Quebec">Quebec</option>
                                <option value="New Brunswick">New Brunswick</option>
                                <option value="Prince Edward Island">Prince Edward Island</option>
                                <option value="Nova Scotia">Nova Scotia</option>
                                <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                <option value="Northwest Territories">Northwest Territories</option>
                                <option value="Nunavut">Nunavut</option>
                                <option value="Yukon">Yukon</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    Postal Code   -->
                    <label for="name" class="cols-sm-2 control-label">Postal Code</label>
                    <div id="badPostalCode" class="hide alert alert-danger ">
                        Invalid Postal Code.
                    </div>
                    <div id="goodPostalCode" class="hide alert alert-success">
                        Postal Code is valid.
                    </div>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /*Postal Code max length 7 */ ?>
                            <input type="text" class="form-control" required name="postalCode" id="postalCode"
                                   pattern="[A-Za-z][1-9][A-Za-z]\s[1-9][A-Za-z][1-9]" placeholder="Format: A1A 1A1"/>
                            <!---->
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    URL   -->
                    <label for="name" class="cols-sm-2 control-label">Url</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /* URL max length 50 */ ?>
                            <input type="text" class="form-control" name="url" id="url"
                                   maxlength="50" placeholder="Enter your URL"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    Description   -->
                    <label for="name" class="cols-sm-2 control-label">Description</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /* Desc max length 160 */ ?>
                            <input type="text" class="form-control" name="desc" id="desc"
                                   maxlength="160" placeholder="Description of your profile"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!--    Location   -->
                    <label for="name" class="cols-sm-2 control-label">Location</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
							<?php /* Location max length 50 */ ?>
                            <input type="text" class="form-control" name="location" id="location"
                                   maxlength="50" placeholder="Enter your Location"/>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <input type="submit" name="button" id="button" value="Register"
                           class="btn btn-primary btn-lg btn-block login-button"/>
                </div>
            </form>
        </div>
    </div> <!-- end row -->
</div><!-- /.container -->
</body>

</html>