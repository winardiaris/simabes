<?php
	$lokasi="Tambah Barang";
	$brg= new barang();
	echo'
	<div class="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_barang()">
	<div class="alat">
		<input name="br_simpan" type="submit" value="Simpan" class="simpan" id="kiri" >
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table cellpadding="5" cellspacing="0" border="0" >
		<tr><td style="width: 170px;"><label>Kode Barang </label></td><td style="width: 10px;">:</td>
			<td style="width: auto;"><input  maxlength="30" size="40" name="kode_brg" class="text" placeholder="Kode Barang"></td></tr>
		<tr><td ><label>Nama Barang *</label></td><td>:</td>
			<td><input  maxlength="40" size="80" name="nm_brg" class="text" placeholder="Nama Barang"></td></tr>
		<tr><td style="width: 170px;"><label>Kategori Barang</label></td><td style="width: 10px;">:</td>
			<td style="width: auto;">
				<select  name="id_kt_brg" class="select" />';
			$tampil = $brg->tampil_kategori();
			foreach($tampil as $data){
				echo '<option  value="'.$data['id_kt_brg'].'">'.$data['nm_kt_brg'].'</option>';
			}
			echo'</td></tr>
		<tr><td><label>Jenis Kendaraan</label></td><td>:</td>
			<td>';
			$tampil = $brg->tampil_jenis_kendaraan();
			foreach($tampil as $data){
				echo '<input name="item[]" id="item[]" value="'.$data['id_kendaraan'].'" type="checkbox"> '. $data['kendaraan'].', ';
			}
			echo'</td></tr>
		<tr><td style="width: 170px;"><label>Kualitas Barang</label></td><td>:</td>
			<td style="width: auto;">';
			$tampil = $brg->tampil_kualitas();
			foreach($tampil as $data){
				echo '<input name="id_kualitas" type="radio" value="'.$data['id_kualitas'].'"> '.$data['kualitas'].' ';
			}	
			echo'</td></tr>
		<tr><td ><label>Harga Beli *</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="hrg_beli" class="text" id="hrg_beli" placeholder="Harga Beli"></td></tr>
		<tr><td ><label>Harga Jual *</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="hrg_jual" class="text" id="hrg_jual" placeholder="Harga Jual">
				 Satuan : <select  name="id_satuan" class="select">';
				$tampil = $brg->tampil_satuan();
				foreach($tampil as $data){
					echo '<option value="'.$data['id_satuan'].'">'.$data['satuan'].'</option>';
				}
			echo'</td></tr>
		<tr><td ><label>Stok *</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="stok" class="text"  type="number" placeholder="Jumlah Barang"/>
				<label> Stok Minimal: </label><input  maxlength="35" size="40" name="stok_min" class="text"  type="number" placeholder="Stok Minimal"/></td></tr>
		<tr><td ><label>Rak</label></td><td>:</td>
			<td><select  name="id_rak" class="select">';
			$tampil = $brg->tampil_rak();
			foreach($tampil as $data){
				echo '<option value="'.$data['id_rak'].'">'.$data['nm_rak'].'</option>';
			}
			echo'</td></tr>
		<tr><td ><label>Supllier</label></td><td>:</td>
			<td><select name="id_sup" class="select" >';
			$tampil = $brg->tampil_penyalur();
			foreach($tampil as $data){
				echo '<option value="'.$data['id_sup'].'">'.$data['nm_sup'].'</option>';
			}
			echo'</select></td></tr>
		<tr><td><label>Tanggal Masuk </label></td><td>:</td>
			<td><input type="text" maxlength="20" size="20" name="tgl_masuk" id="tgl_masuk" class="text" value="'.date("Y-m-d").'"/></td></tr>
		<tr><td valign="top"><label>Keterangan </label></td><td valign="top">:</td>
			<td valign="top"><textarea  cols="80" rows="5" name="ket_brg" placeholder="Keterangan"></textarea></td></tr>
		<tr><td><label>Photo Barang</label></td><td>:</td>
			<td><input type="file" name="photo_brg" id="photo_brg" class="text"></td></tr>
	</table>
	</form>
	</div>';
?>
