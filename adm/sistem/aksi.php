<?php
$sis = new sistem();
$sekarang = date("Y-m-d H:i:s");
$hari_ini = date("Y-m-d");
$lokasi  = $_POST['lokasi'];

if(isset($_POST['perbaharui_bengkel'])){
	$id = 1;
	$nm_bengkel=$_POST['nm_bengkel'];
	$telp1=$_POST['telp1'];
	$telp2=$_POST['telp2'];
	$almt_bengkel=$_POST['almt_bengkel'];
	$tntg_bengkel=$_POST['tntg_bengkel'];
	
	if(empty($nm_bengkel)){echo "<script type='text/javascript'> alert('Isikan Nama Bengkel !');history.back();</script>";}
	elseif(empty($telp1) && empty($telp2)){echo "<script type='text/javascript'> alert('Isikan No Telepon !');history.back();</script>";}
	elseif(empty($almt_bengkel)){echo "<script type='text/javascript'> alert('Isikan Alamat Bengkel !');history.back();</script>";}
	else{
		if(!empty($_FILES["logo_bengkel"]["tmp_name"])){
		$namafolder="../img/";
		$jenis_gambar=$_FILES['logo_bengkel']['type'];
		$logo_bengkel = $sis->tampil_bengkel('logo_bengkel','1');
			//hapus photo lama
			if($logo_bengkel!="pegawai/photo/default.png"){if (strlen($logo_bengkel)>3){if (file_exists($logo_bengkel)) unlink($logo_bengkel);}}
			 
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["logo_bengkel"]["size"] < 512000){
					$namafile = md5($nm_bengkel.$id);
					$logo_bengkel = $namafolder.$namafile.".".end(explode(".",$_FILES["logo_bengkel"]["name"]));
					move_uploaded_file($_FILES["logo_bengkel"]["tmp_name"],$logo_bengkel);
					
					//perbaharui logo
					$sis->simpan_logo_bengkel($id,$logo_bengkel);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
		}
	
		$sis->perbaharui_bengkel($id,$nm_bengkel,$telp1,$telp2,$almt_bengkel,$tntg_bengkel);
		echo "<script type='text/javascript'> alert('Pengaturan bengkel berhasil disimpan');window.location='?mod=utama';</script>";	
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:1:Menyimpan pengaturan dasar bengkel";$log_waktu = $sekarang;
		$sis->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);		
	}
}
elseif(isset($_POST['simpan_pengguna'])){
	$nm_pengguna	=$_POST['nm_pengguna'];
	$nm_asli		=$_POST['nm_asli'];
	$kt_sandi		=$_POST['kt_sandi'];
	$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
	$kel_id			=$_POST['kel_id'];

	if(empty($nm_pengguna)){echo "<script type='text/javascript'> alert('Isikan Nama Pengguna !');history.back();</script>";}
	else if(empty($nm_asli)){echo "<script type='text/javascript'> alert('Isikan Nama Asli!');history.back();</script>";}
	else if(empty($kel_id)){echo "<script type='text/javascript'> alert('Pilih Kelompok Pengguna!');history.back();</script>";}
	else if(empty($kt_sandi)){echo "<script type='text/javascript'> alert('Isikan Kata Kunci !');history.back();</script>";}
	else if($kt_sandi != $ulang_kt_sandi){echo "<script type='text/javascript'> alert('Kata kunci tidak sama !'); history.back();</script>";}
	else{
		$cek = $sis->cek_pengguna($nm_pengguna);
		if(count($cek)>0){
			echo "<script type='text/javascript'> alert('Nama Pengguna ($nm_pengguna) telah digunakan !'); history.back();</script>";
			return false;
		}
		else{
		if(!empty($_FILES["photo_pengguna"]["tmp_name"])){
		$namafolder="sistem/photo/";
		$jenis_gambar=$_FILES['photo_pengguna']['type'];
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_pengguna"]["size"] < 512000){
					$namafile = md5($nm_pengguna.$kel_id);
					$photo_pengguna = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_pengguna"]["name"]));
					move_uploaded_file($_FILES["photo_pengguna"]["tmp_name"],$photo_pengguna);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
		}
		else{$photo_pengguna="sistem/photo/default.png";}
		
		$sis->simpan_pengguna($nm_pengguna,$nm_asli,$kt_sandi,$kel_id,$photo_pengguna,$sekarang);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:1:Menambahkan pengguna ($nm_pengguna)";$log_waktu = $sekarang;
		$sis->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);	
		
		echo "<script type='text/javascript'> alert('Data Berhasil Disimpan !'); window.location='?mod=sistem&h=pengguna'</script>";
		}
	}
}
elseif(isset($_POST['hapus_pengguna'])){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_pengguna=$_POST["item"][$i];
		$sis->hapus_pengguna($id_pengguna);
		
		//hapus photo
		$photo = $sis->sunting_pengguna('photo_pengguna',$id_pengguna);
		if($photo!="sistem/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}} 
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:4:Menghapus pengguna ($id_pengguna)";$log_waktu = $sekarang;
		$sis->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);	
		
		
	}
	echo "<script type='text/javascript'> alert('Data berhasil dihapus');window.location='?mod=sistem&h=pengguna';</script>";
	}
	else{echo "<script type='text/javascript'> alert('Pilih data yang akan dihapus');history.back();</script>";}
}	
elseif(isset($_POST['perbaharui_pengguna'])){
	$id_pengguna	=$_POST['id_pengguna'];
	$nm_pengguna	=$_POST['nm_pengguna'];
	$nm_asli		=$_POST['nm_asli'];
	$kt_sandi		=$_POST['kt_sandi'];
	$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
	$kel_id			=$_POST['kel_id'];
	
	if (empty($nm_asli)){echo "<script type='text/javascript'> alert('Isikan Nama Asli');history.back();</script>";}
	else if($kt_sandi != $ulang_kt_sandi){echo "<script type='text/javascript'> alert('Kata kunci tidak sama !'); history.back();</script>";}
	else{
		if(!empty($_FILES["photo_pengguna"]["tmp_name"])){
		$namafolder="sistem/photo/";
		$jenis_gambar=$_FILES['photo_pengguna']['type'];
		
		$photo = $sis->sunting_pengguna('photo_pengguna',$id_pengguna);
			//hapus photo lama
			if($photo!="sistem/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}}
			 
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_pengguna"]["size"] < 512000){
					$namafile = md5($nm_pengguna.$kel_id);
					$photo_pengguna = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_pengguna"]["name"]));
					move_uploaded_file($_FILES["photo_pengguna"]["tmp_name"],$photo_pengguna);
					//perbaharui photo
					$sis->perbaharui_photo_pengguna($nm_pengguna,$photo_pengguna);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
		}
		$sis->perbaharui_pengguna($id_pengguna,$nm_asli,$kel_id,$sekarang);
		if(!empty($kt_sandi)){
			$sis->perbaharui_kt_sandi($nm_pengguna,$kt_sandi);
		}
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:3:Memperbaharui pengguna ($id_pengguna | $nm_pengguna)";$log_waktu = $sekarang;
		$sis->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		
		echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=sistem&h=pengguna';</script>";
		
	}
}
elseif(isset($_POST['simpan_kelompok'])){
	$nm_kel=$_POST['nm_kel'];
		
	if(empty($nm_kel)){echo "<script type='text/javascript'> alert('Isikan Nama Kelompok');history.back();</script>";}
	else{
		$cek = $sis->cek_kelompok($nm_kel);
		if(count($cek)>0){echo "<script type='text/javascript'> alert('Nama Kelompok telah ada');history.back();</script>";return false;}
		else{
			$sis->simpan_kelompok($nm_kel);
			$kel_id = $sis->tampil_kelompok2('kel_id',$nm_kel);
			$jumlah=count($_POST["menu"]);
			for($i=0; $i < $jumlah; $i++){
			$id_menu=$_POST["menu"][$i];	
	
				
				$sis->simpan_akses_pengguna($kel_id,$id_menu);
		
			}
			//log
			$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
			$log_pesan="A:1:Menambahkan kelompok pengguna ($kel_id | $nm_kel)";$log_waktu = $sekarang;
			$sis->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);	
			echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=sistem&h=kelompok'</script>";
		}
	}
}
elseif(isset($_POST['hapus_kelompok'])){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$kel_id=$_POST["item"][$i];
		$sis->hapus_kelompok($kel_id);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:4:Menghapus kelompok pengguna ($kel_id)";$log_waktu = $sekarang;
		$sis->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);	
	
	}
	echo "<script type='text/javascript'> alert('Data berhasil dihapus');window.location='?mod=".$_GET['mod']."&h=kelompok';</script>";
	}
	else{
		echo "<script type='text/javascript'> alert('Pilih data yang akan dihapus');window.location='?mod=".$_GET['mod']."&h=kelompok';</script>";
	}
}
elseif(isset($_POST['perbaharui_kelompok'])){
	$nm_kel=$_POST['nm_kel'];
	$kel_id=$_POST['kel_id'];
	
	if(empty($nm_kel)){echo "<script type='text/javascript'> alert('Isikan Nama kelompok');history.back();</script>";}
	else{
		$sis->perbaharui_kelompok($kel_id,$nm_kel);
		$sis->hapus_akses_pengguna($kel_id);
		
		$jumlah=count($_POST["menu"]);
		for($i=0; $i < $jumlah; $i++){
			$id_menu=$_POST["menu"][$i];	
			$sis->simpan_akses_pengguna($kel_id,$id_menu);
		}
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:3:Memperbaharui kelompok pengguna ($kel_id | $nm_kel)";$log_waktu = $sekarang;
		$sis->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);	
		echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=sistem&h=kelompok'</script>";
	}
}
else{
	echo "<script type='text/javascript'>alert('tidak ada aksi');history.back();</script>";
}

?>
