<?php 
	$id_mod=2;
	include("../inc/cek_akses.php");
	
	echo'
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
		<li class="judul">Pelanggan</li>
		<ul class="sidebar-nav">
			<li><a href="?mod='.$_GET['mod'].'&h=tambah">Tambah Pelanggan <img src="../img/tambah_orang.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=data">Data Pelanggan<img src="../img/daftar.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=kadaluarsa">Pelanggan Kadaluarsa<img src="../img/daftar.png"></a></li>
			<li class="judul">Peralatan</li>
			<li><a href="?mod='.$_GET['mod'].'&h=kartu">Kartu Pelanggan <img src="../img/print.png"></a></li>
		</ul>';
		require ("pengguna.php");
		echo'
		</div>
	</div>';
?>
