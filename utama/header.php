<?php
	session_start();
	$a=mysql_query("SELECT * FROM pengaturan") OR DIE(mysql_error());
	$b=mysql_fetch_object($a);
	$namabengkel=$b->nm_bengkel;
	$alamat=$b->almt_bengkel;
	$telp=$b->telp1;
	$logo = substr($b->logo_bengkel,  3);
	
echo "
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
	<title>$aplikasi | Daily Build</title>
	<link rel='stylesheet' type='text/css' href='styler/utama.css'>
	<link rel='shortcut icon' href='img/icon.ico' />
	<script type='text/javascript' src='styler/iframe.js'></script>
	<meta name='generator' content='Geany 1.23.1' />
</head><body>
<div class='batas'>
		<script type=\"text/javascript\">
			var image1 = new Image()
			image1.src = \"img/bg/1.jpg\"
			var image2 = new Image()
			image2.src = \"img/bg/2.jpg\"
			var image3 = new Image()
			image3.src = \"img/bg/3.png\"
			var image4 = new Image()
			image4.src = \"img/bg/4.jpg\"
		</script>
<div class='header-utama'>
	<div class='info'><img src='".$logo."' class='logo'/>SiMaBeS | Sistem Informasi Manajemen Bengkel Sederhana</div>
	<div class='pengguna'>";
		if (!empty($_SESSION['nama_asli']))
			echo $_SESSION['nama_asli'] ."<div class='login'><a href='logout.php' class='keluar'>Keluar</a></div>";
		else
			echo "<a href='login.php' class='masuk'>Masuk</a>";
	echo"
	</div>
</div>
	
<div class='slide-show'>
<div class='text-slide'><p>
	<h1>$namabengkel</h1>
	<i>$alamat</i><br>
	$telp
	</p>
</div>
<img src='img/bg/1.jpg'  name='slide' class='image-slide'/>
<script type=\"text/javascript\">
      <!--
	//variable that will increment through the images
			var step=1
			function slideit(){
		//if browser does not support the image object, exit.
			if (!document.images)
			return
			document.images.slide.src=eval(\"image\"+step+\".src\")
			if (step<4)
			step++
			else
			step=1
		//call function \"slideit()\" every 5 seconds
			setTimeout(\"slideit()\",10000)
			}
			slideit()
		//-->
	</script>
	</div>
	<center>
	<div id='menu-wrapper'>
		<div class='isi-menu'>
		<a ";if(empty($_GET['mod'])){echo "class='menu2'";}else{ echo "class='menu'";} echo" href='index.php' title='Katalog ' >Katalog</a>
		<a ";if(!empty($_GET['mod']) AND $_GET['mod']=="info"){echo "class='menu2'";}else{ echo "class='menu'";} echo" href='?mod=info' title='Informasi bengkel' >Info Bengkel</a>
		<a ";if(!empty($_GET['mod']) AND $_GET['mod']=="bantuan"){echo "class='menu2'";}else{ echo "class='menu'";} echo" href='?mod=bantuan' title='Bantuan pencarian' >Bantuan</a>
		<a ";if(!empty($_GET['mod']) AND $_GET['mod']=="pengguna"){echo "class='menu2'";}else{ echo "class='menu'";} echo" href='?mod=pengguna' title='Area pengguna' >Area pengguna</a>
		<a ";if(!empty($_GET['mod']) AND $_GET['mod']=="tentang"){echo "class='menu2'";}else{ echo "class='menu'";} echo" href='?mod=tentang' title='Tentang Aplikasi' >Tentang Aplikasi</a>
		";
	echo"</div></div></center>";
?>
