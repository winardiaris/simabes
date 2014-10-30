<?php
	echo'
		<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
		<html><head>  
			<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
			<link rel="stylesheet" type="text/css" href="../styler/kartu.css">
			<link rel="shortcut icon" href="../icon.ico" />
		</head>
		<body>
			<form><input class="noPrint" type="button" value="Cetak" onclick="window.print()"></form>
			<div class="page">';
	
	include ("../inc/konf.php");
	include ("../inc/koneksi.php");
	
	$sql = "SELECT count( * ) as num FROM `sementara` WHERE id_sementara='kartu_pelanggan' OR id_sementara='kartu_pegawai' ";
	$result = mysql_query($sql);
	$result = mysql_fetch_assoc( $result );
	$jml = $result['num'];
	
	if ($jml!=0){
	$qkartu=mysql_query("select * from sementara WHERE id_sementara='kartu_pelanggan' OR id_sementara='kartu_pegawai'");

	while($dkartu=mysql_fetch_object($qkartu)){
		$cekplg="select * from dt_pelanggan where id_plg='$dkartu->value'";
		$plg=mysql_query($cekplg) or die(mysql_error());
		
		$cekpeg="select * from dt_pegawai where id_peg='$dkartu->value'";
		$peg=mysql_query($cekpeg) or die(mysql_error());
		
			if(mysql_num_rows($plg)>0){
				$qid=mysql_query("SELECT * FROM dt_pelanggan WHERE id_plg='$dkartu->value'");
				$d2id=mysql_fetch_object($plg);
				$jns_kartu="KARTU PELANGGAN";
				$jns_id="ID Pelanggan";
				$id=$d2id->id_plg;
				$nama=$d2id->nm_plg;
				$alamat=$d2id->almt_plg;
				$ket="Masa Berlaku";
				$dket=$d2id->masa_berlaku;
				$photo=$d2id->photo_plg;
			}
			elseif(mysql_num_rows($peg)>0){
				$qid=mysql_query("SELECT * FROM dt_pegawai WHERE id_peg='$dkartu->value'");
				$d2id=mysql_fetch_object($peg);
				$jns_kartu="KARTU PEGAWAI";
				$jns_id="ID Pegawai";
				$id=$d2id->id_peg;
				$nama=$d2id->nm_peg;
				$alamat=$d2id->almt_peg;
				$ket="Jabatan";
					
					$a=mysql_query("SELECT nm_kel FROM kel_pengguna WHERE kel_id='$d2id->kel_id'");
					$b=mysql_fetch_object($a);
					
				$dket=$b->nm_kel;
				$photo=$d2id->photo_peg;
			}
		
		$qpeng=mysql_query("select * from pengaturan");
		$dpeng=mysql_fetch_object($qpeng);
		while($did=mysql_fetch_object($qid)){
			echo'
					
					<div class="kartu">
						<table border="0" class="kartu_header" cellpadding="2" cellspacing="0">
							<tr>
								<td colspan="1" rowspan="2" ><img src="'. $dpeng->logo_bengkel .'" alt="'.  $dpeng->nm_bengkel .'" width="40" height="40"></td>
								<td align="center">
									<font class="kartu_nm_bengkel" >'. $dpeng->nm_bengkel.'</font><br>
									<font class="kartu_almt_bengkel">'. $dpeng->almt_bengkel."<br>".$dpeng->telp1." / ".$dpeng->telp2.'</font>
								</td>
							</tr>
							<tr>
								<td align="center"><strong>'. $jns_kartu.'</strong></td>
							</tr>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" class="kartu_konten" width="100%">
							<tr >
								<td width="70px" height="15px"><font>'. $jns_id.'</font></td>
								<td width="5px">:</td>
								<td ><strong>'. $id.'</strong></td>
								<td width="50px" rowspan="4" align="center" valign="top">
									<img id="photo_plg" src="'. $photo.'" alt="'.  $id.'"/>
								</td>
							</tr>
							<tr >
								<td height="15px"><font>Nama</font></td>
								<td>:</td>
								<td>'. $nama.'</td>
							</tr>
							<tr>
								<td valign="top"><font>Alamat</font></td>
								<td valign="top">:</td>
								<td valign="top">'. $alamat.'</td>
							</tr>
							<tr >
								<td height="15px"><font>'. $ket.'</font></td>
								<td>:</td>
								<td>'. $dket.'</td>
							</tr>
						</table>
					</div>';
		}//penutup while($did=mysql_fetch_object($qid))
	}//penutup while($dkartu=mysql_fetch_object($qkartu))

	sleep(1);
		$q= "DELETE FROM `sementara`  WHERE id_sementara='kartu_pelanggan' OR id_sementara='kartu_pegawai'";
		mysql_query($q) or die (mysql_error());
	}//akhir if jumlah
	else{
		echo "<script type='text/javascript'> alert('Jumlah antrian kosong');setdisplay('divpopup',0);history.back();</script>";
	}
	echo'</div></body></html>';
?>

