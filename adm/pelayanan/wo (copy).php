<?php
include ("samping.php");
echo '<div class="konten">';


//halaman awal
if (empty($_GET['id']) && empty($_GET['no_wo'])){
	$lokasi="Data Work Order";
	echo '
	<div class="lokasi"><label>'.$lokasi.'</label>
		<div class="kanan2">
			<form action="" method="get" name="fpencarian" id="fpencarian">
			<input name="mod" value="wo" class="btn-pencarian" type="hidden" >
			<input name="cari" value="';if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" id="cari" size="20" maxlength="50" class="text-pencarian" type="text"  placeholder="Pencarian" title=" No. WO | ID Pelanggan | No. Polisi | ID Pegawai" > 
			</form>
		</div>
	
	</div>
	<form class="form1" method="POST" action="?mod=f_pelayanan" enctype="multipart/form-data"  name="wo" >
	<table class="table" cellpadding="5" cellspacing="0" border="0">
	<tr>
		<th width="10px">No.</th>
		<th width="20px">Status</th>
		<th width="130px">No Work Order</th>
		<th width="80px">ID Pelanggan</th>
		<th width="80px">No Polisi</th>
		<th width="200px">Jenis Kendaraan</th>
		<th>Keluhan</th>
		<th width="80px">Mekanik</th>
	</tr>';
	
	$no=0;
	if($_SESSION['kel_id'] == 5){
		$qry = "SELECT * FROM ply_wo  WHERE status='0' OR status='1' ORDER BY no_wo DESC";
	}
	elseif($_SESSION['kel_id'] == 3){
		$qry = "SELECT * FROM ply_wo  WHERE status='2' OR status='3' ORDER BY no_wo DESC";
	}
	elseif(!empty($_GET['cari'])){
		$cari = $_GET['cari'];
		$qry = "SELECT * FROM ply_wo 
				WHERE no_wo='".$cari."' 
				OR id_plg='".$cari."'
				OR no_polisi='".$cari."'
				OR id_peg='".$cari."'
				ORDER BY no_wo DESC";
	}
	else{
		$qry = "SELECT * FROM ply_wo ORDER BY no_wo DESC";
	}
	$a=mysql_query($qry) or die (mysql_error());
	$jml=mysql_num_rows($a);
	if($jml >0){
	while($data=mysql_fetch_object($a)){
		$kolom= ($no%2 == 1)? "kolom-ganjil" : "kolom-genap";
		$no++;
		if($data->status == 0 )
		$img = "0.png";
		elseif($data->status == 1) 
		$img = "1.png";
		elseif ($data->status == 2)
		$img = "2.png";
		else
		$img = "3.png";
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$no.'.</td>
		<td align="center">
			<a href="?mod='.$_GET['mod'].'&h=wo&id='.$data->status.'&no_wo='.$data->no_wo.'">
			<img src="../img/'.$img.'" height="24px" width="24px">
			</a>
		</td>
		<td>'.$data->no_wo.'</td>
		<td>'.$data->id_plg.'</td>
		<td>'.$data->no_polisi.'</td>
		<td>'.$data->jns_kendaraan.'</td>
		<td>'.$data->keluhan.'</td>
		<td>'.$data->id_peg.'</td>
	</tr>';
	}
	}
	else{
	
	echo'
	<tr>
		<td colspan="8">--- tidak ada data --</td>
	</tr>
	';
		
	}
	echo'
	</table>
	</form>';
}

