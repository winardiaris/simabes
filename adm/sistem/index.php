<?php
	include ("submenu.php");
	include ("class.php");
	$h = $_GET['h'];	
	switch($h){
		
		case "aksi":
		$view = "aksi.php";
		break;
		case "bengkel":
		$view = "bengkel.php";
		break;
		case "pengguna":
		$view = "pengguna_daftar.php";
		break;
		case "pengguna_tambah":
		$view = "pengguna_tambah.php";
		break;
		case "pengguna_sunting":
		$view = "pengguna_sunting.php";
		break;
		case "kelompok":
		$view = "kelompok_daftar.php";
		break;
		case "kelompok_tambah":
		$view = "kelompok_tambah.php";
		break;
		case "kelompok_sunting":
		$view = "kelompok_sunting.php";
		break;
		case "log":
		$view = "catatan.php";
		break;
	}
	
	
	if(empty($_GET['h'])){
		header("location:?mod=".$_GET['mod']."&h=bengkel");
	}
	else{
		include $view;
	}

?>
