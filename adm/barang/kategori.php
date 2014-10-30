<?php
	$lokasi="Kategori Barang";
	$brg = new barang();
	
	echo'
<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	
	<div id="TabbedPanels1" class="TabbedPanels">
	<ul class="TabbedPanelsTabGroup">
		<li class="TabbedPanelsTab" tabindex="0">Kategori Barang</li>
		<li class="TabbedPanelsTab" tabindex="0">Kualitas Barang</li>
		<li class="TabbedPanelsTab" tabindex="0">Satuan</li>
		<li class="TabbedPanelsTab" tabindex="0">Jenis Kendaraan</li>
	</ul>
	<div class="TabbedPanelsContentGroup">
		<div class="TabbedPanelsContent"><!-- Awal kategori barang -->
			<form class="form1" name="form1" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return confirm(\'Hapus Data Terpilih ?\')">
			<div class="alat">
				<a href="?mod='.$_GET['mod'].'&h=kategori_tambah"><input name="tambah_kategori" value="Tambah kategori barang" class="tambah" id="kiri" type="button"></a>
				<input name="br_kategori_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
				<input type="hidden" name="lokasi" value="'.$lokasi.'">
			</div>
			<table class="table" cellpadding="5" cellspacing="0" border="0" >
				<tr>
					<th align="right" width="10px">No.</th>
					<th align="center" width="10px"></th>
					<th align="center" width="10px">Sunting</th>
					<th align="center" width="15px">ID</th>
					<th align="center">Nama Kategori</th>
					<th align="center" width="120px">Terakhir diubah</th>
				</tr>';
					$baris=1;
					$tampil = $brg->tampil_kategori();
					foreach($tampil as $data){
						$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo'
				<tr class="'.$kolom.'">
					<td align="right">'.$baris++ .'.</td>
					<td align="center"><input name="item[]" id="item[]" value="'.$data['id_kt_brg'].'" type="checkbox"></td>
					<td align="center"><a href="?mod='.$_GET['mod'].'&h=kategori_sunting&id_kt_brg='.$data['id_kt_brg'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
					<td>'.$data['id_kt_brg'].'</td>
					<td>'.$data['nm_kt_brg'].'</td>
					<td align="center">'.$data['wkt_ubah'].'</td>
				</tr>';
				
				}
			echo'
			</table>
			</form>
		</div><!-- Akhir kategori barang -->
		<div class="TabbedPanelsContent"><!-- Awal kualitas barang -->
			<form class="form1" name="fkua_brg" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return confirm(\'Hapus Data Terpilih ?\')">
			<div class="alat">
				<a href="?mod='.$_GET['mod'].'&h=kualitas_tambah"><input name="tambah_kualitas" value="Tambah kualitas barang" class="tambah" id="kiri" type="button"></a>
				<input name="br_kualitas_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
			</div>
			<table class="table" cellpadding="5" cellspacing="0" border="0" >
				<tr>
					<th align="right" width="10px">No.</th>
					<th align="center" width="10px"></th>
					<th align="center" width="10px">Sunting</th>
					<th align="center" width="15px">ID</th>
					<th align="center">Kualitas</th>
					<th align="center" width="120px">Terakhir diubah</th>
				</tr>';
					$baris=1;
					$tampil = $brg->tampil_kualitas();
					foreach($tampil as $data){
						$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo'
				<tr class="'.$kolom.'">
					<td align="right">'.$baris++ .'.</td>
					<td align="center"><input name="item[]" id="item[]" value="'.$data['id_kualitas'].'" type="checkbox"></td>
					<td align="center"><a href="?mod='.$_GET['mod'].'&h=kualitas_sunting&id_kualitas='.$data['id_kualitas'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
					<td>'.$data['id_kualitas'].'</td>
					<td>'.$data['kualitas'].'</td>
					<td align="center">'.$data['wkt_ubah'].'</td>
				</tr>';
					}
			echo'
			</table>
			</form>
		</div><!-- Akhir kualitas barang -->
		<div class="TabbedPanelsContent"><!-- Awal Satuan -->
			<form class="form1" name="fsatuan_brg" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return confirm(\'Hapus Data Terpilih ?\')">
			<div class="alat">
				<a href="?mod='.$_GET['mod'].'&h=satuan_tambah"><input name="tambah_satuan" value="Tambah satuan" class="tambah" id="kiri" type="button"></a>
				<input name="br_satuan_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
			</div>
			<table class="table" cellpadding="5" cellspacing="0" border="0" >
				<tr>
					<th align="right" width="10px">No.</th>
					<th align="center" width="10px"></th>
					<th align="center" width="10px">Sunting</th>
					<th align="center" width="15px">ID</th>
					<th align="center">Satuan</th>
					<th align="center" width="120px">Terakhir diubah</th>
				</tr>'; 
					$baris=1;
					$tampil = $brg->tampil_satuan();
					foreach($tampil as $data){
						$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo'
				<tr class="'.$kolom.'">
					<td align="right">'.$baris++ .'.</td>
					<td align="center"><input name="item[]" id="item[]" value="'.$data['id_satuan'].'" type="checkbox"></td>
					<td align="center"><a href="?mod='.$_GET['mod'].'&h=satuan_sunting&id_satuan='.$data['id_satuan'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
					<td>'.$data['id_satuan'].'</td>
					<td>'.$data['satuan'].'</td>
					<td align="center">'.$data['wkt_ubah'].'</td>
				</tr>';
					}
			echo'
			</table>
			</form>
		</div><!-- akhir satuan -->
		<div class="TabbedPanelsContent"><!-- awal jenis kendaraan -->
			<form class="form1" name="fkendaraan_brg" method="post" action="?mod='.$_GET['mod'].'&h=aksi" onsubmit="return confirm(\'Hapus Data Terpilih ?\')">
			<div class="alat">
				<a href="?mod='.$_GET['mod'].'&h=kendaraan_tambah"><input name="tambah_kendaraan" value="Tambah jenis kendaraan" class="tambah" id="kiri" type="button"></a>
				<input name="br_kendaraan_hapus" value="Hapus Data Terpilih" class="hapus" id="kanan"  type="submit">
			</div>
			<table class="table" cellpadding="5" cellspacing="0" border="0" >
				<tr>
					<th align="right" width="10px">No.</th>
					<th align="center" width="10px"></th>
					<th align="center" width="10px">Sunting</th>
					<th align="center" width="15px">ID</th>
					<th align="center">Jenis Kendaraan</th>
					<th align="center" width="120px">Terakhir diubah</th>
				</tr>';
					$baris=1;
					$tampil = $brg->tampil_jenis_kendaraan();
					foreach($tampil as $data){
						$kolom= ($baris %2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo'
				<tr class="'.$kolom.'">
					<td align="right">'.$baris++ .'.</td>
					<td align="center"><input name="item[]" id="item[]" value="'.$data['id_kendaraan'].'" type="checkbox"></td>
					<td align="center"><a href="?mod='.$_GET['mod'].'&h=kendaraan_sunting&id_kendaraan='.$data['id_kendaraan'].'"><img src="../img/sunting.png" height="20px" width="20px"></a></td>
					<td>'.$data['id_kendaraan'].'</td>
					<td>'.$data['kendaraan'].'</td>
					<td align="center">'.$data['wkt_ubah'].'</td>
				</tr>';
				}
			echo'
			</table>
			</form>
		</div><!-- akhir jenis kendaraan -->
	</div>
	</div>

</div>

<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>';
?>
