<?php
	header('Content-Type: application/json; charset=utf8');

	$url = $_GET['url'];

	$filename = hash('ripemd160', $url);

	$path = getcwd();
	$file = "$path/api/$filename.json";

	if (file_exists($file)) {
		echo file_get_contents($file);
		return;
	}

	$data = file_get_contents($url);

	file_put_contents($file, $data);

	echo $data;
?>
