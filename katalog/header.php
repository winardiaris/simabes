<?php
	session_start();
	$a=mysql_query("SELECT * FROM pengaturan") OR DIE(mysql_error());
	$b=mysql_fetch_object($a);
	$namabengkel=$b->nm_bengkel;
	$alamat=$b->almt_bengkel;
	$telp=$b->telp1;
	$logo = substr($b->logo_bengkel,  3);
	$info = $b->tentang_bengkel;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Simabes</title>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/fonts-custom.css" rel="stylesheet">
	<link href="css/katalog.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.js"></script>	
	<script src="styler/iframe.js"></script>
</head>
<body >
	 <!-- Navigation -->
    <nav class="navbar navbar-default  navbar-static-top " role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="#">SiMaBeS</a>
			<span class="navbar-text" >Sistem Informasi Manajemen Bengkel Sederhana</span>
		</div>
		<div class="collapse navbar-collapse" id="menu" style="float:right;">
		<ul class="nav navbar-nav  ">
			<li id="catalog" class="<?php if(!empty($_GET['mod']) AND $_GET['mod']=="catalog"){echo "active";} ?>" ><a href="?mod=catalog">Katalog</a></li>
			<li id="info" class="<?php if(!empty($_GET['mod']) AND $_GET['mod']=="info"){echo "active";} ?>" ><a href="?mod=info">Info Bengkel</a></li>
			<li id="help" class="<?php if(!empty($_GET['mod']) AND $_GET['mod']=="help"){echo "active";} ?>" ><a href="?mod=help">Bantuan</a></li>
			<li id="about" class="<?php if(!empty($_GET['mod']) AND $_GET['mod']=="about"){echo "active";} ?>" ><a href="?mod=about">Tentang Aplikasi</a></li>
			<li id="login"><a href="login.php">Masuk</a></li>
			<!-- <li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> aris <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>
					<li><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>
					<li><a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a></li>
					<li class="divider"></li>
					<li><a href="login.php?log=out"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
				</ul>
			</li> -->
		</ul>
		</div>
	</nav>
<div id="content">


