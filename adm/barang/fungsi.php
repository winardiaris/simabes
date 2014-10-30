<?php
include ("../inc/koneksi.php");
include ("../inc/cek_login.php");


//============= Barang ===============//
function br_simpan(){
$kode_brg		= $_POST['kd_brg'];
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
$sekarang		= date("Y-m-d H:i:s");


// ----- awal kode otomatis ----- //
$qry = "SELECT max(id_brg) as maxID FROM br_data WHERE id_brg LIKE '$id_kt_brg%' ORDER by id_brg ";

$hasil = mysql_query($qry);
$data = mysql_fetch_array($hasil);
$idMax = $data['maxID'];
$noUrut = (int) substr($idMax, 2, 5);
$noUrut++;

$newID = $id_kt_brg . sprintf("%05s", $noUrut);
// ----- akhir kode otomatis ----- //


if(empty($nm_brg)){
	echo "<script type='text/javascript'> alert('Isikan Nama Barang');history.back();</script>";
}	
elseif(empty($hrg_beli)){
	echo "<script type='text/javascript'> alert('Harga beli tidak boleh kosong');history.back();</script>";
}
elseif(empty($hrg_jual)){
	echo "<script type='text/javascript'> alert('Harga jual tidak boleh kosong');history.back();</script>";
}
elseif($hrg_jual > ($hrg_beli + ($hrg_beli * (50/100)))){
	echo "<script type='text/javascript'> alert('Persentase harga jual terlalu tinggi ');history.back();</script>";
}
elseif(empty($stok)){
	echo "<script type='text/javascript'> alert('Isikan stok barang tersedia');history.back();</script>";
}
elseif(empty($stok_min)){
	$stok_min = 1;
}
else{
	$cekdata="select id_brg,kode_brg FROM br_data WHERE id_brg='$newID' OR kode_brg='$kd_brg'";
	$ada=mysql_query($cekdata) or die(mysql_error());
		if(mysql_num_rows($ada)>0){
			echo "<script type='text/javascript'> alert('Data barang telah ada');history.back();</script>";
		}
		else{
			if(!empty($_FILES["photo_brg"]["tmp_name"])){
				$namafolder="../photo/suku_cadang/";
				$jenis_gambar=$_FILES['photo_brg']['type'];
					if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
						$photo_brg = $namafolder . basename($_FILES['photo_brg']['name']);
							if(!move_uploaded_file($_FILES['photo_brg']['tmp_name'],$photo_brg)){
								die("gambar gagal dikirim");
							}
					}
					else{
						echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
					}
			}
			else{
					$photo_brg="../photo/suku_cadang/default.png";
			}
			
			if(empty($tgl_masuk) ||  empty ($ket_brg)){
			$ket="Tidak ada keterangan untuk barang ini";
				
			mysql_query("INSERT INTO br_data (id_brg,kode_brg,nm_brg,id_kt_brg,id_kualitas,hrg_beli,hrg_jual,id_satuan,stok,stok_min,id_rak,id_sup,tgl_masuk,ket_brg,photo_brg,wkt_ubah)".
				    "values ('$newID','$kd_brg','$nm_brg','$id_kt_brg','$id_kualitas','$hrg_beli','$hrg_jual','$id_satuan','$stok','$stok_min','$id_rak','$id_sup','$sekarang','$ket','$photo_brg','$sekarang')") or die(mysql_error());
			}
			else{
			mysql_query("INSERT INTO br_data (id_brg,kode_brg,nm_brg,id_kt_brg,id_kualitas,hrg_beli,hrg_jual,id_satuan,stok,stok_min,id_rak,id_sup,tgl_masuk,ket_brg,photo_brg,wkt_ubah)".
				    "values ('$newID','$kd_brg','$nm_brg','$id_kt_brg','$id_kualitas','$hrg_beli','$hrg_jual','$id_satuan','$stok','$stok_min,'$id_rak','$id_sup','$tgl_masuk','$ket_brg','$photo_brg','$sekarang')") or die(mysql_error());
			}
			//==============================
			if(!empty($_POST['item'])){
				
				$jumlah=count($_POST["item"]);
				for($i=0; $i < $jumlah; $i++){
				$id_kendaraan=$_POST["item"][$i];
			
					$qry2 = "INSERT INTO br_data_perkendaraan (id_data,id_brg,id_kendaraan,wkt_ubah) values ('','$newID','$id_kendaraan','$sekarang')";
					mysql_query($qry2) or die(mysql_error());
		
				}
			}
			else{
					$qry2 = "INSERT INTO br_data_perkendaraan (id_data,id_brg,id_kendaraan,wkt_ubah) values ('','$newID','A','$sekarang')";
					mysql_query($qry2) or die(mysql_error());
			}
			//==========
			
			//membuat log
			$pengguna=$_SESSION['nama_asli'] ;
			$lokasi=$_POST['lokasi'];
			$pesan="Berhasil menambahkan data barang dengan id/kode barang ($newID / $kd_brg)";
			$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
			"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
			mysql_query($log) or die (mysql_error());
			
			//echo "<script type='text/javascript'>  alert('Barang berhasil disimpan');window.location='?mod=barang_tambah';</script>";
			echo "<script type='text/javascript'>  alert('Barang berhasil disimpan');window.location='?mod=barang';</script>";
		}
	}
}
//============================//
function br_perbaharui(){
$id_brg			= $_POST['id_brg'];
$kd_brg			= $_POST['kd_brg'];
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
$sekarang		= date("Y-m-d H:i:s");


if(empty($nm_brg)){
	echo "<script type='text/javascript'> alert('Isikan Nama Barang');history.back();</script>";
}	
elseif(empty($hrg_beli)){
	echo "<script type='text/javascript'> alert('Harga beli tidak boleh kosong');history.back();</script>";
}
elseif(empty($hrg_jual)){
	echo "<script type='text/javascript'> alert('Harga jual tidak boleh kosong');history.back();</script>";
}
elseif(empty($stok)){
	echo "<script type='text/javascript'> alert('Isikan stok barang tersedia');history.back();</script>";
}
elseif(empty($stok_min)){
	$stok_min = 1;
}
else{
		if(!empty($_FILES["photo_brg"]["tmp_name"])){
			$namafolder="../photo/suku_cadang/";
			$jenis_gambar=$_FILES['photo_brg']['type'];
				if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
					$photo_brg = $namafolder . basename($_FILES['photo_brg']['name']);
						if(!move_uploaded_file($_FILES['photo_brg']['tmp_name'],$photo_brg)){
							die("Gambar gagal dikirim");
						}
						
						//Hapus photo_brg yang lama jika ada
						$res = mysql_query("select photo_brg FROM br_data WHERE id_brg='$id_brg' LIMIT 1");
						$d=mysql_fetch_object($res);
						if($d->photo_brg!="../photo/suku_cadang/default.png"){
							if (strlen($d->photo_brg)>3){
								if (file_exists($d->photo_brg)) unlink($d->photo_brg);
							}
						}                   
						//update photo_brg dengan yang baru
						$a = "UPDATE br_data SET photo_brg='$photo_brg' WHERE id_brg='$id_brg' LIMIT 1";
						mysql_query($a);
					}
					else{
						echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
					
					}
		}
		
		//update data barang
		if(empty($tgl_masuk) ||  empty ($ket_brg)){
			$ket="Tidak ada keterangan untuk barang ini";
			
			$qry="	UPDATE br_data SET 
					kode_brg='$kd_brg',nm_brg='$nm_brg',id_kt_brg='$id_kt_brg',
					id_kualitas='$id_kualitas',hrg_beli='$hrg_beli',hrg_jual='$hrg_jual',
					id_satuan='$id_satuan',stok='$stok',stok_min='$stok_min',id_rak='$id_rak',id_sup='$id_sup',
					tgl_masuk='$sekarang',ket_brg='$ket',dipesan='0' ,wkt_ubah='$sekarang' 
					WHERE id_brg='$id_brg' LIMIT 1";
		}
		else{
			$qry="	UPDATE br_data SET 
					kode_brg='$kd_brg',nm_brg='$nm_brg',id_kt_brg='$id_kt_brg',
					id_kualitas='$id_kualitas',hrg_beli='$hrg_beli',hrg_jual='$hrg_jual',
					id_satuan='$id_satuan',stok='$stok',stok_min='$stok_min',id_rak='$id_rak',
					id_sup='$id_sup',tgl_masuk='$tgl_masuk',ket_brg='$ket_brg',
					dipesan='0',wkt_ubah='$sekarang' 
					WHERE id_brg='$id_brg' LIMIT 1";
		}
		
		mysql_query($qry) or die(mysql_error());

		//==============================
			$sql = "SELECT count( * ) as num FROM `br_data_perkendaraan` WHERE id_brg='$id_brg' ";
			$result = mysql_query($sql);
			$result = mysql_fetch_assoc( $result );
			$jml = $result['num'];
			
			$q= "DELETE FROM `br_data_perkendaraan` WHERE id_brg='$id_brg' LIMIT 1";
				for($a=0;$a<=$jml;$a++){
					mysql_query($q) or die ("Gagal Menghapus !!");
				}
			$jumlah=count($_POST["item"]);
				for($i=0; $i < $jumlah; $i++){
				$id_kendaraan=$_POST["item"][$i];
				
				$qry2 = "INSERT INTO br_data_perkendaraan (id_data,id_brg,id_kendaraan,wkt_ubah) values ('','$id_brg','$id_kendaraan','$sekarang')";
				mysql_query($qry2) or die(mysql_error());
				}
		
		//membuat log
			$pengguna=$_SESSION['nama_asli'] ;
			$lokasi=$_POST['lokasi'];
			$pesan="Berhasil memperbaharui data barang dengan id/kode barang ($id_brg / $kd_brg)";
			$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
			"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
			mysql_query($log) or die (mysql_error());
			echo "<script type='text/javascript'>  alert('Berhasil diperbaharui');window.location='?mod=barang';</script>";
	}
}
//============================//
function br_hapus(){
	// Hapus Data br_data
	if(!empty($_POST['item'])){
		$jumlah=count($_POST["item"]);
		for($i=0; $i < $jumlah; $i++){
			$id_brg=$_POST["item"][$i];
	
			// Hapus data br_data_perkendaraan
			$q= "DELETE  FROM `br_data_perkendaraan` WHERE id_brg='$id_brg' ";
			mysql_query($q) or die ("Gagal Menghapus !!");
		
			$myquery = "DELETE FROM br_data WHERE id_brg='$id_brg' LIMIT 1";
			$hapus = mysql_query($myquery) or die ("<script type='text/javascript'> alert('Gagal menghapus');history.back();</script>");
		}
		echo "<script type='text/javascript'>  alert('Berhasil dihapus');window.location='?mod=barang';</script>";
	}
	else{
		echo "<script type='text/javascript'>  alert('Pilih data barang yang akan dihapus');window.location='?mod=barang';</script>";	
	}
}
//============================//
function br_supplier_simpan(){
	$id_sup=$_POST['id_sup'];
	$nm_sup=$_POST['nm_sup'];
	$almt_sup=$_POST['almt_sup'];
	$telp_sup=$_POST['telp_sup'];
	$sekarang=date("Y-m-d H:i:s");

	if(empty($id_sup)){
		echo "<script type='text/javascript'> alert('Isikan ID Supplier');history.back();</script>";
	}
	elseif(empty($nm_sup)){
		echo "<script type='text/javascript'> alert('Isikan Nama Supplier');history.back();</script>";
	}
	elseif(empty($almt_sup)){
		echo "<script type='text/javascript'> alert('Isikan Alamat Supplier');history.back();</script>";
	}
	elseif (empty($telp_sup)){
		echo "<script type='text/javascript'> alert('Isikan No Telepon/HP Supplier');history.back();</script>";
	}
	else{
		$cekdata="select id_sup FROM sup_data WHERE id_sup='$id_sup'";
		$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0){
				echo "<script type='text/javascript'> alert('ID Supplier Sudah Terpakai');history.back();</script>";
			}	
			else{
				mysql_query(" INSERT INTO sup_data (id_sup,nm_sup,almt_sup,telp_sup,wkt_ubah)"
						."values ('$id_sup','$nm_sup','$almt_sup','$telp_sup','$sekarang')") or die(mysql_error());
				echo "Berhasil";
			
			echo "<script type='text/javascript'>  alert('Data berhasil disimpan');window.location='?mod=supplier';</script>";
			}
	}
}
//============================//
function br_supplier_hapus(){
$jumlah=count($_POST["item"]);
if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_sup=$_POST["item"][$i];
	
		$myquery = "delete FROM sup_data WHERE id_sup='$id_sup' limit 1";
		$hapus = mysql_query($myquery) or die ("<script type='text/javascript'> alert('Gagal menghapus');history.back();</script>");
	
	}
	echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=supplier';</script>";
}
else{
	echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=supplier';</script>";
}
}
//============================//
function br_supplier_perbaharui(){
	$id_sup=$_POST['id_sup'];
	$nm_sup=$_POST['nm_sup'];
	$almt_sup=$_POST['almt_sup'];
	$telp_sup=$_POST['telp_sup'];
	$sekarang=date("Y-m-d H:i:s");

	if(empty($id_sup)){
		echo "<script type='text/javascript'> alert('Isikan ID Supplier');history.back();</script>";
	}	
	elseif(empty($nm_sup)){
		echo "<script type='text/javascript'> alert('Isikan Nama Supplier');history.back();</script>";
	}
	elseif(empty($almt_sup)){
		echo "<script type='text/javascript'> alert('Isikan Alamat Supplier');history.back();</script>";
	}
	elseif (empty($telp_sup)){
		echo "<script type='text/javascript'> alert('Isikan No Telepon/HP Supplier');history.back();</script>";
	}
	else{
		$qry="UPDATE sup_data SET nm_sup='$nm_sup',almt_sup='$almt_sup',telp_sup='$telp_sup',wkt_ubah='$sekarang' WHERE id_sup='$id_sup' LIMIT 1";
		mysql_query($qry) or die(mysql_error());
		echo "<script type='text/javascript'>  alert('Data berhasil diperbaharui');window.location='?mod=supplier';</script>";
	}
}

