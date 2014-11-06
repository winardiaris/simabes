<?php
sleep(1);
$plg = new pelanggan();
$sekarang = date("Y-m-d H:i:s");
$hari_ini = date("Y-m-d");

//buat log
$lokasi = $_POST['lokasi'];
$pengguna=$_SESSION['nama_asli'];
$log_tipe = "Staff";


//simpan
if(isset($_POST['simpan'])){
	$id_plg			=$_POST['id_plg'];
	$nm_plg			=$_POST['nm_plg'];
	$tgl_registrasi	=$_POST['tgl_registrasi'];
	$masa_berlaku	=$_POST['masa_berlaku'];
	$almt_plg		=$_POST['almt_plg'];
	$telp_plg		=$_POST['telp_plg'];
	$jns_kelamin	=$_POST['jns_kelamin'];
	$kt_sandi		=$_POST['kt_sandi'];
	$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
	$berlaku 		=date('Y-m-d', strtotime("+1 year"));

		if(!empty($_FILES["photo_plg"]["tmp_name"])){
		$namafolder="pelanggan/photo/";
		$jenis_gambar=$_FILES['photo_plg']['type'];
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_plg"]["size"] < 512000){
					$namafile = md5($nm_plg.$id_plg);
					$photo_plg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_plg"]["name"]));
					move_uploaded_file($_FILES["photo_plg"]["tmp_name"],$photo_plg);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
		}
		else{$photo_plg="pelanggan/photo/default.png";}
		
		if (empty($kt_sandi) && empty($ulang_kt_sandi)){$kt_sandi = "simabes";}

		
		//simpan
		$plg->simpan($id_plg,$nm_plg,$tgl_registrasi,$masa_berlaku,$almt_plg,$telp_plg,$jns_kelamin,$photo_plg,$sekarang,$kt_sandi);
	
		//log
		$log_pesan="A:1:Menambahkan data pelanggan ($id_plg)";
		$plg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
	
		//echo "<script type='text/javascript'>window.location='?mod=pelanggan';</script>";
		header("location:?mod=pelanggan");
	
}
elseif(isset($_POST['perbaharui'])){
	$id_plg			=$_POST['id_plg'];
	$mid_plg		=md5($id_plg);
	$nm_plg			=$_POST['nm_plg'];
	$tgl_registrasi	=$_POST['tgl_registrasi'];
	$masa_berlaku	=$_POST['masa_berlaku'];
	$almt_plg		=$_POST['almt_plg'];
	$telp_plg		=$_POST['telp_plg'];
	$jns_kelamin	=$_POST['jns_kelamin'];
	$kt_sandi		=$_POST['kt_sandi'];
	$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
	
	if(!empty($_FILES["photo_plg"]["tmp_name"])){
		$namafolder="pelanggan/photo/";
		$jenis_gambar=$_FILES['photo_plg']['type'];
		
		$photo = $plg->sunting('photo_plg',$id_plg);
			//hapus photo lama
			if($photo!="pelanggan/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}}
			 
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_plg"]["size"] < 512000){
					$namafile = md5($nm_plg.$id_plg);
					$photo_plg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_plg"]["name"]));
					move_uploaded_file($_FILES["photo_plg"]["tmp_name"],$photo_plg);
					
					//perbaharui photo
					$plg->perbaharuiphoto($id_plg,$photo_plg);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
	}
	//update data pelanggan
	$plg->perbaharui($id_plg,$nm_plg,$tgl_registrasi,$masa_berlaku,$almt_plg,$telp_plg,$jns_kelamin,$sekarang,$kt_sandi);
		
		
		
		//update data pengguna
		/*if (!empty($kt_sandi) || !empty($ulang_kt_sandi)){
			$qry2=" UPDATE dt_pengguna SET nm_asli='$nm_plg',kt_sandi='".md5($ulang_kt_sandi)."',wkt_ubah='$sekarang' WHERE nm_pengguna='$mid_plg'";
		}
		else{
			$qry2=" UPDATE dt_pengguna SET nm_asli='$nm_plg',wkt_ubah='$sekarang' WHERE nm_pengguna='$mid_plg'";
		}*/
		
		//log
		$log_pesan="A:2:Memperbaharui data pelanggan ($id_plg)";
		$plg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		

		//echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=pelanggan';</script>";
		header("location:?mod=pelanggan");
}
//hapus
elseif(isset($_POST['hapus'])){
	$jumlah=count($_POST["item"]);
	
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_plg=$_POST["item"][$i];
		
		$photo = $plg->sunting('photo_plg',$id_plg);
		//hapus photo
		if($photo!="pelanggan/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}}
		
		//hapus data
		$plg->hapus($id_plg);
		
		//log
		$log_tipe = "Staff";
		$pengguna=$_SESSION['nama_asli'];
		$log_lokasi=$lokasi;
		$log_pesan="A:4:Menghapus data pelanggan, ID pelanggan ($id_plg)";
		$log_waktu = date("Y-m-d H:i:s");
		$plg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		
		
	}
		echo "<script type='text/javascript'> alert('Data berhasil dihapus');window.location='?mod=pelanggan';</script>";
	}
	else{
		echo "<script type='text/javascript'> alert('Pilih data yang akan dihapus');window.location='?mod=pelanggan';</script>";
	}
	
}
elseif(isset($_POST['perpanjang'])){
	$jumlah=count($_POST["item"]);
	
		if(!empty($jumlah)){
		for($i=0; $i < $jumlah; $i++){
		$id_plg=$_POST["item"][$i];

			$a = strtotime ( '+1 year' , strtotime ( $plg->sunting('masa_berlaku',$id_plg) ) ) ;
			$masa_berlaku =date ( 'Y-m-d' , $a );
			
			$b = $plg->sunting('perpanjang',$id_plg);
			$perpanjang = $b + 1;
			
			$plg->perpanjang($id_plg,$masa_berlaku,$perpanjang);
			
			//log
			$log_tipe = "Staff";
			$pengguna=$_SESSION['nama_asli'];
			$log_lokasi=$lokasi;
			$log_pesan="A:3:memperpanjang masa berlaku pelanggan, ID pelanggan ($id_plg)";
			$log_waktu = date("Y-m-d H:i:s");
			$plg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);	
		
		}
		echo "<script type='text/javascript'> alert('Berhasil memperpanjang masa berlaku pelanggan');window.location='?mod=pelanggan&h=kadaluarsa';</script>";
		}
	}
