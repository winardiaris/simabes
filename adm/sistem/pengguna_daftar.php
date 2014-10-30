<?php
	$lokasi="Data Pengguna Aplikasi";
	$sis = new sistem();
	$tampil = $sis->tampil_pengguna();
	
	echo'
	<div class="konten">
		<div class="lokasi">
			<label>'.$lokasi.'</label>
			<div class="kanan2">
				<form action="" method="get" name="fpencarian" id="fpencarian">
				<input name="mod" value="sistem" type="hidden" >
				<input name="h" value="pengguna" type="hidden" >
				<input name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text"  placeholder="Pencarian Pengguna" title="Pencarian" value="'; if(!empty($_GET['cari'])){echo $_GET['cari'];}echo'"> 
				</form>
			</div>
		</div>
	<form  class="form1" name="fkonten" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return confirm(\'Hapus Data Terpilih ?\')">
		<div class="alat">
			<a href="?mod=sistem&h=pengguna_tambah">
				<button class="tambah" id="kiri" type="button">Tambah Pengguna Baru</button>
				<input name="hapus_pengguna" value="Hapus Data Terpilih" class="hapus" id="kanan" type="submit">
				<input name="lokasi" value="'.$lokasi.'" type="hidden" >
			</a>
		</div>
	<table class="table" cellpadding="5" cellspacing="0" >
	<tr id="th">
		<th align="right" width="10px">No.</th>
		<th align="center" width="10px"></th>
		<th align="center" width="10px">Sunting</th>
		<th align="center" width="150px">Nama Pengguna</th>
		<th align="center">Nama Asli</th>
		<th align="center" width="120px">Kelompok Pengguna</td>
		<th align="center" width="120px">Terakhir Masuk</th>
	</tr>';
	
$no = 0;
if(count($tampil)>0){
	foreach($tampil as $data){
		$no++;
		$kolom= ($no%2 == 1)? "kolom-ganjil" : "kolom-genap";
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$no .'.</td>
		<td align="center"><input name="item[]" id="item[]" value="'.$data['id_pengguna'].'" type="checkbox"></td>
		<td align="center"><a href="?mod=sistem&h=pengguna_sunting&id_pengguna='.$data['id_pengguna'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
		<td>'.$data['nm_pengguna'].'</td>
		<td>'.$data['nm_asli'].'</td>
		<td>'. $data['nm_kel'] .'</td>
		<td align="center">'.$data['terakhir_masuk'].'</td>
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
	echo "<script type='text/javascript'> alert('Data pengguna kosong');history.back()'</script>";
} 
?>
