//main js file for this project

//check url invalidity and format
function checkUrl(url) {
	var f = false;
	url = url.replace(" ", ""); //remove spaces
	if (url.indexOf("360buy.com") > -1) {
		if ((url.indexOf("brand") == -1) && (url.search(/[0-9]+\.html\/?/i) != -1)) {
			f = 1; //single product url
		} else {
			f = 2; //cateogry url
		}
	}
	return f;
}

//check if Enter has been pressed
function checkEnter(evt) {
	if (evt.which || evt.keyCode) {
		if (evt.which == 13 || evt.keyCode == 13) {
			return true;
		}
	}
}

//get product info: title, price and url
function getPInfo(pinfo) {
	var pinfoArr = [];
	if (pinfo.length < 5) {
		alert("Invalid responsetext");
	} else {
		var pptitle = pinfo.substr(0, pinfo.indexOf("\r\n"));
		var ppprice = pinfo.substring(pinfo.indexOf("\r\n"), pinfo.lastIndexOf("\r\n"));
		ppprice = ppprice.replace("\r\n", "");
		var ppurl = pinfo.substring(pinfo.lastIndexOf("\r\n"));
		ppurl = ppurl.replace("\r\n", "");
		pinfoArr[0] = pptitle;
		pinfoArr[1] = ppprice;
		pinfoArr[2] = ppurl;
	}
	return pinfoArr;
}

//basic ajax wrapper
function getXHR() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
	} else if (window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
	}
}

//ajax main
function showResult(url) {
	var ptag = checkUrl(url);
	if (!ptag) {
		alert("Invalid product URL!\n\rONLY support 360buy.com so far!");
		document.getElementById("plist").style.display = "none";
		document.getElementById("ppinfo").style.display = "none";
		document.getElementById("uemail").style.display = "none";
		document.getElementById("step2").style.display = "none";
		return;
	}
	xmlhttp = getXHR();	
	xmlhttp.onreadystatechange = function () {
		document.getElementById("loadingImg").style.display = "inherit";
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
			var pinfo = getPInfo(xmlhttp.responseText);
			
			if (pinfo.length == 0) {
				document.getElementById("plist").style.display = "none";
				document.getElementById("ppinfo").style.display = "none";
				document.getElementById("uemail").style.display = "none";
				document.getElementById("step2").style.display = "none";
			}
			if (ptag == 1) { //single product
				document.getElementById("plist").style.display = "none";
				document.getElementById("pptitle1").innerHTML = pinfo[0]; //title
				document.getElementById("ppprice1").value = pinfo[1]; //price
				document.getElementById("pptitle2").innerHTML = pinfo[0]; //title
				document.getElementById("ppprice2").value = pinfo[1]; //price
				document.getElementById("ppprice3").value = pinfo[1]; //price
				document.getElementById("pptitle3").innerHTML = pinfo[0]; //title
				document.getElementById("ppinfo").style.display = "inherit";
				
			} else if (ptag == 2) { //
				document.getElementById("plist").style.display = "inherit";
				document.getElementById("ppinfo").style.display = "none"; //hide the div for single product
				document.getElementById("plist").innerHTML = pinfo; //price
			}
			document.getElementById("step2").style.display = "inherit";
			document.getElementById("uemail").style.display = "inherit";
			document.getElementById("loadingImg").style.display = "none";
		}
	}
	xmlhttp.open("GET", "livesearch.php?q=" + url.replace(" ", ""), true);
	xmlhttp.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT"); //cache fix
	xmlhttp.send();
}

//submit all
function submitAll() {
	//check email validity
	if (checkEmail(document.getElementById("useremail").value)) {
		//
		alert("email ok.");
	} else {
		alert("Please provide a valid email address");
		document.getElementById("useremail").focus();
	}
	//submit all:
	
}

//check email
function checkEmail(email) {
	//var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	//if (filter.test(email)) {
	//return true;
	//}
}

//change element value by given id
function activeInput(id) {
	document.getElementById(id).focus();
}

//check if any product has been selected and if the email is valid.
function checkForm() {
	var chks = document.getElementsByName('pid[]');
	var email = document.getElementById('email').value;
	var flag = false;
	
	if (chks.length == 0) {
		alert("No product found in the given url!");
		return flag;
	}
	
	if ((email.indexOf(".") < 2) || (email.indexOf("@") == 0)) {
		alert("Invalid email address!");
	} else {
		var j = 0;
		for (var i = 0; i < chks.length; i++) {
			if (chks[i].checked) {
				j++;
				flag = true;
			}
		}
		if (j == 0) {
			alert("No produect selected!");
		}
	}
	return flag;
}
//toggle on/off all checkboxes
function checkAll() {
	var chks = document.getElementsByName('pid[]');
	var chkall = document.getElementById('chkall');
	for (var i = 0; i < chks.length; i++) {
		chks[i].checked = chkall.checked;
	}
}
 