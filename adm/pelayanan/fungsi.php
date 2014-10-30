<?php
include ("../inc/koneksi.php");
include ("../inc/cek_login.php");
///
function simpan_wo(){
	$no_wo 				= $_POST['no_wo'];
	$id_plg 			= $_POST['id_plg'];
	$no_polisi 			= $_POST['no_polisi'];
	$no_mesin 			= $_POST['no_mesin'];
	$jns_kendaraan 		= $_POST['jns_kendaraan'];
	$km_terakhir 		= $_POST['km_terakhir'];
	$keluhan 			= $_POST['keluhan'];
	$sekarang 			= date("Y-m-d H:i:s");
	$hari_ini 			= date("Y-m-d");
		
	if(empty($id_plg)){
		echo "<script type='text/javascript'> alert('Isikan ID Pelanggan !');history.back();</script>";
	}
	elseif(empty($no_polisi)){
		echo "<script type='text/javascript'> alert('Isikan No. Polisi !');history.back();</script>";
	}
	else{
		$qry = "INSERT INTO ply_wo 
				(no_wo,id_plg,tgl_wo,no_polisi,no_mesin,jns_kendaraan,km_terakhir,keluhan,wkt_ubah) 
				VALUES
				('$no_wo','$id_plg','$hari_ini','$no_polisi','$no_mesin','$jns_kendaraan','$km_terakhir','$keluhan','$sekarang') ";
		mysql_query ($qry) or die (mysql_error());
		
		echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pelayanan';</script>";
	}
	
}

//

function tmbh_brg(){
	$cari_brg	=$_POST['cari_brg'];
	$jml_brg	=$_POST['jml_brg'];
	$no_struk	=$_POST['no_struk'];
	$hari_ini 	= date("Y-m-d");
	
	if(empty($cari_brg)){
		echo "<script type='text/javascript'> alert('Isikan barang !');history.back();</script>";
	}
	elseif(empty($jml_brg)){
		echo "<script type='text/javascript'> alert('Isikan jumlah beli');history.back();</script>";
	}
	else{
		$qry="	SELECT id_brg, nm_brg, hrg_jual, stok, terjual FROM br_data WHERE id_brg='$cari_brg' 
				OR kode_brg='$cari_brg' OR nm_brg='$cari_brg'  ORDER by id_brg ASC";
		$daftar=mysql_query($qry) or die (mysql_error());
		$data=mysql_fetch_object($daftar);
		
		if($cek=mysql_num_rows($daftar)>0){
			if($data->stok <= 0){
				echo "<script type='text/javascript'> alert('Stok untuk $cari_brg habis atau tidak cukup!!!');history.back();</script>";
			}
			elseif ($data->stok < $jml_brg){
				echo "<script type='text/javascript'> alert('Stok KURANG !!!');history.back();</script>";
			}	
			else{
			
			$cek = mysql_query("SELECT id_brg,jml_brg FROM ply_penjualan_detail WHERE no_struk='$no_struk' AND id_brg='$data->id_brg'");
			$a=mysql_fetch_object($cek);
				if($ada=mysql_num_rows($cek)>0){
					$tambah = $a->jml_brg + $jml_brg;
					$total= $data->hrg_jual * $tambah;
					$qry2=	" UPDATE ply_penjualan_detail SET jml_brg='$tambah', total='$total' WHERE no_struk='$no_struk' AND id_brg='$data->id_brg'";
				}
				else{
					$total= $data->hrg_jual * $jml_brg;
					$qry2 = " INSERT INTO ply_penjualan_detail VALUES
							('$no_struk','$data->id_brg','$jml_brg','$total','$hari_ini') ";
			
				}
				$kurang=$data->stok - $jml_brg;
				$tterjual=$data->terjual + $jml_brg;
				$qry3 = "UPDATE br_data SET stok='$kurang', terjual='$tterjual' WHERE id_brg='$data->id_brg'";
		
				mysql_query($qry2) or die(mysql_error());
				mysql_query($qry3) or die(mysql_error());
	
				echo "<script type='text/javascript'>history.back();</script>";
			}
		}
		else{
			echo "<script type='text/javascript'> alert('Barang [$cari_brg] tidak ada!!!');history.back();</script>";
		}
	}
}

