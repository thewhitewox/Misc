<?php
set_time_limit(0);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|  Mass Gamertag Checker by Furry~  |\n";
echo "| Usage: php gamertag.php InsertWordListHere  |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $trim = trim($file);
    $gt = explode("\r\n", $trim);
    foreach($gt as $gamertag){
        $url = 'http://www.xboxleaders.com/api/1.0/profile.json?gamertag='.$gamertag;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        $result = curl_exec($ch);
        $json = json_decode($result, true);
        print_r($json);
        if($json['Stat'] === 'fail'){
            echo "Gamertag ".$gamertag." is taken!\n";
            $fh = fopen('available.txt', 'a') or die("can't open file");
            fwrite($fh, $pheed."\n");
        } else {
            echo "Gamertag ".$gamertag." is available!\n";
        }
    }
}
?>