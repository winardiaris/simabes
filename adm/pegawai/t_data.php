<?php
$pg = new pegawai();
$tampil = $pg->tampil();

$lokasi = "Data Pegawai";
$jml_peg = count($tampil);
$banyak = $jml_peg;

echo'
<div class="konten">
	<div class="lokasi">
		<label name="lokasi">'.$lokasi.'</label>
		<div class="kanan2">
			<form class="form1" action="" method="get" name="fpencarian" id="fpencarian">
			<label>Terdapat <font>'.$jml_peg.' </font> '. $lokasi .' </label>
			<input name="mod" value="pegawai" type="hidden" >
			<input name="h" value="data" type="hidden" >
			<input value="'; if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text"  placeholder="Pencarian pegawai" title="Pencarian dengan ID / Nama pegawai"> 
			</form>
		</div>
	</div>
<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan dihapus\');">
	<div class="alat">
		<input name="pegawai_hapus_terpilih" value="Hapus Data Terpilih" class="hapus" id="sendiri"  type="submit" >
	</div>
	
<table cellpadding="5" cellspacing="0" class="table">
<tr id="th">
	<th align="right" width="10px">No.</th>
	<th align="center" width="10px" ><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.$banyak.')"></th>
	<th align="center" width="10px" >Sunting</th>
	<th align="center" width="80px">ID pegawai</th>
	<th align="center" width="150px">Nama Pegawai</th>
	<th align="center">Alamat</th>
	<th align="center" width="20px">L/P</th>
	<th align="center" width="100px">Nomor Telepon</td>
	<th align="center" width="100px">Jabatan</td>
	<th align="center" width="120px" >Terakhir diubah</th>
</tr>';
if(count($tampil)>0){
	$i = 1;
	foreach($tampil as $data){
	$kolom= ($i%2 == 1)? "kolom-ganjil" : "kolom-genap";
	$a = '?mod=pegawai&h=sunting&id_peg='.$data['id_peg'];
	echo'
	<tr class="'.$kolom.'" >
		<td align="right">'.$i.'.</td>
		<td align="center" ><input name="item[]" id="item'.$i.'" value="'.$data['id_peg'].'" type="checkbox"></td>
		<td align="center" ><a href="'.$a.'" title="Merubah data pegawai"><img src="../img/sunting.png" height="20px" width="20px"></a></td>	
		<td align="center">'.$data['id_peg'].'</td>
		<td>'.$data['nm_peg'].'</td>
		<td>'.$data['almt_peg'].'</td>
		<td align="center">'.$data['jns_kelamin'].'</td>
		<td align="left">'.$data['telp_peg'].'</td>
		<td align="left">'.$data['nm_kel'].'</td>
		<td align="center" >'.$data['wkt_ubah'].'</td>
	</tr>';
	$i++;
	}
}
elseif(count($tampil)==0  && !empty($_GET['cari'])){
	echo "<script type='text/javascript'> toastr.warning('Pencarian [".$_GET['cari']."] tidak ditemukan ! <button class=\'perbaharui\' onclick=\' history.back()\'>OK</button>', 'SIMaBeS');</script>";
	echo "<tr><td colspan='8'>-- Pencarian [".$_GET['cari']."] tidak ditemukan --</td></tr>";
}
else{
	echo "<script type='text/javascript'>toastr.warning('".$lokasi." kosong!', 'SIMaBeS');</script>";
	echo "<tr><td colspan='8'>-- Data Kosong --</td></tr>";
}
echo'
</table>
</form>
</div>';

?>
