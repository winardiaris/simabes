<?php
$ply = new pelayanan();
echo '<div class="konten">';


//bagian mekanik
if($_GET['id']==0  && !empty($_GET['no_wo'])){
	
	$lokasi		="Work Order (cont) ";
	$hari_ini 	= date("Y-m-d");
	
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

// ---
		$no_wo = $_GET['no_wo'];

		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:2:Membuka";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
//--
	echo'
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="wo" onsubmit="return validasi_transaksi()">
		<div class="alat">';
			if(count($ply->cek_pelayanan($no_struk,'1'))>0){
				echo "
				<input type='submit' class='simpan' id='kiri' name='simpan_wo_dua' value='Simpan'>
				<input name='batal' type='button'  value='Batal' class='batal' id='kanan' onclick='history.back();'>";
			}
			else{
				echo'
				<input name="batal" type="button"  value="Batal" class="batal" id="sendiri" onclick="history.back();">';
			}
				echo'
				<input type="hidden" name="no_struk" value="'.$no_struk.'"> <!-- di sembunyikan -->
				<input type="hidden" name="no_wo" value="'.$no_wo.'"> <!-- di sembunyikan -->
				<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
		</div>
		
		<table cellspacing="0" cellpadding="5" border="0" class="table" >
			<tr>
				<td width="120px"><label>No Struk</label></td><td width="10px">:</td><td>'.$no_struk.'</td>
				<!-- -->
				<td width="120px"><label>Jenis Kendaraan</label></td><td width="10px">:</td><td>'.$ply->tampil_wo2('jns_kendaraan',$no_wo).'</td>
			</tr>
			<tr>
				<td><label>No Work Order</label></td><td>:</td><td>'.$no_wo.'</td>
				<!-- -->
				<td><label>No Polisi</label></td><td>:</td><td>'.$ply->tampil_wo2('no_polisi',$no_wo).'</td>
			</tr>
			<tr>
				<td><label>ID Pelanggan</label></td><td>:</td><td>'.$ply->tampil_wo2('id_plg',$no_wo).'</td>
				<!-- -->
				<td><label>No Mesin</label></td><td>:</td><td>'.$ply->tampil_wo2('no_mesin',$no_wo).'</td></tr>
			<tr>
				<td><label>Nama Pelanggan</label></td><td>:</td><td>'.$ply->tampil_wo2('nm_plg',$no_wo).'</td>
				<!-- -->
				<td><label>Mekanik *</label></td><td>:</td>
				<td>';
				if($_SESSION['kel_id'] == 5){
					echo'<input type="text" name="id_peg" class="text" value="'.$_SESSION['id'].'" readonly="">';
				}
				else{
				echo'
					<input list="cari_peg" name="id_peg" class="text" size="30" maxlength="20" placeholder="ID Pegawai / Nama Pegawai">
					<datalist id="cari_peg">';		
					$tampil = $ply->ambil_pegawai();
					foreach($tampil as $data){
					echo '<option value="'.$data['id_peg'].'">'.$data['nm_peg'].'</option>';
					}
					echo'	
					</datalist>';
				}
				echo'
				</td>
			</tr>
			<tr>
				<td valign="top"><label>Keluhan Pelanggan</label></td><td valign="top">:</td><td><textarea cols="50" rows="4" name="keluhan" readonly="">'.$ply->tampil_wo2('keluhan',$no_wo).'</textarea></td>
				<td valign="top"><label>Saran Mekanik*</label></td><td valign="top">:</td><td><textarea cols="50" rows="4" name="saran"></textarea></td>
			</tr>
	</table>
	</form>
	</div>';
	
	echo'
	<div class="konten2">
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" >
		<input type="hidden" name="no_struk"   value="'.$no_struk.'">
		<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
		<table class="table" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td>
					<label class="bold">Pelayanan</label><br/>
					<input list="id_kt_ply" name="id_kt_ply" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Pelayanan atau Nama Pelayanan">
					<datalist id="id_kt_ply">';
					$tampil = $ply->ambil_kt_pelayanan();
					foreach($tampil as $data){
						echo '<option value="'.$data['id_kt_ply'].'">'.$data['nm_kt_ply'].'</option>';
					}
					echo'
					</datalist>
					<input type="submit" name="tmbh_ply" value="Tambah Pelayanan" class="tambah" id="sendiri" onclick="return validasi_tambah_ply()">
				</td>
				<!--  -->
				<td>
					<label class="bold">Barang / Suku cadang</label><br/>
					<input list="id_brg" name="id_brg" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Barang | Kode Barang | Nama Barang">
					<datalist id="id_brg">';
						$tampil = $ply->ambil_brg();
						foreach($tampil as $data){
							echo '<option value="'.$data['id_brg'].'">'.$data['nm_brg'].'</option>';
							echo '<option value="'.$data['id_brg'].'">'.$data['kode_brg'].'</option>';
						}
					echo'
					</datalist>
					<input type="number" name="jml_brg" class="text" size="10" maxlength="4" autocomplete="off" placeholder="Jumlah Beli">
					<input type="submit" name="tmbh_brg" value="Tambah Barang" class="tambah" id="sendiri" onclick="return validasi_tambah_brg()">
				</td>
			</tr>
		</table>
		<table class="table" cellspacing="0" cellpadding="5" border="0">
			<tr id="th">
				<th width="10px">No</th><th align="center" width="10px">Hapus</th><th width="150px">ID</th><th>Nama Barang / Jenis Pelayanan</th><th width="20px">Jumlah</th><th width="80px">Harga Satuan</th><th width="100px">Total</th>
			</tr>';
		$baris=0;
		//---- buat pelayanan
		$tampil_detail = $ply->ambil_ply_detail($no_struk);
		if(count($tampil_detail) >0){	
			foreach($tampil_detail as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
			 	<td align='center'><a href='?mod=".$_GET['mod']."&h=hapus2&id_kt_ply=".$data['id_kt_ply']."&no_struk=$no_struk'  title='Menghapus data pelayanan' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data['id_kt_ply'] ."</td>
				<td>". $data['nm_kt_ply'] ."</td>
				<td></td>
				<td></td>
				<td align='right' ><span class='mu'>Rp. </span>". number_format($data['biaya'], 0,',','.') ."</td>
			</tr>";
			}
		}
		
		//---- buat barang
		$tampil_ply_penjualan = $ply->ambil_ply_penjualan($no_struk);
		if(count($tampil_ply_penjualan) > 0){	
			foreach($tampil_ply_penjualan as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				
			
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
				<td align='center'><a href='?mod=".$_GET['mod']."&h=hapus&id_brg=".$data['id_brg']."&no_struk=$no_struk&jml=".$data['jml_brg']."' title='Menghapus data barang' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data['id_brg']."</td>
				<td>". $data['nm_brg'] ."</td>
				<td align='right'>". $data['jml_brg']."</td>
				<td align='right'>". number_format($data['hrg_jual'], 0,',','.') ."</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($data['total'], 0,',','.') ."</td>
			</tr>";
			}
		}
		else{	
			echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td align='right'>0</td><td align='right'>0</td><td align='right'>0</td></tr>";
		}
		echo "
		</table>
	</form>
	</div>";
	
}
elseif($_GET['id']==1  && !empty($_GET['no_wo'])){
	$no_wo 		= $_GET['no_wo'];
	$no_struk = $ply->ambil_no_struk('no_struk',$no_wo);
	$lokasi		="Work Order (cont) ";
	$hari_ini 	= date("Y-m-d");
	
	//log
	$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
	$log_pesan="A:2:Membuka";$log_waktu = $sekarang;
	$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	
	if($_SESSION['kel_id']==5){
		// cek untuk mekanik yang menangani
		$id_peg = $_SESSION['nm_pengguna'];
		$cek = mysql_query("SELECT id_peg FROM ply_wo WHERE no_wo='$no_wo'") or die (mysql_error());
		$datacek = mysql_fetch_object($cek);
		
		if($id_peg != md5($datacek->id_peg)){
			echo "<script type='text/javascript'> alert('Bukan kerjaan anda');history.back();</script>";
		}
	}
		
		
//--
	echo'
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="wo" onsubmit="return validasi_transaksi();">
		<div class="alat">';
			if(count($ply->cek_pelayanan($no_struk,""))>0){
				echo "
				<input type='submit' class='simpan' id='kiri' name='perbaharui_wo' value='Simpan'>
				<input name='batal' type='button'  value='Batal' class='batal' id='kanan' onclick='history.back()'>
				<input type='checkbox' name='selesai' id='selesai' value='2'><label for='selesai'>Selesai </label>
				";
			}
			else{
				echo'
				<input name="batal" type="button"  value="Batal" class="batal" id="sendiri" onclick="history.back()">';
			}
				echo'
				<input type="hidden" name="no_struk" value="'.$no_struk.'"> <!-- di sembunyikan -->
				<input type="hidden" name="no_wo" value="'.$no_wo.'"> <!-- di sembunyikan -->
				<input type="hidden" name="id" value="'.$_GET['id'].'"> <!-- di sembunyikan -->
				<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
		</div>
		
		<table cellspacing="0" cellpadding="5" border="0" class="table" >
			<tr>
				<td width="120px"><label>No Struk</label></td><td width="10px">:</td><td width="300px">'.$no_struk.'</td>
				<!-- -->
				<td width="120px"><label>Jenis Kendaraan</label></td><td width="10px">:</td><td>'.$ply->tampil_wo2('jns_kendaraan',$no_wo).'</td>
			</tr>
			<tr>
				<td><label>No Work Order</label></td><td>:</td><td>'.$no_wo.'</td>
				<!-- -->
				<td><label>No Polisi</label></td><td>:</td><td>'.$ply->tampil_wo2('no_polisi',$no_wo).'</td>
			</tr>
			<tr>
				<td><label>ID Pelanggan</label></td><td>:</td><td>'.$ply->tampil_wo2('id_plg',$no_wo).'</td>
				<!-- -->
				<td><label>No Mesin</label></td><td>:</td><td>'.$ply->tampil_wo2('no_mesin',$no_wo).'</td>
			</tr>
			<tr>
				<td><label>Nama Pelanggan</label></td><td>:</td><td>'.$ply->tampil_wo2('nm_plg',$no_wo).'</td>
				<!-- -->
				<td><label>Mekanik</label></td>	<td>:</td><td>'.$ply->tampil_wo2('id_peg',$no_wo).'<input type="hidden" name="id_peg" value="'.$ply->tampil_wo2('id_peg',$no_wo).'"></td>
			</tr>
			<tr>
				<td valign="top"><label>Keluhan Pelanggan</label></td><td valign="top">:</td><td valign="top">'.$ply->tampil_wo2('keluhan',$no_wo).'</td>
				<td valign="top"><label>Saran Mekanik</label></td><td valign="top">:</td><td><textarea cols="50" rows="4" name="saran">'.$ply->tampil_wo2('saran',$no_wo).'</textarea></td>
			</tr>
	</table>
	</form>
	</div>';
	
	echo'
	<div class="konten2">
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" >
		<input type="hidden" name="no_struk"  size="10" maxlength="4" value="'.$no_struk.'">
		<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
		<table class="table" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td>
					<label class="bold">Pelayanan</label><br/>
					<input list="id_kt_ply" name="id_kt_ply" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Pelayanan atau Nama Pelayanan">
					<datalist id="id_kt_ply">';
						$tampil = $ply->ambil_kt_pelayanan();
						foreach($tampil as $data){
						echo '<option value="'.$data['id_kt_ply'].'">'.$data['nm_kt_ply'].'</option>';
						}
						echo'
					</datalist>
					<input type="submit" name="tmbh_ply" value="Tambah Pelayanan" class="tambah" id="sendiri" onclick="return validasi_tambah_ply();">
				</td>
				<!--  -->
				<td>
					<label class="bold">Barang / Suku cadang</label><br/>
				<input list="id_brg" name="id_brg" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Barang | Kode Barang | Nama Barang">
					<datalist id="id_brg">';
						$tampil = $ply->ambil_brg();
						foreach($tampil as $data){
							echo '<option value="'.$data['id_brg'].'">'.$data['nm_brg'].'</option>';
							echo '<option value="'.$data['id_brg'].'">'.$data['kode_brg'].'</option>';
						}
					echo'
					</datalist>
					<input type="number" name="jml_brg" class="text" size="10" maxlength="4" autocomplete="off" placeholder="Jumlah Beli">
					<input type="submit" name="tmbh_brg" value="Tambah Barang" class="tambah" id="sendiri" onclick="return validasi_tambah_brg()">
				</td>
			</tr>
		</table>
		<table class="table" cellspacing="0" cellpadding="5" border="0">
			<tr id="th">
				<th width="10px">No</th><th align="center" width="10px">Hapus</th><th width="150px">ID</th><th>Nama Barang / Jenis Pelayanan</th><th width="20px">Jumlah</th><th width="80px">Harga Satuan</th><th width="100px">Total</th>
			</tr>';
		$baris=0;
		//---- buat pelayanan
		$tampil_detail = $ply->ambil_ply_detail($no_struk);
		if(count($tampil_detail) >0){	
			foreach($tampil_detail as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
			 	<td align='center'><a href='?mod=".$_GET['mod']."&h=hapus2&id_kt_ply=".$data['id_kt_ply']."&no_struk=$no_struk'  title='Menghapus data pelayanan' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data['id_kt_ply'] ."</td>
				<td>". $data['nm_kt_ply'] ."</td>
				<td></td>
				<td></td>
				<td align='right' ><span class='mu'>Rp. </span>". number_format($data['biaya'], 0,',','.') ."</td>
			</tr>";
			}
		}
		
		//---- buat barang
		$tampil_ply_penjualan = $ply->ambil_ply_penjualan($no_struk);
		if(count($tampil_ply_penjualan) > 0){	
			foreach($tampil_ply_penjualan as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
				<td align='center'><a href='?mod=".$_GET['mod']."&h=hapus&id_brg=".$data['id_brg']."&no_struk=$no_struk&jml=".$data['jml_brg']."' title='Menghapus data barang' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data['id_brg']."</td>
				<td>". $data['nm_brg'] ."</td>
				<td align='right'>". $data['jml_brg']."</td>
				<td align='right'>". number_format($data['hrg_jual'], 0,',','.') ."</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($data['total'], 0,',','.') ."</td>
			</tr>";
			}
		}
		else{	
			echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td align='right'>0</td><td align='right'>0</td><td align='right'>0</td></tr>";
		}
		echo "
		</table>
	</form>
	</div>";
	}
	
