<?php
include ("../inc/koneksi.php");

$title = "Exporting Data Pelanggan";
$content_header = "<table>
					<tr>
						<th>ID Pelanggan</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Masa Berlaku</th>
					</tr>";
$content_footer = "</table>";
$content_dalam = "";
 
$sql = "SELECT * FROM `dt_pelanggan`";
$q   = mysql_query( $sql );
while( $r=mysql_fetch_array( $q ) ){
 
$data = "<tr><td>".$r['id_plg']."</td><td>".$r['nm_plg']."</td><td>".$r['almt_plg']."</td><td>".$r['masa_berlaku']."</td></tr>";
$content_dalam = $content_dalam ."\n". $data;
}
 
$content_sheet = $title . "\n" . $content_header . "\n" . $content_dalam . "\n" . $content_footer;
 
 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=export_dt_pelanggan.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $content_sheet;
?>

