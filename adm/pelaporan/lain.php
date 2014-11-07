<?php
	$lokasi="Pelaporan";
	$baris=0;
	$id=$_GET['id'];

	echo"
	<div class='konten'>
		<div class='lokasi'><label>$lokasi ";if(isset($id)){echo $id;}echo"</label></div>
		<form><input class='noPrint' type='button' value='Cetak' onclick='window.print()'></form>
		<form class='form1' action='' method='GET' name='fpencarian' id='fpencarian'>
			<div class='alat'>
			<input name='mod' value='pelaporan_lain' class='btn-pencarian' type='hidden' >
			<input name='id' value='".$id."' class='btn-pencarian' type='hidden' >
			<input 
				name='cari' 
				value='";if(isset($_GET['cari'])){echo $_GET['cari'];}echo"' 
				id='cari' 
				size='50' 
				maxlength='50' 
				class='text-pencarian' 
				type='text'
				placeholder='";
					if($id=="pelanggan"){
						echo "ID / Nama Pelanggan";
					}
					elseif($id=="barang"){
						echo "ID / KODE / Nama Barang";
					}
					elseif($id=="supplier"){
						echo "ID / Nama Supplier";
					}
					elseif($id=="pegawai"){
						echo "ID / Nama Pegawai";
					}
					else{
						echo "aaa";
					}
					
				echo"'> 
			</div>
		</form>";
	
	if(empty($_GET['id'])){
		echo "tidak ada";	
	}
	elseif($id=="pelanggan"){
		// PELANGGAN ----------------------------------------------------
		echo"		
		<form class='form1' name='fkonten'>
			<table cellpadding='5' cellspacing='0' class='table'>
			<tr id='th'>
				<th align='right' width='10px'>No.</th>
				<th align='center' width='80px'>ID Pelanggan</th>
				<th align='center' width='150px'>Nama</th>
				<th align='center' width='20px'>L/P</th>
				<th align='center'>Alamat</th>
				<th align='center' width='100px'>Nomor Telepon</td>
				<th align='center' width='100px'>Registrasi</td>
				<th align='center' width='100px'>Masa Berlaku</td>
			</tr>";

		
			if(!empty($_GET['cari'])) {
				$myquery="	SELECT * FROM dt_pelanggan 
							WHERE 
							id_plg='".$_GET['cari']."' OR 
							nm_plg LIKE '%".$_GET['cari']."%' 
							ORDER by id_plg ASC ";
			}
			else {
				$myquery="	SELECT * FROM dt_pelanggan 
							ORDER by id_plg ASC ";
			}
			
			$daftar=mysql_query($myquery) or die (mysql_error());
			$numrow=mysql_num_rows($daftar);
			if($numrow==0){
				echo "<script type='text/javascript'> alert('Pelanggan tidak ditemukan');history.back();</script>";
			}
			else{
				while($dataku=mysql_fetch_object($daftar)){
				$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				$baris++;
			echo"	
	<tr class='$kolom'>
		<td align='right'>$baris.</td>
		<td align='center'>$dataku->id_plg</td>
		<td>$dataku->nm_plg</td>
		<td align='center'>$dataku->jns_kelamin</td>
		<td>$dataku->almt_plg</td>
		<td align='left'>$dataku->telp_plg</td>
		<td align='center'>$dataku->tgl_registrasi</td>
		<td align='center'>$dataku->masa_berlaku</td>
	</tr>";

				}//penutup dari while($dataku=mysql_fetch_object($daftar))
			}
	echo"</table>
		</form>";
		
		
	}// PELANGGAN ----------------------------------------------------
	// BARANG ----------------------------------------------------
	elseif($id=="barang"){
	echo"
		<form class='form1' name='fkonten'>
		<table cellpadding='5' cellspacing='0' class='table'>
		<tr id='th'>
			<th align='right' width='10px'>No.</th>
			<th align='center' width='60px'>ID Barang</th>
			<th align='center' width='100px'>Kode Barang</th>
			<th align='center'>Nama Barang</th>
			<th align='center' width='100px'>Harga</th>
			<th align='center' width='10px'>Stok</td>
			<th align='center' width='60px'>Kategori</th>
			<th align='center' width='60px'>Kualitas</th>
			<th align='center' width='100px'>Kendaraan</th>
		</tr>";
		if(!empty($_GET['cari'])) {
		$myquery="SELECT * FROM br_data WHERE 
				id_brg='".$_GET['cari']."' or 
				kode_brg='".$_GET['cari']."'or 
				nm_brg LIKE '%".$_GET['cari']."%' 
				ORDER by id_brg ASC ";
		}
		else {
		$myquery="SELECT * FROM br_data ORDER by id_brg asc";
		}
		$daftar=mysql_query($myquery) or die (mysql_error());
		$numrow=mysql_num_rows($daftar);
		if($numrow==0){
			echo "<script type='text/javascript'> alert('Barang tidak ditemukan');history.back();</script>";
		}
		else{
				while($data=mysql_fetch_object($daftar)){
					$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
					$baris++;
	echo"
	<tr class='$kolom'>
		<td align='right'>$baris .</td>
		<td align='center'>$data->id_brg</td>
		<td >$data->kode_brg</td>
		<td>$data->nm_brg</td>
		<td align='right'>";
			
				$harga = $data->hrg_jual;
				$Format_Harga = number_format($harga, 0,',','.');
				echo "<span class='mu'>Rp. </span>".$Format_Harga;
	echo"		
		</td>
		<td align='right'>$data->stok</td>
		<td align='center'>$data->id_kt_brg</td>
		<td align='center'>$data->id_kualitas</td>
		<td>";
			$qry2=mysql_query("SELECT * FROM br_data_perkendaraan WHERE id_brg='$data->id_brg'");
				while($data2=mysql_fetch_object($qry2)){
					$qry3=mysql_query("SELECT * FROM br_kendaraan WHERE id_kendaraan='$data2->id_kendaraan'");
					while($data3=mysql_fetch_object($qry3)){
							echo $data3->kendaraan .", ";
					}
				}
	echo"
		</td>
	</tr>";
	
			}//penutup dari while($data=mysql_fetch_object($daftar))
		}			
	echo"
	</table>
	</form>";
	}// Barang ----------------------------------------------------
	// SUPPLIER ----------------------------------------------------
	elseif($id=="supplier"){
	echo"	<form class='form1' name='fkonten'>
				<table class='table' cellpadding='5' cellspacing='0' border='0'>
				<tr>
					<th align='right' width='10px'>No.</th>
					<th align='center' width='80px'>ID Supplier</th>
					<th align='center' width='150px'>Nama</th>
					<th align='center' >Alamat</th>
					<th align='center' width='100px'>No Telp/HP</td>
				</tr>";
			if(!empty($_GET['cari'])) {
				$myquery="	SELECT * 
							FROM sup_data 
							WHERE id_sup='".$_GET['cari']."' 
							OR nm_sup LIKE '%".$_GET['cari']."%' 
							ORDER by id_sup ASC";
			}
			else {
				$myquery="	SELECT * 
							FROM sup_data 
							ORDER by id_sup ASC";
			}

			$daftar=mysql_query($myquery) or die (mysql_error());
			$numrow=mysql_num_rows($daftar) or die (mysql_error());
			if($numrow>0){
				while($data=mysql_fetch_object($daftar)){
					$baris++;
					$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
	
					echo"
					<tr class='$kolom'>
						<td align='right'> $baris.</td>
						<td align='center'> $data->id_sup</td>
						<td> $data->nm_sup</td>
						<td> $data->almt_sup</td>
						<td align='left'> $data->telp_sup</td>
					</tr>";
				}
			}
			else{
				echo "<script type='text/javascript'> alert('Supplier tidak ditemukan');</script>";
			}
	echo"	</table>
		</form>";
	}// SUPPLIER ----------------------------------------------------
	elseif($id=="pegawai"){// PEGAWAI ----------------------------------------------------
	echo"	<form class='form1' name='fkonten'>
				<table cellpadding='5' cellspacing='0' class='table'>
				<tr id='th'>
					<th align='right' width='10px'>No.</th>
					<th align='center' width='80px'>ID pegawai</th>
					<th align='center' width='150px'>Nama</th>
					<th align='center'>Alamat</th>
					<th align='center' width='20px'>L/P</th>
					<th align='center' width='100px'>Nomor Telepon</td>
				</tr>";
			if(!empty($_GET['cari'])) {
				$myquery="	SELECT * FROM dt_pegawai 
							WHERE 
							id_peg='".$_GET['cari']."' OR 
							nm_peg LIKE '%".$_GET['cari']."%' 
							ORDER by id_peg ASC";
			}
			else {
				$myquery="	SELECT * FROM dt_pegawai 
							ORDER by id_peg ASC";
			}

			$daftar=mysql_query($myquery) or die (mysql_error());
			$numrow=mysql_num_rows($daftar);
			if($numrow==0){
				echo "<script type='text/javascript'> alert('Pegawai tidak ditemukan');history.back();</script>";
			}
			else{	
				while($dataku=mysql_fetch_object($daftar)){
					$baris++;
					$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
					echo"
					<tr class='$kolom'>
						<td align='right'> $baris.</td>
						<td align='center'> $dataku->id_peg</td>
						<td> $dataku->nm_peg</td>
						<td> $dataku->almt_peg</td>
						<td align='center'> $dataku->jns_kelamin</td>
						<td align='left'> $dataku->telp_peg</td>
					</tr>";
				
				}
			}
	echo"
		</table>
		</form>";
	}// PEGAWAI ----------------------------------------------------
	echo"</div>";// KONTEN ----------------------------------------------------
	
	
?>
