<?php
$lokasi="Tambah Laporan Keuangan";
echo"<div class='konten'>";
if(!empty($_POST['simpan'])){
	$tgl=$_POST['tgl'];
	$jns=$_POST['jenis'];
	$ket=$_POST['ket'];
	$jml=preg_replace("/[^0-9]/", "", $_POST['jml']);
	
	if(empty($tgl)){
		$tgl=date("Y-m-d");
	}
	elseif(empty($ket)){
		echo "<script type='text/javascript'> alert('Isikan keterangan laporan!!');window.location='?mod=pelaporan_keuangan_tambah';</script>";
		
	}
	elseif(empty($jml)){
		echo "<script type='text/javascript'> alert('Isikan jumlah uang yang dilaporkan!!');window.location='?mod=pelaporan_keuangan_tambah';</script>";
		
	}
	else{
		if($jns=="masuk"){
			mysql_query("INSERT INTO keuangan VALUES ('','$tgl','$ket','$jml','0')") or die(mysql_error());
		}
		elseif($jns=="keluar"){
			mysql_query("INSERT INTO keuangan VALUES ('','$tgl','$ket','0','$jml')") or die(mysql_error());
		}
				//membuat log
				$pengguna=$_SESSION['nama_asli'];
				$pesan="Berhasil menambahkan pelaporan  keuangan ($ket : $jns : $jml)";
				$sekarang = date("Y-m-d H:i:s");
				$log=" insert into log_sistem (log_id,log_tipe,id,log_lokasi,log_pesan,log_waktu)".
				"values('','Staff','$pengguna','$lokasi','$pesan','$sekarang')";
				mysql_query($log) or die (mysql_error());
				//
		echo "<script type='text/javascript'> alert('Berhasil menambahkan laporan keuangan!!');window.location='?mod=pelaporan_keuangan';</script>";
	}
}
else{
echo "
<script>
    $(function() {
        $( \"#tgl\" ).datepicker({ 
			dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
		});
    });
    </script>
    

<div class='lokasi'><label>$lokasi</label></div>
<form action='' class='form1' method='post' onsubmit=\"return confirm('Simpan Laporan ?')\">
	<table class='table' cellpadding='5' >
		<tr>
			<td width='170px'>Tanggal</td>
			<td width='10px'>:</td>
			<td><input type='text' class='text' id='tgl' name='tgl' value='".date("Y-m-d")."'></td>
		</tr>
		<tr>
			<td>Jenis Keuangan</td>
			<td>:</td>
			<td><input type='radio' name='jenis' value='masuk' checked>Pemasukan <input type='radio' name='jenis' value='keluar'>Pengeluaran</td>
		</tr>
		<tr>
			<td valign='top'>Keterangan</td>
			<td valign='top'>:</td>
			<td><textarea rows='5' cols='50' name='ket'></textarea></td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td>:</td>
			<td><input type='text' class='text' name='jml' id='jml'></td>
		</tr>
	
	<script type=\"text/javascript\">
		jml.onkeyup=function(){
		b=jml.value.replace(/[^\d\.]/g,'').split('.');
		function c(jml){return jml.split('').reverse().join('')}
		jml.value=c(c(b[0]).replace(/(\d{3})/g,'$1,')).replace(/^,/g,'')+(b[1]!==undefined?'.'+b[1]:'');
		}
	
	</script>
	</table>
	<div class='alat'>
		<input type='submit' value='Simpan' class='simpan' id='kiri' name='simpan'  >
		<input type='reset' value='Batal' class='batal' id='kanan' onClick='javascript:history.back()'>
	</div>
</form>
</div>
";
}
?>
