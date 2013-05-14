<?php
set_time_limit(0);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|          Mass Twitter Checker by Furry~      |\n";
echo "|   Usage: php twitter.php InsertWordListHere  |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $trim = trim($file);
    $tw = explode("\r\n", $trim);
    $browser = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36';
    foreach($tw as $twi){
        $url = 'https://twitter.com/users/username_available?username='.$twi;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, '$browser');
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $json = json_decode($result, true);
        if($json['valid'] == 1){
            echo "Twitter ".$twi." is available!\n";
            $fh = fopen('available.txt', 'a') or die("can't open file");
            fwrite($fh, $twi."\n");
        } else {
            echo "Twitter ".$twi." is taken!\n";
        }
    }
}
?>