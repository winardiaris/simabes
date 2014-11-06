<?php
	$lokasi="Sunting Kategori Barang";
	$brg = new barang();
	$id_kt_brg = $_GET['id_kt_brg'];
	echo'
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_kategori()">
	<div class="alat">
		<input name="br_kategori_perbaharui" type="submit" value="Perbaharui" class="perbaharui" id="kiri">
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table  border="0" cellpadding="2" cellspacing="2">
		<tr><td style="width: 100px;"><label>ID Kategori</label></td><td style="width: 10px;">:</td>
			<td style="width: 700px;"><input  maxlength="2" size="15" name="id_kt_brg" class="text" value="'.$id_kt_brg.'" readonly=""></td></tr>
		<tr><td ><label>Nama Kategori</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="nm_kt_brg" class="text" value="'.$brg->sunting_kategori('nm_kt_brg',$id_kt_brg).'"></td></tr>
	</table>
	</form>
	</div>';
?>
