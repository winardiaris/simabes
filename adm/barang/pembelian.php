	<script>
    $(function() {
        $( "#tgl_trans" ).datepicker({ 
			dateFormat:'yy-mm-dd',
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


echo "<div class='konten'><div class='lokasi'><label>$lokasi</label></div>";
	
	
	$qbtn=mysql_query(" SELECT no_pes FROM br_pembelian_detail WHERE no_pes='$nopes'") or die (mysql_error());
			if(mysql_num_rows($qbtn)>0){
				
			}
			else{
				echo "<form class='form1' action='?mod=pembelian_br' name='form1' method='get'>
				<div class='alat'> Pilih Supplier
		
				<input name='mod' value='pembelian_br'  type='hidden'>
				<select name='id_sup' class='select' onChange='form1.submit()'>
					<option value='0'>-- Pilih --</option>";
				$qry_sup="SELECT id_sup, nm_sup FROM sup_data";
				$sup=mysql_query($qry_sup) or die (mysql_error());
					while($data=mysql_fetch_object($sup)){
						if(!empty($_GET['id_sup'])){
							echo "<option value=\"$data->id_sup\"";
								if($data->id_sup==$_GET['id_sup']){
									echo "selected";
								}
							echo ">$data->nm_sup</option>";
						}
						else{
							echo "<option value=\"$data->id_sup\">$data->nm_sup</option>";
						}
					}
				echo"	
				</select>
				</div>
				</form>";
			}
//---------------------------------
	echo "
	<form class='form1' name='fkonten1' method='post' action='?mod=f_barang'>";
		$qbtn=mysql_query(" SELECT no_pes FROM br_pembelian_detail WHERE no_pes='$nopes'") or die (mysql_error());
			if(mysql_num_rows($qbtn)>0){
		echo"
		<div class='alat'>
			<input type='submit' class='simpan' id='sendiri' name='simpan_pesanan' value='Selesai pemesanan'>
		</div>";
		}
		echo"
		<table class='table'>
			<tr>
				<td width='130px'><label>No Pemesanan</label></td>
				<td align='center' width='10px'>:</td>
				<td width='200px'><input type='text' name='no_pesan' class='text' value='$nopes' readonly=''></td>
				<!-- -->
				<td width='130px'><label>Tanggal Pemesanan</label></td>
				<td align='center' width='10px'>:</td>
				<td><input type='text' class='text' name='tgl_pesan' id='tgl_trans' value='$hari_ini'></td>
			</tr>
		</table> 
	</form>";
//---------------------------------
	echo "
	<form class='form1' name='fkonten' method='post' action='?mod=f_barang' onsubmit=\"return confirm('Simpan data ?')\">
		<table class='table' border='0' cellspacing='0' cellpadding='5'>";
	$baris=0;

	if(empty($_GET['id_sup'])){ //sebelum memilih suppplier
	
	echo "
	<br>
		<label> Barang yang belum ditindak lanjuti</label>
		<tr><th width='5px'>No.</th>
			<th width='100px'>ID / Kode Barang</th>
			<th >Nama Barang</th>
			<th width='80px'>Harga</th>
			<th width='50px'>Stok</th>
		</tr>";	
		
		$qsem=mysql_query("SELECT * FROM sementara WHERE id_sementara='pesan_barang'")or die (mysql_error());
		while($dsem=mysql_fetch_object($qsem)){
			$qbrg=mysql_query("SELECT * FROM br_data WHERE id_brg='$dsem->value'");
			while($dbrg=mysql_fetch_object($qbrg)){
		
				$baris++;
				$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo"
		<tr class='$kolom'>
			<td align='right'>$baris.</td>
			<td>$dbrg->id_brg</td>
			<td>$dbrg->nm_brg</td>
			<td align='right'>
				<span class='mu'>Rp. </span>". number_format($dbrg->hrg_beli, 0,',','.')."
			</td>
			<td align='right'>$dbrg->stok</td>
		</tr>
		
		";
			}//penutup while($dbrg=mysql_fetch_object($qbrg))
		}//while($dsem=mysql_fetch_object($qsem))

	}
	else{ //sudah memilih supplier dan menampilkan data pemesanan berdasarkan id supplier
		$id_sup=$_GET['id_sup'];
		$qdetail=mysql_query("SELECT * FROM br_pembelian_detail WHERE no_pes='$nopes' AND id_sup='$id_sup'");
	
		if(mysql_num_rows($qdetail)>0){ //jika sudah melakukan pemesanan
			echo "
		<br>
		<label>Selesaikan pemesanan barang</label>
		<tr>	
			<th width='5px'>No.</th>
			<th width='100px'>ID / Kode Barang</th>
			<th >Nama Barang</th>
			<th width='100px'>Harga</th>
			<th width='80px'>Jumlah Pesan</th>
			<th width='100px'>Total</th>
		</tr>";
		
			while($ddetail=mysql_fetch_object($qdetail)){
				$baris++;
				$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				$qbrg2=mysql_query("SELECT * FROM br_data WHERE id_brg='$ddetail->id_brg' AND id_sup='$ddetail->id_sup'");
				$dbrg2=mysql_fetch_object($qbrg2);
				$nm_brg=$dbrg2->nm_brg;
		
			echo"
		<tr class='$kolom'>
			<td align='right'>$baris.</td>
			<td align='center'>$ddetail->id_brg</td>
			<td>$nm_brg</td>
			<td align='right'><span class='mu'>Rp. </span>". number_format($ddetail->hrg_brg, 0,',','.') ."</td>
			<td align='right'>$ddetail->jml_brg</td>
			<td align='right'><span class='mu'>Rp. </span>". number_format($ddetail->total, 0,',','.') ."</td>
		</tr>
		";
			}//penutup while($ddetail=mysql_fetch_object($qdetail)){
			
			$q= mysql_query("SELECT SUM( total ) AS total , SUM(jml_brg) AS jml FROM  br_pembelian_detail WHERE no_pes LIKE '%$nopes%'");
			$d=mysql_fetch_object($q);
			echo"
		<tr>
			<td colspan='4' align='right'>Total</td>
			<td align='right'>$d->jml</td>
			<td align='right'><span class='mu'>Rp. </span>". number_format($d->total, 0,',','.') ."</td>
		</tr>
		
		";
		}//penutup if(mysql_num_rows($qdetail)>0)
		else{ // belum melakunan pemesanan barang
	
		echo "
		<br>
		<label>Tindak lanjuti pemesanan</label>
		<tr>
			<th width='5px'>No.</th>
			<th width='100px'>ID / Kode Barang</th>
			<th >Nama Barang</th>
			<th width='20px'>Stok</th>
			<th width='80px'>Harga</th>
			<th width='50px'>Jumlah Pesan</th>
		</tr>";
		$qsem=mysql_query("SELECT * FROM sementara WHERE id_sementara='pesan_barang'")or die (mysql_error());
		
		while($dsem=mysql_fetch_object($qsem)){
			$qbrg=mysql_query("SELECT * FROM br_data WHERE id_brg='$dsem->value' AND id_sup='$id_sup'");
				
			while($dbrg=mysql_fetch_object($qbrg)){
			
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			$id_sup=$_GET['id_sup'];
			echo"
		<tr class='$kolom' >
			<td align='right'>$baris.</td>
			<td>$dbrg->id_brg</td>
			<td>$dbrg->nm_brg</td>
			<td align='right'>$dbrg->stok</td>
			<td align='right'>
				<span class='mu'>Rp. </span>". number_format($dbrg->hrg_beli, 0,',','.')."
			</td>
			<td align='right'>
				<input type='number' class='text' name='jml_brg[]' id='jml_brg' size='2' maxlength='3'>
			</td>
			
			<input type='hidden' name='id_brg[]' id='id_brg' value='$dbrg->id_brg'>
			<input type='hidden' name='no_pesan' value='$nopes'>
			<input type='hidden' name='hrg_brg[]' value='$dbrg->hrg_beli'>
			<input type='hidden' name='id_sup' value='$id_sup'>
		</tr>
		
			";
			}//penutup while($dbrg=mysql_fetch_object($qbrg))
		}//penutup while($dsem=mysql_fetch_object($qsem))
		if(mysql_num_rows($qbrg)>0){
			echo"
			<tr>
				<td colspan='6' align='right' class='alat' >	
					<input type='submit' value='Pesan' name='pesan_brg' class='simpan' id='sendiri'>
				</td>
			</tr>";
		}
		else{
			echo"
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>";
		}
		}//penutup else if(mysql_num_rows($qdetail)>0)
	}
	echo"
</table>
</form>
</div>";

?>

