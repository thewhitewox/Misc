<?php
set_time_limit(0);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|        Mass Youtube Checker by Furry~        |\n";
echo "|  Usage: php youtube.php InsertWordListHere   |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $trim = trim($file);
    $yt = explode("\r\n", $trim);
    $avail = array();
    foreach($yt as $you){
        $you = trim($you);
        $url = 'http://www.youtube.com/'.$you;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        $result = curl_exec($ch);
        if(strpos($result, '404 Not Found') === false){
            echo "Youtube ".$url." is taken!\n";
        } else {
            echo "Youtube ".$url." is available!\n";
            $fh = fopen('available.txt', 'a') or die("can't open file");
            fwrite($fh, "\n".$url);
        }
    }
}
?>