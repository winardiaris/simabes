<?php
	$lokasi="Data Penyalur";
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
					type="text"  placeholder="ID / Nama Penyalur" title="Pencarian dengan ID / Nama Penyalur" 
					value="';if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'"> 
				</form>
			</div>
		</div>
	<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan dihapus\')">
		<div class="alat">
			<button class="perbaharui" id="kiri" onclick="window.location=\'?mod='.$_GET['mod'].'&h=penyalur_tambah\'">Tambah</button>
			<input name="br_Penyalur_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan" type="submit">
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
		</div>
	<table class="table" cellpadding="5" cellspacing="0" border="0">
	<tr>
		<th align="right" width="10px">No.</th>
		<th align="center" width="10px"><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.count($tampil).')"></th>
		<th align="center" width="10px">Sunting</th>
		<th align="center" width="80px">ID Penyalur</th>
		<th align="center" width="150px">Nama</th>
		<th align="center" >Alamat</th>
		<th align="center" width="80px">No Telp/HP</td>
		<th align="center" width="120px">Terakhir diubah</th>
	</tr>';
if(count($tampil)>0){
	$baris = 0;
	foreach($tampil as $data){
		$baris++;
		$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$baris.'.</td>
		<td align="center"><input name="item[]" id="item'.$baris.'" value="'.$data['id_sup'].'" type="checkbox"></td>
		<td align="center"><a href="?mod='.$_GET['mod'].'&h=penyalur_sunting&id_sup='.$data['id_sup'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>	
		<td align="center">'.$data['id_sup'].'</td>
		<td>'.$data['nm_sup'].'</td>
		<td>'.$data['almt_sup'].'</td>
		<td align="left">'.$data['telp_sup'].'</td>
		<td align="center">'.$data['wkt_ubah'].'</td>
	</tr>';
	}
}
elseif(count($tampil)==0  && !empty($_GET['cari'])){
	echo "<script type='text/javascript'> toastr.warning('Pencarian [".$_GET['cari']."] tidak ditemukan ! <button class=\'perbaharui\' onclick=\' history.back()\'>OK</button>', 'SIMaBeS');</script>";
	echo "<tr><td colspan='8'>-- Pencarian [".$_GET['cari']."] tidak ditemukan --</td></tr>";
}
else{
	echo "<script type='text/javascript'>toastr.warning('".$lokasi." kosong!', 'SIMaBeS');</script>";
	echo "<tr><td colspan='8'>-- Data Kosong --</td></tr>";
}
	echo'
	</table>
	</form>
	</div>';
?>
