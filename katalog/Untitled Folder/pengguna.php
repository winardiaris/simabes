<?php
echo "
	<div class='konten'>
		<div class='header-konten'>
			<h1>Area Pengguna</h1>
		</div>
		<div class='isi-konten'>";

if(!empty($_POST['ubah_kt_sandi'])){ // jika melakukan perubahan kata sandi
	
	$id_pengguna		= $_SESSION['id_pengguna'];
	$nama_asli			= $_SESSION['nama_asli'];
	$kt_sandi_terkini 	= md5($_POST['kt_sandi_terkini']);
	$kt_sandi_baru 		= md5($_POST['kt_sandi_baru']);
	$ulang_kt_sandi 	= md5($_POST['ulang_kt_sandi']);
	$sekarang			= date("Y-m-d H:i:s");
	
	if(empty($_POST['kt_sandi_terkini'])){
		echo "<script type='text/javascript'> alert('Isikan kata sandi terkini');history.back();</script>";
	}
	elseif(empty($_POST['kt_sandi_baru']) OR empty($_POST['ulang_kt_sandi'])){
		echo "<script type='text/javascript'> alert('Isikan kata sandi baru dan ulang kata sandi');history.back();</script>";
	}
	elseif($_POST['kt_sandi_baru'] != $_POST['ulang_kt_sandi']){
		echo "<script type='text/javascript'> alert('Kata sandi tidak cocok');history.back();</script>";
	}
	else{
		$cekpengguna = mysql_query("SELECT * FROM dt_pengguna WHERE id_pengguna='$id_pengguna' AND kt_sandi='$kt_sandi_terkini' ")or die (mysql_error());
		if(mysql_num_rows($cekpengguna)>0){
			$dpengguna = mysql_fetch_object($cekpengguna);
			
			$ubah_kt_sandi = "UPDATE dt_pengguna SET kt_sandi='$ulang_kt_sandi',wkt_ubah='$sekarang' WHERE id_pengguna='$id_pengguna'  AND kt_sandi='$kt_sandi_terkini'";
			mysql_query($ubah_kt_sandi) or die (mysql_error());
			
				//membuat log
				$pengguna=$_SESSION['nama_asli'];
				$lokasi="Area Pengguna";
	
				$pesan="Berhasil menrubah kata sandi ";
				$sekarang = date("Y-m-d H:i:s");
				$log=" insert into log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
				"values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
				mysql_query($log) or die (mysql_error());
				//
			echo "<script type='text/javascript'> alert('Kata sandi telah berhasil diubah');history.back();</script>";
		}
		else{
			echo "<script type='text/javascript'> alert('Kata sandi terkini tidak cocok');history.back();</script>";
		}
	
	
	}
	
}
else{
	if(isset($_SESSION['kel_id'])){
		if($_SESSION['kel_id']==2){// masuk sebagai pelanggan
		
		$nm_plg=$_SESSION['nama_asli'];
		$qplg=mysql_query("SELECT * FROM dt_pelanggan WHERE nm_plg LIKE '%$nm_plg%' ")or die (mysql_error());
		$dplg=mysql_fetch_object($qplg);
	
		echo "
				<table border='0' cellpadding='5' cellspacing='0' align='center' class='table'>
					<tr>
						<td rowspan='3' height='150px' align='center'><img src='".substr($dplg->photo_plg,3) ."' class='photo-plg'></td>
						<td width='150px' valign='top' align='right' class='judul-ket'>ID Pelanggan</td>
						<td width='300px' valign='top' class='isi-ket'>$dplg->id_plg</td>
						<!-- -->
						<td width='150px' valign='top' align='right' class='judul-ket'>Nama Pelanggan</td>
						<td width='300px' valign='top' class='isi-ket'>$dplg->nm_plg</td>
					</tr>
					<tr>
						<td width='150px' valign='top' align='right' class='judul-ket'>No telepon</td>
						<td width='300px' valign='top' class='isi-ket'>$dplg->telp_plg</td>
						<!-- -->
						<td width='150px' valign='top' align='right' class='judul-ket'>Alamat</td>
						<td width='300px' valign='top' class='isi-ket'>$dplg->almt_plg</td>
					</tr>
					<tr>
						<td width='150px' valign='top' align='right' class='judul-ket'>Tanggal Registrasi</td>
						<td width='300px' valign='top' class='isi-ket'>$dplg->tgl_registrasi</td>
						<!-- -->
						<td width='150px' valign='top' align='right' class='judul-ket'>Masa Berlaku</td>
						<td width='300px' valign='top' class='isi-ket'>$dplg->masa_berlaku</td>
					</tr>
				</table>
				<table  border='0' cellpadding='5' cellspacing='0' align='center' class='table2'>
					<tr class='judul-ket'>
						<th align='center'>No Struk</th>
						<th align='center'>Tanggal</th>
						<th align='center'>Total Pembayaran</th>
					</tr>";
		$id_plg=$dplg->id_plg;
		$qply=mysql_query("SELECT * FROM ply_ WHERE id_plg='$id_plg'") or die (mysql_error());
	
			while($dply=mysql_fetch_object($qply)){
				echo"
					<tr>
						<td>$dply->no_struk</td>
						<td>$dply->tgl_struk</td>
						<td align='right'>";
						$total = $dply->total_pembayaran;
						$Format = number_format($total, 0,',','.');
						echo "<span class=\"mu\">Rp. </span>".$Format."
						</td>
					</tr>";		
			}
		echo"	
			</table>";
		}
		else{ // kalau yang masuknya selain pelanggan
			echo "
					<div class='text'>
						Anda masuk sebagai ".$_SESSION['nama_asli']."
					</div>";
		
		
		}//ubah sandi
			echo "
				<form name='ubah-kt-sandi' action='?mod=pengguna' method='post' class='formubah'>
					<table cellpadding='5' cellspacing='0' border='0' align='center'>
						<tr>
							<td colspan='3'>Ubah Kata Sandi</td>
						</tr>
						<tr>
							<td width='150px'>Kata sandi terkini</td>
							<td width='10px'>:</td>
							<td><input type='password' name='kt_sandi_terkini' class='textubah'></td>
							</tr>
							<tr>
							<td width='150px'>Kata sandi baru</td>
							<td width='10px'>:</td>
							<td><input type='password' name='kt_sandi_baru' class='textubah'></td>
						</tr>
						<tr>
							<td width='150px'>Ulang kata sandi</td>
							<td width='10px'>:</td>
							<td><input type='password' name='ulang_kt_sandi' class='textubah'></td>
						</tr>
						<tr>
							<td colspan='3' align='center'><input type='submit' class='btnubah' name='ubah_kt_sandi' value='Ubah Kata Sandi' ></td>
						</tr>
					</table>		
				</form>";
	

			echo "	</div>
				</div>";

	}
	else{ // kalau belum masuk
		echo "
				<div class='text'>
					Silahkan masuk terlebih dahulu untuk ke area pelanggan
				</div>";
	}
}
	echo"
			</div>
		</div>";
?>
