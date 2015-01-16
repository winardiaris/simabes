<?php
include ("koneksi.php");
//Nama aplikasi
$aplikasi = "SIMaBeS";

//Menetapkan Zona Waktu
date_default_timezone_set("Asia/Jakarta");

//jumlah baris setiap daftar
$jumlah_baris = 20;


//iframe
$iframe = '	<div id="divpopup" name="divpopup" class="dpop" style="display:none">
				<iframe id="framepopup" name="framepopup" class="fpop" src="loading.html"></iframe><br/>
				<a href=# onClick="window.framepopup.location=\'loading.html\';setdisplay(\'divpopup\',0); return false"><button type="button" class="btn btn-danger btn-frame"><i class="fa fa-power-off"></i> Close</button></a>
			</div>';
			
$sekarang = date("Y-m-d H:i:s");
?>
