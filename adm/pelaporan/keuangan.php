	<script>
    $(function() {
        $( "#tgl1" ).datepicker({ 
			dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
		});
		$( "#tgl2" ).datepicker({ 
			dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
		});
    });
    </script>
<?php
	$lokasi="Laporan Keuangan";

	
	echo "
	<div class='konten'>
	<input class='noPrint'  type='button' value='Cetak' onclick='window.print()'>
		<div class='lokasi'><label>$lokasi</label></div>
	<form name='form1' class='form1' action='' method='get'>
		<input type='hidden' name='mod' value='".$_GET['mod']."'>
		<input type='hidden' name='h' value='".$_GET['h']."'>
		<div class='alat'>";
				if(!empty($_GET['tgl1']) && !empty($_GET['tgl2'])) {
					echo"
					Mulai tanggal <input type='text' name='tgl1' id='tgl1' class='text' size='10' maxlength='11' value='".$_GET['tgl1'] ."'> 
					sampai dengan tanggal <input type='text' name='tgl2' id='tgl2' class='text' size='10' maxlength='11' value='".$_GET['tgl2'] ."'>";
				}
				else{
					echo"
					Mulai tanggal <input type='text' name='tgl1' id='tgl1' class='text' size='10' maxlength='11'> 
					sampai dengan tanggal <input type='text' name='tgl2' id='tgl2' class='text' size='10' maxlength='11'>";
				}
	echo"		<input type='submit' name='tgl' value='Seleksi' class='simpan' id='kiri'>
				<a href='?mod=pelaporan_keuangan_tambah' class='btn'><button class='tambah' id='kanan' type='button'>Tambah laporan keuangan</button></a>

	</div>
	</form>";
	
	echo"
		<table class='table' cellpadding='5' cellspacing='0' border='0'>
			<tr>
				<th width='10px'>No.</th>
				<th width='80px'>Tanggal</th>
				<th>Keterangan</th>
				<th width='120px'>Masuk</th>
				<th width='120px'>Keluar</th>
			</tr>";
			$baris=0;
			if(!empty($_GET['tgl1']) && !empty($_GET['tgl2'])) {
				$qkeuangan=mysql_query("SELECT * FROM keuangan WHERE tgl BETWEEN '".$_GET['tgl1']."' AND '".$_GET['tgl2']."' ORDER BY id DESC");
				
				$a=mysql_query("SELECT 	SUM( IF( tgl BETWEEN '".$_GET['tgl1']."' AND '".$_GET['tgl2']."', masuk, 0 ) ) AS masuk
							 	,		SUM( IF( tgl BETWEEN '".$_GET['tgl1']."' AND '".$_GET['tgl2']."', keluar, 0 ) ) AS keluar 
								FROM  keuangan");
			}
			else{
				$qkeuangan=mysql_query("SELECT * FROM keuangan ORDER BY id DESC");
				
				$a=mysql_query("SELECT 	SUM(masuk)  AS masuk
							 	,		SUM( keluar ) AS keluar 
								FROM  keuangan");
			}
				while($dkeuangan=mysql_fetch_object($qkeuangan)){
					$baris++;
					$kolom= ($baris%2 == 1)? "kolom-ganjil" : "kolom-genap";
				echo "
			<tr class='$kolom'>
				<td align='right'>$baris.</td>
				<td align='center'>$dkeuangan->tgl</td>
				<td>$dkeuangan->ket</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($dkeuangan->masuk, 0,',','.') ."</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($dkeuangan->keluar, 0,',','.') ."</td>
			</tr>";
				}
			// ----- awal jumlah 
			

			$dsum=mysql_fetch_array($a);
			$masuk = $dsum['masuk'];
			$keluar = $dsum['keluar'];
			$saldo =$masuk-$keluar;
	echo"	<tr>
				<td colspan='3' align='right'>Jumlah</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($masuk, 0,',','.') ."</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($keluar, 0,',','.') ."</td>
			</tr>	
			<tr class='total'>
				<td colspan='3' align='right'>Saldo bersih</td>
				<td align='right'><span class='mu'>Rp. </span>". number_format($saldo, 0,',','.') ."</td>
				<td align='right'></td>
			</tr>
		";
			// ----- akhir jumlah
	echo"	
		</table>

	</div>
	";

?>

