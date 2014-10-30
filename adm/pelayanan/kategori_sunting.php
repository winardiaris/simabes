<?php
	$lokasi		="Sunting Kategori Pelayanan";
	$ply		= new pelayanan();
	$id_kt_ply 	= $_GET['id_kt_ply'];
	
	echo'
	<div class="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="input-sup" >
		<div class="alat">
			<input name="ply_kat_perbaharui" type="submit" value="Perbaharui" class="perbaharui" id="kiri">
			<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		</div>
	<table cellpadding="5" cellspacing="0" border="0" >
		<tr><td style="width: 170px;"><label>Kategori Pelayanan</label></td><td style="width: 10px;">:</td><td style="width: auto;">
			<input  maxlength="30" size="40" name="nm_kat" class="text" value="'.$ply->sunting_kt_ply('nm_kt_ply',$id_kt_ply).'">
			<input name="id_kt_ply" value="'.$id_kt_ply.'" type="hidden">
			</td></tr>
		<tr><td ><label>Biaya Pelayanan</label></td><td>:</td>
			<td><input  maxlength="30" size="40" name="biaya" class="text" type="number" value="'.$ply->sunting_kt_ply('biaya',$id_kt_ply).'"></td>
			</tr>
	</tbody>
	</table>
	</form></div>';
?>
