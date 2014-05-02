function validateForm() {
	//displays all errors on one page
	var errors = '';
	//validates name
	var name = document.forms["contactUs"]['name'].value;
	if (name == null || name == "") {
		errors = "Valid Name must be entered! \n";
	}
	//validates email
	var email = document.forms["contactUs"]["e-mail"].value;
	atpos = email.indexOf("@");
	dotpos = email.lastIndexOf(".");
	if (atpos < 1 || (dotpos - atpos < 2) || email == null || email == "") {
		errors += "Please enter correct EMAIL ADDRESS! \n";

	}
	//validates subject
	var subject = document.forms["contactUs"]['subject'].value;
	if (subject == null || subject == "") {
		errors += "Valid Subject must be entered! \n";
	}
	//validates message
	var message = document.forms["contactUs"]['message'].value;
	if (message == null || message == "") {
		errors += "Valid Message must be entered! \n";
	}
	//validates security
	var security = document.forms["contactUs"]['security'].value;
	if (security != 30) {
		errors += "Please answer the Security question correctly! \n";
	}
	//checks if errors exist
	if (!errors == '') {
		alert("The following error(s) occured: \n\n" + errors);
		return false;
	} else {
		return true;
	}
}
