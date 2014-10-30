<?php 
	$id_mod=5;
	include("../inc/cek_akses.php");
	
	echo'
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
		<li class="judul">Pegawai</li>
		<ul class="sidebar-nav">
			<li><a href="?mod='.$_GET['mod'].'&h=tambah">Tambah Pegawai <img src="../img/tambah_orang.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=data">Data Pegawai<img src="../img/daftar.png"></a></li>
			<li class="judul">Peralatan</li>
			<li><a href="?mod='.$_GET['mod'].'&h=kartu">Kartu Pegawai <img src="../img/print.png"></a></li>
         </ul>';
		require ("pengguna.php");
		echo'
		</div>
	</div>';
?>
