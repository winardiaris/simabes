<?php
session_start();
//membuat log
		include ("inc/koneksi.php");
		$pengguna=$_SESSION['nama_asli'];
		$lokasi="System";
		$pesan="Pengguna (".$_SESSION['nama_asli'].") keluar";
		$sekarang = date("Y-m-d H:i:s");
		$log=" insert into log_sistem (log_id,log_tipe,pengguna,log_lokasi,log_pesan,log_waktu)".
		"values('','sistem','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
		// 
//hapus session yang sudah dibuat
session_destroy();
 
//redirect ke halaman login
header('location:login.php');
?>
