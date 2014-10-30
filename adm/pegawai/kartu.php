<?php
	$lokasi="Kartu Pegawai";
	require ("samping.php");
	
	$sql = "SELECT count( * ) as num FROM `sementara` WHERE id_sementara='kartu_pegawai' ";
	$result = mysql_query($sql);
	$result = mysql_fetch_assoc( $result );
	$jml = $result['num'];

	echo "<div class=\"konten\">";
	echo $iframe;
echo'
	<div class="lokasi">
		<label>'.$lokasi.'</label>
		<div class="kanan2">
			<form class="form1"action="?mod=pegawai_kartu" method="get" name="fpencarian" id="fpencarian">
			<label>Terdapat <font>'.$jml.'</font> dalam antrian menunggu untuk dicetak </label>
			<input name="mod" value="pegawai_kartu" class="btn-pencarian" type="hidden" >
			<input name="Submit" value=""  type="hidden" >
			<input value="'; if(!empty($_GET['cari'])){echo $_GET['cari'];} echo'" name="cari" id="cari" size="20" maxlength="50" class="text-pencarian" type="text"  placeholder="Pencarian pegawai" title="Pencarian"> 
			</form>
		</div>
	</div>

<form class="form1" name="fkonten" method="post" action="?mod=f_pegawai">
	<div class="alat">
		<input name="pegawai_kartu_antri" value="Tambahkan dalam antrian" class="tambah" id="kiri" type="submit">
		<a href="kartu.php" target="framepopup"  onClick="setdisplay(\'divpopup\',1)"><button type="button" class="cetak" id="kanan">Cetak Kartu pegawai</button></a>
	</div>
<table cellpadding="5" cellspacing="0" class="table">
<tr  class="kolom-header">
	<th align="right" width="10px">No.</th>
	<th align="center" width="10px"></th>
	<th align="center" width="80px">ID pegawai</th>
	<th align="center" width="150px">Nama</th>
	<th align="center">Alamat</th>
	<th align="center" width="100px">Nomor Telepon</td>
	<th align="center" width="100px">Jabatan</td>
</tr>';


 
$baris=1;
$baselink="?mod=pegawai_kartu"; 
$BarisPerHal = $jumlah_baris;  // jumlah data perhalaman

if(isset($_GET['page'])){
    $NoHal = $_GET['page'];
} 
else $NoHal = 1;

$offset = 1 + (($NoHal - 1) * $BarisPerHal);
$offset2=$offset - 1;
//
$query   = "SELECT COUNT(*) as jumData FROM `dt_pegawai`";
$hasil  = mysql_query($query);
$data     = mysql_fetch_array($hasil);
$jumData = $data['jumData'];


	if(!empty($_GET['cari'])) {
		$myquery="	SELECT * 
					FROM dt_pegawai 
					WHERE 
					id_peg='".$_GET['cari']."'OR 
					nm_peg LIKE '%".$_GET['cari']."%' 
					ORDER by id_peg ASC 
					LIMIT $offset2,  $BarisPerHal";
	}
	else {
		$myquery="	SELECT *  
					FROM dt_pegawai 
					ORDER by id_peg ASC 
					LIMIT $offset2, $BarisPerHal";
	}

$daftar	=mysql_query($myquery) or die (mysql_error());
$numrow	=mysql_num_rows($daftar);
	if($numrow==0){
		echo "<script type='text/javascript'> alert('Pegawai tidak ditemukan');history.back();</script>";
	}
	else{
		while($dataku=mysql_fetch_object($daftar)){
		$kolom= ($offset%2 == 1)? "kolom-ganjil" : "kolom-genap";
		echo'
	<tr class="'.$kolom.'">
		<td align="right">'.$offset++ .'.</td>
		<td align="center"><input name="item[]" id="item[]" value="'.$dataku->id_peg.'" type="checkbox"></td>
		<td align="center">'.$dataku->id_peg.'</td>
		<td>'.$dataku->nm_peg.'</td>
		<td>'.$dataku->almt_peg.'</td>
		<td align="left">'.$dataku->telp_peg.'</td>
		<td align="left">';
				$id=$dataku->kel_id;
				$a=mysql_query("SELECT nm_kel FROM kel_pengguna WHERE kel_id='$id'");
				$b=mysql_fetch_object($a);
				echo $b->nm_kel;
			echo'</td>
	</tr>';
		}//penutup dari while($dataku=mysql_fetch_object($daftar))
	}
echo'
</table>
	<div class="alat">
		<input name="pegawai_kartu_antri" value="Tambahkan dalam antrian" class="tambah" id="sendiri" type="submit">
	</div>';
	
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
echo'</form></div>';
?>
