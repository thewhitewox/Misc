<?php
set_time_limit(0);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|        Mass Tumblr Checker by Furry~        |\n";
echo "|  Usage: php tumblr.php InsertWordListHere   |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $trim = trim($file);
    $tr = explode("\r\n", $trim);
    $avail = array();
    foreach($tr as $tumblr){
        $tumblr = trim($tumblr);
        $url = $tumblr.'.tumblr.com';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        $result = curl_exec($ch);
        if(strpos($result, 'We couldn\'t find the page you were looking for.') === false){
            echo "Tumblr ".$url." is taken!\n";
        } else {
            echo "Tumblr ".$url." is available!\n";
            $fh = fopen('available.txt', 'a') or die("can't open file");
            fwrite($fh, "\n".$url);
        }
    }
}
?>