//============= Kategori ===============//
function br_kategori_simpan(){
	$id_kt_brg=$_POST['id_kt_brg'];
	$nm_kt_brg=$_POST['nm_kt_brg'];
	$sekarang=date("Y-m-d H:i:s");

	if(empty($id_kt_brg)){
		echo "<script type='text/javascript'> alert('Isikan ID Kategori');history.back();</script>";
	}
	elseif(empty($nm_kt_brg)){
		echo "<script type='text/javascript'> alert('Isikan Nama Kategori');history.back();</script>";
	}
	else{
		$cekdata="select id_kt_brg FROM br_kategori WHERE id_kt_brg='$id_kt_brg'";
		$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0){
				echo "<script type='text/javascript'> alert('ID Sudah Terpakai');history.back();</script>";
			}	
			else{
				mysql_query(" INSERT INTO br_kategori "
						."values ('$id_kt_brg','$nm_kt_brg','$sekarang')") or die(mysql_error());
				
				echo "<script type='text/javascript'>  alert('Data berhasil disimpan');window.location='?mod=barang_kategori';</script>";
			
			//header("location:?mod=barang_kategori");
			}
	}
	
}
function br_kategori_perbaharui(){
	$id_kt_brg=$_POST['id_kt_brg'];
	$nm_kt_brg=$_POST['nm_kt_brg'];
	$sekarang=date("Y-m-d H:i:s");

	if(empty($id_kt_brg)){
		echo "<script type='text/javascript'> alert('Isikan ID Kategori');history.back();</script>";
	}
	elseif(empty($nm_kt_brg)){
		echo "<script type='text/javascript'> alert('Isikan Nama Kategori');history.back();</script>";
	}
	else{
		$qry="UPDATE br_kategori SET nm_kt_brg='$nm_kt_brg',wkt_ubah='$sekarang' WHERE id_kt_brg='$id_kt_brg' LIMIT 1";
		mysql_query($qry) or die(mysql_error());
		echo "<script type='text/javascript'>  alert('Data berhasil diperbaharui');window.location='?mod=barang_kategori';</script>";
	}
			
}
function br_kategori_hapus(){
	$jumlah=count($_POST["item"]);
	for($i=0; $i < $jumlah; $i++){
		$id_kt_brg=$_POST["item"][$i];
	
		$myquery = "delete FROM br_kategori WHERE id_kt_brg='$id_kt_brg' limit 1";
		$hapus = mysql_query($myquery) or die (mysql_error());
	
	}
	echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=barang_kategori';</script>";	
}
function br_rak_simpan(){
	$nm_rak=$_POST['nm_rak'];
	$ket=$_POST['ket'];
	$sekarang=date("Y-m-d H:i:s");
	
	if (empty($nm_rak)){
		echo "<script type='text/javascript'> alert(' Isikan Nama Rak ');history.back();</script>";
	}
	else{
		$qry="INSERT INTO br_rak VALUE ('','$nm_rak','$ket','$sekarang')";
		mysql_query($qry) or die(mysql_error());
		echo "<script type='text/javascript'>  alert('Data berhasil disimpan');window.location='?mod=rak';</script>";
	}
	
}
function br_rak_perbaharui(){
	$id_rak=$_POST['id_rak'];
	$nm_rak=$_POST['nm_rak'];
	$ket=$_POST['ket'];
	$sekarang=date("Y-m-d H:i:s");

	if (empty($nm_rak)){
		echo "<script type='text/javascript'> alert(' Isikan Nama Rak');history.back();</script>";
	}
	else{
		$qry="UPDATE br_rak SET nm_rak='$nm_rak',ket='$ket', wkt_ubah='$sekarang' WHERE id_rak='$id_rak' LIMIT 1";
		mysql_query($qry) or die(mysql_error());
		echo "<script type='text/javascript'>  alert('Data berhasil diperbaharui');window.location='?mod=rak';</script>";
	}
}
function br_rak_hapus(){
	$jumlah=count($_POST["item"]);
	for($i=0; $i < $jumlah; $i++){
		$id_rak=$_POST["item"][$i];
	
		$myquery = "delete FROM br_rak WHERE id_rak='$id_rak' limit 1";
		$hapus = mysql_query($myquery) or die ("<script type='text/javascript'> alert('Gagal menghapus');history.back();</script>");
	
	}
	echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=rak';</script>";
}

