<?php
	$lokasi="Tambah jenis kendaraan";
	echo'
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_kendaraan()">
	<div class="alat">
		<input name="br_kendaraan_simpan" type="submit" value="Simpan" class="simpan" id="kiri">
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table  border="0" cellpadding="2" cellspacing="2">
		<tr><td style="width: 100px;"><label>ID kendaraan</label></td><td style="width: 10px;">:</td>
			<td style="width: 700px;"><input  maxlength="8" size="15" name="id_kendaraan" class="text" ></td></tr>
		<tr><td ><label>Kendaraan</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="kendaraan" class="text"></td></tr>
	</table>
	</form>
	</div>';
