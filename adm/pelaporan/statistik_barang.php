<?php
	$lokasi="Statistik Barang";
echo"<html><body>";
		
	$a = mysql_query("SELECT * FROM br_data");
	$jml_brg=mysql_num_rows($a);
	
	$b = mysql_query("SELECT SUM(stok) AS tot_stok FROM br_data");
	$data2=mysql_fetch_object($b);
	$tot_stok = $data2->tot_stok;
	
	$qry_kt="SELECT id_kt_brg, nm_kt_brg FROM br_kategori";
	$kt=mysql_query($qry_kt) or die (mysql_error());
	$kt2=mysql_query($qry_kt) or die (mysql_error());
	
	$qry_kend="SELECT id_kendaraan, kendaraan FROM br_kendaraan";
	$kend=mysql_query($qry_kend) or die (mysql_error());
	$kend2=mysql_query($qry_kend) or die (mysql_error());
	
	$qry_kua="SELECT id_kualitas, kualitas FROM br_kualitas";
	$kua=mysql_query($qry_kua) or die (mysqli_error());
	$kua2=mysql_query($qry_kua) or die (mysqli_error());
	
	$qry_sat="SELECT id_satuan, satuan FROM br_satuan";
	$sat=mysql_query($qry_sat) or die (mysqli_error());
	$sat2=mysql_query($qry_sat) or die (mysqli_error());
	
	$qry_rak="SELECT id_rak, nm_rak FROM br_rak";
	$rak=mysql_query($qry_rak) or die (mysqli_error());
	$rak2=mysql_query($qry_rak) or die (mysqli_error());
	
	$qry_sup="SELECT id_sup, nm_sup FROM sup_data";
	$sup=mysql_query($qry_sup) or die (mysql_error());
	$sup2=mysql_query($qry_sup) or die (mysql_error());
	
	
	echo "<div class=\"konten\">";
	echo $iframe;
	?>
		<form><input class='noPrint' type='button' value='Cetak' onclick='window.print()'></form>
		<div class="lokasi"><label><?php echo $lokasi;?></label></div>
		
		<table class="table" cellpadding="10" cellspacing="0" border="0">
			<tr>
				<td width="150px">Total nama barang</td>
				<td width="5px">:</td>
				<td> <?php echo $jml_brg?></td>
			</tr>
			<tr>
				<td>Total stok barang </td>
				<td>:</td>
				<td><?php echo $tot_stok ?></td>
			</tr>
			<tr>
				<td colspan="3" class="judul-td"><label><strong>DATA PER NAMA BARANG</strong></label></td>
			</tr>
			<tr>
				<td valign="top">Barang per kategori barang</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($kt)){
						echo $data->nm_kt_brg . "<font class='a'>[ ";
						
						$a = mysql_query(" SELECT COUNT(`id_brg`) AS jml_kt FROM  `br_data` WHERE  `id_kt_brg` LIKE '%$data->id_kt_brg%'");
						while($b = mysql_fetch_object($a)){
							echo $b->jml_kt;
						}
						echo " ]</font>, ";
					}
					?>				
					<br><a href="pelaporan/grafik/1.1.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Barang per kualitas barang</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($kua)){
						echo $data->kualitas . " <font class='a'>[ ";
						
						$a = mysql_query(" SELECT COUNT(`id_brg`) AS jml_kt FROM  `br_data` WHERE  `id_kualitas` LIKE '%$data->id_kualitas%'");
						while($b = mysql_fetch_object($a)){
							echo $b->jml_kt;
						}
						echo " ]</font>, ";
					}
					?>				
					<br><a href="pelaporan/grafik/1.2.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Barang per satuan barang</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($sat)){
						echo $data->satuan . " <font class='a'>[ ";
						
						$a = mysql_query(" SELECT COUNT(`id_brg`) AS jml_kt FROM  `br_data` WHERE  `id_satuan`='$data->id_satuan'");
						while($b = mysql_fetch_object($a)){
							echo $b->jml_kt;
						}
						echo " ]</font>, ";
					}
					?>				
					<br><a href="pelaporan/grafik/1.3.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Barang per rak penyimpanan</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($rak)){
						echo $data->nm_rak . " <font class='a'>[ ";
						
						$a = mysql_query(" SELECT COUNT(`id_brg`) AS jml_kt FROM  `br_data` WHERE  `id_rak`='$data->id_rak'");
						while($b = mysql_fetch_object($a)){
							echo $b->jml_kt;
						}
						echo " ]</font>, ";
					}
					?>				
					<br><a href="pelaporan/grafik/1.4.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Barang per supplier</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($sup)){
						echo $data->nm_sup . " <font class='a'>[ ";
						
						$a = mysql_query(" SELECT COUNT(`id_brg`) AS jml_kt FROM  `br_data` WHERE  `id_sup`='$data->id_sup'");
						while($b = mysql_fetch_object($a)){
							echo $b->jml_kt;
						}
						echo " ]</font>, ";
					}
					?>				
					<br><a href="pelaporan/grafik/1.5.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="judul-td"><label><strong>DATA PER STOK BARANG</strong></label></td>
			</tr>
			<tr>
				<td valign="top">Stok barang per kategori barang</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					
					while($data2=mysql_fetch_object($kt2)){
						echo $data2->nm_kt_brg . "<font class='a'>[ ";
						
						$a2 = mysql_query(" SELECT SUM( IF(  id_kt_brg LIKE  '$data2->id_kt_brg',  stok , 0 ) ) AS  stok_kt FROM  br_data ");
						while($b2 = mysql_fetch_object($a2)){
							echo $b2->stok_kt;
						}
						echo " ]</font>, ";
					}
					?>				
					<br><a href="pelaporan/grafik/2.1.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Stok barang per kualitas barang</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($kua2)){
						echo $data->kualitas . " <font class='a'>[ ";
						
						$a = mysql_query(" SELECT SUM( IF(  id_kualitas LIKE  '$data->id_kualitas',  stok , 0 ) ) AS  kua FROM  br_data ");
						while($b = mysql_fetch_object($a)){
							echo $b->kua;
						}
						echo " ]</font>, ";
					}
					?>
					<br><a href="pelaporan/grafik/2.2.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Stok barang per satuan barang</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($sat2)){
						echo $data->satuan . " <font class='a'>[ ";
						
						$a = mysql_query(" SELECT SUM( IF(  id_satuan LIKE  '$data->id_satuan',  stok , 0 ) ) AS  sat FROM  br_data ");
						while($b = mysql_fetch_object($a)){
							echo $b->sat;
						}
						echo " ]</font>, ";
					}
					?>
					<br><a href="pelaporan/grafik/2.3.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Stok barang per rak penyimpanan</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($rak2)){
						echo $data->nm_rak. " <font class='a'>[ ";
						
						$a = mysql_query(" SELECT SUM( IF(  id_rak LIKE  '$data->id_rak',  stok , 0 ) ) AS  rak FROM  br_data ");
						while($b = mysql_fetch_object($a)){
							echo $b->rak;
						}
						echo " ]</font>, ";
					}
					?>
					<br><a href="pelaporan/grafik/2.4.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td valign="top">Stok barang per supplier</td>
				<td valign="top">:</td>
				<td valign="top">
					<?php
					while($data=mysql_fetch_object($sup2)){
						echo $data->nm_sup . " <font class='a'>[ ";
						
						$a = mysql_query(" SELECT SUM( IF(  id_sup LIKE  '$data->id_sup',  stok , 0 ) ) AS  sup FROM  br_data ");
						while($b = mysql_fetch_object($a)){
							echo $b->sup;
						}
						echo " ]</font>, ";
					}
					?>
					<br><a href="pelaporan/grafik/2.5.php" class="a" target="framepopup" onClick="setdisplay('divpopup',1)">Lihat dalam grafik</a>
				</td>
			</tr>
		
		
		</table>
	</div>
	
</body>

</html>
