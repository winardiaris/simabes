<?php
	$lokasi="Data Supplier";
	$brg = new barang();
	$tampil = $brg->tampil_penyalur();

	echo'
	<div class="konten">
		<div class="lokasi">
			<label>'.$lokasi.'</label>
			<div class="kanan2">
				<form class="form1" action="" method="get" name="fpencarian" id="fpencarian">
					<input name="mod" value="barang"  type="hidden" >
					<input name="h" value="penyalur"  type="hidden" >
					<input name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" 
					type="text"  placeholder="ID / Nama Supplier" title="Pencarian dengan ID / Nama Supplier" 
					value="';if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'"> 
				</form>
			</div>
		</div>
	<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return confirm(\'Hapus Data Terpilih ?\')">
		<div class="alat">
			<input name="br_supplier_hapus" value="Hapus Data Terpilih" class="hapus" id="sendiri" type="submit">
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
		</div>
	<table class="table" cellpadding="5" cellspacing="0" border="0">
	<tr>
		<th align="right" width="10px">No.</th>
		<th align="center" width="10px"></th>
		<th align="center" width="10px">Sunting</th>
		<th align="center" width="80px">ID Supplier</th>
		<th align="center" width="150px">Nama</th>
		<th align="center" >Alamat</th>
		<th align="center" width="80px">No Telp/HP</td>
		<th align="center" width="120px">Terakhir diubah</th>
	</tr>';
if(count($tampil)>0){
	$baris = 1;
	foreach($tampil as $data){
		$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$baris++ .'.</td>
		<td align="center"><input name="item[]" id="item[]" value="'.$data['id_sup'].'" type="checkbox"></td>
		<td align="center"><a href="?mod='.$_GET['mod'].'&h=penyalur_sunting&id_sup='.$data['id_sup'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>	
		<td align="center">'.$data['id_sup'].'</td>
		<td>'.$data['nm_sup'].'</td>
		<td>'.$data['almt_sup'].'</td>
		<td align="left">'.$data['telp_sup'].'</td>
		<td align="center">'.$data['wkt_ubah'].'</td>
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
else{
	echo "<script type='text/javascript'> alert('Penyalur kosong');window.location='?mod=".$_GET['mod']."&h=penyalur_tambah'</script>";
} 
?>
