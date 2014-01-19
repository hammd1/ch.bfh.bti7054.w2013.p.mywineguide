function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf) {
     // Check each field has a value
    if (uid.value == ''        || 
          email.value == ''  || 
          password.value == ''       || 
          conf.value == '') {
 
    	alert(unescape("Sie m%FCssen alle ben%F6tigten Angaben machen%2C bitte versuchen Sie es erneut."));
    	return false;
    }
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
    	alert(unescape("Der Benutzername darf nur aus Buchstaben%2C Nummern und %22_%22 bestehen%2C bitte versuchen Sie es erneut."));
    	form.username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
    	alert(unescape("Das Passwort muss mindestens aus 6 Zeichen bestehen%2C bitte versuchen Sie es erneut."));
    	form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
    	alert(unescape("Ihr Passwort erf%FCllt die Bedingungen nicht%3A Bitte versuchen Sie es erneut."));
    	return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert(unescape("Ihr Passwort und das Best%E4tigungspasswort stimmen nicht %FCberein"));
        form.password.focus();
        return false;
    }
 
    //check email
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(email.value)) {
    	alert(unescape("Ihre Email-Adresse ist ung%FCltig%2C bitte versuchen Sie es erneut."));
    	return false;
    }
    
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
//    alert(unescape("Login erfolgreich%2C Sie k%F6nnen sich nun auf der Login Seite anmelden%0A"));

    form.submit();
    return true;
}