<?php
$pg = new pegawai();
$tampil = $pg->tampil();

$lokasi = "Kartu Pegawai";
$banyak = count($tampil);
	
	//jumlah sementara untuk cetak kartu pegawai
	$sql = mysql_query("SELECT * FROM `sementara` WHERE id_sementara like '%kartu%' ") or die (mysql_error());
	$jml = mysql_num_rows($sql);


echo'
<div class="konten">'.$iframe.'
	<div class="lokasi">
		<label name="lokasi">'.$lokasi.'</label>
		<div class="kanan2">
			<form class="form1" action="" method="get" name="fpencarian" id="fpencarian">
			<label>Terdapat <font>'.$jml.'</font> dalam antrian menunggu untuk dicetak </label>
			<input name="mod" value="pegawai" type="hidden" >
			<input name="h" value="kartu" type="hidden" >
			<input value="'; if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text"  placeholder="Pencarian pegawai" title="Pencarian dengan ID / Nama pegawai"> 
			</form>
		</div>
	</div>
<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data untuk ditambahkan dalam antrian\');">
	<div class="alat">
		<input name="kartu_antri" value="Tambahkan dalam antrian" class="tambah" id="kiri" type="submit">
		<a href="kartu.php" target="framepopup"  onClick=" return cek_data('.$jml.',\'Jumlah antrian kosong\');"><button type="button" class="cetak" id="kanan">Cetak Kartu pegawai</button></a>
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
<table cellpadding="5" cellspacing="0" class="table">
<tr id="th">
	<th align="right" width="10px">No.</th>
	<th align="center" width="10px" ><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.$banyak.')"></th>
	<th align="center" width="80px">ID pegawai</th>
	<th align="center" width="150px">Nama</th>
	<th align="center">Alamat</th>
	<th align="center" width="20px">L/P</th>
	<th align="center" width="100px">Nomor Telepon</td>
	<th align="center" width="100px">Jabatan</td>
</tr>';
if(count($tampil)>0){
	$i = 1;
	foreach($tampil as $data){
	$kolom= ($i%2 == 1)? "kolom-ganjil" : "kolom-genap";
	echo'
	<tr class="'.$kolom.'" onclick="check();">
		<td align="right">'.$i.'.</td>
		<td align="center" ><input name="item[]" id="item'.$i.'" value="'.$data['id_peg'].'" type="checkbox"></td>
		<td align="center">'.$data['id_peg'].'</td>
		<td>'.$data['nm_peg'].'</td>
		<td>'.$data['almt_peg'].'</td>
		<td align="center">'.$data['jns_kelamin'].'</td>
		<td align="left">'.$data['telp_peg'].'</td>
		<td align="left">'.$data['nm_kel'].'</td>
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
</form></div>';

?>
