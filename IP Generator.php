<?php
if(isset($argv[1])){
    if(isset($argv[2])){
        $ips = $argv[1];
        for ($i = 0; $i < $ips; $i++){
            $ip = rand(0,225).'.'.rand(0,225).'.'.rand(0,225).'.'.rand(1,254);
            $fh = fopen($argv[2], 'a') or die("can't open file");
            fwrite($fh, "\n".$ip);
        }
    } else {
        echo 'Please put the out file';
    }
} else {
    echo 'Please put how many IPs you want generated';
}
?>