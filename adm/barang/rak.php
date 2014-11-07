<?php
	$lokasi="Rak Penyimpanan Barang";
	$brg = new barang();
	$tampil = $brg->tampil_rak();
	
	echo'
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1"  method="post" action="?mod='.$_GET['mod'].'&h=aksi" name="form1" onsubmit="return cek_chk(\'Pilih data yang akan dihapus\');">
		<div class="alat">
			<a href="?mod='.$_GET['mod'].'&h=rak_tambah"><input name="br_rak_tambah" value="Tambah" class="tambah" id="kiri" type="button"></a>
			<input name="br_rak_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
		</div>
	<table class="table" cellpadding="5" cellspacing="0" border="0">
		<tr><th align="right" width="10px">No.</th><th align="center" width="10px"><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.count($tampil).')"></th>
		<th align="center" width="10px">Sunting</th><th align="center" width="80px">Nama Rak</th><th align="center">Keterangan</th><th align="center" width="120px">Terakhir diubah</th>
		</tr>';
	
	$i=0;
	foreach($tampil as $data){
		$i++;
		$kolom= ($i %2 == 1)? "kolom-ganjil" : "kolom-genap";
		echo'
		<tr class="'.$kolom.'">
			<td align="right">'.$i.'.</td>
			<td align="center"><input name="item[]" id="item'.$i.'" value="'.$data['id_rak'].'" type="checkbox"></td>
			<td align="center"><a href="?mod='.$_GET['mod'].'&h=rak_sunting&id_rak='.$data['id_rak'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
			<td>'.$data['nm_rak'].'</td>
			<td>'.$data['ket'].'</td>
			<td align="center">'.$data['wkt_ubah'].'</td>
		</tr>';
		}
	echo'
	</table>
	</form>
	</div>';
?>
