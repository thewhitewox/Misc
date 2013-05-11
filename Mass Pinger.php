<?php
function pingAddress($ip) {
    $pingresult = exec("ping -n 1 -w 1 $ip", $outcome, $status);
    if (0 == $status) {
        $status = "alive";
        $fh = fopen('alive.txt', 'a') or die("can't open file");
        fwrite($fh, "\n".$ip);
    } else {
        $status = "dead";
    }
    echo "The IP address, $ip, is ".$status."\n";
}

if(isset($argv[1])){
    $ips = explode("\n", trim(file_get_contents($argv[1])));
    foreach($ips as $ip){
        $up = pingAddress($ip);
        if ($up){
            echo $ip;
        }
    }
} else {
    echo 'Please put the input file';
}
?>