<?php
sleep(1);
$ply = new pelayanan();
$sekarang = date("Y-m-d H:i:s");
$hari_ini = date("Y-m-d");
$lokasi  = $_POST['lokasi'];
//aksi
if (isset($_POST['simpan_wo'])){
	$no_wo 				= $_POST['no_wo'];
	$id_plg 			= $_POST['id_plg'];
	$no_polisi 			= $_POST['no_polisi'];
	$no_mesin 			= $_POST['no_mesin'];
	$jns_kendaraan 		= $_POST['jns_kendaraan'];
	$km_terakhir 		= $_POST['km_terakhir'];
	$keluhan 			= $_POST['keluhan'];
	
	if(empty($id_plg)){echo "<script type='text/javascript'> alert('Isikan ID Pelanggan !');history.back();</script>";	}
	elseif(empty($no_polisi)){echo "<script type='text/javascript'> alert('Isikan No. Polisi !');history.back();</script>";}
	else{
		$ply->simpan_wo($no_wo,$id_plg,$hari_ini,$no_polisi,$no_mesin,$jns_kendaraan,$km_terakhir,$keluhan,$sekarang);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:1:Menyimpan Work Order ($no_wo)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		//echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pelayanan';</script>";
		header("location:?mod=pelayanan");
	}
}
elseif (isset($_POST['tmbh_ply'])){
	$no_struk 	= $_POST['no_struk'];
	$id_kt_ply 	= $_POST['id_kt_ply'];
	$lokasi  = $_POST['lokasi'];
	
	$cek = $ply->cek_pelayanan($no_struk,$id_kt_ply);
	if(count($cek) >0){echo "<script type='text/javascript'> alert('Pelayanan telah ada !!!');history.back();</script>";return false;}
	else{
		$ply->tambah_pelayanan($no_struk,$id_kt_ply,$sekarang);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:1:Menambahkan pelayanan ($id_kt_ply | $no_struk)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	}
	echo "<script type='text/javascript'>history.back();</script>";
}
elseif(isset($_POST['tmbh_brg'])){
	$id_brg		=$_POST['id_brg'];
	$jml_brg	=$_POST['jml_brg'];
	$no_struk	=$_POST['no_struk'];
	
	$cek_stok = $ply->cek_stok($id_brg);
	foreach($cek_stok as $data){
		if($data['stok'] <= 0){echo "<script type='text/javascript'> alert('Stok untuk [$id_brg] habis atau tidak cukup !!!');history.back();</script>";return false;}
		elseif($data['stok'] < $jml_brg ){echo "<script type='text/javascript'> alert('Stok KURANG !!!');history.back();</script>";return false;}
		else{
			$cek_ada = $ply->cek_ada($no_struk,$id_brg);
			if(count($cek_ada) > 0){
				foreach($cek_ada as $data){
				$sudah_ada=$data['jml_brg'];
				//perbaharui penjualan
				$ply->perbaharui_barang($no_struk,$id_brg,$sudah_ada,$jml_brg,$sekarang);
				//perbaharui status barang
				$ply->perbaharui_status_barang($id_brg,$jml_brg);
				
				//log
				$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
				$log_pesan="A:3:Memperbaharui Barang ($id_brg | $no_struk)";$log_waktu = $sekarang;
				$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
				}
			}
			else{
				$ply->tambah_barang($no_struk,$id_brg,$jml_brg,$sekarang);
				
				//log
				$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
				$log_pesan="A:1:Menambahkan Barang ($id_brg | $no_struk)";$log_waktu = $sekarang;
				$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
			}
		}	
	}
	echo "<script type='text/javascript'>history.back();</script>";
}
elseif(isset($_POST['simpan_wo_dua'])){
	$no_struk			=$_POST['no_struk'];
	$no_wo				=$_POST['no_wo'];
	$saran				=$_POST['saran'];
	$id_peg				=$_POST['id_peg'];
	
	if(empty($id_peg)){echo "<script type='text/javascript'> alert('Mekanik tidak boleh kosong');history.back();</script>";}
	else{
		$ply->simpan_wo_dua($no_struk,$no_wo,$hari_ini,$id_peg,$saran,$sekarang);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:1:Menyimpan Work Order ($no_wo | $no_struk)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		//echo "<script type='text/javascript'>alert('Data berhasil disimpan');window.location='?mod=pelayanan&h=wo';</script>";
		header("location:?mod=pelayanan&h=wo");
	}
}
elseif(isset($_POST['perbaharui_wo'])){
	$no_struk	=$_POST['no_struk'];
	$no_wo		=$_POST['no_wo'];
	$saran		=$_POST['saran'];
	
	if(!empty($_POST['selesai'])) $status = $_POST['selesai'];	
	else	$status = $_POST['id'];	

	$ply->perbaharui_wo($no_struk,$no_wo,$status,$saran,$sekarang);
	//log
	$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
	$log_pesan="A:3:Memperbaharui Work Order ($no_wo | $no_struk)";$log_waktu = $sekarang;
	$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	//echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pelayanan&h=wo';</script>";
	header("location:?mod=pelayanan&h=wo");
}

