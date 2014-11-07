<!DOCTYPE html>
<html><head>  
  	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../../styler/cetak.css"/>
	<meta name="generator" content="Geany 1.23.1" />
	
	<style type="text/css">
	@media print {
	input.noPrint { display: none; }
	}
	</style>
</head>
<body>
	<form><input class="noPrint" type="button" value="Cetak Struk"onclick="window.print()"></form>
<?php
	$judul="PENJUALAN LANGSUNG";
	include ("../../inc/konf.php");
	include ("../../inc/koneksi.php");
	
	$no_struk=$_GET['no_struk'];
	
	$qry=mysql_query("SELECT * FROM ply_penjualan WHERE no_struk='$no_struk' LIMIT 1");
	$data=mysql_fetch_object($qry);
	$uang_bayar = $data->uang_bayar;
	
	
	$y=mysql_query("SELECT * FROM ply_penjualan_detail WHERE no_struk='$no_struk' LIMIT 1");
	$detail=mysql_fetch_object($y);
	
	
	
	if(mysql_num_rows($qry)==0){
		echo "<script type='text/javascript'> alert('No Struk tidak ada !');history.back();</script>";
	}
	else{

// ----- awal jumlah 
		$a = mysql_query("SELECT SUM( IF( no_struk LIKE  '%$no_struk%', jml_brg, 0 ) ) AS tot_brg".
						", SUM( IF( no_struk LIKE  '%$no_struk%', total, 0 ) ) AS tot_bayar_brg ".
						"FROM  ply_penjualan_detail");
		//$b = mysql_query("SELECT SUM( biaya ) AS biaya FROM  ply_detail1 WHERE no_struk LIKE '%$no_struk%'");
	
		$data2=mysql_fetch_array($a);
		//$data3=mysql_fetch_object($b);
		$tot_brg = $data2['tot_brg'];
		
		//$biaya = $data3->biaya;
		$tot_bayar_brg = $data2['tot_bayar_brg'];
		//$tot_bayar = $biaya + $tot_bayar_brg;
		$tot_bayar =  $tot_bayar_brg;
		
// ----- akhir jumlah
// ---- atap
		$atap=mysql_query("SELECT * FROM pengaturan WHERE id='1'");
		$isi_atap=mysql_fetch_object($atap);
			
?>
<div >
	<table width="600px" cellpadding="2" border="0">
		<tr><td><font class="nm_bengkel"><?php echo $isi_atap->nm_bengkel?></font></td></tr>
		<tr><td><label><?php echo $isi_atap->almt_bengkel?></label></td></tr>
		<tr><td><label><?php echo $isi_atap->telp1?></label></td></tr>
		<tr><td><label><?php echo $isi_atap->telp2?></label></td></tr>
		<tr><th align="center"><?php echo $judul ?></th></tr>

	</table>
	<table width="600px" cellpadding="5" border="0"  >
		<tr>
			<td valign="top" width="120px"><label>No Struk:</label></td>
			<td valign="top" width="275px"><?php echo $no_struk ?></td>
			<!-- -->
			<td valign="top" width="120px"><label>Tanggal:</label></td>
			<td valign="top" width="275px"><?php echo $data->tgl_struk; ?></td>
			<!-- -->
		</tr>
		<tr>
			<td valign="top"><label>Pelanggan:</label></td>
			<td valign="top"><?php echo $data->nm_plg?></td>
			<!-- -->
			<td valign="top"><label>Petugas:</label></td>
			<td valign="top">
				<?php 
					$qpg=mysql_query("SELECT nm_asli FROM dt_pengguna WHERE id_pengguna='$data->id_pengguna'") or die(mysql_error());
					$dpg = mysql_fetch_object($qpg);
				
					echo $data->id_pengguna ."  |  ". $dpg->nm_asli ;  
				?></td>
		</tr>
	</table>
</div>
<br>
<div>
	<table width="600px"  cellpadding="5" border="0">
		<tr id="th">
			<th width="10px">No</th>
			<th width="100px">ID</th>
			<th>Nama Barang </th>
			<th width="10px">Jml</th>
			<th width="50px">Harga</th>
			<th width="90px">Total</th>
		</tr>
		
		<?php
		$baris=0;
			
		
		//---- buat barang
		$qry="SELECT * FROM ply_penjualan_detail WHERE no_struk='$no_struk' ORDER BY id_brg ASC ";
		$daftar=mysql_query($qry) or die (mysql_error());
		
		if(mysql_num_rows($daftar)>0){	
		while($data=mysql_fetch_object($daftar)){
		$baris++;
			$a=mysql_query("SELECT * FROM br_data WHERE id_brg='$data->id_brg'") or die(mysql_error());
			$b=mysql_fetch_object($a);
		echo "	<tr>
					<td valign='top' align='right'>$baris.</td>
					<td valign='top'>". $data->id_brg ."</td>
					<td valign='top'>". $b->nm_brg ."</td>
					<td valign='top' align='right'>". $data->jml_brg."</td>
					<td valign='top' align='right'>". number_format($b->hrg_jual, 0,',','.') ."</td>
					<td valign='top' align='right'><span class='mu'>Rp. </span>". number_format($data->total, 0,',','.') ."</td>
				</tr>";
		}// penutup while($data=mysql_fetch_object($daftar)){
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
		echo "	<tr class='total'>
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
</body>

</html>
