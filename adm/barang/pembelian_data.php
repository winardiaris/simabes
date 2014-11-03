<?php
	$lokasi="Data Pemesanan Barang";
	$brg = new barang();
	$tampil = $brg->tampil_pembelian();
	$jml = count($tampil);
	
	echo'
	<div class="konten">'.$iframe.'
	<div class="lokasi">
		<label>'.$lokasi.'</label>
		<div class="kanan2">
			<form action="" method="get" name="fpencarian" id="fpencarian">
			<label>Terdapat <font>'.$jml.' </font> '.$lokasi.' </label>
			<input name="mod" value="'.$_GET['mod'].'" type="hidden" >
			<input name="h" value="'.$_GET['h'].'" type="hidden" >
			<input name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text" value="'; if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" placeholder="No Pemesanan | ID Supplier" > 
			</form>
		</div>
	</div>
<form name="fkonten" method="post" action="?mod='.$_GET['mod'].'&h=aksi">
<table cellpadding="5" cellspacing="0" class="table">
<tr id="th"><th align="right" width="10px">No.</th>
	<th align="center" width="10px">Cetak</th><th align="center" width="130px">No Pemesanan</th>
	<th align="center" width="80px">Tanggal</th><th>ID | Nama Supplier</th>
	<th align="center" width="60px">Jumlah</th></tr>';

$baris=1;
if($jml > 0){	
	foreach($tampil as $data){
		$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$baris++ .'.</td>
		<td align="center">
			<a href="barang/faktur_pes.php?no_pes='.$data['no_pes'].'" title="Cetak Pemesanan" target="framepopup" onClick="setdisplay(\'divpopup\',1)">
				<img src="../img/print.png" height="20px" width="20px">
			</a>
		</td>
		<td align="center">'.$data['no_pes'].'</td>
		<td align="center">'.$data['tgl_pes'].'</td>
		<td >';
			echo $brg->sunting_penyalur('nm_sup',$data['id_sup']);
		
		echo'
		</td>
		<td align="right">';
			$no_pes = $data['no_pes'];
			$id_sup = $data['id_sup'];
			echo count($brg->tampil_pembelian_detail("*","WHERE no_pes='$no_pes' "));
		echo'
		</td>
	</tr>';
	}
	echo'	
	</table>
	</form>
	</div>';
}
elseif(count($tampil)==0  && !empty($_GET['cari'])){
	echo "<script type='text/javascript'> alert('Pencarian [".$_GET['cari']."] tidak ditemukan');history.back()</script>";
}
else{echo "<script type='text/javascript'> alert('Data kosong');window.location='?mod=barang&h=data'</script>";}
?>