function br_kualitas_simpan(){
	$id_kualitas = $_POST['id_kualitas'];
	$kualitas=$_POST['kualitas'];
	$sekarang=date("Y-m-d H:i:s");
	
	if(empty($id_kualitas)){
		echo "<script type='text/javascript'> alert('Isikan ID Kualitas');history.back();</script>";
	}
	elseif(empty($kualitas)){
		echo "<script type='text/javascript'> alert('Isikan Kualitas');history.back();</script>";
	}
	else{
		$cekdata="select id_kualitas FROM br_kualitas WHERE id_kualitas='$id_kualitas'";
		$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0){
				echo "<script type='text/javascript'> alert('ID Sudah Terpakai');history.back();</script>";
			}
			else{
			$qry=mysql_query("INSERT INTO br_kualitas VALUES('$id_kualitas','$kualitas','$sekarang')") or die(mysql_error());
			echo "<script type='text/javascript'>  alert('Data berhasil disimpan');window.location='?mod=barang_kategori';</script>";
		}
	}
}
function br_kualitas_perbaharui(){
	$id_kualitas = $_POST['id_kualitas'];
	$kualitas=$_POST['kualitas'];
	$sekarang=date("Y-m-d H:i:s");
	if(empty($kualitas)){
		echo "<script type='text/javascript'> alert('Isikan Kualitas');history.back();</script>";
	}
	else{
		$qry=mysql_query("UPDATE br_kualitas SET kualitas='$kualitas',wkt_ubah='$sekarang' WHERE id_kualitas='$id_kualitas'")or die(mysql_error());
		echo "<script type='text/javascript'>  alert('Data berhasil diperbaharui');window.location='?mod=barang_kategori';</script>";
	}
}
function br_kualitas_hapus(){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_kualitas=$_POST["item"][$i];
	
		$myquery = "DELETE FROM br_kualitas WHERE id_kualitas='$id_kualitas' limit 1";
		$hapus = mysql_query($myquery) or die ("<script type='text/javascript'> alert('Gagal menghapus');history.back();</script>");
	
	}
		echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=barang_kategori';</script>";
	}
	else{
		echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=barang_kategori';</script>";
	}
}
function br_satuan_simpan(){
	$id_satuan = $_POST['id_satuan'];
	$satuan=$_POST['satuan'];
	$sekarang=date("Y-m-d H:i:s");
	if(empty($id_satuan)){
		echo "<script type='text/javascript'> alert('Isikan ID Satuan');history.back();</script>";
	}
	elseif(empty($satuan)){
		echo "<script type='text/javascript'> alert('Isikan Satuan');history.back();</script>";
	}
	else{
		$cekdata="select id_satuan FROM br_satuan WHERE id_satuan='$id_satuan'";
		$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0){
				echo "<script type='text/javascript'> alert('ID Sudah Terpakai');history.back();</script>";
			}
			else{
				$qry=mysql_query("INSERT INTO br_satuan VALUES('$id_satuan','$satuan','$sekarang')");
				echo "<script type='text/javascript'>  alert('Data berhasil disimpan');window.location='?mod=barang_kategori';</script>";
			}
		}
}
function br_satuan_perbaharui(){
	$id_satuan = $_POST['id_satuan'];
	$satuan=$_POST['satuan'];
	$sekarang=date("Y-m-d H:i:s");
	if(empty($satuan)){
		echo "<script type='text/javascript'> alert('Isikan Satuan');history.back();</script>";
	}
	else{
		$qry=mysql_query("UPDATE br_satuan SET satuan='$satuan', wkt_ubah='$sekarang' WHERE id_satuan='$id_satuan'");
		echo "<script type='text/javascript'>  alert('Data berhasil diperbaharui');window.location='?mod=barang_kategori';</script>";
	}
}
function br_satuan_hapus(){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_satuan=$_POST["item"][$i];
	
		$myquery = "DELETE FROM br_satuan WHERE id_satuan='$id_satuan' limit 1";
		$hapus = mysql_query($myquery) or die ("<script type='text/javascript'> alert('Gagal menghapus');history.back();</script>");
		echo $id_satuan ."<br>";
	}
	echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=barang_kategori';</script>";	
	}
	else{
		echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=barang_kategori';</script>";
	}
}
function br_kendaraan_simpan(){
	$id_kendaraan = $_POST['id_kendaraan'];
	$kendaraan=$_POST['kendaraan'];
	$sekarang=date("Y-m-d H:i:s");
	if(empty($id_kendaraan)){
		echo "<script type='text/javascript'> alert('Isikan ID Kendaraan');history.back();</script>";
	}
	elseif(empty($kendaraan)){
		echo "<script type='text/javascript'> alert('Isikan Kendaraan');history.back();</script>";
	}
	else{
		$cekdata="select id_kendaraan FROM br_kendaraan WHERE id_kendaraan='$id_kendaraan'";
		$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0){
				echo "<script type='text/javascript'> alert('ID Sudah Terpakai');history.back();</script>";
			}
			else{
				$qry=mysql_query("INSERT INTO br_kendaraan VALUES('$id_kendaraan','$kendaraan','$sekarang')");
				echo "<script type='text/javascript'>  alert('Data berhasil disimpan');window.location='?mod=barang_kategori';</script>";	
			}
	}
}
function br_kendaraan_perbaharui(){
	$id_kendaraan = $_POST['id_kendaraan'];
	$kendaraan=$_POST['kendaraan'];
	$sekarang=date("Y-m-d H:i:s");
	if(empty($kendaraan)){
		echo "<script type='text/javascript'> alert('Isikan kendaraan');history.back();</script>";
	}
	else{
		$qry=mysql_query("UPDATE br_kendaraan SET kendaraan='$kendaraan', wkt_ubah='$sekarang' WHERE id_kendaraan='$id_kendaraan'");
		echo "<script type='text/javascript'>  alert('Data berhasil diperbaharui');window.location='?mod=barang_kategori';</script>";
	}
}
function br_kendaraan_hapus(){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_kendaraan=$_POST["item"][$i];
	
		$myquery = "DELETE FROM br_kendaraan WHERE id_kendaraan='$id_kendaraan' limit 1";
		$hapus = mysql_query($myquery) or die ("<script type='text/javascript'> alert('Gagal menghapus');history.back();</script>");
		
	}
	echo "<script type='text/javascript'>  alert('Data berhasil dihapus');window.location='?mod=barang_kategori';</script>";	
	}
	else{
		echo "<script type='text/javascript'>  alert('Pilih data yang akan dihapus');window.location='?mod=barang_kategori';</script>";
	}
}

