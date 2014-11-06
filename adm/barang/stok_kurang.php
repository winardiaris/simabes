<?php
	$lokasi="Stok Minimal";
	$brg = new barang();
	$tampil = $brg->tampil_stok_kurang();
	$jml = count($tampil);
	$ada = count($brg->tampil_sementara("*","pesan_barang"));
	echo'
	<div class="konten">
		<div class="lokasi">
			<label>'.$lokasi.'</label>
			<div class="kanan2">
				<label>Terdapat <font>'.$jml.' </font>'. $lokasi.'</label>
				<label>dan terdapat <font>'.$ada.' </font> pesanan untuk ditindak lanjuti</label>
			</div>
		</div>
	<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return cek_chk(\'Pilih data yang akan ditambahkan dalam pesanan\');">
		<div class="alat">
			<input name="pesan_tambah" value="Tambahkan dalam pesanan" class="tambah" id="kiri"  type="submit">
			<a '; if($ada>0){ echo'href="?mod='.$_GET['mod'].'&h=pembelian" '; }echo' onClick=" return cek_data('.$ada.',\'Tidak terdapat pesanan\');"><button type="button" class="perbaharui" id="kanan" >Tindak lanjuti pesanan</button></a>
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
		</div>
	<table cellpadding="5" cellspacing="0" class="table">
	<tr id="th">
		<th align="right" width="10px">No.</th><th align="center" width="10px"><input type="checkbox" id="semua" name="semua" onclick="checkUncheckAll('.$jml.')"></th>
		<th align="center" width="60px">ID Barang</th><th align="center" width="120px">Kode Barang</th>
		<th align="center" width="60px">Kategori</th><th align="center">Nama Barang</th>
		<th align="center" width="80">Harga Beli</th><th align="center" width="80">Harga Jual</th>
		<th align="center" width="10px">Stok</td><th align="center" width="200px">Supplier</th>
	</tr>';

	$baris = 0;
	if($jml>0){	
		foreach($tampil as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
		echo'
		<tr class="'.$kolom.'">
			<td align="right">'.$baris.'.</td>
			<td align="center"><input name="item[]" id="item'.$baris.'" value="'.$data['id_brg'].'" type="checkbox"></td>
			<td align="center">'.$data['id_brg'].'</td>
			<td >'.$data['kode_brg'].'</td>
			<td align="center">'.$data['id_kt_brg'].'</td>
			<td>'.$data['nm_brg'].'</td>
			<td align="right">';			
				$harga = $data['hrg_beli'];
				$Format_Harga = number_format($harga, 0,',','.');
				echo "<span class=\"mu\">Rp. </span>".$Format_Harga;
		echo'
			</td>
			<td align="right">';
				$harga = $data['hrg_jual'];
				$Format_Harga = number_format($harga, 0,',','.');
				echo "<span class=\"mu\">Rp. </span>".$Format_Harga;
		echo'
			</td>
			<td align="right">'.$data['stok'].'</td>
			<td>'; 
				$id_sup = $data['id_sup'];
				echo $brg->sunting_penyalur('nm_sup',$id_sup);
		echo'
			</td>
		</tr>';
		}
	}
	else{
		echo '<tr ><td >_</td><td >_</td><td >_</td><td >_</td><td >_</td><td >_</td><td >_</td><td >_</td><td >_</td><td >_</td></tr>';
	}
	echo'
	</table>
	</form>
	</div>';
?>