//antri 
elseif(isset($_POST['kartu_antri'])){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
		if(count($plg->cek_kosong()) == 8 ){
			echo "<script type='text/javascript'> alert('Jumlah antrian sudah penuh');window.location='?mod=pelanggan&h=kartu';</script>";
		}
		elseif(count($plg->cek_kosong()) < 8 ){
			for($i=0; $i < $jumlah; $i++){
			$id_plg=$_POST["item"][$i];
				if(count($plg->cek_ada($id_plg))>0){
					echo "<script type='text/javascript'> alert('Data telah ada');window.location='?mod=pelanggan&h=kartu';</script>";
				}
				else{
					$plg->kartu_antri($id_plg);		
					//log
					$log_tipe = "Staff";
					$pengguna=$_SESSION['nama_asli'];
					$log_lokasi=$_POST['lokasi'];
					$log_pesan="A:5:Menambahkan antrian cetak kartu pelanggan dengan ID pelanggan ($id_plg) ";
					$log_waktu = date("Y-m-d H:i:s");
		
					$plg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
					
					echo "<script type='text/javascript'> alert('Data berhasil ditambahkan dalam antrian');window.location='?mod=pelanggan&h=kartu';</script>";
				}
			}
			
		}
	
		
	}	
	else{
		echo "<script type='text/javascript'> alert('Pilih data untuk ditambahkan dalam antrian');window.location='?mod=pelanggan&h=kartu';</script>";
	}
	
}
else{echo "<script type='text/javascript'>  alert('tidak ada function');history.back();</script>";}

?>
