<?php
class pelaporan{
	//pelayanan
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
	function tampil_kt_pelayanan(){
		$qry=	mysql_query("SELECT * FROM ply_kategori")or die (mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
	function tampil_ply_detail($select,$where){
		$qry=mysql_query("SELECT $select FROM ply_detail $where") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;	
		}
	}
	function rata2_ply(){
		$qtgl=mysql_query("	SELECT  MIN( tgl_struk ) AS tgl1, COUNT(*) AS jml FROM  `ply_`");
		$dtgl=mysql_fetch_object($qtgl);
		$tgl1=$dtgl->tgl1;
		$jml=$dtgl->jml;
		
		$pecah1=explode("-",$tgl1);
		$date1=$pecah1[2];
		$month1=$pecah1[1];
		$year1=$pecah1[0];

		$tgl2=date("Y-m-d");
		$pecah2=explode("-",$tgl2);
		$date2=$pecah2[2];
		$month2=$pecah2[1];
		$year2=$pecah2[0];

		$jd1=GregorianToJD($month1,$date1,$year1);
		$jd2=GregorianToJD($month2,$date2,$year2);
		$selisih=$jd2-$jd1 +1 ;

		$rata2=$jml / $selisih;
		
		return $rata2;
	}
	function belum_transaksi(){
		$qry=mysql_query("SELECT id_plg, nm_plg FROM dt_pelanggan WHERE transaksi='0'");
		if(mysql_num_rows($qry)>0){
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
		}				
	}
	//penjualan
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
	function rata2_pl(){
		$qtgl=mysql_query("	SELECT  MIN( tgl_struk ) AS tgl1, COUNT(*) AS jml FROM  `ply_penjualan`");
		if(mysql_num_rows($qtgl)>0){
		$dtgl=mysql_fetch_object($qtgl);
		$tgl1=$dtgl->tgl1;
		$jml=$dtgl->jml;
				
		$pecah1=explode("-",$tgl1);
		$date1=$pecah1[2];
		$month1=$pecah1[1];
		$year1=$pecah1[0];

		$tgl2=date("Y-m-d");
		$pecah2=explode("-",$tgl2);
		$date2=$pecah2[2];
		$month2=$pecah2[1];
		$year2=$pecah2[0];

		$jd1=GregorianToJD($month1,$date1,$year1);
		$jd2=GregorianToJD($month2,$date2,$year2);
		$selisih=$jd2-$jd1+1;

		$rata2=$jml / $selisih;
		}
		else{$rata2 = 0;}
		return $rata2;
	}
	function top_ten(){
		$qry=mysql_query("SELECT id_brg, nm_brg , terjual  FROM br_data where terjual !=0 ORDER BY terjual DESC LIMIT 10") or die(mysql_error());
		while($row = mysql_fetch_array($qry))
			$data[] = $row;
			return $data;
	}
}

?>
