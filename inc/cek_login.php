<?php
session_start();
//jika session username belum dibuat, atau session username kosong
if (!isset($_SESSION['nm_pengguna']) || empty($_SESSION['nm_pengguna'])) {
    //redirect ke halaman login
    header('location:../login.php');
}
elseif($_SESSION['kel_id']=='2'){
	header('location:index.php');
}
else{
	$now= time();
		if($now > $_SESSION['habis']){
			session_destroy();
			echo "<script>alert('Sesi anda telah habis. Silahkan masuk kembali !',document.location.href='../login.php')</script>";
			//header('location:http://localhost/simabes/inc/session.php');
		}
}
?>

