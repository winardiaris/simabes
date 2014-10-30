<?php
function simpan_pengaturan(){
	$nm_bengkel=$_POST['nm_bengkel'];
	$telp1=$_POST['telp1'];
	$telp2=$_POST['telp2'];
	$almt_bengkel=$_POST['almt_bengkel'];
	
	if(empty($nm_bengkel)){
		echo "<script type='text/javascript'> alert('Isikan Nama Bengkel !');history.back();</script>";
	}
	elseif(empty($telp1) && empty($telp2)){
		echo "<script type='text/javascript'> alert('Isikan No Telepon !');history.back();</script>";
	}
	elseif(empty($almt_bengkel)){
		echo "<script type='text/javascript'> alert('Isikan Alamat Bengkel !');history.back();</script>";
	}
	else{
		if(!empty($_FILES["logo_bengkel"]["tmp_name"])){
			$namafolder="../img/";
			$jenis_gambar=$_FILES['logo_bengkel']['type'];
				if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
					$logo_bengkel = $namafolder . basename($_FILES['logo_bengkel']['name']);
						if(!move_uploaded_file($_FILES['logo_bengkel']['tmp_name'],$logo_bengkel)){
							die("Gambar gagal dikirim");
						}
						//Hapus logo_bengkel yang lama jika ada
						$res = mysql_query("select logo_bengkel from pengaturan where id='1' LIMIT 1");
						$d=mysql_fetch_object($res);
						if (strlen($d->logo_bengkel)>3){
							if (file_exists($d->logo_bengkel)) unlink($d->logo_bengkel);
						}                   
						//update logo_bengkel dengan yang baru
						mysql_query("UPDATE pengaturan SET logo_bengkel='$logo_bengkel' WHERE id='1' LIMIT 1");
					}
					else{
						echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
					
					}
			}
		$myqry="UPDATE pengaturan SET nm_bengkel='$nm_bengkel',telp1='$telp1',telp2='$telp2', almt_bengkel='$almt_bengkel' WHERE id='1' LIMIT 1";
		mysql_query($myqry) or die(mysql_error());
		//header("location:?mod=utama");
		echo "<script type='text/javascript'> alert('Pengaturan bengkel berhasil disimpan');window.location='?mod=utama';</script>";
	}	
}	
function simpan_pengguna(){
$nm_pengguna	=$_POST['nm_pengguna'];
$nm_asli		=$_POST['nm_asli'];
$kt_sandi		=$_POST['kt_sandi'];
$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
$kel_id			=$_POST['kel_id'];
$sekarang		=date("Y-m-d H:i:s");

	if(empty($nm_pengguna)){
		echo "<script type='text/javascript'> alert('Isikan Nama Pengguna !');history.back();</script>";
	}
	else if(empty($nm_asli)){
		echo "<script type='text/javascript'> alert('Isikan Nama Asli!');history.back();</script>";
	}
	else if(empty($kel_id)){
		echo "<script type='text/javascript'> alert('Pilih Kelompok Pengguna!');history.back();</script>";
	}
	else if(empty($kt_sandi)){
		echo "<script type='text/javascript'> alert('Isikan Kata Kunci !');history.back();</script>";
	}
	else if($kt_sandi != $ulang_kt_sandi){
		echo "<script type='text/javascript'> alert('Kata kunci tidak sama !'); history.back();</script>";
	}
	else{
		$cekdata="select nm_pengguna from dt_pengguna where nm_pengguna='".md5($nm_pengguna)."'";
		$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0){
				echo "<script type='text/javascript'> alert('Nama pengguna sudah terpakai');window.location='?mod=pengguna';</script>";
			}
			else{
				if(!empty($_FILES["photo_pengguna"]["tmp_name"])){
					$namafolder="../photo/";
					$jenis_gambar=$_FILES['photo_pengguna']['type'];
						if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
							$photo_pengguna = $namafolder . basename($_FILES['photo_pengguna']['name']);
								if(!move_uploaded_file($_FILES['photo_pengguna']['tmp_name'],$photo_pengguna)){
									echo "<script type='text/javascript'> alert('Gambar gagal dikirim');history.back();</script>";
								}
						}
						else{
							echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
						}
				}
				else{
					$photo_pengguna="../photo/default.png";
				}
				
				mysql_query(" 	insert into dt_pengguna (id_pengguna,nm_pengguna,nm_asli,kt_sandi,kel_id,photo_pengguna,wkt_ubah)
								values ('','".md5($nm_pengguna)."','$nm_asli','".md5($ulang_kt_sandi)."','$kel_id','$photo_pengguna','$sekarang')") or die(mysql_error());
			}
		
		
		
		echo "<script type='text/javascript'> alert('Data Berhasil Disimpan !'); window.location='?mod=pengguna'</script>";
	}
}
function perbaharui_pengguna(){
$id_pengguna	=$_POST['id_pengguna'];
$nm_asli		=$_POST['nm_asli'];
$kt_sandi		=$_POST['kt_sandi'];
$ulang_kt_sandi	=$_POST['ulang_kt_sandi'];
$kel_id			=$_POST['kel_id'];
$sekarang		=date("Y-m-d H:i:s");


if (empty($nm_asli)){
	echo "<script type='text/javascript'> alert('Isikan Nama Asli');history.back();</script>";
}
else if($kt_sandi != $ulang_kt_sandi){
		echo "<script type='text/javascript'> alert('Kata kunci tidak sama !'); history.back();</script>";
	}
else{
	if(!empty($_FILES["photo_pengguna"]["tmp_name"])){
			$namafolder="../photo/";
			$jenis_gambar=$_FILES['photo_pengguna']['type'];
				if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png"){
					$photo_pengguna = $namafolder . basename($_FILES['photo_pengguna']['name']);
						if(!move_uploaded_file($_FILES['photo_pengguna']['tmp_name'],$photo_pengguna)){
							die("Gambar gagal dikirim");
						}
						//Hapus photo_pengguna yang lama jika ada
						$res = mysql_query("select photo_pengguna from dt_pengguna where nm_pengguna='$nm_pengguna' LIMIT 1");
						$d=mysql_fetch_object($res);
						if (strlen($d->photo_pengguna)>3){
							if (file_exists($d->photo_pengguna)) unlink($d->photo_pengguna);
						}                   
						//update photo_pengguna dengan yang baru
						$a = "UPDATE dt_pengguna SET photo_pengguna='$photo_pengguna' WHERE  nm_pengguna='$nm_pengguna' LIMIT 1";
						mysql_query($a);
					}
					else{
						echo "<script type='text/javascript'> alert('jenis Gambar yang anda kirim salah. Harus .jpg .gif .png');history.back();</script>";
					
					}
	}
	if (!empty($kt_sandi) || !empty($ulang_kt_sandi)){
		$qry="update dt_pengguna set nm_asli='$nm_asli',kt_sandi='".md5($ulang_kt_sandi)."',kel_id='$kel_id',wkt_ubah='$sekarang' where id_pengguna='$id_pengguna' ";
	}
	else{
		$qry="update dt_pengguna set nm_asli='$nm_asli',kel_id='$kel_id',wkt_ubah='$sekarang' where id_pengguna='$id_pengguna' ";
	}
	mysql_query($qry) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=pengguna';</script>";
	
	}
}
function hapus_pengguna(){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_pengguna=$_POST["item"][$i];
	
		$myquery = "delete from dt_pengguna where id_pengguna='$id_pengguna' limit 1";
		$hapus = mysql_query($myquery) or die (" Gagal Menghapus !!");
	echo "<script type='text/javascript'> alert('Data berhasil dihapus');window.location='?mod=pengguna';</script>";
	}
	}
	else{
		echo "<script type='text/javascript'> alert('Pilih data yang akan dihapus');window.location='?mod=pengguna';</script>";
	}
}
function simpan_kelompok(){
	$nm_kel=$_POST['nm_kel'];
		
	if(empty($nm_kel)){
		echo "<script type='text/javascript'> alert('Isikan Nama Kelompok');history.back();</script>";
	}
	else{
		
	$myquery = " insert into kel_pengguna (nm_kel) values ('$nm_kel')";
	mysql_query($myquery) or die(mysql_error());
		
	$qry=mysql_query("SELECT kel_id  FROM kel_pengguna where nm_kel='$nm_kel'  LIMIT 1");
	$data=mysql_fetch_object($qry);
	$kel_id=$data->kel_id;
		
	$jumlah=count($_POST["menu"]);
	for($i=0; $i < $jumlah; $i++){
	$id_menu=$_POST["menu"][$i];	
	
		$myquery3="select * from kel_pengguna where kel_id='$kel_id'";
		$daftar=mysql_query($myquery3) or die (mysql_error());
		while($dataku=mysql_fetch_object($daftar)){

			$myquery2 = "insert into akses_pengguna (kel_id,id_menu,r) values ('".$dataku->kel_id."','$id_menu','1')";
			mysql_query($myquery2) or die(mysql_error());
		
		}
	}
	echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=kelompok';</script>";
	}
}
function hapus_kelompok(){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$kel_id=$_POST["item"][$i];
	
		$myquery = "delete from kel_pengguna where kel_id='$kel_id' limit 1";
		$hapus = mysql_query($myquery) or die (" Gagal Menghapus !!");
		
		$myquery2 = "delete from akses_pengguna where kel_id='$kel_id'";
		mysql_query($myquery2) or die (" Gagal Menghapus !!");
	
	}
	echo "<script type='text/javascript'> alert('Data berhasil dihapus');window.location='?mod=kelompok';</script>";
	}
	else{
		echo "<script type='text/javascript'> alert('Pilih data yang akan dihapus');window.location='?mod=kelompok';</script>";
	}
}
function perbaharui_kelompok(){
	$nm_kel=$_POST['nm_kel'];
	$kel_id=$_POST['kel_id'];
	
	if(empty($nm_kel)){
		echo "<script type='text/javascript'> alert('Isikan Nama kelompok');history.back();</script>";
	}
	else{
	$myquery = " update kel_pengguna set nm_kel='$nm_kel' where kel_id='$kel_id' ";
	mysql_query($myquery) or die(mysql_error());
		
	$qry=mysql_query("SELECT kel_id  FROM kel_pengguna where nm_kel='$nm_kel'  LIMIT 1");
	$data=mysql_fetch_object($qry);
	$kel_id=$data->kel_id;
		
		$myquery3 = "delete from akses_pengguna where kel_id='$kel_id'";
		mysql_query($myquery3) or die (" Gagal Menghapus !!");
		
	$jumlah=count($_POST["menu"]);
	for($i=0; $i < $jumlah; $i++){
	$id_menu=$_POST["menu"][$i];	
	
		$myquery2="select * from kel_pengguna where kel_id='$kel_id'";
		$daftar=mysql_query($myquery2) or die (mysql_error());
		
		while($dataku=mysql_fetch_object($daftar)){
			$myquery4 = "insert into akses_pengguna (kel_id,id_menu,r) values ('".$dataku->kel_id."','$id_menu','1')";
			mysql_query($myquery4) or die(mysql_error());
		}
	}
	echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=kelompok';</script>";
	}
}
//==========================================//
if(isset($_POST['simpan_pengaturan'])){
	simpan_pengaturan();
}
else if(isset($_POST['hapus_kelompok'])){
	hapus_kelompok();
}
else if(isset($_POST['perbaharui_kelompok'])){
	perbaharui_kelompok();
}
else if(isset($_POST['simpan_kelompok'])){
	simpan_kelompok();
}
else if(isset($_POST['perbaharui_pengguna'])){
	perbaharui_pengguna();
}
else if(isset($_POST['hapus_pengguna'])){
	hapus_pengguna();
}
else if(isset($_POST['simpan_pengguna'])){
	simpan_pengguna();
}
else{
	echo "<script type='text/javascript'> alert('Tidak ada Function !'); history.back();</script>";
}
?>
