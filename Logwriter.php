<?php
require 'Functions.php';
require 'Credentials.php';

$message=$_POST['message'];
$status=$_POST['status'];
checkandlogonapp($logfile, $message, $status);


?>
