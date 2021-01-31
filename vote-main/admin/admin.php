<?php
session_start();
require('../connection.php');

$key = 'hai,namasayaiqbal,umur23tahunlahir31011997.andthisismyfypprojecton2020.thankyou.';

function decryptthis($cdata,$key){
$c = base64_decode($cdata);
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
$iv = substr($c, 0, $ivlen);
$hmac = substr($c, $ivlen, $sha2len=32);
$ciphertext_raw = substr($c, $ivlen+$sha2len);
$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
{
    return $original_plaintext;
  }
}

//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:login-admin.php");
}
?>
    <?php
    $admin = $_SESSION['admin_id'];
    include '../connection.php';
    $query = "SELECT *
         FROM tbadministrators WHERE admin_id='$admin'";
    $result = mysqli_query($con, $query) or die('SQL error admin');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    ?>

    <?php
      $counterA=0;
      $a = "SELECT * FROM tbcandidates";
      $aa = mysqli_query($con, $a) or die('SQL error count candidates');
      while(mysqli_fetch_array($aa,MYSQLI_ASSOC))
      {
      ?>
        <?php $counterA++; ?>
      <?php
      }
    ?>

    <?php
      $counterB=0;
      $b = "SELECT * FROM tbpositions";
      $bb = mysqli_query($con, $b) or die('SQL error count positions');
      while(mysqli_fetch_array($bb,MYSQLI_ASSOC))
      {
      ?>
        <?php $counterB++; ?>
      <?php
      }
    ?>

    <?php
      $counterC=0;
      $c = "SELECT * FROM tbmembers";
      $cc = mysqli_query($con, $c) or die('SQL error count students');
      while(mysqli_fetch_array($cc,MYSQLI_ASSOC))
      {
      ?>
        <?php $counterC++; ?>
      <?php
      }
    ?>

    <?php
      $counterD=0;
      $d = "SELECT * FROM tblvotes";
      $dd = mysqli_query($con, $d) or die('SQL error count votes');
      while(mysqli_fetch_array($dd,MYSQLI_ASSOC))
      {
      ?>
        <?php $counterD++; ?>
      <?php
      }
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
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="../css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="../css/elegant-icons-style.css" rel="stylesheet" />
  <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="../assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="../assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="../assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="../css/owl.carousel.css" type="text/css">
  <link href="../css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="../css/widgets.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet" />
  <link href="../css/xcharts.min.css" rel=" stylesheet">
  <link href="../css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  <link href="../img/vote.jpg" rel="icon">
  <link href="../img/vote.jpg" rel="apple-touch-icon">
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="admin.php" class="logo">Secure <span class="lite">Vote</span></a>
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
            <a href="#" data-toggle="modal" data-target="#logout-admin" class="btn btn-warning btn-lg">Logout</a>
        </ul>
      </div>
    </header>
    <!--header end-->

    <!-- Logout admin start-->
      <div id="logout-admin" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Admin Logout</h4>
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
      <!-- Logout admin end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="admin.php">
                          <i class="icon_house_alt"></i>
                          <span>Home</span>
                      </a>
          </li>
          <li>
            <a class="" href="positions.php">
                          <i class="icon_genius"></i>
                          <span>Manage Positions</span>
                      </a>
          </li>
          <li>
            <a class="" href="candidates.php">
                          <i class="icon_genius"></i>
                          <span>Manage Candidates</span>
                      </a>
          </li>
          <li>
            <a class="" href="refresh.php">
                          <i class="icon_piechart"></i>
                          <span>Poll Results</span>
                      </a>
          </li>
          <li>
            <a class="" href="manage-admins.php">
                          <i class="icon_genius"></i>
                          <span>Manage Account</span>
                      </a>
          </li>
          <li>
            <a class="" href="change-pass.php">
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
            <h5 class="h1 text-center">Hi Admin, <?php echo decryptthis($row['first_name'], $key); ?>! </h5>
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="admin.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-user"></i>
              <div class="count"><?php echo $counterA ?></div>
              <div class="title">Candidates</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-thumbs-o-up"></i>
              <div class="count"><?php echo $counterB ?></div>
              <div class="title">Positions</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-user"></i>
              <div class="count"><?php echo $counterC ?></div>
              <div class="title">Students</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-thumbs-o-up"></i>
              <div class="count"><?php echo $counterD ?></div>
              <div class="title">Votes</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

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
  <script src="../js/jquery.js"></script>
  <script src="../js/jquery-ui-1.10.4.min.js"></script>
  <script src="../js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="../js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="../js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="../js/jquery.scrollTo.min.js"></script>
  <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="../assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="../js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="../assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="../js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <<script src="../js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="../assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="../js/calendar-custom.js"></script>
    <script src="../js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="../js/jquery.customSelect.min.js"></script>
    <script src="../assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="../js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="../js/sparkline-chart.js"></script>
    <script src="../js/easy-pie-chart.js"></script>
    <script src="../js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../js/xcharts.min.js"></script>
    <script src="../js/jquery.autosize.min.js"></script>
    <script src="../js/jquery.placeholder.min.js"></script>
    <script src="../js/gdp-data.js"></script>
    <script src="../js/morris.min.js"></script>
    <script src="../js/sparklines.js"></script>
    <script src="../js/charts.js"></script>
    <script src="../js/jquery.slimscroll.min.js"></script>
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
