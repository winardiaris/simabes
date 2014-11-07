<script type="text/javascript" >
$(function() {
$( "#tgl_registrasi" ).datepicker({ dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});
$( "#masa_berlaku" ).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});
});
telp.onkeyup=function(){
	b=telp.value.replace(/[^\d\.]/g,'').split('.');
	function c(telp){return telp.split('').reverse().join('')}
	telp.value=c(c(b[0]).replace(/(\d{3})/g,'$1')).replace(/^,/g,'')+(b[1]!==undefined?'.'+b[1]:'');
}

function validasi(){
var form = document.forms['form1'];
var nm_plg = form1.nm_plg.value;
var almt_plg = form1.almt_plg.value;
var telp_plg = form1.telp_plg.value;
var kt_sandi = form1.kt_sandi.value;
var ulang_kt_sandi = form1.ulang_kt_sandi.value;

	
if (nm_plg == ""){form.nm_plg.focus();toastr.warning("Isikan nama pelanggan !", "SIMaBeS");return false;}
else if (almt_plg == ""){form.almt_plg.focus();toastr.warning("Isikan alamat pelanggan !", "SIMaBeS");return false;}
else if (telp_plg == ""){form.telp_plg.focus();toastr.warning("Isikan No. telepon pelanggan !", "SIMaBeS");return false;}
else if( ulang_kt_sandi != kt_sandi){form.kt_sandi.focus();toastr.warning("Kata sandi tidak sesuai !", "SIMaBeS");return false;}
else{toastr.success("Data berhasil disimpan");return true;}
}

</script>
