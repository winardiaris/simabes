<?php
	$no_struk=$_GET['no_struk'];
	$id_kt_ply =$_GET['id_kt_ply'];
	

	$qry =  "delete from ply_detail where id_kt_ply ='$id_kt_ply' AND no_struk='$no_struk' limit 1"; 

	mysql_query($qry) or die ("Gagal menghapus"); 

	//header ("location:ply_pembelian.php");
	echo "<script type='text/javascript'>alert('Data berhasil dihapus');history.back();</script>";
?>
