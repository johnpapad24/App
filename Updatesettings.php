<?php
require 'Functions.php';

$setting=$POST['setting'];
$value=$POST['value'];
$message1="Error! Cannot update settings file."
$message2="Settings file updated."
$test=settingsfileupdater($settingsfile,$setting,$value);
if($test==false){
  loggger($logfile,$message1,"ERROR");
  requesterror($message);
}
else {
  loggger($logfile,$message2,"OK");
}

?>
