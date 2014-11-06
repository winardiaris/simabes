<?php
	$lokasi="Data Barang";
	$brg = new barang();
	$tampil = $brg->tampil_barang();
	$jml = count($tampil);
	$banyak = $jml;
	
	echo'
	<div class="konten">
		<div class="lokasi">
			<label>'.$lokasi.'</label>
			<div class="kanan2">
				<form action="" method="get" name="fpencarian" id="fpencarian">
				<label>Terdapat <font>'.$jml.' </font> '. $lokasi .' </label>
				<input name="mod" value="barang"  type="hidden" >
				<input name="h" value="data"  type="hidden" >
				<input name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text" value="';if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" placeholder="ID/Kode/Nama Barang" title="Kode barang / Nama barang"> 
				</form>
			</div>
		</div>
	<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan dihapus\')">
		<div class="alat">
			<input name="br_hapus" value="Hapus Data Terpilih" class="hapus" id="sendiri" align="float" type="submit"/>
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
		</div>
	<table cellpadding="5" cellspacing="0" class="table">
	<tr id="th"><th align="right" width="10px">No.</th>
		<th align="center" width="10px"><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.$banyak.')"></th>
		<th align="center" width="10px">Sunting</th>
		<th align="center" width="60px">ID Barang</th><th align="center" width="120px">Kode Barang</th><th align="center">Nama Barang</th>
		<th align="center" width="100px">Harga</th><th align="center" width="10px">Stok</td><th align="center" width="60px">Kategori</th>
		<th align="center" width="60px">Kualitas</th><th align="center" width="100px">Kendaraan</th>
	</tr>';

$i=1;
if($jml > 0){
	foreach($tampil as $data){
		$kolom= ($i%2 == 1)? "kolom-ganjil" : "kolom-genap";
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$i.'.</td>
		<td align="center"><input name="item[]" id="item'.$i.'" value="'.$data['id_brg'].'" type="checkbox"></td>
		<td align="center"><a href="?mod=barang&h=sunting&id_brg='.$data['id_brg'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>	
		<td align="center">'.$data['id_brg'].'</td>
		<td >'.$data['kode_brg'].'</td>
		<td>'.$data['nm_brg'].'</td>
		<td align="right">';
				$harga = $data['hrg_jual'];
				$Format_Harga = number_format($harga, 0,',','.');
				echo '<span class="mu">Rp. </span>'.$Format_Harga;
		echo'	
		</td>
		<td align="right">'.$data['stok'].'</td>
		<td align="center">'.$data['id_kt_brg'].'</td>
		<td align="center">'.$data['id_kualitas'].'</td>
		<td>';
			$id_brg = $data['id_brg'];
			$tampil2 = $brg->tampil_br_kendaraan($id_brg);
			foreach($tampil2 as $data2){
				echo $data2['id_kendaraan'].', ';
			}
		echo'
		</td>
	</tr>';	
	$i++;
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
	echo "<script type='text/javascript'> alert('Barang kosong');window.location='?mod=barang&h=tambah'</script>";
} 
?>
