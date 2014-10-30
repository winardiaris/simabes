<?php 

$plg = new pelanggan();

$lokasi="Tambah Data Pelanggan";
$hari_ini		=date("Y-m-d");
$berlaku 		=date('Y-m-d', strtotime("+1 year"));
	

$a=date("ym");
// ----- awal kode otomatis ----- //
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
<form action="?mod='.$_GET['mod'].'&h='.$_GET['h'] .'"  method="post" enctype="multipart/form-data"  name="form1" class="form1" >
<div class="alat">
	<input name="lokasi" type="hidden" value="'.$lokasi.'">
	<input name="simpan" type="button" value="Simpan" class="simpan" id="kiri" onClick="validasi();">
	<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
</div>
<table cellpadding="5" cellspacing="0" border="0" >
    <tr><td width="170px"><label>ID Pelanggan</label></td><td width= "10px">:</td><td width="auto"><input type="text"  maxlength="8" size="15" name="id_plg" class="text" value="'.$newID.'" readonly=""></td></tr>
    <tr><td ><label>Nama Pelanggan *</label></td><td>:</td><td><input  type="text"  maxlength="50" size="50" name="nm_plg" class="text" placeholder="Nama Pelanggan"></td></tr>
    <tr><td><label>Tanggal Registrasi </label></td><td>:</td><td><input type="text" maxlength="20" size="20" name="tgl_registrasi" id="tgl_registrasi" class="text" value="'.$hari_ini.'" /></td></tr>
    <tr><td><label>Masa Berlaku </label></td><td>:</td><td><input type="text" maxlength="20" size="20" name="masa_berlaku" id="masa_berlaku" class="text" value="'.$berlaku.'" /></td></tr>
    <tr><td valign="top"><label>Alamat Pelanggan *</label></td><td valign="top">:</td><td valign="top"><textarea  cols="50" rows="5" name="almt_plg" placeholder="Isikan alamat"></textarea></td></tr>
    <tr><td><label>Nomor Telepon *</label></td><td>:</td><td><input  type="text" maxlength="13" size="50" name="telp_plg" class="text" placeholder="Nomor telepon"></td></tr>
    <tr><td><label>Jenis Kelamin </label></td><td>:</td><td><input name="jns_kelamin" type="radio" value="L" checked>Laki-laki	<input name="jns_kelamin" type="radio" value="P">Perempuan	</td></tr>
	<tr><td><label>Photo </label></td><td>:</td><td><input type="file" name="photo_plg" title="Ukuran berkas maksimal 512Kb"> <i>max size : 512KB</i></td> </tr>
	<tr><td><label>Kata Sandi </label></td><td>:</td><td><input type="password" maxlength="50" size="50" name="kt_sandi" class="text" placeholder="Default : simabes"></td></tr>
	<tr><td><label>Ulang Kata Sandi </label></td><td>:</td><td><input type="password" maxlength="50" size="50" name="ulang_kt_sandi" class="text" placeholder="Default : simabes"></td></tr>
</table>
</form></div>';





//simpan
if(isset($_POST['id_plg'])){
	$id_plg			=$_POST['id_plg'];
	$nm_plg			=$_POST['nm_plg'];
	$tgl_registrasi	=$_POST['tgl_registrasi'];
	$masa_berlaku	=$_POST['masa_berlaku'];
	$almt_plg		=$_POST['almt_plg'];
	$telp_plg		=$_POST['telp_plg'];
	$jns_kelamin	=$_POST['jns_kelamin'];
	$kt_sandi		=$_POST['kt_sandi'];
	$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
	$wkt_ubah		=date("Y-m-d H:i:s");
	$berlaku 		=date('Y-m-d', strtotime("+1 year"));


		if(!empty($_FILES["photo_plg"]["tmp_name"])){
		$namafolder="pelanggan/photo/";
		$jenis_gambar=$_FILES['photo_plg']['type'];
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_plg"]["size"] < 512000){
					$namafile = md5($nm_plg.$id_plg);
					$photo_plg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_plg"]["name"]));
					move_uploaded_file($_FILES["photo_plg"]["tmp_name"],$photo_plg);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
		}
		else{$photo_plg="pelanggan/photo/default.png";}
		
		if (empty($kt_sandi) && empty($ulang_kt_sandi)){$kt_sandi = "simabes";}

		
		//simpan
		$plg->simpan($id_plg,$nm_plg,$tgl_registrasi,$masa_berlaku,$almt_plg,$telp_plg,$jns_kelamin,$photo_plg,$wkt_ubah,$kt_sandi);
		//log
		$log_tipe = "Staff";
		$pengguna=$_SESSION['nama_asli'];
		$log_lokasi=$_POST['lokasi'];
		$log_pesan="A:1:Berhasil menambahkan pelanggan ID pelanggan ($id_plg)";
		$log_waktu = date("Y-m-d H:i:s");
		$plg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		
		echo "<script type='text/javascript'>window.location='?mod=pelanggan';</script>";
	
}
?>
