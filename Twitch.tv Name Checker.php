<?php
set_time_limit(0);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|        Mass Twich.tv Checker by Furry~      |\n";
echo "|   Usage: php Twich.php InsertWordListHere   |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $trim = trim($file);
    $tv = explode("\r\n", $trim);
    $browser = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36';
    foreach($tv as $twitch){
            $url = 'https://api.twitch.tv/kraken/users/'.$twitch;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, '$browser');
            curl_setopt($ch, CURLOPT_TIMEOUT, 8);
            $result = curl_exec($ch);
            if(strpos($result, '"status":404')){
                echo "Twitch ".$twitch." is available!\n";
                $fh = fopen('available.txt', 'a') or die("can't open file");
                fwrite($fh, $twitch."\n");
           } else {
                echo "Twitch ".$twitch." is taken!\n";
        }
    }
}
?>