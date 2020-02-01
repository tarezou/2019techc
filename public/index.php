<?php

$fp = fopen('count.text', 'r+');
$count = (int)fgets($fp);
fclose($fp);

if (isset($_COOKIE['count'])){
	$youcount = $_COOKIE['count'];
}else{
	$count++;

	$youcount = $count;
	setcookie('count', $count);

	$fp = fopen('count.text', 'w');
	fwrite($fp, $count);

	fclose($fp);
}

echo '現在の訪問者数'.$count.'人'."<br>";
echo 'あなたは'.$youcount.'人目の訪問者です';