//============= Lainnya ===============//
function pesan(){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_brg=$_POST["item"][$i];
	
		//manambahkan pesanan
		$qpesan=mysql_query("INSERT INTO sementara VALUES('pesan_barang','$id_brg')")or die ("<script type='text/javascript'> alert('Gagal menambahkan pesanan');history.back();</script>");
		//echo "<br><br><br>".$id_brg;
		
		//merubah data barang
		$dipesan=mysql_query("UPDATE br_data SET dipesan='1' WHERE id_brg='$id_brg'")or die ("<script type='text/javascript'> alert('Gagal dipesan');history.back();</script>");
		
		
		//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi="Barang";
		$pesan="Berhasil menambahkan pembelian barang dengan ID Barang (".$id_brg.") ";
		$sekarang = date("Y-m-d H:i:s");
		$log=" 	INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)
				values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
			//
	}
		echo "<script type='text/javascript'>  alert('Berhasil menambahkan pesanan');window.location='?mod=stok_kurang';</script>";	
	}
	else{
		echo "<script type='text/javascript'>  alert('Pilih data yang akan dipesan');window.location='?mod=stok_kurang';</script>";	
	}
}
function pesan_brg(){

	$id_sup=$_POST['id_sup'];
	$sekarang =date("Y-m-d  H:i:s");
	$jumlah=count($_POST["id_brg"]);
	for($i=0;$i<$jumlah;$i++){
		$no_pesan=$_POST['no_pesan'];
		$tgl_pesan=date("Y-m-d");
		$id_brg=$_POST['id_brg'][$i];
		$jml_brg=$_POST['jml_brg'][$i];
		$hrg_brg=$_POST['hrg_brg'][$i];
		$total = $jml_brg * $hrg_brg;
		
		if(!empty($jml_brg)){
			$qdetail="INSERT INTO br_pembelian_detail VALUES('','$no_pesan','$tgl_pesan','$id_sup','$id_brg','$hrg_brg','$jml_brg','$total','0','$sekarang')";
			$qhsem="DELETE FROM sementara WHERE value='$id_brg'";
			$qbrg="UPDATE br_data SET dipesan='2' WHERE id_brg='$id_brg'";
		
			mysql_query($qdetail) or die(mysql_error());
			mysql_query($qbrg) or die(mysql_error());
			mysql_query($qhsem) or die(mysql_error());
			echo "<script type='text/javascript'>history.back();</script>";
		}
		else{
			echo "<script type='text/javascript'>  alert('Isikan jumlah barang');history.back();</script>";	
		}
		
	}
}
function simpan_pesanan(){
	$no_pesan=$_POST['no_pesan'];
	$tgl_pesan=$_POST['tgl_pesan'];
	$id_pengguna=$_SESSION['id_pengguna'];
	$sekarang =date("Y-m-d  H:i:s");
	$q= mysql_query("SELECT SUM( total ) AS total, id_sup FROM  br_pembelian_detail WHERE no_pes='$no_pesan'");
	$d=mysql_fetch_object($q);
	
	$qsimpan = mysql_query("INSERT INTO br_pembelian VALUES('$no_pesan','$tgl_pesan','$d->id_sup','$d->total','0','$id_pengguna','$sekarang')") or die(mysql_error());

	//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi="Barang";
		$pesan="Berhasil menyelesaikan pemesanan barang dengan No Pesan (".$no_pesan.") ";
		$log=" 	INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)
				values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
	//
	echo "<script type='text/javascript'>  alert('Pemesanan berhasil disimpan');window.location='?mod=data_pembelian_br';</script>";			
}
function terima(){
	$no_pes = $_POST['no_pes'];
	$id_sup = $_POST['id_sup'];
	$jumlah=count($_POST["item"]);
	
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_brg=$_POST["item"][$i];
		
	$qjml=mysql_query("SELECT jml_brg FROM br_pembelian_detail WHERE no_pes='$no_pes' AND id_brg='$id_brg' ")OR DIE(mysql_error());	
	$djml=mysql_fetch_object($qjml);
	$jml_brg=$djml->jml_brg;
	
	$qstok=mysql_query("SELECT stok FROM br_data WHERE id_brg='$id_brg'")OR DIE(mysql_error());
	$dstok=mysql_fetch_object($qstok);
	$stok = $dstok->stok;
	
	$tambah = $stok + $jml_brg;
	
	

	$qbrg=mysql_query("UPDATE br_data SET stok='$tambah', dipesan='0' WHERE id_brg='$id_brg'") OR DIE (mysql_error());
	}
	
	echo "<script type='text/javascript'>history.back();</script>";
	}
