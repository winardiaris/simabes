<?php
$baselink="?mod=katalog"; 
$BarisPerHal = 18;
if(isset($_GET['page'])){
    $NoHal = $_GET['page'];
} 
else $NoHal = 1;
$offset = 1 + (($NoHal - 1) * $BarisPerHal);
$offset2=$offset - 1;
$query   = "SELECT COUNT(*) as jumData FROM `br_data`";
$hasil  = mysql_query($query);
$data     = mysql_fetch_array($hasil);
$jumData = $data['jumData'];

		if(!empty($_GET['cari'])) {
			$qry="select * from br_data where kode_brg='".$_GET['cari']."'or nm_brg LIKE '%".$_GET['cari']."%' ORDER by id_brg asc LIMIT $offset2, $BarisPerHal";
		}
		elseif(!empty($_GET['kat'])){
			$qry="select * from br_data where id_kt_brg='".$_GET['kat']."' order by id_brg ASC LIMIT $offset2, $BarisPerHal";
		}
		else {
			$qry="select * from br_data ORDER by id_brg ASC  LIMIT $offset2, $BarisPerHal";
		}
		$daftar=mysql_query($qry) or die (mysql_error());
		$ada=mysql_num_rows($daftar);
	echo"
	<div class='konten'>
		<div id='divpopup' name='divpopup' class='dpop' style='display:none'>
		<iframe id='framepopup' name='framepopup' class='fpop' src='index.html'></iframe><br>
		<a href='#' class='btn-iframe' onClick=\"window.framepopup.location='inc/index.html';setdisplay('divpopup',0); return false\">Tutup</a>
		</div>
		<div class='wrapper-pencarian'>
				<div class='isi-pencarian'>
				<form method='GET' action='' name='fcari'>
				<input type='text' name='mod' value='katalog' class='hilang' >
				<input type='text' class='text-pencarian' placeholder='ID | Kode | Nama Barang' name='cari' value='";if(!empty($_GET['cari'])){echo $_GET['cari'];}echo"'>
				<input type='submit' name='p' value='Pencarian' class='btn-pencarian'>
				</form>
				</div>
		</div>
		<div id='wrapper-kategori'><div class='kategori'>";
		$qkat=mysql_query("SELECT id_kt_brg,nm_kt_brg FROM br_kategori") or die (mysql_error());
		while($dkat=mysql_fetch_object($qkat)){
			echo "<a  href='?mod=katalog&kat=$dkat->id_kt_brg'";if(!empty($_GET['kat'])){ if($_GET['kat']==$dkat->id_kt_brg){echo "class='selected'";}}echo">$dkat->nm_kt_brg</a>";
		}
	echo"	
		</div>";
		include ("utama/halaman.php");
	echo"</div>
		<div class='header-konten'>
			<h1>Katalog Barang</h1>
			<h3>Terdapat $ada Barang</h3>
		</div>
		<div class='isi-konten'>";
		
		//---------------------------
		if(mysql_num_rows($daftar)>0){	
			while($data=mysql_fetch_object($daftar)){
		
				echo "<a href='utama/lihat.php?id_brg=$data->id_brg' target='framepopup' onClick=\"setdisplay('divpopup',1)\">
				<div id='isi'>
				<img class='photo' src='adm/".$data->photo_brg."'>
				<div id='wrapper-ket'>
					<table border='0' cellpadding='0' cellspacing='0'>
					<tr>
						<td width='150px' height='25px'><label>".substr($data->nm_brg,0,15).""; if(strlen($data->nm_brg) > 15)
							echo "..."; echo"</label></td>
						<td rowspan='3' align='center'>Stok<div class='stok'>$data->stok</div></td>					
					</tr>
					<tr>
						<td height='25px'><span>"; 
						if(!empty($data->kode_brg)){
							echo substr($data->kode_brg,0,15) ;
							if(strlen($data->kode_brg) > 15)
							echo "...";
							echo " <br>";
						}
						else{
							echo substr($data->id_brg,0,15) ."<br>";
						}		
						$harga = $data->hrg_jual;
						$Format_Harga = number_format($harga, 0,',','.');			
						echo"</span></td>
					</tr>
					<tr>
						<td height='25px'><h1><span>Rp. $Format_Harga</span></h1></td>
					</tr>
					</table>
				</div>
				</div>
				</a>";
			}//penutup dari while($data=mysql_fetch_object($daftar))
		}//if(mysql_num_rows($daftar)>0)
		else{
			echo "<script type='text/javascript'> alert('Barang tidak ditemukan');history.back();</script>";
		}
		//---------------------------
	
		
	echo"</div>";
	
	if(empty($_GET['kat'])){
	echo"<br><br><br><br><br>
		<div class='header-konten2'>
			<h1>Kategori Service</h1>
		</div>
		<div class='isi-konten2'>
			<table border='0' cellpadding='5' cellspacing='0' align='center' class='table'>
				<tr class='judul-ket'>
					<th>Kategori Pelayanan</th>
					<th width='200px'>Biaya</th>
				</tr>
			</table>
			<table border='0' cellpadding='5' cellspacing='0' align='center' class='table2'>";
		$qply=mysql_query("SELECT * FROM ply_kategori")or die(mysql_error());
		$baris=0;
			while($dply=mysql_fetch_object($qply)){
				echo "
				<tr>
					<td>$dply->nm_kt_ply</td>
					<td width='200px' align='right'>";
					$biaya = $dply->biaya;
					$Format = number_format($biaya, 0,',','.');
					echo "<span class='mu'>Rp. </span>".$Format."</td>
				</tr>
				";
			}		
	echo "</table></div>";
	}
	echo"
	</div>	
	";

?>
