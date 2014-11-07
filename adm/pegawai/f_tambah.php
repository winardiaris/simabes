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
<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="POST" enctype="multipart/form-data"  name="form1" onsubmit="return validasi();">
<div class="alat">
	<input name="simpan_pegawai" type="submit" value="Simpan" id="kiri" class="simpan">
	<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan"  onClick="javascript:history.back()">
	<input name="lokasi" type="hidden"  value="'.$lokasi.'">	
</div>
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
	<td ><label>Tempat Lahir *</label></td><td>:</td> 
	<td><input  type="text"  maxlength="50" size="50" name="tmpt_lahir" class="text" placeholder="Tempat Lahir"></td>
    </tr><tr>
	<td><label>Tanggal Lahir *</label></td><td>:</td>
	<td><input type="text" maxlength="20" size="20" name="tgl_lahir" id="tgl_lahir" class="text"/></td>
    </tr><tr>
	<td valign="top"><label>Alamat Pegawai *</label></td><td valign="top">:</td>
	<td valign="top"><textarea  cols="50" rows="5" name="almt_peg" placeholder="Isikan alamat"></textarea></td>
    </tr><tr>
	<td><label>Telepon/ponsel *</label></td><td>:</td>
	<td><input  type="text" maxlength="13" size="50" name="telp_peg" id="telp" class="text" placeholder="Nomor telepon"></td>
    </tr><tr>
	<td><label>Pendidikan terakhir *</label></td><td>:</td>
	<td><input  type="text" maxlength="50" size="50" name="pend_peg" class="text" placeholder="isikan pendidikan terakhir"></td>
    </tr><tr>
	<td><label>Tanggal Bergabung *</label></td><td>:</td>
	<td><input type="text" maxlength="20" size="20" name="tgl_bergabung" id="tgl_bergabung" class="text"/></td>
    </tr><tr>
	<td valign="top"><label>Pengalaman Kerja *</label></td><td valign="top">:</td>
	<td valign="top"><textarea  cols="50" rows="5" name="pengalaman_peg" placeholder="Isikan alamat"></textarea></td>
    </tr><tr>
	<td ><label>Kelompok Pengguna </label></td><td>:</td>
	<td><select  name="kel_id" class="select">
		<option value="0">-- Pilih --</option>';
	
		foreach($ambil_pengguna as $data){
		echo "<option value=\"".$data['kel_id']."\">".$data['nm_kel']."</option>";
		}
		echo'
		</select>
	</td>
    </tr><tr>
	<td><label>Photo </label></td><td>:</td>
	<td><input type="file" name="photo_peg" > <i>max size : 512KB</i></td> </tr>
</table>
</form></div>';

?>
