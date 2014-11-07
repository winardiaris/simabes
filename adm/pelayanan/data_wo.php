<?php
$lokasi="Data Work Order";
$ply = new pelayanan();
$tampil = $ply->tampil_wo();
$jml = count($tampil);

	
//log
$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
$log_pesan="A:2:Membuka";$log_waktu = $sekarang;
$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	echo '
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label>
		<div class="kanan2">
		<form action="" method="get" name="fpencarian" id="fpencarian">
		<input name="mod" value="pelayanan"  type="hidden" >
		<input name="h" value="wo"  type="hidden" >
		<input name="cari" value="';if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" id="cari" size="20" maxlength="50" class="text-pencarian" type="text"  placeholder="Pencarian" title=" No. WO | ID Pelanggan | No. Polisi | ID Pegawai" > 
		</form>
		</div>
	</div>
	<form class="form1" method="POST" action="" enctype="multipart/form-data"  name="wo" >
	<table class="table" cellpadding="5" cellspacing="0" border="0">
	<tr><th width="10px">No.</th><th width="20px">Status</th><th width="130px">No Work Order</th><th width="80px">ID Pelanggan</th><th width="80px">No Polisi</th><th width="200px">Jenis Kendaraan</th><th>Keluhan</th><th width="80px">Mekanik</th></tr>';
	$no=0;
	if($jml >0){
	foreach($tampil as $data){
		$kolom= ($no%2 == 1)? "kolom-ganjil" : "kolom-genap";
		$no++;
		if($data['status'] == 0 ) $img = "0.png";
		elseif($data['status'] == 1) $img = "1.png";
		elseif ($data['status'] == 2) $img = "2.png";
		else $img = "3.png";
		
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$no.'.</td>
		<td align="center"><a href="?mod='.$_GET['mod'].'&h=transaksi&id='.$data['status'].'&no_wo='.$data['no_wo'].'"><img src="../img/'.$img.'" height="24px" width="24px"></a></td>
		<td>'.$data['no_wo'].'</td><td>'.$data['id_plg'].'</td><td>'.$data['no_polisi'].'</td><td>'.$data['jns_kendaraan'].'</td><td>'.$data['keluhan'].'</td><td>'.$data['id_peg'].'</td>
	</tr>';
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
echo '</table></form></div>';

?>
