<?php
	$lokasi="Tambah Rak";
	echo'
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_rak()">
		<div class="alat">
			<input name="br_rak_simpan" type="submit" value="Simpan" class="simpan" id="kiri" >
			<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="history.back();">
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
		</div>
	<table cellpadding="5" cellspacing="0" border="0" >
		<tr><td style="width: 170px;"><label>Nama Rak</label></td><td style="width: 10px;">:</td>
			<td style="width: auto;"><input  maxlength="30" size="40" name="nm_rak" class="text" placeholder="Isikan nama rak"></td></tr>
		<tr><td ><label>Keterangan</label></td><td>:</td>
			<td><textarea  cols="50" rows="5" name="ket" placeholder="Isikan keterangan untuk barang"></textarea></td></tr>
	</table>
	</form>
	</div>';
?>
