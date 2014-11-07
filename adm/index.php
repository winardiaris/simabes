<?php
include "../inc/koneksi.php";
include "../inc/konf.php";
include "../inc/cek_login.php";
include "header.php";
$mod = $_GET['mod'];	
	switch($mod){
		
		case "utama" :
		$view = "utama.php";
		break;
	
		//pelanggan
		case "pelanggan" :
		$view = "pelanggan/index.php";
		break;

		//cetak kartu
		case "cetak_kartu" :
		$view = "kartu.php";
		break;
		
		//pelayanan
		case "pelayanan":
		$view = "pelayanan/index.php";
		break;
		
		
		//barang
		case "barang":
		$view = "barang/index.php";
		break;
		
		
		//pegawai		
		case "pegawai":
		$view = "pegawai/index.php";
		break;	
		
		//pelaporan
		case "pelaporan":
		$view = "pelaporan/index.php";
		break;
		

		//sistem
		case "sistem":
		$view = "sistem/index.php";
		break;

}
if(empty($_GET['mod'])){
	header("location:?mod=utama");
}
else{
		include $view;
}
include "footer.php";
?>
