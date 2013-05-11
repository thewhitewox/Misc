<?php
if(isset($argv[1])){
    $url = 'http://www.eyeem.com/auth/signUp';
    $browser = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1468.0 Safari/537.36';
    $file = file_get_contents($argv[1]);
    $trim = trim($file);
    $em = explode("\n", $trim);
    foreach($em as $eye){
        $pass = 'Play'.rand(5000,50000);
        $email = $eye.rand(0,500).'@yopmail.fr';
        $fields   = array(
            'referrer' => 'http%253A%252F%252Fwww.eyeem.com%252Fsignup',
            'name' => 'FurryHF',
            'nickname' => $eye,
            'email' => $email,
            'password' => $pass,
            'submit' => ''
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_USERAGENT, '$browser)');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        echo $eye." is done.\n";
        $fh = fopen('EyeEm.txt', 'a') or die("can't open file");
        fwrite($fh, $email.':'.$pass."\n");
    }
}
?>