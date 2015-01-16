<?php
include "../inc/koneksi.php";

$baselink="?mod=katalog"; 
$BarisPerHal = 18;
if(isset($_GET['page'])){
    $NoHal = $_GET['page'];
} 
else $NoHal = 1;
$offset = 1 + (($NoHal - 1) * $BarisPerHal);
$offset2=$offset - 1;
$query   = "SELECT COUNT(*) as jumData FROM `br_data`";
$hasil  = mysql_query($query);
$data     = mysql_fetch_array($hasil);
$jumData = $data['jumData'];

		if(!empty($_GET['s'])) {
			$qry="select * from br_data where kode_brg='".$_GET['s']."'or nm_brg LIKE '%".$_GET['s']."%' ORDER by id_brg asc LIMIT $offset2, $BarisPerHal";
		}
		elseif(!empty($_GET['cat'])){
			$qry="select * from br_data where id_kt_brg='".$_GET['cat']."' order by id_brg ASC LIMIT $offset2, $BarisPerHal";
		}
		else {
			$qry="select * from br_data ORDER by id_brg ASC  LIMIT $offset2, $BarisPerHal";
		}
		$list=mysql_query($qry) or die (mysql_error());
		$count=mysql_num_rows($list);
		
?>
 <div class="col-lg-10">
		<!-- search -->
		<div class="col-lg-12 search">
			<div class="col-md-6 " >
				<h1>Cari ...</h1>
				<form action="" method="get" name="form-search">
				<div class="input-group">
					<input type="text" name="s" placeholder="Pencarian (ID | Kode | Nama Barang)" class="form-control" value="<?php if(!empty($_GET['s'])){echo $_GET['s'];} ?>"required>
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
					</span>
				</div>
				</form>
			</div>
			<div class="col-md-6">
			<div class="form-group">
				<h1>Kategori</h1>
				<form  action="" method="get" name="form-cat" role="form">
				
                <select class="form-control" name="cat" id="cat" onchange="this.form.submit()">
					<option value="">-- Pilih Kategori --</option>
					<?php
						$qkat=mysql_query("SELECT id_kt_brg,nm_kt_brg FROM br_kategori") or die (mysql_error());
						while($dkat=mysql_fetch_array($qkat)){
							echo '<option value="'.$dkat['id_kt_brg'].'" '; 
								if(!empty($_GET['cat'])){ if($_GET['cat']==$dkat['id_kt_brg']){echo "selected";}}
							echo'>'.$dkat['nm_kt_brg'].'</option>';
						}
							
					?>
				</select>
				</form>
			</div>
			</div>
		</div>
		
	
		
		<!-- item catalog -->
		<div class="col-lg-12">
			<?php
			if($count>0){	
			while($data=mysql_fetch_array($list)){
				echo'
				<a href="katalog/lihat.php?id_brg='.$data['id_brg'].'" target="framepopup" onClick="setdisplay(\'divpopup\',1)">
				<div class="col-xs-4 col-md-3 col-lg-3 ">
				<div class="row ct-item ">
					<img  src="adm/'.$data['photo_brg'].'" style="width:100%;">
					<div class="col-lg-12 ct-item-name"><label>'.substr($data['nm_brg'],0,15).'</label></div>
					<div class="col-lg-8 ct-item-desc"><p>'; 
						if(!empty($data['kode_brg'])){
							echo substr($data['kode_brg'],0,15) ;
							if(strlen($data['kode_brg']) > 15)
							echo "...";
						}
						else{echo substr($data['id_brg'],0,15);}
						
						$harga = $data['hrg_jual'];
						$price = number_format($harga, 0,',','.');
					echo'<br><label>'.$price.'</label></p></div>
					<div class="col-lg-4 ct-item-stok"><h3>'.$data['stok'].'</h3></div>
				</div>
				</div></a>';
			}
			}
			else{echo "<h3>barang tidak ada</h3>";}
			?>	
			
			
		</div>
		<div class="col-lg-6">
		<?php if($count>0){include ("katalog/halaman.php");} ?>
		</div>
    </div>
    <div class="col-lg-2 col-xs-12 col-md-12 smp">
	<!-- top sell -->
    <h3>Top 5</h3>
		<?php
			
			$qry=mysql_query("select * from br_data ORDER by terjual DESC  LIMIT 5") or die(mysql_error());
			while($data = mysql_fetch_array($qry)){
				echo'
				<a href="katalog/lihat.php?id_brg='.$data['id_brg'].'" target="framepopup" onClick="setdisplay(\'divpopup\',1)">
				<div class="col-lg-12 col-md-3 col-xs-2 top-item" >
					<div class="col-lg-5">
						<img  src="adm/'.$data['photo_brg'].'" style="width:100%;">
					</div>
					<div class="col-lg-7 ">
						<label>'.$data['nm_brg'].'</label>
						<p>';
						if(!empty($data['kode_brg'])){
							echo substr($data['kode_brg'],0,15) ;
							if(strlen($data['kode_brg']) > 15)
							echo "...";
						}
						else{echo substr($data['id_brg'],0,15);}
						echo'</p>
					</div>
				</div></a>
				';
				
			}
		?>		
    </div>	
<?php echo $iframe; ?>
