<?php
	$lokasi="Pencetakan Label";
	$brg = new barang();
	$tampil = $brg->tampil_barang();
	
	$cek = $brg->tampil_sementara("*","WHERE id_sementara='pencetakan_label'");
	$jml = count($cek);
	
	echo'
	<div class="konten">
	'.$iframe.'
		<div class="lokasi">
			<label>'.$lokasi.'</label>
			<div class="kanan2">
				<form action="?mod=barang" method="get" name="form-pencarian" id="fpencarian" >
				<label>Terdapat <font>'.$jml.'</font> dalam antrian menunggu untuk dicetak </label>
				<input name="mod" value="barang"  type="hidden" >
				<input name="h" value="pencetakan_label" type="hidden">
				<input name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text" value="';if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" placeholder="ID/Kode/Nama Barang" title="Kode barang / Nama barang"> 
				</form>
			</div>
		</div>
	<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data untuk ditambahkan dalam antrian\');">
		<div class="alat">
			<input name="tambah_antrian_label" value="Tambah dalam antrian" class="tambah" id="kiri"  type="submit">
			<a  href="barang/label.php" target="framepopup"  onClick=" return cek_data('.$jml.',\'Jumlah antrian kosong\');"><button name="cetak" class="cetak" id="kanan" type="button">Cetak label barang</button></a>
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
		</div>
	<table cellpadding="5" cellspacing="0" class="table">
	<tr id="th">
		<th align="right" width="10px">No.</th>
		<th align="center" width="10px"> <input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.count($tampil).')"></th>
		<th align="center" width="60px">ID Barang</th>
		<th align="center" width="120px">Kode Barang</th>
		<th align="center">Nama Barang</th>
		<th align="center" width="60px">Kategori</th>
	</tr>';
	if(count($tampil) >0){
	$baris = 0;
		foreach($tampil as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
		echo'
		<tr class="'.$kolom.'">
			<td align="right">'.$baris.'.</td>
			<td align="center"><input name="item[]" id="item'.$baris.'" value="'.$data['id_brg'].'" type="checkbox"></td>
			<td align="center">'.$data['id_brg'].'</td>
			<td >'.$data['kode_brg'].'</td>
			<td>'.$data['nm_brg'].'</td>
			<td align="center">'.$data['id_kt_brg'].'</td>
		</tr>';	
		}
	}
	elseif(count($tampil)==0  && !empty($_GET['cari'])){
	echo "<script type='text/javascript'> alert('Pencarian [".$_GET['cari']."] tidak ditemukan');history.back()</script>";
	}
	else{
	echo "<script type='text/javascript'> alert('Barang kosong');window.location='?mod=barang&h=tambah'</script>";
	} 	
	
	
	echo'	
	</table>
	</form>
	</div>';
?>
