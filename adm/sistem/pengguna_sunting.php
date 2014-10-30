<?php
	$lokasi="Sunting Pengguna Aplikasi";
	$sis = new sistem();
	$id_pengguna = $_GET['id_pengguna'];
	
	
	echo'
	<div class ="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi" method="post" enctype="multipart/form-data" name="sunting_pengguna">
	<div class="alat">
			<input name="perbaharui_pengguna" type="submit" value="Perbaharui" class="perbaharui" id="kiri" >
			<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
			<input name="lokasi" value="'.$lokasi.'" type="hidden" >
		</div>
	<table cellpadding="5" cellspacing="0" border="0">
		<tr>
			<td><label>ID Pengguna</label></td>
			<td>:</td>
			<td><input type="text" class="text" id="id_pengguna" name="id_pengguna" maxlength="30" size="30" value="'.$sis->sunting_pengguna('id_pengguna',$id_pengguna).'" readonly=""></td>
			<td width="163" rowspan="8" align="center" valign="top">
				<img class="photo" src="'. $sis->sunting_pengguna('photo_pengguna',$id_pengguna).'" alt="'. $sis->sunting_pengguna('nm_pengguna',$id_pengguna).'" width="100" border="1"/><br/>
			</td>
		</tr>
		<tr>
			<td width="170px"><label>Nama Pengguna</label></td>
			<td width="10px">:</td>
			<td width="auto"><input name="nm_pengguna"type="password" readonly="" class="text" maxlength="30" size="30" placeholder="Nama Pengguna" value="'.$sis->sunting_pengguna('nm_pengguna',$id_pengguna) .'"></td>
		</tr>
		<tr>
			<td><label>Nama Asli</label></td>
			<td>:</td>
			<td><input name="nm_asli" type="text" class="text" maxlength="30" size="30" placeholder="Nama Asli Pengguna" value="'.$sis->sunting_pengguna('nm_asli',$id_pengguna).'"></td>
		</tr>
		<tr>
			<td ><label>Kelompok Pengguna</label></td>
			<td>:</td>
			<td><select  name="kel_id" class="select">';
			$tampil = $sis->tampil_kelompok();
			$kel_id = $sis->sunting_pengguna('kel_id',$id_pengguna);
				foreach($tampil as $data){
					echo '<option value="'.$data['kel_id'].'" ';
					if( $kel_id == $data['kel_id']){ echo ' selected';}
					echo'>'.$data['nm_kel'].'</option>';
				}
			echo'
			</td>
    	</tr>
		<tr>
			<td><label>Kata Sandi</label></td>
			<td>:</td>
			<td><input name="kt_sandi" type="password" class="text" maxlength="30" size="30" placeholder="Kata Sandi"></td>
		</tr>
		<tr>
			<td><label>Ulangi Kata Sandi</label></td>
			<td>:</td>
			<td><input name="ulang_kt_sandi" type="password" class="text" maxlength="30" size="30" placeholder="Ulangi Kata Sandi"></td>
		</tr>
		<tr>
			<td><label>Photo</label></td>
			<td>:</td>
			<td>
			<input type="file" name="photo_pengguna" >
			</td> 
		</tr>
	</table>
	</form>
	</div>';
?>
