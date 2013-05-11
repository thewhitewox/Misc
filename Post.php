<?php
$url = 'http://www.eyeem.com/ajax/validate';
$browser = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36';
$fields   = array(
    'type' => 'nickname',
    'value' => 'Furry'
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 8);
curl_setopt($ch, CURLOPT_USERAGENT, '$browser)');
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
$result = curl_exec($ch);
var_dump(json_decode($result, true));

?>