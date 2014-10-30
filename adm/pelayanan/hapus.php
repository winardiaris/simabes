<?php
	$no_struk  =$_GET['no_struk'];
	$id_brg =$_GET['id_brg'];
	$jml	=$_GET['jml'];
	
	$qry="SELECT id_brg, stok, terjual FROM br_data WHERE id_brg='$id_brg' ";
	$daftar=mysql_query($qry) or die (mysql_error());
	$data=mysql_fetch_object($daftar);
		$tambah =$data->stok + $jml;
		$balik =$data->terjual - $jml;
	
	$qry2 =  "delete from ply_penjualan_detail where id_brg ='$id_brg' AND no_struk='$no_struk' limit 1"; 
	
	$qry3= "UPDATE br_data SET stok='$tambah', terjual='$balik' WHERE id_brg='$id_brg'";

	mysql_query($qry) or die (mysql_error()); 
	mysql_query($qry2) or die (mysql_error()); 
	mysql_query($qry3) or die (mysql_error()); 
	//header ("location:ply_penjualan.php");
	echo "<script type='text/javascript'>alert('Data berhasil dihapus');history.back();</script>";
?>