else{echo "<script type='text/javascript'> alert('Pilih data yang diterima');history.back();</script>";}
}
function simpan_terima(){
	$no_pes = $_POST['no_pes'];
	$id_sup = $_POST['id_sup'];
	$sekarang = date("Y-m-d H:i:s");
	
	$q=mysql_query("SELECT SUM(total) AS total FROM br_pembelian_detail WHERE  no_pes='$no_pes' AND id_sup='$id_sup' AND diterima='1'")OR DIE(mysql_error());
	$d=mysql_fetch_object($q);
	$qterima = mysql_query("UPDATE br_pembelian SET total_pembayaran='$d->total', diterima='1' WHERE no_pes='$no_pes' AND id_sup='$id_sup' ") OR DIE(mysql_error());

	$bayar = $d->total;
	
	$qkeuangan=mysql_query("INSERT INTO keuangan VALUES('','$sekarang','Pembayaran pemesanan barang ($no_pes)','0','$bayar')") or die(mysql_error());
	
	//kembalikan status pesan barang untuk barang yang tidak ada
	$cari=mysql_query("SELECT id_brg FROM br_pembelian_detail WHERE no_pes='$no_pes' AND diterima='0'")or die (mysql_error());
		while($balik=mysql_fetch_object($cari)){
			mysql_query("UPDATE br_data SET dipesan='0' WHERE id_brg='$balik->id_brg'")or die(mysql_error());
			//echo $balik->id_brg;
		}
		
	//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi="Penerimaan Pemesanan Barang";
		$pesan="Berhasil menyelesaikan Penerimaan barang dengan No Pesan (".$no_pes.") ";
		$log=" 	INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)
				values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
	//
	echo "<script type='text/javascript'>  alert('Berhasil menambahkan antrian ');window.location='?mod=penerimaan_pembelian_br';</script>";
}
function tambah_antrian_label(){
	if(!empty($_POST['item'])){
		$jumlah=count($_POST["item"]);
		for($i=0; $i < $jumlah; $i++){
			$id_brg=$_POST["item"][$i];
			
			$cek ="SELECT * FROM sementara WHERE id_sementara='pencetakan_label' ";
			$cek_=mysql_query($cek) or die(mysql_error());
			//$data = mysql_fetch_object($cek_) or die (mysql_error());
			
			if(mysql_num_rows($cek_) >0){
				
				$delete = "DELETE  FROM sementara WHERE value='$id_brg' LIMIT 1";
				mysql_query($delete) or die(mysql_error());
			}
				
				$qry2 = "INSERT INTO sementara  VALUES ('pencetakan_label','".$id_brg."')";
				mysql_query($qry2) or die(mysql_error());
			
				//membuat log
				$pengguna=$_SESSION['nama_asli'];
				$lokasi="Pencetakan Label";
				$pesan="Berhasil menambahkan antrian pencetakan label untuk (".$id_brg.") ";
				$sekarang = date("Y-m-d H:i:s");
				$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
				"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
				mysql_query($log) or die (mysql_error());
			
		}
		echo "<script type='text/javascript'>  alert('Berhasil menambahkan antrian ');window.location='?mod=pencetakan_label';</script>";
	}
	else{
		echo "<script type='text/javascript'>  alert('Pilih data untuk ditambahkan dalam antrian');window.location='?mod=pencetakan_label';</script>";	
	}
}


