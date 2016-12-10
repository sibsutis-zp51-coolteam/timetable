<?php
$ch = curl_init("http://ngs.ru");

curl_setopt($ch, CURLOPT_URL, "http://ngs.ru");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);

curl_close($ch);

$fp = fopen ("result.txt", "w");

fwrite($fp, $result);

fclose($fp);

