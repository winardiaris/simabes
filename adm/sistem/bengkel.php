<?php
	$lokasi="Pengaturan Bengkel";
	$sis = new sistem();
	echo'
<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="pengaturan" class="form1"  onsubmit="return confirm(\'Simpan pengaturan bengkel?\')">
	<div class="alat">
			<input name="simpan_bengkel" type="submit" value="Simpan Pengaturan" class="simpan" id="sendiri">
			<input type="hidden" name="lokasi" valur="'.$lokasi.'">
	</div>
	<table   cellpadding ="5" cellspacing="0" border="0">
		<tbody>
		<tr><td style="width: 170px;"><label>Versi Aplikasi</label></td><td style="width: 10px;">:</td>
			<td style="width: auto;"><input readonly="readonly" size="15" name="versi_aplikasi" class="text" value="'.$sis->tampil_bengkel('versi_aplikasi','1').'"></td></tr>
		<tr><td><label>Nama Bengkel *</label></td><td>:</td>
			<td><input maxlength="30" size="30" name="nm_bengkel" class="text" value="'.$sis->tampil_bengkel('nm_bengkel','1').'"></td></tr>
		<tr><td><label>No Telepon *</label></td><td>:</td>
			<td><input maxlength="30" size="30" name="telp1" class="text" value="'.$sis->tampil_bengkel('telp1','1').'"></td></tr>
		<tr><td><label>Seluler *</label></td><td>:</td>
			<td><input maxlength="30" size="30" name="telp2" class="text" value="'.$sis->tampil_bengkel('telp2','1').'"></td></tr>
		<tr><td valign="top"><label>Alamat *</label></td><td valign="top">:</td>
			<td valign="top"><textarea cols="50" rows="5" name="almt_bengkel">'.$sis->tampil_bengkel('almt_bengkel','1').'</textarea></td></tr>
		<tr><td><label>Logo Bengkel</label></td><td>:</td>
			<td><img src="'. $sis->tampil_bengkel('logo_bengkel','1').'" alt="'. $sis->tampil_bengkel('nm_bengkel','1').'" width="100" border="0"/><br>
			<input type="file" name="logo_bengkel" ></td></tr>
		</tbody>
	</table>  

</form></div>';
