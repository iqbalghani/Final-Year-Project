<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
require('../connection.php');

$message="";
$tbl_name="tbAdministrators"; // Table name


// Defining your login details into variables
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$encrypted_mypassword=md5($mypassword); //MD5 Hash for security

// MySQL injection protections
$myusername = stripslashes($myusername);
$mypassword = stripslashes($encrypted_mypassword);

//$myusername = mysqli_real_escape_string($myusername);
//$mypassword = mysqli_real_escape_string($mypassword);

//echo $mypassword." ".$myusername;

$sql=mysqli_query($con, "SELECT * FROM tbadministrators WHERE email='$myusername' and password='$mypassword'");
// Checking table row
$count = mysqli_num_rows($sql);

// If username and password is a match, the count will be 1
if($count)
{
// If everything checks out, you will now be forwarded to admin.php

  $user=mysqli_fetch_assoc($sql);
  $_SESSION['admin_id'] = $user['admin_id'];
  header("location:admin.php");
}
//If the username or password is wrong, you will receive this message below.
else {
  $message = "Wrong username or password";
  }

ob_end_flush();
?>