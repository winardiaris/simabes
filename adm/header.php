<?php
	$qpeng=mysql_query("SELECT * FROM pengaturan  LIMIT 1");
	$dpeng=mysql_fetch_object($qpeng);
	
	$qmenu="select id_menu  from akses_pengguna where  kel_id='".$_SESSION['kel_id']."' AND r='1' ";
	$dmenu=mysql_query($qmenu) or die (mysql_error());
echo'
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>'.$aplikasi." | ".strtoupper($_GET['mod']).' | Daily Build</title>
		<link rel="shortcut icon" href="../img/icon.ico" />
		<link rel="stylesheet" type="text/css" href="../styler/header.css">
		<link rel="stylesheet" type="text/css" href="../styler/style.css">

		<link rel="stylesheet" type="text/css" href="../styler/jquery-ui.css">	
		<link rel="stylesheet" type="text/css" href="../styler/jquery-ui.theme.css">	
		<script type="text/javascript" src="../styler/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="../styler/jquery-ui.js"></script>
		
		
		<link rel="stylesheet" type="text/css" href="../styler/toastr.css">	
		<script type="text/javascript" src="../styler/toastr.js"></script>
		<script type="text/javascript" src="../styler/toastr_option.js"></script>
		
		
		<script type="text/javascript" src="../styler/iframe.js"></script>
		<script type="text/javascript" src="../styler/check-uncheck.js"></script>
		
		<script src="../styler/tab.js" type="text/javascript"></script>
		<link href="../styler/tab.css" rel="stylesheet" type="text/css" />
		
		
</head>

<body >

<div class="header" >
	<div class="kiri">
		<a href="../index.php" target="_blank">
		<div class="logo"><img src="'.$dpeng->logo_bengkel.'"></div>
		<div class="namabengkel" >'.$dpeng->nm_bengkel.'</div></a>
	</div>
	<div class="kanan">
		<ul class="header-nav">';
		
			while ($dpengku2=mysql_fetch_object($dmenu)){
				$myquery="select *  from menu where id_menu='".$dpengku2->id_menu."'"; 
				$isi=mysql_query($myquery) or die (mysql_error());
				$dpengku=mysql_fetch_object($isi);
				
				echo "<a href='$dpengku->links' title='$dpengku->nm_menu' ><li class='$dpengku->class'><img class='img' src='$dpengku->icon'>$dpengku->nm_menu</li></a>"; 
			}
		echo'
		</ul>
	</div>
</div>
';
?>
