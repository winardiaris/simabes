<?php
	$brg = new barang();
	$tampil_kategori = $brg->tampil_kategori();
	$tampil_kualitas = $brg->tampil_kualitas();
	$tampil_satuan = $brg->tampil_satuan();
	$tampil_jenis_kendaraan = $brg->tampil_jenis_kendaraan();
	
	if($_GET['id']==1){$lokasi="Kategori Barang";}
	elseif($_GET['id']==2){$lokasi="Kualitas Barang";}
	elseif($_GET['id']==3){$lokasi="Satuan Barang";}
	elseif($_GET['id']==4){$lokasi="Jenis Kendaraan";}
	echo'
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	
	<div class="alat">
		<button class="perbaharui" id="kiri" onclick="window.location=\'?mod='.$_GET['mod'].'&h='.$_GET['h'].'&id=1\'">Kategori Barang</button>
		<button class="perbaharui" id="tengah" onclick="window.location=\'?mod='.$_GET['mod'].'&h='.$_GET['h'].'&id=2\'">Kualitas Barang</button>
		<button class="perbaharui" id="tengah" onclick="window.location=\'?mod='.$_GET['mod'].'&h='.$_GET['h'].'&id=3\'">Satuan Barang</button>
		<button class="perbaharui" id="kanan" onclick="window.location=\'?mod='.$_GET['mod'].'&h='.$_GET['h'].'&id=4\'">Jenis Kendaraan</button>
	</div>';
