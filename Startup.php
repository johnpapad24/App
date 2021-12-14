<html lang="en">
<head>
  <!-- Use correct character set. -->
  <meta charset="utf-8">
  <!-- Tell IE to use the latest, best version. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Make the application on mobile take up the full browser screen and disable user scaling. -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
  <title>Hello World!</title>
  <link href="popupwindow.css" rel="stylesheet">
  <link href="bootstrap.min.css" rel="stylesheet">
	<script src="jquery-3.6.0.min.js"></script>
  <script src="bootstrap.min.js"></script>
	<script src="popupwindow.js"></script>
  <script src="functions.js"></script>
</head>
<body>
  <div id="logwindow" style="display:none;" >
    <div style="width:100%; height:100%;">
    <div style="display: block; margin:auto; height: 100%; width:100%;"><textarea id="logtextarea" style="height: 100%; width:100%; resize:none; min-height:150px; min-width:350px;" readonly></textarea>
    <button style="left: 50%; position: relative; -ms-transform: translate(-50%); transform: translate(-50%);">OK</button>
  </div>
</div>
</div>
  <div style="text-align:center; display: block; vertical-align:middle; margin-left: auto;
    margin-right: auto; position: relative;">
      <img style="" src="Resources/splash.jpeg">
  </div>


  <div class="progress" style="display:block; margin:auto; text-align:center; position: relative; max-width:500px; margin-top:10px;">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">0%</div>
  </div>

  <div style="text-align:center; display: block; margin-top:10px">
    <span id="processtext">Initializing...</span>
  </div>

<?php
require 'Functions.php';
require 'Credentials.php';
ini_set('display_errors', 1);

$totalsteps=6;
$check=true;
$percent=0;
$step=0;

//initialization

$check=logcreator($logfile);
if($check==false){
  startupprocesserror("Error! Log file creation failed.");
  die();
}
checkandlogonstartup($logfile,"Starting initialization...","");
$step=$step+1;


//checking internet connection
statupprogressupdater("Checking internet connection...", round(($step*(100/$totalsteps)),$precision=0,PHP_ROUND_HALF_EVEN));
$check=checknetconn();
if($check==false){
  checkandlogonstartup($logfile,"Checking internet connection...","FAILED");
  startupprocesserror("Error! Cannot connect to the internet.");
  die();
}
checkandlogonstartup($logfile,"Checking internet connection...","OK");
$step=$step+1;

//checking tle file
statupprogressupdater("Checking TLE File...", round(($step*(100/$totalsteps)),$precision=0,PHP_ROUND_HALF_EVEN));
if(!file_get_contents($tlefile)) {
  checkandlogonstartup($logfile,"Checking TLE file...","FAILED");
  startupprocesserror("Error! TLE file not found.");
  die();
}
checkandlogonstartup($logfile,"Checking TLE file...","OK");
$step=$step+1;

//connecting to db
statupprogressupdater("Connecting to database...", round(($step*(100/$totalsteps)),$precision=0,PHP_ROUND_HALF_EVEN));
$conn=connectdb($servername, $username, $password);
if($conn==null){
  checkandlogonstartup($logfile,"Connecting to database...","FAILED");
  startupprocesserror("Error! Cannot connect to database.");
  die();
}
checkandlogonstartup($logfile,"Connecting to database...","OK");
$step=$step+1;

//update db
statupprogressupdater("Updating database...", round(($step*(100/$totalsteps)),$precision=0,PHP_ROUND_HALF_EVEN));

$num=updatedb($conn,$tlefile);

if($num==1 || $num==2 || $num==3){
  checkandlogonstartup($logfile,"Updating database...","FAILED");
  startupprocesserror("Error! Cannot update database.");
  die();
}
checkandlogonstartup($logfile,"Updating database...","OK");
$step=$step+1;

//check and create settings file
statupprogressupdater("Checking/creating settings file...", round(($step*(100/$totalsteps)),$precision=0,PHP_ROUND_HALF_EVEN));
checkandcreatesettingsfile($settingsfile);
$step=$step+1;
//startup

statupprogressupdater("Starting up...", round(($step*(100/$totalsteps)),$precision=0,PHP_ROUND_HALF_EVEN));
checkandlogonstartup($logfile,"Started Cessium environment Load...","");



?>


  </body>
</html>
