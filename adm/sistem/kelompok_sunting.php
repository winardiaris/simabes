<?php
	$lokasi="Sunting Kelompok Pengguna";
	$sis = new sistem();
	$kel_id=$_GET['kel_id'];
	

	echo'
	<div class ="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi" method="post" enctype="multipart/form-data" name="tambah_pengguna">
	<div class="alat">
			<input name="perbaharui_kelompok" type="submit" value="Perbaharui" class="perbaharui" id="kiri" >
			<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
			<input name="lokasi" value="'.$lokasi.'" type="hidden" >
			<input name="kel_id" type="hidden"  value="'.$sis->sunting_kelompok('kel_id',$kel_id).'" >
	</div>
	<table cellpadding="5" cellspacing="0" border="0">
		<tr><td width="170px"><label>Nama Kelompok</label></td><td width="10px">:</td>
			<td><input name="nm_kel" type="text" class="text" maxlength="30" size="30" placeholder="Nama Kelompok" value="'.$sis->sunting_kelompok('nm_kel',$kel_id).'"></td></tr>
		<tr><td><label>Hak Istimewa</label></td><td>:</td>
			<td>
				<table class="table" cellpadding="5" cellspacing="0" border="0">
					<tr><th width="10px">ID</td><th width>Nama Menu</td><th width="10px">Ijin</td></tr>';
				
					$tampil = $sis->tampil_menu();
					foreach($tampil as $data){
						$kolom= ($data['id_menu']%2 == 1)? "kolom-ganjil" : "kolom-genap";
					echo'
					<tr class="'.$kolom.'">
						<td align=right">'.$data['id_menu'].'.</td>
						<td>'.$data['nm_menu'].'</td>
						<td align="center"><input name="menu[]" id="menu[]" value="'.$data['id_menu'].'" type="checkbox"';
							$tampil2 = $sis->tampil_akses_pengguna($kel_id);
							foreach($tampil2 as $data2){
								if($data2['id_menu'] == $data['id_menu']){echo'checked';}
							}
						echo'></td>
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
