<?php
class pelayanan{
	//pelayanan
	function simpan_wo($no_wo,$id_plg,$tgl_wo,$no_polisi,$no_mesin,$jns_kendaraan,$km_terakhir,$keluhan,$wkt_ubah){
		mysql_query("INSERT INTO ply_wo 
		(no_wo,id_plg,tgl_wo,no_polisi,no_mesin,jns_kendaraan,km_terakhir,keluhan,wkt_ubah) 
		VALUES
		('$no_wo','$id_plg','$tgl_wo','$no_polisi','$no_mesin','$jns_kendaraan','$km_terakhir','$keluhan','$wkt_ubah')") or de(mysql_error());
	}
	function simpan_wo_dua($no_struk,$no_wo,$tgl_struk,$id_peg,$saran,$wkt_ubah){
		mysql_query("INSERT INTO ply_ (no_struk,no_wo,tgl_struk,wkt_ubah) VALUES ('$no_struk','$no_wo','$tgl_struk','$wkt_ubah')") or de(mysql_error());
		mysql_query("UPDATE ply_wo SET saran='$saran', id_peg='$id_peg', status='1', wkt_ubah='$wkt_ubah' WHERE no_wo='$no_wo'") or de(mysql_error());
	}
	function perbaharui_wo($no_struk,$no_wo,$status,$saran,$wkt_ubah){
		mysql_query("UPDATE ply_ SET wkt_ubah='$wkt_ubah' WHERE no_struk='$no_struk' AND no_wo='$no_wo'") or die(mysql_error());
		mysql_query("UPDATE ply_wo SET status='$status', saran='$saran', wkt_ubah='$wkt_ubah' WHERE no_wo='$no_wo'")or die(mysql_error());
	}
	function simpan_ply($no_struk,$no_wo,$tot_bayar,$id_pengguna,$wkt_ubah){
		mysql_query("UPDATE ply_ SET total_pembayaran='$tot_bayar', id_pengguna='$id_pengguna', wkt_ubah='$wkt_ubah' WHERE no_struk='$no_struk' AND no_wo='$no_wo'");	
	}
	function selesai_ply($no_struk,$uang_bayar,$wkt_ubah){
		mysql_query("UPDATE ply_ SET uang_bayar='$uang_bayar', wkt_ubah='$wkt_ubah' WHERE no_struk='$no_struk' ") or die (mysql_error());
	}
	
	//penjualan
	function simpan_pl($no_struk,$tgl_trans,$nm_plg,$tot_bayar,$id_pengguna,$wkt_ubah){
		mysql_query("INSERT INTO ply_penjualan VALUES ('$no_struk','$tgl_trans','$nm_plg','$tot_bayar','0','$id_pengguna','$wkt_ubah')") or die(mysql_error());
	}
	function selesai_pl($no_struk,$uang_bayar){
		mysql_query("UPDATE ply_penjualan SET `uang_bayar`='$uang_bayar' WHERE `no_struk`='$no_struk' ") or die(mysql_error());
	}
	
	function tampil_wo(){
		if($_SESSION['kel_id'] == 5){$qry = "SELECT * FROM ply_wo  WHERE status='0' OR status='1' ORDER BY no_wo DESC";}
		elseif($_SESSION['kel_id'] == 3){$qry = "SELECT * FROM ply_wo  WHERE status='2' OR status='3' ORDER BY no_wo DESC";}
		elseif(!empty($_GET['cari'])){$cari = $_GET['cari'];$qry = "SELECT * FROM ply_wo WHERE no_wo='".$cari."' OR id_plg='".$cari."'	OR no_polisi='".$cari."' OR id_peg='".$cari."' ORDER BY no_wo DESC";}
		else{$qry = "SELECT * FROM ply_wo ORDER BY no_wo DESC";}
		
		$run = mysql_query($qry) or die (mysql_error());
		if(mysql_num_rows($run)>0){
		while($row = mysql_fetch_array($run))
			$data[] = $row;
			return $data;
		}
	}
	function tampil_wo2($field,$no_wo){
		$qry = 	mysql_query("SELECT  ply_wo.id_plg, dt_pelanggan.nm_plg, ply_wo.jns_kendaraan, ply_wo.no_polisi, ply_wo.no_mesin, ply_wo.keluhan, ply_wo.id_peg, ply_wo.saran FROM ply_wo 
				INNER JOIN dt_pelanggan ON ply_wo.id_plg = dt_pelanggan.id_plg WHERE ply_wo.no_wo = '$no_wo' LIMIT 1") or die (mysql_error());
		$data = mysql_fetch_array($qry);
		if($field == 'id_plg')
			return $data['id_plg'];
		elseif($field == 'nm_plg')
			return $data['nm_plg'];
		elseif($field == 'jns_kendaraan')
			return $data['jns_kendaraan'];
		elseif($field == 'no_polisi')
			return $data['no_polisi'];
		elseif($field == 'no_mesin')
			return $data['no_mesin'];
		elseif($field == 'keluhan')
			return $data['keluhan'];
		elseif($field == 'id_peg')
			return $data['id_peg'];
		elseif($field == 'saran')
			return $data['saran'];
	}
	
	function tampil_sejarah_ply(){
		if(!empty($_GET['cari'])){
			$cari = $_GET['cari'];
			
			$qry= "	SELECT  ply_.no_struk, ply_wo.id_plg, dt_pelanggan.nm_plg, ply_.total_pembayaran, ply_.tgl_struk
					FROM ply_
					INNER JOIN ply_wo ON ply_.no_wo = ply_wo.no_wo
					INNER JOIN dt_pelanggan ON ply_wo.id_plg = dt_pelanggan.id_plg 
					WHERE  ply_.no_struk='".$cari."' OR ply_wo.id_plg='".$cari."' OR 	dt_pelanggan.nm_plg LIKE '%".$cari."%'  AND total_pembayaran>0
					ORDER BY ply_.no_struk DESC";
		}
		else{
			$qry= "	SELECT  ply_.no_struk, ply_wo.id_plg, dt_pelanggan.nm_plg, ply_.total_pembayaran, ply_.tgl_struk
					FROM ply_
					INNER JOIN ply_wo ON ply_.no_wo = ply_wo.no_wo
					INNER JOIN dt_pelanggan ON ply_wo.id_plg = dt_pelanggan.id_plg 
					WHERE total_pembayaran>0
					ORDER BY ply_.no_struk DESC";
		}
		$run = mysql_query($qry) or die (mysql_error());
		if(mysql_num_rows($run)>0){
		while($row = mysql_fetch_array($run))
			$data[] = $row;
			return $data;
		}
	}
	function tampil_sejarah_pl(){
		if(!empty($_GET['cari'])){$cari = $_GET['cari'];$qry ="SELECT * FROM ply_penjualan WHERE no_struk='".$cari."' OR nm_plg LIKE '%".$cari."%'  ORDER BY no_struk DESC";}
		else{$qry="	SELECT * FROM ply_penjualan ORDER BY no_struk DESC";}
		$run = mysql_query($qry) or die (mysql_error());
		if(mysql_num_rows($run)>0){
		while($row = mysql_fetch_array($run))
			$data[] = $row;
			return $data;
		}
	}

	//
	function cek_stok($id_brg){
		$qry = mysql_query("SELECT `stok` FROM `br_data` WHERE `id_brg`='$id_brg' LIMIT 1") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function cek_ada($no_struk,$id_brg){
		$qry = mysql_query("SELECT `id_brg`,`jml_brg` FROM `ply_penjualan_detail` WHERE `no_struk`='$no_struk' AND `id_brg` LIKE '%$id_brg%' LIMIT 1");
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	function cek_pelayanan($no_struk,$id_kt_ply){
		$qry=mysql_query("SELECT `id_kt_ply`  FROM  `ply_detail` WHERE `no_struk`='$no_struk' AND `id_kt_ply` LIKE '%$id_kt_ply%' ") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}		
	function tambah_barang($no_struk,$id_brg,$jml_brg,$wkt_ubah){
		$qry = mysql_query("SELECT hrg_jual FROM br_data WHERE id_brg='$id_brg' ") or die (mysql_error());
		$data = mysql_fetch_object($qry);
		$total= $data->hrg_jual * $jml_brg;
		mysql_query("INSERT INTO ply_penjualan_detail VALUES ('$no_struk','$id_brg','$jml_brg','$total','$wkt_ubah')");
	}
	function perbaharui_barang($no_struk,$id_brg,$sudah_ada,$jml_brg,$wkt_ubah){
		$qry = mysql_query("SELECT hrg_jual FROM br_data WHERE id_brg='$id_brg' ") or die (mysql_error());
		$data = mysql_fetch_object($qry);
		
		$tambah = $sudah_ada + $jml_brg;
		$total= $data->hrg_jual * $tambah;
		
		mysql_query("UPDATE ply_penjualan_detail SET jml_brg='$tambah',total='$total' WHERE no_struk='$no_struk' AND id_brg='$id_brg'") or die(mysql_error());
	}
	function perbaharui_status_barang($id_brg,$jml_brg){
		$qry = mysql_query("SELECT stok,terjual FROM br_data WHERE id_brg='$id_brg' ") or die (mysql_error());
		$data = mysql_fetch_object($qry);
		$stok=$data->stok - $jml_brg;
		$terjual=$data->terjual + $jml_brg;	
			
		mysql_query("UPDATE br_data SET stok='$stok', terjual='$terjual' WHERE id_brg='$id_brg'") or die(mysql_error());
	}
	function tambah_pelayanan($no_struk,$id_kt_ply,$wkt_ubah){
		mysql_query("INSERT INTO ply_detail VALUES ('$no_struk','$id_kt_ply','$wkt_ubah')") or die(mysql_error());
	}
	
	function ambil_no_struk($field,$no_wo){
		$qry = mysql_query("SELECT no_struk FROM ply_ WHERE no_wo='$no_wo'")or die(mysql_error());
		$data = mysql_fetch_array($qry);
		if($field == 'no_struk')
			return $data['no_struk'];
	}
	function ambil_pelanggan(){
		$qry=	mysql_query("SELECT * FROM dt_pelanggan WHERE masa_berlaku >  tgl_registrasi ORDER by id_plg ASC ")or die (mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	
		
	function ambil_pegawai(){
		$q = mysql_query("SELECT kel_id FROM kel_pengguna WHERE nm_kel LIKE '%mekanik%'") or die(mysql_error());
		$qq = mysql_fetch_object($q);
		$kel_id = $qq->kel_id;
					
		$qry=	mysql_query("SELECT * FROM dt_pegawai WHERE kel_id='$kel_id' ORDER by id_peg ASC ")or die (mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function ambil_brg(){
		$qry=	mysql_query("SELECT * FROM br_data")or die (mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}	
	function ambil_ply_detail($no_struk){
		$qry = mysql_query("SELECT ply_detail.id_kt_ply, ply_kategori.nm_kt_ply, ply_kategori.biaya FROM ply_kategori INNER JOIN ply_detail ON ply_kategori.id_kt_ply = ply_detail.id_kt_ply WHERE ply_detail.no_struk = '$no_struk'") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	function ambil_ply_penjualan($no_struk){
		$qry = mysql_query("SELECT ply_penjualan_detail.id_brg, br_data.nm_brg, br_data.hrg_jual, ply_penjualan_detail.jml_brg, ply_penjualan_detail.total FROM br_data INNER JOIN ply_penjualan_detail ON br_data.id_brg = ply_penjualan_detail.id_brg WHERE ply_penjualan_detail.no_struk='$no_struk' ORDER BY id_brg asc ") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	function ambil_jml_brg($field,$no_struk){
		$qry = mysql_query("SELECT SUM( IF( no_struk LIKE  '%$no_struk%', jml_brg, 0 ) ) AS tot_brg
						, SUM( IF( no_struk LIKE  '%$no_struk%', total, 0 ) ) AS tot_bayar_brg 
						FROM  ply_penjualan_detail");
		$data = mysql_fetch_array($qry);
		if($field == 'tot_brg')
			return $data['tot_brg'];
		elseif($field == 'tot_bayar_brg')
			return $data['tot_bayar_brg'];
	}
	function ambil_jml_ply($field,$no_struk){
		$qry = mysql_query("SELECT SUM( biaya ) AS biaya
							FROM ply_detail
							INNER JOIN ply_kategori ON ply_detail.id_kt_ply = ply_kategori.id_kt_ply
							WHERE ply_detail.no_struk =  '$no_struk'");
		$data = mysql_fetch_array($qry);
		if($field == 'biaya')
			return $data['biaya'];
	}
	
	//kategori
	function ambil_kt_pelayanan(){
		$qry=	mysql_query("SELECT * FROM ply_kategori")or die (mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function simpan_kt_ply($nm_kt_ply,$biaya,$wkt_ubah){
		mysql_query("INSERT INTO ply_kategori (nm_kt_ply,biaya,wkt_ubah)VALUES ('$nm_kt_ply','$biaya','$wkt_ubah')") or die (mysql_error());
	}		
	function hapus_kt_ply($id_kt_ply){
		mysql_query("DELETE FROM ply_kategori WHERE id_kt_ply='$id_kt_ply' LIMIT 1") or die(mysql_error());
	}
	function sunting_kt_ply($field,$id_kt_ply){
		$qry = "SELECT * FROM ply_kategori WHERE id_kt_ply='$id_kt_ply' LIMIT 1";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'id_kt_ply')
			return $data['id_kt_ply'];
		elseif($field == 'nm_kt_ply')
			return $data['nm_kt_ply'];
		elseif($field == 'biaya')
			return $data['biaya'];
	}
	function perbaharui_kt_ply($id_kt_ply,$nm_kt_ply,$biaya,$wkt_ubah){
		mysql_query("UPDATE  ply_kategori SET nm_kt_ply='$nm_kt_ply',biaya='$biaya',wkt_ubah='$wkt_ubah' WHERE id_kt_ply='$id_kt_ply' ") or die(mysql_error());
	}
	
	//
	function ambil_transaksi_plg($field,$id_plg){
		$qry = "SELECT transaksi FROM dt_pelanggan WHERE id_plg='$id_plg'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'transaksi')
			return $data['transaksi'];
	}
	function perbaharui_transaksi_plg($id_plg,$transaksi){
		mysql_query("UPDATE dt_pelanggan SET transaksi='$transaksi' WHERE id_plg='$id_plg'") or die(mysql_error());
	}
	
	//pelaporan keuangan
	function tambah_pelaporan_keuangan($tgl,$ket,$masuk,$keluar){
		mysql_query(" INSERT INTO keuangan VALUES('','$tgl','$ket','$masuk','keluar')") or die(mysql_error());
	}
	
	
	//catatan sistem
	function log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu){
		$qry=" INSERT INTO log_sistem VALUES ('','$log_tipe','$pengguna','$log_lokasi','$log_pesan','$log_waktu')";
		mysql_query($qry) or die (mysql_error());
	}
}
?>
