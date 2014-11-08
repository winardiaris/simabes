	<script>
    $(function() {
        $( "#tgl_trans" ).datepicker({ 
			dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
		});
    });

	
    </script>
<?php
	$ply = new pelayanan();
	$lokasi="Penjualan Langsung";
	$hari_ini 	= date("Y-m-d");

	$a="PL";
	$b=date("ymd");
// ----- awal kode otomatis ----- //
	$qry = "SELECT max(no_struk) as maxID FROM ply_penjualan WHERE no_struk LIKE '%$a/$b%'";
	$hasil = mysql_query($qry);
	$data = mysql_fetch_array($hasil);
	$idMax = $data['maxID'];
	$noUrut = (int) substr($idMax, 13, 4);
	$noUrut++;
	$no_struk = "ST/".$a ."/". $b . "/". sprintf("%04s", $noUrut);
// ----- akhir kode otomatis ----- //

// ----- total bayar ---- //
	$tot_bayar = $ply->ambil_jml_brg('tot_bayar_brg',$no_struk);
	$tot_brg = $ply->ambil_jml_brg('tot_brg',$no_struk);
		
	
//
if(empty($_GET['id'])){
	$cek = $ply->cek_ada($no_struk,"");
	echo'
	<div class="konten">
	<div class="lokasi"><label>'.$lokasi.'</label></div>
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form" onsubmit="return validasi_penjualan()">
	<div class="alat">';
	if(count($cek)>0){
		echo "
			<input type='submit' class='simpan' id='kiri' name='pl_simpan' value='Selesai Transaksi'>
			<input name='kembali' type='button'  value='Kembali' class='batal' id='kanan' onclick='history.back();'>
			";
	}
	else{
		echo"
			<input name='kembali' type='button'  value='Kembali' class='batal' id='sendiri' onclick='history.back();'>
		";
	}
	echo'
	<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
	</div>			
	<table cellspacing="0" cellpadding="2" border="0" class="table" >
		<tr>
			<td width="183px"><label>No Faktur</label></td>
			<td width="5px">:</td>
			<td ><input type="text" class="text" name="no_struk" value="'.$no_struk.'" readonly=""></td>
			<td><label>Nama Pelanggan*</label></td>
			<td>:</td>
			<td>
				<input type="text" class="text" name="nm_plg" size="30" maxlength="25">
				<input type="hidden" name="lokasi" value="'.$lokasi.'">
				<input type="hidden" name="tot_bayar" value="'.$tot_bayar.'">				
			</td>
		</tr>
		<tr>
			<td ><label>Tanggal</label></td>
			<td >:</td>
			<td><input type="text" class="text" name="tgl_trans" id="tgl_trans" value="'.$hari_ini.'"></td>
			<td><label>Petugas</label></td>
			<td>:</td>
			<td colspan="2">
				<input type="hidden" name="id_pengguna" value="'.$_SESSION['id_pengguna'].'">
				<input type="text" class="text" name="petugas" value="'.$_SESSION['nama_asli'].'" readonly="">
			</td>
		</tr>
	</table>
	</form>
	</div>
	<div class="konten2">
	<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="form1" >
		<div class="alat">
		<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
		<input list="id_brg" name="id_brg" class="text" size="30" maxlength="20" autocomplete="off" placeholder="ID Barang/Kode Barang/Nama Barang">
			<datalist id="id_brg">';
				$tampil = $ply->ambil_brg();
				foreach($tampil as $data){
					echo '<option value="'.$data['id_brg'].'">'.$data['nm_brg'].'</option>';
					echo '<option value="'.$data['id_brg'].'">'.$data['kode_brg'].'</option>';
				}
				echo'
			</datalist>
		<input type="number" name="jml_brg" class="text" size="10" maxlength="4" placeholder="Jumlah Beli" autocomplete="off">
		<input type="submit" name="tmbh_brg" value="Tambah" class="tambah" id="sendiri" onclick="return validasi_tambah_brg()">
		<input type="hidden" name="no_struk"  size="10" maxlength="4" value="'.$no_struk.'">
		</div>
		<table class="table" cellspacing="0" cellpadding="5" border="0">
		<tr id="th"><th width="10px">No</th><th align="center" width="10px">Hapus</th><th width="150px">ID Barang</th><th>Nama Barang</th>
			<th width="20px">Jumlah</th><th width="50px">Harga</th><th width="100px">Total</th>
		</tr>';
		
		
		$baris=0;
		$tampil_ply_penjualan = $ply->ambil_ply_penjualan($no_struk);
		if(count($tampil_ply_penjualan) > 0){
			foreach($tampil_ply_penjualan as $data){
			$baris++;
			$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				
			echo "
			<tr class='".$kolom."'>
				<td align='right'>$baris.</td>
				<td align='center'><a href='?mod=pelayanan&h=hapus&id_brg=".$data['id_brg']."&no_struk=$no_struk&jml=".$data['jml_brg']."' title='Menghapus data barang' onClick=\" return confirm('Hapus Data ?')\"><img src='../img/hapus.png' height='20px' width='20px'></a></td>
				<td>". $data['id_brg'] ."</td>
				<td>". $data['nm_brg'] ."</td>
				<td align='right'>". $data['jml_brg']."</td>
				<td align='right'>". number_format($data['hrg_jual'], 0,',','.') ."</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($data['total'], 0,',','.') ."</td>
			</tr>";
			}
		}
		else{echo "
			<tr><td>-</td><td>-</td><td>-</td><td>-</td><td align='right'>0</td><td align='right'>0</td><td align='right'>0</td></tr>";
		}
		echo '
			<tr class="total">
				<td colspan="4" align="right">Total</td>
				<td align="right">'.$tot_brg.'</td>
				<td></td>
				<td align="right" ><span class="mu">Rp. </span>'. number_format($tot_bayar, 0,',','.') .'
				</td>
			</tr>
		</table>
	</form>	
	</div>';
}
elseif(!empty($_GET['id']) && !empty($_GET['no_struk']) ){
	$no_struk = $_GET['no_struk'];
	$tot_bayar = $ply->ambil_jml_brg('tot_bayar_brg',$no_struk);
	echo '
		<div class="konten">
		<div class="lokasi"><label>Pembayaran Transaksi '.$no_struk.'</label></div>
		<form class="form1" action="?mod='.$_GET['mod'].'&h=aksi"  method="post" enctype="multipart/form-data"  name="ply_transaksi" >
		<div class="alat">
		<input type="submit" name="pl_selesai" value="Simpan" class="simpan" id="sendiri" >
		<input type="hidden" name="no_struk" value="'.$no_struk.'">
		<input type="hidden" name="lokasi" value="'.$lokasi.'"> <!-- di sembunyikan -->
		</div>
		<table>
		<tr><td><label>Total Pembayaran :</label><h1><span class="mu">Rp.  </span>'. number_format($tot_bayar, 0,',','.') .',-</h1>
		<input type="hidden" name="total" id="total" value="'.$tot_bayar.'"></td></tr>
		<tr><td><label>Uang Bayar : </label><input type="text" name="bayar" id="bayar" onkeyup="hitung();"></td></tr>
		<tr><td><label>Uang Kembali : </label><br><h2 >Rp. <span id="kembali"></span>,-</h2></td>
		</tr></table>
		</form>
		</div>';
}

	
?>
<script type="text/javascript">
function hitung(){
	var total = document.getElementById("total").value;
	var bayar = document.getElementById("bayar").value;
	kembali = bayar - total;
	document.getElementById("kembali").innerHTML = kembali;
}	
</script>
