<?php
ini_set('display_errors', 1);
//phpinfo();
$h=fopen("testog.log","w");
if(!$h){ echo 'fopen failed. reason: '; print_r(error_get_last()); echo get_current_user();  //Acer
echo exec('whoami');   //admin
die();}

fclose($h);


$sock = @fsockopen('192.168.1.1', 80);
stream_get_contents($sock);
?>
