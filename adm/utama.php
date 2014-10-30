<?php
	
	$id_mod=1;
	include("../inc/cek_akses.php");
	
	echo "<body>";
	$myquery2="select * from akses_pengguna where  kel_id='".$_SESSION['kel_id']."' AND r='1'  AND id_menu!='1' AND id_menu!='8' ";
	$isi2=mysql_query($myquery2) or die (mysql_error());
	
	
	echo "<div class='konten-muka'>";

	while($dataku2=mysql_fetch_object($isi2)){	
		$myquery="SELECT *  FROM menu WHERE id_menu='".$dataku2->id_menu."' "; 
		$isi=mysql_query($myquery) or die (mysql_error());
		$dataku=mysql_fetch_object($isi);	
	
	echo "
	<a href='$dataku->links'>
	   <div class='isi-muka'>
		<div class='judul-muka'>$dataku->nm_menu</div>
		<div class='ket'>$dataku->value</div>
	   </div>
	</a>
	";
	}
	echo "</div>
	</body>
	</html>";
?>

	
	

