	<script>
    $(function() {
        $( '#tgl_trans' ).datepicker({ 
			dateFormat:"yy-mm-dd",
            changeMonth: true,
            changeYear: true
		});
    });
    </script>
<?php
	$lokasi="Pemesanan Barang";
	$brg = new barang();
	$hari_ini =date("Y-m-d");
	// ----- awal kode otomatis ----- //
		$a="PS";
		$b=date("ymd");
		$qry = "SELECT max(no_pes) as maxID FROM br_pembelian WHERE no_pes LIKE '%$a/$b%'";
		$hasil = mysql_query($qry);
		$kode = mysql_fetch_array($hasil);
		$idMax = $kode['maxID'];
		$noUrut = (int) substr($idMax, 10, 4);
		$noUrut++;
		$nopes = $a ."/". $b . "/". sprintf("%04s", $noUrut);
	// ----- akhir kode otomatis ----- //
		$ada = count($brg->tampil_pembelian_detail("*","WHERE no_pes='$nopes'"));
		
		
echo '<div class="konten"><div class="lokasi"><label>'.$lokasi.'</label></div>';
	//$qbtn=mysql_query(' SELECT no_pes FROM br_pembelian_detail WHERE no_pes="'.$nopes.'"') or die (mysql_error());
		if($ada == 0){
			echo '<form class="form1" action="" name="form1" method="get">
			<div class="alat"> Pilih Supplier
			<input name="mod" value="barang"  type="hidden">
			<input name="h" value="pembelian"  type="hidden">
			<select name="id_sup" class="select" onChange="form1.submit()">
				<option value="0">-- Pilih --</option>';
			$tampil_penyalur = $brg->tampil_penyalur();
			foreach($tampil_penyalur as $data){
				if(!empty($_GET['id_sup'])){
					echo '<option value="'.$data['id_sup'].'"';
					if($data['id_sup'] == $_GET['id_sup']){echo ' selected';}
					echo '>'.$data['id_sup'].". ".$data['nm_sup'].'</option>';
				}
				else{
					echo '<option value="'.$data['id_sup'].'">'.$data['nm_sup'].'</option>';
				}
			}
			echo'	
			</select>
			</div>
			</form>';
		}
//---------------------------------
	
	echo '
	<form class="form1" name="fkonten1" method="post" action="?mod='.$_GET['mod'].'&h=aksi">';
		if($ada > 0){
		echo'<div class="alat">
			<input type="submit" class="simpan" id="sendiri" name="simpan_pesanan" value="Selesai pemesanan">
			<input type="hidden" name="lokasi" value="'.$lokasi.'"></div>';
			
		}
		echo'
		<table class="table">
			<tr>
				<td width="130px"><label>No Pemesanan</label></td>
				<td align="center" width="10px">:</td>
				<td width="200px"><input type="text" name="no_pes" class="text" value="'.$nopes.'" readonly=""></td>
				<!-- -->
				<td width="130px"><label>Tanggal Pemesanan</label></td>
				<td align="center" width="10px">:</td>
				<td><input type="text" class="text" name="tgl_pes" id="tgl_trans" value="'.$hari_ini.'"></td>
			</tr>
		</table> 
	</form>';
//---------------------------------
	echo '
	<form class="form1" name="fkonten" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit=\'return confirm("Simpan data ?")\'>
		<table class="table" border="0" cellspacing="0" cellpadding="5">';
	$baris=0;

