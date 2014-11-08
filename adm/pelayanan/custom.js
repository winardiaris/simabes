<script type="text/javascript">
function validasi_mulai(){
	var form = document.forms['form1'];
	var id_plg = form1.id_plg.value;
	var no_polisi = form1.no_polisi.value;
	var jns_kendaraan = form1.jns_kendaraan.value;
	if(id_plg == ""){form.id_plg.focus();toastr.warning("Isikan ID pelanggan !", "SIMaBeS");return false;}
	else if(no_polisi == ""){form.no_polisi.focus();toastr.warning("Isikan nomor polisi !", "SIMaBeS");return false;}
	else if(jns_kendaraan == ""){form.jns_kendaraan.focus();toastr.warning("Isikan jenis kendaraan !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
function validasi_transaksi(){
	var form = document.forms['wo'];
	var id_peg = wo.id_peg.value;
	var saran = wo.saran.value;
	if(id_peg == ""){form.id_peg.focus();toastr.warning("Isikan Mekanik !", "SIMaBeS");return false;}
	else if(saran == ""){form.saran.focus();toastr.warning("Isikan Saran !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
function validasi_tambah_ply(){
	var form = document.forms['form1'];
	var id_kt_ply = form1.id_kt_ply.value;
	if(id_kt_ply == ""){form.id_kt_ply.focus();toastr.warning("Isikan kategori pelayanan !", "SIMaBeS");return false;}
}
function validasi_tambah_brg(){
	var form = document.forms['form1'];
	var id_brg = form1.id_brg.value;
	var jml_brg = form1.jml_brg.value;
	if(id_brg == ""){form.id_brg.focus();toastr.warning("Isikan barang !", "SIMaBeS");return false;}
	else if(jml_brg == ""){form.jml_brg.focus();toastr.warning("Isikan jumlah barang !", "SIMaBeS");return false;}	
}
function validasi_penjualan(){
	var form = document.forms['form'];
	var nm_plg = form.nm_plg.value;	
	var tgl_trans = form.tgl_trans.value;	
	if(nm_plg == ""){form.nm_plg.focus();toastr.warning("Isikan nama pelanggan !", "SIMaBeS");return false;}
	else if(tgl_trans == ""){form.tgl_trans.focus();toastr.warning("Isikan tanggal transaksi !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
</script>
