<?php 

$plg = new pelanggan();

$lokasi="Tambah Data Pelanggan";
$hari_ini		=date("Y-m-d");
$berlaku 		=date('Y-m-d', strtotime("+1 year"));
	

// ----- awal kode otomatis ----- //
$a=date("ym");
$qry = "SELECT max(id_plg) as maxID FROM dt_pelanggan WHERE id_plg LIKE '$a%' ORDER by id_plg ";

$hasil = mysql_query($qry);
$data = mysql_fetch_array($hasil);
$idMax = $data['maxID'];
$noUrut = (int) substr($idMax, 4, 4);
$noUrut++;

$newID = $a . sprintf("%04s", $noUrut);
// ----- akhir kode otomatis ----- //
echo'
<div class="konten">
	<div class="lokasi"><label name="lokasi">'.$lokasi.'</label></div>
<form action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" class="form1" onsubmit="return validasi()">
<div class="alat">
	<input name="lokasi" type="hidden" value="'.$lokasi.'">
	<input name="simpan" type="submit" value="Simpan" class="simpan" id="kiri" >
	<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
</div>
<table cellpadding="5" cellspacing="0" border="0" >
    <tr><td width="170px"><label>ID Pelanggan</label></td><td width= "10px">:</td><td width="auto"><input type="text"  maxlength="8" size="15" name="id_plg" class="text" value="'.$newID.'" readonly=""></td></tr>
    <tr><td ><label>Nama Pelanggan *</label></td><td>:</td><td><input  type="text"  maxlength="50" size="50" name="nm_plg" class="text" placeholder="Nama Pelanggan"></td></tr>
    <tr><td><label>Tanggal Registrasi </label></td><td>:</td><td><input type="text" maxlength="20" size="20" name="tgl_registrasi" id="tgl_registrasi" class="text" value="'.$hari_ini.'" /></td></tr>
    <tr><td><label>Masa Berlaku </label></td><td>:</td><td><input type="text" maxlength="20" size="20" name="masa_berlaku" id="masa_berlaku" class="text" value="'.$berlaku.'" /></td></tr>
    <tr><td valign="top"><label>Alamat Pelanggan *</label></td><td valign="top">:</td><td valign="top"><textarea  cols="50" rows="5" name="almt_plg" placeholder="Isikan alamat"></textarea></td></tr>
    <tr><td><label>Telepon/ponsel *</label></td><td>:</td><td><input  type="text" maxlength="13" size="50" name="telp_plg" id="telp" class="text" placeholder="Nomor telepon" ></td></tr>
    <tr><td><label>Jenis Kelamin </label></td><td>:</td><td><input name="jns_kelamin" type="radio" value="L" checked>Laki-laki	<input name="jns_kelamin" type="radio" value="P">Perempuan	</td></tr>
	<tr><td><label>Photo </label></td><td>:</td><td><input type="file" name="photo_plg" title="Ukuran berkas maksimal 512Kb"> <i>max size : 512KB</i></td> </tr>
	<tr><td><label>Kata Sandi </label></td><td>:</td><td><input type="password" maxlength="50" size="50" name="kt_sandi" class="text" placeholder="Default : simabes"></td></tr>
	<tr><td><label>Ulang Kata Sandi </label></td><td>:</td><td><input type="password" maxlength="50" size="50" name="ulang_kt_sandi" class="text" placeholder="Default : simabes"></td></tr>
</table>
</form></div>';
?>
