<?php
include "inc/koneksi.php";
include "inc/konf.php";
include ("katalog/header.php");

$mod = $_GET['mod'];	
	switch($mod){
		case "catalog" :
		$view = "katalog/katalog.php";
		break;
		case "info" :
		$view = "katalog/info.php";
		break;
		case "help" :
		$view = "katalog/bantuan.php";
		break;
		case "user" :
		$view = "katalog/pengguna.php";
		break;
		case "about" :
		$view = "katalog/tentang.php";
		break;
}
		include $view;
if(empty($mod)){
	include ("katalog/katalog.php");
}
include ("katalog/footer.php");
?>
