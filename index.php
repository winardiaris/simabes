<?php
include "inc/koneksi.php";
include "inc/konf.php";
include ("utama/header.php");

$mod = $_GET['mod'];	
	switch($mod){
		case "katalog" :
		$view = "utama/katalog.php";
		break;
		case "info" :
		$view = "utama/info.php";
		break;
		case "bantuan" :
		$view = "utama/bantuan.php";
		break;
		case "pengguna" :
		$view = "utama/pengguna.php";
		break;
		case "tentang" :
		$view = "utama/tentang.php";
		break;
}
		include $view;

if(empty($_GET['mod'])){
	header("location:?mod=katalog");
}
include ("utama/footer.php");
?>
