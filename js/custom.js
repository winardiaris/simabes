function setdisplay(id,s) {
  if (s == "1") {
    $(id).fadeIn();
    $(id).show();
  
  } else {
   $(id).fadeOut();
   $(id).hide();
   
  }
}
