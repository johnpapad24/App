<?php
require 'Functions.php';
require 'Credentials.php';

$satellite=$_POST['satellite'];

$conn=connectdb($servername, $username, $password);
$tle=gettle($conn,$satellite);
mysqli_close($conn);
echo $tle;
?>
