<?php
require 'Functions.php';
require 'Credentials.php';

$conn=connectdb($servername, $username, $password);
$html=getsatnames_new($conn);
mysqli_close($conn);
return $html;
?>
