<?php
	$lokasi="Tambah Data Penyalur";
	echo'
	<div class="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_penyalur()">
	<div class="alat">
		<input name="br_supplier_simpan" type="submit" value="Simpan" class="simpan" id="kiri">
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table cellpadding="5" cellspacing="0" border="0" >
		<tr><td ><label>Nama Penyalur*</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="nm_sup" class="text"></td></tr>
		<tr><td valign="top"><label>Alamat Penyalur*</label></td><td valign="top">:</td>
			<td><textarea  cols="50" rows="5" name="almt_sup"></textarea></td></tr>
		<tr><td><label>Telp/Ponsel*</label></td><td>:</td>
			<td><input  maxlength="13" size="20" name="telp_sup" class="text"></td></tr>
	</table>
	</form>
	</div>';
?>
