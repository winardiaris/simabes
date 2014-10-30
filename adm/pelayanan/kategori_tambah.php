<?php
	$lokasi="Tambah Kategori Pelayanan";

	echo'
	<div class="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" >
		<div class="alat">
			<input name="ply_kat_simpan" type="submit" value="Simpan" class="simpan" id="kiri">
			<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		</div>
	<table cellpadding="5" cellspacing="0" border="0" >
		<tr><td style="width: 170px;"><label>Kategori Pelayanan</label></td><td style="width: 10px;">:</td><td style="width: auto;"><input  maxlength="30" size="40" name="nm_kat" class="text" ></td></tr>
		<tr><td ><label>Biaya Pelayanan</label></td><td>:</td><td><input  maxlength="30" size="40" name="biaya" class="text" type="number"></td></tr>
	</table>
	</form></div>';
?>