function tmbh_pel(){
	$cari_pel	=$_POST['cari_pel'];
	$no_struk	=$_POST['no_struk'];
	$hari_ini 	= date("Y-m-d");
	
	if(empty($cari_pel)){
		echo "<script type='text/javascript'> alert('Isikan kategori pelayanan !');history.back();</script>";
	}
	elseif(!empty($cari_pel)){
		
	$qry = "SELECT * FROM ply_kategori WHERE id_kt_ply='$cari_pel' OR nm_kt_ply LIKE '%$cari_pel%' ORDER BY id_kt_ply ASC ";
	$daftar=mysql_query($qry) or die (mysql_error());
		if($ada=mysql_num_rows($daftar)>0){
			$data=mysql_fetch_object($daftar);
			$qry2 = "INSERT INTO ply_detail 
					VALUES ('$no_struk','$data->id_kt_ply','$hari_ini') ";
			mysql_query($qry2) or die(mysql_error());
		}
		else{
			echo "<script type='text/javascript'> alert('Kategori pelayanan ($cari_pel) tidak ada !');history.back();</script>";
		}
	
	echo "<script type='text/javascript'>history.back();</script>";
	}
}
function simpan_wo_dua(){
	$no_struk			=$_POST['no_struk'];
	$no_wo				=$_POST['no_wo'];
	$tgl_trans			=$_POST['tgl_trans'];

	$saran				=$_POST['saran'];
	$id_peg				=$_POST['id_peg'];
	$id_pengguna		=$_POST['id_pengguna'];
	
	$sekarang 			= date("Y-m-d H:i:s");
	$hari_ini			= date("Y-m-d");
	
	
	if(empty($id_peg)){
		echo "<script type='text/javascript'> alert('Mekanik tidak boleh kosong');history.back();</script>";
	}
	else{
		$qry="	INSERT INTO ply_ VALUES ('$no_struk','$no_wo','$hari_ini','','','','$sekarang')";
		
		$qry2="	UPDATE ply_wo SET saran='$saran', id_peg='$id_peg', status='1', wkt_ubah='$sekarang' WHERE no_wo='$no_wo'";
		 
		mysql_query($qry) or die(mysql_error());
		mysql_query($qry2) or die(mysql_error());
	
		echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=wo';</script>";
	}
	
}

function update_wo(){
	$no_struk			=$_POST['no_struk'];
	$no_wo				=$_POST['no_wo'];
	$saran				=$_POST['saran'];	
	$sekarang 			= date("Y-m-d H:i:s");
	$hari_ini			= date("Y-m-d");
	
		$qry="	UPDATE ply_ SET wkt_ubah='$sekarang' WHERE no_struk='$no_struk' AND no_wo='$no_wo'";
		
		 
		if(!empty($_POST['selesai'])){
			$qry2="	UPDATE ply_wo SET saran='$saran', status='".$_POST['selesai']."', wkt_ubah='$sekarang' WHERE no_wo='$no_wo'";
		}
		else{
			$qry2="	UPDATE ply_wo SET saran='$saran', wkt_ubah='$sekarang' WHERE no_wo='$no_wo'";
		}
		mysql_query($qry) or die(mysql_error());
		mysql_query($qry2) or die(mysql_error());
	
	
}
function ply_simpan(){
	$no_struk			=$_POST['no_struk'];
	$no_wo				=$_POST['no_wo'];
	$tot_bayar			=$_POST['tot_bayar'];
	$id_pengguna		=$_POST['id_pengguna'];
	
	$sekarang 			= date("Y-m-d H:i:s");
	$hari_ini			= date("Y-m-d");
	
		$qry="	UPDATE ply_ SET total_pembayaran='$tot_bayar', id_pengguna='$id_pengguna', wkt_ubah='$sekarang' WHERE no_struk='$no_struk' AND no_wo='$no_wo'";
		
		 
		mysql_query($qry) or die(mysql_error());
	//yang belom histori dan perubahan data status pembelian di dt_pelanggan
	
		
	
	
	
}