if(empty($_GET['id_sup'])){ //sebelum memilih suppplier
	echo '
	<br>
		<label> Barang yang belum ditindak lanjuti</label>
		<tr>	
			<th width="5px">No.</th><th width="100px">ID / Kode Barang</th>
			<th >Nama Barang</th><th width="80px">Harga</th>
			<th width="50px">Stok</th>
		</tr>';	
		$tampil = $brg->tampil_sementara("value","WHERE id_sementara='pesan_barang'");
		foreach($tampil as $data){
			$id_brg = $data['value'];
			$baris++;
			$kolom= ($baris%2 == 1)? 'kolom-ganjil' : 'kolom-genap';
				echo'
		<tr class="'.$kolom.'">
			<td align="right">'.$baris.'.</td>
			<td>'.$id_brg.'</td>
			<td>'.$brg->sunting_barang('nm_brg',$id_brg).'</td>
			<td align="right">
				<span class="mu">Rp. </span>'. number_format($brg->sunting_barang('hrg_beli',$id_brg), 0,',','.').'
			</td>
			<td align="right">'.$brg->sunting_barang('stok',$id_brg).'</td>
		</tr>
		
		';
		}

}
else{ //sudah memilih supplier dan menampilkan data pemesanan berdasarkan id supplier
		$id_sup=$_GET['id_sup'];
		$tampil = $brg->tampil_pembelian_detail("*","WHERE no_pes='$nopes' AND id_sup='$id_sup'");
		$ada = count($tampil);
	
		if($ada != 0){ //jika sudah melakukan pemesanan
			echo '
		<br>
		<label>Selesaikan pemesanan barang</label>
		<tr><th width="5px">No.</th><th width="100px">ID / Kode Barang</th>
			<th >Nama Barang</th><th width="100px">Harga</th>
			<th width="80px">Jumlah Pesan</th><th width="100px">Total</th></tr>';
			
		$baris = 0;
		foreach($tampil as $data){
			$id_brg = $data['id_brg'];
			$baris++;
			$kolom= ($baris%2 == 1)? 'kolom-ganjil' : 'kolom-genap';
		echo'
		<tr class="'.$kolom.'">
			<td align="right">'.$baris.'.</td>
			<td align="center">'.$id_brg.'</td>
			<td>'.$brg->sunting_barang('nm_brg',$id_brg).'</td>
			<td align="right"><span class="mu">Rp. </span>'. number_format($brg->sunting_barang('hrg_beli',$id_brg), 0,',','.') .'</td>
			<td align="right">'.$data['jml_brg'].'</td>
			<td align="right"><span class="mu">Rp. </span>'. number_format($data['total'], 0,',','.') .'</td>
		</tr>
		';
		}
			
			$q= mysql_query("SELECT SUM( total ) AS total , SUM(jml_brg) AS jml FROM  br_pembelian_detail WHERE no_pes='$nopes' ");
			$d=mysql_fetch_object($q);
			echo'
		<tr>
			<td colspan="4" align="right">Total</td>
			<td align="right">'.$d->jml.'</td>
			<td align="right"><span class="mu">Rp. </span>'. number_format($d->total, 0,',','.') .'</td>
		</tr>
		
		';
		}
		else{ // belum melakunan pemesanan barang
	
		echo '
		<br>
		<label>Tindak lanjuti pemesanan</label>
		<tr>
			<th width="5px">No.</th>
			<th width="100px">ID / Kode Barang</th>
			<th >Nama Barang</th>
			<th width="20px">Stok</th>
			<th width="80px">Harga</th>
			<th width="50px">Jumlah Pesan</th>
		</tr>';
		$tampil = $brg->tampil_sementara("value","WHERE id_sementara='pesan_barang'");
		foreach($tampil as $data){
			$id_brg = $data['value'];
			
			$tampil_brg = $brg->tampil_barang_w("*","WHERE id_brg='$id_brg' AND id_sup='$id_sup'");
			if(count($tampil_brg)>0){
			foreach($tampil_brg as $data2){
			$baris++;
			$kolom= ($baris%2 == 1)? 'kolom-ganjil' : 'kolom-genap';
			echo'
		<tr class="'.$kolom.'" >
			<td align="right">'.$baris.'.</td>
			<td>'.$data2['id_brg'].'</td>
			<td>'.$data2['nm_brg'].'</td>
			<td align="right">'.$data2['stok'].'</td>
			<td align="right">
				<span class="mu">Rp. </span>'. number_format($data2['hrg_beli'], 0,',','.').'
			</td>
			<td align="right">
				<input type="number" class="text" name="jml_brg[]" id="jml_brg" size="2" maxlength="3">
			</td>
			
			<input type="hidden" name="id_brg[]" id="id_brg" value="'.$data2['id_brg'].'">
			<input type="hidden" name="no_pes" value="'.$nopes.'">
			<input type="hidden" name="hrg_brg[]" value="'.$data2['hrg_beli'].'">
			<input type="hidden" name="id_sup" value="'.$id_sup.'">
		</tr>
		
			';
			}
			echo'
			<tr><td colspan="6" align="right" class="alat" >	
				<input type="submit" value="Pesan" name="pesan_brg" class="simpan" id="sendiri">
				<input type="hidden" name="lokasi" value="'.$lokasi.'">
				</td></tr>';
			}
			else{
			echo'<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
			}
		}
		

		}
}
	echo'
</table>
</form>
</div>';

?>

