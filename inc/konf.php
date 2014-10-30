<?php
include ("koneksi.php");
//Nama aplikasi
$aplikasi = "SIMaBeS";

//Menetapkan Zona Waktu
date_default_timezone_set("Asia/Jakarta");

//jumlah baris setiap daftar
$jumlah_baris = 20;


//iframe
$iframe = "	<div id=\"divpopup\" name=\"divpopup\" class=\"dpop\" style=\"display:none\">
				<iframe id=\"framepopup\" name=\"framepopup\" class=\"fpop\" src=\"index.html\"></iframe><br/>
				<a href=# onClick=\"window.framepopup.location='../inc/index.html';setdisplay('divpopup',0); return false\"><button type=\"button\">TUTUP</button></a>
			</div>";
			
$sekarang = date("Y-m-d H:i:s");
?>
