<?php
$lokasi="Sunting Data Pelanggan";
$id_plg=$_GET['id_plg'];
$plg = new pelanggan();
//log
	$log_tipe = "Staff";
	$pengguna=$_SESSION['nama_asli'];
	$log_lokasi=$lokasi;
	$log_pesan="A:4:Menyunting data pelanggan, ID pelanggan ($id_plg)";
	$log_waktu = date("Y-m-d H:i:s");
	$plg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);

echo'

<div class="konten">
	<div class="lokasi"><label name="lokasi">'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi()">
	<div class="alat">
	<td colspan="3" rowspan="1"><input name="perbaharui" type="submit" value="Perbaharui" class="perbaharui" id="kiri">
	<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
	<input name="lokasi" type="hidden" value="'. $lokasi.'"></td>
</div>
<table  border="0" cellpadding="2" cellspacing="0">
  	<tr><td width="170px"><label>ID Pelanggan *</label></td><td width="10px" >:</td>
		<td style="width: 700px;"><input  maxlength="8" size="15" name="id_plg" class="text" value="'.$plg->sunting('id_plg',$id_plg) .'" readonly=""></td>
		<td width="163" rowspan="10" align="center" valign="top">
			<img class="photo" src="'.$plg->sunting('photo_plg',$id_plg).'" alt="'.$plg->sunting('nm_plg',$id_plg).'" width="100" border="1"/><br/>
		</td></tr>
    <tr><td ><label>Nama Pelanggan *</label></td><td>:</td>
		<td><input  maxlength="35" size="40" name="nm_plg" class="text" value="'.$plg->sunting('nm_plg',$id_plg).'"></td></tr>
    <tr><td><label>Tanggal Registrasi</label></td><td>:</td>
		<td><input type="text" maxlength="20" size="20" name="tgl_registrasi" id="tgl_registrasi" class="text" value="'.  $plg->sunting('tgl_registrasi',$id_plg).'"></td></tr>
   	<tr><td><label>Masa Berlaku</label></td><td>:</td>
		<td><input type="text" maxlength="20" size="20" name="masa_berlaku" id="masa_berlaku" class="text" value="'.  $plg->sunting('masa_berlaku',$id_plg).'"/></td></tr>
   	<tr><td valign="top"><label>Alamat Pelanggan *</label></td><td valign="top">:</td>
		<td valign="top"><textarea  cols="50" rows="5" name="almt_plg">'. $plg->sunting('almt_plg',$id_plg) .'</textarea></td></tr>
   	<tr><td><label>Telepon/ponsel *</label></td><td>:</td>
		<td><input  maxlength="13" size="20" name="telp_plg" id="telp" class="text" value="'. $plg->sunting('telp_plg',$id_plg).'"></td></tr>
   	<tr><td><label>Jenis Kelamin</label></td><td>:</td>
		<td><input name="jns_kelamin" type="radio" value="L" '; if($plg->sunting('jns_kelamin',$id_plg) =='L') echo "checked"; echo'>Laki-laki
			<input name="jns_kelamin" type="radio" value="P" '; if($plg->sunting('jns_kelamin',$id_plg) =='P') echo "checked"; echo'>Perempuan</td></tr>
	<tr><td><label>Photo</label></td><td>:</td>
		<td><input type="file" name="photo_plg"><br/><p>Pilih Photo Jika Ingin Diganti</p></td></tr>
	<tr><td><label>Kata Sandi</label></td><td>:</td>
		<td><input type="password" maxlength="50" size="50" name="kt_sandi" class="text"></td></tr>
	<tr><td><label>Ulang Kata Sandi</label></td><td>:</td>
		<td><input type="password" maxlength="50" size="50" name="ulang_kt_sandi" class="text"></td></tr>
</table></form></div></body></html>';
?>
