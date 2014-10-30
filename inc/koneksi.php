<?php
	ob_start();
  
	// koneksi ke database
	// user yang dicantumkan di sini harus memiliki hak membuat database
	$dbserver="localhost";
	$dbusername="simabes";
	$dbpassword="simabes";
	$dbname="simabes";
	
	//koneksi
	mysql_connect($dbserver,$dbusername,$dbpassword)  or die(mysql_error());
	mysql_select_db($dbname) or die  (mysql_error());
	
?>
