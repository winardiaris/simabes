<?php
include ("../inc/koneksi.php");
include ("../inc/cek_login.php");

function simpan(){
	$id_plg			=$_POST['id_plg'];
	$nm_plg			=$_POST['nm_plg'];
	$tgl_registrasi	=$_POST['tgl_registrasi'];
	$masa_berlaku	=$_POST['masa_berlaku'];
	$almt_plg		=$_POST['almt_plg'];
	$telp_plg		=$_POST['telp_plg'];
	$jns_kelamin	=$_POST['jns_kelamin'];
	$kt_sandi		=$_POST['kt_sandi'];
	$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
	$sekarang		=date("Y-m-d H:i:s");
	$berlaku 		=date('Y-m-d', strtotime("+1 year"));

	if(empty($id_plg)){
		echo "<script type='text/javascript'> alert('Isikan ID pelanggan');history.back();</script>";
	}
	elseif(empty($nm_plg)){
		echo "<script type='text/javascript'> alert('Isikan Nama pelanggan');history.back();</script>";
	}
	elseif(empty($almt_plg)){
		echo "<script type='text/javascript'> alert('Isikan Alamat pelanggan');history.back();</script>";
	}
	elseif (empty($telp_plg)){
		echo "<script type='text/javascript'> alert('Isikan No Telepon/HP pelanggan');history.back();</script>";
	}
	elseif ($kt_sandi!=$ulang_kt_sandi){
		echo "<script type='text/javascript'> alert('Kata sandi tidak cocok ');history.back();</script>";
	}
	else{
		$cekdata="SELECT id_plg FROM dt_pelanggan WHERE id_plg='$id_plg'";
		$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0){
				echo "<script type='text/javascript'> alert('ID Pelanggan Sudah Terpakai');history.back();</script>";
			}
			else{
				if(!empty($_FILES["photo_plg"]["tmp_name"])){
					$namafolder="../photo/pelanggan/";
					$jenis_gambar=$_FILES['photo_plg']['type'];
						if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
							$photo_plg = $namafolder . basename($_FILES['photo_plg']['name']);
								if(!move_uploaded_file($_FILES['photo_plg']['tmp_name'],$photo_plg)){
									echo "<script type='text/javascript'> alert('Gambar gagal dikirim');history.back();</script>";
								}
						}
						else{
							echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
						}
				}
				else{
					$photo_plg="../photo/pelanggan/default.png";
				}
				
				
				
				//Memasukan data ke table pelanggan	
				if(empty($tgl_registrasi) || empty ($masa_berlaku)){
					$qry=" 	INSERT INTO dt_pelanggan 
							(id_plg,nm_plg,tgl_registrasi,masa_berlaku,almt_plg,telp_plg,jns_kelamin,photo_plg,wkt_ubah)
							VALUES ('$id_plg','$nm_plg','$sekarang','$berlaku','$almt_plg','$telp_plg','$jns_kelamin','$photo_plg','$sekarang')";
				}
				else{
					$qry=" 	INSERT INTO dt_pelanggan 
							(id_plg,nm_plg,tgl_registrasi,masa_berlaku,almt_plg,telp_plg,jns_kelamin,photo_plg,wkt_ubah)
							VALUES ('$id_plg','$nm_plg','$tgl_registrasi','$masa_berlaku','$almt_plg','$telp_plg','$jns_kelamin','$photo_plg','$sekarang')";
				}
				//Memasukan data ke tabel pengguna	
				if (empty($kt_sandi) || empty($ulang_kt_sandi)){
					$qry2=" INSERT INTO dt_pengguna 
							(id_pengguna,nm_pengguna,nm_asli,kel_id,photo_pengguna,kt_sandi)
							VALUES ('','".md5($id_plg)."','$nm_plg','2','$photo_plg','".md5('simabes')."')";
				}
				else{
					$qry2=" INSERT INTO dt_pengguna 
							(id_pengguna,nm_pengguna,nm_asli,kel_id,photo_pengguna,kt_sandi) 
							VALUES ('','".md5($id_plg)."','$nm_plg','2','$photo_plg','".md5($ulang_kt_sandi)."')";
				}
				
				//eksekusi sql query
				mysql_query($qry) or die(mysql_error());
				mysql_query($qry2) or die(mysql_error());
				 
				//membuat log
				$pengguna=$_SESSION['nama_asli'];
				$lokasi=$_POST['lokasi'];
	
				$pesan="Berhasil menambahkan pelanggan ($nm_plg) dengan ID Pelanggan ($id_plg) ";
				$sekarang = date("Y-m-d H:i:s");
				$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
				"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
				mysql_query($log) or die (mysql_error());
				//
				
				echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pelanggan';</script>";
				
				
			}
	}
	
}
//==========================================//
function pelanggan_hapus_terpilih(){
	$jumlah=count($_POST["item"]);
	if($jumlah==0){
		echo "<script type='text/javascript'> alert('Pilih data yang akan dihapus');window.location='?mod=pelanggan';</script>";
	}
	else{
	for($i=0; $i < $jumlah; $i++){
		$id_plg=$_POST["item"][$i];
		
		$q="SELECT * FROM dt_pelanggan WHERE id_plg='$id_plg' ";
		$daftar=mysql_query($q) or die (mysql_error());
		while($data=mysql_fetch_object($daftar)){
			$qry2= "delete FROM dt_pengguna WHERE nm_pengguna='".md5($data->id_plg)."'";
			mysql_query($qry2) or die ("Gagal Menghapus !!");
		}
		
		//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi="Data Pelanggan";
		$_SESSION['nama_asli'];
		$pesan="Berhasil menghapus pelanggan  dengan ID Pelanggan (".$id_plg.")";
		$sekarang = date("Y-m-d H:i:s");
		$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
		"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
		//

		$qry = "delete FROM dt_pelanggan WHERE id_plg='$id_plg' limit 1";
		mysql_query($qry) or die (" Gagal Menghapus !!");
		
		echo "<script type='text/javascript'> alert('Data berhasil dihapus');window.location='?mod=pelanggan';</script>";
	}
	}
	
}
//==========================================//
function perbaharui(){
	$id_plg			=$_POST['id_plg'];
	$mid_plg		=md5($id_plg);
	$nm_plg			=$_POST['nm_plg'];
	$tgl_registrasi	=$_POST['tgl_registrasi'];
	$masa_berlaku	=$_POST['masa_berlaku'];
	$almt_plg		=$_POST['almt_plg'];
	$telp_plg		=$_POST['telp_plg'];
	$kt_sandi		=$_POST['kt_sandi'];
	$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
	$sekarang		=date("Y-m-d H:i:s");

	if(empty($id_plg)){
		echo "<script type='text/javascript'> alert('Isikan ID pelanggan');history.back();</script>";
	}
	elseif(empty($nm_plg)){
		echo "<script type='text/javascript'> alert('Isikan Nama pelanggan');history.back();</script>";
	}
	elseif(empty($almt_plg)){
		echo "<script type='text/javascript'> alert('Isikan Alamat pelanggan');history.back();</script>";
	}
	elseif (empty($telp_plg)){
		echo "<script type='text/javascript'> alert('Isikan No Telepon/HP pelanggan');history.back();</script>";
	}
	elseif ($kt_sandi!=$ulang_kt_sandi){
		echo "<script type='text/javascript'> alert('Ulangi Kata Sandi ');history.back();</script>";
	}
	else{
		if(!empty($_FILES["photo_plg"]["tmp_name"])){
			$namafolder="../photo/pelanggan/";
			$jenis_gambar=$_FILES['photo_plg']['type'];
				if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png" || $jenis_gambar=="image/PNG"){
					$photo_plg = $namafolder . basename($_FILES['photo_plg']['name']);
						if(!move_uploaded_file($_FILES['photo_plg']['tmp_name'],$photo_plg)){
							die("Gambar gagal dikirim");
						}
						
						//Hapus photo_plg yang lama jika ada
						$res = mysql_query("SELECT photo_plg FROM dt_pelanggan WHERE id_plg='$id_plg' LIMIT 1");
						$d=mysql_fetch_object($res);
						if($d->photo_plg!="../photo/pelanggan/default.png"){
							if (strlen($d->photo_plg)>3){
								if (file_exists($d->photo_plg)) unlink($d->photo_plg);
							}
						}                   
						//update photo_plg dengan yang baru
						$a = "UPDATE dt_pelanggan SET photo_plg='$photo_plg' WHERE id_plg='$id_plg' LIMIT 1";
						$b = "UPDATE dt_pengguna SET photo_pengguna='$photo_plg' WHERE  nm_pengguna='$id_plg' LIMIT 1";
						mysql_query($a);
						mysql_query($b);
					}
					else{
						echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
					
					}
		}
		
		//update data pelanggan
		if(!empty($tgl_registrasi) || !empty($masa_berlaku)){
			$qry="UPDATE dt_pelanggan SET nm_plg='$nm_plg',tgl_registrasi='$tgl_registrasi', masa_berlaku='$masa_berlaku', almt_plg='$almt_plg',telp_plg='$telp_plg',wkt_ubah='$sekarang' WHERE id_plg='$id_plg' LIMIT 1";
		}
		else{
			$qry="UPDATE dt_pelanggan SET nm_plg='$nm_plg',almt_plg='$almt_plg',telp_plg='$telp_plg',wkt_ubah='$sekarang' WHERE id_plg='$id_plg' LIMIT 1";
		}
		
		
		//update data pengguna
		if (!empty($kt_sandi) || !empty($ulang_kt_sandi)){
			$qry2=" UPDATE dt_pengguna SET nm_asli='$nm_plg',kt_sandi='".md5($ulang_kt_sandi)."',wkt_ubah='$sekarang' WHERE nm_pengguna='$mid_plg'";
		}
		else{
			$qry2=" UPDATE dt_pengguna SET nm_asli='$nm_plg',wkt_ubah='$sekarang' WHERE nm_pengguna='$mid_plg'";
		}
		
		//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi=$_POST['lokasi'];
		$_SESSION['nama_asli'];
		$pesan="Berhasil memperbaharui pelanggan (".$nm_plg.") dengan ID Pelanggan (".$id_plg.")";
		$sekarang = date("Y-m-d H:i:s");
		$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
		"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
		//
		
		mysql_query($qry) or die(mysql_error());
		mysql_query($qry2) or die(mysql_error());
		echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=pelanggan';</script>";
	}
}
//==========================================//
function pelanggan_perpanjang(){
	$jumlah=count($_POST["item"]);
	if($jumlah==0){
		echo "<script type='text/javascript'> alert('Pilih data untuk perpanjang masa berlaku');window.location='?mod=pelanggan_kadaluarsa';</script>";
	}
	else{
		for($i=0; $i < $jumlah; $i++){
		$id_plg=$_POST["item"][$i];

		$qry="SELECT * FROM dt_pelanggan WHERE id_plg='$id_plg' ";
		$daftar=mysql_query($qry) or die (mysql_error());
		
		while($data=mysql_fetch_object($daftar)){
			
			$a = strtotime ( '+1 year' , strtotime ( $data->masa_berlaku ) ) ;
			$perpanjang =date ( 'Y-m-d' , $a );
			
			$b = $data->perpanjang;
			$c = $b + 1;
			
			$d = "UPDATE dt_pelanggan SET masa_berlaku='$perpanjang', perpanjang='$c' WHERE id_plg='$id_plg' LIMIT 1";
			mysql_query($d) or die(mysql_error());
					
			
			//membuat log
			$pengguna=$_SESSION['nama_asli'];
			$lokasi="Data Pelanggan Kadaluarsa";
			$_SESSION['nama_asli'];
			$pesan="Berhasil memperpanjang masa berlaku pelanggan dengan ID Pelanggan (".$id_plg.") ";
			$sekarang = date("Y-m-d H:i:s");
			$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
			"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
			mysql_query($log) or die (mysql_error());
			//
			}
		
		
		}
		echo "<script type='text/javascript'> alert('Berhasil memperpanjang masa berlaku pelanggan');window.location='?mod=pelanggan_kadaluarsa';</script>";
	}
	
}
//==========================================//
function kartu_antri(){
	$jumlah=count($_POST["item"]);
	if($jumlah==0){
		echo "<script type='text/javascript'> alert('Pilih data untuk ditambahkan dalam antrian');window.location='?mod=pelanggan_kartu';</script>";
	}
	else{
	for($i=0; $i < $jumlah; $i++){
		$id_plg=$_POST["item"][$i];

		$qry="SELECT * FROM dt_pelanggan WHERE id_plg='$id_plg' ";
		$daftar=mysql_query($qry) or die (mysql_error());
		
		$cek ="SELECT * FROM sementara where id_sementara like '%kartu%'";
		$cek_=mysql_query($cek) or die(mysql_error());
		if(mysql_num_rows($cek_) < 8){
			$qry2 = "INSERT INTO sementara  VALUES ('kartu_pelanggan','".$id_plg."')";
			mysql_query($qry2) or die(mysql_error());
			
			//membuat log
			$pengguna=$_SESSION['nama_asli'];
			$lokasi="Kartu Pelanggan";
			$_SESSION['nama_asli'];
			$pesan="Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (".$id_plg.") ";
			$sekarang = date("Y-m-d H:i:s");
			$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
			"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
			mysql_query($log) or die (mysql_error());
			//
		}
		else{
			echo "<script type='text/javascript'> alert('Jumlah antrian sudah penuh');window.location='?mod=pelanggan_kartu';</script>";
		}
	}
	echo "<script type='text/javascript'> alert('Berhasil menambahkan antrian');window.location='?mod=pelanggan_kartu';</script>";
	}
}

//==========================================//

if(isset($_POST['simpan'])){
	simpan();
}
else if(isset($_POST['pelanggan_hapus_terpilih'])){
	pelanggan_hapus_terpilih();
}
else if(isset($_POST['perbaharui'])){
	perbaharui();
}
else if(isset($_POST['pelanggan_perpanjang'])){
	pelanggan_perpanjang();
}
else if(isset($_POST['kartu_antri'])){
	kartu_antri();
}
else{
	echo "<script type='text/javascript'> alert('Tidak ada!'); history.back();</script>";
}
?>
