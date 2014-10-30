<script>
$(function() {
$( "#tgl_registrasi" ).datepicker({ dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});
$( "#masa_berlaku" ).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});
$(document).tooltip();
});

function validasi(){
var form = document.forms['form1'];
var nm_plg = form1.nm_plg.value;
var almt_plg = form1.almt_plg.value;
var telp_plg = form1.telp_plg.value;
var kt_sandi = form1.kt_sandi.value;
var ulang_kt_sandi = form1.ulang_kt_sandi.value;

		
toastr.options = {"closeButton": true,"debug": false,"positionClass": "toast-top-right","onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "3000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}
if (nm_plg == ""){form.nm_plg.focus();toastr.warning("Isikan nama pelanggan !", "SIMaBeS");return false;}
else if (almt_plg == ""){form.almt_plg.focus();toastr.warning("Isikan alamat pelanggan !", "SIMaBeS");return false;}
else if (telp_plg == ""){form.telp_plg.focus();toastr.warning("Isikan No. telepon pelanggan !", "SIMaBeS");return false;}
else if( ulang_kt_sandi != kt_sandi){form.kt_sandi.focus();toastr.warning("Kata sandi tidak sesuai !", "SIMaBeS");return false;}
else{toastr.success("Data berhasil disimpan");return true;}
}
</script>
