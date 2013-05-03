<?php
set_time_limit(0);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|         Webdav IP Checker by Furry~         |\n";
echo "|          Usage: php webdav.php IPs          |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $trim = trim($file);
    $tr = explode("\n", $trim);
    foreach($tr as $data){
        $ch = curl_init($data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        $response = curl_exec($ch);
        if(strpos($response, "WebDAV testpage") == false){
            echo $data." Isnt a webdav\n";
        } else {
            $fh = fopen('webdavs.txt', 'a') or die("can't open file");
            fwrite($fh, "\n".$data);
        }
    }
}
?>