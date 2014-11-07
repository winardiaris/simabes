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
	<form><input class="noPrint" type="button" value="Cetak Faktur"onclick="window.print()"></form>
<?php
	$judul=" PEMESANAN BARANG";
	include ("../../inc/konf.php");
	include ("../../inc/koneksi.php");
	
	$nopes=$_GET['no_pes'];
	
	$qry=mysql_query("SELECT * FROM br_pembelian WHERE no_pes='$nopes' LIMIT 1");
	$data=mysql_fetch_object($qry);
	
	
	$y=mysql_query("SELECT * FROM br_pembelian_detail WHERE no_pes='$nopes' LIMIT 1");
	$detail=mysql_fetch_object($y);
	
	
	
	if(mysql_num_rows($qry)==0){
		echo "<script type='text/javascript'> alert('No Pesanan tidak ada !');history.back();</script>";
	}
	else{

// ----- awal jumlah 
		$a = mysql_query("SELECT SUM( jml_brg ) AS tot_brg FROM  br_pembelian_detail WHERE no_pes LIKE '%$nopes%'");
	
		$djml=mysql_fetch_array($a);
		$tot_brg = $djml['tot_brg'];
		
	
		
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
		<tr><th><?php echo $judul ?></th></tr>
	</table>
	<table width="600px" cellpadding="2" border="0"  >
		<tr>
			<td valign="top" width="120px"><label>No Pesanan</label></td>
			<td valign="top" width="5px">:</td>
			<td valign="top"><?php echo $nopes ?></td>
			<!-- -->
			<td valign="top" width="120px"><label>Tanggal Pemesanan</label></td>
			<td valign="top" width="5px">:</td>
			<td valign="top"><?php echo $data->tgl_pes; ?></td>
			<!-- -->
		</tr>
		<tr>
			<td valign="top"><label>Supplier</label></td>
			<td valign="top">:</td>
			<td valign="top"><?php 
				$qsup=mysql_query("SELECT * FROM sup_data WHERE id_sup='$data->id_sup'");
				$dsup=mysql_fetch_object($qsup);
				echo $dsup->nm_sup ;
			?></td>
			<!-- -->
			<td valign="top" ><label>Petugas</label></td>
			<td valign="top" >:</td>
			<td valign="top">
				<?php 
					$qpg=mysql_query("SELECT nm_asli FROM dt_pengguna WHERE id_pengguna='$data->id_pengguna'") or die(mysql_error());
					$dpg = mysql_fetch_object($qpg);
				
					echo $data->id_pengguna ."  |  ". $dpg->nm_asli ; 
				?>
			</td>
		</tr>
	</table>
</div>
<div>
	<table width="600px"  cellpadding="2" border="0">
		<tr id="th">
			<th width="10px">No</th>
			<th width="180px">ID | Kode Barang</th>
			<th>Nama Barang </th>
			<th width="20px">Jumlah</th>
		</tr>
		
		<?php
		$baris=0;
			
		
		//---- buat barang
		$qry="SELECT * FROM br_pembelian_detail WHERE no_pes='$nopes' ORDER BY id_brg ASC ";
		$daftar=mysql_query($qry) or die (mysql_error());
		
		if(mysql_num_rows($daftar)>0){	
		while($data=mysql_fetch_object($daftar)){
		$baris++;
		
		$qbrg=mysql_query("SELECT * FROM br_data WHERE id_brg='$data->id_brg'");
		$dbrg=mysql_fetch_object($qbrg);
		
				
		echo "	<tr>
					<td valign='top' align='right'>$baris.</td>
					<td valign='top'>". $data->id_brg . " | ". $dbrg->kode_brg ."</td>
					<td valign='top'>". $dbrg->nm_brg ."</td>
					<td valign='top' align='right'>". $data->jml_brg."</td>
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
				</tr>";
		}
		echo "	<tr class='total'>
					<td valign='top' colspan='3' align='right'>Total</td>
					<td valign='top' align='right'>". $tot_brg ."</td>
				</tr>";
		?>	
		</table>
</div>
	<?php } //penutup else paling atas?>
</body>

</html>
