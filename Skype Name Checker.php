<?php
set_time_limit(0);
error_reporting(E_ALL);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|          Mass Skype Checker by Furry~       |\n";
echo "|   Usage: php skype.php InsertWordListHere   |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $trim = trim($file);
    $sk = explode("\r\n", $trim);
    $browser = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36';
    foreach($sk as $sky){
        $url = 'https://login.skype.com/json/validator?new_username='.$sky;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, '$browser');
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $json = json_decode($result, true);
        if($json['status'] == 200){
            echo "Skype ".$sky." is available!\n";
            $fh = fopen('available.txt', 'a') or die("can't open file");
            fwrite($fh, $sky."\n");
        } else {
            echo "Skype ".$sky." is taken!\n";
        }
    }
}
?>