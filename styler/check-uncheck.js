	function checkUncheckAll(byk_data) {
	 // mengambil id checkbox semua
	 var all = eval("document.forms['form1'].semua");
	 
	 // jika semua tercentang
	 if (all.checked == true)
	 {
	  // lakukan looping sebanyak data 
	  for (var j = 1; j <= byk_data; j++) {
	 
	   // mengeset var checkbox data
	   var box = eval("document.forms['form1'].item" + j);
	   // jika checkboxnya tidak terdefinisi, maka lanjutkan
	   // tidak ada error yang terjadi (error handling)
	   if (box == undefined) {
	    continue;
	   // selain itu, jika data tidak tercentang, maka ubah jadi tercentang
	   } else {
	    if (box.checked == false) box.checked = true;
	   }
	 
	  }
	 // jika checkMaster tidak tercentang
	 } else if (all.checked == false)
	 {
	  // lakukan looping sebanyak data data
	  for (var j = 1; j <= byk_data; j++) {
	 
	   // mengeset var checkbox data
	   var box = eval("document.forms['form1'].item" + j);
	 
	   // jika checkboxnya tidak terdefinisi, maka lanjutkan
	   // tidak ada error yang terjadi (error handling)
	   if (box == undefined) {
		continue;
	   // selain itu, jika data tercentang, maka ubah jadi tidak tercentang
	   } else {
	    if (box.checked == true) box.checked = false;
	   }
	 
	  }
	 }
	}
