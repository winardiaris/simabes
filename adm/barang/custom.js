<script type="text/javascript" >
$(function() {$( "#tgl_masuk" ).datepicker({ dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true	});});
hrg_beli.onkeyup=function(){
	b=hrg_beli.value.replace(/[^\d\.]/g,'').split('.');
	function c(hrg_beli){return hrg_beli.split('').reverse().join('')}
	hrg_beli.value=c(c(b[0]).replace(/(\d{3})/g,'$1,')).replace(/^,/g,'')+(b[1]!==undefined?'.'+b[1]:'');
}
hrg_jual.onkeyup=function(){
	b=hrg_jual.value.replace(/[^\d\.]/g,'').split('.');
	function c(hrg_jual){return hrg_jual.split('').reverse().join('')}
	hrg_jual.value=c(c(b[0]).replace(/(\d{3})/g,'$1,')).replace(/^,/g,'')+(b[1]!==undefined?'.'+b[1]:'');
}
function validasi_barang(){
	var form = document.forms['form1'];
	var nm_brg = form1.nm_brg.value;
	var jns = $('input:checkbox:checked').length;
	var kua = $('input:radio:checked').length;
	var hrg_beli = form1.hrg_beli.value;
	var hrg_jual = form1.hrg_jual.value;
	var stok = form1.stok.value;
	var stok_min = form1.stok_min.value;
	

	if(nm_brg == ""){form.nm_brg.focus();toastr.warning("Isikan nama barang !", "SIMaBeS");return false;}
	else if(jns == 0){toastr.warning("Pilih jenis kendaraan !", "SIMaBeS");return false;}
	else if(kua == 0){toastr.warning("Pilih kualitas barang !", "SIMaBeS");return false;}
	else if(hrg_beli == ""){form.hrg_beli.focus();toastr.warning("Isikan harga beli barang !", "SIMaBeS");return false;}
	else if(hrg_jual == ""){form.hrg_jual.focus();toastr.warning("Isikan harga jual barang !", "SIMaBeS");return false;}
	else if(stok == ""){form.stok.focus();toastr.warning("Isikan stok barang !", "SIMaBeS");return false;}
	else if(stok_min == ""){form.stok_min.focus();toastr.warning("Isikan stok minimal !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
function validasi_kategori(){
	var form = document.forms['form1'];
	var id_kt_brg = form1.id_kt_brg.value;
	var nm_kt_brg = form1.nm_kt_brg.value;
	if(id_kt_brg == ""){form.id_kt_brg.focus();toastr.warning("Isikan id kategori barang !", "SIMaBeS");return false;}
	else if(nm_kt_brg == ""){form.nm_kt_brg.focus();toastr.warning("Isikan nama kategori barang !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
function validasi_kendaraan(){
	var form = document.forms['form1'];
	var id_kendaraan = form1.id_kendaraan.value;
	var kendaraan = form1.kendaraan.value;
	if(id_kendaraan == ""){form.id_kendaraan.focus();toastr.warning("Isikan id kendaraan !", "SIMaBeS");return false;}
	else if(kendaraan == ""){form.kendaraan.focus();toastr.warning("Isikan nama kendaraan !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
function validasi_kualitas(){
	var form = document.forms['form1'];
	var id_kualitas = form1.id_kualitas.value;
	var kualitas = form1.kualitas.value;
	if(id_kualitas == ""){form.id_kualitas.focus();toastr.warning("Isikan id kualitas barang !", "SIMaBeS");return false;}
	else if(kualitas == ""){form.kualitas.focus();toastr.warning("Isikan nama kualitas barang !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
function validasi_satuan(){
	var form = document.forms['form1'];
	var id_satuan = form1.id_satuan.value;
	var satuan = form1.satuan.value;
	if(id_satuan == ""){form.id_satuan.focus();toastr.warning("Isikan id satuan barang !", "SIMaBeS");return false;}
	else if(satuan == ""){form.satuan.focus();toastr.warning("Isikan nama satuan barang !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
function validasi_rak(){
	var form = document.forms['form1'];
	var nm_rak = form1.nm_rak.value;
	var ket = form1.ket.value;
	if(nm_rak == ""){form.nm_rak.focus();toastr.warning("Isikan nama rak penyimpanan !", "SIMaBeS");return false;}
	else if(ket == ""){form.ket.focus();toastr.warning("Isikan keterangan rak !", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
function validasi_penyalur(){
	var form = document.forms['form1'];
	var nm_sup = form1.nm_sup.value;
	var almt_sup = form1.almt_sup.value;
	var telp_sup = form1.telp_sup.value;
	if(nm_sup == ""){form.nm_sup.focus();toastr.warning("Isikan nama penyalur !", "SIMaBeS");return false;}
	else if(almt_sup == ""){form.almt_sup.focus();toastr.warning("Isikan alamat penyalur!", "SIMaBeS");return false;}
	else if(telp_sup == ""){form.telp_sup.focus();toastr.warning("Isikan telepon/ponsel penyalur!", "SIMaBeS");return false;}
	else{toastr.success("Data berhasil disimpan");return true;}
}
</script>
