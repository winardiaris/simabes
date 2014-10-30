<?php
function simpan_pegawai(){
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
$sekarang 		= date("Y-m-d H:i:s");
$default		="simabes";
	

	if(empty($id_peg)){
		echo "<script type='text/javascript'> alert('Isikan ID pegawai');history.back();</script>";
	}
	elseif(empty($nm_peg)){
		echo "<script type='text/javascript'> alert('Isikan Nama pegawai');history.back();</script>";
	}
	elseif(empty($almt_peg)){
		echo "<script type='text/javascript'> alert('Isikan Alamat pegawai');history.back();</script>";
	}
	elseif (empty($telp_peg)){
		echo "<script type='text/javascript'> alert('Isikan No Telepon/HP pegawai');history.back();</script>";
	}
	else{
		$cekdata="select id_peg from dt_pegawai where id_peg='$id_peg'";
		$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0){
				echo "<script type='text/javascript'> alert('ID pegawai Sudah Terpakai');history.back();</script>";
			}
			else{
				if(!empty($_FILES["photo_peg"]["tmp_name"])){
					$namafolder="photo/pegawai/";
					$jenis_gambar=$_FILES['photo_peg']['type'];
						if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
							$photo_peg = $namafolder . basename($_FILES['photo_peg']['name']);
								if(!move_uploaded_file($_FILES['photo_peg']['tmp_name'],$photo_peg)){
									echo "<script type='text/javascript'> alert('Gambar gagal dikirim');history.back();</script>";
								}
						}
						else{
							echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
						}
				}
				else{
					$photo_peg="../photo/pegawai/default.png";
				}
				
				
				
				//Memasukan data ke database pegawai	
				if(empty($tgl_bergabung)){
					$qry=" 	insert into dt_pegawai (
							id_peg, nm_peg, jns_kelamin, tmpt_lahir, tgl_lahir, almt_peg, telp_peg,
							pend_peg, tgl_bergabung, photo_peg, pengalaman_peg, kel_id,  wkt_ubah)
							values (
							'$id_peg','$nm_peg','$jns_kelamin','$tmpt_lahir','$tgl_lahir','$almt_peg','$telp_peg','$pend_peg',
							'$hari_ini','$photo_peg','$pengalaman_peg','$kel_id','$sekarang'
							)";
				}
				else{
					$qry=" 	insert into dt_pegawai (
							id_peg, nm_peg, jns_kelamin, tmpt_lahir, tgl_lahir, almt_peg, telp_peg,
							pend_peg, tgl_bergabung, photo_peg, pengalaman_peg, kel_id, wkt_ubah)
							values (
							'$id_peg','$nm_peg','$jns_kelamin','$tmpt_lahir','$tgl_lahir','$almt_peg','$telp_peg','$pend_peg',
							'$tgl_bergabung','$photo_peg','$pengalaman_peg','$kel_id','$sekarang'
							)";
				}
				//Memasukan data ke database pengguna	
				$qry2=" insert into dt_pengguna 
						(id_pengguna,nm_pengguna,nm_asli,kel_id,photo_pengguna,kt_sandi,wkt_ubah) 
						values 
						('','".md5($id_peg)."','$nm_peg','$kel_id','$photo_peg','".md5($tgl_lahir)."','$hari_ini')";
				
				
				
				//eksekusi sql query
				mysql_query($qry) or die(mysql_error());
				mysql_query($qry2) or die(mysql_error());
				 
				//membuat log
				$pengguna=$_SESSION['nama_asli'];
				$lokasi=$_POST['lokasi'];
			
	
				$pesan="Berhasil menambahkan pegawai (".$_POST['nm_peg'].") dengan ID pegawai (".$_POST['id_peg'].")";
				$log=" insert into log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
				"values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
				mysql_query($log) or die (mysql_error());
				//
				
				echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pegawai';</script>";
				
				
			}
	}
	
}
//==========================================//

