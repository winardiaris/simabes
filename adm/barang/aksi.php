<?php
sleep(1);
$brg = new barang();
$sekarang = date("Y-m-d H:i:s");
$hari_ini = date("Y-m-d");

//buat log
$lokasi = $_POST['lokasi'];
$pengguna=$_SESSION['nama_asli'];
$log_tipe = "Staff";


// barang //
if(isset($_POST['br_simpan'])){
	$kode_brg		= $_POST['kode_brg'];
	$nm_brg			= $_POST['nm_brg'];
	$id_kt_brg		= $_POST['id_kt_brg'];
	$id_kualitas	= $_POST['id_kualitas'];
	$hrg_beli		= preg_replace("/[^0-9]/", "", $_POST['hrg_beli']);
	$hrg_jual		= preg_replace("/[^0-9]/", "",$_POST['hrg_jual']);
	$id_satuan		= $_POST['id_satuan'];
	$stok			= $_POST['stok'];
	$stok_min		= $_POST['stok_min'];
	$id_rak			= $_POST['id_rak'];
	$id_sup			= $_POST['id_sup'];
	$tgl_masuk		= $_POST['tgl_masuk'];
	$ket_brg		= $_POST['ket_brg'];
	


	// ----- awal kode otomatis ----- //
	$qry = "SELECT max(id_brg) as maxID FROM br_data WHERE id_brg LIKE '$id_kt_brg%' ORDER by id_brg ";
	
	$hasil = mysql_query($qry);
	$data = mysql_fetch_array($hasil);
	$idMax = $data['maxID'];
	$noUrut = (int) substr($idMax, 2, 5);
	$noUrut++;

	$id_brg = $id_kt_brg . sprintf("%05s", $noUrut);
	// ----- akhir kode otomatis ----- //


	if(empty($nm_brg)){echo "<script type='text/javascript'> alert('Isikan Nama Barang');history.back();</script>";}	
	elseif(empty($hrg_beli)){ echo "<script type='text/javascript'> alert('Harga beli tidak boleh kosong');history.back();</script>";}
	elseif(empty($hrg_jual)){ echo "<script type='text/javascript'> alert('Harga jual tidak boleh kosong');history.back();</script>";}
	elseif($hrg_jual > ($hrg_beli + ($hrg_beli * (50/100)))){echo "<script type='text/javascript'> alert('Persentase harga jual terlalu tinggi ');history.back();</script>";}
	elseif(empty($stok)){echo "<script type='text/javascript'> alert('Isikan stok barang tersedia');history.back();</script>";}
	else{
		if(!empty($kode_brg)){$ada = count($brg->cek_ada($id_brg,$kode_brg));}
		
		if($ada>0){
			echo "<script type='text/javascript'> alert('Data barang dengan kode [$kode_brg] telah ada');history.back();</script>";
		}
		else{
			if(!empty($_FILES["photo_brg"]["tmp_name"])){
			$namafolder="barang/photo/";
			$jenis_gambar=$_FILES['photo_brg']['type'];
				if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
					if($_FILES["photo_brg"]["size"] < 512000){
						$namafile = md5($id_brg.$kode_brg);
						$photo_brg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_brg"]["name"]));
						move_uploaded_file($_FILES["photo_brg"]["tmp_name"],$photo_brg);
					}
					else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
				}
				else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
			}
			else{$photo_brg="barang/photo/default.png";}
			
			if(empty($stok_min)){$stok_min = 1;}
			elseif(empty($tgl_masuk)){$tgl_masuk = $hari_ini;}
			elseif(empty($ket_brg)){$ket_brg = "Tidak ada keterangan untuk gambar ini";}
			$brg->simpan_barang($id_brg,$kode_brg,$nm_brg,$id_kt_brg,$id_kualitas,$hrg_beli,$hrg_jual,$id_satuan,$stok,$stok_min,$id_rak,$id_sup,$tgl_masuk,$ket_brg,$photo_brg,$sekarang);
			
			//==============================
			if(!empty($_POST['item'])){
				$jumlah=count($_POST["item"]);
				for($i=0; $i < $jumlah; $i++){
				$id_kendaraan=$_POST["item"][$i];
					$brg->simpan_brg_kendaraan($id_brg,$id_kendaraan,$sekarang);
				}
			}
			else{$brg->simpan_brg_kendaraan($id_brg,'A',$sekarang);}
			//==========
			
			//log
			
			$log_pesan="A:1:Menyimpan data barang ($id_brg)";
			$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
			
			header ("location:?mod=barang");
		}
	}
	
}
elseif(isset($_POST['br_hapus'])){
	if(!empty($_POST['item'])){
		$jumlah=count($_POST["item"]);
		for($i=0; $i < $jumlah; $i++){
			$id_brg=$_POST["item"][$i];
			
			//hapus photo
			$photo = $brg->sunting_barang('photo_brg',$id_brg);
			if($photo!="barang/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}}
			
			//hapus brg_data_perkendaraan
			$brg->hapus_brg_kendaraan($id_brg);
			
			//hapus data
			$brg->hapus_barang($id_brg);
			
			
			//log
			
			$log_pesan="A:4:Mengapus data barang ($id_brg)";
			$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
					
		}
		echo "<script type='text/javascript'>  alert('Berhasil dihapus');window.location='?mod=barang';</script>";
	}
	else{echo "<script type='text/javascript'>  alert('Pilih data barang yang akan dihapus');window.location='?mod=barang';</script>";}
		
}
elseif(isset($_POST['br_perbaharui'])){
	$id_brg			= $_POST['id_brg'];
	$kode_brg		= $_POST['kode_brg'];
	$nm_brg			= $_POST['nm_brg'];
	$id_kt_brg		= $_POST['id_kt_brg'];
	$id_kualitas	= $_POST['id_kualitas'];
	$hrg_beli		= preg_replace("/[^0-9]/", "", $_POST['hrg_beli']);
	$hrg_jual		= preg_replace("/[^0-9]/", "",$_POST['hrg_jual']);
	$id_satuan		= $_POST['id_satuan'];
	$stok			= $_POST['stok'];
	$stok_min		= $_POST['stok_min'];
	$id_rak			= $_POST['id_rak'];
	$id_sup			= $_POST['id_sup'];
	$tgl_masuk		= $_POST['tgl_masuk'];
	$ket_brg		= $_POST['ket_brg'];
	
	
	if(empty($nm_brg)){echo "<script type='text/javascript'> alert('Isikan Nama Barang');history.back();</script>";}	
	elseif(empty($hrg_beli)){echo "<script type='text/javascript'> alert('Harga beli tidak boleh kosong');history.back();</script>";}
	elseif(empty($hrg_jual)){echo "<script type='text/javascript'> alert('Harga jual tidak boleh kosong');history.back();</script>";}
	elseif(empty($stok)){echo "<script type='text/javascript'> alert('Isikan stok barang tersedia');history.back();</script>";}
	else{
		if(!empty($_FILES["photo_brg"]["tmp_name"])){
		$namafolder="barang/photo/";
		$jenis_gambar=$_FILES['photo_brg']['type'];
		
		$photo = $brg->sunting_barang('photo_brg',$id_brg);
			//hapus photo lama
			if($photo!="barang/photo/default.png"){if (strlen($photo)>3){if (file_exists($photo)) unlink($photo);}}
			
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
				if($_FILES["photo_brg"]["size"] < 512000){
					$namafile = md5($id_brg.$kode_brg);
					$photo_brg = $namafolder.$namafile.".".end(explode(".",$_FILES["photo_brg"]["name"]));
					move_uploaded_file($_FILES["photo_brg"]["tmp_name"],$photo_brg);
					
					//perbaharui photo
					$brg->perbaharui_photo($id_brg,$photo_brg);
				}
				else{echo "<script type='text/javascript'> alert('ukuran gambar terlalu besar');history.back();</script>";	return false;}
			}
			else{echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";return false;}
		}
			if(empty($stok_min)){$stok_min = 1;}
			elseif(empty($tgl_masuk)){$tgl_masuk = $hari_ini;}
			elseif(empty($ket_brg)){$ket_brg = "Tidak ada keterangan untuk gambar ini";}
			//perbaharui
			$brg->perbaharui_barang($id_brg,$kode_brg,$nm_brg,$id_kt_brg,$id_kualitas,$hrg_beli,$hrg_jual,$id_satuan,$stok,$stok_min,$id_rak,$id_sup,$tgl_masuk,$ket_brg,$sekarang);
			
			$brg->hapus_brg_kendaraan($id_brg);
			//==============================
			if(!empty($_POST['item'])){
				$jumlah=count($_POST["item"]);
				for($i=0; $i < $jumlah; $i++){
				$id_kendaraan=$_POST["item"][$i];
					$brg->simpan_brg_kendaraan($id_brg,$id_kendaraan,$sekarang);
				}
			}
			else{$brg->simpan_brg_kendaraan($id_brg,'A',$sekarang);}
			//==========
		
			//log
			
			$log_pesan="A:3:Memperbaharui data barang ($id_brg)";
			$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
	
			//echo "<script type='text/javascript'>  alert('Barang berhasil diperbaharui');window.location='?mod=barang';</script>";
			header('location:?mod=barang');
		
	}
}
elseif(isset($_POST['br_kategori_simpan'])){
	$id_kt_brg=$_POST['id_kt_brg'];
	$nm_kt_brg=$_POST['nm_kt_brg'];
	
	if(empty($id_kt_brg)){echo "<script type='text/javascript'> alert('Isikan ID Kategori');history.back();</script>";}
	elseif(empty($nm_kt_brg)){	echo "<script type='text/javascript'> alert('Isikan Nama Kategori');history.back();</script>";}
	else{
		$ada = count($brg->cek_kategori($id_kt_brg));
		if($ada>0){	echo "<script type='text/javascript'> alert('ID [$id_kt_brg] Sudah Terpakai');history.back();</script>";}	
		else{
			$brg->simpan_kategori($id_kt_brg,$nm_kt_brg,$sekarang);
			
			
			//log
			
			$log_pesan="A:1:Menyimpan data kategori barang ($id_kt_brg)";
			$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
			
			echo "<script type='text/javascript'>  window.location='?mod=barang&h=kategori';</script>";
		}
	}
	
}
elseif(isset($_POST['br_kategori_hapus'])){
	$jumlah=count($_POST["item"]);
	if($jumlah>0){
	for($i=0; $i < $jumlah; $i++){
		$id_kt_brg=$_POST["item"][$i];
	
		$brg->hapus_kategori($id_kt_brg);
		
		//log
		
		$log_pesan="A:4:Menghapus data kategori barang ($id_kt_brg)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
	}
	echo "<script type='text/javascript'>  alert('[$jumlah] Data berhasil dihapus');window.location='?mod=barang&h=kategori';</script>";	
	}
	else{echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=barang&h=kategori';</script>";}
}
elseif(isset($_POST['br_kategori_perbaharui'])){
	$id_kt_brg=$_POST['id_kt_brg'];
	$nm_kt_brg=$_POST['nm_kt_brg'];
	
	if(empty($id_kt_brg)){echo "<script type='text/javascript'> alert('Isikan ID Kategori');history.back();</script>";}
	elseif(empty($nm_kt_brg)){	echo "<script type='text/javascript'> alert('Isikan Nama Kategori');history.back();</script>";}
	else{
		$brg->perbaharui_kategori($id_kt_brg,$nm_kt_brg,$sekarang);
		
		//log
		
		$log_pesan="A:3:Memperbaharui data kategori barang ($id_kt_brg)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		echo "<script type='text/javascript'>  window.location='?mod=barang&h=kategori';</script>";
	}
}
elseif(isset($_POST['br_kualitas_simpan'])){
	$id_kualitas = $_POST['id_kualitas'];
	$kualitas=$_POST['kualitas'];
	
	if(empty($id_kualitas)){echo "<script type='text/javascript'> alert('Isikan ID Kualitas');history.back();</script>";}
	elseif(empty($kualitas)){echo "<script type='text/javascript'> alert('Isikan Kualitas');history.back();</script>";}
	else{
		$ada = count($brg->cek_kualitas($id_kualitas));
			if($ada>0){	echo "<script type='text/javascript'> alert('ID [$id_kualitas] Sudah Terpakai');history.back();</script>";}
			else{
			$brg->simpan_kualitas($id_kualitas,$kualitas,$sekarang);
			
			//log
			
			$log_pesan="A:1:Menyimpan data kualitas barang ($id_kualitas)";
			$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
			
			echo "<script type='text/javascript'>  window.location='?mod=barang&h=kategori';</script>";
		}
	}
}
elseif(isset($_POST['br_kualitas_hapus'])){
	$jumlah=count($_POST["item"]);
	if($jumlah>0){
	for($i=0; $i < $jumlah; $i++){
		$id_kualitas=$_POST["item"][$i];
	
		$brg->hapus_kualitas($id_kualitas);
		
		//log
		
		$log_pesan="A:4:Menghapus data kualitas barang ($id_kualitas)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
	
	}
		echo "<script type='text/javascript'>  alert('Data [$id_kualitas] berhasil dihapus');window.location='?mod=barang&h=kategori';</script>";
	}
	else{echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=barang&h=kategori';</script>";}
}
elseif(isset($_POST['br_kualitas_perbaharui'])){
	$id_kualitas = $_POST['id_kualitas'];
	$kualitas=$_POST['kualitas'];
	if(empty($kualitas)){echo "<script type='text/javascript'> alert('Isikan Kualitas');history.back();</script>";}
	else{
		$brg->perbaharui_kualitas($id_kualitas,$kualitas,$sekarang);
		
		//log
		
		$log_pesan="A:3:Memperbaharui data kualitas barang ($id_kualitas)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		
		echo "<script type='text/javascript'>  window.location='?mod=barang&h=kategori';</script>";
	}
}
elseif(isset($_POST['br_satuan_simpan'])){
	$id_satuan = $_POST['id_satuan'];
	$satuan=$_POST['satuan'];;
	if(empty($id_satuan)){echo "<script type='text/javascript'> alert('Isikan ID Satuan');history.back();</script>";}
	elseif(empty($satuan)){echo "<script type='text/javascript'> alert('Isikan Satuan');history.back();</script>";}
	else{
		$ada=count($brg->cek_satuan($id_satuan));
		if($ada>0){echo "<script type='text/javascript'> alert('ID [$id_satuan] Sudah Terpakai');history.back();</script>";}
		else{
			$brg->simpan_satuan($id_satuan,$satuan,$sekarang);
			//log
			
			$log_pesan="A:1:Menyimpan data satuan barang ($id_satuan)";
			$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
				
			echo "<script type='text/javascript'>  window.location='?mod=barang&h=kategori';</script>";
			}
		}
	
}
elseif(isset($_POST['br_satuan_hapus'])){
	$jumlah=count($_POST["item"]);
	if($jumlah>0){
	for($i=0; $i < $jumlah; $i++){
		$id_satuan=$_POST["item"][$i];
		
		$brg->hapus_satuan($id_satuan);
		//log
		
		$log_pesan="A:4:Menghapus data satuan barang ($id_satuan)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
	}
	echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=barang&h=kategori';</script>";	
	}
	else{echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=barang&h=kategori';</script>";}
}
elseif(isset($_POST['br_satuan_perbaharui'])){
	$id_satuan = $_POST['id_satuan'];
	$satuan=$_POST['satuan'];
	if(empty($satuan)){echo "<script type='text/javascript'> alert('Isikan Satuan');history.back();</script>";}
	else{
		$brg->perbaharui_satuan($id_satuan,$satuan,$sekarang);
		//log
		
		$log_pesan="A:3:Memperbaharui data satuan barang ($id_satuan)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		echo "<script type='text/javascript'>  window.location='?mod=barang&h=kategori';</script>";
	}
	
}
elseif(isset($_POST['br_kendaraan_simpan'])){
	$id_kendaraan = $_POST['id_kendaraan'];
	$kendaraan=$_POST['kendaraan'];

	if(empty($id_kendaraan)){echo "<script type='text/javascript'> alert('Isikan ID Kendaraan');history.back();</script>";	}
	elseif(empty($kendaraan)){echo "<script type='text/javascript'> alert('Isikan Kendaraan');history.back();</script>";}
	else{
		$ada = count($brg->cek_jenis_kendaraan($id_kendaraan));
			if($ada>0){echo "<script type='text/javascript'> alert('ID [$id_kendaraan] Sudah Terpakai');history.back();</script>";}
			else{
				$brg->simpan_jenis_kendaraan($id_kendaraan,$kendaraan,$sekarang);
				
				//log
				
				$log_pesan="A:1:Menyimpan data jenis kendaraan ($id_kendaraan)";
				$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
				
				echo "<script type='text/javascript'>  window.location='?mod=barang&h=kategori';</script>";	
			}
	}
}
elseif(isset($_POST['br_kendaraan_hapus'])){
	$jumlah=count($_POST["item"]);
	if($jumlah>0){
	for($i=0; $i < $jumlah; $i++){
		$id_kendaraan=$_POST["item"][$i];
	
		$brg->hapus_jenis_kendaraan($id_kendaraan);
		
		//log
		
		$log_pesan="A:4:Menghapus data jenis kendaraan ($id_kendaraan)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		
		
	}
	echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=barang&h=kategori';</script>";	
	}
	else{echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=barang&h=kategori';</script>";}
}
elseif(isset($_POST['br_kendaraan_perbaharui'])){
	$id_kendaraan = $_POST['id_kendaraan'];
	$kendaraan=$_POST['kendaraan'];
	
	if(empty($kendaraan)){echo "<script type='text/javascript'> alert('Isikan kendaraan');history.back();</script>";}
	else{
		$brg->perbaharui_jenis_kendaraan($id_kendaraan,$kendaraan,$sekarang);
		//log
		
		$log_pesan="A:3:Memperbaharui data jenis kendaraan ($id_kendaraan)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		echo "<script type='text/javascript'>  window.location='?mod=barang&h=kategori';</script>";
	}
}
elseif(isset($_POST['br_rak_simpan'])){
	$nm_rak=$_POST['nm_rak'];
	$ket=$_POST['ket'];
	
	if (empty($nm_rak)){echo "<script type='text/javascript'> alert(' Isikan Nama Rak ');history.back();</script>";}
	else{
		$ada = count($brg->cek_rak($nm_rak));
		if($ada>0){echo "<script type='text/javascript'> alert('Nama [$nm_rak] Sudah Terpakai');history.back();</script>";}
		else{
		$brg->simpan_rak($nm_rak,$ket,$sekarang);
		//log
		
		$log_pesan="A:1:Menyimpan data Rak penyimpanan ($nm_rak)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		echo "<script type='text/javascript'>  window.location='?mod=barang&h=rak';</script>";
		}
	}
}
elseif(isset($_POST['br_rak_hapus'])){
	$jumlah=count($_POST["item"]);
	if($jumlah>0){
	for($i=0; $i < $jumlah; $i++){
		$id_rak=$_POST["item"][$i];
		
		$brg->hapus_rak($id_rak);
		//log
		
		$log_pesan="A:4:Menhhapus data Rak penyimpanan ($id_rak | $nm_rak)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		
		echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=barang&h=rak';</script>";
	}
	}
	else{echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=barang&h=rak';</script>";}
	
}
elseif(isset($_POST['br_rak_perbaharui'])){
	$id_rak=$_POST['id_rak'];
	$nm_rak=$_POST['nm_rak'];
	$ket=$_POST['ket'];

	if (empty($nm_rak)){echo "<script type='text/javascript'> alert(' Isikan Nama Rak');history.back();</script>";}
	else{
		$sunting = $brg->sunting_rak('nm_rak',$id_rak);
		if($sunting == $nm_rak){
			$brg->perbaharui_rak($id_rak,$nm_rak,$ket,$sekarang);
			
			//log
			
			$log_pesan="A:3:Memperbaharui data Rak penyimpanan ($id_rak | $nm_rak)";
			$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
			echo "<script type='text/javascript'>  window.location='?mod=barang&h=rak';</script>";
		}
		else{
			$ada = count($brg->cek_rak($nm_rak));
			if($ada>0){echo "<script type='text/javascript'> alert('Nama [$nm_rak] Sudah Terpakai');history.back();</script>";}
			else{
				$brg->perbaharui_rak($id_rak,$nm_rak,$ket,$sekarang);
				
				//log
				
				$log_pesan="A:3:Memperbaharui data Rak penyimpanan ($id_rak | $nm_rak)";
				$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
				echo "<script type='text/javascript'>  window.location='?mod=barang&h=rak';</script>";
			}	
			
		}
		
		
		
		
	}
}
elseif(isset($_POST['br_supplier_simpan'])){
	$nm_sup=$_POST['nm_sup'];
	$almt_sup=$_POST['almt_sup'];
	$telp_sup=$_POST['telp_sup'];

	if(empty($nm_sup)){echo "<script type='text/javascript'> alert('Isikan Nama Supplier');history.back();</script>";}
	elseif(empty($almt_sup)){echo "<script type='text/javascript'> alert('Isikan Alamat Supplier');history.back();</script>";}
	elseif (empty($telp_sup)){echo "<script type='text/javascript'> alert('Isikan No Telepon/HP Supplier');history.back();</script>";}
	else{
		$ada = $brg->cek_penyalur($nm_sup);
			if($ada>0){echo "<script type='text/javascript'> alert('Nama [$nm_sup] Sudah Terpakai');history.back();</script>";}	
			else{
				$brg->simpan_penyalur($nm_sup,$almt_sup,$telp_sup,$sekarang);
				//log
				
				$log_pesan="A:1:Menyimpan data Penyalur ($nm_sup)";
				$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
			echo "<script type='text/javascript'>  window.location='?mod=barang&h=penyalur';</script>";
			}
	}
}
elseif(isset($_POST['br_supplier_hapus'])){
	$jumlah=count($_POST["item"]);
	if($jumlah>0){
	for($i=0; $i < $jumlah; $i++){
		$id_sup=$_POST["item"][$i];
	
		//log
		$nm_sup = $brg->sunting_penyalur('nm_sup',$id_sup);
		$log_pesan="A:4:Menghapus data Penyalur ($id_sup | $nm_sup) ";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		
		$brg->hapus_penyalur($id_sup);
		
	}
	echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=barang&h=penyalur';</script>";
	}
}
elseif(isset($_POST['br_supplier_perbaharui'])){
	$id_sup=$_POST['id_sup'];
	$nm_sup=$_POST['nm_sup'];
	$almt_sup=$_POST['almt_sup'];
	$telp_sup=$_POST['telp_sup'];

	if(empty($nm_sup)){echo "<script type='text/javascript'> alert('Isikan Nama Supplier');history.back();</script>";}
	elseif(empty($almt_sup)){echo "<script type='text/javascript'> alert('Isikan Alamat Supplier');history.back();</script>";}
	elseif (empty($telp_sup)){echo "<script type='text/javascript'> alert('Isikan No Telepon/HP Supplier');history.back();</script>";}
	else{
		$brg->perbaharui_penyalur($id_sup,$nm_sup,$almt_sup,$telp_sup,$sekarang);
		//log
		
		$log_pesan="A:3:Memperbaharui data Penyalur ($nm_sup)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		
		echo "<script type='text/javascript'>window.location='?mod=barang&h=penyalur';</script>";
	}
	
}
elseif(isset($_POST['pesan_tambah'])){
	$jumlah=count($_POST['item']);
	if($jumlah>0){
	for($i=0; $i < $jumlah; $i++){
		$id_brg=$_POST["item"][$i];
		//manambahkan pesanan
		$brg->tambah_sementara("pesan_barang",$id_brg);
		//merubah data barang
		$brg->perbaharui_status_barang("dipesan='1'","WHERE id_brg='$id_brg'");
		//log
		$log_pesan="A:1:Menambahkan pembelian barang ($id_brg)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
	}
		echo "<script type='text/javascript'>  alert('Berhasil menambahkan pesanan');window.location='?mod=barang&h=stok_kurang';</script>";	
	}
	else{echo "<script type='text/javascript'>  alert('Pilih data yang akan dipesan');window.location='?mod=barang&h=stok_kurang';</script>";}
}
elseif(isset($_POST['pesan_brg'])){
	$no_pes=$_POST['no_pes'];
	$id_sup=$_POST['id_sup'];
	
	$jumlah=count($_POST["id_brg"]);
	for($i=0;$i<$jumlah;$i++){
		
		$id_brg=$_POST['id_brg'][$i];
		$jml_brg=$_POST['jml_brg'][$i];
		$hrg_brg=$_POST['hrg_brg'][$i];
		$total = $jml_brg * $hrg_brg;
		
		if(!empty($jml_brg)){
			$brg->simpan_pembelian_detail($no_pes,$hari_ini,$id_sup,$id_brg,$hrg_brg,$jml_brg,$total,$sekarang);
			$brg->hapus_sementara('pesan_barang',$id_brg);
			$brg->perbaharui_status_barang("dipesan='2'","WHERE id_brg='$id_brg'");

			echo "<script type='text/javascript'>history.back();</script>";
		}
		else{echo "<script type='text/javascript'>  alert('Isikan jumlah barang');history.back();</script>";}
		
	}
}
elseif(isset($_POST['simpan_pesanan'])){
	$no_pes=$_POST['no_pes'];
	$tgl_pes=$_POST['tgl_pes'];
	$id_pengguna=$_SESSION['id_pengguna'];

	$tampil = $brg->tampil_total_detail("*","WHERE no_pes='$no_pes'");
	foreach ($tampil as $data){
	//$qsimpan = mysql_query("INSERT INTO br_pembelian VALUES('$no_pesan','$tgl_pesan','$d->id_sup','$d->total','0','$id_pengguna','$sekarang')") or die(mysql_error());
	$brg->simpan_pembelian($no_pes,$tgl_pes,$data['id_sup'],$data['total'],'0',$id_pengguna,$sekarang);
	}
	//log
		$log_pesan="A:1:Menyimpan Pemesanan barang ($no_pes)";
		$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
	//
	echo "<script type='text/javascript'>  alert('Pemesanan berhasil disimpan');window.location='?mod=barang&h=pembelian_data';</script>";			
}
elseif(isset($_POST['terima'])){
	$no_pes = $_POST['no_pes'];
	//$id_sup = $_POST['id_sup'];
	$jumlah=count($_POST["item"]);
	
	if($jumlah>0){
	for($i=0; $i < $jumlah; $i++){
		$id_brg=$_POST["item"][$i];
		
		$tampil = $brg->tampil_total_detail("*","WHERE no_pes='$no_pes' AND id_brg='$id_brg'");
		foreach ($tampil as $data){
			$jml_brg = $data['jml_brg'];
			$stok = $brg->sunting_barang('stok',$id_brg);
			$tambah = $stok + $jml_brg;
		
			$brg->perbaharui_pembelian_detail($no_pes,$id_brg);
			$brg->perbaharui_status_barang("dipesan='0',stok='$tambah'","WHERE id_brg='$id_brg'");
			
			//log
			$log_pesan="A:1:Menerima Pemesanan barang ($no_pes | $id_brg)";
			$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
		}
	}
	
	echo "<script type='text/javascript'>history.back();</script>";
	}
	else{echo "<script type='text/javascript'> alert('Pilih data yang diterima');history.back();</script>";}
}
elseif(isset($_POST['simpan_terima'])){
	$no_pes = $_POST['no_pes'];
	
	$tampil = $brg->tampil_total_detail("SUM( total ) AS total","WHERE diterima='1' ");
	foreach($tampil as $data){
		$total_pembayaran = $data['total'];
		$brg->perbaharui_pembelian($no_pes,$total_pembayaran);
		
		//keuangan
		$ket = "Pembayaran pemesanan barang ($no_pes)";
		$brg->simpan_keuangan($hari_ini,$ket,'0',$total_pembayaran);
		
	}
	
	//kembalikan status pesan barang untuk barang yang tidak ada
	$cari = $brg->tampil_pembelian_detail("*","WHERE no_pes='$no_pes' ")	;
	foreach($cari as $data2){
		$id_brg = $data2['id_brg'];
		if($data2['diterima'] == 0){
		$brg->perbaharui_status_barang("dipesan='0'","WHERE id_brg='$id_brg'");
		
		}
	}
	
	//log
	$log_pesan="A:1:Menyelesaikan Pemesanan barang ($no_pes)";
	$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
	echo "<script type='text/javascript'>  alert('Berhasil menyelesaikan pemesanan ($no_pes) ');window.location='?mod=barang&h=penerimaan_pembelian';</script>";
}
elseif(isset($_POST['tambah_antrian_label'])){
	if(!empty($_POST['item'])){
		$jumlah=count($_POST["item"]);
		for($i=0; $i < $jumlah; $i++){
			$id_brg=$_POST["item"][$i];
			
			$cek = $brg->tampil_sementara("*","WHERE id_sementara='pencetakan_label' AND value='$id_brg'");
			$ada = count($cek);
			
			if($ada > 0){
				echo "<script type='text/javascript'>window.location='?mod=barang&h=pencetakan_label';</script>";
			}
			else{
				$brg->tambah_sementara('pencetakan_label',$id_brg);
				//log
				$log_pesan="A:1:Menambahkan pencetakan label  barang ($id_brg)";
				$brg->log($log_tipe,$pengguna,$lokasi,$log_pesan,$sekarang);
			}
		}
		echo "<script type='text/javascript'>  alert('Berhasil menambahkan antrian ');window.location='?mod=barang&h=pencetakan_label';</script>";
	}
	else{
		echo "<script type='text/javascript'>  alert('Pilih data untuk ditambahkan dalam antrian');window.location='?mod=barang&h=pencetakan_label';</script>";	
	}
}
else{echo "<script type='text/javascript'>  alert('tidak ada function');history.back();</script>";}

?>