if(isset($_GET['id'])){
	if($_GET['id'] == 1){
		echo'
		<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan dihapus\');">
			<div class="alat">
				<a href="?mod='.$_GET['mod'].'&h=kategori_tambah"><input name="tambah_kategori" value="Tambah" class="tambah" id="kiri" type="button"></a>
				<input name="br_kategori_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
				<input type="hidden" name="lokasi" value="'.$lokasi.'">
			</div>
			<table class="table" cellpadding="5" cellspacing="0" border="0" >
				<tr>
					<th align="right" width="10px">No.</th>
					<th align="center" width="10px"><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.count($tampil_kategori).')"></th>
					<th align="center" width="10px">Sunting</th>
					<th align="center" width="15px">ID</th>
					<th align="center">Nama Kategori</th>
					<th align="center" width="120px">Terakhir diubah</th>
				</tr>';
					$tampil = $tampil_kategori;
					$baris=0;
					foreach($tampil as $data){
						$baris++;
						$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo'
				<tr class="'.$kolom.'">
					<td align="right">'.$baris .'.</td>
					<td align="center"><input name="item[]" id="item'.$baris.'" value="'.$data['id_kt_brg'].'" type="checkbox"></td>
					<td align="center"><a href="?mod='.$_GET['mod'].'&h=kategori_sunting&id_kt_brg='.$data['id_kt_brg'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
					<td>'.$data['id_kt_brg'].'</td>
					<td>'.$data['nm_kt_brg'].'</td>
					<td align="center">'.$data['wkt_ubah'].'</td>
				</tr>';
				
				}
			echo'
			</table>
			</form>';
	}
	elseif($_GET['id'] == 2){
		echo'
		<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan dihapus\');">
			<div class="alat">
				<a href="?mod='.$_GET['mod'].'&h=kualitas_tambah"><input name="tambah_kualitas" value="Tambah" class="tambah" id="kiri" type="button"></a>
				<input name="br_kualitas_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
			</div>
			<table class="table" cellpadding="5" cellspacing="0" border="0" >
				<tr>
					<th align="right" width="10px">No.</th>
					<th align="center" width="10px"><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.count($tampil_kualitas).')"></th>
					<th align="center" width="10px">Sunting</th>
					<th align="center" width="15px">ID</th>
					<th align="center">Kualitas</th>
					<th align="center" width="120px">Terakhir diubah</th>
				</tr>';
					$baris=0;
					$tampil = $tampil_kualitas;
					foreach($tampil as $data){
						$baris++;
						$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo'
				<tr class="'.$kolom.'">
					<td align="right">'.$baris .'.</td>
					<td align="center"><input name="item[]" id="item'.$baris.'" value="'.$data['id_kualitas'].'" type="checkbox"></td>
					<td align="center"><a href="?mod='.$_GET['mod'].'&h=kualitas_sunting&id_kualitas='.$data['id_kualitas'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
					<td>'.$data['id_kualitas'].'</td>
					<td>'.$data['kualitas'].'</td>
					<td align="center">'.$data['wkt_ubah'].'</td>
				</tr>';
					}
			echo'
			</table>
			</form>';
	}
	elseif($_GET['id'] == 3){
		echo'
		<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan dihapus\');">
			<div class="alat">
				<a href="?mod='.$_GET['mod'].'&h=satuan_tambah"><input name="tambah_satuan" value="Tambah" class="tambah" id="kiri" type="button"></a>
				<input name="br_satuan_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
			</div>
			<table class="table" cellpadding="5" cellspacing="0" border="0" >
				<tr>
					<th align="right" width="10px">No.</th>
					<th align="center" width="10px"><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.count($tampil_satuan).')"></th>
					<th align="center" width="10px">Sunting</th>
					<th align="center" width="15px">ID</th>
					<th align="center">Satuan</th>
					<th align="center" width="120px">Terakhir diubah</th>
				</tr>'; 
					$baris=0;
					$tampil = $tampil_satuan;
					foreach($tampil as $data){
						$baris++;
						$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo'
				<tr class="'.$kolom.'">
					<td align="right">'.$baris .'.</td>
					<td align="center"><input name="item[]" id="item'.$baris.'" value="'.$data['id_satuan'].'" type="checkbox"></td>
					<td align="center"><a href="?mod='.$_GET['mod'].'&h=satuan_sunting&id_satuan='.$data['id_satuan'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
					<td>'.$data['id_satuan'].'</td>
					<td>'.$data['satuan'].'</td>
					<td align="center">'.$data['wkt_ubah'].'</td>
				</tr>';
					}
			echo'
			</table>
			</form>';
	}
	elseif($_GET['id'] == 4){
		echo'
		<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan dihapus\');">
			<div class="alat">
				<a href="?mod='.$_GET['mod'].'&h=kendaraan_tambah"><input name="tambah_kendaraan" value="Tambah" class="tambah" id="kiri" type="button"></a>
				<input name="br_kendaraan_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
			</div>
			<table class="table" cellpadding="5" cellspacing="0" border="0" >
				<tr>
					<th align="right" width="10px">No.</th>
					<th align="center" width="10px"><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.count($tampil_jenis_kendaraan).')"></th>
					<th align="center" width="10px">Sunting</th>
					<th align="center" width="15px">ID</th>
					<th align="center">Jenis Kendaraan</th>
					<th align="center" width="120px">Terakhir diubah</th>
				</tr>';
					$baris=0;
					$tampil = $tampil_jenis_kendaraan;
					foreach($tampil as $data){
						$baris++;
						$kolom= ($baris %2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo'
				<tr class="'.$kolom.'">
					<td align="right">'.$baris .'.</td>
					<td align="center"><input name="item[]" id="item'.$baris.'" value="'.$data['id_kendaraan'].'" type="checkbox"></td>
					<td align="center"><a href="?mod='.$_GET['mod'].'&h=kendaraan_sunting&id_kendaraan='.$data['id_kendaraan'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
					<td>'.$data['id_kendaraan'].'</td>
					<td>'.$data['kendaraan'].'</td>
					<td align="center">'.$data['wkt_ubah'].'</td>
				</tr>';
				}
			echo'
			</table>
			</form>';
	}
	
	
	
}
else{
	header('location:?mod='.$_GET['mod'].'&h='.$_GET['h'].'&id=1');
}
echo'</div>';

?>
