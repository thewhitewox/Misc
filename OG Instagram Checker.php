<?php
set_time_limit(0);
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|       Mass Instagram Checker by Furry~      |\n";
echo "|   Usage: php insta.php InsertWordListHere   |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $browser = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36';
    $trim = trim($file);
    $ig = explode("\r\n", $trim);
    foreach($ig as $insta){
            $url = 'http://instagram.com/'.$insta;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, '$browser');
            curl_setopt($ch, CURLOPT_TIMEOUT, 8);
            $result = curl_exec($ch);
            $pos = strpos($result, "<h2>Page Not Found</h2>");
            if($pos === false){
                echo "Instagram, ".$insta.", is taken!\n";
           } else {
                echo "Instagram, ".$insta.", is available!\n";
                $fh = fopen('available.txt', 'a') or die("can't open file");
                fwrite($fh, "\n".$insta);
        }
    }
}
?>