function pegawai_perbaharui(){
	$id_peg			=$_POST['id_peg'];
	$mid_peg		=md5($id_peg);
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
	$sekarang 		= date("Y-m-d H:i:s");

	if(empty($id_peg)){
		echo "<script type='text/javascript'> alert('Isikan ID pegawai');history.back();</script>";
	}
	elseif(empty($nm_peg)){
		echo "<script type='text/javascript'> alert('Isikan Nama pegawai');history.back();</script>";
	}
	elseif(empty($almt_peg)){
		echo "<script type='text/javascript'> alert('Isikan Alamat pegawai');history.back();</script>";
	}
	elseif (empty($telp_peg)){
		echo "<script type='text/javascript'> alert('Isikan No Telepon/HP pegawai');history.back();</script>";
	}
	else{
		if(!empty($_FILES["photo_peg"]["tmp_name"])){
			$namafolder="../photo/pegawai/";
			$jenis_gambar=$_FILES['photo_peg']['type'];
				if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
					$photo_peg = $namafolder . basename($_FILES['photo_peg']['name']);
						if(!move_uploaded_file($_FILES['photo_peg']['tmp_name'],$photo_peg)){
							die("Gambar gagal dikirim");
						}
						
						//Hapus photo_peg yang lama jika ada
						$res = mysql_query("select photo_peg from dt_pegawai where id_peg='$id_peg' LIMIT 1");
						$d=mysql_fetch_object($res);
						if($d->photo_peg!="../photo/pegawai/default.png"){
							if (strlen($d->photo_peg)>3){
								if (file_exists($d->photo_peg)) unlink($d->photo_peg);
							}
						}                   
						//update photo_peg dengan yang baru
						$a = "UPDATE dt_pegawai SET photo_peg='$photo_peg' WHERE id_peg='$id_peg' LIMIT 1";
						$b = "UPDATE dt_pengguna SET photo_pengguna='$photo_peg' WHERE  nm_pengguna='$id_peg' LIMIT 1";
						mysql_query($a);
						mysql_query($b);
					}
					else{
						echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
					
					}
		}
		
		//update data pegawai
			$qry="	UPDATE dt_pegawai SET 
					nm_peg='$nm_peg',
					jns_kelamin='$jns_kelamin',
					tmpt_lahir='$tmpt_lahir',
					tgl_lahir='$tgl_lahir',
					almt_peg='$almt_peg',
					telp_peg='$telp_peg',
					pend_peg='$pend_peg',
					tgl_bergabung='$tgl_bergabung', 
					pengalaman_peg='$pengalaman_peg',
					kel_id='$kel_id',
					wkt_ubah='$sekarang' 
					WHERE id_peg='$id_peg' ";
		
		//update data pengguna
		$sandi=md5($tgl_lahir);
		$qry2=" UPDATE dt_pengguna SET nm_asli='$nm_peg',kel_id='$kel_id',kt_sandi='$sandi',wkt_ubah='$sekarang' WHERE nm_pengguna='$mid_peg'";
		
		//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi=$_POST['lokasi'];
		$_SESSION['nama_asli'];
		$pesan="Berhasil memperbaharui pegawai (".$nm_peg.") dengan ID pegawai (".$id_peg.")";
		$sekarang = date("Y-m-d H:i:s");
		$log=" insert into log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
		"values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
		//
		
		mysql_query($qry) or die(mysql_error());
		mysql_query($qry2) or die(mysql_error());
		echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=pegawai';</script>";
	}
}
//==========================================//
function pegawai_hapus_terpilih(){
	$jumlah=count($_POST["item"]);
	
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_peg=$_POST["item"][$i];
		
		$q="select * from dt_pegawai where id_peg='$id_peg' ";
		$daftar=mysql_query($q) or die (mysql_error());
		while($dataku=mysql_fetch_object($daftar)){
			$qry2= "delete from dt_pengguna where nm_pengguna='".$dataku->id_peg."'";
			mysql_query($qry2) or die ("Gagal Menghapus !!");
		}
		
		//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi="Data pegawai";
		$_SESSION['nama_asli'];
		$pesan="Berhasil menghapus pegawai  dengan ID pegawai (".$id_peg.")";
		$sekarang = date("Y-m-d H:i:s");
		$log=" insert into log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
		"values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
		//

		$qry = "delete from dt_pegawai where id_peg='$id_peg' limit 1";
		mysql_query($qry) or die (" Gagal Menghapus !!");
	}
	echo "<script type='text/javascript'> alert('Data berhasil dihapus');window.location='?mod=pegawai';</script>";;
	}	
	else{
		echo "<script type='text/javascript'> alert('Pilih data yang akan dihapus');window.location='?mod=pegawai';</script>";
	}
}
//==========================================//
function pegawai_kartu_antri(){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_peg=$_POST["item"][$i];

		$qry="select * from dt_pegawai where id_peg='$id_peg' ";
		$daftar=mysql_query($qry) or die (mysql_error());
		
		$cek ="SELECT * FROM sementara where id_sementara like '%kartu%'";
		$cek_=mysql_query($cek) or die(mysql_error());
		
		if(mysql_num_rows($cek_) < 8){
		while($dataku=mysql_fetch_object($daftar)){
			$qry2 = "insert into sementara values ('kartu_pegawai','".$dataku->id_peg."')";
			mysql_query($qry2) or die(mysql_error());
			
			//membuat log
			$pengguna=$_SESSION['nama_asli'];
			$lokasi="Kartu pegawai";
			$_SESSION['nama_asli'];
			$pesan="Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (".$id_peg.") ";
			$sekarang = date("Y-m-d H:i:s");
			$log=" insert into log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
			"values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
			mysql_query($log) or die (mysql_error());
			//echo "<script type='text/javascript'> alert('Jumlah antrian sudah penuh');window.location='?mod=pelanggan_kartu';</script>";
		}
		}
		else{
			echo "<script type='text/javascript'> alert('Jumlah antrian sudah penuh');window.location='?mod=pegawai_kartu';</script>";
		}
	}
	echo "<script type='text/javascript'> alert('Data berhasil ditambahkan dalam antrian');window.location='?mod=pegawai_kartu';</script>";
	}
	else{
		echo "<script type='text/javascript'> alert('Pilih data untuk ditambahkan dalam antrian');window.location='?mod=pegawai_kartu';</script>";
	}
}
//==========================================//
if(isset($_POST['simpan_pegawai'])){
	simpan_pegawai();
}
else if(isset($_POST['pegawai_hapus_terpilih'])){

	pegawai_hapus_terpilih();
}
else if(isset($_POST['pegawai_perbaharui'])){
	pegawai_perbaharui();
}
else if(isset($_POST['pegawai_kartu_antri'])){
	pegawai_kartu_antri();
}
else{
	echo "<script type='text/javascript'> alert('Tidak ada!'); history.back();</script>";
}
?>