function ply_selesai(){
	$no_struk = $_POST['no_struk'];
	$uang_bayar=$_POST['bayar'];
	$sekarang 		= date("Y-m-d H:i:s");
	
	$qry=mysql_query("UPDATE ply_ SET uang_bayar='$uang_bayar', wkt_ubah='$sekarang' WHERE no_struk='$no_struk' ") or die (mysql_error());
	
	
	
	//menambah jumlah catatan pembelian
		$a = mysql_query("SELECT ply_wo.id_plg FROM ply_wo inner join ply_ on ply_wo.no_wo = ply_.no_wo WHERE no_struk='$no_struk'") or die(mysql_error());
		$da = mysql_fetch_object($a);
		
		$id_plg = $da->id_plg;
	
		$a=mysql_query("SELECT transaksi FROM dt_pelanggan WHERE id_plg='$id_plg'");
		$plg=mysql_fetch_object($a);
		$transaksi = $plg->transaksi + 1;
		mysql_query("UPDATE dt_pelanggan SET transaksi='$transaksi' WHERE id_plg='$id_plg'");
	
	//membuat log
		$pengguna=$_SESSION['nama_asli'];
		$lokasi="Transaksi Pelayanan";
		$pesan="Transaksi Pelayanan dengan No Struk ($no_struk)";
		$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)
		VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
		//
		
	//---buat laporan pendapatan
		$z = mysql_query("SELECT SUM( IF( no_struk LIKE  '%$no_struk%', jml_brg, 0 ) ) AS tot_brg".
						", SUM( IF( no_struk LIKE  '%$no_struk%', total, 0 ) ) AS tot_bayar_brg ".
						"FROM  ply_penjualan_detail");
						
		$x = mysql_query("	SELECT SUM( biaya ) AS biaya
							FROM ply_detail
							INNER JOIN ply_kategori ON ply_detail.id_kt_ply = ply_kategori.id_kt_ply
							WHERE ply_detail.no_struk =  '$no_struk'");
	
		$data2=mysql_fetch_array($z);
		$data3=mysql_fetch_object($x);
		$tot_brg = $data2['tot_brg'];
		
		$biaya = $data3->biaya;
		$tot_bayar_brg = $data2['tot_bayar_brg'];
		$tot_bayar = $biaya + $tot_bayar_brg;
	
}

function ply_batal(){
	$no_struk		=$_POST['no_struk'];
	$cek=mysql_query("SELECT COUNT(*) AS jml1 FROM   ply_penjualan_detail WHERE no_struk='$no_struk'") OR DIE(mysql_error());
	$cek2=mysql_query("SELECT COUNT(*) AS jml2 FROM   ply_detail1 WHERE no_struk='$no_struk'") OR DIE(mysql_error());
	$ada=mysql_fetch_object($cek); $jml1=$ada->jml1;
	$ada2=mysql_fetch_object($cek2); $jml2=$ada2->jml2;
	
	if ($jml1>0 || $jml2>0){ 
		$qdtl1 =mysql_query("DELETE FROM ply_detail1 WHERE no_struk='$no_struk'") OR DIE(mysql_error()); 
		$a=mysql_query("SELECT id_brg, jml_brg FROM  ply_penjualan_detail WHERE no_struk='$no_struk'") OR DIE (mysql_error());
		
		while($data=mysql_fetch_object($a)){
			$qry=mysql_query("SELECT id_brg, stok, terjual FROM br_data WHERE id_brg='$data->id_brg' ") OR DIE(mysql_error());
			$dbrg=mysql_fetch_object($qry);
			
			$tambah =$dbrg->stok + $data->jml_brg;
			$balik =$dbrg->terjual - $data->jml_brg;
				
			$qbrg=mysql_query("UPDATE br_data SET stok='$tambah', terjual='$balik' WHERE id_brg='$data->id_brg'") OR DIE (mysql_error());		
			$qpj=mysql_query("DELETE FROM ply_penjualan_detail WHERE no_struk='$no_struk' AND id_brg='$data->id_brg'") OR DIE (mysql_error());
		}
		echo "<script type='text/javascript'> alert('Pembatalan berhasil dan data dikembalikan');window.location='?mod=pelayanan';</script>";
	}
	else{
		header("location:?mod=pelayanan");
	}	
}
function pl_simpan(){
	$no_struk		=$_POST['no_struk'];
	$tgl_trans		=$_POST['tgl_trans'];
	$nm_plg			=$_POST['nm_plg'];
	$tot_bayar		=$_POST['tot_bayar'];
	$uang_bayar		=$_POST['uang_bayar'];
	$id_pengguna	=$_POST['id_pengguna'];
	$hari_ini 		= date("Y-m-d");
	$sekarang 		= date("Y-m-d H:i:s");
	
	
	if(empty($nm_plg)){
		echo "<script type='text/javascript'> alert('Isikan Nama pelanggan');history.back();</script>";
	}
	elseif(empty($uang_bayar)){
		echo "<script type='text/javascript'> alert('Isikan Uang Bayar');history.back();</script>";
	}
	else{
	
		if(!empty($tgl_trans)){
			$qry="INSERT INTO ply_penjualan VALUES".
			"('$no_struk','$tgl_trans','$nm_plg','$tot_bayar','$uang_bayar','$id_pengguna','$sekarang');";
		}
		else{
			$qry="INSERT INTO ply_penjualan VALUES".
			"('$no_struk','$hari_ini','$nm_plg','$tot_bayar','$uang_bayar','$id_pengguna','$sekarang')";
		}
			
		mysql_query($qry) or die(mysql_error());
		
		
		//hapus sementara
			$a = "DELETE FROM sementara where id_sementara='$no_struk' LIMIT 1";
			mysql_query($a);
		
		
		//membuat log
		$pengguna=$_SESSION['nama_asli'] ;
		$lokasi=$_POST['lokasi'];
		$pesan="Transaksi penjualan langsung dengan No Struk ($no_struk)";
		$log=" INSERT INTO log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
		"VALUES('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
		mysql_query($log) or die (mysql_error());
		
		//---buat laporan pendapatan
		$qjual=mysql_query("SELECT SUM(total) AS jual FROM ply_penjualan_detail WHERE no_struk='$no_struk'") or die(mysql_error());
		$djual=mysql_fetch_object($qjual);
		$jual=$djual->jual;
		
		$masuk = $jual ;
		$keuangan=mysql_query(" INSERT INTO keuangan VALUES('','$hari_ini','Pemasukan dari transaksi penjualan ($no_struk)','$masuk','0')") or die(mysql_error());
		//-----
		echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=sejarah_pl';</script>";
	}
}
function ply_kat_simpan(){
	$nm_kat = $_POST['nm_kat'];
	$biaya 	= $_POST['biaya'];
	$sekarang = date("Y-m-d H:i:s");
	
	if(empty($nm_kat)){
		echo "<script type='text/javascript'> alert('Isikan kategori pelayanan!');history.back();</script>";
	}
	elseif(empty($biaya)){
		echo "<script type='text/javascript'> alert('Isikan Biaya kategori pelayanan!');history.back();</script>";
	}
	else{
	$qry ="	INSERT INTO ply_kategori (id_kt_ply,nm_kt_ply,biaya,wkt_ubah) 
			VALUES ('','$nm_kat','$biaya','$sekarang')";
	mysql_query($qry) or die (mysql_error());
	echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=kategori';</script>";
	}
}
function ply_kat_perbaharui(){
	$id_kt_ply = $_POST['id_kt_ply'];
	$nm_kat = $_POST['nm_kat'];
	$biaya 	= $_POST['biaya'];
	$sekarang = date("Y-m-d H:i:s");
	if(empty($nm_kat)){
		echo "<script type='text/javascript'> alert('Isikan kategori pelayanan!');history.back();</script>";
	}
	elseif(empty($biaya)){
		echo "<script type='text/javascript'> alert('Isikan Biaya kategori pelayanan!');history.back();</script>";
	}
	else{
		$qry ="	UPDATE  ply_kategori SET nm_kt_ply='$nm_kat',biaya='$biaya',wkt_ubah='$sekarang' WHERE id_kt_ply='$id_kt_ply' "; 
		mysql_query($qry) or die (mysql_error());
		echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=kategori';</script>";
	}
}
function ply_kat_hapus(){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_kt_ply=$_POST["item"][$i];
	
		$myquery = "DELETE FROM ply_kategori WHERE id_kt_ply='$id_kt_ply' LIMIT 1";
		$hapus = mysql_query($myquery) or die (" Gagal Menghapus !!");
	
	}
	echo "<script type='text/javascript'>alert('Data berhasil dihapus');history.back();</script>";
	}
	else{
		echo "<script type='text/javascript'>alert('Pilih data yang akan dihapus');history.back();</script>";
	}
}


