<script>$(function() {$( "#tgl_bergabung" ).datepicker({ dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});$( "#tgl_lahir" ).datepicker({ dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});});</script>
<?php
$pg = new pegawai();
$id_peg	=$_GET['id_peg'];
$lokasi	="Sunting Data Pegawai";
	
	//log
	$log_tipe = "Staff";
	$pengguna=$_SESSION['nama_asli'];
	$log_lokasi=$lokasi;
	$log_pesan="A:4:Menyunting data pegawai, ID pegawai ($id_peg)";
	$log_waktu = date("Y-m-d H:i:s");
	$pg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		
echo'
<div class="konten">
	<div class="lokasi"><label name="lokasi">'.$lokasi.'</label></div>
<form class="form1" action="?mod=pegawai&h=sunting"  method="post" enctype="multipart/form-data"  name="input-plg" >
<table cellpadding="5" cellspacing="0" border="0" >
    <tr>
	<td width="170px"><label>ID Pegawai</label></td>
	<td width= "10px">:</td>
	<td width="auto"><input type="text"  maxlength="8" size="15" name="id_peg" class="text" value="'.$id_peg .'" readonly="" ></td>
	<td rowspan="14" valign="top" align="center"><img class="photo" src="'. $pg->sunting('photo_peg',$id_peg).'" title="'. $pg->sunting('nm_peg',$id_peg).'" width="100" border="1"/></td>
    </tr><tr>
	<td ><label>Nama Pegawai *</label></td><td>:</td> 
	<td><input  type="text"  maxlength="50" size="50" name="nm_peg" class="text" value="'.$pg->sunting('nm_peg',$id_peg).'"></td>
    </tr><tr>
	<td><label>Jenis Kelamin </label></td><td>:</td>
	<td>
		<input name="jns_kelamin" type="radio" value="L"';if($pg->sunting('jns_kelamin',$id_peg) =='L') echo "checked"; echo'>Laki-laki
		<input name="jns_kelamin" type="radio" value="P"';if($pg->sunting('jns_kelamin',$id_peg) =='P') echo "checked"; echo'>Perempuan
	</td>
	</tr><tr>
	<td ><label>Tempat Lahir </label></td><td>:</td> 
	<td><input  type="text"  maxlength="50" size="50" name="tmpt_lahir" class="text" value="'.$pg->sunting('tmpt_lahir',$id_peg).'"></td>
    </tr><tr>
	<td><label>Tanggal Lahir</label></td><td>:</td>
	<td><input type="text" maxlength="20" size="20" name="tgl_lahir" id="tgl_lahir" class="text" value="'.$pg->sunting('tgl_lahir',$id_peg).'"/></td>
    </tr><tr>
	<td valign="top"><label>Alamat Pegawai *</label></td><td valign="top">:</td>
	<td valign="top"><textarea  cols="50" rows="5" name="almt_peg" >'.$pg->sunting('almt_peg',$id_peg).'</textarea></td>
    </tr><tr>
	<td><label>Nomor Telepon *</label></td><td>:</td>
	<td><input  type="text" maxlength="50" size="50" name="telp_peg" class="text" value="'.$pg->sunting('telp_peg',$id_peg).'"></td>
    </tr><tr>
	<td><label>Pendidikan terakhir </label></td><td>:</td>
	<td><input  type="text" maxlength="50" size="50" name="pend_peg" class="text" value="'.$pg->sunting('pend_peg',$id_peg).'"></td>
    </tr><tr>
	<td><label>Tanggal Bergabung </label></td><td>:</td>
	<td><input type="text" maxlength="20" size="20" name="tgl_bergabung" id="tgl_bergabung" class="text" value="'.$pg->sunting('tgl_bergabung',$id_peg).'"/></td>
   	</tr><tr>
	<td valign="top"><label>Pengalaman Kerja</label></td><td valign="top">:</td>
	<td valign="top"><textarea  cols="50" rows="5" name="pengalaman_peg" >'.$pg->sunting('pengalaman_peg',$id_peg).'</textarea></td>
    </tr><tr>
	<td ><label>Kelompok Pengguna </label></td><td>:</td>
	<td><select  name="kel_id" class="select">';
		$ambil_pengguna = $pg->ambil_pengguna();
		$kel_id = $pg->sunting('kel_id',$id_peg);
		foreach($ambil_pengguna as $data){
			echo "<option value=\"".$data['kel_id']."\"";
			if($kel_id == $data['kel_id']){echo ' selected';}
			echo">".$data['nm_kel']."</option>";
		}
		echo'
		</select>
	</td>
    </tr><tr>
	<td><label>Photo </label></td><td>:</td>
	<td><input type="file" name="photo_peg" ></td> 
	</tr>
</table>
<div class="alat">
	<input name="pegawai_perbaharui" type="submit" value="Perbaharui" class="perbaharui" id="kiri">
	<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
	<input name="lokasi" type="hidden"  value="'.$lokasi.'"></div>
</form>
</div>';








// perbaharui
if(isset($_POST['pegawai_perbaharui'])){
	$id_peg			=$_POST['id_peg'];
	$nm_peg			=$_POST['nm_peg'];
	$jns_kelamin	=$_POST['jns_kelamin'];
	$tmpt_lahir		=$_POST['tmpt_lahir'];
	$tgl_lahir		=$_POST['tgl_lahir'];
	$almt_peg		=$_POST['almt_peg'];
	$telp_peg		=$_POST['telp_peg'];
	$pend_peg		=$_POST['pend_peg'];
	$tgl_bergabung	=$_POST['tgl_bergabung'];
	$pengalaman_peg	=$_POST['pengalaman_peg'];
	$kel_id			=$_POST['kel_id'];
	$wkt_ubah 		= date("Y-m-d H:i:s");
	


	if(!empty($_FILES["photo_peg"]["tmp_name"])){
		$namafolder="pegawai/photo/";
		$jenis_gambar=$_FILES['photo_peg']['type'];
		
		$photo = $pg->sunting('photo_peg',$id_peg);
			//hapus photo lama
			if($photo!="pegawai/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}}
			 
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_peg"]["size"] < 512000){
					$namafile = md5($nm_peg.$id_peg);
					$photo_peg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_peg"]["name"]));
					move_uploaded_file($_FILES["photo_peg"]["tmp_name"],$photo_peg);
					
					//perbaharui photo
					$pg->perbaharuiphoto($id_peg,$photo_peg);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
	}
	//perbaharui data
	$pg->perbaharui($id_peg,$nm_peg,$jns_kelamin,$tmpt_lahir,$tgl_lahir,$almt_peg,$telp_peg,$pend_peg,$tgl_bergabung,$pengalaman_peg,$kel_id,$wkt_ubah);
	
	//log
	$log_tipe = "Staff";
	$pengguna=$_SESSION['nama_asli'];
	$log_lokasi=$_POST['lokasi'];
	$log_pesan="A:3:Memperbaharui pegawai ($id_peg)";
	$log_waktu = date("Y-m-d H:i:s");
	$pg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	
	echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=pegawai';</script>";
}
?>
