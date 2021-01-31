<?php
require('connection.php');

$key = 'hai,namasayaiqbal,umur23tahunlahir31011997.andthisismyfypprojecton2020.thankyou.';

function encryptthis($data,$key){
    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($data, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    $cdata = base64_encode( $iv.$hmac.$ciphertext_raw );
    return $cdata;}

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


session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['member_id'])){
 header("location:login-student.php");
}
?>
<?php
// retrieving positions sql query
$positions=mysqli_query($con, "SELECT * FROM tbPositions");
?>
<?php
    // retrieval sql query
// check if Submit is set in POST
 if (isset($_POST['Submit']))
 {
 // get position value
 $position = addslashes( $_POST['position'] ); //prevents types of SQL injection

 // retrieve based on position
 $result = mysqli_query($con,"SELECT * FROM tbCandidates WHERE candidate_position='$position'");
 // redirect back to vote
 //header("Location: vote.php");
 }
 else
 // do something

?>

<!--<?php
/*include('connection.php');
$hah = $_SESSION['member_id'];
$vote=mysqli_query($con, "SELECT * FROM tblvotes WHERE voter_id='$hah' AND position='$position'");
$aa = mysqli_query($con,$vote) or die('SQL error voter ');
$row = mysqli_fetch_array($aa, MYSQLI_ASSOC);
if($aa){}
$dah = $row[''];*/
?>-->
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

<script type="text/javascript">
function getVote(int)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  if(confirm("Are you sure? "))
  {
  var pos=document.getElementById("str").value;
  var id=document.getElementById("hidden").value;
  //var candi=document.getElementById("candi").value;
  xmlhttp.open("GET","save1.php?vote="+int+"&user_id="+id+"&position="+pos,true);
  xmlhttp.send();

  xmlhttp.onreadystatechange =function()
{
  if(xmlhttp.readyState ==4 && xmlhttp.status==200)
  {
  //  alert("dfdfd");
  document.getElementById("error").innerHTML=xmlhttp.responseText;
  }
}

  }
  else
  {
  alert("Choose another candidate ");
  }

}

function getPosition(String)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","vote.php?position="+String,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
$(document).ready(function(){
   var j = jQuery.noConflict();
    j(document).ready(function()
    {
        j(".refresh").everyTime(1000,function(i){
            j.ajax({
              url: "admin/refresh.php",
              cache: false,
              success: function(html){
                j(".refresh").html(html);
              }
            })
        })

    });
   j('.refresh').css({color:"green"});
});
</script>

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
          <li class="active">
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
          <li>
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
            <h3 class="page-header"><i class="icon_piechart"></i> Current Polls</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="student.php">Home</a></li>
              <li><i class="icon_piechart"></i>Current Polls</li>
            </ol>
          </div>
        </div>
      </section>

      <section>
        <div class="row text-center">
          <div class="col-lg-12">
            <section class="panel text-center">
              <header class="panel-heading h4">
                Choose Position
              </header>
              <div class="panel-body">
                <form name="fmNames" id="fmNames" method="post" action="vote.php" onSubmit="return positionValidate(this)">
                  <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">Candidate Position</label>
                    <select class="form-control" name="position" id="position" onclick="getPosition(this.value)">
                    <option VALUE="select">select
                    <?php
                    //loop through all table rows
                    while ($row=mysqli_fetch_array($positions)){
                    echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
                    //mysql_free_result($positions_retrieved);
                    //mysql_close($link);
                    }
                    ?>
                    </select>
                  </div>
                  <input type="hidden" id="hidden" value="<?php echo $_SESSION['member_id']; ?>" />
                  <!--<input type="hidden" id="candi" value="<?php //echo $_REQUEST['candidate_name']; ?>" />-->
                  <input type="hidden" id="str" value="<?php echo $_REQUEST['position'];?>" />
                  <button type="submit" name="Submit" class="btn btn-primary">See Candidates</button>
                </form>
                <br>
                <p class="text-info">Reminder!: Click a circle beside a respective candidate to cast your vote. You can't vote more than once in a respective position. This process can not be undone so think wisely before casting your vote.</p>
                <header class="panel-heading h4">
                Available Candidates
              </header>
              <section class="panel">
                <table class="table table-striped table-advance table-hover">
                  <tbody>
                    <tr class="h4">
                      <td><i class="icon_profile"></i> Candidate Name</td>
                      <td><i class="icon_cogs"></i> Vote</td>
                    </tr>
                <?php
                //loop through all table rows
                //if (mysql_num_rows($result)>0){
                  if (isset($_POST['Submit']))
                  {
                    $sql=mysqli_query($con, "SELECT position,voter_id FROM tblvotes where position='$_REQUEST[position]' and voter_id='$_SESSION[member_id]'");
                    if (mysqli_num_rows($sql) != 0){
                      echo '<script language="javascript">';
                      echo 'alert("You already done your part!")';
                      echo '</script>';
                      while ($row=mysqli_fetch_array($result)){
                      $y=$row['candidate_id'];
                      $x=$row['candidate_name'];
                      echo "<tr>";
                      $dcandidatename = decryptthis($x, $key);
                      echo "<td>" . $dcandidatename."</td>";
                      echo "<td><input type='radio' name='vote' disabled /></td>";
                      echo "</tr>";
                      }
}
                      else{
                while ($row=mysqli_fetch_array($result)){
                $y=$row['candidate_id'];
                $x=$row['candidate_name'];
                echo "<tr>";
                $dcandidatename = decryptthis($x, $key);
                echo "<td>" . $dcandidatename."</td>";
                echo "<td><input type='radio' name='vote' value=$y onclick='getVote(this.value)'/></td>";
                echo "</tr>";
                }
              }

                mysqli_free_result($result);
                mysqli_close($con);
                //}
                  }
                  else
                // do nothing
                ?>
              </tbody>
                </table>
              </section>

              </div>

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
