<?php
	$lokasi="Data Kelompok Pengguna";
	$sis = new sistem();
	$tampil = $sis->tampil_kelompok();
	
	echo'
	<div class="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	
	<form class="form1" name="fkonten" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return confirm(\'Hapus Data Terpilih ?\')">
	<div class="alat">
		<a href="?mod='.$_GET['mod'].'&h=kelompok_tambah"><button class="tambah" id="kiri" type="button">Tambah Kelompok Pengguna</button></a>
		<input name="hapus_kelompok" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
		<input name="lokasi" value="'.$lokasi.'" type="hidden" >
	</div>
	<table class="table" cellpadding="5" cellspacing="0" >
	<tr id="th"><th align="right" width="10px">No.</th><th align="center" width="10px"></th><th align="center" width="10px">Sunting</th><th align="center" width="100px">ID Kelompok</th><th align="center">Nama Kelompok</th></tr>';
	
	$baris=1;
	foreach($tampil as $data){
		$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
	
	echo'
		<tr class="'.$kolom.'">
			<td align="right">'.$baris++ .'.</td>
			<td align="center"><input name="item[]" id="item[]" value="'.$data['kel_id'].'" type="checkbox"></td>
			<td align="center"><a href="?mod='.$_GET['mod'].'&h=kelompok_sunting&kel_id='.$data['kel_id'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
			<td align="center">'.$data['kel_id'].'</td>
			<td>'.$data['nm_kel'].'</td>
		
		</tr>';
	}
	echo'
		
	</table>
	</form>
	</div>';
?>
