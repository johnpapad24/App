<?php
require 'Functions.php';
require 'Credentials.php';
$windowname=$_POST["windowname"];
$conn=connectdb($servername, $username, $password);
$html=getsatnames_new($conn,$windowname);
mysqli_close($conn);
return $html;
?>
