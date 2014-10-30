<?php
	$lokasi="Catatan sistem";
	$sis = new sistem();
	
	echo'
	<div class="konten">
		<div class="lokasi">
			<label>'.$lokasi.'</label>
			<div class="kanan2">
				<form action="" method="get" name="fpencarian" id="fpencarian">
				<input name="mod" value="sistem"  type="hidden" >
				<input name="h" value="log"  type="hidden" >
				<input name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text"  value="'; if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" placeholder="Pencarian Catatan" title="Pencarian"> 
				</form>
			</div>
		</div>
	<form name="fkonten" method="" action="" >
	<table cellpadding="5" cellspacing="0" class="table">
	<tr id="th">
		<th align="right" width="10px">No.</th>
		<th width="180px">Lokasi</th>
		<th>Pengguna</th>
		<th>Pesan</th>
		<th align="center" width="130px">Waktu</th>
	</tr>';
	$tampil = $sis->tampil_catatan_sistem();
	if(count($tampil)>0){
	$no = 0;
	foreach($tampil as $data){
		$no++;
		$kolom= ($no%2 == 1)? "kolom-ganjil" : "kolom-genap";
	
	echo'
		<tr class="'.$kolom.'">
			<td align="right">'.$no .'.</td>
			<td>'.$data['log_lokasi'].'</td>
			<td>'.$data['pengguna'].'</td>
			<td>'.$data['log_pesan'].'</td>
			<td align="center">'.$data['log_waktu'].'</td>
		</tr>';
		}
	echo'
	</table>
	</form>
	</div>';
}
elseif(count($tampil)==0  && !empty($_GET['cari'])){
	echo "<script type='text/javascript'> alert('Pencarian [".$_GET['cari']."] tidak ditemukan');history.back()</script>";
}
else{
	echo "<script type='text/javascript'> alert('Catatan Sistem kosong');window.location='?mod=pegawai&h=tambah'</script>";
} 
?>
