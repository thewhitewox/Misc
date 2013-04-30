<?php
set_time_limit(0);
set_time_limit(0);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|  Mass Gamertag Checker by Furry~  |\n";
echo "| Usage: php gamertag.php InsertWordListHere  |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $trim = urlencode($file);
    $gt = explode("%0D%0A", $trim);
    $avail = array();
    foreach($gt as $gamertag){
  $url = 'http://www.xboxleaders.com/api/profile/'.urlencode($gamertag).'.xml';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_TIMEOUT, 8);
  $result = curl_exec($ch);
  if(strpos($result, 'Invalid gamertag') === false){
    echo "Gamertag ".$gamertag." is taken!\n";
  } else {
    echo "Gamertag ".$gamertag." is available!\n";
    $avail[] .= $gamertag;
  }
    }
    foreach($avail as $ava){
    $file = 'Available.txt';
    $handle = fopen($file, 'a');
    fwrite($handle, $ava."\n");
    }
}
?>