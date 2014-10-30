<?php
//cek akses pengguna ------------------------------------
	$kel_id=$_SESSION['kel_id'];
	$qakses=mysql_query("SELECT id_menu FROM  `akses_pengguna` WHERE  `kel_id` ='$kel_id' AND id_menu='$id_mod'");
	if(mysql_num_rows($qakses)==0){
		echo "<script type='text/javascript'> alert('Anda tidak berhak');history.back();</script>";
		return false;
	}
//cek akses pengguna ------------------------------------
?>
