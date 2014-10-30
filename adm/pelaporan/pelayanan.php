<?php
	$lokasi="Pelaporan Pelayanan";
	require ("samping.php");
	echo $iframe;
	
	echo'
	<div class="konten">
		<form><input class="noPrint"  type="button" value="Cetak" onclick="window.print()"></form>
		<div class="lokasi"><label>'.$lokasi.'</label></div>
		
		<table class="table" cellpadding="10" cellspacing="0" border="0">
			<tr>
				<td width="150px">Total pelayanan</td>
				<td width="5px">:</td>
				<td>';
					$qpel=mysql_query("SELECT no_struk FROM ply_");
					$jml=mysql_num_rows($qpel);
					echo $jml;
				echo'
				</td>
			</tr>
			<tr>
				<td>Total pelayanan per jenis pelayanan</td>
				<td>:</td>
				<td>';
						$qry_kt="SELECT id_kt_ply, nm_kt_ply FROM ply_kategori";
						$kt=mysql_query($qry_kt) or die (mysql_error());
						
						while($data=mysql_fetch_object($kt)){
							echo $data->nm_kt_ply . " <font class='a'>[ ";
						
							$a = mysql_query(" SELECT COUNT(`id`) AS jml_kt FROM  `ply_detail1` WHERE  `id_kt_ply`='$data->id_kt_ply'");
							while($b = mysql_fetch_object($a)){
								echo $b->jml_kt;
							}
							echo " ]</font>, ";
						}
				
				echo'
					<br><a href="#" class="a">Lihat dalam grafik</a>
				</td>
			</tr>
			<tr>
				<td>Rata-rata pelayanan per hari</td>
				<td>:</td>
				<td >';
				$qtgl=mysql_query("	SELECT MAX( tgl_struk ) AS tgl2, 
									MIN( tgl_struk ) AS tgl1,
									COUNT(*) AS jml FROM  `ply_`");
				$dtgl=mysql_fetch_object($qtgl);
				$tgl1=$dtgl->tgl1;
				$tgl2=$dtgl->tgl2;
				$jml=$dtgl->jml;
				
				$pecah1=explode("-",$tgl1);
				$date1=$pecah1[2];
				$month1=$pecah1[1];
				$year1=$pecah1[0];

				$pecah2=explode("-",$tgl2);
				$date2=$pecah2[2];
				$month2=$pecah2[1];
				$year2=$pecah2[0];

				$jd1=GregorianToJD($month1,$date1,$year1);
				$jd2=GregorianToJD($month2,$date2,$year2);
				$selisih=$jd2-$jd1 +1 ;

				$rata2=$jml / $selisih;
				
				echo $rata2 ." per hari<br>";				
				echo'
				</td>
			</tr>
			<tr>
				<td valign="top">Pelanggan yang belum pernah bertransaksi</td>
				<td valign="top">:</td>
				<td >';
				$qplg=mysql_query("SELECT nm_plg,transaksi FROM dt_pelanggan WHERE transaksi='0'");
				$jml=mysql_num_rows($qplg);
				
				while($data=mysql_fetch_object($qplg)){
					
					echo $data->nm_plg ." [ ".$data->transaksi." ]<br> ";
				}
				echo'
				</td>
			</tr>
		</table>
		<!-- ---------------------------------------------- -->
		
			<form class="form1" action="" method="get" name="fpencarian" id="fpencarian">
			<div class="alat">
			<input name="mod" value="pelaporan_pelayanan" class="btn-pencarian" type="hidden" >
			<input value="'; if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" name="cari" id="cari" size="50" maxlength="50" class="text-pencarian2" type="text"  placeholder="No Struk / ID pelanggan / Nama pelanggan " title="Pencarian dengan No Struk"> 
			</div>
			</form>
		
<table cellpadding="5" cellspacing="0" class="table">
<tr id="th">
	<th align="right" width="10px">No.</th>
	<th width="10px" class="tidak_dicetak"></th>
	<th align="center" width="130px">No Struk</th>
	<th align="center" width="80px">ID Pelanggan</th>
	<th align="center">Nama Pelanggan</th>
	<th align="center" width="100px">Total Pembayaran</th>
	<th align="center" width="100px">Tanggal</th>
</tr>';
$baris=1;
$baselink="?mod=sejarah_tr"; 
$BarisPerHal = $jumlah_baris;  // jumlah data perhalaman
if(isset($_GET['page']))
{
    $NoHal = $_GET['page'];
} 
else $NoHal = 1;
$offset = 1 + (($NoHal - 1) * $BarisPerHal);
$offset2=$offset - 1;
//
$query   = "SELECT COUNT(*) as jumData FROM `ply_`";
$hasil  = mysql_query($query);
$data     = mysql_fetch_array($hasil);
$jumData = $data['jumData'];



	if(!empty($_GET['cari'])) {
		$myquery="	SELECT * FROM ply_ 
					WHERE 
					no_struk='".$_GET['cari']."' OR 
					id_plg='".$_GET['cari']."' OR 
					nm_plg LIKE '%".$_GET['cari']."%'  
					ORDER BY wkt_ubah DESC 
					LIMIT $offset2, $BarisPerHal";
	}
	else {
		$myquery="	SELECT * FROM ply_ 
					ORDER by wkt_ubah DESC 
					LIMIT $offset2, $BarisPerHal";
	}
$daftar=mysql_query($myquery) or die (mysql_error());
$numrow=mysql_num_rows($daftar);
	if($numrow==0){
		echo "<script type='text/javascript'> alert('Pelaporan pelayanan tidak ditemukan');history.back();</script>";
	}
	else{
	
	while($data=mysql_fetch_object($daftar)){
		$kolom= ($offset%2 == 1)? "kolom-ganjil" : "kolom-genap";
	
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$offset++ .'.</td>
		<td align="center" class="tidak_dicetak">
			<a href="pelayanan/struk_tr.php?no_struk='.$data->no_struk.'" title="Detail Pelayanan" target="framepopup" onClick="setdisplay(\'divpopup\',1)">
				<img src="../img/daftar.png" height="20px" width="20px">
			</a>
		</td>	
		<td align="left">'.$data->no_struk.'</td>
		<td align="center">'.$data->id_plg.'</td>
		<td align="left">'.$data->nm_plg.'</td>
		<td align="right">';
			$harga = $data->total_pembayaran;
			$Format_Harga = number_format($harga, 0,',','.');
				echo "<span class=\"mu\">Rp. </span>".$Format_Harga;
			echo'
		</td>
		<td align="right">'.$data->tgl_struk.'</td>
	</tr>';
	}//penutup dari while($data=mysql_fetch_object($daftar))
}

echo'</table>';

	if(!empty($_GET['cari'])) {//navigasi Halaman
		//jika melakukan pencarian tombol navigasi tidak tampil
	}
	else{
		$jumPage = ceil($jumData/$BarisPerHal);
		echo "<div class='navigasi'>";
		if ($NoHal > 1) echo  "<a class='page' href='$baselink&page=".($NoHal-1)."'>&lt;&lt; Sebelum</a>";
	
		$showPage=0;
		for($page = 1; $page <= $jumPage; $page++){
			if ((($page >= $NoHal - 3) && ($page <= $NoHal + 3)) || ($page == 1) || ($page == $jumPage)) {   
			
				if (($showPage == 1) && ($page != 2))
				echo "..."; 
				
				if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
				echo "...";
				
				if ($page == $NoHal)
				echo " <span class='selected'>".$page."</span> ";
				else 
				echo " <a class='page' href='$baselink&page=".$page."'>".$page."</a> ";
				$showPage = $page;          
			}
		}
	
	if ($NoHal < $jumPage) echo "<a class='page' href='$baselink&page=".($NoHal+1)."'>Berikut &gt;&gt;</a>";
	echo "</div>";
	}
		
	echo'	
	</div><!-- konten -->
	';
?>
