<?php
class pegawai{
	//simpan
	function simpan($id_peg,$nm_peg,$jns_kelamin,$tmpt_lahir,$tgl_lahir,$almt_peg,$telp_peg,$pend_peg,$tgl_bergabung,$photo_peg,$pengalaman_peg,$kel_id,$wkt_ubah){		
		//dt_pegawai
		$qry ="	INSERT INTO dt_pegawai 
				VALUES
				('$id_peg','$nm_peg','$jns_kelamin','$tmpt_lahir','$tgl_lahir','$almt_peg','$telp_peg','$pend_peg','$tgl_bergabung','$photo_peg','$pengalaman_peg','$kel_id','$wkt_ubah')";
		
		//dt_pengguna
		$qry2=" INSERT INTO dt_pengguna 
				VALUES 
				('','".md5($id_peg)."','$nm_peg','$kel_id','$photo_peg','".md5($tgl_lahir)."','','$wkt_ubah')";
		$peg = mysql_query($qry) or die(mysql_error());
		$peng = mysql_query($qry2)or die(mysql_error());
	}
	
	//tampil
	function tampil(){
		if(!empty($_GET['cari'])){
			$qry = 	mysql_query("
					SELECT
					dt_pegawai.id_peg,
					dt_pegawai.nm_peg,
					dt_pegawai.almt_peg,
					dt_pegawai.jns_kelamin,
					dt_pegawai.telp_peg,
					kel_pengguna.nm_kel,
					dt_pegawai.wkt_ubah
					FROM dt_pegawai
					INNER JOIN kel_pengguna ON dt_pegawai.kel_id = kel_pengguna.kel_id 
					WHERE id_peg='".$_GET['cari']."' OR nm_peg LIKE '%".$_GET['cari']."%' 
					ORDER BY id_peg ASC
					")
					or die (mysql_error());
		}
		else{
			$qry = 	mysql_query("
					SELECT
					dt_pegawai.id_peg,
					dt_pegawai.nm_peg,
					dt_pegawai.almt_peg,
					dt_pegawai.jns_kelamin,
					dt_pegawai.telp_peg,
					kel_pengguna.nm_kel,
					dt_pegawai.wkt_ubah
					FROM dt_pegawai
					INNER JOIN kel_pengguna ON dt_pegawai.kel_id = kel_pengguna.kel_id 
					ORDER BY id_peg ASC
					")
					or die (mysql_error());
		}
		
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	
	//sunting
	function sunting($field,$id_peg){
		$qry = "SELECT * FROM dt_pegawai WHERE id_peg='$id_peg'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'id_peg')
			return $data['id_peg'];
		elseif($field == 'nm_peg')
			return $data['nm_peg'];
		elseif ($field == 'jns_kelamin')
			return $data['jns_kelamin'];
		elseif ($field == 'tmpt_lahir')
			return $data['tmpt_lahir'];
		elseif ($field == 'tgl_lahir')
			return $data['tgl_lahir'];
		elseif ($field == 'almt_peg')
			return $data['almt_peg'];
		elseif ($field == 'telp_peg')
			return $data['telp_peg'];
		elseif ($field == 'pend_peg')
			return $data['pend_peg'];
		elseif ($field == 'tgl_bergabung')
			return $data['tgl_bergabung'];
		elseif ($field == 'photo_peg')
			return $data['photo_peg'];
		elseif ($field == 'pengalaman_peg')
			return $data['pengalaman_peg'];
		elseif ($field == 'kel_id')
			return $data['kel_id'];
	}	
	//perbaharui
	function perbaharui($id_peg,$nm_peg,$jns_kelamin,$tmpt_lahir,$tgl_lahir,$almt_peg,$telp_peg,$pend_peg,$tgl_bergabung,$pengalaman_peg,$kel_id,$wkt_ubah){
		$qry="	UPDATE dt_pegawai SET nm_peg='$nm_peg',	jns_kelamin='$jns_kelamin',	tmpt_lahir='$tmpt_lahir',tgl_lahir='$tgl_lahir',almt_peg='$almt_peg',telp_peg='$telp_peg',pend_peg='$pend_peg',tgl_bergabung='$tgl_bergabung', pengalaman_peg='$pengalaman_peg',kel_id='$kel_id',wkt_ubah='$wkt_ubah' WHERE id_peg='$id_peg' ";
		$qry2=" UPDATE dt_pengguna SET nm_asli='$nm_peg',kel_id='$kel_id',kt_sandi='".md5($tgl_lahir)."',wkt_ubah='$wkt_ubah' WHERE nm_pengguna='".md5($id_peg)."'";
		
		mysql_query($qry) or die(mysql_error());
		mysql_query($qry2) or die(mysql_error());
		
	}
	function perbaharuiphoto($id_peg,$photo_peg){
		$qry="	UPDATE dt_pegawai SET photo_peg='$photo_peg' WHERE id_peg='$id_peg' ";
		$qry2=" UPDATE dt_pengguna SET photo_pengguna='$photo_peg' WHERE nm_pengguna='".md5($id_peg)."'";
		
		mysql_query($qry);
		mysql_query($qry2);
		return true;
		
	}
	
	//hapus
	function hapus($id_peg){
		$qry = mysql_query("DELETE FROM dt_pegawai WHERE id_peg='$id_peg'") OR DIE(mysql_error());
		$qry2 = mysql_query("DELETE FROM dt_pengguna WHERE nm_pengguna='".md5($id_peg)."'") OR DIE(mysql_error());
		
	}
	
	//kartu antri
	function kartu_antri($id_peg){
		$qry = "INSERT INTO sementara VALUES ('kartu_pegawai','$id_peg')";
		mysql_query($qry) OR DIE(mysql_error());
	}
		
	function cek_kosong(){
		$qry =mysql_query("SELECT * FROM sementara WHERE id_sementara like '%kartu%'")or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function cek_ada($id_peg){
		$qry = mysql_query("SELECT value FROM sementara WHERE  value='$id_peg'")or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	
	//catatan sistem
	function log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu){
		$qry=" INSERT INTO log_sistem VALUES ('','$log_tipe','$pengguna','$log_lokasi','$log_pesan','$log_waktu')";
		mysql_query($qry) or die (mysql_error());
	}
	
	//pengguna aplikasi
	function ambil_pengguna(){
		$qry = mysql_query("SELECT * FROM kel_pengguna WHERE kel_id!=1 AND kel_id!=2") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	
}





?>
