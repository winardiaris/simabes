    <script>
    $(function() {
        $( "#tgl_bergabung" ).datepicker({ 
			dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
		});
		$( "#tgl_lahir" ).datepicker({ 
			dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
		});
    });
    </script>
<?php 
$pg = new pegawai();
$ambil_pengguna = $pg->ambil_pengguna();


$lokasi="Tambah Data Pegawai";
$a=date("ym");
$b="PG";

// ----- awal kode otomatis ----- //
$qry 	= "SELECT max(id_peg) as maxID FROM dt_pegawai WHERE id_peg LIKE '%".date("y")."%' ORDER by id_peg ";
$hasil 	= mysql_query($qry);
$data 	= mysql_fetch_array($hasil);
$idMax 	= $data['maxID'];
$noUrut = (int) substr($idMax, 8, 3);
$noUrut++;
$newID = $b ."-". $a ."-". sprintf("%03s", $noUrut);
// ----- akhir kode otomatis ----- //

echo '
<div class="konten">
	<div class="lokasi"><label name="lokasi">'.$lokasi.'</label></div>
<form class="form1" action="?mod='.$_GET['mod'].'&h='.$_GET['h'] .'"  method="POST" enctype="multipart/form-data"  name="input" >
<table cellpadding="5" cellspacing="0" border="0">
    <tr>
	<td width="170px"><label>ID Pegawai</label></td><td width= "10px">:</td>
	<td width="auto"><input type="text"  maxlength="8" size="15" name="id_peg" class="text" value="'.$newID .'" ></td>
    </tr><tr>
	<td ><label>Nama Pegawai *</label></td><td>:</td> 
	<td><input  type="text"  maxlength="50" size="50" name="nm_peg" class="text" placeholder="Nama Pegawai"></td>
    </tr><tr>
	<td><label>Jenis Kelamin </label></td><td>:</td>
	<td>
		<input name="jns_kelamin" type="radio" value="L" checked>Laki-laki <input name="jns_kelamin" type="radio" value="P">Perempuan
	</td>
	</tr><tr></tr>
	<td ><label>Tempat Lahir </label></td><td>:</td> 
	<td><input  type="text"  maxlength="50" size="50" name="tmpt_lahir" class="text" placeholder="Tempat Lahir"></td>
    </tr><tr>
	<td><label>Tanggal Lahir *</label></td><td>:</td>
	<td><input type="text" maxlength="20" size="20" name="tgl_lahir" id="tgl_lahir" class="text"/></td>
    </tr><tr>
	<td valign="top"><label>Alamat Pegawai *</label></td><td valign="top">:</td>
	<td valign="top"><textarea  cols="50" rows="5" name="almt_peg" placeholder="Isikan alamat"></textarea></td>
    </tr><tr>
	<td><label>Nomor Telepon *</label></td><td>:</td>
	<td><input  type="text" maxlength="13" size="50" name="telp_peg" class="text" placeholder="Nomor telepon"></td>
    </tr><tr>
	<td><label>Pendidikan terakhir </label></td><td>:</td>
	<td><input  type="text" maxlength="50" size="50" name="pend_peg" class="text" placeholder="isikan pendidikan terakhir"></td>
    </tr><tr>
	<td><label>Tanggal Bergabung </label></td><td>:</td>
	<td><input type="text" maxlength="20" size="20" name="tgl_bergabung" id="tgl_bergabung" class="text"/></td>
    </tr><tr>
	<td valign="top"><label>Pengalaman Kerja</label></td><td valign="top">:</td>
	<td valign="top"><textarea  cols="50" rows="5" name="pengalaman_peg" placeholder="Isikan alamat"></textarea></td>
    </tr><tr>
	<td ><label>Kelompok Pengguna </label></td><td>:</td>
	<td><select  name="kel_id" class="select">';
		foreach($ambil_pengguna as $data){
				echo "<option value=\"".$data['kel_id']."\">".$data['nm_kel']."</option>";
			}
		echo'
		</select>
	</td>
    </tr><tr>
	<td><label>Photo </label></td><td>:</td>
	<td><input type="file" name="photo_peg" > <i>max size : 512KB</i></td> 
	</tr>
</table>
<div class="alat">
	<input name="simpan_pegawai" type="submit" value="Simpan" id="kiri" class="simpan">
	<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan"  onClick="javascript:history.back()">
	<input name="lokasi" type="hidden"  value="'.$lokasi.'">	
</div>
</form></div>';





//simpan
if(isset($_POST['simpan_pegawai'])){
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
	$hari_ini 		= date("Y-m-d");
	$wkt_ubah 		= date("Y-m-d H:i:s");
	
	if(empty($id_peg)){
		echo "<script type='text/javascript'> alert('Isikan ID pegawai');history.back();</script>";
	}
	elseif(empty($nm_peg)){
		echo "<script type='text/javascript'> alert('Isikan Nama pegawai');history.back();</script>";
	}
	elseif(empty($tgl_lahir)){
		echo "<script type='text/javascript'> alert('Isikan Tanggal lahir pegawai');history.back();</script>";
	}
	elseif(empty($almt_peg)){
		echo "<script type='text/javascript'> alert('Isikan Alamat pegawai');history.back();</script>";
	}
	elseif (empty($telp_peg)){
		echo "<script type='text/javascript'> alert('Isikan No Telepon/HP pegawai');history.back();</script>";
	}
	else{
	if(!empty($_FILES["photo_peg"]["tmp_name"])){
		$namafolder="pegawai/photo/";
		$jenis_gambar=$_FILES['photo_peg']['type'];
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_peg"]["size"] < 512000){
					$namafile = md5($nm_peg.$id_peg);
					$photo_peg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_peg"]["name"]));
					move_uploaded_file($_FILES["photo_peg"]["tmp_name"],$photo_peg);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
	}
	else{$photo_peg="pegawai/photo/default.png";}
	//simpan
	$pg->simpan($id_peg,$nm_peg,$jns_kelamin,$tmpt_lahir,$tgl_lahir,$almt_peg,$telp_peg,$pend_peg,$tgl_bergabung,$photo_peg,$pengalaman_peg,$kel_id,$wkt_ubah);
	//log
	$log_tipe = "Staff";
	$pengguna=$_SESSION['nama_asli'];
	$log_lokasi=$_POST['lokasi'];
	$log_pesan="A:1:Berhasil menambahkan pegawai ID pegawai ($id_peg)";
	$log_waktu = date("Y-m-d H:i:s");
	$pg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pegawai';</script>";
	}
}
?>
