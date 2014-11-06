<?php
class pelanggan{
	
	//simpan
	function simpan($id_plg,$nm_plg,$tgl_registrasi,$masa_berlaku,$almt_plg,$telp_plg,$jns_kelamin,$photo_plg,$wkt_ubah,$kt_sandi){
		
		//dt_pelanggan
		$qry=" 	INSERT INTO dt_pelanggan 
				(id_plg,nm_plg,tgl_registrasi,masa_berlaku,almt_plg,telp_plg,jns_kelamin,photo_plg,wkt_ubah)
				VALUES 
				('$id_plg','$nm_plg','$tgl_registrasi','$masa_berlaku','$almt_plg','$telp_plg','$jns_kelamin','$photo_plg','$wkt_ubah')";
			
		//dt_pengguna
		$qry2=" INSERT INTO dt_pengguna 
				VALUES 
				('','".md5($id_plg)."','$nm_plg','2','$photo_plg','".md5($kt_sandi)."','','$wkt_ubah')";
				
		mysql_query($qry) or die(mysql_error());
		mysql_query($qry2)or die(mysql_error());
	}
	
	//tampil
	function tampil(){
		if(!empty($_GET['cari'])) {
			$qry=	mysql_query("SELECT * FROM dt_pelanggan WHERE id_plg='".$_GET['cari']."' AND masa_berlaku >  tgl_registrasi  OR nm_plg LIKE '%".$_GET['cari']."%' AND masa_berlaku >  tgl_registrasi  ORDER by id_plg ASC ")
					or die (mysql_error());
		}
		else {
			$qry=	mysql_query("SELECT * FROM dt_pelanggan WHERE masa_berlaku >  tgl_registrasi ORDER by id_plg ASC ")
					or die (mysql_error());
		}

		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	
	
	//sunting ===================================================================================================
	function sunting($field,$id_plg){
		$qry = "SELECT * FROM dt_pelanggan WHERE id_plg='$id_plg'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		
		if($field == 'id_plg')
			return $data['id_plg'];
		elseif($field == 'nm_plg')
			return $data['nm_plg'];
		elseif($field == 'tgl_registrasi')
			return $data['tgl_registrasi'];
		elseif($field == 'masa_berlaku')
			return $data['masa_berlaku'];
		elseif($field == 'almt_plg')
			return $data['almt_plg'];
		elseif($field == 'telp_plg')
			return $data['telp_plg'];
		elseif($field == 'jns_kelamin')
			return $data['jns_kelamin'];
		elseif($field == 'photo_plg')
			return $data['photo_plg'];
		elseif($field == 'transaksi')
			return $data['transaksi'];
		elseif($field == 'perpanjang')
			return $data['perpanjang'];
		elseif($field == 'wkt_ubah')
			return $data['wkt_ubah'];
		
	}
	
	
	//perbaharui
	function perbaharui($id_plg,$nm_plg,$tgl_registrasi,$masa_berlaku,$almt_plg,$telp_plg,$jns_kelamin,$wkt_ubah,$kt_sandi){
		$qry="UPDATE dt_pelanggan SET nm_plg='$nm_plg',tgl_registrasi='$tgl_registrasi', masa_berlaku='$masa_berlaku', almt_plg='$almt_plg',telp_plg='$telp_plg',jns_kelamin='$jns_kelamin', wkt_ubah='$wkt_ubah' WHERE id_plg='$id_plg' LIMIT 1";
		$qry2=" UPDATE dt_pengguna SET nm_asli='$nm_plg',wkt_ubah='$wkt_ubah' WHERE nm_pengguna='".md5($id_plg)."'";
		
		mysql_query($qry) or die(mysql_error());
		mysql_query($qry2) or die(mysql_error());
		
	}
	
	//perbaharuiphoto
	function perbaharuiphoto($id_plg,$photo_plg){
		$qry = "UPDATE dt_pelanggan SET photo_plg='$photo_plg' WHERE id_plg='$id_plg' LIMIT 1";
		$qry2 = "UPDATE dt_pengguna SET photo_pengguna='$photo_plg' WHERE  nm_pengguna='".md5($id_plg)."' LIMIT 1";
		
		mysql_query($qry);
		mysql_query($qry2);
		return true;
	}
	
	//hapus
	function hapus($id_plg){
		$qry = "DELETE FROM dt_pelanggan WHERE id_plg='$id_plg'";
		$qry2= "DELETE FROM dt_pengguna WHERE nm_pengguna='".md5($id_plg)."'";
		mysql_query($qry);
		mysql_query($qry2);
	}
	
	//kartu antri
	function kartu_antri($id_plg){
		$qry = "INSERT INTO sementara VALUES ('kartu_pelanggan','$id_plg')";
		mysql_query($qry) OR DIE(mysql_error());
	}
	function cek_kosong(){
		$qry =mysql_query("SELECT * FROM sementara WHERE id_sementara LIKE '%kartu%'")or die(mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	function cek_ada($id_plg){
		$qry = mysql_query("SELECT value FROM sementara WHERE  value='$id_plg'")or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	
	//kadaluarsa
	function kadaluarsa(){
		if(!empty($_GET['cari'])) {
			$qry=	mysql_query("SELECT * FROM dt_pelanggan WHERE id_plg='".$_GET['cari']."' AND masa_berlaku <=  tgl_registrasi  OR nm_plg LIKE '%".$_GET['cari']."%' AND masa_berlaku <=  tgl_registrasi ORDER by id_plg ASC ")
					or die (mysql_error());
		}
		else {
			$qry=	mysql_query("SELECT * FROM dt_pelanggan WHERE masa_berlaku <=  tgl_registrasi	ORDER by id_plg ASC ")
					or die (mysql_error());
		}
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}
	}
	function perpanjang($id_plg,$masa_berlaku,$perpanjang){
		$qry= "UPDATE dt_pelanggan SET masa_berlaku='$masa_berlaku', perpanjang='$perpanjang' WHERE id_plg='$id_plg'";
		mysql_query($qry) or die(mysql_error());
		
		
	}
	
	//catatan sistem
	function log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu){
		$qry=" INSERT INTO log_sistem VALUES ('','$log_tipe','$pengguna','$log_lokasi','$log_pesan','$log_waktu')";
		mysql_query($qry) or die (mysql_error());
	}

}

?>
