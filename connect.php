<?php
	header('Content-Type: text/html; charset=utf-8');
	$sqlhost = "localhost";
	$sqluser = "root";
	$sqlpassword = "alpalp123";
	$database = "katalog";
	$sqlconn = mysqli_connect($sqlhost,$sqluser,$sqlpassword,$database);

	if (!$sqlconn) {
    echo "HATA: SQL sunucusuna bağlanılamıyor." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
	}
	mysqli_set_charset($sqlconn,"utf8mb4");

?>