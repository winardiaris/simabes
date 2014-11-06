<?php
	$lokasi="Sunting Barang";
	$brg = new barang();	
	$id_brg=$_GET['id_brg'];
	
	echo'
	<div class="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>	
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" onsubmit="return validasi_barang()">
	<div class="alat">
		<input name="br_perbaharui" type="submit" value="Perbaharui" class="perbaharui" id="kiri">
		<input name="btn_batal" type="reset"  value="Batal" class="batal" id="kanan" onClick="javascript:history.back()">
		<input type="hidden" name="lokasi" value="'.$lokasi.'">
	</div>
	<table cellpadding="5" cellspacing="0" border="0" >
		<tr>
			<td style="width: 170px;"><label>Kode Barang </label></td><td style="width: 10px;">:</td>
			<td style="width: auto;"><input  maxlength="30" size="40" name="kode_brg" class="text" value="'.$brg->sunting_barang('kode_brg',$id_brg).'"></td>
			<td width="163" rowspan="10" align="center" valign="top">
				<img class="photo" src="'.$brg->sunting_barang('photo_brg',$id_brg).'" alt="'.$brg->sunting_barang('nm_brg',$id_brg).'" width="200" border="1"/>
				<input name="id_brg" type="hidden" value="'.$brg->sunting_barang('id_brg',$id_brg) .'">
			</td></tr>
		<tr><td ><label>Nama Barang *</label></td><td>:</td>
			<td><input  maxlength="40" size="80" name="nm_brg" class="text" value="'. $brg->sunting_barang('nm_brg',$id_brg).'"></td></tr>
		<tr><td style="width: 170px;"><label>Kategori Barang</label></td><td style="width: 10px;">:</td>
			<td style="width: auto;">
				<select  name="id_kt_brg" class="select" />';
			$id_kt_brg = $brg->sunting_barang('id_kt_brg',$id_brg);
			$tampil = $brg->tampil_kategori();
			foreach($tampil as $data){
				echo '<option  value="'.$data['id_kt_brg'].'"';
					if($data['id_kt_brg'] == $id_kt_brg){echo' selected';}
				echo'>'.$data['nm_kt_brg'].'</option>';
			}	
			echo'</select></td></tr>
		<tr><td><label>Jenis Kendaraan</label></td><td>:</td><td>';			
			$tampil = $brg->tampil_jenis_kendaraan();
			foreach($tampil as $data){
				echo '<input name="item[]" id="item[]" value="'.$data['id_kendaraan'].'" type="checkbox"';
					$tampil2 = $brg->tampil_br_kendaraan($id_brg);
					foreach($tampil2 as $data2){
						if($data['id_kendaraan'] == $data2['id_kendaraan']){ echo ' checked';}
					}
				echo '> '. $data['kendaraan'].', ';
			}
			echo'
			</td></tr>
		<tr><td style="width: 170px;"><label>Kualitas Barang</label></td><td style="width: 10px;">:</td>
			<td style="width: auto;">';	
			$id_kualitas = $brg->sunting_barang('id_kualitas',$id_brg);
			$tampil = $brg->tampil_kualitas();
			foreach($tampil as $data){
				echo '<input name="id_kualitas" type="radio" value="'.$data['id_kualitas'].'"';
					if($data['id_kualitas'] == $id_kualitas){ echo ' checked';}
				echo '> '.$data['kualitas'].' ';
			}	
			echo'</td></tr>
		<tr><td ><label>Harga Beli *</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="hrg_beli" id="hrg_beli" class="text" value="'. $brg->sunting_barang('hrg_beli',$id_brg).'"></td></tr>
		<tr><td ><label>Harga Jual *</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="hrg_jual" id="hrg_jual" class="text" value="'. $brg->sunting_barang('hrg_jual',$id_brg).'" >
			 Satuan : <select  name="id_satuan" class="select">';
				$id_satuan = $brg->sunting_barang('id_satuan',$id_brg);
				$tampil = $brg->tampil_satuan();
				foreach($tampil as $data){
					echo '<option value="'.$data['id_satuan'].'"';
						if($data['id_satuan'] == $id_satuan){echo ' selected';}
					echo'>'.$data['satuan'].'</option>';
				}	
			echo'</select></td></tr>
		<tr><td ><label>Stok *</label></td><td>:</td>
			<td><input  maxlength="35" size="40" name="stok" class="text"  type="number" value="'. $brg->sunting_barang('stok',$id_brg).'"/>
				<label> Stok Minimal : </label>
				<input  maxlength="35" size="40" name="stok_min" class="text"  type="number" value="'. $brg->sunting_barang('stok_min',$id_brg).'"/>
			</td></tr>
		<tr><td ><label>Rak</label></td><td>:</td>
			<td><select  name="id_rak" class="select">';
			$id_rak = $brg->sunting_barang('id_rak',$id_brg);
			$tampil = $brg->tampil_rak();
			foreach($tampil as $data){
				echo '<option value="'.$data['id_rak'].'"';
				if($data['id_rak'] == $id_rak){echo ' selected';}
				echo '>'.$data['nm_rak'].'</option>';
			}	
			echo'</select></td></tr>
		<tr><td ><label>Supllier</label></td><td>:</td>
			<td><select name="id_sup" class="select" >';
			$id_sup = $brg->sunting_barang('id_sup',$id_brg);
			$tampil = $brg->tampil_penyalur();
			foreach($tampil as $data){
				echo '<option value="'.$data['id_sup'].'"';
				if($data['id_sup'] == $id_sup){echo ' selected';}
				echo '>'.$data['nm_sup'].'</option>';
			}
			echo'</select></td></tr>
		<tr><td><label>Tanggal Masuk </label></td><td>:</td>
			<td><input type="text" maxlength="20" size="20" name="tgl_masuk" id="tgl_masuk" class="text" value="'. $brg->sunting_barang('tgl_masuk',$id_brg).'"/></td></tr>
		<tr><td valign="top"><label>Keterangan *</label></td><td valign="top">:</td>
			<td valign="top"><textarea  cols="80" rows="5" name="ket_brg">'. $brg->sunting_barang('ket_brg',$id_brg).'</textarea></td></tr>
		<tr><td><label>Photo Barang</label></td><td>:</td>
			<td><input type="file" name="photo_brg" id="photo_brg" class="text"><br><font >Pilih Photo Jika Ingin Diganti</font></td></tr>
	</table>
	</form></div>';
?>

