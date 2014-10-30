<?php
	$lokasi="Kategori Pelayanan";
	$ply = new pelayanan();
	$tampil = $ply->ambil_kt_pelayanan();
	
	echo'
	<div class="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return confirm(\'Hapus Data Terpilih ?\')">
		<div class="alat">
			<a href="?mod='.$_GET['mod'].'&h=kategori_tambah"><button class="tambah" id="kiri" type="button" >Tambah Kategori Pelayanan </button></a>
			<input name="ply_kat_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan" type="submit">
		</div>
	<table class="table" cellpadding="5" cellspacing="0" border="0">
	<tr><th align="right" width="10px">No.</th><th align="center" width="10px"></th><th align="center" width="10px">Sunting</th><th align="center">Nama Kategori Pelayanan</th><th align="center" width="80px">Biaya</th></tr>';
	$baris=1;
	foreach($tampil as $data){
	$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$baris++.'.</td>
		<td align="center"><input name="item[]" id="item[]" value="'.$data['id_kt_ply'].'" type="checkbox"></td>
		<td align="center"><a href="?mod=pelayanan&h=kategori_sunting&id_kt_ply='.$data['id_kt_ply'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
		<td>'.$data['nm_kt_ply'].'</td>
		<td align="right"><span class="mu">Rp.</span>'.number_format($data['biaya'], 0,',','.').'</td>
	</tr>';
		}
	echo'
	</table>
	</form>
	</div>';
?>
