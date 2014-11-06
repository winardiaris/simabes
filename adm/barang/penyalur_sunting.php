<?php
	$lokasi="Sunting Data Penyalur";
	$brg = new barang();
	$id_sup=$_GET['id_sup'];
	echo '
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_penyalur()" >
	<div class="alat">
		<input name="br_supplier_perbaharui" type="submit" value="Perbaharui" class="perbaharui" id="kiri" >
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input type="hidden" name="id_sup" value="'.$id_sup.'">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table  border="0" cellpadding="2" cellspacing="2">
		<tr><td ><label>Nama Penyalur*</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="nm_sup" class="text" value="'.$brg->sunting_penyalur('nm_sup',$id_sup) .'"></td></tr>
		<tr><td valign="top"><label>Alamat Penyalur*</label></td><td valign="top">:</td>
			<td><textarea  cols="50" rows="5" name="almt_sup">'.$brg->sunting_penyalur('almt_sup',$id_sup) .'</textarea></td></tr>
		<tr><td><label>Telp/Ponsel*</label></td><td>:</td>
			<td><input  maxlength="13" size="20" name="telp_sup" class="text" value="'.$brg->sunting_penyalur('telp_sup',$id_sup) .'"></td></tr>
	</table>
	</form>	
	</div>';
?>
