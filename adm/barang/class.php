<?php
class barang{
	//barang
	var $tambahan ;
	function tampil_barang(){
		if(!empty($_GET['cari']) && empty($id_brg)){
			$cari = $_GET['cari'];
			$qry ="SELECT * FROM br_data WHERE id_brg='".$cari."' OR kode_brg='".$cari."'OR nm_brg LIKE '%".$cari."%' AND  stok>=stok_min ORDER BY id_brg ASC";
		}
		else{$qry = "SELECT * FROM br_data WHERE stok>=stok_min";}
		$run =mysql_query($qry) or die(mysql_error());
		while($row = mysql_fetch_array($run))
			$data[] = $row;
			return $data;
	}
	function tampil_barang_w($select,$where){
		$qry = mysql_query("SELECT $select FROM br_data $where") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	function sunting_barang($field,$id_brg){
		$qry = "SELECT * FROM br_data WHERE id_brg='$id_brg'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		
		if($field == 'id_brg')
			return $data['id_brg'];
		elseif($field == 'kode_brg')
			return $data['kode_brg'];
		elseif($field == 'nm_brg')
			return $data['nm_brg'];
		elseif($field == 'id_kt_brg')
			return $data['id_kt_brg'];
		elseif($field == 'id_kualitas')
			return $data['id_kualitas'];
		elseif($field == 'hrg_beli')
			return $data['hrg_beli'];
		elseif($field == 'hrg_jual')
			return $data['hrg_jual'];
		elseif($field == 'id_satuan')
			return $data['id_satuan'];
		elseif($field == 'stok')
			return $data['stok'];
		elseif($field == 'stok_min')
			return $data['stok_min'];
		elseif($field == 'id_rak')
			return $data['id_rak'];
		elseif($field == 'id_sup')
			return $data['id_sup'];
		elseif($field == 'tgl_masuk')
			return $data['tgl_masuk'];
		elseif($field == 'ket_brg')
			return $data['ket_brg'];
		elseif($field == 'photo_brg')
			return $data['photo_brg'];
		elseif($field == 'terjual')
			return $data['terjual'];
		elseif($field == 'dipesan')
			return $data['dipesan'];
	}
	function simpan_barang($id_brg,$kode_brg,$nm_brg,$id_kt_brg,$id_kualitas,$hrg_beli,$hrg_jual,$id_satuan,$stok,$stok_min,$id_rak,$id_sup,$tgl_masuk,$ket_brg,$photo_brg,$wkt_ubah){
		mysql_query("INSERT INTO br_data (id_brg,kode_brg,nm_brg,id_kt_brg,id_kualitas,hrg_beli,hrg_jual,id_satuan,stok,stok_min,id_rak,id_sup,tgl_masuk,ket_brg,photo_brg,wkt_ubah)
		VALUES ('$id_brg','$kode_brg','$nm_brg','$id_kt_brg','$id_kualitas','$hrg_beli','$hrg_jual','$id_satuan','$stok','$stok_min','$id_rak','$id_sup','$tgl_masuk','$ket_brg','$photo_brg','$wkt_ubah')") or die(mysql_error());
	}
	function cek_ada($id_brg,$kode_brg){
		$qry = mysql_query("select id_brg,kode_brg FROM br_data WHERE id_brg='$id_brg' OR kode_brg='$kode_brg'") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	function hapus_barang($id_brg){
		mysql_query("DELETE FROM br_data WHERE id_brg='$id_brg' LIMIT 1") or die(mysql_error());
	}
	function perbaharui_photo($id_brg,$photo_brg){
		mysql_query("UPDATE br_data SET photo_brg='$photo_brg' WHERE id_brg='$id_brg'") or die (mysql_error());
	}
	function perbaharui_barang($id_brg,$kode_brg,$nm_brg,$id_kt_brg,$id_kualitas,$hrg_beli,$hrg_jual,$id_satuan,$stok,$stok_min,$id_rak,$id_sup,$tgl_masuk,$ket_brg,$wkt_ubah){
		mysql_query("UPDATE br_data SET 
					kode_brg='$kode_brg',nm_brg='$nm_brg',id_kt_brg='$id_kt_brg',
					id_kualitas='$id_kualitas',hrg_beli='$hrg_beli',hrg_jual='$hrg_jual',
					id_satuan='$id_satuan',stok='$stok',stok_min='$stok_min',id_rak='$id_rak',
					id_sup='$id_sup',tgl_masuk='$tgl_masuk',ket_brg='$ket_brg',
					wkt_ubah='$wkt_ubah' 
					WHERE id_brg='$id_brg' LIMIT 1") or die(mysql_error());
		
	}
	function perbaharui_status_barang($set,$where){
		$qry = "UPDATE br_data SET $set $where";
		mysql_query($qry) or die (mysql_error());
	}
	//barang per kendaraan
	function tampil_br_kendaraan($id_brg){		
		$qry = mysql_query("SELECT * FROM br_data_perkendaraan WHERE id_brg='$id_brg'") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function simpan_brg_kendaraan($id_brg,$id_kendaraan,$wkt_ubah){
		mysql_query("INSERT INTO br_data_perkendaraan (id_brg,id_kendaraan,wkt_ubah) values ('$id_brg','$id_kendaraan','$wkt_ubah')") or die(mysql_error());
	}
	function hapus_brg_kendaraan($id_brg){
		mysql_query("DELETE  FROM `br_data_perkendaraan` WHERE id_brg='$id_brg'") or die(mysql_error());
	}
	
	//kategori
	function tampil_kategori(){
		$qry = mysql_query("SELECT * FROM br_kategori") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function sunting_kategori($field,$id_kt_brg){
		$qry = "SELECT * FROM br_kategori WHERE id_kt_brg='$id_kt_brg'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		
		if($field == 'id_kt_brg')
			return $data['id_kt_brg'];
		elseif($field == 'nm_kt_brg')
			return $data['nm_kt_brg'];
	}
	function simpan_kategori($id_kt_brg,$nm_kt_brg,$wkt_ubah){
		mysql_query("INSERT INTO br_kategori values ('$id_kt_brg','$nm_kt_brg','$wkt_ubah') ") or die(mysql_error());		
	}
	function cek_kategori($id_kt_brg){
		$qry = mysql_query("SELECT * FROM br_kategori WHERE id_kt_brg='$id_kt_brg'") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function hapus_kategori($id_kt_brg){
		mysql_query("DELETE FROM br_kategori WHERE id_kt_brg='$id_kt_brg'") or die(mysql_error());
	}
	function perbaharui_kategori($id_kt_brg,$nm_kt_brg,$wkt_ubah){
		mysql_query("UPDATE br_kategori SET nm_kt_brg='$nm_kt_brg',wkt_ubah='$wkt_ubah' WHERE id_kt_brg='$id_kt_brg' ") or die(mysql_error());
	}
	
	//jenis kendaraan
	function tampil_jenis_kendaraan(){
		$qry = mysql_query("SELECT * FROM br_kendaraan") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function sunting_jenis_kendaraan($field,$id_kendaraan){
		$qry = "SELECT * FROM br_kendaraan WHERE id_kendaraan='$id_kendaraan'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		
		if($field == 'id_kendaraan')
			return $data['id_kendaraan'];
		elseif($field == 'kendaraan')
			return $data['kendaraan'];
	}
	function simpan_jenis_kendaraan($id_kendaraan,$kendaraan,$wkt_ubah){
		mysql_query("INSERT INTO br_kendaraan VALUES('$id_kendaraan','$kendaraan','$wkt_ubah')") or die(mysql_error());
		
	}
	function cek_jenis_kendaraan($id_kendaraan){
		$qry = mysql_query("SELECT * FROM br_kendaraan WHERE id_kendaraan='$id_kendaraan'") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function hapus_jenis_kendaraan($id_kendaraan){
		mysql_query("DELETE FROM br_kendaraan WHERE id_kendaraan='$id_kendaraan' ") or die(mysql_error());
	}
	function perbaharui_jenis_kendaraan($id_kendaraan,$kendaraan,$wkt_ubah){
		mysql_query("UPDATE br_kendaraan SET kendaraan='$kendaraan', wkt_ubah='$wkt_ubah' WHERE id_kendaraan='$id_kendaraan'") or die(mysql_error());
	}
	
	//kualitas
	function tampil_kualitas(){
		$qry = mysql_query("SELECT * FROM br_kualitas") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function sunting_kualitas($field,$id_kualitas){
		$qry = "SELECT * FROM br_kualitas WHERE id_kualitas='$id_kualitas'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'id_kualitas')
			return $data['id_kualitas'];
		elseif($field == 'kualitas')
			return $data['kualitas'];
	}
	function simpan_kualitas($id_kualitas,$kualitas,$wkt_ubah){
		mysql_query("INSERT INTO br_kualitas VALUES('$id_kualitas','$kualitas','$wkt_ubah')") or die(mysql_error());		
	}
	function cek_kualitas($id_kualitas){
		$qry = mysql_query("SELECT * FROM br_kualitas WHERE id_kualitas='$id_kualitas'") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function hapus_kualitas($id_kualitas){
		mysql_query("DELETE FROM br_kualitas WHERE id_kualitas='$id_kualitas'") or die(mysql_error());
	}
	function perbaharui_kualitas($id_kualitas,$kualitas,$wkt_ubah){
		mysql_query("UPDATE br_kualitas SET kualitas='$kualitas',wkt_ubah='$wkt_ubah' WHERE id_kualitas='$id_kualitas' ") or die(mysql_error());
	}
	
	//satuan
	function tampil_satuan(){
		$qry = mysql_query("SELECT * FROM br_satuan") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function sunting_satuan($field,$id_satuan){
		$qry = "SELECT * FROM br_satuan WHERE id_satuan='$id_satuan'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'id_satuan')
			return $data['id_satuan'];
		elseif($field == 'satuan')
			return $data['satuan'];
	}
	function simpan_satuan($id_satuan,$satuan,$wkt_ubah){
		mysql_query("INSERT INTO br_satuan VALUES('$id_satuan','$satuan','$wkt_ubah')") or die(mysql_error());
	}
	function cek_satuan($id_satuan){
		$qry = mysql_query("SELECT id_satuan FROM br_satuan WHERE id_satuan='$id_satuan'") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function hapus_satuan($id_satuan){
		mysql_query("DELETE FROM br_satuan WHERE id_satuan='$id_satuan'") or die(mysql_error());
	}
	function perbaharui_satuan($id_satuan,$satuan,$wkt_ubah){
		mysql_query("UPDATE br_satuan SET satuan='$satuan', wkt_ubah='$wkt_ubah' WHERE id_satuan='$id_satuan' ") or die(mysql_error());
	}
	
	//rak
	function tampil_rak(){
		$qry = mysql_query("SELECT * FROM br_rak") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function sunting_rak($field,$id_rak){
		$qry = "SELECT * FROM br_rak WHERE id_rak='$id_rak'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'id_rak')
			return $data['id_rak'];
		elseif($field == 'nm_rak')
			return $data['nm_rak'];
		elseif($field == 'ket')
			return $data['ket'];
	}
	function simpan_rak($nm_rak,$ket,$wkt_ubah){
		mysql_query("INSERT INTO br_rak VALUES ('','$nm_rak','$ket','$wkt_ubah')") or die(mysql_error());
	}
	function cek_rak($nm_rak){
		$qry = mysql_query("SELECT * FROM br_rak WHERE nm_rak='$nm_rak'") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function hapus_rak($id_rak){
		mysql_query("DELETE FROM br_rak WHERE id_rak='$id_rak'") or die(mysql_error());
	}
	function perbaharui_rak($id_rak,$nm_rak,$ket,$wkt_ubah){
		mysql_query("UPDATE br_rak SET nm_rak='$nm_rak',ket='$ket',wkt_ubah='$wkt_ubah' WHERE id_rak='$id_rak' ") or die(mysql_error());
	}
	
	//penyalur
	function tampil_penyalur(){
		if(!empty($_GET['cari'])){$qry = "SELECT * FROM sup_data WHERE id_sup='".$_GET['cari']."'OR nm_sup LIKE '%".$_GET['cari']."%' ORDER BY id_sup ASC";}
		else{$qry = "SELECT * FROM sup_data";}
		
		$run =mysql_query($qry) or die(mysql_error());
		if(mysql_num_rows($run)>0){
		while($row = mysql_fetch_array($run))
			$data[] = $row;
			return $data;
		}
	}
	function sunting_penyalur($field,$id_sup){
		$qry = "SELECT * FROM sup_data WHERE id_sup='$id_sup'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'id_sup')
			return $data['id_sup'];
		elseif($field == 'nm_sup')
			return $data['nm_sup'];
		elseif($field == 'almt_sup')
			return $data['almt_sup'];
		elseif($field == 'telp_sup')
			return $data['telp_sup'];
	}
	function simpan_penyalur($nm_sup,$almt_sup,$telp_sup,$wkt_ubah){
		mysql_query("INSERT INTO sup_data VALUES ('','$nm_sup','$almt_sup','$telp_sup','$wkt_ubah')") or die(mysql_error());
	}
	function cek_penyalur($nm_sup){
		$qry = mysql_query("SELECT * FROM sup_data WHERE nm_sup='$nm_sup'") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function hapus_penyalur($id_sup){
		mysql_query("DELETE FROM sup_data WHERE id_sup='$id_sup'") or die(mysql_error());
	}
	function perbaharui_penyalur($id_sup,$nm_sup,$almt_sup,$telp_sup,$wkt_ubah){
		mysql_query("UPDATE sup_data SET nm_sup='$nm_sup',almt_sup='$almt_sup',telp_sup='$telp_sup',wkt_ubah='$wkt_ubah' WHERE id_sup='$id_sup' ") or die(mysql_error());
	}
	
	//stok kurang
	function tampil_stok_kurang(){
		$qry = mysql_query("SELECT * FROM br_data  WHERE stok<=stok_min  AND dipesan='0' ORDER BY id_sup ASC") or die (mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	
	//pembelian
	function tampil_pembelian_detail($select,$where){
		$qry = mysql_query("SELECT $select FROM `br_pembelian_detail`  $where")  or die (mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	//tampil total detail
	function tampil_total_detail($select,$where){
		$qry = mysql_query("SELECT $select FROM  br_pembelian_detail $where") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function simpan_pembelian_detail($no_pes,$tgl_pes,$id_sup,$id_brg,$hrg_brg,$jml_brg,$total,$wkt_ubah){
		mysql_query("INSERT INTO br_pembelian_detail VALUES('','$no_pes','$tgl_pes','$id_sup','$id_brg','$hrg_brg','$jml_brg','$total','0','$wkt_ubah')") or die(mysql_error());
	}
	function perbaharui_pembelian_detail($no_pes,$id_brg){
		mysql_query("UPDATE br_pembelian_detail SET diterima='1' WHERE no_pes='$no_pes' AND id_brg='$id_brg'") or die(mysql_error());
	}
	function tampil_pembelian(){
		if(!empty($_GET['cari'])){
			$qry = "SELECT * FROM `br_pembelian` WHERE no_pes='".$_GET['cari']."' OR id_sup='".$_GET['cari']."' ORDER by wkt_ubah DESC";
		}
		else{
			$qry = "SELECT * FROM `br_pembelian` ORDER by wkt_ubah DESC";
		}
		$hasil = mysql_query($qry)  or die (mysql_error());
		if(mysql_num_rows($hasil)>0){
		while($row = mysql_fetch_array($hasil))
			$data[] = $row;
			return $data;
		}
	}
	function sunting_pembelian($field,$no_pes){
		$qry = "SELECT * FROM br_pembelian WHERE no_pes='$no_pes'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'no_pes')
			return $data['no_pes'];
		elseif($field == 'tgl_pes')
			return $data['tgl_pes'];
		elseif($field == 'id_sup')
			return $data['id_sup'];
		elseif($field == 'total_pembayaran')
			return $data['total_pembayaran'];
		elseif($field == 'diterima')
			return $data['diterima'];
		elseif($field == 'id_pengguna')
			return $data['id_pengguna'];
	}
	function simpan_pembelian($no_pes,$tgl_pes,$id_sup,$total_pembayaran,$diterima,$id_pengguna,$wkt_ubah){
		mysql_query("INSERT INTO br_pembelian VALUES('$no_pes','$tgl_pes','$id_sup','$total_pembayaran','$diterima','$id_pengguna','$wkt_ubah')") or die(mysql_error());
	}
	function perbaharui_pembelian($no_pes,$total_pembayaran){
		mysql_query("UPDATE br_pembelian SET total_pembayaran='$total_pembayaran', diterima='1' WHERE no_pes='$no_pes' ") or die(mysql_error());
	}
	
	
	//keuangan
	function simpan_keuangan($tgl,$ket,$masuk,$keluar){
		mysql_query("INSERT INTO keuangan VALUES('','$tgl','$ket','$masuk','$keluar')") or die (mysql_error());
	}
	
	
	//sementara
	function tampil_sementara($select,$where){
		$qry= mysql_query("SELECT $select FROM sementara $where") or die(mysql_error());;
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	function tambah_sementara($id_sementara,$value){
		mysql_query("INSERT INTO sementara VALUES ('$id_sementara','$value')") or die(mysql_error());
	}
	function hapus_sementara($id_sementara,$value){
		mysql_query("DELETE FROM sementara WHERE id_sementara='$id_sementara' AND value='$value'") or die(mysql_error());
	}
	
	
	//catatan sistem
	function log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu){
		$qry=" INSERT INTO log_sistem VALUES ('','$log_tipe','$pengguna','$log_lokasi','$log_pesan','$log_waktu')";
		mysql_query($qry) or die (mysql_error());
	}
}

?>
