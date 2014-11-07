<?php

	$lokasi="Statistik Pelanggan";
echo"<html><body>";

	

	
	$a = mysql_query("SELECT * FROM dt_pelanggan");
	$jml_plg=mysql_num_rows($a);
	
	$qry="SELECT id_plg, nm_plg, transaksi FROM dt_pelanggan WHERE transaksi!=0 ORDER BY transaksi DESC LIMIT 10";
	$b=mysql_query($qry) or die (mysql_error());
	$jml_plg_aktif=mysql_num_rows($b);
	
	$hari_ini=date("Y-m-d");
	$c=mysql_query("SELECT id_plg, nm_plg, transaksi FROM dt_pelanggan WHERE masa_berlaku < '$hari_ini'");
	$jml_plg_kadaluarsa=mysql_num_rows($c);
	
//}
//

//if(mysql_num_rows($daftarpelanggan)>0){	
	//while($dataku=mysql_fetch_object($daftarpelanggan)){
	?>
	<div class="konten">
		<div class="lokasi"><label><?php echo $lokasi;?></label></div>
		<form><input class='noPrint' type='button' value='Cetak' onclick='window.print()'></form>
		<table class="table" cellpadding="10" cellspacing="0" border="0">
			<tr>
				<td width="150px"><labell>Total pelanggan</labell></td>
				<td width="5px">:</td>
				<td ><?php echo $jml_plg?></td>
			</tr>
			<tr>
				<td><labell>Total pelanggan yang aktif</labell></td>
				<td>:</td>
				<td><?php echo $jml_plg_aktif?></td>
			</tr>
			<tr>
				<td><labell>Total pelanggan kedaluarsa</labell></td>
				<td>:</td>
				<td ><?php echo $jml_plg_kadaluarsa?></td>
			</tr>
			<tr>
				<td valign="top"><labell>10 Pelanggan paling aktif</labell></td>
				<td valign="top">:</td>
				<td >
					<?php
						while($plg=mysql_fetch_object($b)){
							echo "[ ".$plg->transaksi ." ] ".$plg->nm_plg ." (". $plg->id_plg .") <br>";
						}
					?>
				</td>
			</tr>
			
		</table>
	</div>
	
</body>

</html>
