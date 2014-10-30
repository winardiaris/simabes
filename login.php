<?php
	include ("inc/konf.php");
	$lokasi="Masuk";
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $aplikasi. " ::. ".$lokasi;?></title>
<link rel="stylesheet" type="text/css" href="styler/login.css">
<link rel="shortcut icon" href="icon.ico" />
</head>
<body>
<?php
//kode php ini kita gunakan untuk menampilkan pesan eror
if (!empty($_GET['error'])) {
	if ($_GET['error'] == 1) {
	echo "<script type='text/javascript'> alert('Nama Pengguna dan Kata Sandi tidak terdaftar!');history.back();</script>";
    }
}
?>
<div class="FormLogin">
<form class="FLogin" name="FLogin" method="post" action="inc/otentikasi.php">
    <div class="border">
	<img src="img/login.png" class="logo">
	<input  name="nm_pengguna" id="nm_pengguna" type="text" size="20" maxlength="20" class="textlogin" placeholder="Nama Pengguna"/><br>
	<input  name="kt_sandi" id="kt_sandi" type="password" size="20" maxlength="20" class="textlogin" placeholder="Kata Sandi" /><br>

	<p align="right">
	   	<button class="btn-mrh" type="button" name="button" id="btn-mrh" onClick="window.location='index.php'">Katalog</button>
		<input class="btn" type="submit" name="button" id="btn" value="Masuk"/>
        </p><br/><br/><br/><br/><br/>
	<p align="center"><?php echo substr($aplikasi,0,7)?> <br/>(Sistem Informasi Manajemen Bengkel Sederhana)<br/>Copyleft &copy; 2014</p>	
    </div> 
</form>
</div>	
</body>
</html>
