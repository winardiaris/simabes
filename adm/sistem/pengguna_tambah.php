<?php
	$lokasi="Tambah Pengguna Aplikasi";
	$sis = new sistem();
	
	echo'
	<div class ="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi" method="post" enctype="multipart/form-data" name="tambah_pengguna">
		<div class="alat">
		<input name="simpan_pengguna" type="submit" value="Simpan" class="simpan" id="kiri" >
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input name="lokasi" value="'.$lokasi.'" type="hidden" >
	</div>
	<table cellpadding="5" cellspacing="0" border="0">
		<tr><td width="170px"><label>Nama Pengguna</label></td><td width="10px">:</td>
			<td width="auto"><input name="nm_pengguna"type="text" class="text" maxlength="30" size="30" placeholder="Nama Pengguna"></td></tr>
		<tr><td><label>Nama Asli</label></td><td>:</td>
			<td><input name="nm_asli" type="text" class="text" maxlength="30" size="30" placeholder="Nama Asli Pengguna"></td></tr>
		<tr><td ><label>Kelompok Pengguna</label></td><td>:</td>
			<td><select  name="kel_id" class="select">';
			$tampil = $sis->tampil_kelompok();
				foreach($tampil as $data){
					echo '<option value="'.$data['kel_id'].'">'.$data['nm_kel'].'</option>';
				}
			echo'
			</td></tr>
		<tr><td><label>Kata Sandi</label></td><td>:</td>
			<td><input name="kt_sandi" type="password" class="text" maxlength="30" size="30" placeholder="Kata Sandi"></td></tr>
		<tr><td><label>Ulangi Kata Sandi</label></td><td>:</td>
			<td><input name="ulang_kt_sandi" type="password" class="text" maxlength="30" size="30" placeholder="Ulangi Kata Sandi"></td></tr>
    	<tr><td><label>Photo</label></td><td>:</td>	<td><input type="file" name="photo_pengguna" ></td></tr>
	</table>
	</form>
	</div>';
?>
