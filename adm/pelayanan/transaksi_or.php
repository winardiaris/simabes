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
	$lokasi		="Work Order";
	$hari_ini 	= date("Y-m-d");
	
	require ("samping.php");
	$id_plg		=$_GET['id_plg'];
	$qry		=mysql_query("select * from dt_pelanggan where id_plg='$id_plg' limit 1");
	$data		=mysql_fetch_object($qry);
	
// ----- awal kode otomatis ----- //
		$a="TR";
		$b=date("ymd");
		$qry = "SELECT max(no_struk) as maxID FROM ply_ WHERE no_struk LIKE '%$a/$b%'";
		$hasil = mysql_query($qry);
		$kode = mysql_fetch_array($hasil);
		$idMax = $kode['maxID'];
		$noUrut = (int) substr($idMax, 13, 4);
		$noUrut++;
		$no_struk = "ST/".$a ."/". $b . "/". sprintf("%04s", $noUrut);
// ----- akhir kode otomatis ----- //
// ----- awal jumlah 
		$a = mysql_query("SELECT SUM( IF( no_struk LIKE  '%$no_struk%', jml_brg, 0 ) ) AS tot_brg".
						", SUM( IF( no_struk LIKE  '%$no_struk%', total, 0 ) ) AS tot_bayar_brg ".
						"FROM  ply_penjualan_detail");
		$b = mysql_query("SELECT SUM( biaya ) AS biaya FROM  ply_detail1 WHERE no_struk LIKE '%$no_struk%'");
	
		$data2=mysql_fetch_array($a);
		$data3=mysql_fetch_object($b);
		$tot_brg = $data2['tot_brg'];
		
		$biaya = $data3->biaya;
		$tot_bayar_brg = $data2['tot_bayar_brg'];
		$tot_bayar = $biaya + $tot_bayar_brg;
		
// ----- uang bayar ---- //
	$a = "SELECT value FROM sementara where id_sementara='$no_struk' LIMIT 1";
	$qry_ = mysql_query($a) or die(mysql_error());
		if(mysql_num_rows($qry_)>0){
			$data_ = mysql_fetch_object($qry_);
			$uang_bayar = $data_->value;
		}
		else{
			$uang_bayar = 0;
		}
