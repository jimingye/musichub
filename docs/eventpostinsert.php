<?php 
include "dbconnect.php";
session_start();
$username1 = $_SESSION['username1'];
 $eventname = $_POST["eventname"];
 $eventpostbody = $_POST["eventpostbody"]; 
 $location = $_POST["location"];
//echo "yes,we have  $location";
 $stime = $_POST["stime"];
 $etime = $_POST["etime"];
$sql = "INSERT INTO `maps` (`mlocid`, `mloc_name`, `address`) VALUES (NULL, NULL, '$location');";
mysqli_query($mysqli, $sql);
$sqlLocation = "SELECT `mlocid` FROM `maps` where address = '$location';";
  $resultSqlLocation = $mysqli->query($sqlLocation);
$mid ="";
while($row = $resultSqlLocation->fetch_array()){
    $mid = $row[0];
    }

$sql1 = "INSERT INTO `events` (`eventid`, `event_name`, `estart_time`, `eend_time`, `edescription`, `mlocid`) VALUES (NULL,'$eventname', '$stime', '$etime', '$eventpostbody','$mid');";
$message = "";
$error = "";
$result1 = $mysqli->query($sql1);
  if (!$result1) {
    $error .= "No more activity so far";
    die("Error running $sql1: " . mysql_error());
  } 
  $message .= "Success";
$mysqli->close();


?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>
      
        Login &middot; 
      
    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="./assets/css/toolkit.css" rel="stylesheet">
    
    <link href="./assets/css/application.css" rel="stylesheet">

    <style>
      /* note: this is a hack for ios iframe for bootstrap themes shopify page */
      /* this chunk of css is not part of the toolkit :) */
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;
        background-image: url("./assets/login_background.jpg");
        background-size: cover;
      }
         #more{
            height:50px;
        }
        #errorlink{
            color: azure;
        }
        #messagelink{
            color:azure;
        }
    </style>

  </head>


<body>
  
<?php include "titles.php"; ?>


<div class="container-fluid container-fill-height">
  <div class="container-content-middle">
    <form role="form" class="m-x-auto text-center app-login-form">
      <div id="error"><?php if($error){
    echo '<div class="alert alert-danger" role="alert">
  '.$error.'</div>';
    echo '<a id="errorlink" href="eventpost.php">Back</a>';} ?>
    </div>
      <div id="message"><?php if($message){
    echo '<div class="alert alert-success" role="alert">
  '.$message.'</div>';
    echo '<a id="messagelink" href="allevents.php?uid='.$username1.'">Take a look</a>';} ?>
    </div>
    </form>
  </div>
</div>


    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/chart.js"></script>
    <script src="./assets/js/toolkit.js"></script>
    <script src="./assets/js/application.js"></script>
    <script type="text/javascript">
        
    </script>
  </body>
</html>