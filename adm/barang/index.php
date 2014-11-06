<?php
include ("submenu.php");
include ("class.php");

$mod = $_GET['h'];	
	switch($mod){
		
		case "aksi" :
		$view = "aksi.php";
		break;
		case "data":
		$view = "barang_data.php";
		break;			
		case "tambah":
		$view = "barang_tambah.php";
		break;	
		case "sunting":
		$view = "barang_sunting.php";
		break;	
		
		case "kategori":
		$view = "kategori.php";
		break;			
		case "kategori_tambah":
		$view = "kategori_tambah.php";
		break;	
		case "kategori_sunting":
		$view = "kategori_sunting.php";
		break;		
		case "kualitas_tambah":
		$view = "kualitas_tambah.php";
		break;	
		case "kualitas_sunting":
		$view = "kualitas_sunting.php";
		break;
		case "satuan_tambah":
		$view = "satuan_tambah.php";
		break;	
		case "satuan_sunting":
		$view = "satuan_sunting.php";
		break;
		case "kendaraan_tambah":
		$view = "kendaraan_tambah.php";
		break;	
		case "kendaraan_sunting":
		$view = "kendaraan_sunting.php";
		break;
		
		case "rak":
		$view = "rak.php";
		break;	
		case "rak_tambah":
		$view = "rak_tambah.php";
		break;
		case "rak_sunting":
		$view = "rak_sunting.php";
		break;
		
		case "penyalur":
		$view = "penyalur.php";
		break;	
		case "penyalur_tambah":
		$view = "penyalur_tambah.php";
		break;
		case "penyalur_sunting":
		$view = "penyalur_sunting.php";
		break;
		
		case "stok_kurang":
		$view = "stok_kurang.php";
		break;
		case "pembelian":
		$view = "pembelian2.php";
		break;
		case "pembelian_data":
		$view = "pembelian_data.php";
		break;
		case "penerimaan_pembelian":
		$view = "pembelian_penerimaan.php";
		break;

		case "pencetakan_label":
		$view = "pencetakan_label.php";
		break;
		case "pencetakan_data":
		$view = "pencetakan_data.php";
		break;

	}
if(empty($_GET['h'])){
	header("location:?mod=".$_GET['mod']."&h=data");
}
else{
	include $view;
	include ("custom.js");
}
?>
