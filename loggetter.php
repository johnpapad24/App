<?php
require 'Credentials.php';

$log=fopen($logfile,'r');
echo (fread($log,filesize("$logfile")));
fclose($log);
?>
