<?php
	echo'
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
		<html><head>  
			<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
			<link rel="stylesheet" type="text/css" href="../../styler/kartu.css">
		</head>
		<body>
			<form><input class="noPrint" type="button" value="Cetak" onclick="window.print()"></form>
			<div class="page">';
		
	include ("../../inc/konf.php");
	include ("../../inc/koneksi.php");
	
	$sql = "SELECT count( * ) as num FROM `sementara` WHERE id_sementara='pencetakan_label'  ";
	$result = mysql_query($sql);
	$result = mysql_fetch_assoc( $result );
	$jml = $result['num'];

	if ($jml!=0){
	$qlabel=mysql_query("select * from sementara WHERE id_sementara='pencetakan_label'");

	while($dlabel=mysql_fetch_object($qlabel)){
		$cekbrg="select * from br_data where id_brg='$dlabel->value'";
		$brg=mysql_query($cekbrg) or die(mysql_error());
		
		while($data=mysql_fetch_object($brg)){
			echo "
			<div class='label'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<th>".$data->id_brg."</th>
					</tr>
					<tr>
						<td>".strtoupper($data->nm_brg)."</td>
					</tr>
					<tr>
						<td><label class='harga'>";
						$harga = $data->hrg_jual;
						$Format_Harga = number_format($harga, 0,',','.');
						echo "Rp. ".$Format_Harga;
						echo"</label></td>
					</tr>
					<tr>
						<td>";
						$q = mysql_query("SELECT * FROM br_data_perkendaraan WHERE id_brg='$data->id_brg'") or die (mysql_error());
						while($d=mysql_fetch_object($q)){
							echo $d->id_kendaraan ." ";
						}
						
						echo"</td>
					</tr>
				</table>
			</div>";
		}
		
	}
	sleep(1);
		$q= "DELETE FROM `sementara`  WHERE id_sementara='pencetakan_label'";
		mysql_query($q) or die (mysql_error());
	}
	else{
		echo "<script type='text/javascript'> alert('Jumlah antrian kosong');setdisplay('divpopup',0);history.back();</script>";
	}
	echo'</div></body></html>';
?>
