<?php
	$lokasi="Sunting Kualitas Barang";
	$brg = new barang();
	$id_kualitas=$_GET['id_kualitas'];

	echo'
	<div class="konten">
	<div class="lokasi"><label>'. $lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_kualitas()">
	<div class="alat">
		<input name="br_kualitas_perbaharui" type="submit" value="Perbaharui" class="perbaharui" id="kiri">
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table  border="0" cellpadding="2" cellspacing="2">
		<tr><td style="width: 100px;"><label>ID Kualitas</label></td><td style="width: 10px;">:</td>
			<td style="width: 700px;"><input  maxlength="8" size="15" name="id_kualitas" class="text" value="'.$id_kualitas.'" readonly=""></td></tr>
		<tr><td ><label>Kualitas</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="kualitas" class="text" value="'.$brg->sunting_kualitas('kualitas',$id_kualitas).'"></td></tr>
	</table>
	</form>
	</div>';
?>