if(isset($_POST['br_simpan'])){
	br_simpan();
}
elseif(isset($_POST['br_perbaharui'])){
	br_perbaharui();
}
elseif(isset($_POST['br_hapus'])){
	br_hapus();
}
elseif(isset($_POST['br_supplier_simpan'])){
	br_supplier_simpan();
}
elseif(isset($_POST['br_supplier_hapus'])){
	br_supplier_hapus();
}
elseif(isset($_POST['br_supplier_perbaharui'])){
	br_supplier_perbaharui();
}
elseif(isset($_POST['br_kategori_simpan'])){
	br_kategori_simpan();
}
elseif(isset($_POST['br_kategori_perbaharui'])){
	br_kategori_perbaharui();
}
elseif(isset($_POST['br_kategori_hapus'])){
	br_kategori_hapus();
}
elseif(isset($_POST['br_rak_simpan'])){
	br_rak_simpan();
}
elseif(isset($_POST['br_rak_perbaharui'])){
	br_rak_perbaharui();
}
elseif(isset($_POST['br_rak_hapus'])){
	br_rak_hapus();
}
elseif(isset($_POST['br_kualitas_simpan'])){
	br_kualitas_simpan();
}
elseif(isset($_POST['br_kualitas_perbaharui'])){
	br_kualitas_perbaharui();
}
elseif(isset($_POST['br_kualitas_hapus'])){
	br_kualitas_hapus();
}
elseif(isset($_POST['br_satuan_simpan'])){
	br_satuan_simpan();
}
elseif(isset($_POST['br_satuan_perbaharui'])){
	br_satuan_perbaharui();
}
elseif(isset($_POST['br_satuan_hapus'])){
	br_satuan_hapus();
}
elseif(isset($_POST['br_kendaraan_simpan'])){
	br_kendaraan_simpan();
}
elseif(isset($_POST['br_kendaraan_perbaharui'])){
	br_kendaraan_perbaharui();
}
elseif(isset($_POST['br_kendaraan_hapus'])){
	br_kendaraan_hapus();
}
elseif(isset($_POST['pesan'])){
	pesan();
}
elseif(isset($_POST['pesan_brg'])){
	pesan_brg();
}
elseif(isset($_POST['simpan_pesanan'])){
	simpan_pesanan();
}
elseif(isset($_POST['terima'])){
	terima();
}
elseif(isset($_POST['simpan_terima'])){
	simpan_terima();
}
elseif(isset($_POST['tambah_antrian_label'])){
	tambah_antrian_label();
}
else{
	echo "<script type='text/javascript'> alert('Tidak ada!'); history.back();</script>";
}

?>
