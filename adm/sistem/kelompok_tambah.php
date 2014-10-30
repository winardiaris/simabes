<?php
	$lokasi="Tambah Kelompok Pengguna";
	$sis = new sistem();
	
	echo'
	<div class ="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi" method="post" enctype="multipart/form-data" name="tambah_pengguna">
	<div class="alat">
		<input name="simpan_kelompok" type="submit" value="Simpan" class="simpan" id="kiri" >
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input name="lokasi" value="'.$lokasi.'" type="hidden" >
	</div>
	<table cellpadding="5" cellspacing="0" border="0">
		<tr><td width="170px"><label>Nama Kelompok*</label></td><td width="10px">:</td>
			<td><input name="nm_kel" type="text" class="text" maxlength="30" size="30" placeholder="Nama Kelompok"></td></tr>
		<tr><td valign="top"><label>Hak Istimewa</label></td><td valign="top">:</td>
			<td valign="top">
				<table cellpadding="5" cellspacing="0" border="0" class="table">
					<tr><th width="10px">ID</th><th width>Nama menu</th><th width="10px">Ijin</th></tr>';				
					$tampil = $sis->tampil_menu();
					foreach($tampil as $data){
						$kolom= ($data['id_menu']%2 == 1)? "kolom-ganjil" : "kolom-genap";
					echo'
					<tr class="'.$kolom.'">
						<td align=right">'.$data['id_menu'].'.</td>
						<td>'.$data['nm_menu'].'</td>
						<td align="center"><input name="menu[]" id="menu[]" value="'.$data['id_menu'].'" type="checkbox"></td>
					</tr>';
					}
					echo'
				</table>
			</td>
		</tr>
	</table>
	</form>
	</div>';
?>
