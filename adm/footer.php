<?php
include ("../inc/koneksi.php");

$qry=mysql_query("SELECT * FROM `pengaturan`  LIMIT 1");
$data=mysql_fetch_object($qry);
echo'
<div id="notif" onclick=" $(\'#notif\').fadeOut(1000);"><p id="isinotif"></p></div>
<div class="footer">
    <div class="footer-wrapper">SIMaBeS (Sistem Informasi Manajemen Bengkel Sederhana) Versi '.$data->versi_aplikasi.' | &copy; 2014</div>
</div>
</body></html>';
?>
