<?php
$lokasi="Data Pelanggan Kadaluarsa";
$plg = new pelanggan();
$tampil = $plg->kadaluarsa();
$jml_plg=count($tampil);
$banyak = $jml_plg;	

	echo '
	<div class="konten">
		<div class="lokasi">
			<label >'.$lokasi.'</label>
			<div class="kanan2">
				<form class="form1" action="" method="get" name="fpencarian" id="fpencarian">
				<label>Terdapat <font>'.$jml_plg." </font> ". $lokasi .' </label>
				<input name="mod" value="pelanggan"  type="hidden" >
				<input name="h" value="kadaluarsa" type="hidden" >
				<input name="submit" value="" class="pencarian" type="submit" >
				<input value="';if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text"  placeholder="ID / Nama Pelanggan" title="Pencarian dengan ID / Nama Pelanggan"> 
				</form>
			</div>
		</div>
	<form class="form1" name="form1" method="POST" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan diperpanjang\');">
		<div class="alat">
			<input name="perpanjang" value="Perpanjang Data Terpilih" class="perbaharui" id="sendiri"  type="submit"/>
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
		</div>
	<table cellpadding="5" cellspacing="0" class="table">
	<tr id="th">
		<th align="right" width="10px">No.</th>
		<th align="center" width="10px">';if($banyak>0)echo '<input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.$banyak.')">'; echo'</th>
		<th align="center" width="80px">ID Pelanggan</th>
		<th align="center" width="150px">Nama</th>
		<th align="center">Alamat</th>
		<th align="center" width="20px">L/P</th>
		<th align="center" width="100px">Nomor Telepon</td>
		<th align="center" width="100px">Masa Berlaku</td>
		<th align="center" width="120px">Terakhir diubah</th>
	</tr>';
if(count($tampil)>0){
		$i=1;
		foreach($tampil as $data){
			$kolom= ($i%2 == 1)? "kolom-ganjil" : "kolom-genap";
		echo'
		<tr class="'.$kolom.'">
			<td align="right">'.$i.'.</td>
			<td align="center"><input name="item[]" id="item'.$i.'" value="'.$data['id_plg'].'" type="checkbox"></td>
			<td align="center">'.$data['id_plg'].'</td>
			<td>'. $data['nm_plg'].'</td>
			<td>'.$data['almt_plg'].'</td>
			<td align="center">'. $data['jns_kelamin'].'</td>
			<td align="left">'. $data['telp_plg'].'</td>
			<td align="center">'. $data['masa_berlaku'].'</td>
			<td align="center">'. $data['wkt_ubah'].'</td>
		</tr>
		';
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
	</div>
	';
?>



