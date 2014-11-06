<?php
	$lokasi="Tambah Kategori";
	echo'
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"   method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_kategori()">
	<div class="alat">
		<input name="br_kategori_simpan" type="submit" value="Simpan" class="simpan" id="kiri">
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="history.back();">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table cellpadding="5" cellspacing="0" border="0" >
		<tr><td style="width: 170px;"><label>ID Kategori</label></td><td style="width: 10px;">:</td>
			<td style="width: auto;"><input  maxlength="2" size="15" name="id_kt_brg" class="text" autocomplete="off" ></td></tr>
		<tr><td ><label>Nama Kategori</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="nm_kt_brg" class="text" autocomplete="off"></td></tr>	
	</table>
	</form>
	</div>';
?>
