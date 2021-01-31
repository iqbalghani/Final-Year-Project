<?php

$key = 'hai,namasayaiqbal,umur23tahunlahir31011997.andthisismyfypprojecton2020.thankyou.';

function encryptthis($data,$key){
    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($data, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    $cdata = base64_encode( $iv.$hmac.$ciphertext_raw );
    return $cdata;}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>UiTM Voting System</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
</head>

<?php include 'checklogin.php'; ?>

<body class="login-img3-body">

  <div class="container">

    <?php
require('connection.php');
//Process
if (isset($_POST['submit']))
{

$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];
$myPassword = $_POST['password'];

$emyFirstName = encryptthis( $myFirstName, $key ); //prevents types of SQL injection
$emyLastName = encryptthis( $myLastName, $key ); //prevents types of SQL injection

$newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash

$sql = mysqli_query($con, "INSERT INTO tbMembers(first_name, last_name, email,password)
VALUES ('$emyFirstName','$emyLastName', '$myEmail', '$newpass') ");

die( "You have registered for an account.<br><br>Go to <a href=\"login-student.php\">Login</a>" );
}

echo "<center><h3>Register an account by filling in the needed information below:</h3></center><br><br>";
echo '<form class="login-form" action="registeracc.php" method="post" onsubmit="return registerValidate(this)">';
echo '<table align="center"><tr><td>';
echo "<tr><td>First Name:</td><td><input type='text' class='form-control' name='firstname' maxlength='15' value='' required></td></tr>";
echo "<tr><td>Last Name:</td><td><input type='text' class='form-control' name='lastname' maxlength='15' value='' required></td></tr>";
echo "<tr><td>Email Address:</td><td><input type='email' class='form-control' name='email' maxlength='100' id='email'value='' required></td><td><span id='result' style='color:red;'></span></td></tr>";
echo "<tr><td>Password:</td><td><input type='password' class='form-control' name='password' maxlength='15' value='' required></td></tr>";
echo "<tr><td>Confirm Password:</td><td><input type='password' class='form-control' name='ConfirmPassword' maxlength='15' value='' required></td></tr>";
echo "<tr><td>&nbsp;</td><td><input type='submit' class='btn btn-primary btn-lg btn-block' name='submit' value='Register Account'/></td></tr>";
echo "<tr><td colspan = '2'><p>Already have an account? <a href='login-student.php'><b>Login Here</b></a></td></tr>";
echo "</tr></td></table>";
echo "</form>";
?>
    <div class="text-right">
      <div class="copyright">
        &copy; Copyright <strong><span>Voting System Inc</span></strong>
      </div>
      <div class="credits">
          Designed by <a href="#">Iqbal</a>
        </div>
    </div>
  </div>


</body>
<script src="js/jquery-1.2.6.min.js"></script>
    <script>
    $(document).ready(function(){

        $('#email').blur(function(event){

            event.preventDefault();
            var emailId=$('#email').val();
                                $.ajax({
                            url:'checkuser.php',
                            method:'post',
                            data:{email:emailId},
                            dataType:'html',
                            success:function(message)
                            {
                            $('#result').html(message);
                            }
                      });



        });

    });

    </script>

</html>
