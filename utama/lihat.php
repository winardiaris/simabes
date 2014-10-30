<?php
	echo "<html>
	<head>
	<link href='../styler/utama.css' rel='stylesheet' type='text/css' />
	
	</head>";
	include ("../inc/koneksi.php");
	$id_brg=$_GET['id_brg'];
	
	$qry=mysql_query("SELECT * FROM br_data WHERE id_brg='$id_brg'") or die (mysql_error());
	$data=mysql_fetch_object($qry);
	
	echo "
		<table border='0' cellpadding='5' cellspacing='0' width='100%' align='center'>
			<tr>
				<td width='220px' rowspan='9' valign ='top' ><img src='../adm/".$data->photo_brg."' width='300' ></td>
				<td width='100px' valign='top' align='right'>ID barang</td>
				<td width='10px' align='center'>:</td>
				<td valign='top'>$data->id_brg</td>
			</tr>
			<tr>
				<td align='right'>Kode Barang</td>
				<td align='center'>:</td>
				<td>$data->kode_brg</td>
			</tr>
			<tr>
				<td align='right'>Nama Barang</td>
				<td align='center'>:</td>
				<td>$data->nm_brg</td>
			</tr>
			<tr>
				<td align='right'>Kategori</td>
				<td align='center'>:</td>
				<td>$data->id_kt_brg</td>
			</tr>
			<tr>
				<td align='right'>Kualitas</td>
				<td align='center'>:</td>
				<td >$data->id_kualitas</td>
			</tr>
			<tr>
				<td align='right'>Harga</td>
				<td align='center'>:</td>
				<td>";
				$harga = $data->hrg_jual;
				$Format_Harga = number_format($harga, 0,',','.');
				echo "Rp. $Format_Harga";
			echo"
			</tr>
			<tr>
				<td align='right'>Stok</td>
				<td align='center'>:</td>
				<td>$data->stok</td>
			</tr>
			<tr>
				<td align='right'>Rak</td>
				<td align='center'>:</td>
				<td>$data->id_rak</td>
			</tr>
			<tr>
				<td valign='top' align='right'>Keterangan</td>
				<td align='center'>:</td>
				<td>$data->ket_brg</td>
			</tr>
		</table></html>	";
?>
