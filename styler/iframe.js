function setvisibility(id,s) {
  if (s == "1") {
    document.getElementById(id).style.visibility = "visible";
  } else {
    document.getElementById(id).style.visibility = "hidden";
  }
}
function setdisplay(id,s) {
  if (s == "1") {
    document.getElementById(id).style.display = "block";
  } else {
    document.getElementById(id).style.display = "none";
  }
}
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

function cek_chk(pesan){
	var len = $('input:checkbox:checked').length;
	if(len == 0){toastr.warning(""+pesan+"", "SIMaBeS");return false;}
	else{return true;}
}
function cek_data(i,pesan){
	if(i == 0){toastr.warning(""+pesan+"", "SIMaBeS");return false;}
	else{setdisplay('divpopup',1); return true;}
}
