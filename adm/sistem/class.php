<?php
class sistem{
	function perbaharui_bengkel($id_bengkel,$nm_bengkel,$telp1,$telp2,$almt_bengkel,$tntg_bengkel){
		mysql_query("UPDATE pengaturan SET nm_bengkel='$nm_bengkel',telp1='$telp1',telp2='$telp2', almt_bengkel='$almt_bengkel', tentang_bengkel='$tntg_bengkel' WHERE id='$id_bengkel' LIMIT 1") or die (mysql_error());
	}
	function simpan_logo_bengkel($id,$logo_bengkel){
		mysql_query("UPDATE pengaturan SET logo_bengkel='$logo_bengkel' WHERE id='$id' LIMIT 1") or die(mysql_error());
	}
	function tampil_bengkel($field,$id_bengkel){
		$qry = "SELECT * FROM pengaturan  WHERE id='$id_bengkel'";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'id')
			return $data['id'];
		elseif($field == 'nm_bengkel')
			return $data['nm_bengkel'];
		elseif($field == 'telp1')
			return $data['telp1'];
		elseif($field == 'telp2')
			return $data['telp2'];
		elseif($field == 'almt_bengkel')
			return $data['almt_bengkel'];
		elseif($field == 'logo_bengkel')
			return $data['logo_bengkel'];
		elseif($field == 'tentang_bengkel')
			return $data['tentang_bengkel'];
	}
	
	//pengguna aplikasi
	function tampil_pengguna(){
		if(!empty($_GET['cari'])){
			$qry = mysql_query("SELECT dt_pengguna.id_pengguna, dt_pengguna.nm_pengguna, dt_pengguna.nm_asli, dt_pengguna.kel_id, dt_pengguna.terakhir_masuk, kel_pengguna.nm_kel
								FROM dt_pengguna INNER JOIN kel_pengguna ON dt_pengguna.kel_id = kel_pengguna.kel_id  WHERE nm_pengguna='".$_GET['cari']."'or nm_asli LIKE '%".$_GET['cari']."%' AND dt_pengguna.id_pengguna != '1'ORDER by kel_id asc ") or die(mysql_error());
		}
		else{
			$qry = mysql_query("SELECT dt_pengguna.id_pengguna, dt_pengguna.nm_pengguna, dt_pengguna.nm_asli, dt_pengguna.kel_id, dt_pengguna.terakhir_masuk, kel_pengguna.nm_kel
								FROM dt_pengguna INNER JOIN kel_pengguna ON dt_pengguna.kel_id = kel_pengguna.kel_id AND dt_pengguna.id_pengguna != '1' ORDER BY kel_id ASC") or die(mysql_error());
		}
		
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}

	function sunting_pengguna($field,$id_pengguna){
		$qry = "SELECT * FROM dt_pengguna WHERE id_pengguna='$id_pengguna' LIMIT 1";
		$hasil = mysql_query($qry);
		$data = mysql_fetch_array($hasil);
		if($field == 'id_pengguna')
			return $data['id_pengguna'];
		elseif($field == 'nm_pengguna')
			return $data['nm_pengguna'];
		elseif ($field == 'nm_asli')
			return $data['nm_asli'];
		elseif ($field == 'kel_id')
			return $data['kel_id'];
		elseif ($field == 'photo_pengguna')
			return $data['photo_pengguna'];
	}
	function cek_pengguna($nm_pengguna){
		$qry = mysql_query("SELECT nm_pengguna FROM dt_pengguna WHERE nm_pengguna='".md5($nm_pengguna)."'") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function simpan_pengguna($nm_pengguna,$nm_asli,$kt_sandi,$kel_id,$photo_pengguna,$wkt_ubah){
		mysql_query(" 	INSERT INTO dt_pengguna (nm_pengguna,nm_asli,kt_sandi,kel_id,photo_pengguna,wkt_ubah)
						VALUES ('".md5($nm_pengguna)."','$nm_asli','".md5($kt_sandi)."','$kel_id','$photo_pengguna','$wkt_ubah')") or die(mysql_error());
	}
	function hapus_pengguna($id_pengguna){
		mysql_query("DELETE FROM dt_pengguna WHERE id_pengguna='$id_pengguna' LIMIT 1") or die(mysql_query());
	}
	function perbaharui_pengguna($id_pengguna,$nm_asli,$kel_id,$wkt_ubah){
		mysql_query("UPDATE dt_pengguna SET nm_asli='$nm_asli',kel_id='$kel_id',wkt_ubah='$wkt_ubah' WHERE id_pengguna='$id_pengguna'") or die(mysql_error());
	}
	function perbaharui_kt_sandi($nm_pengguna,$kt_sandi){
		mysql_query("UPDATE dt_pengguna SET kt_sandi='".md5($kt_sandi)."' WHERE nm_pengguna='$nm_pengguna' ") or die(mysql_error());
	}
	function perbaharui_photo_pengguna($nm_pengguna,$photo_pengguna){
		mysql_query("UPDATE dt_pengguna SET photo_pengguna='$photo_pengguna' WHERE  nm_pengguna='$nm_pengguna' ") or die(mysql_error());
	}
	
	function tampil_kelompok(){
		$qry = mysql_query("SELECT * FROM kel_pengguna ") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function cek_kelompok($nm_kel){
		$qry = mysql_query("SELECT nm_kel FROM kel_pengguna WHERE nm_kel='$nm_kel' ") or die (mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function simpan_kelompok($nm_kel){
		mysql_query("insert into kel_pengguna (nm_kel) values ('$nm_kel')") or die(mysql_error());
	}
	function tampil_kelompok2($field,$nm_kel){
		$qry = mysql_query("SELECT kel_id FROM kel_pengguna  WHERE nm_kel='$nm_kel'") or die(mysql_error());
		$data = mysql_fetch_array($qry);
		if($field == 'kel_id')
			return $data['kel_id'];
	}
	function sunting_kelompok($field,$kel_id){
		$qry = mysql_query("SELECT * FROM kel_pengguna  WHERE kel_id='$kel_id'") or die(mysql_error());
		$data = mysql_fetch_array($qry);
		if($field == 'kel_id')
			return $data['kel_id'];
		elseif($field == 'nm_kel')
			return $data['nm_kel'];
	}
	function perbaharui_kelompok($kel_id,$nm_kel){
		mysql_query("UPDATE kel_pengguna SET nm_kel='$nm_kel' WHERE kel_id='$kel_id' ") or die(mysql_error());
	}
	function simpan_akses_pengguna($kel_id,$id_menu){
		mysql_query("INSERT INTO akses_pengguna (kel_id,id_menu,r) VALUES ('$kel_id','$id_menu','1')") or die(mysql_error());
	}
	function tampil_akses_pengguna($kel_id){
		$qry = mysql_query("SELECT id_menu FROM akses_pengguna WHERE kel_id='$kel_id'") or die(mysql_query());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function hapus_akses_pengguna($kel_id){
		mysql_query("DELETE FROM akses_pengguna WHERE kel_id='$kel_id'") or die(mysql_error());
	}
	function hapus_kelompok($kel_id){
		mysql_query("DELETE FROM kel_pengguna WHERE kel_id='$kel_id' LIMIT 1") or die(mysql_error());
		mysql_query("DELETE FROM akses_pengguna WHERE kel_id='$kel_id'") or die(mysql_error());
	}
	
	
	function tampil_menu(){
		$qry = mysql_query("SELECT * FROM menu ORDER BY id_menu ASC") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	
	//catatan sistem
	function log($log_tipe,$pengguna,$log_lokasi,$log_pesan,$log_waktu){
		$qry=" INSERT INTO log_sistem VALUES ('','$log_tipe','$pengguna','$log_lokasi','$log_pesan','$log_waktu')";
		mysql_query($qry) or die (mysql_error());
	}
	function tampil_catatan_sistem(){
		if(!empty($_GET['cari'])){
			$qry = mysql_query("SELECT * FROM log_sistem WHERE 
					log_pesan LIKE '%".$_GET['cari']."%' 
					OR log_tipe LIKE '%".$_GET['cari']."%' 
					OR log_lokasi LIKE '%".$_GET['cari']."%' 
					OR log_waktu LIKE '%".$_GET['cari']."%' 
					ORDER BY log_id DESC") or die(mysql_error());
		}
		else{
			$qry = mysql_query("SELECT * FROM log_sistem ORDER BY log_id DESC ") or die(mysql_error());
		}
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
}
?>
