var userValid = false; //AJAX
var displayValid = false; //not empty
var emailValid = false; //regexp
var passValid = false; //regexp
var confirmValid = false; //compare

function validateUser(usr){
	var xhttp;
    if (usr.length == 0) {
        document.getElementById("invalidUser").hidden = true;
        document.getElementById('SignUser').classList.remove("is-invalid");
        userValid = false;
        validateAll();
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && (this.status == 200 || this.status == 204)) {
            document.getElementById("invalidUser").hidden = false;
            document.getElementById('SignUser').classList.add("is-invalid");
            userValid = false;
            validateAll();
        } else {
            document.getElementById("invalidUser").hidden = true;
            document.getElementById('SignUser').classList.remove("is-invalid");
            userValid = true;
            validateAll();
        }
    };
    xhttp.open("GET", "./Controllers/readUser.php?username="+usr, true);
    xhttp.send();
}

function validateDisplay(name){
	if(name == "") {
		document.getElementById("invalidDisplay").hidden = false;
		document.getElementById('SignDisplay').classList.add("is-invalid");
		displayValid = false;
		validateAll();
	} else {
		document.getElementById("invalidDisplay").hidden = true;
		document.getElementById('SignDisplay').classList.remove("is-invalid");
		displayValid = true;
		validateAll();
	}
}

function validateEmail(mail){
	var regexE = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	if(regexE.test(mail)){
		document.getElementById("invalidEmail").hidden = true;
		document.getElementById('SignEmail').classList.remove("is-invalid");
		emailValid = true;
		validateAll();
	} else {
		document.getElementById("invalidEmail").hidden = false;
		document.getElementById('SignEmail').classList.add("is-invalid");
		emailValid = false;
		validateAll();
	}
}

function validatePass(pass){
	var hasDigit = false;
	var hasLower = false;
	var hasUpper = false;
	for(let i=0; i<pass.length ; i+=1) {
		if(pass.charAt(i) >= '0' && pass.charAt(i) <= '9') hasDigit = true;
		if(pass.charAt(i) >= 'a' && pass.charAt(i) <= 'z') hasLower = true;
		if(pass.charAt(i) >= 'A' && pass.charAt(i) <= 'Z') hasUpper = true;
	}
	if((pass.length > 7) && hasDigit && hasLower && hasUpper && (pass.length < 21)){
		document.getElementById("invalidPass").hidden = true;
		document.getElementById('SignPassword').classList.remove("is-invalid");
		passValid = true;
		validateAll();
	} else {
		document.getElementById("invalidPass").hidden = false;
		document.getElementById('SignPassword').classList.add("is-invalid");
		passValid = false;
		validateAll();
	}
}

function validateConfirm(pass,conf){
	if(pass === conf) {
		document.getElementById("invalidConfirm").hidden = true;
		document.getElementById('SignConfirm').classList.remove("is-invalid");
		confirmValid = true;
		validateAll();
	} else {
		document.getElementById("invalidConfirm").hidden = false;
		document.getElementById('SignConfirm').classList.add("is-invalid");
		confirmValid = false;
		validateAll();
	}
}

function validateAll() {
	if(userValid && displayValid && emailValid && passValid && confirmValid) {
		document.getElementById("signupbtn").disabled = false;
	} else {
		document.getElementById("signupbtn").disabled = true;
	}
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

function signup(usr,disp,email,pass){
	window.location = "./Controllers/createUser.php?username="+usr+"&displayname="+disp+"&email="+email+"&password="+cipher(pass);
}