// bagian pelayanan
elseif($_GET['id']==2  && !empty($_GET['no_wo'])){
	$no_wo = $_GET['no_wo'];
	$no_struk = $ply->ambil_no_struk('no_struk',$no_wo);
	$lokasi		="Transaksi Pelayanan";
	$hari_ini 	= date("Y-m-d");
	
	//log
	$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
	$log_pesan="A:2:Membuka";$log_waktu = $sekarang;
	$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	
	//bayar
	$biaya = $ply->ambil_jml_ply('biaya',$no_struk);
	$tot_bayar_brg = $ply->ambil_jml_brg('tot_bayar_brg',$no_struk);
	$tot_bayar = $biaya + $tot_bayar_brg;
		
//--
	echo'
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="wo" >
		<div class="alat">';
			if(count($ply->cek_pelayanan($no_struk,""))>0){
				echo "
				<input type='submit' class='simpan' id='kiri' name='ply_simpan' value='Selesai Transaksi'>
				<input name='batal' type='button'  value='Batal' class='batal' id='kanan' onclick='history.back()'>
				<input type='checkbox' name='selesai' id='selesai' value='3'><label for='selesai'>Selesai </label>
				";
			}
			else{
				echo'<input name="batal" type="button"  value="Batal" class="batal" id="sendiri" onclick="history.back()">';
			}
				echo'
				<input type="hidden" name="no_struk" value="'.$no_struk.'"> <!-- di sembunyikan -->
				<input type="hidden" name="no_wo" value="'.$no_wo.'"> <!-- di sembunyikan -->
				<input type="hidden" name="id" value="'.$_GET['id'].'"> <!-- di sembunyikan -->
				<input type="hidden" name="saran" value="'.$ply->tampil_wo2('saran',$no_wo).'"> <!-- di sembunyikan -->
				<input type="hidden" name="id_pengguna" value="'.$_SESSION['id_pengguna'].'"> <!-- di sembunyikan -->
				<input type="hidden" name="tot_bayar" value="'.$tot_bayar.'"> <!-- di sembunyikan -->
				<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
		</div>
		
		<table cellspacing="0" cellpadding="5" border="0" class="table" >
			<tr>
				<td width="120px"><label>No Struk</label></td><td width="10px">:</td><td width="300px">'.$no_struk.'</td>
				<!-- -->
				<td width="120px"><label>Jenis Kendaraan</label></td><td width="10px">:</td><td>'.$ply->tampil_wo2('jns_kendaraan',$no_wo).'</td>
			</tr>
			<tr>
				<td><label>No Work Order</label></td><td>:</td><td>'.$no_wo.'</td>
				<!-- -->
				<td><label>No Polisi</label></td><td>:</td><td>'.$ply->tampil_wo2('no_polisi',$no_wo).'</td>
			</tr>
			<tr>
				<td><label>ID Pelanggan</label></td><td>:</td><td>'.$ply->tampil_wo2('id_plg',$no_wo).'</td>
				<!-- -->
				<td><label>No Mesin</label></td><td>:</td><td>'.$ply->tampil_wo2('no_mesin',$no_wo).'</td>
			</tr>
			<tr>
				<td><label>Nama Pelanggan</label></td><td>:</td><td>'.$ply->tampil_wo2('nm_plg',$no_wo).'</td>
				<!-- -->
				<td><label>Mekanik</label></td><td>:</td><td>'.$ply->tampil_wo2('id_peg',$no_wo).'</td>
			</tr>
			<tr>
				<td valign="top"><label>Keluhan Pelanggan</label></td><td valign="top">:</td><td valign="top">'.$ply->tampil_wo2('keluhan',$no_wo).'</td>
				<td valign="top"><label>Saran Mekanik</label></td><td valign="top">:</td><td>'.$ply->tampil_wo2('saran',$no_wo).'</td>
			</tr>
	</table>
	</form>
	</div>';
	
	echo'
	<div class="konten2">
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" >
		<input type="hidden" name="no_struk"  size="10" maxlength="4" value="'.$no_struk.'">
		<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
		<table class="table" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td>
					<label class="bold">Pelayanan</label><br/>
					<input list="id_kt_ply" name="id_kt_ply" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Pelayanan atau Nama Pelayanan">
					<datalist id="id_kt_ply">';
						$tampil = $ply->ambil_kt_pelayanan();
						foreach($tampil as $data){
						echo '<option value="'.$data['id_kt_ply'].'">'.$data['nm_kt_ply'].'</option>';
						}
						echo'
					</datalist>
					<input type="submit" name="tmbh_ply" value="Tambah Pelayanan" class="tambah" id="sendiri" onclick="return validasi_tambah_ply();">
				</td>
				<!--  -->
				<td>
					<label class="bold">Barang / Suku cadang</label><br/>
				<input list="id_brg" name="id_brg" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Barang | Kode Barang | Nama Barang">
					<datalist id="id_brg">';
						$tampil = $ply->ambil_brg();
						foreach($tampil as $data){
							echo '<option value="'.$data['id_brg'].'">'.$data['nm_brg'].'</option>';
							echo '<option value="'.$data['id_brg'].'">'.$data['kode_brg'].'</option>';
						}
					echo'
					</datalist>
					<input type="number" name="jml_brg" class="text" size="10" maxlength="4" autocomplete="off" placeholder="Jumlah Beli">
					<input type="submit" name="tmbh_brg" value="Tambah Barang" class="tambah" id="sendiri" onclick="return validasi_tambah_brg();">
					
				</td>
			</tr>
		</table>
		<table class="table" cellspacing="0" cellpadding="5" border="0">
			<tr id="th">
				<th width="10px">No</th><th align="center" width="10px">Hapus</th><th width="150px">ID</th><th>Nama Barang / Jenis Pelayanan</th><th width="20px">Jumlah</th><th width="80px">Harga Satuan</th><th width="100px">Total</th>
			</tr>';
		$baris=0;
		//---- buat pelayanan
		$tampil_detail = $ply->ambil_ply_detail($no_struk);
		if(count($tampil_detail) >0){	
			foreach($tampil_detail as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
			 	<td align='center'><a href='?mod=".$_GET['mod']."&h=hapus2&id_kt_ply=".$data['id_kt_ply']."&no_struk=$no_struk'  title='Menghapus data pelayanan' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data['id_kt_ply'] ."</td>
				<td>". $data['nm_kt_ply'] ."</td>
				<td></td>
				<td></td>
				<td align='right' ><span class='mu'>Rp. </span>". number_format($data['biaya'], 0,',','.') ."</td>
			</tr>";
			}
		}
		
		//---- buat barang
		$tampil_ply_penjualan = $ply->ambil_ply_penjualan($no_struk);
		if(count($tampil_ply_penjualan) > 0){	
			foreach($tampil_ply_penjualan as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
				<td align='center'><a href='?mod=".$_GET['mod']."&h=hapus&id_brg=".$data['id_brg']."&no_struk=$no_struk&jml=".$data['jml_brg']."' title='Menghapus data barang' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data['id_brg']."</td>
				<td>". $data['nm_brg'] ."</td>
				<td align='right'>". $data['jml_brg']."</td>
				<td align='right'>". number_format($data['hrg_jual'], 0,',','.') ."</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($data['total'], 0,',','.') ."</td>
			</tr>";
			}
		}
		else{	
			echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td align='right'>0</td><td align='right'>0</td><td align='right'>0</td></tr>";
		}		
		echo "
			<tr class='total'><td colspan='4' align='right'>Total</td><td align='right'>". $ply->ambil_jml_brg('tot_brg',$no_struk) ."</td>	<td></td><td align='right'><span class='mu'>Rp. </span>". number_format($tot_bayar, 0,',','.') ."</td></tr>
		</table>
	</form>
	</div>";
}

