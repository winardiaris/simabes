<?php 
	$id_mod=4;
	include("../inc/cek_akses.php");
	echo'
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
		<li class="judul">Barang</li>
		<ul class="sidebar-nav">
			<li><a href="?mod='.$_GET['mod'].'&h=tambah" title="Tambah">Tambah Barang <img src="../img/tambah.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=data">Data Barang <img src="../img/daftar.png"></a></li>
		<li class="judul">Kategori</li>
			<li><a href="?mod='.$_GET['mod'].'&h=kategori">Kategori Barang<img src="../img/daftar.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=rak">Rak Penyimpanan <img src="../img/daftar.png"></a></li>
		<li class="judul">Penyalur</li>
			<li><a href="?mod='.$_GET['mod'].'&h=penyalur">Data penyalur <img src="../img/orang.png"></a></li>
		<li class="judul">Pemesanan</li>
			<li><a href="?mod='.$_GET['mod'].'&h=stok_kurang">Data Stok kurang <img src="../img/daftar.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=pembelian_data">Data Pemesanan <img src="../img/daftar.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=penerimaan_pembelian">Penerimaan Pemesanan <img src="../img/bawah.png"></a></li>
		<li class="judul">Peralatan</li>
			<li><a href="?mod='.$_GET['mod'].'&h=pencetakan_label">Pencetakan Label <img src="../img/print.png"></a></li>
			<!-- <li><a href="?mod='.$_GET['mod'].'&h=pencetakan_data_barang">Pencetakan Data Barang <img src="../img/print.png"></a></li> -->
        </ul>';
		require ("pengguna.php");
		echo'
        </div>
	</div>';
?>
