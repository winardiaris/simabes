<?php
	$pel = new pelaporan();
	$lokasi="Pelaporan Pelayanan";
	$tampil = $pel->tampil_sejarah_ply();
	$banyak = count($tampil);
	echo'
	<div class="konten">'.$iframe.'
		<form><input class="noPrint"  type="button" value="Cetak" onclick="window.print()"></form>
		<div class="lokasi"><label>'.$lokasi.'</label></div>
		<table class="table" cellpadding="10" cellspacing="0" border="0">
			<tr><td width="150px">Total pelayanan</td><td width="5px">:</td>
				<td>'.$banyak.'</td></tr>
			<tr>
				<td>Total pelayanan per jenis pelayanan</td>
				<td>:</td>
				<td>';
				$tampil_kt_pelayanan = $pel->tampil_kt_pelayanan();
				foreach($tampil_kt_pelayanan as $kt){
					echo $kt['nm_kt_ply'] . " <font class='a'>[";
					$det = $pel->tampil_ply_detail("*","WHERE  `id_kt_ply`='".$kt['id_kt_ply']."'");
					echo count($det);
					
					echo"]</font>, ";

				}
				echo'
					<br><!-- <a href="#" class="a">Lihat dalam grafik</a> -->
				</td>
			</tr>
			<tr>
				<td>Rata-rata pelayanan per hari</td>
				<td>:</td>
				<td >';
				$rata2 = $pel->rata2_ply();
				echo $rata2." per hari";
							
				echo'
				</td>
			</tr>
			<tr>
				<td valign="top">Pelanggan yang belum pernah bertransaksi</td>
				<td valign="top">:</td>
				<td >';
				$belum = $pel->belum_transaksi();
				if(count($belum)>0){
					foreach($belum as $plg){
					echo "<font class='a'>[".$plg['id_plg']."]</font> ".$plg['nm_plg'];
					}
				}
				echo'
				</td>
			</tr>
		</table>
		<!-- ---------------------------------------------- -->
		
			<form class="form1" action="" method="get" name="fpencarian" id="fpencarian">
			<div class="alat">
			<input name="mod" value="pelaporan" type="hidden" >
			<input name="h" value="pelayanan" type="hidden" >
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
	$baris=0;
	if($banyak>0){
		foreach($tampil as $data){
			$baris++;
		$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
	
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$baris .'.</td>
		<td align="center" class="tidak_dicetak">
			<a href="pelayanan/struk_tr.php?no_struk='.$data['no_struk'].'" title="Detail Pelayanan" target="framepopup" onClick="setdisplay(\'divpopup\',1)">
				<img src="../img/daftar.png" height="20px" width="20px">
			</a>
		</td>	
		<td align="left">'.$data['no_struk'].'</td>
		<td align="center">'.$data['id_plg'].'</td>
		<td align="left">'.$data['nm_plg'].'</td>
		<td align="right">';
			$harga = $data['total_pembayaran'];
			$Format_Harga = number_format($harga, 0,',','.');
				echo "<span class=\"mu\">Rp. </span>".$Format_Harga;
			echo'
		</td>
		<td align="right">'.$data['tgl_struk'].'</td>
	</tr>';
	}
}
echo'</table></div><!-- konten -->';
?>
