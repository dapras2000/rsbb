	
	//functions.js
			
	//A variable used to distinguish whether to open or close the calendar.
	var showOrHide = true;
	
	function showHideCalendar() {
		
		//The location we are loading the page into.
		var objID = "calendar";
		
		//Change the current image of the minus or plus.
		if (showOrHide == true){
			//Show the calendar.
			document.getElementById("opencloseimg").src = "images/mins.gif";
			//The page we are loading.
			var serverPage = "calendar.php";
			//Set the open close tracker variable.
			showOrHide = false;
			var obj = document.getElementById(objID);
			processajax (serverPage, obj, "get", "");
		} else {
			//Hide the calendar.
			document.getElementById("opencloseimg").src = "images/plus.gif";
			showOrHide = true;
			//Reset the content.
			document.getElementById(objID).innerHTML = "";
		}
		
		
	}
	
	function createform (e, thedate){
		
		theObject = document.getElementById("createtask");
		
		theObject.style.visibility = "visible";
		theObject.style.height = "200px";
		theObject.style.width = "200px";
		
		var posx = 0;
		var posy = 0;
		
		posx = e.clientX + document.body.scrollLeft;
		posy = e.clientY + document.body.scrollTop;
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		//The location we are loading the page into.
		var objID = "createtask";
		var serverPage = "theform.php?thedate=" + thedate;
		
		var obj = document.getElementById(objID);
		processajax (serverPage, obj, "get", "");
		
	}
		
	function closetask (){
		
		theObject = document.getElementById("createtask");
		
		theObject.style.visibility = "hidden";
		theObject.style.height = "0px";
		theObject.style.width = "0px";
		
		acObject = document.getElementById("autocompletediv");
		
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
	}
	
	function findPosX(obj){
		var curleft = 0;
		if (obj.offsetParent){
			while (obj.offsetParent){
				curleft += obj.offsetLeft
				obj = obj.offsetParent;
			}
		} else if (obj.x){
			curleft += obj.x;
		}
		return curleft;
	}
	
	function findPosY(obj){
		var curtop = 0;
		if (obj.offsetParent){
			while (obj.offsetParent){
				curtop += obj.offsetTop
				obj = obj.offsetParent;
			}
		} else if (obj.y){
			curtop += obj.y;
		}
		return curtop;
	}
	
	function autocomplete (thevalue, e){
		
		theObject = document.getElementById("autocompletediv");
		
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("namabarang")) + 1);
		posy = (findPosY (document.getElementById("namabarang")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
		if (theextrachar == 8){
			if (thevalue.length == 1){
				var serverPage = "rajal/autocomp.php";
			} else {
				var serverPage = "rajal/autocomp.php" + "?sstring=" + thevalue.substr (0, (thevalue.length -1));
			}
		} else {
			var serverPage = "rajal/autocomp.php" + "?sstring=" + thevalue + String.fromCharCode (theextrachar);
		}
		
		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
	}
	
	function autocomplete_permbarang (thevalue, e){
		
		theObject = document.getElementById("autocompletediv");
		radObject1 = document.getElementById("gudang");
		radObject2 = document.getElementById("logistik");
		var grpbarang = document.getElementById("grpbarang").value;
		
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("nm_barang")) + 1);
		posy = (findPosY (document.getElementById("nm_barang")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
		
		if(radObject1.checked){
			
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "rajal/autocomp_permobat.php?grp=" + grpbarang;
				} else {
					var serverPage = "rajal/autocomp_permobat.php?grp=" + grpbarang + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "rajal/autocomp_permobat.php?grp=" + grpbarang + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		}else if(radObject2.checked){
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "rajal/autocomp_permbarang.php?grp=" + grpbarang;
				} else {
					var serverPage = "rajal/autocomp_permbarang.php?grp=" + grpbarang + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "rajal/autocomp_permbarang.php?grp=" + grpbarang + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		}
		
		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
	}
	
	function autocomplete_obat (thevalue, e){
		
		theObject = document.getElementById("autocompletediv");
		var grpbarang = document.getElementById("grpbarang").value;
	
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("nm_barang")) + 1);
		posy = (findPosY (document.getElementById("nm_barang")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
		
			if (theextrachar == 8){
			if (thevalue.length == 1){
					var serverPage = "rajal/autocomp_permobat.php?grp=" + grpbarang;
				} else {
					var serverPage = "rajal/autocomp_permobat.php?grp=" + grpbarang + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "rajal/autocomp_permobat.php?grp=" + grpbarang + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		

		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
	}
	
	
	function autocomplete_barang (thevalue, e){
		
		theObject = document.getElementById("autocompletediv");
		radObject1 = document.getElementById("gudang");
		radObject2 = document.getElementById("logistik");
		radObject3 = document.getElementById("bhp");
		var grpbarang = document.getElementById("grpbarang").value;
		
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("nm_barang")) + 1);
		posy = (findPosY (document.getElementById("nm_barang")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
		
		if(radObject1.checked){
			
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "orderbarang/autocomp_barang.php?farmasi=1&grp=" + grpbarang;
				} else {
					var serverPage = "orderbarang/autocomp_barang.php?farmasi=1&grp=" + grpbarang + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "orderbarang/autocomp_barang.php?farmasi=1&grp=" + grpbarang + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		}else if(radObject2.checked){
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "orderbarang/autocomp_barang.php?farmasi=0&grp=" + grpbarang;
				} else {
					var serverPage = "orderbarang/autocomp_barang.php?farmasi=0&grp=" + grpbarang + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "orderbarang/autocomp_barang.php?farmasi=0&grp=" + grpbarang + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		}else if(radObject3.checked){
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "orderbarang/autocomp_barang.php?farmasi=2&grp=" + grpbarang;
				} else {
					var serverPage = "orderbarang/autocomp_barang.php?farmasi=2&grp=" + grpbarang + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "orderbarang/autocomp_barang.php?farmasi=2&grp=" + grpbarang + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		}
		
		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
	}
	
	function autocomplete_apotek (thevalue, e){
		
    	theObject = document.getElementById("autocompletediv");
		
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("nm_barang")) + 1);
		posy = (findPosY (document.getElementById("nm_barang")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
		
			
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "orderbarang/autocomp_barang.php?farmasi=1&grp=1";
				} else {
					var serverPage = "orderbarang/autocomp_barang.php?farmasi=1&grp=1&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "orderbarang/autocomp_barang.php?farmasi=1&grp=1&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		
		
		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
	}
	
	
	function autocomplete_gudang (thevalue, e){
		
		theObject = document.getElementById("autocompletediv");
		var optFarmasi = document.getElementById("farmasi").value;
		var grpbarang = document.getElementById("grpbarang").value;
		
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("nm_barang")) + 1);
		posy = (findPosY (document.getElementById("nm_barang")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
		
			
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "gudang/autocomp_barang.php?farmasi=" + optFarmasi + "&grp=" + grpbarang;
				} else {
					var serverPage = "gudang/autocomp_barang.php?farmasi=" + optFarmasi + "&grp= " + grpbarang + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "gudang/autocomp_barang.php?farmasi=" + optFarmasi + "&grp= " + grpbarang + " &sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		
		
		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
	}

	function setvalue (thevalue,kode, nobatch, expdate){
		acObject = document.getElementById("autocompletediv");
		
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		
		document.getElementById("nm_barang").value = thevalue;
		document.getElementById("kd_barang").value = kode;
		document.getElementById("no_batch").value = nobatch;
		document.getElementById("tgl_kadaluarsa").value = expdate;
		document.getElementById("nm_barang").focus();
		
	}
	
		function autocomplete_icd (thevalue, e){
		theObject = document.getElementById("autocompleteicd");
	
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("icd")) + 1);
		posy = (findPosY (document.getElementById("icd")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompleteicd";

		//Take into account the backspace.
		
		if (theextrachar == 8){
			if (thevalue.length == 1){
				var serverPage = "rajal/autocomp_icd.php";
			} else {
				var serverPage = "rajal/autocomp_icd.php" + "?sstring=" + thevalue.substr (0, (thevalue.length -1));
			}
		} else {
			var serverPage = "rajal/autocomp_icd.php" + "?sstring=" + thevalue + String.fromCharCode (theextrachar);
		}
		
	
		var obj = document.getElementById(objID);

		processajax (serverPage, obj, "get", "");
	}
	function autocomplete_icd2 (thevalue, e){
		theObject = document.getElementById("autocompleteicd2");
	
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("icd2")) + 1);
		posy = (findPosY (document.getElementById("icd2")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompleteicd2";

		//Take into account the backspace.
		
		if (theextrachar == 8){
			if (thevalue.length == 1){
				var serverPage = "rajal/autocomp_icd2.php";
			} else {
				var serverPage = "rajal/autocomp_icd2.php" + "?sstring=" + thevalue.substr (0, (thevalue.length -1));
			}
		} else {
			var serverPage = "rajal/autocomp_icd2.php" + "?sstring=" + thevalue + String.fromCharCode (theextrachar);
		}
		
	
		var obj = document.getElementById(objID);

		processajax (serverPage, obj, "get", "");
	}
	function autocomplete_icd3 (thevalue, e){
		theObject = document.getElementById("autocompleteicd3");
	
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("icd3")) + 1);
		posy = (findPosY (document.getElementById("icd3")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompleteicd3";

		//Take into account the backspace.
		
		if (theextrachar == 8){
			if (thevalue.length == 1){
				var serverPage = "rajal/autocomp_icd3.php";
			} else {
				var serverPage = "rajal/autocomp_icd3.php" + "?sstring=" + thevalue.substr (0, (thevalue.length -1));
			}
		} else {
			var serverPage = "rajal/autocomp_icd3.php" + "?sstring=" + thevalue + String.fromCharCode (theextrachar);
		}
		
	
		var obj = document.getElementById(objID);

		processajax (serverPage, obj, "get", "");
	}
	function autocomplete_icd4 (thevalue, e){
		theObject = document.getElementById("autocompleteicd4");
	
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("icd4")) + 1);
		posy = (findPosY (document.getElementById("icd4")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompleteicd4";

		//Take into account the backspace.
		
		if (theextrachar == 8){
			if (thevalue.length == 1){
				var serverPage = "rajal/autocomp_icd4.php";
			} else {
				var serverPage = "rajal/autocomp_icd4.php" + "?sstring=" + thevalue.substr (0, (thevalue.length -1));
			}
		} else {
			var serverPage = "rajal/autocomp_icd4.php" + "?sstring=" + thevalue + String.fromCharCode (theextrachar);
		}
		
	
		var obj = document.getElementById(objID);

		processajax (serverPage, obj, "get", "");
	}
	function setvalue_icd (thevalue,kode){
		acObject = document.getElementById("autocompleteicd");
		
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		
		document.getElementById("icd").value = thevalue;
		document.getElementById("icd_code").value = kode;
		document.getElementById("icd").focus();
		
	}
	function setvalue_icd2 (thevalue,kode){
		acObject = document.getElementById("autocompleteicd2");
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		document.getElementById("icd2").value = thevalue;
		document.getElementById("icd_code2").value = kode;
		document.getElementById("icd2").focus();
	}
	function setvalue_icd3 (thevalue,kode){
		acObject = document.getElementById("autocompleteicd3");
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		document.getElementById("icd3").value = thevalue;
		document.getElementById("icd_code3").value = kode;
		document.getElementById("icd3").focus();
	}
	function setvalue_icd4 (thevalue,kode){
		acObject = document.getElementById("autocompleteicd4");
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		document.getElementById("icd4").value = thevalue;
		document.getElementById("icd_code4").value = kode;
		document.getElementById("icd4").focus();
	}
	
	function validateform (thevalue){
		
		serverPage = "validator.php?sstring=" + thevalue;
		objID = "messagebox";
		
		var obj = document.getElementById(objID);
		processajax (serverPage, obj, "get", "");
	}
	
	function checkfortasks (thedate, e){
		
		theObject = document.getElementById("taskbox");
		
		theObject.style.visibility = "visible";
		
		var posx = 0;
		var posy = 0;
		
		posx = e.clientX + document.body.scrollLeft;
		posy = e.clientY + document.body.scrollTop;
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		serverPage = "taskchecker.php?thedate=" + thedate;
		objID = "taskbox";
		
		var obj = document.getElementById(objID);
		processajax (serverPage, obj, "get", "")
	}
	
	function hidetask (){
		tObject = document.getElementById("taskbox");
		
		tObject.style.visibility = "hidden";
		tObject.style.height = "0px";
		tObject.style.width = "0px";
	}
	
	function trim(inputString) {
	   // Removes leading and trailing spaces from the passed string. Also removes
	   // consecutive spaces and replaces it with one space. If something besides
	   // a string is passed in (null, custom object, etc.) then return the input.
	   if (typeof inputString != "string") { return inputString; }
	   var retValue = inputString;
	   var ch = retValue.substring(0, 1);
	   while (ch == " ") { // Check for spaces at the beginning of the string
	      retValue = retValue.substring(1, retValue.length);
	      ch = retValue.substring(0, 1);
	   }
	   ch = retValue.substring(retValue.length-1, retValue.length);
	   while (ch == " ") { // Check for spaces at the end of the string
	      retValue = retValue.substring(0, retValue.length-1);
	      ch = retValue.substring(retValue.length-1, retValue.length);
	   }
	   while (retValue.indexOf("  ") != -1) { // Note that there are two spaces in the string - look for multiple spaces within the string
	      retValue = retValue.substring(0, retValue.indexOf("  ")) + retValue.substring(retValue.indexOf("  ")+1, retValue.length); // Again, there are two spaces in each of the strings
	   }
	   return retValue; // Return the trimmed string back to the user
	} // Ends the "trim" function
	
	//Function to validate the addtask form.
	function validatetask (thevalue, thename){
		
		var nowcont = true;
		
		if (thename == "yourname"){
			if (trim (thevalue) == ""){
				document.getElementById("themessage").innerHTML = "You must enter your name.";
				document.getElementById("newtask").yourname.focus();
				nowcont = false;
			}
		}
		if (nowcont == true){
			if (thename == "yourtask"){
				if (trim (thevalue) == ""){
					document.getElementById("themessage").innerHTML = "You must enter a task.";
					document.getElementById("newtask").yourtask.focus();
					nowcont = false;
				}
			}
		}
		
		return nowcont;
	}
	
	var aok;
	
	//Functions to submit a form.
	function getformvalues (fobj, valfunc){
		
		var str = "";
		aok = true;
		var val;
		//Run through a list of all objects contained within the form.
		for(var i = 0; i < fobj.elements.length; i++){
			if(valfunc) {
				if (aok == true){
					val = valfunc (fobj.elements[i].value,fobj.elements[i].name); 
					if (val == false){
						aok = false;
					}
				}
			}
			str += fobj.elements[i].name + "=" + escape(fobj.elements[i].value) + "&";
		}
		//Then return the string values.
		return str;
	}
	
	function submitform (theform, serverPage, objID, valfunc){
		
		var file = serverPage;
		var str = getformvalues(theform,valfunc);
		
		//If the validation is ok.
		if (aok == true){
			obj = document.getElementById(objID);
			processajax (serverPage, obj, "post", str);
		}
	}
	
	function newsubmitform (theform, serverPage, objID, valfunc){
		
		var file = serverPage;
		var str = getnewformvalues(theform,valfunc);
		
		//If the validation is ok.
		if (aok == true){
			obj = document.getElementById(objID);
			processajax (serverPage, obj, "post", str);
		}
	}
	
	function getnewformvalues (fobj, valfunc){
		
		var str = "";
		aok = true;
		var val;
		//Run through a list of all objects contained within the form.
		for(var i = 0; i < fobj.elements.length; i++){
		  if(fobj.elements[i].type=='checkbox') {

			if(fobj.elements[i].checked){
			   str += fobj.elements[i].name + "=" + escape(fobj.elements[i].value) + "&";
			
			}
			
			
		 }else if(fobj.elements[i].type=='radio') {

			if(fobj.elements[i].checked){
			   str += fobj.elements[i].name + "=" + escape(fobj.elements[i].value) + "&";
			
			}
			
			
		 }else{
			  str += fobj.elements[i].name + "=" + escape(fobj.elements[i].value) + "&";
		 }
			
		}
		//Then return the string values.
		return str;
	}
	
	function saveresep(s){

		var objID = "cart_resep";
		var obj = document.getElementById(objID);
		
		processajax ("rajal/saveresep.php", obj, "post", "idxnya="+s+"&");
		
	}

  
	function deleteResep(s,s1){
		
		var objID = "cart_resep";
		var obj = document.getElementById(objID);
		
		processajax ("rajal/delresep.php", obj, "post", "idxresep="+s+"&"+"idxdaftar="+s1+"&");
	}
	
	function addbayar(s){

		var objID = "cart_bayar";
		var obj = document.getElementById(objID);
		
		processajax ("addbayar.php", obj, "post", "kode="+s+"&");
	}
	
	function newaddbayar(s, d, p){

		var objID = "cart_bayar";
		var obj = document.getElementById(objID);
		
		processajax ("addbayar.php", obj, "post", "kode="+s+"&dokter="+d+"&tarif="+p);
	}
	
		function delcart(s,s1){
		
		var objID = "cart_bayar";
		var obj = document.getElementById(objID);
		
		processajax ("delbayar.php", obj, "post", "kodetarif="+s+"&");
	}

	function edituser(s){

		var objID = "edit_user";
		var obj = document.getElementById(objID);
		processajax ("adm/form_edit_user.php", obj, "post", "NIP="+s+"&");
	}
	
	function editmakanan(s){

		var objID = "edit_makanan";
		var obj = document.getElementById(objID);
		processajax ("pantri/form_edit_makanan.php", obj, "post", "id="+s+"&");
	}
	
	function editbahanmakanan(s){

		var objID = "edit_bahan_makanan";
		var obj = document.getElementById(objID);
		processajax ("pantri/form_edit_bahanmakanan.php", obj, "post", "id="+s+"&");
	}
	
	function str_replace(search_target,replacement,str)
    {
        str = new String(str);
        var n_str = str.length;
        var n_search = search_target.length;
        var result = "",searching = 0;
        for(var i=0;i<n_str;i++)
        {   
            if (n_search == 1)
            {
                if (str.charAt(i) == search_target) result += replacement;
                else result+=str.charAt(i);
            }else
            {           
                searching = str.indexOf(search_target,i);
                if (searching <= i && searching >= 0)
                {
                    result += replacement;                               
                    i+=n_search-1;
                }
                else
                {
                    result+=str.charAt(i);
                }
                   
            }           
        }
        return result;
    }
	
	
var startyear = "1950";
var endyear = "2010";
var dat = new Date();
var curday = dat.getDate();
var curmon = dat.getMonth()+1;
var curyear = dat.getFullYear();

function checkleapyear(datea)
{
	if(datea.getYear()%4 == 0)
	{
		if(datea.getYear()% 10 != 0)
		{
			return true;
		}
		else
		{
			if(datea.getYear()% 400 == 0)
				return true;
			else
				return false;
		}
	}
return false;
}
function DaysInMonth(Y, M) {
    with (new Date(Y, M, 1, 12)) {
        setDate(0);
        return getDate();
    }
}
function datediff(date1, date2) {
    var y1 = date1.getFullYear(), m1 = date1.getMonth(), d1 = date1.getDate(),
	 y2 = date2.getFullYear(), m2 = date2.getMonth(), d2 = date2.getDate();

    if (d1 < d2) {
        m1--;
        d1 += DaysInMonth(y2, m2);
    }
    if (m1 < m2) {
        y1--;
        m1 += 12;
    }
    return [y1 - y2, m1 - m2, d1 - d2];
}

function calage(ctgl, objID)
{
	
var calday = ctgl.substr(8,2);
var calmon = ctgl.substr(5,2);
var calyear = ctgl.substr(0,4);

if(curday == "" || curmon=="" || curyear=="" || calday=="" || calmon=="" || calyear=="")
	{
		//alert("please fill all the values and click go -");
	}	
	else
	{
		var curd = new Date(curyear,curmon-1,curday);
		var cald = new Date(calyear,calmon-1,calday);
		
		var diff =  Date.UTC(curyear,curmon,curday,0,0,0) - Date.UTC(calyear,calmon,calday,0,0,0);

		var dife = datediff(curd,cald);
		vobj = document.getElementById(objID);
		vobj.value = dife[0]+" tahun "+dife[1]+" bulan "+dife[2]+" hari";
		}
}

function submitformpendaftaran(theform, serverPage, objID, valfunc){
		var file = serverPage;
		var str = getnewformvalues(theform,valfunc);
		
		//If the validation is ok.
		if (aok == true){
			
			obj = document.getElementById(objID);
			processajaxpendaftaran(serverPage, obj, "post", str);
			
		}
	}


//radiologi

function autocomplete_barang_rad(thevalue, e){
	theObject = document.getElementById("autocompletediv");
		radObject1 = document.getElementById("j_br1");
		radObject2 = document.getElementById("j_br2");
				
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("nm_barang")) + 1);
		posy = (findPosY (document.getElementById("nm_barang")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
		
		if(radObject1.checked){
			
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "radiologi/orderbarang/autocomp_barang.php?farmasi=1&grp=1";
				} else {
					var serverPage = "radiologi/orderbarang/autocomp_barang.php?farmasi=1&grp=1" + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "radiologi/orderbarang/autocomp_barang.php?farmasi=1&grp=1" + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		}else if(radObject2.checked){
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "radiologi/orderbarang/autocomp_barang.php?farmasi=1&grp=2";
				} else {
					var serverPage = "radiologi/orderbarang/autocomp_barang.php?farmasi=1&grp=2" + "&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "radiologi/orderbarang/autocomp_barang.php?farmasi=1&grp=2" + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		}
		
		var obj = document.getElementById(objID);
		
			processajax (serverPage, obj, "get", "");
}

function setvalue_rad (thevalue,kode){
		acObject = document.getElementById("autocompletediv");
		
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		
		document.getElementById("nm_barang").value = thevalue;
		document.getElementById("kd_barang").value = kode;
		document.getElementById("no_batch").focus();
		
	}
	
function autocomplete_barang_rad_nobatch(thevalue, e){
	theObject = document.getElementById("autocompletediv");
		radObject1 = document.getElementById("kd_barang").value;
						
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("no_batch")) + 1);
		posy = (findPosY (document.getElementById("no_batch")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "radiologi/orderbarang/autocomp_barang_nobatch.php?kdbarang=" + radObject1;
				} else {
					var serverPage = "radiologi/orderbarang/autocomp_barang_nobatch.php?kdbarang=" + radObject1 +"&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "radiologi/orderbarang/autocomp_barang_nobatch.php?kdbarang=" + radObject1 + "&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		
		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
}

function setvalue_rad_nobatch (thevalue){
		acObject = document.getElementById("autocompletediv");
		
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		
		document.getElementById("no_batch").value = thevalue;
		document.getElementById("jml_barang").focus();
		
	}
	
function autocomplete_resep (thevalue, e){
		
    	theObject = document.getElementById("autocompletediv");
		
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("nm_barang")) + 1);
		posy = (findPosY (document.getElementById("nm_barang")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletediv";

		//Take into account the backspace.
		
			
			if (theextrachar == 8){
				if (thevalue.length == 1){
					var serverPage = "rajal/resep/autocomp_barang.php?farmasi=1&grp=1";
				} else {
					var serverPage = "rajal/resep/autocomp_barang.php?farmasi=1&grp=1&sstring=" + thevalue.substr (0, (thevalue.length -1));
				}
			} else {
				var serverPage = "rajal/resep/autocomp_barang.php?farmasi=1&grp=1&sstring=" + thevalue + String.fromCharCode (theextrachar);
			}
		
		
		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
	}	
	
	function delobat(s,s1){
		
		var objID = "cart_obat";
		var obj = document.getElementById(objID);
		
		processajax ("rajal/add_obat.php", obj, "post", "idxtemp="+s+"&");
	}
	
	function autocomplete_obat (thevalue, e){
		theObject = document.getElementById("autocompletedivobat");
	
		theObject.style.visibility = "visible";
		theObject.style.width = "300px";
		
		var posx = 0;
		var posy = 0;
		
		posx = (findPosX (document.getElementById("obat")) + 1);
		posy = (findPosY (document.getElementById("obat")) + -125);
		
		theObject.style.left = posx + "px";
		theObject.style.top = posy + "px";
		
		var theextrachar = e.which;
		
		if (theextrachar == undefined){
			theextrachar = e.keyCode;
		}
		
		//The location we are loading the page into.
		var objID = "autocompletedivobat";

		//Take into account the backspace.
		
		if (theextrachar == 8){
			if (thevalue.length == 1){
				var serverPage = "rajal/autocomp_obat.php";
			} else {
				var serverPage = "rajal/autocomp_obat.php" + "?sstring=" + thevalue.substr (0, (thevalue.length -1));
			}
		} else {
			var serverPage = "rajal/autocomp_obat.php" + "?sstring=" + thevalue + String.fromCharCode (theextrachar);
		}
		
	
		var obj = document.getElementById(objID);

		processajax (serverPage, obj, "get", "");
	}
	
	function setvalueobat (thevalue){
		acObject = document.getElementById("autocompletedivobat");
		
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		
		document.getElementById("obat").value = thevalue;
		document.getElementById("obat").focus();
		
	}
