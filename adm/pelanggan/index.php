<?php
	include ("submenu.php");
	include ("class.php");
	include ("notif.js");
	$h = $_GET['h'];	
	switch($h){
		
		case "tambah" :
		$view = "f_tambah.php";
		break;
		
		case "sunting" :
		$view = "f_sunting.php";
		break;
		
		case "data" :
		$view = "t_data.php";
		break;
		
		case "kadaluarsa" :
		$view = "t_kadaluarsa.php";
		break;
		
		case "kartu" :
		$view = "t_kartu.php";
		break;
		
		case "fungsi" :
		$view = "fungsi.php";
		break;
	}
	
	if(empty($_GET['h'])){
		header("location:?mod=".$_GET['mod']."&h=data");
	}
	else{
		include $view;
	}
	
?>
