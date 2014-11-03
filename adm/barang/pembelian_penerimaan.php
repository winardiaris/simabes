<?php
	$lokasi='Penerimaan Pemesanan Barang';
	$brg = new barang();
	$baris=0;
	echo '<div class="konten">';
	if(!empty($_GET['no_pes'])){ 
		$no_pes=$_GET['no_pes'];
		$tampil = $brg->tampil_pembelian();
		
	echo'
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" name="fkonten" method="post" action="?mod='.$_GET['mod'].'&h=aksi">
	<div class="alat">';
		$diterima = $brg->sunting_pembelian('diterima',$no_pes);
		if($diterima == 0){echo'<input type="submit" class="simpan" id="sendiri" name="simpan_terima" value="Selesai penerimaan">';}
		else{echo'<a href="?mod='.$_GET['mod'].'&h=penerimaan_pembelian" ><button type="button" class="batal" id="sendiri">Kembali</button></a>';}
	echo'
	</div>
<table cellpadding="5" cellspacing="0" class="table">
	<tr>
		<td width="100px">No Pemesanan</td>
		<td width="10px">:</td>
		<td>'.$no_pes.'</td>
	</tr>
	<tr>
		<td>Supplier</td>
		<td>:</td>
		<td>';
		$id_sup = $brg->sunting_pembelian('id_sup',$no_pes);
		echo $brg->sunting_penyalur('nm_sup',$id_sup); echo'</td>
	</tr>
	</table><br>
	<table cellpadding="5" cellspacing="0" class="table">
	<tr>
	<td colspan="5">';
		
	if($diterima==1){}	
	else{echo'<input type="submit" name="terima" class="tambah" id="sendiri" value="terima">';}
	echo'
	</td>
	</tr>
	<tr id="th">
		<th width="10px">No</th>
		<th width="10px">Terima</th>
		<th width="180px">ID | Kode Barang</th>
		<th>Nama Barang </th>
		<th width="20px">Jumlah</th>
	</tr>';
	

	$tampil = $brg->tampil_pembelian_detail("*","WHERE no_pes='$no_pes' ");
	$jml = count($tampil);
	if($jml != 0){	
		foreach($tampil as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? 'kolom-ganjil' : 'kolom-genap';

		echo'
		<tr class="'.$kolom.'">
		<td align="right">'.$baris.'.</td>
		<td align="center">
			<input type="hidden" name="lokasi" value="'.$lokasi.'">
			<input type="hidden" name="no_pes" value="'.$no_pes.'">
			<input type="hidden" name="id_sup" value="'.$data['id_sup'].'">';
			if($data['diterima']==0){
				echo'
				<input name="item[]" id="item[]" value="'.$data['id_brg'].'" type="checkbox">';
			}
			else{
				echo'<img src="../img/ceklis.png" height="20px" width="20px">';
			}
		echo '</td>
		<td >'.$data['id_brg'].'  | '.$brg->sunting_barang('kode_brg',$data['id_brg']).'</td>
		<td>'.$brg->sunting_barang('nm_brg',$data['id_brg']).'</td>
		<td align="right" >'.$data['jml_brg'].'</td>
	</tr>
		
		';
		}
	}
}	
	else{ // awal halaman
	$tampil = $brg->tampil_pembelian();
	$jml = count($tampil);
	echo $iframe;
	echo'
	<div class="lokasi">
		<label>'.$lokasi.'</label>
		<div class="kanan2">
			<form class="form1" action="" method="get" name="fpencarian" id="fpencarian">
			<label>Terdapat <font>'.$jml.' </font>'.$lokasi.'</label>
			<input name="mod" value="'.$_GET['mod'].'" type="hidden" >
			<input name="h" value="'.$_GET['h'].'" type="hidden" >
			<input name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text" value="'; if(!empty($_GET["cari"])){echo $_GET["cari"];} echo '" placeholder="Pencarian " > 
			</form>
		</div>
	</div>

	<form name="fkonten" method="post" action="?mod='.$_GET['mod'].'&h=aksi">
	<table cellpadding="5" cellspacing="0" class="table">
	<tr id="th">
		<th align="right" width="10px">No.</th>
		<th align="center" width="10px">Terima</th>
		<th align="center" width="130px">No Pemesanan</th>
		<th align="center" width="80px">Tanggal</th>
		<th>ID | Nama Supplier</th>
		<th align="center" width="60px">Jumlah</th>
	</tr>';

	

//ambil data

	$baris = 0;
	if($jml>0){
		foreach($tampil as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? 'kolom-ganjil' : 'kolom-genap';
			echo '
	<tr class="'.$kolom.'">
		<td align="right">'.$baris.'.</td>
		<td align="center">
			<a href=?mod='.$_GET['mod'].'&h=penerimaan_pembelian&no_pes='.$data['no_pes'].' title="Terima Pemesanan">';
				if($data['diterima']==0){echo'<img src="../img/bawah.png" height="20px" width="20px">';}
				else{echo'<img src="../img/ceklis.png" height="20px" width="20px">';}
			echo'
			</a>
		</td>
		<td align="center">'.$data['no_pes'].'</td>
		<td align="center">'.$data['tgl_pes'].'</td>
		<td >';
				echo $data['id_sup'].' | '.$brg->sunting_penyalur('nm_sup',$data['id_sup']); 
		echo '		
		</td>
		<td align="right">	';
				$no_pes = $data['no_pes'];
				echo count($brg->tampil_pembelian_detail("*","WHERE no_pes='$no_pes' "));
		echo'
		</td>
	</tr>';
		}//penutup dari while($data=mysql_fetch_object($daftar))
		
	echo'	
	</table>
	</form>';
	}
	elseif(count($tampil)==0  && !empty($_GET['cari'])){
		echo "<script type='text/javascript'> alert('Pencarian [".$_GET['cari']."] tidak ditemukan');history.back()</script>";
	}
	else{echo "<script type='text/javascript'> alert('Barang kosong');window.location='?mod=barang&h=tambah'</script>";}
	

	
}

echo'
</div>
</body>
</html>';
?>
