<?php
$ply = new pelayanan();
$ambil_pelanggan = $ply->ambil_pelanggan();

	$lokasi="Work Order";

// ----- awal kode otomatis ----- //
	$a="WO";
	$b=date("ymd");
	$qry = "SELECT max(no_wo) as maxID FROM ply_wo WHERE no_wo LIKE '%$a/$b%'";
	$hasil = mysql_query($qry);
	$kode = mysql_fetch_array($hasil);
	$idMax = $kode['maxID'];
	$noUrut = (int) substr($idMax, 10, 3);
	$noUrut++;
	$no_wo = $a ."/". $b . "/". sprintf("%03s", $noUrut);
// ----- akhir kode otomatis ----- //
	
	echo '
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" method="POST" action="?mod='.$_GET['mod'].'&h=aksi" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_mulai();">
	<div class="alat">
		<input type="submit" name="simpan_wo" class="simpan" id="sendiri" value="Simpan '.$lokasi.'">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table class="table" cellpadding="5" cellspacing="0" border="0">
		<tr><td width="170px"><label>No Work Order</label></td><td width="5px">:</td><td><input type="text" class="text" name="no_wo" value="'.$no_wo.'" readonly=""></td></tr>
		<tr><td><label>ID Pelanggan *</label></td><td>:</td><td><input list="cari_plg" name="id_plg" class="text" size="30" maxlength="20" placeholder="ID Pelanggan">
				<datalist id="cari_plg">';
				foreach($ambil_pelanggan as $data){
				echo "<option value=\"".$data['id_plg']."\">".$data['nm_plg']."</option>";
				}
				echo'	
				</datalist></td></tr>
		<tr><td><label>No. Polisi *</label></td><td>:</td><td><input type="text" class="text" maxlength="10" name="no_polisi" placeholder="Isi no polisi kendaraan"></></td></tr>
		<tr><td><label>No. Mesin</label></td><td>:</td><td><input type="text" class="text" name="no_mesin" placeholder="Isi no mesin kendaraan"></td></tr>
		<tr><td><label>Jenis Kendaraan*</label></td><td>:</td><td><input type="text" class="text" name="jns_kendaraan" placeholder="Isi jenis kendaraan"></td></tr>
		<tr><td><label>KM Terakhir</label></td><td>:</td><td><input type="text" class="text" name="km_terakhir" placeholder="Isi KM terakhir"></td></tr>
		<tr><td><label>Keluhan</label></td><td>:</td><td><textarea cols="50" rows="2" name="keluhan" placeholder="Isikan keluhan pelanggan"></textarea></td></tr>
	</table>
	</form>
	</div>';
?>	
