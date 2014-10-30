<?php 
	$id_mod=6;
	include("../inc/cek_akses.php");
	
	echo'
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
		<li class="judul">Sistem</li>
		<ul class="sidebar-nav">
			<li><a href="?mod='.$_GET['mod'].'&h=bengkel">Pengaturan Bengkel <img src="../img/sistem.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=pengguna">Pengguna Aplikasi <img src="../img/orang.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=kelompok">Kelompok Pengguna <img src="../img/sistem.png"></a></li>
			<li><a href="?mod='.$_GET['mod'].'&h=log">Catatan Sistem<img src="../img/sistem.png"></a></li>
		</ul>';
	
	require ("pengguna.php");
	echo'
        </div>
	</div>';
	?>
