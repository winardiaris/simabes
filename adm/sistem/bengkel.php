<?php
	$lokasi="Pengaturan Bengkel";
	$sis = new sistem();
	echo'
<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="pengaturan" class="form1"  onsubmit="return confirm(\'Simpan pengaturan bengkel?\')">
	<div class="alat">
			<input name="perbaharui_bengkel" type="submit" value="Simpan Pengaturan" class="simpan" id="sendiri">
			<input type="hidden" name="lokasi" valur="'.$lokasi.'">
	</div>
	<table   cellpadding ="5" cellspacing="0" border="0">
		<tbody>
		<tr><td><label>Nama Bengkel: *</label></td>
			<td colspan="3"><input maxlength="100" size="100" name="nm_bengkel" class="text" value="'.$sis->tampil_bengkel('nm_bengkel','1').'"></td></tr>
		<tr><td><label>No Telepon: *</label></td>
			<td><input maxlength="30" size="30" name="telp1" class="text" value="'.$sis->tampil_bengkel('telp1','1').'">
			<label>Seluler: *</label><input maxlength="30" size="30" name="telp2" class="text" value="'.$sis->tampil_bengkel('telp2','1').'"></td>
			</tr>
		<tr><td valign="top"><label>Alamat: *</label></td>
			<td valign="top" ><textarea cols="50" rows="5" name="almt_bengkel">'.$sis->tampil_bengkel('almt_bengkel','1').'</textarea></td>
			<td valign="top"><label>Logo Bengkel:</label></td>
			<td ><img src="'. $sis->tampil_bengkel('logo_bengkel','1').'" alt="'. $sis->tampil_bengkel('nm_bengkel','1').'" width="100" border="0"/>
			<br><input type="file" name="logo_bengkel" ></td>
			</tr>
		<tr><td valign="top"><label>Tentang Bengkel: </label>
			<td valign="top" colspan="3"><textarea cols="110" rows="12" name="tntg_bengkel">'.$sis->tampil_bengkel('tentang_bengkel','1').'</textarea></td></tr>
		</tbody>
	</table>  

</form></div>';
