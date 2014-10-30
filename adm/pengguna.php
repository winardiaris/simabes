<?php
$nm_pengguna=$_SESSION['nm_pengguna'];
$qpeng=mysql_query("SELECT * FROM dt_pengguna WHERE nm_pengguna='$nm_pengguna' LIMIT 1");
$dpeng=mysql_fetch_object($qpeng);

echo'
<div id="wrapper-pengguna">
		<!-- Pengguna -->
		<div id="pengguna">
			<div class="photo"><img src="'.$dpeng->photo_pengguna.'"></div>
			<div class="data">
				<p>'.$_SESSION['nama_asli'].'</p>
				'.$dpeng->terakhir_masuk.'
			</div>
		</div>
</div>';
?>
