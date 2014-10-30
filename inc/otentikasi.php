<?php
//session_start();
include('koneksi.php');
include('cek_login.php');

//tangkap data dari form login
$nm_pengguna 	= md5($_POST['nm_pengguna']);
$kt_sandi 		= md5($_POST['kt_sandi']);
 
 
//untuk mencegah sql injection
$nm_pengguna 	= mysql_real_escape_string($nm_pengguna);
$kt_sandi 		= mysql_real_escape_string($kt_sandi);

 
$q = mysql_query("select * from dt_pengguna where nm_pengguna='$nm_pengguna' and kt_sandi='$kt_sandi'");
$cek = mysql_num_rows($q);
	
	if($cek <> 0){
		$data = mysql_fetch_array($q);
		$sekarang = date("Y-m-d H:i:s");
		$_SESSION['id_pengguna']=$data['id_pengguna'];
		$_SESSION['id']=$_POST['nm_pengguna'];
		$_SESSION['nm_pengguna']= $nm_pengguna;
		$_SESSION['nama_asli'] = $data['nm_asli'];
		$_SESSION['kel_id'] = $data['kel_id'];
		$_SESSION['mulai'] = time();
		$_SESSION['habis'] = $_SESSION['mulai'] + (60*60);
				
		$sql_login =  mysql_query("UPDATE dt_pengguna SET terakhir_masuk = '$sekarang' WHERE nm_pengguna = '$nm_pengguna'");
		//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi="Masuk";
		$pesan="A:6:Pengguna (".$_SESSION['nama_asli'].") Berhasil masuk";
		$sekarang = date("Y-m-d H:i:s");
		$log=" INSERT INTO log_sistem VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
		//
		if(isset($_SESSION['kel_id'])){
			if ($_SESSION['kel_id'] == "2"){
				header('location:../');
			}
			else{
				header('location:../adm/');
			}
		}
		
	}
	else{
	//kalau nm_pengguna ataupun kt_sandi tidak terdaftar di database
    header('location:../login.php?error=1');
	}
?>
