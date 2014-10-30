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
		$view = "pelaporan/statistik_barang.php";
		break;
		case "pelaporan_st_barang":
		$view = "pelaporan/statistik_barang.php";
		break;
		case "pelaporan_st_pelanggan":
		$view = "pelaporan/statistik_pelanggan.php";
		break;
		case "pelaporan_pelayanan":
		$view = "pelaporan/pelayanan.php";
		break;
		case "pelaporan_penjualan":
		$view = "pelaporan/penjualan.php";
		break;
		case "pelaporan_keuangan":
		$view = "pelaporan/keuangan.php";
		break;
		case "pelaporan_keuangan_tambah":
		$view = "pelaporan/keuangan_tambah.php";
		break;
		case "pelaporan_lain":
		$view = "pelaporan/pelaporan.php";
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