//bagian mekanik
elseif($_GET['id']==0  && !empty($_GET['no_wo'])){
	
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
		
		$qry = "SELECT * FROM ply_wo WHERE no_wo='$no_wo' ";
		$result = mysql_query($qry) or die(mysql_error());
		$data = mysql_fetch_object($result);
		
		$qry2 = "SELECT * FROM dt_pelanggan WHERE id_plg='$data->id_plg' ";
		$result2 = mysql_query($qry2) or die(mysql_error());
		$data2 = mysql_fetch_object($result2);

		$qcek=mysql_query("SELECT id_kt_ply FROM  ply_detail WHERE no_struk LIKE '%$no_struk%'") or die(mysql_error());
//--
	echo'
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod=f_pelayanan"  method="post" enctype="multipart/form-data"  name="wo" >
		<div class="alat">';
			if($ada=mysql_num_rows($qcek)>0){
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
		</div>
		
		<table cellspacing="0" cellpadding="5" border="0" class="table" >
			<tr>
				<td width="120px"><label>No Struk</label></td>
				<td width="10px">:</td>
				<td>'.$no_struk.'</td>
				<!-- -->
				<td width="120px"><label>Jenis Kendaraan</label></td>
				<td width="10px">:</td>
				<td>'.$data->jns_kendaraan.'</td>
			</tr>
			<tr>
				<td><label>No Work Order</label></td>
				<td>:</td>
				<td>'.$no_wo.'</td>
				<!-- -->
				<td><label>No Polisi</label></td>
				<td>:</td>
				<td>'.$data->no_polisi.'</td>
			</tr>
			<tr>
				<td><label>ID Pelanggan</label></td>
				<td>:</td>
				<td>'.$data2->id_plg.'</td>
				<!-- -->
				<td><label>No Mesin</label></td>
				<td>:</td>
				<td>'.$data->no_mesin.'</td>
			</tr>
			<tr>
				<td><label>Nama Pelanggan</label></td>
				<td>:</td>
				<td>'.$data2->nm_plg.'</td>
				<!-- -->
				<td><label>Mekanik *</label></td>
				<td>:</td>
				<td>
					<input list="cari_peg" name="id_peg" class="text" size="30" maxlength="20" placeholder="ID Pegawai / Nama Pegawai">
					<datalist id="cari_peg">';
						$q = "SELECT kel_id FROM kel_pengguna WHERE nm_kel LIKE '%mekanik%'";
						$qq = mysql_query($q) or die(mysql_error());
						$qqq = mysql_fetch_object($qq);
						$kel_id = $qqq->kel_id;
					
						$qpeg="SELECT * FROM dt_pegawai WHERE kel_id='$kel_id' ";
						$peg=mysql_query($qpeg) or die (mysql_error());
						while($datap=mysql_fetch_object($peg)){
							echo "<option value=\"$datap->id_peg\">$datap->nm_peg</option>";
						}
					echo'	
					</datalist>
				</td>
			</tr>
			<tr>
				<td valign="top"><label>Keluhan Pelanggan</label></td>
				<td valign="top">:</td>
				<td><textarea cols="50" rows="4" name="keluhan" readonly="">'.$data->keluhan.'</textarea></td>
				
				<td valign="top"><label>Saran Mekanik</label></td>
				<td valign="top">:</td>
				<td><textarea cols="50" rows="4" name="saran"></textarea></td>
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
						$qbr="SELECT * FROM br_data";
						$br=mysql_query($qbr) or die (mysql_error());
						while($databr=mysql_fetch_object($br)){//perulangan menampilkan data
							echo "<option value=\"$databr->id_brg\">$databr->nm_brg</option>";
							echo "<option value=\"$databr->kode_brg\">$databr->nm_brg</option>";
							echo "<option value=\"$databr->nm_brg\"></option>";
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
		$q="SELECT * FROM ply_detail WHERE no_struk='$no_struk' ORDER BY id_kt_ply ASC ";
		$daf_pel =mysql_query($q) or die (mysql_error());
		
		if(mysql_num_rows($daf_pel)>0){	
			while($data2=mysql_fetch_object($daf_pel)){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			
			$a=mysql_query("SELECT * FROM ply_kategori WHERE id_kt_ply='$data2->id_kt_ply'") or die(mysql_error());
			$b=mysql_fetch_object($a);
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
			 	<td align='center'><a href='?mod=hapus2&id_kt_ply=$data2->id_kt_ply&no_struk=$no_struk'  title='Menghapus data pelayanan' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data2->id_kt_ply ."</td>
				<td>". $b->nm_kt_ply ."</td>
				<td></td>
				<td></td>
				<td align='right' ><span class='mu'>Rp. </span>". number_format($b->biaya, 0,',','.') ."</td>
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
				
			$a=mysql_query("SELECT * FROM br_data WHERE id_brg='$data->id_brg'") or die(mysql_error());
			$b=mysql_fetch_object($a);
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
				<td align='center'><a href='?mod=hapus&id_brg=$data->id_brg&no_struk=$no_struk&jml=$data->jml_brg' title='Menghapus data barang' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data->id_brg ."</td>
				<td>". $b->nm_brg ."</td>
				<td align='right'>". $data->jml_brg."</td>
				<td align='right'>". number_format($b->hrg_jual, 0,',','.') ."</td>
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
		echo "
		</table>
	</form>
	</div>";
	
}
elseif($_GET['id']==1  && !empty($_GET['no_wo'])){
	$no_wo = $_GET['no_wo'];
	$lokasi		="Work Order (cont) ";
	$hari_ini 	= date("Y-m-d");
	
	if($_SESSION['kel_id']==5){
		// cek untuk mekanik yang menangani
		$id_peg = $_SESSION['nm_pengguna'];
		$cek = mysql_query("SELECT id_peg FROM ply_wo WHERE no_wo='$no_wo'") or die (mysql_error());
		$datacek = mysql_fetch_object($cek);
		
		if($id_peg != md5($datacek->id_peg)){
			echo "<script type='text/javascript'> alert('Bukan kerjaan anda');history.back();</script>";
		}
	}
	
	
	$a = mysql_query("SELECT * FROM ply_ WHERE no_wo='$no_wo'")or die(mysql_error());
	$b = mysql_fetch_object($a);
	
	$no_struk = $b->no_struk;
		
		
		$qry = "SELECT * FROM ply_wo WHERE no_wo='$no_wo' ";
		$result = mysql_query($qry) or die(mysql_error());
		$data = mysql_fetch_object($result);
		
		$qry2 = "SELECT * FROM dt_pelanggan WHERE id_plg='$data->id_plg' ";
		$result2 = mysql_query($qry2) or die(mysql_error());
		$data2 = mysql_fetch_object($result2);

		$qcek=mysql_query("SELECT id_kt_ply FROM  ply_detail WHERE no_struk LIKE '%$no_struk%'") or die(mysql_error());
//--
	echo'
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod=f_pelayanan"  method="post" enctype="multipart/form-data"  name="wo" >
		<div class="alat">';
			if($ada=mysql_num_rows($qcek)>0){
				echo "
				<input type='submit' class='simpan' id='kiri' name='update_wo' value='Simpan'>
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
		</div>
		
		<table cellspacing="0" cellpadding="5" border="0" class="table" >
			<tr>
				<td width="120px"><label>No Struk</label></td>
				<td width="10px">:</td>
				<td width="300px">'.$no_struk.'</td>
				<!-- -->
				<td width="120px"><label>Jenis Kendaraan</label></td>
				<td width="10px">:</td>
				<td>'.$data->jns_kendaraan.'</td>
			</tr>
			<tr>
				<td><label>No Work Order</label></td>
				<td>:</td>
				<td>'.$no_wo.'</td>
				<!-- -->
				<td><label>No Polisi</label></td>
				<td>:</td>
				<td>'.$data->no_polisi.'</td>
			</tr>
			<tr>
				<td><label>ID Pelanggan</label></td>
				<td>:</td>
				<td>'.$data2->id_plg.'</td>
				<!-- -->
				<td><label>No Mesin</label></td>
				<td>:</td>
				<td>'.$data->no_mesin.'</td>
			</tr>
			<tr>
				<td><label>Nama Pelanggan</label></td>
				<td>:</td>
				<td>'.$data2->nm_plg.'</td>
				<!-- -->
				<td><label>Mekanik</label></td>
				<td>:</td>
				<td>'.$data->id_peg.'</td>
			</tr>
			<tr>
				<td valign="top"><label>Keluhan Pelanggan</label></td>
				<td valign="top">:</td>
				<td valign="top">'.$data->keluhan.'</td>
				
				<td valign="top"><label>Saran Mekanik</label></td>
				<td valign="top">:</td>
				<td><textarea cols="50" rows="4" name="saran">'.$data->saran.'</textarea></td>
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
						$qbr="SELECT * FROM br_data";
						$br=mysql_query($qbr) or die (mysql_error());
						while($databr=mysql_fetch_object($br)){//perulangan menampilkan data
							echo "<option value=\"$databr->id_brg\">$databr->nm_brg</option>";
							echo "<option value=\"$databr->kode_brg\">$databr->nm_brg</option>";
							echo "<option value=\"$databr->nm_brg\"></option>";
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
		$q="SELECT * FROM ply_detail WHERE no_struk='$no_struk' ORDER BY id_kt_ply ASC ";
		$daf_pel =mysql_query($q) or die (mysql_error());
		
		if(mysql_num_rows($daf_pel)>0){	
			while($data2=mysql_fetch_object($daf_pel)){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			
			$a=mysql_query("SELECT * FROM ply_kategori WHERE id_kt_ply='$data2->id_kt_ply'") or die(mysql_error());
			$b=mysql_fetch_object($a);
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
			 	<td align='center'><a href='?mod=hapus2&id_kt_ply=$data2->id_kt_ply&no_struk=$no_struk'  title='Menghapus data pelayanan' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data2->id_kt_ply ."</td>
				<td>". $b->nm_kt_ply ."</td>
				<td></td>
				<td></td>
				<td align='right' ><span class='mu'>Rp. </span>". number_format($b->biaya, 0,',','.') ."</td>
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
				
			$a=mysql_query("SELECT * FROM br_data WHERE id_brg='$data->id_brg'") or die(mysql_error());
			$b=mysql_fetch_object($a);
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
				<td align='center'><a href='?mod=hapus&id_brg=$data->id_brg&no_struk=$no_struk&jml=$data->jml_brg' title='Menghapus data barang' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data->id_brg ."</td>
				<td>". $b->nm_brg ."</td>
				<td align='right'>". $data->jml_brg."</td>
				<td align='right'>". number_format($b->hrg_jual, 0,',','.') ."</td>
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
		echo "
		</table>
	</form>
	</div>";
	}
	
// bagian pelayanan
elseif($_GET['id']==2  && !empty($_GET['no_wo'])){
	$no_wo = $_GET['no_wo'];
	$lokasi		="Transaksi Pelayanan";
	$hari_ini 	= date("Y-m-d");
		
	$a = mysql_query("SELECT * FROM ply_ WHERE no_wo='$no_wo'")or die(mysql_error());
	$b = mysql_fetch_object($a);
	
	$no_struk = $b->no_struk;
		
		
		$qry = "SELECT * FROM ply_wo WHERE no_wo='$no_wo' ";
		$result = mysql_query($qry) or die(mysql_error());
		$data = mysql_fetch_object($result);
		
		$qry2 = "SELECT * FROM dt_pelanggan WHERE id_plg='$data->id_plg' ";
		$result2 = mysql_query($qry2) or die(mysql_error());
		$dataplg = mysql_fetch_object($result2);

		$qcek=mysql_query("SELECT id_kt_ply FROM  ply_detail WHERE no_struk LIKE '%$no_struk%'") or die(mysql_error());
		
		//bayar
		$z = mysql_query("SELECT SUM( IF( no_struk LIKE  '%$no_struk%', jml_brg, 0 ) ) AS tot_brg".
						", SUM( IF( no_struk LIKE  '%$no_struk%', total, 0 ) ) AS tot_bayar_brg ".
						"FROM  ply_penjualan_detail");
						
		$x = mysql_query("	SELECT SUM( biaya ) AS biaya
							FROM ply_detail
							INNER JOIN ply_kategori ON ply_detail.id_kt_ply = ply_kategori.id_kt_ply
							WHERE ply_detail.no_struk =  '$no_struk'");
	
		$data2=mysql_fetch_array($z);
		$data3=mysql_fetch_object($x);
		$tot_brg = $data2['tot_brg'];
		
		$biaya = $data3->biaya;
		$tot_bayar_brg = $data2['tot_bayar_brg'];
		$tot_bayar = $biaya + $tot_bayar_brg;
//--
	echo'
		<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod=f_pelayanan"  method="post" enctype="multipart/form-data"  name="wo" >
		<div class="alat">';
			if($ada=mysql_num_rows($qcek)>0){
				echo "
				<input type='submit' class='simpan' id='kiri' name='ply_simpan' value='Selesai Transaksi'>
				<input name='batal' type='button'  value='Batal' class='batal' id='kanan' onclick='history.back()'>
				<input type='checkbox' name='selesai' id='selesai' value='3'><label for='selesai'>Selesai </label>
				";
			}
			else{
				echo'
				<input name="batal" type="button"  value="Batal" class="batal" id="sendiri" onclick="history.back()">';
			}
				echo'
				<input type="hidden" name="no_struk" value="'.$no_struk.'"> <!-- di sembunyikan -->
				<input type="hidden" name="no_wo" value="'.$no_wo.'"> <!-- di sembunyikan -->
				<input type="hidden" name="id_pengguna" value="'.$_SESSION['id_pengguna'].'"> <!-- di sembunyikan -->
				<input type="hidden" name="tot_bayar" value="'.$tot_bayar.'"> <!-- di sembunyikan -->
		</div>
		
		<table cellspacing="0" cellpadding="5" border="0" class="table" >
			<tr>
				<td width="120px"><label>No Struk</label></td>
				<td width="10px">:</td>
				<td width="300px">'.$no_struk.'</td>
				<!-- -->
				<td width="120px"><label>Jenis Kendaraan</label></td>
				<td width="10px">:</td>
				<td>'.$data->jns_kendaraan.'</td>
			</tr>
			<tr>
				<td><label>No Work Order</label></td>
				<td>:</td>
				<td>'.$no_wo.'</td>
				<!-- -->
				<td><label>No Polisi</label></td>
				<td>:</td>
				<td>'.$data->no_polisi.'</td>
			</tr>
			<tr>
				<td><label>ID Pelanggan</label></td>
				<td>:</td>
				<td>'.$dataplg->id_plg.'</td>
				<!-- -->
				<td><label>No Mesin</label></td>
				<td>:</td>
				<td>'.$data->no_mesin.'</td>
			</tr>
			<tr>
				<td><label>Nama Pelanggan</label></td>
				<td>:</td>
				<td>'.$dataplg->nm_plg.'</td>
				<!-- -->
				<td><label>Mekanik</label></td>
				<td>:</td>
				<td>'.$data->id_peg.'</td>
			</tr>
			<tr>
				<td valign="top"><label>Keluhan Pelanggan</label></td>
				<td valign="top">:</td>
				<td valign="top">'.$data->keluhan.'</td>
				
				<td valign="top"><label>Saran Mekanik</label></td>
				<td valign="top">:</td>
				<td>'.$data->saran.'</td>
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
						$qbr="SELECT * FROM br_data";
						$br=mysql_query($qbr) or die (mysql_error());
						while($databr=mysql_fetch_object($br)){//perulangan menampilkan data
							echo "<option value=\"$databr->id_brg\">$databr->nm_brg</option>";
							echo "<option value=\"$databr->kode_brg\">$databr->nm_brg</option>";
							echo "<option value=\"$databr->nm_brg\"></option>";
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
		$q="SELECT * FROM ply_detail WHERE no_struk='$no_struk' ORDER BY id_kt_ply ASC ";
		$daf_pel =mysql_query($q) or die (mysql_error());
		
		if(mysql_num_rows($daf_pel)>0){	
			while($data2=mysql_fetch_object($daf_pel)){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
			
			$a=mysql_query("SELECT * FROM ply_kategori WHERE id_kt_ply='$data2->id_kt_ply'") or die(mysql_error());
			$b=mysql_fetch_object($a);
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
			 	<td align='center'><a href='?mod=hapus2&id_kt_ply=$data2->id_kt_ply&no_struk=$no_struk'  title='Menghapus data pelayanan' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data2->id_kt_ply ."</td>
				<td>". $b->nm_kt_ply ."</td>
				<td></td>
				<td></td>
				<td align='right' ><span class='mu'>Rp. </span>". number_format($b->biaya, 0,',','.') ."</td>
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
				
			$a=mysql_query("SELECT * FROM br_data WHERE id_brg='$data->id_brg'") or die(mysql_error());
			$b=mysql_fetch_object($a);
			echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
				<td align='center'><a href='?mod=hapus&id_brg=$data->id_brg&no_struk=$no_struk&jml=$data->jml_brg' title='Menghapus data barang' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data->id_brg ."</td>
				<td>". $b->nm_brg ."</td>
				<td align='right'>". $data->jml_brg."</td>
				<td align='right'>". number_format($b->hrg_jual, 0,',','.') ."</td>
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
		
		
		echo "
			<tr class='total'>
				<td colspan='4' align='right'>Total</td>
				<td align='right'>". $tot_brg ."</td>
				<td></td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($tot_bayar, 0,',','.') ."</td>
			</tr>
		</table>
	</form>
	</div>";
}

elseif($_GET['id']=="bayar"  && !empty($_GET['no_struk'])){
	$no_struk=$_GET['no_struk'];
	$a = mysql_query("SELECT total_pembayaran FROM ply_ WHERE no_struk='".$no_struk."'") or die (mysql_error());
	$data = mysql_fetch_object($a);

	
	
	echo'
	<div class="lokasi"><label>Pembayaran Transaksi : '.$no_struk.'</label></div>
	<form class="form1" action="?mod=f_pelayanan"  method="post" enctype="multipart/form-data"  name="pembayaran">
	<table class="table">
		<tr>
			<td>
				<label>Total Pembayaran :</label><br>
				<h1><span class="mu">Rp.  </span>'. number_format($data->total_pembayaran, 0,',','.') .',-</h1>
				<input type="hidden" name="total" id="total" value="'.$data->total_pembayaran.'">
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

