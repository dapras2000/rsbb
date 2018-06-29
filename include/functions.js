	
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
				var serverPage = "RAJAL/autocomp.php";
			} else {
				var serverPage = "RAJAL/autocomp.php" + "?sstring=" + thevalue.substr (0, (thevalue.length -1));
			}
		} else {
			var serverPage = "autocomp.php" + "?sstring=" + thevalue + String.fromCharCode (theextrachar);
		}
		
		var obj = document.getElementById(objID);
		
		processajax (serverPage, obj, "get", "");
	}
	
	function setvalue (thevalue,kode){
		acObject = document.getElementById("autocompletediv");
		
		acObject.style.visibility = "hidden";
		acObject.style.height = "0px";
		acObject.style.width = "0px";
		
		document.getElementById("namabarang").value = thevalue;
		document.getElementById("kode").value = kode;
		document.getElementById("namabarang").focus();
		
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
	
		function delcart(s,s1){
		
		var objID = "cart_bayar";
		var obj = document.getElementById(objID);
		
		processajax ("delbayar.php", obj, "post", "kodetarif="+s+"&");
	}
