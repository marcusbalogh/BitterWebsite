<?php

//  CH 19 Secure PHP Programming

//	Windows Apache MySql Php - WAMP
//  Php.ini initialization file for php
//  CH 19: 3 layer architecture
//  http.conf-for the (apache)

//  VULNERABILITIES
//1. Software - what is the architecture for the server?
//2. User Input - SQL injection
//3. Unprotected data - where is the data stored?

/*  PHP.ini - max_execution_time, show_errors, disable_functions, disable_classes
 *
 *  httpd.conf - AddType: hide that this is a .php
 *             - Add handler - change all files to .abc
 *             - ServerSignatures - all my web files will be in the same folder
 *             - ServerTokens - It will give all errors server details other values: "Prod"
 *
 *
 *  /phpinfo.php - move me to a dif folder for security purposes
 */


$myString = "Hello world";
echo md5($myString);

//Initialization vector ??
$iv      = mcrypt_create_iv(0, MCRYPT_DEV_RANDOM);
$key     = "secret";
$message = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $myString, MCRYPT_MODE_CBC, $iv);