elseif($_GET['id']=="bayar"  && !empty($_GET['no_struk'])){
	$no_struk=$_GET['no_struk'];
	$a = mysql_query("SELECT total_pembayaran FROM ply_ WHERE no_struk='".$no_struk."'") or die (mysql_error());
	$data = mysql_fetch_object($a);
	$lokasi ="Pembayaran Transaksi ".$no_struk;

	//log
	$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
	$log_pesan="A:2:Membuka";$log_waktu = $sekarang;
	$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	
	echo'
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="pembayaran">
	<table class="table">
		<tr>
			<td>
				<label>Total Pembayaran :</label><br>
				<h1><span class="mu">Rp.  </span>'. number_format($data->total_pembayaran, 0,',','.') .',-</h1>
				<input type="hidden" name="total" id="total" value="'.$data->total_pembayaran.'">
				<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
			</td>
		</tr>
		<tr>
			<td>
				<label>Uang Bayar : </label><br>
				<input type="text" name="bayar" id="bayar" onkeyup="hitung();">
			</td>
		</tr>
		<tr>
			<td>
				<label>Uang Kembali : </label><br>
				<h2 >Rp. <span id="kembali"></span>,-</h2>
			</td>
		</tr>
	</table>
		<div class="alat">
			<input type="submit" name="ply_selesai" value="Simpan" class="simpan" id="sendiri" >
			<input type="hidden" name="no_struk" value="'.$no_struk.'">
		</div>
	</form>';
}
echo '</div>';// penutup div konten

?>
<script type="text/javascript">
function hitung(){
	var total = document.getElementById("total").value;
	var bayar = document.getElementById("bayar").value;
	kembali = bayar - total;
	document.getElementById("kembali").innerHTML = kembali;
}	
</script>

