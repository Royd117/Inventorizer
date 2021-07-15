var userValid = false; //AJAX
var displayValid = false; //not empty
var emailValid = false; //regexp
var oldPassValid = false;
var newPassValid = false; //regexp
var confirmValid = false; //compare

var auxid = 0;

function validateUser(usr){
	var xhttp;
    if (usr.length == 0) {
        document.getElementById("invalidChangeUser").hidden = true;
        document.getElementById('InputChangeUser').classList.remove("is-invalid");
        userValid = false;
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && (this.status == 200 || this.status == 204)) {
            document.getElementById("invalidChangeUser").hidden = false;
            document.getElementById('InputChangeUser').classList.add("is-invalid");
            userValid = false;
        } else {
            document.getElementById("invalidChangeUser").hidden = true;
            document.getElementById('InputChangeUser').classList.remove("is-invalid");
            userValid = true;
        }
    };
    xhttp.open("GET", "./Controllers/readUser.php?username="+usr, true);
    xhttp.send();
}

function validateDisplay(name){
	if(name == "") {
		document.getElementById("invalidChangeDisplay").hidden = false;
		document.getElementById('InputChangeDisplay').classList.add("is-invalid");
		displayValid = false;
	} else {
		document.getElementById("invalidChangeDisplay").hidden = true;
		document.getElementById('InputChangeDisplay').classList.remove("is-invalid");
		displayValid = true;
	}
}

function validateEmail(mail){
	var regexE = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	if(regexE.test(mail)){
		document.getElementById("invalidChangeEmail").hidden = true;
		document.getElementById('InputChangeEmail').classList.remove("is-invalid");
		emailValid = true;
	} else {
		document.getElementById("invalidChangeEmail").hidden = false;
		document.getElementById('InputChangeEmail').classList.add("is-invalid");
		emailValid = false;
	}
}

function placeValues(id,usr,disp,email){
    document.getElementById('InputChangeUser').value = usr;
    document.getElementById('InputChangeDisplay').value = disp;
    document.getElementById('InputChangeEmail').value = email;
    auxid = id;
}

function sendToUpdate(usr,name,email){
	validateUser(usr);
	validateDisplay(name);
	validateEmail(email);
	if(userValid && displayValid && emailValid)
		window.location = "./Controllers/updateUser.php?id="+auxid+"&username="+usr+"&displayname="+name+"&email="+email;
}



function validateOldPass(usr,pass){
	var xhttp;
    if (pass.length == 0) {
        document.getElementById("invalidOldPass").hidden = false;
        document.getElementById('InputOldPass').classList.add("is-invalid");
        oldPassValid = false;
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && (this.status == 200)) {
        	var obj = JSON.parse(this.responseText);
            obj.forEach((data) => {
	        	if(data.password == cipher(pass)) {
		            document.getElementById("invalidOldPass").hidden = true;
		            document.getElementById('InputOldPass').classList.remove("is-invalid");
		            oldPassValid = true;
		        } else {
		        	document.getElementById("invalidOldPass").hidden = false;
		            document.getElementById('InputOldPass').classList.add("is-invalid");
		            oldPassValid = false;
		        }
		    });
        } else {
            document.getElementById("invalidOldPass").hidden = false;
            document.getElementById('InputOldPass').classList.add("is-invalid");
            oldPassValid = false;
        }
    };
    xhttp.open("GET", "./Controllers/readUser.php?username="+usr, true);
    xhttp.send();
}

function validateNewPass(pass){
	var hasDigit = false;
	var hasLower = false;
	var hasUpper = false;
	for(let i=0; i<pass.length ; i+=1) {
		if(pass.charAt(i) >= '0' && pass.charAt(i) <= '9') hasDigit = true;
		if(pass.charAt(i) >= 'a' && pass.charAt(i) <= 'z') hasLower = true;
		if(pass.charAt(i) >= 'A' && pass.charAt(i) <= 'Z') hasUpper = true;
	}
	if((pass.length > 7) && hasDigit && hasLower && hasUpper && (pass.length < 21)){
		document.getElementById("invalidNewPass").hidden = true;
		document.getElementById('InputNewPass').classList.remove("is-invalid");
		newPassValid = true;
	} else {
		document.getElementById("invalidNewPass").hidden = false;
		document.getElementById('InputNewPass').classList.add("is-invalid");
		newPassValid = false;
	}
}

function validateConfirm(pass,conf){
	if(pass === conf) {
		document.getElementById("invalidConfirmPass").hidden = true;
		document.getElementById('InputConfirmPass').classList.remove("is-invalid");
		confirmValid = true;
	} else {
		document.getElementById("invalidConfirmPass").hidden = false;
		document.getElementById('InputConfirmPass').classList.add("is-invalid");
		confirmValid = false;
	}
}

function placeSecretValues(id){
    auxid = id;
}

function sendToSecretUpdate(usr,old,pass,conf){
	//validateOldPass(usr,old);
	validateNewPass(pass);
	validateConfirm(pass,conf);
	if(oldPassValid && newPassValid && confirmValid)
		window.location = "./Controllers/updateUser.php?id="+auxid+"&new="+cipher(pass);
}

function cipher(str){
	//Duplicate string
	var auxstr = str.repeat(2);
	//Diffuse string
	var adder = true;
	var diffused = "";
	for(let i=0; i<auxstr.length ; i+=1){
		diffused += (adder) ? String.fromCharCode(auxstr.charCodeAt(i) + i) : String.fromCharCode(auxstr.charCodeAt(i) - i);
		adder = !adder;
	}
	//Reverse string
	var splitString = diffused.split("");
    var reverseArray = splitString.reverse();
    var revPass = reverseArray.join("");

    return revPass;
}

function sendToDelete(id){
	window.location = "./Controllers/deleteUser.php?id="+id;
}