elseif(isset($_POST['ply_simpan'])){
	$no_struk			=$_POST['no_struk'];
	$no_wo				=$_POST['no_wo'];
	$tot_bayar			=$_POST['tot_bayar'];
	$id_pengguna		=$_POST['id_pengguna'];
	$saran				=$_POST['saran'];
	
	if(!empty($_POST['selesai'])){
		$status = $_POST['selesai'];
		
		$ply->perbaharui_wo($no_struk,$no_wo,$status,$saran,$sekarang);
		$ply->simpan_ply($no_struk,$no_wo,$tot_bayar,$id_pengguna,$sekarang);
		
		$id_plg = $ply->tampil_wo2('id_plg',$no_wo);
		$transaksi = $ply->ambil_transaksi_plg('transaksi',$id_plg) + 1;
		$ply->perbaharui_transaksi_plg($id_plg,$transaksi);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:1:Menyimpan Pelayanan ($no_wo | $no_struk)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		
		echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pelayanan&h=transaksi&id=bayar&no_struk=$no_struk';</script>";
	}
	else{	
		$status = $_POST['id'];
		$ply->perbaharui_wo($no_struk,$no_wo,$status,$saran,$sekarang);
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:3:Memperbaharui Work Order ($no_wo | $no_struk)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pelayanan&h=wo';</script>";		
	}
}

elseif(isset($_POST['ply_selesai'])){
	$no_struk = $_POST['no_struk'];
	$uang_bayar=$_POST['bayar'];
	
	$ply->selesai_ply($no_struk,$uang_bayar,$sekarang);

	//log
	$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
	$log_pesan="A:1:Menyelesaikan Pelayanan ( $no_struk)";$log_waktu = $sekarang;
	$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	
	//pelaporan keuangan
	$biaya = $ply->ambil_jml_ply('biaya',$no_struk);$tot_bayar_brg = $ply->ambil_jml_brg('tot_bayar_brg',$no_struk);
	$masuk = $biaya + $tot_bayar_brg;$keluar = 0;
	$ket = "Pemasukan dari transaksi pelayanan ($no_struk)";
	$ply->tambah_pelaporan_keuangan($hari_ini,$ket,$masuk,$keluar);
	
	
	//log
	$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
	$log_pesan="A:1:Menyimpan Pemasukan ($no_struk)";$log_waktu = $sekarang;
	$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	echo "<script type='text/javascript'>alert('Data berhasil disimpan');window.location='?mod=pelayanan&h=wo';</script>";
}
elseif(isset($_POST['pl_simpan'])){
	$no_struk		=$_POST['no_struk'];
	$tgl_trans		=$_POST['tgl_trans'];
	$nm_plg			=$_POST['nm_plg'];
	$tot_bayar		=$_POST['tot_bayar'];
	$id_pengguna	=$_POST['id_pengguna'];
	
	if(empty($nm_plg)){
		echo "<script type='text/javascript'> alert('Isikan Nama Pelanggan');history.back();</script>";
	}
	else{
		$ply->simpan_pl($no_struk,$tgl_trans,$nm_plg,$tot_bayar,$id_pengguna,$sekarang);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:1:Menyimpan Penjualan ($no_struk)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		//echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pelayanan&h=penjualan&id=bayar&no_struk=$no_struk';</script>";
		header("location:?mod=pelayanan&h=penjualan&id=bayar&no_struk=$no_struk");
	}
}
elseif(isset($_POST['pl_selesai'])){
	$no_struk	=$_POST['no_struk'];
	$uang_bayar = $_POST['bayar'];
	
	$ply->selesai_pl($no_struk,$uang_bayar);
	//log
	$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
	$log_pesan="A:1:Menyelesaikan Penjualan ($no_struk)";$log_waktu = $sekarang;
	$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	
	//pelaporan keuangan
	$biaya = $ply->ambil_jml_ply('biaya',$no_struk);$tot_bayar_brg = $ply->ambil_jml_brg('tot_bayar_brg',$no_struk);
	$masuk = $biaya + $tot_bayar_brg;$keluar = 0;
	$ket = "Pemasukan dari transaksi penjualan ($no_struk)";
	$ply->tambah_pelaporan_keuangan($hari_ini,$ket,$masuk,$keluar);
	
	//log
	$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
	$log_pesan="A:1:Menyimpan Pemasukan ($no_struk)";$log_waktu = $sekarang;
	$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	
	echo "<script type='text/javascript'>window.location='?mod=pelayanan&h=sejarah_pl';</script>";
}

