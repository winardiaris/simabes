<!DOCTYPE html>
<html><head>  
  	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../../styler/cetak.css"/>
	<meta name="generator" content="Geany 1.23.1" />
</head>
<body>
	<form><input class="noPrint" type="button" value="Cetak Struk"onclick="window.print()"></form>
<?php
	$judul="PELAYANAN";
	include ("../../inc/konf.php");
	include ("../../inc/koneksi.php");
	
	$no_struk=$_GET['no_struk'];
	
	$qry=mysql_query("SELECT * FROM ply_ WHERE no_struk='$no_struk' LIMIT 1");
	$data=mysql_fetch_object($qry);
	$uang_bayar = $data->uang_bayar;
	
	$no_wo = $data->no_wo;
	$y=mysql_query("SELECT * FROM ply_wo WHERE no_wo='$no_wo' LIMIT 1");
	$wo=mysql_fetch_object($y);
	
	$x=mysql_query("SELECT nm_plg,almt_plg,telp_plg FROM dt_pelanggan WHERE id_plg='$wo->id_plg' LIMIT 1");
	$plg=mysql_fetch_object($x);
	
	
	
	if(mysql_num_rows($qry)==0){
		echo "<script type='text/javascript'> alert('No Struk tidak ada !');history.back();</script>";
	}
	else{

// ----- awal jumlah 
		//bayar
		$z = mysql_query("SELECT SUM( IF( no_struk LIKE  '%$no_struk%', jml_brg, 0 ) ) AS tot_brg".
						", SUM( IF( no_struk LIKE  '%$no_struk%', total, 0 ) ) AS tot_bayar_brg ".
						"FROM  ply_penjualan_detail");
						
		$x = mysql_query("	SELECT SUM( biaya ) AS biaya
							FROM ply_detail
							INNER JOIN ply_kategori ON ply_detail.id_kt_ply = ply_kategori.id_kt_ply
							WHERE ply_detail.no_struk =  '$no_struk'");
	
		$data2=mysql_fetch_array($z);
		$data3=mysql_fetch_object($x);
		$tot_brg = $data2['tot_brg'];
		
		$biaya = $data3->biaya;
		$tot_bayar_brg = $data2['tot_bayar_brg'];
		$tot_bayar = $biaya + $tot_bayar_brg;
		
// ----- akhir jumlah
// ---- atap
		$atap=mysql_query("SELECT * FROM pengaturan WHERE id='1'");
		$isi_atap=mysql_fetch_object($atap);
			
echo"
<div >
	<table width='600px' cellpadding='2' border='0'>
		<tr><td><font class='nm_bengkel'>$isi_atap->nm_bengkel</font></td></tr>
		<tr><td><label>$isi_atap->almt_bengkel</label></td></tr>
		<tr><td><label>$isi_atap->telp1  $isi_atap->telp2</label></td></tr>
		<tr><th align='center'>$judul</th></tr>

	</table>
	<table width='600px' cellpadding='2' border='0'  >
		<tr>
			<td valign='top' width='100px'><label>No Struk:</label></td>
			<td valign='top' width='250px'>$no_struk</td>
			<!-- -->
			<td valign='top' width='100px'><label>Tanggal:</label></td>
			<td valign='top' width='250px'>$data->tgl_struk</td>
		</tr>
		<tr>
			<td valign='top' ><label>ID Pelanggan:</label></td>
			<td valign='top' >$wo->id_plg</td>
			<!-- -->
			<td valign='top' ><label>No. Polisi:</label></td>
			<td valign='top'>$wo->no_polisi</td>
		</tr>
		<tr>
			<td valign='top'><label>Nama:</label></td>
			<td valign='top'>$plg->nm_plg</td>
			<!-- -->
			<td valign='top'><label>No. Mesin:</label></td>
			<td valign='top'>$wo->no_mesin</td>
		</tr>
		<tr>
			<td valign='top'><label>Telepon/ponsel:</label></td>
			<td valign='top'>$plg->telp_plg</td>
			<!-- -->
			<td valign='top'><label>Jenis Kendaraan:</label></td>
			<td valign='top'>$wo->jns_kendaraan</td>
		</tr>
		<tr>
			<td valign='top'><label>Alamat:</label></td>
			<td valign='top'>$plg->almt_plg</td>
			<!-- -->
			<td valign='top'><label>KM terakhir:</label></td>
			<td valign='top'>$wo->km_terakhir</td>
		</tr>
		<tr>
			<td valign='top' valign='top'><label> Saran Mekanik:</label></td>
			
			<td valign='top'>$wo->saran</td>
			<!-- -->
			<td valign='top' valign='top'><label>Keluhan:</label></td>
			<td valign='top' colspan='2'>$wo->keluhan</td>
		</tr>
		<tr>
			<td valign='top' valign='top'><label>Mekanik:</label></td>
			<td valign='top'> ";
				$id_peg=$wo->id_peg;
				$peg=mysql_query("SELECT nm_peg FROM dt_pegawai WHERE id_peg='$id_peg' LIMIT 1")OR DIE(mysql_error());
				$dpeg=mysql_fetch_object($peg);
				echo $wo->id_peg." | " .$dpeg->nm_peg;
			echo" 
			</td>
			<!-- -->
			<td valign='top' valign='top'><label>Petugas:</label></td>
			<td valign='top' colspan='2'>";
				$qpg=mysql_query("SELECT nm_asli FROM dt_pengguna WHERE id_pengguna='$data->id_pengguna'") or die(mysql_error());
				$dpg = mysql_fetch_object($qpg);
				echo $data->id_pengguna ."  |  ". $dpg->nm_asli ;
			echo"
			</td>
		</tr>
	</table>
</div>
<br>
<div>
	<table width='600px'  cellpadding='2' border='0'>
		<tr id='th'>
			<th width='10px'>No</th>
			<th width='100px'>ID</th>
			<th>Nama Barang / Jenis Pelayanan</th>
			<th width='10px'>Jml</th>
			<th width='50px'>Harga</th>
			<th width='90px'>Total</th>
		</tr>";
		

		$baris=0;
		//---- buat kategori pelayanan
		$q="SELECT * FROM ply_detail WHERE no_struk='$no_struk' ORDER BY id_kt_ply ASC ";
		$daf_pel =mysql_query($q) or die (mysql_error());
		
		
		
		if(mysql_num_rows($daf_pel)>0){	
		while($data2=mysql_fetch_object($daf_pel)){
		$baris++;		
		
		$r=mysql_query("SELECT * FROM ply_kategori WHERE id_kt_ply='$data2->id_kt_ply' ")or die(mysql_error());
		$daf_pel2 = mysql_fetch_object($r);
		echo "	<tr>
					<td valign='top' align='right'>$baris.</td>
					<td valign='top'>". $data2->id_kt_ply ."</td>
					<td valign='top'>". $daf_pel2->nm_kt_ply ."</td>
					<td valign='top'></td>
					<td valign='top'></td>
					<td valign='top' align='right' ><span class='mu'>Rp. </span>". number_format($daf_pel2->biaya, 0,',','.') ."</td>
				</tr>";
		}
		}
		
		//---- buat barang
		$qry="SELECT * FROM ply_penjualan_detail WHERE no_struk='$no_struk' ORDER BY id_brg ASC ";
		$daftar=mysql_query($qry) or die (mysql_error());
		
		if(mysql_num_rows($daftar)>0){	
		while($data=mysql_fetch_object($daftar)){
		$baris++;
		
		$x = mysql_query("SELECT nm_brg,hrg_jual FROM br_data WHERE id_brg='$data->id_brg'") or die (mysql_error());
		$brg=mysql_fetch_object($x);
				
		echo "	<tr>
					<td valign='top' align='right'>$baris.</td>
					<td valign='top'>". $data->id_brg ."</td>
					<td valign='top'>". $brg->nm_brg ."</td>
					<td valign='top' align='right'>". $data->jml_brg."</td>
					<td valign='top' align='right'>". number_format($brg->hrg_jual, 0,',','.') ."</td>
					<td valign='top' align='right'><span class='mu'>Rp. </span>". number_format($data->total, 0,',','.') ."</td>
				</tr>";
		}
		}
		else{	
		echo "	<tr>
					<td valign='top'>-</td>
					<td valign='top'>-</td>
					<td valign='top'>-</td>
					<td valign='top'>-</td>
					<td valign='top' align='right'>0</td>
					<td valign='top' align='right'>0</td>
					<td valign='top' align='right'>0</td>
				</tr>";
		}
		
		echo "	<tr >
					<td valign='top' colspan='3' align='right'>Total</td>
					<td valign='top' align='right'>". $tot_brg ."</td>
					<td></td>
					<td valign='top' align='right'><span class='mu'>Rp. </span>". number_format($tot_bayar, 0,',','.') ."</td>
				</tr>
				<tr >
					<td colspan='3' align='right'>Uang Bayar</td>
					<td></td>
					<td></td>
					<td align='right'><span class='mu' >Rp. </span>". number_format($uang_bayar, 0,',','.') ."</td>
				</tr>";
					$uang_kembali = $uang_bayar - $tot_bayar;
				echo"
				<tr >
					<td colspan='3' align='right'>Uang Kembali</td>
					<td></td>
					<td></td>
					<td align='right'><span class='mu' >Rp. </span>". number_format($uang_kembali, 0,',','.') ."</td>
				</tr>";
		?>	
		</table>
</div>
	<?php } //penutup else paling atas?>
</body></html>
