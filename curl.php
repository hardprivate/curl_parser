<?php
$ch = curl_init();

// установка URL и других необходимых параметров
curl_setopt($ch, CURLOPT_URL, "http://www.kinonews.ru/". $_GET["st"]);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
//curl_setopt($ch, CURLOPT_PROXY, "192.168.100.3:3128");
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.1) Gecko/2008070208'); 

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// загрузка страницы и выдача её браузеру
$data = curl_exec($ch);

$data = preg_replace("!<noindex>(.*?)</noindex>!si","",$data);
$data = str_replace(" src='/" , " src='http://www.kinonews.ru/", $data);
$data = str_replace(' src="/' , ' src="http://www.kinonews.ru/', $data);
$data = str_replace("<a href='/" , "<a href='/?st=", $data);
$data = str_replace('<a href="/' , '<a href="/?st=', $data);
$data = str_replace("image=/" , "image=http://www.kinonews.ru/", $data);
$data = str_replace("<a href='http://www.kinonews.ru/", "<a href='http://". $_SERVER["SERVER_NAME"] ."/?st=" , $data);
echo str_replace('<a href="http://www.kinonews.ru/', '<a href="http://'. $_SERVER["SERVER_NAME"] .'/?st=' , $data);

// завершение сеанса и освобождение ресурсов
curl_close($ch);
?>