//
		$qcek=mysql_query("SELECT id_kt_ply FROM  ply_detail1 WHERE no_struk LIKE '%$no_struk%'") or die(mysql_error());
		
			
	echo'
	<div class="konten">
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod=f_pelayanan"  method="post" enctype="multipart/form-data"  name="ply_transaksi" >
		<div class="alat">';
			if($ada=mysql_num_rows($qcek)>0){
				echo "
				<input type='submit' class='simpan' id='kiri' name='ply_simpan' value='Selesai Transaksi'>
				<input name='ply_batal' type='submit'  value='Batal' class='batal' id='kanan'>";
			}
			else{
				echo'
				<input name="ply_batal" type="submit"  value="Batal" class="batal" id="sendiri">';
			}
					echo'
		</div>
		<table cellspacing="0" cellpadding="2" border="0" class="table" >
			<tr>
				<td width="120px"><label>No Faktur</label></td>
				<td width="5px">:</td>
				<td>'.$no_struk.'</td>
				<!-- -->
				<td width="120px"><label>Tanggal Transaksi</label></td>
				<td width="5px">:</td>
				<td><input type="text" class="text" name="tgl_trans" id="tgl_trans" value="'.$hari_ini.'"></td>
				<!-- -->
				<td  rowspan="5" align="center" valign="top">
					<img class="photo" src="'. $data->photo_plg.'" alt="'. $data->nm_plg.'" width="100" border="1"/><br/>
				</td>
			</tr>
			<tr>
				<td ><label>ID Pelanggan</label></td>
				<td >:</td>
				<td >'.$id_plg.'</td>
				<!-- -->
				<td ><label>No. Polisi *</label></td>
				<td >:</td>
				<td><input type="text" class="text" maxlength="10" name="no_polisi" placeholder="Isi no polisi kendaraan"></td>
			</tr>
			<tr>
				<td><label>Nama Pelanggan</label></td>
				<td>:</td>
				<td>'.$data->nm_plg.'</td>
				<!-- -->
				<td><label>No. Mesin</label></td>
				<td>:</td>
				<td><input type="text" class="text" name="no_mesin" placeholder="Isi no mesin kendaraan"></td>
			</tr>
			<tr>
				<td><label>No Telepon/HP</label></td>
				<td>:</td>
				<td>'.$data->telp_plg.'</td>
				<!-- -->
				<td><label>Jenis Kendaraan</label></td>
				<td>:</td>
				<td><input type="text" class="text" name="jenis_kendaraan" placeholder="Isi jenis kendaraan"></td>
			</tr>
			<tr>
				<td><label>Alamat</label></td>
				<td>:</td>
				<td>'.$data->almt_plg.'</td>
				<!-- -->
				<td><label>KM terakhir</label></td>
				<td>:</td>
				<td><input type="text" class="text" name="km_terakhir" placeholder="Isi KM terakhir"></td>
			</tr>
			<tr>
				<td valign="top"><label>Keluhan Pelanggan</label></td>
				<td valign="top">:</td>
				<td><textarea cols="50" rows="2" name="keluhan" placeholder="Isikan keluhan pelanggan"></textarea></td>
				<!-- -->
				<td valign="top"><label>Saran Mekanik</label></td>
				<td valign="top">:</td>
				<td colspan="2"><textarea cols="50" rows="2" name="saran" placeholder="Isikan saran untuk pelanggan"></textarea></td>
			</tr>
			<tr>
				<td><label>Mekanik *</label></td>
				<td>:</td>
				<td>
					<input list="cari_peg" name="peg" class="text" size="30" maxlength="20" placeholder="ID Pegawai / Nama Pegawai">
					<datalist id="cari_peg">';
						$q = "SELECT kel_id FROM kel_pengguna WHERE nm_kel LIKE '%mekanik%'";
						$qq = mysql_query($q) or die(mysql_error());
						$qqq = mysql_fetch_object($qq);
						$kel_id = $qqq->kel_id;
					
						$qpeg="SELECT * FROM dt_pegawai WHERE kel_id='$kel_id' ";
						$peg=mysql_query($qpeg) or die (mysql_error());
						while($data=mysql_fetch_object($peg)){
							echo "<option value=\"$data->id_peg\">$data->nm_peg</option>";
						}
					echo'	
					</datalist>
				</td>
				<td><label>Petugas</label></td>
				<td>:</td>
				<td colspan="2">
					<input type="hidden" name="id_pengguna" value="'.$_SESSION['id_pengguna'].'">
					<input type="text" class="text" name="petugas" value="'.$_SESSION['id_pengguna'] ." | ". $_SESSION['nama_asli'].'" readonly=""></td>
			</tr>
		</table>
	</form>
	</div>';
	
	echo'
	<div class="konten2">
	<form class="form1" action="?mod=f_pelayanan"  method="post" enctype="multipart/form-data"  name="ply_transaksi_detail" >
		<input type="hidden" name="no_struk"  size="10" maxlength="4" value="'.$no_struk.'">
		<table class="table" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td>
					<label class="bold">Pelayanan</label><br/>
					<input list="cari_pel" name="cari_pel" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Pelayanan atau Nama Pelayanan">
					<datalist id="cari_pel">';
						$qkat="SELECT * FROM ply_kategori";
						$kat=mysql_query($qkat) or die (mysql_error());
						
						while($data=mysql_fetch_object($kat)){//perulangan menampilkan data
							echo "
							<option value=\"$data->id_kt_ply\">$data->nm_kt_ply</option>
							<option value=\"$data->nm_kt_ply\">$data->nm_kt_ply</option>
							";
						}
						echo'
					</datalist>
					<input type="submit" name="tmbh_pel" value="Tambah Pelayanan" class="tambah" id="sendiri">
				</td>
				<!--  -->
				<td>
					<label class="bold">Barang / Suku cadang</label><br/>
				<input list="cari_brg" name="cari_brg" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Barang | Kode Barang | Nama Barang">
					<datalist id="cari_brg">';
						$qkat="SELECT * FROM br_data";
						$kat=mysql_query($qkat) or die (mysql_error());
						while($data=mysql_fetch_object($kat)){//perulangan menampilkan data
							echo "<option value=\"$data->id_brg\">$data->nm_brg</option>";
							echo "<option value=\"$data->kode_brg\">$data->nm_brg</option>";
							echo "<option value=\"$data->nm_brg\"></option>";
						}
					echo'
					</datalist>
					<input type="number" name="jml_brg" class="text" size="10" maxlength="4" autocomplete="off" placeholder="Jumlah Beli">
					<input type="submit" name="tmbh_brg" value="Tambah Barang" class="tambah" id="sendiri">
				</td>
			</tr>
		</table>
		<table class="table" cellspacing="0" cellpadding="5" border="0">
			<tr id="th">
				<th width="10px">No</th>
				<th align="center" width="10px">Hapus</th>
				<th width="150px">ID</th>
				<th>Nama Barang / Jenis Pelayanan</th>
				<th width="20px">Jumlah</th>
				<th width="80px">Harga Satuan</th>
				<th width="100px">Total</th>
			</tr>';
			
		
		$baris=0;
		//---- buat kategori pelayanan
		$q="SELECT * FROM ply_detail1 WHERE no_struk='$no_struk' ORDER BY id_kt_ply ASC ";
		$daf_pel =mysql_query($q) or die (mysql_error());
		
		if(mysql_num_rows($daf_pel)>0){	
			while($data2=mysql_fetch_object($daf_pel)){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
			 	<td align='center'><a href='?mod=hapus2&id_kt_ply=$data2->id_kt_ply&no_struk=$no_struk'  title='Menghapus data pelayanan' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data2->id_kt_ply ."</td>
				<td>". $data2->nm_kt_ply ."</td>
				<td></td>
				<td></td>
				<td align='right' ><span class='mu'>Rp. </span>". number_format($data2->biaya, 0,',','.') ."</td>
			</tr>";
			}
		}
		
		
		
		//---- buat barang
		$qry="SELECT * FROM ply_penjualan_detail WHERE no_struk='$no_struk' ORDER BY id_brg asc ";
		$daftar=mysql_query($qry) or die (mysql_error());
		
		if(mysql_num_rows($daftar)>0){	
			while($data=mysql_fetch_object($daftar)){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
					
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
				<td align='center'><a href='?mod=hapus&id_brg=$data->id_brg&no_struk=$no_struk&jml=$data->jml_brg' title='Menghapus data barang' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data->id_brg ."</td>
				<td>". $data->nm_brg ."</td>
				<td align='right'>". $data->jml_brg."</td>
				<td align='right'>". number_format($data->hrg_brg, 0,',','.') ."</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($data->total, 0,',','.') ."</td>
			</tr>";
			}
		}
		else{	
			echo "
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td align='right'>0</td>
				<td align='right'>0</td>
				<td align='right'>0</td>
			</tr>";
		}
		//--- uang kembali ---//
		$uang_kembali = $uang_bayar - $tot_bayar;
		echo "
			<tr class='total'>
				<td colspan='4' align='right'>Total</td>
				<td align='right'>". $tot_brg ."</td>
				<td></td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($tot_bayar, 0,',','.') ."</td>
			</tr>
			<tr>
				<td colspan='4' align='right'>Uang Bayar</td>
				<td colspan='3><span class='mu'>
					<input type='hidden' name='tot_bayar' value='$tot_bayar'>
					<input type='text' class='text' name='uang_bayar' size='15' maxlength='10'>
					<input type='submit' class='tambah' id='sendiri' value='Hitung' name='hitung'>
				</td>
			</tr>
			<tr>
				<td colspan='4' align='right'>Uang Kembali</td>
				<td colspan='3' align='right'><span class='mu'>Rp. </span>". number_format($uang_kembali, 0,',','.') ."</td>
			</tr>
		</table>
	</form>
	</div>";



?>