elseif(isset($_POST['ply_kat_simpan'])){
	$nm_kat = $_POST['nm_kat'];
	$biaya 	= $_POST['biaya'];
	
	if(empty($nm_kat)){echo "<script type='text/javascript'> alert('Isikan kategori pelayanan!');history.back();</script>";}
	elseif(empty($biaya)){echo "<script type='text/javascript'> alert('Isikan Biaya kategori pelayanan!');history.back();</script>";}
	else{
		$ply->simpan_kt_ply($nm_kat,$biaya,$sekarang);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:1:Menyimpan Kategori Pelayanan ($nm_kat)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		echo "<script type='text/javascript'> alert('Data berhasil disimpan');window.location='?mod=pelayanan&h=kategori';</script>";
	}
}
elseif(isset($_POST['ply_kat_hapus'])){
	$jumlah=count($_POST["item"]);
	if(!empty($jumlah)){
	for($i=0; $i < $jumlah; $i++){
		$id_kt_ply=$_POST["item"][$i];
		$ply->hapus_kt_ply($id_kt_ply);	
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:4:Menghapus Kategori Pelayanan ($id_kt_ply)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
	}
	echo "<script type='text/javascript'>alert('Data berhasil dihapus');history.back();</script>";
	}
	else{echo "<script type='text/javascript'>alert('Pilih data yang akan dihapus');history.back();</script>";}
}
elseif(isset($_POST['ply_kat_perbaharui'])){
	$id_kt_ply = $_POST['id_kt_ply'];
	$nm_kt_ply = $_POST['nm_kat'];
	$biaya 	= $_POST['biaya'];
	if(empty($nm_kt_ply)){echo "<script type='text/javascript'> alert('Isikan kategori pelayanan!');history.back();</script>";}
	elseif(empty($biaya)){echo "<script type='text/javascript'> alert('Isikan Biaya kategori pelayanan!');history.back();</script>";}
	else{
		$ply->perbaharui_kt_ply($id_kt_ply,$nm_kt_ply,$biaya,$sekarang);
		
		//log
		$log_tipe = "Staff";$pengguna=$_SESSION['nama_asli'];$log_lokasi=$lokasi;
		$log_pesan="A:3:Memperbaharui Kategori Pelayanan ($id_kt_ply)";$log_waktu = $sekarang;
		$ply->log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu);
		echo "<script type='text/javascript'> alert('Data berhasil diperbaharui');window.location='?mod=pelayanan&h=kategori';</script>";
	}
}
else{
	echo "<script type='text/javascript'>alert('tidak ada aksi');history.back();</script>";
}

?>
