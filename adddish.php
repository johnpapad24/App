<?php
require 'Credentials.php';
$name=$_POST["Name"];
$tle1=$_POST["TLE1"];
$tle2=$_POST["TLE2"];
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  echo '</html>';
}
$existsq= mysqli_query($conn, 'SELECT count(*) as exist from Satellite where Name='."\"".$name."\"".';');
$res=$existsq->fetch_assoc();
if($res["exist"]<1){
  $insertq= $conn->query('insert into Satellite (Name, Tleline1, Tleline2, BeamCSV) Values ('."\"".$name."\", \"".$tle1."\", \"".$tle2."\", ".'"/CSVs/'.$name.'.csv");');
}
else{
  $updatq=$conn->query('UPDATE Satellite SET Tleline1='.'"'.$tle1.'"'.', Tleline2='.'"'.$tle2.'"'. ' Where Name='.'"'.$name.'";');
}
$dirname="CSVs/".filename_satinizer($name);
$cfile=$dirname."/beams.csv";
if(!is_dir($dirname)){
  mkdir($dirname);
  $csvfile=fopen($cfile, 'w') or die("Unable to create file!");
  fwrite($csvfile, "Beams/TargetedSpotbeam.beam");
  fclose($csvfile);

}
else if(!is_file($cfile)){
      $csvfile=fopen($cfile, 'w') or die("Unable to create file!");
  fwrite($csvfile, "Beams/TargetedSpotbeam.beam");
  fclose($csvfile);
}

}
fclose($file);
}
function filename_satinizer($filename){
$filename = str_replace(array_merge(
        array_map('chr', range(0, 31)),
        array('<', '>', ':', '"', '/', '\\', '|', '?', '*')
    ), '', $filename);
    // maximise filename length to 255 bytes http://serverfault.com/a/9548/44086
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $filename= mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');
    return $filename;
}

?>