if(isset($_POST['tmbh_brg'])){
	tmbh_brg();
}
elseif(isset($_POST['tmbh_pel'])){
	tmbh_pel();
}
elseif(isset($_POST['ply_simpan'])){
	if(!empty($_POST['selesai'])){
		$no_struk = $_POST['no_struk'];
		update_wo();
		ply_simpan();
		echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=wo&id=bayar&no_struk=$no_struk';</script>";
	}
	else{
		update_wo();
		echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=wo';</script>";
	}
}


elseif(isset($_POST['ply_batal'])){
	ply_batal();
}
elseif(isset($_POST['pl_simpan'])){
	pl_simpan();
}
elseif(isset($_POST['ply_kat_simpan'])){
	ply_kat_simpan();
}
elseif(isset($_POST['ply_kat_perbaharui'])){
	ply_kat_perbaharui();
}
elseif(isset($_POST['ply_kat_hapus'])){
	ply_kat_hapus();
}

elseif(isset($_POST['simpan_wo'])){
	simpan_wo();
}
elseif(isset($_POST['simpan_wo_dua'])){
	simpan_wo_dua();
}
elseif(isset($_POST['update_wo'])){
	update_wo();
	echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=wo';</script>";
}
elseif(isset($_POST['ply_selesai'])){
	ply_selesai();
	echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=sejarah_tr';</script>";
}
else{
	echo "<script type='text/javascript'> alert('Tidak ada!'); history.back();</script>";
}
	
?>
