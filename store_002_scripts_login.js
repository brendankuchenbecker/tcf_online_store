//Add an event listener to the email.
document.getElementById('email').addEventListener('blur', function(event){
	event.preventDefault();
	//Check to see if this user already exists.
	check_email(email.value);
}, false);

function check_email(email){
	var xhttp = new XMLHttpRequest();
	var post_data = 'email=' + email;
	xhttp.onreadystatechange = function(){
		if (xhttp.readyState == 4 && xhttp.status == 200){
			//Get the response from ajax.
			var email_exists = xhttp.responseText;
			console.log('Email exists = ' + email_exists);
			//var first_name = document.getElementById('first_name');
			var sign_up = document.body.contains(document.getElementById('first_name'));
			console.log('Sign up clicked = ' + sign_up);
			if(email_exists && sign_up){
				//Get the password section element.
				section_password = document.getElementById('section_password');
				//Make the text in this element red.
				section_password.style.color = 'red';
				//Display a message to the user to log in.
				section_password.innerHTML = 'A user with that email already exists.<br>Click "Log in" instead.';
			}
		}
	}
	xhttp.open('POST', 'store_001_get_email.php', true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send(post_data);
}