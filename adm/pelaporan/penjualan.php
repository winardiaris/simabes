<?php
	$lokasi="Pelaporan Penjualan";
	$pel = new pelaporan();
	$tampil = $pel->tampil_sejarah_pl();
	$jml=count($tampil);
		
	echo'
	<div class="konten">'.$iframe.'
		<div class="lokasi"><label>'.$lokasi.'</label></div>
		<form><input class="noPrint" type="button" value="Cetak" onclick="window.print()"></form>
		<table class="table" cellpadding="10" cellspacing="0" border="0">
			<tr>
				<td width="150px">Total penjualan</td>
				<td width="5px">:</td>
				<td >'.$jml.'</td>
			</tr>
			<tr>
				<td>Rata-rata penjualan per hari</td>
				<td>:</td>
				<td >';
				$rata2 = $pel->rata2_pl();
				echo $rata2 ." per hari<br>";
				echo'</td>
			</tr>
			<tr>
				<td valign="top">10 Barang yang paling dicari</td>
				<td valign="top">:</td>
				<td >';
				$top_ten = $pel->top_ten();
				foreach($top_ten as $data){
					echo "<font class='a'>[".$data['id_brg']."]</font> ".$data['nm_brg']."<font class='a'> [".$data['terjual']."]</font><br>";
				}
					echo'
				</td>
			</tr>
			
		</table>
		<form class="form1" action="" method="get" name="fpencarian" id="fpencarian">
			<div class="alat">
			<input name="mod" value="pelaporan_penjualan" class="btn-pencarian" type="hidden" >
			<input name="cari" value="'; if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" id="cari" size="50" maxlength="50" class="text-pencarian2" type="text"  placeholder="No Struk / Nama pelanggan" title="Pencarian dengan No Struk"> 
			</div>
		</form>
	<table cellpadding="5" cellspacing="0" class="table">
<tr id="th">
	<th align="right" width="10px">No.</th>
	<th width="10px" class="tidak_dicetak"></th>
	<th align="center" width="130px">No Struk</th>
	<th align="center">Nama Pelanggan</th>
	<th align="center" width="100px">Total Pembayaran</th>
	<th align="center" width="100px">Tanggal</th>
</tr>';
 
$baris=0;
if($jml>0){
	foreach($tampil as $data){
		$baris++;
		$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
	echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$baris.'.</td>
		<td align="center" class="tidak_dicetak">
			<a href="pelayanan/struk_pl.php?no_struk='.$data['no_struk'].'" title="Detail Penjualan" target="framepopup" onClick="setdisplay(\'divpopup\',1)">
				<img src="../img/daftar.png" height="20px" width="20px">
			</a>
		</td>	
		<td align="left">'.$data['no_struk'].'</td>
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
echo'</table></div>	';
?>
