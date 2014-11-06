<?php
$pg = new pegawai();

//simpan
if(isset($_POST['simpan_pegawai'])){
	$id_peg			=$_POST['id_peg'];
	$nm_peg			=$_POST['nm_peg'];
	$jns_kelamin	=$_POST['jns_kelamin'];
	$tmpt_lahir		=$_POST['tmpt_lahir'];
	$tgl_lahir		=$_POST['tgl_lahir'];
	$almt_peg		=$_POST['almt_peg'];
	$telp_peg		=$_POST['telp_peg'];
	$pend_peg		=$_POST['pend_peg'];
	$tgl_bergabung	=$_POST['tgl_bergabung'];
	$pengalaman_peg	=$_POST['pengalaman_peg'];
	$kel_id			=$_POST['kel_id'];
	$hari_ini 		= date("Y-m-d");
	$wkt_ubah 		= date("Y-m-d H:i:s");
	

	if(!empty($_FILES["photo_peg"]["tmp_name"])){
		$namafolder="pegawai/photo/";
		$jenis_gambar=$_FILES['photo_peg']['type'];
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_peg"]["size"] < 512000){
					$namafile = md5($nm_peg.$id_peg);
					$photo_peg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_peg"]["name"]));
					move_uploaded_file($_FILES["photo_peg"]["tmp_name"],$photo_peg);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
	}
	else{$photo_peg="pegawai/photo/default.png";}
	//simpan
	$pg->simpan($id_peg,$nm_peg,$jns_kelamin,$tmpt_lahir,$tgl_lahir,$almt_peg,$telp_peg,$pend_peg,$tgl_bergabung,$photo_peg,$pengalaman_peg,$kel_id,$wkt_ubah);
	//log
	$log_tipe = "Staff";
	$pengguna=$_SESSION['nama_asli'];
	$log_lokasi=$_POST['lokasi'];
	$log_pesan="A:1:Berhasil menambahkan pegawai ID pegawai ($id_peg)";
	$log_waktu = date("Y-m-d H:i:s");
	$pg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	echo "<script type='text/javascript'>sleep(2000);window.location='?mod=pegawai';</script>";
}
// perbaharui
elseif(isset($_POST['pegawai_perbaharui'])){
	sleep(1);
	$id_peg			=$_POST['id_peg'];
	$nm_peg			=$_POST['nm_peg'];
	$jns_kelamin	=$_POST['jns_kelamin'];
	$tmpt_lahir		=$_POST['tmpt_lahir'];
	$tgl_lahir		=$_POST['tgl_lahir'];
	$almt_peg		=$_POST['almt_peg'];
	$telp_peg		=$_POST['telp_peg'];
	$pend_peg		=$_POST['pend_peg'];
	$tgl_bergabung	=$_POST['tgl_bergabung'];
	$pengalaman_peg	=$_POST['pengalaman_peg'];
	$kel_id			=$_POST['kel_id'];
	$wkt_ubah 		= date("Y-m-d H:i:s");
	


	if(!empty($_FILES["photo_peg"]["tmp_name"])){
		$namafolder="pegawai/photo/";
		$jenis_gambar=$_FILES['photo_peg']['type'];
		
		$photo = $pg->sunting('photo_peg',$id_peg);
			//hapus photo lama
			if($photo!="pegawai/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}}
			 
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_peg"]["size"] < 512000){
					$namafile = md5($nm_peg.$id_peg);
					$photo_peg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_peg"]["name"]));
					move_uploaded_file($_FILES["photo_peg"]["tmp_name"],$photo_peg);
					
					//perbaharui photo
					$pg->perbaharuiphoto($id_peg,$photo_peg);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
	}
	//perbaharui data
	$pg->perbaharui($id_peg,$nm_peg,$jns_kelamin,$tmpt_lahir,$tgl_lahir,$almt_peg,$telp_peg,$pend_peg,$tgl_bergabung,$pengalaman_peg,$kel_id,$wkt_ubah);
	
	//log
	$log_tipe = "Staff";
	$pengguna=$_SESSION['nama_asli'];
	$log_lokasi=$_POST['lokasi'];
	$log_pesan="A:3:Memperbaharui pegawai ($id_peg)";
	$log_waktu = date("Y-m-d H:i:s");
	$pg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	
	echo "<script type='text/javascript'>window.location='?mod=pegawai';</script>";
}
//hapus
elseif(isset($_POST['pegawai_hapus_terpilih'])){
	$jumlah=count($_POST["item"]);
	
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_peg=$_POST["item"][$i];
		
		$photo = $pg->sunting('photo_peg',$id_peg);
		//hapus photo
		if($photo!="pegawai/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}}
		
		//hapus data
		$pg->hapus($id_peg);
		
		//log
		$log_tipe = "Staff";
		$pengguna=$_SESSION['nama_asli'];
		$log_lokasi=$lokasi;
		$log_pesan="A:4:Menghapus data pegawai, ID pegawai ($id_peg)";
		$log_waktu = date("Y-m-d H:i:s");
		$pg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		
		
	}
		echo "<script type='text/javascript'> alert('Data berhasil dihapus');window.location='?mod=pegawai';</script>";
	}
	else{
		echo "<script type='text/javascript'> alert('Pilih data yang akan dihapus');window.location='?mod=pegawai';</script>";
	}
	
}
elseif(isset($_POST['kartu_antri'])){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
		if(count($pg->cek_kosong()) == 8 ){
			echo "<script type='text/javascript'> alert('Jumlah antrian sudah penuh');window.location='?mod=pegawai&h=kartu';</script>";
		}
		elseif(count($pg->cek_kosong()) < 8 ){
			for($i=0; $i < $jumlah; $i++){
			$id_peg=$_POST["item"][$i];
				if(count($pg->cek_ada($id_peg))>0){
					echo "<script type='text/javascript'> alert('Data telah ada');window.location='?mod=pegawai&h=kartu';</script>";
				}
				else{
					$pg->kartu_antri($id_peg);		
					//log
					$log_tipe = "Staff";
					$pengguna=$_SESSION['nama_asli'];
					$log_lokasi=$_POST['lokasi'];
					$log_pesan="A:5:Menambahkan antrian cetak kartu pegawai dengan ID pegawai ($id_peg) ";
					$log_waktu = date("Y-m-d H:i:s");
		
					$pg->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
					
					echo "<script type='text/javascript'> alert('Data berhasil ditambahkan dalam antrian');window.location='?mod=pegawai&h=kartu';</script>";
				}
			}
			
		}
	
		
	}	
	else{
		echo "<script type='text/javascript'> alert('Pilih data untuk ditambahkan dalam antrian');window.location='?mod=pegawai&h=kartu';</script>";
	}
	
}
?>
