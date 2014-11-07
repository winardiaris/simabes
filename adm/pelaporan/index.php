<?php
include ("class.php");
include ("submenu.php");
$h = $_GET['h'];
switch($h){
	
		case "st_barang":
		$view = "statistik_barang.php";
		break;
		case "st_pelanggan":
		$view = "statistik_pelanggan.php";
		break;
		case "pelayanan":
		$view = "pelayanan.php";
		break;
		case "penjualan":
		$view = "penjualan.php";
		break;
		case "keuangan":
		$view = "keuangan.php";
		break;
		case "keuangan_tambah":
		$view = "keuangan_tambah.php";
		break;
		case "lain":
		$view = "lain.php";
		break;
	
}
if(empty($_GET['h'])){
	header("location:?mod=pelaporan&h=st_barang");
}
else{
		include $view;
}
?>
