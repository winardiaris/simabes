<script>
    $(function() {
        $( "#tgl_bergabung" ).datepicker({ dateFormat:'yy-mm-dd',changeMonth: true, changeYear: true });
		$( "#tgl_lahir" ).datepicker({ dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true});
    });
   

function validasi(){
var form = document.forms['form1'];
var nm_peg = form1.nm_peg.value;
var tmpt_lahir = form1.tmpt_lahir.value;
var tgl_lahir = form1.tgl_lahir.value;
var almt_peg = form1.almt_peg.value;
var telp_peg = form1.telp_peg.value;
var pend_peg = form1.pend_peg.value;
var pengalaman_peg = form1.pengalaman_peg.value;


if (nm_peg == ""){form.nm_peg.focus();toastr.warning("Isikan nama pegawai !", "SIMaBeS");return false;}
else if (tmpt_lahir == ""){form.tmpt_lahir.focus();toastr.warning("Isikan tempat lahir pegawai !", "SIMaBeS");return false;}
else if (tgl_lahir == ""){form.tgl_lahir.focus();toastr.warning("Isikan tanggal lahir pegawai !", "SIMaBeS");return false;}
else if (almt_peg == ""){form.almt_peg.focus();toastr.warning("Isikan alamat pegawai !", "SIMaBeS");return false;}
else if (telp_peg == ""){form.telp_peg.focus();toastr.warning("Isikan telepon pegawai !", "SIMaBeS");return false;}
else if (pend_peg == ""){form.pend_peg.focus();toastr.warning("Isikan pendidikan terakhir pegawai !", "SIMaBeS");return false;}
else if (pengalaman_peg == ""){form.pengalaman_peg.focus();toastr.warning("Isikan pengalaman kerja pegawai !", "SIMaBeS");return false;}
else{toastr.success("Data berhasil disimpan");return true;}
}
</script>
