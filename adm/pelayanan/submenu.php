<?php 
	$id_mod=3;
	include("../inc/cek_akses.php");
	
	if($_SESSION['kel_id'] == 5){
	echo'
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
		<li class="judul">Pelayanan</li>
		<ul class="sidebar-nav">
			<li><a href="?mod='.$_GET['mod'].'&h=wo" title="Work Order">Data Work Order <img src="../img/daftar.png"></a></li>
        </ul>';
		require ("pengguna.php");
	echo'
		</div>
	</div>';
	}
	else{
	echo'
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
		<li class="judul">Pelayanan</li>
		<ul class="sidebar-nav">
			<li><a href="?mod='.$_GET['mod'].'&h=mulai" title="Pelayanan">Mulai Pelayanan <img src="../img/tambah.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=wo" title="Work Order">Data Work Order <img src="../img/daftar.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=penjualan" title="Penjualan">Transaksi Penjualan<img src="../img/tambah.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=sejarah_tr">Sejarah Pelayanan <img src="../img/daftar.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=sejarah_pl">Sejarah Penjualan <img src="../img/daftar.png"></a></li>
		<li class="judul">Kategori</li>
			<li><a href="?mod='.$_GET['mod'].'&h=kategori">Kategori Pelayanan<img src="../img/daftar.png"></a></li>
        </ul>';
		require ("pengguna.php");
	echo'
		</div>
	</div>';
	}
?>
