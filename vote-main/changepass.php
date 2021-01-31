<?php
require('connection.php');

session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['member_id'])){
 header("location:login-student.php");
}
$message="";
$error="";
//retrive student details from the tbmembers table
$result=mysqli_query($con, "SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from db
 $stdId = $row['member_id'];
  $encpass= $row['password'];
}
?>
<?php
// updating sql query
if (isset($_POST['changepass'])){
$myId =  $_REQUEST['id'];
$oldpass = md5($_POST['oldpass']);
$newpass = $_POST['newpass'];
$conpass = $_POST['conpass'];
if($encpass == $oldpass)
{
  if($newpass == $conpass)
  {
    $newpassword = md5($newpass); //This will make your password encrypted into md5, a high security hash
    $sql = mysqli_query($con,"UPDATE tbmembers SET password='$newpassword' WHERE member_id = '$myId'" );
    $message = "Your password updated!";
  }
  else
  {
    $error = "Your new pass and confirm pass not match!";
  }

}
else
{
   $error = "Your old pass not match!";
}


// redirect back to profile
// header("Location: manage-profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive student Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, student, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>UiTM Voting System</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="css/widgets.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/xcharts.min.css" rel=" stylesheet">
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  <link href="img/vote.jpg" rel="icon">
  <link href="img/vote.jpg" rel="apple-touch-icon">
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="student.php" class="logo">Secure <span class="lite">Vote</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
            <a href="#" data-toggle="modal" data-target="#logout-student" class="btn btn-warning btn-lg">Logout</a>
        </ul>
      </div>
    </header>
    <!--header end-->

    <!-- Logout student start-->
      <div id="logout-student" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Student Logout</h4>
              <button data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <center><div class="form-group"><br>
                  <a href="logout.php" class="btn btn-primary">Logout</a>
          </div></center>
      <br><h5><center>You are going to leave this system </center></h5>
            </div>
          </div>
        </div>
      </div>
      <!-- Logout student end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li>
            <a class="" href="student.php">
                          <i class="icon_house_alt"></i>
                          <span>Home</span>
                      </a>
          </li>
          <li>
            <a class="" href="vote.php">
                          <i class="icon_piechart"></i>
                          <span>Current Polls</span>
                      </a>
          </li>
          <li>
            <a class="" href="manage-profile.php">
                          <i class="icon_genius"></i>
                          <span>Manage My Profile</span>
                      </a>
          </li>
          <li class="active">
            <a class="" href="changepass.php">
                          <i class="icon_key"></i>
                          <span>Change Password</span>
                      </a>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="icon_key"></i> Change Password</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="student.php">Home</a></li>
              <li><i class="icon_key"></i>Change Password</li>
            </ol>
          </div>
        </div>

        <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Change Password
              </header>
              <div class="panel-body">
                        <?php if($error != "") {
                        echo
                        '<div class="alert alert-danger fade in">
                          <button data-dismiss="alert" class="close close-sm" type="button">
                                              <i class="icon-remove"></i>
                                          </button>
                          <strong>Error!</strong> '. $error . '
                        </div>'; }?>
                        <?php if($message != "") {
                        echo
                        '<div class="alert alert-success fade in">
                          <button data-dismiss="alert" class="close close-sm" type="button">
                                              <i class="icon-remove"></i>
                                          </button>
                          <strong>Nice!</strong> '. $message . '
                        </div>'; }?>
                <form action="changepass.php?id=<?php echo $_SESSION['member_id']; ?>" method="post">
                  <div class="form-group">
                    <label for="exampleInputPassword">Old Password</label>
                    <input name="oldpass" type="password" class="form-control" id="exampleInputPassword" placeholder="Enter Old Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input name="newpass" minlength="5" type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter New Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">Confirm Password</label>
                    <input name="conpass" minlength="5" type="password" class="form-control" id="exampleInputPassword2" placeholder="Re-enter New Password">
                  </div>
                  <center><button name="changepass" type="submit" class="btn btn-success">Change</button></center>
                </form>

              </div>
            </section>
          </div>

        <!--/.row-->
      </section>

      <div class="text-center">
        <div class="copyright">
        &copy; Copyright <strong><span>Voting System Inc</span></strong>
      </div>
        <div class="credits">
          Designed by <a href="#">Iqbal</a>
        </div>
      </div>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <<script src="js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>

</body>

</html>
