<?php 		
	$id_mod=6;
	include("../inc/cek_akses.php");
	echo'
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
		<li class="judul">Pelaporan</li>
		<ul class="sidebar-nav">
			<li><a href="?mod=pelaporan&h=st_barang">Statisktik Barang <img src="../img/sistem.png"></a></li>
			<li><a href="?mod=pelaporan&h=st_pelanggan">Statistik Pelanggan <img src="../img/orang.png"></a></li>
			<li><a href="?mod=pelaporan&h=pelayanan">Pelaporan Pelayanan<img src="../img/daftar.png"></a></li>
			<li><a href="?mod=pelaporan&h=penjualan">Pelaporan Penjualan<img src="../img/daftar.png"></a></li>
		<li class="judul">Laporan Lainnya</li>
			<li><a href="?mod=pelaporan&h=lain&id=pelanggan">Pelaporan Pelanggan<img src="../img/masuk.png"></a></li>
			<li><a href="?mod=pelaporan&h=lain&id=barang">Pelaporan Barang<img src="../img/masuk.png"></a></li>
			<li><a href="?mod=pelaporan&h=lain&id=supplier">Pelaporan Supplier<img src="../img/masuk.png"></a></li>
			<li><a href="?mod=pelaporan&h=lain&id=pegawai">Pelaporan Pegawai<img src="../img/masuk.png"></a></li>
		<li class="judul">Keuangan</li>
			<li><a href="?mod=pelaporan&h=keuangan">Pelaporan Keuangan<img src="../img/masuk.png"></a></li>
         </ul>';
		require ("pengguna.php");
		echo'
        </div>
	</div>';
?>
