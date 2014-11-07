<?php
include ("submenu.php");
include ("class.php");
$mod = $_GET['h'];	
	switch($mod){
		
		case "aksi" :
		$view = "aksi.php";
		break;
		case "mulai" :
		$view = "mulai.php";
		break;
		case "wo":
		$view = "data_wo.php";
		break;	
		case "transaksi" :
		$view = "transaksi.php";
		break;	
		case "penjualan" :
		$view = "penjualan.php";
		break;	
		case "sejarah_tr":
		$view = "sejarah_tr.php";
		break;			
		case "sejarah_pl":
		$view = "sejarah_pl.php";
		break;	
		case "hapus":
		$view = "hapus.php";
		break;			
		case "hapus2":
		$view = "hapus2.php";
		break; 		
		case "kategori":
		$view = "kategori.php";
		break;			
		case "kategori_sunting":
		$view = "kategori_sunting.php";
		break;			
		case "kategori_tambah":
		$view = "kategori_tambah.php";
		break;	
	}
if(empty($_GET['h'])){
	header("location:?mod=".$_GET['mod']."&h=wo");
}
else{
	include $view;
	include ("custom.js");
}
?>
