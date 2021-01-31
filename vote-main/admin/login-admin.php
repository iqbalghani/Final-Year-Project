<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="../img/favicon.png">

  <title>UiTM Voting System</title>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="../css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="../css/elegant-icons-style.css" rel="stylesheet" />
  <link href="../css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet" />
</head>

    <?php //include 'checklogin.php' ?>

    <?php
    ini_set ("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
require('../connection.php');

$message="";
$tbl_name="tbAdministrators"; // Table name


// Defining your login details into variables
if(isset($_POST['login']))  
    {  
        $user_name=$_POST['myusername'];  
        $user_pass=$_POST['mypassword'];  

        $user_pass=md5($user_pass);
      
        $check_user="select * from tbadministrators WHERE email='$user_name'AND password='$user_pass'";  
      
        $run=mysqli_query($con,$check_user);  
      
        if(mysqli_num_rows($run))  
        {  
            echo "<script>window.open('admin.php','_self')</script>";  
            $user=mysqli_fetch_assoc($run);
            $_SESSION['admin_id'] = $user['admin_id'];//here session is used and value of $user_email store in $_SESSION.  
      
        }  
        else  
        {  
          $message = "Incorrect username or password.";
          //echo "<script>alert('Email or password is incorrect!')</script>";  
        }  
    }  

ob_end_flush();
    ?>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" method="post" action="">
      <div class="login-wrap">
        <?php if($message != "") {
                        echo
                        '<div class="alert alert-danger fade in">
                          <button data-dismiss="alert" class="close close-sm" type="button">
                                              <i class="icon-remove"></i>
                                          </button>
                          <strong>OhNo!</strong> '. $message . '
                        </div>'; }?>
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input name="myusername" type="text" class="form-control" placeholder="Email" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input name="mypassword" type="password" class="form-control" placeholder="Password">
        </div>
        <br>
        <button name="login" class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        <br>
        <center><a href="../index.php" class="btn btn-warning"><i class="fa fa-home"></i> Home</a></center>
      </div>
    </form>
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

</html>
